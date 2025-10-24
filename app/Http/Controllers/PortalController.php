<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estabelecimento;
use App\Models\NaturezaJuridica;
use App\Models\Empresa;
use App\Models\Cnae;
use App\Models\Municipio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str; 
use Carbon\Carbon;

class PortalController extends Controller
{
    // EXIBE A PÁGINA PRINCIPAL DO PORTAL DE ANÁLISE.
    public function index()
    {
        // DURAÇÃO DO CACHE EM MINUTOS (24 HORAS).
        $cacheDuration = 2880; 

        // DATA DE CORTE PARA ANÁLISES ANUAIS
        $umAnoAtras = Carbon::now()->subYear();
        $tresAnosAtras = Carbon::now()->subYears(3);

        // BUSCA O TOTAL DE ESTABELECIMENTOS.
        //$totalEmpresas = Estabelecimento::count();

 
        // BUSCA AS 10 CIDADES COM MAIS EMPRESAS ATIVAS USANDO O RELACIONAMENTO ELOQUENT (COM CACHE).
        $top10Cidades = Cache::remember('portal_top_10_cidades', $cacheDuration, function () {
            // PASSO 1: FAZ A CONTAGEM NA TABELA PRINCIPAL E JÁ "EAGER LOADS" O RELACIONAMENTO.
            $topCidadesResult = Estabelecimento::with('municipioRel') // CARREGA O RELACIONAMENTO DE FORMA OTIMIZADA
                ->where('situacao_cadastral', 2) // Apenas ativos
                ->select('municipio', 'uf', DB::raw('count(*) as total'))
                ->groupBy('municipio', 'uf')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get();

            // PASSO 2: MAPEIA O RESULTADO PARA O FORMATO QUE A VIEW ESPERA.
            return $topCidadesResult->map(function ($item) {
                $nome = $item->municipioRel->descricao ?? 'Não encontrado';
                return (object) [
                    'nome' => $nome,
                    'uf' => $item->uf,
                    'total' => $item->total,
                    'municipio_slug' => Str::slug($nome),
                ];
            });
        });

        
        // BUSCA OS 10 ESTADOS COM MAIS EMPRESAS ATIVAS.
        // A CONSULTA CORRETA NÃO PRECISA DE JOIN, POIS A 'uf' JÁ ESTÁ EM 'estabelecimentos'.
        $top10Estados = Cache::remember('portal_top_10_estados', $cacheDuration, function () {
            return Estabelecimento::select('uf', DB::raw('count(*) as total'))
                ->where('situacao_cadastral', 2) // Apenas ativos
                ->whereNotNull('uf') // Garante que a UF não seja nula
                ->where('uf', '!=', '') // Garante que a UF não seja vazia
                ->groupBy('uf')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get();
        });

        
        // BUSCA OS 3 ESTADOS QUE MAIS FECHARAM EMPRESAS NO ANO DE 2024.
        $estadosMaisFechamentos = Cache::remember('portal_estados_mais_fechamentos_2024_v3', $cacheDuration, function () {
            return Estabelecimento::select('uf', DB::raw('count(*) as total'))
                ->where('situacao_cadastral', '!=', 2) 
                ->whereBetween('data_situacao_cadastral', ['2024-01-01', '2024-12-31']) 
                ->groupBy('uf')
                ->orderBy('total', 'desc')
                ->limit(3)
                ->get();
        });

        


        // BUSCA AS 10 ATIVIDADES ECONÔMICAS MAIS COMUNS.
        $top10Atividades = Cache::remember('top_10_atividades_v2', now()->addDay(), function () {
            // Realiza a contagem e agrupamento direto na tabela estabelecimentos
            $atividades = Estabelecimento::select('cnae_fiscal_principal', DB::raw('count(*) as total'))
                ->where('situacao_cadastral', 2) // Apenas empresas ativas
                ->whereNotNull('cnae_fiscal_principal')
                // ->with('cnaePrincipal') // Carrega o relacionamento
                ->groupBy('cnae_fiscal_principal')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get();

            // Como o 'with' não funciona bem com 'groupBy' para o que queremos, 
            // buscamos os detalhes dos CNAEs em uma segunda consulta otimizada.
            $cnaeIds = $atividades->pluck('cnae_fiscal_principal');
            $cnaes = Cnae::whereIn('codigo', $cnaeIds)->get()->keyBy('codigo');

            // Combina os resultados
            return $atividades->map(function($atividade) use ($cnaes) {
                $cnae = $cnaes->get($atividade->cnae_fiscal_principal);
                if ($cnae) {
                    $atividade->descricao = $cnae->descricao;
                    $atividade->codigo = $cnae->codigo;
                }
                return $atividade;
            })->filter(); // Remove itens que não encontraram um CNAE correspondente
        });


        // BUSCA A QUANTIDADE DE EMPRESAS POR NATUREZA JURÍDICA (TOP 10).
        $porNaturezaJuridica = Cache::remember('portal_top_10_natureza_juridica_geral', now()->addDay(), function () {
            // 1. Pega todas as naturezas jurídicas.
            $todasNaturezas = NaturezaJuridica::all();
            $contagem = [];

            // 2. Faz uma consulta de contagem para cada uma.
            foreach ($todasNaturezas as $natureza) {
                $total = Empresa::where('natureza_juridica', $natureza->codigo)->count();
                if ($total > 0) {
                    $contagem[] = (object) [
                        'natureza_juridica' => $natureza->codigo,
                        'descricao' => $natureza->descricao,
                        'total' => $total
                    ];
                }
            }
            
            // 3. Ordena o array de resultados em memória.
            usort($contagem, function($a, $b) {
                return $b->total <=> $a->total;
            });

            // 4. Pega os 10 primeiros e CONVERTE PARA UMA COLEÇÃO.
            return collect(array_slice($contagem, 0, 10));
        });

        
        // ESTATÍSTICAS DE EMPRESAS ABERTAS (ANO A ANO)
        $statsAbertas = Cache::remember('portal_stats_abertas_por_ano_22_24', now()->addDay(), function () {
            $anos = ['2024', '2023', '2022'];
            $dados = collect();
            foreach($anos as $ano) {
                $total = Estabelecimento::whereBetween('data_inicio_atividade', ["{$ano}-01-01", "{$ano}-12-31"])->count();
                $dados->put($ano, $total);
            }
            return $dados;
        });

        
        // ESTATÍSTICAS DE EMPRESAS FECHADAS (ANO A ANO)
        $statsFechadas = Cache::remember('portal_stats_fechadas_por_ano_22_24', now()->addDay(), function () {
            $anos = ['2024', '2023', '2022'];
            $dados = collect();
            foreach($anos as $ano) {
                $total = Estabelecimento::where('situacao_cadastral','!=', 2)
                    ->whereBetween('data_situacao_cadastral', ["{$ano}-01-01", "{$ano}-12-31"])
                    ->count();
                $dados->put($ano, $total);
            }
            return $dados;
        });
        

        // RETORNA A VIEW PRINCIPAL DO PORTAL, PASSANDO TODOS OS DADOS.
        return view('pages.empresas.index', [
            'top10Cidades' => $top10Cidades,
            'top10Estados' => $top10Estados,
            'estadosMaisFechamentos' => $estadosMaisFechamentos,
            'top10Atividades' => $top10Atividades,
            'porNaturezaJuridica' => $porNaturezaJuridica,
            'statsAbertas' => $statsAbertas,
            'statsFechadas' => $statsFechadas,
        ]);
    }

}

