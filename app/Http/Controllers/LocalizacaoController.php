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

class LocalizacaoController extends Controller
{
    // MAPA PARA BUSCAR O NOME COMPLETO DO ESTADO PELA SIGLA
    private $estadosBrasileiros = [
        'ac' => 'Acre', 'al' => 'Alagoas', 'ap' => 'Amapá', 'am' => 'Amazonas',
        'ba' => 'Bahia', 'ce' => 'Ceará', 'df' => 'Distrito Federal', 'es' => 'Espírito Santo',
        'go' => 'Goiás', 'ma' => 'Maranhão', 'mt' => 'Mato Grosso', 'ms' => 'Mato Grosso do Sul',
        'mg' => 'Minas Gerais', 'pa' => 'Pará', 'pb' => 'Paraíba', 'pr' => 'Paraná',
        'pe' => 'Pernambuco', 'pi' => 'Piauí', 'rj' => 'Rio de Janeiro', 'rn' => 'Rio Grande do Norte',
        'rs' => 'Rio Grande do Sul', 'ro' => 'Rondônia', 'rr' => 'Roraima', 'sc' => 'Santa Catarina',
        'sp' => 'São Paulo', 'se' => 'Sergipe', 'to' => 'Tocantins'
    ];

    // (NOVO) MAPA DE PREPOSIÇÕES CORRETAS PARA CADA ESTADO
    private $preposicoesEstado = [
        'ac' => 'do', 'al' => 'de', 'ap' => 'do', 'am' => 'do',
        'ba' => 'da', 'ce' => 'do', 'df' => 'do', 'es' => 'do',
        'go' => 'de', 'ma' => 'do', 'mt' => 'de', 'ms' => 'de',
        'mg' => 'de', 'pa' => 'do', 'pb' => 'da', 'pr' => 'do',
        'pe' => 'de', 'pi' => 'do', 'rj' => 'do', 'rn' => 'do',
        'rs' => 'do', 'ro' => 'de', 'rr' => 'de', 'sc' => 'de',
        'sp' => 'de', 'se' => 'de', 'to' => 'de'
    ];

    // (NOVO) MAPA DE CAPITAIS
    private $capitais = [
        'ac' => 'Rio Branco', 'al' => 'Maceió', 'ap' => 'Macapá', 'am' => 'Manaus',
        'ba' => 'Salvador', 'ce' => 'Fortaleza', 'df' => 'Brasília', 'es' => 'Vitória',
        'go' => 'Goiânia', 'ma' => 'São Luís', 'mt' => 'Cuiabá', 'ms' => 'Campo Grande',
        'mg' => 'Belo Horizonte', 'pa' => 'Belém', 'pb' => 'João Pessoa', 'pr' => 'Curitiba',
        'pe' => 'Recife', 'pi' => 'Teresina', 'rj' => 'Rio de Janeiro', 'rn' => 'Natal',
        'rs' => 'Porto Alegre', 'ro' => 'Porto Velho', 'rr' => 'Boa Vista', 'sc' => 'Florianópolis',
        'sp' => 'São Paulo', 'se' => 'Aracaju', 'to' => 'Palmas'
    ];

    // (NOVO) Lista de prefixos CNAE para Indústrias (Seções B, C, D, F)
    private $cnaePrefixosIndustrias = ['05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','35','36','37','38','39','41','42','43'];


    // #########################################################################################################
    // #########################################################################################################
    // EXIBE A LISTA DE CIDADES PARA UMA UF ESPECÍFICA.
    // TODO: IMPLEMENTAR A LÓGICA E A VIEW.
    public function porUf($uf)
    {
        $nomeEstado = $this->estadosBrasileiros[$uf];
        $ufUpper = strtoupper($uf); // Para as consultas no banco
        $ufLower = strtolower($uf);
        $preposicao = $this->preposicoesEstado[$uf] ?? 'de'; // (NOVO) Pega a preposição
        $nomeCapital = $this->capitais[$ufLower] ?? 'Capital';
        $nomeEstado = $this->estadosBrasileiros[$uf];


        // CHAVE DE CACHE PRINCIPAL PARA ESTE ESTADO
        $cacheKeyBase = "portal_estado_{$ufUpper}";

        // Datas para consultas parciais
        $hoje = Carbon::now()->toDateString(); // Ex: '2025-10-22'
        $inicioAno = Carbon::now()->startOfYear()->toDateString();

        // #########################################################################################################
        // --- KPIs DO ESTADO (SEPARADOS EM 5 CONSULTAS) ---
        // #########################################################################################################

        // 1. Total de Ativas
        $totalAtivas = Cache::remember("{$cacheKeyBase}_kpi_ativas", now()->addDay(), function () use ($ufUpper) {
            return Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->count();
        });

        // 2. Total de Matrizes
        $totalMatrizes = Cache::remember("{$cacheKeyBase}_kpi_matrizes", now()->addDay(), function () use ($ufUpper) {
            return Estabelecimento::where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->where('identificador_matriz_filial', 1)
                ->count();
        });

        // 3. Total de Filiais
        $totalFiliais = Cache::remember("{$cacheKeyBase}_kpi_filiais", now()->addDay(), function () use ($ufUpper) {
            return Estabelecimento::where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->where('identificador_matriz_filial', 2)
                ->count();
        });

        // 4. Abertas em 2025 (Parcial)
        $abertas2025Parcial = Cache::remember("{$cacheKeyBase}_kpi_abertas_2025", now()->addDay(), function () use ($ufUpper, $inicioAno, $hoje) {
            return Estabelecimento::where('uf', $ufUpper)
                ->whereBetween('data_inicio_atividade', [$inicioAno, $hoje])
                ->count();
        });

        // 5. Fechadas/Inativas em 2025 (Parcial)
        $fechadas2025Parcial = Cache::remember("{$cacheKeyBase}_kpi_fechadas_2025", now()->addDay(), function () use ($ufUpper, $inicioAno, $hoje) {
            return Estabelecimento::where('uf', $ufUpper)
                ->where('situacao_cadastral', '!=', 2) // Usando != 2 (Inativas)
                ->whereBetween('data_situacao_cadastral', [$inicioAno, $hoje])
                ->count();
        });
        
        // Monta o objeto $kpis que a view espera
        $kpis = (object) [
            'total_ativas' => $totalAtivas,
            'total_matrizes' => $totalMatrizes,
            'total_filiais' => $totalFiliais,
            'abertas_2025_parcial' => $abertas2025Parcial,
            'fechadas_2025_parcial' => $fechadas2025Parcial,
        ];
        // #######################################################################################################################################


        // #########################################################################################################
        // --- (NOVO) DADOS ESPECÍFICOS PARA O FAQ ---
        // #########################################################################################################
        $faqDados = Cache::remember("{$cacheKeyBase}_faq_dados", now()->addDay(), function () use ($ufUpper, $nomeCapital, $ufLower) {
            // Contagem de Supermercados (CNAE 4711-3/02)
            $totalSupermercados = Estabelecimento::where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->where(function ($query) {
                    $query->where('cnae_fiscal_principal', '4711302');
                })->count();

            // Contagem de Indústrias (Seções B, C, D, F)
            $totalIndustrias = Estabelecimento::where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->where(function ($query) {
                    foreach ($this->cnaePrefixosIndustrias as $prefixo) {
                        // Verifica se o CNAE principal OU secundário começa com o prefixo
                        $query->orWhere('cnae_fiscal_principal', 'LIKE', "{$prefixo}%")
                              ->orWhere('cnae_fiscal_secundaria', 'LIKE', "%{$prefixo}%");
                    }
                })->count();

            // Contagem de Empresas na Capital
            // Primeiro, busca o código do município da capital
            $municipioCapital = Municipio::where('descricao', $nomeCapital)
                                ->first();

            $totalCapital = 0;
            $codigoMunicipioCapital = null;
            if ($municipioCapital) {
                 $codigoMunicipioCapital = $municipioCapital->codigo;
                 $totalCapital = Estabelecimento::where('uf', $ufUpper)
                    ->where('situacao_cadastral', 2)
                    ->where('municipio', $codigoMunicipioCapital)
                    ->count();
            }

            return (object) [
                'totalSupermercados' => $totalSupermercados,
                'totalIndustrias' => $totalIndustrias,
                'totalCapital' => $totalCapital,
                'codigoMunicipioCapital' => $codigoMunicipioCapital, // Passa o código para gerar link no FAQ
                'slugCapital' => Str::slug($nomeCapital) // Passa o slug para gerar link no FAQ
            ];
        });


        // #########################################################################################################
        // --- TOP 10 CIDADES DESTE ESTADO ---
        // #########################################################################################################
        $top10Cidades = Cache::remember("{$cacheKeyBase}_top_10_cidades", now()->addDay(), function () use ($ufUpper, $uf) {
            $municipiosPopulares = Estabelecimento::select('municipio', DB::raw('count(*) as total'))
                ->where('uf', $ufUpper)
                ->where('situacao_cadastral', 2) // Apenas ativas
                ->groupBy('municipio')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get();
            // Busca os nomes
            $codigos = $municipiosPopulares->pluck('municipio');
            $municipiosNomes = Municipio::whereIn('codigo', $codigos)->pluck('descricao', 'codigo');
            // Combina os resultados
            // Agora a variável $uf (minúscula) está disponível aqui.
            return $municipiosPopulares->map(function ($item) use ($municipiosNomes, $uf) {
                $item->nome = $municipiosNomes[$item->municipio] ?? 'N/A';
                $item->municipio_slug = Str::slug($item->nome);
                $item->uf = $uf; // Esta linha agora funciona
                return $item;
            });
        });
        // #######################################################################################################################################



        // #######################################################################################################################################
        
        // --- BUSCA LISTA COMPLETA DE MUNICÍPIOS DESTE ESTADO (COM PAGINAÇÃO) ---
        $page = request()->get('page', 1);
        $cacheKey = "{$cacheKeyBase}_lista_municipios_otimizada2_page_{$page}";
        $listaMunicipios = Cache::remember($cacheKey, now()->addDay(), function () use ($ufUpper, $uf) {
            // SUBQUERY: total de empresas ativas por município
            $subquery = Estabelecimento::select('municipio', DB::raw('COUNT(*) AS total'))
                ->where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->groupBy('municipio');
            // JOIN DIRETO COM MUNICÍPIOS
            $municipiosPaginados = Municipio::query()
                ->joinSub($subquery, 'e', 'e.municipio', '=', 'municipios.codigo')
                ->select(
                    'municipios.codigo',
                    'municipios.descricao',
                    'e.total',
                    DB::raw("REPLACE(LOWER(municipios.descricao), ' ', '-') AS municipio_slug"),
                    DB::raw("'{$uf}' AS uf")
                )
                ->orderBy('municipios.descricao', 'asc')
                ->paginate(21);
            return $municipiosPaginados;
        });
        // #######################################################################################################################################
        // #######################################################################################################################################
        // --- BUSCA TOP 5 ATIVIDADES DESTE ESTADO ---
        
        $top5Atividades = Cache::remember("{$cacheKeyBase}_top_7_atividades_gptp", now()->addDay(), function () use ($ufUpper) {
            return Estabelecimento::join('cnaes as c', 'estabelecimentos.cnae_fiscal_principal', '=', 'c.codigo')
            ->select(
                'estabelecimentos.cnae_fiscal_principal as codigo',
                'c.descricao',
                DB::raw('COUNT(*) as total')
            )
            ->where('estabelecimentos.uf', $ufUpper)
            ->where('estabelecimentos.situacao_cadastral', 2)
            ->groupBy('estabelecimentos.cnae_fiscal_principal', 'c.descricao')
            ->orderByDesc('total')
            ->limit(7)
            ->get();
        });
        // #######################################################################################################################################
        // #######################################################################################################################################
        // --- BALANÇO ANUAL DOS ÚLTIMOS 5 ANOS PARA O ESTADO ---
        
        $balancoAnualEstado = Cache::remember("{$cacheKeyBase}_balanco_anualv2", now()->addDay(), function () use ($ufUpper) {
            $anoAtual = date('Y') - 1;
            $anos = range($anoAtual, $anoAtual - 3); 
            // 1️⃣ EMPRESAS ABERTAS POR ANO
            $abertas = Estabelecimento::select(
                    DB::raw('YEAR(data_inicio_atividade) as ano'),
                    DB::raw('COUNT(*) as total_abertas')
                )
                ->where('uf', $ufUpper)
                ->whereBetween('data_inicio_atividade', [min($anos) . '-01-01', max($anos) . '-12-31'])
                ->groupBy('ano')
                ->pluck('total_abertas', 'ano');
            // 2️⃣ EMPRESAS INATIVAS POR ANO
            $inativas = Estabelecimento::select(
                    DB::raw('YEAR(data_situacao_cadastral) as ano'),
                    DB::raw('COUNT(*) as total_inativas')
                )
                ->where('uf', $ufUpper)
                ->where('situacao_cadastral', '!=', 2)
                ->whereBetween('data_situacao_cadastral', [min($anos) . '-01-01', max($anos) . '-12-31'])
                ->groupBy('ano')
                ->pluck('total_inativas', 'ano');
            // 3️⃣ MONTA A COLEÇÃO FINAL (garantindo todas as chaves)
            return collect($anos)->mapWithKeys(function ($ano) use ($abertas, $inativas) {
                return [
                    $ano => [
                        'abertas'  => $abertas[$ano] ?? 0,
                        'inativas' => $inativas[$ano] ?? 0,
                    ],
                ];
            });
        });
        // #######################################################################################################################################
        // #######################################################################################################################################
        //  6 CEPS ALEATÓRIOS DE 6 MUNICÍPIOS ALEATÓRIOS (LÓGICA ATUALIZADA) ---
        $cepsAleatorios = Cache::remember("{$cacheKeyBase}_ceps_aleatorios", now()->addDay(), function () use ($ufUpper) {
            // 1. Pega 6 códigos de municípios aleatórios do estado
            $municipios = Estabelecimento::select('municipio')
                ->where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->distinct()
                ->inRandomOrder()
                ->limit(6)
                ->pluck('municipio');
            $dadosCeps = collect();
            // 2. Para cada município, busca 1 CEP aleatório e 5 empresas dele
            foreach ($municipios as $municipio) {
                // Pega 1 CEP aleatório desse município
                $cepAleatorio = Estabelecimento::select('cep')
                    ->where('uf', $ufUpper)
                    ->where('municipio', $municipio)
                    ->where('situacao_cadastral', 2)
                    ->whereNotNull('cep')->where('cep', '!=', '')
                    ->inRandomOrder()
                    ->first();
                if ($cepAleatorio) {
                    $cep = $cepAleatorio->cep;
                    // Pega 5 CNPJs desse CEP
                    $cnpjs = Estabelecimento::where('cep', $cep)
                        ->where('situacao_cadastral', 2)
                        ->where('uf', $ufUpper)
                        ->where('municipio', $municipio)
                        // Carrega a razão social da empresa relacionada
                        ->with('empresa:cnpj_basico,razao_social') 
                        ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv', 'cep') // Seleciona colunas necessárias
                        ->limit(5)
                        ->get();
                    
                    if ($cnpjs->isNotEmpty()) {
                        $dadosCeps->put($cep, $cnpjs);
                    }
                }
            }
            return $dadosCeps;
        });
        
        // #########################################################################################################
        // --- TOTAL DE MUNICÍPIOS ATIVOS ---
        // #########################################################################################################
        $totalMunicipiosAtivos = Cache::remember("{$cacheKeyBase}_total_municipios_ativos", now()->addDay(), function () use ($ufUpper) {
                return Estabelecimento::where('uf', $ufUpper)
                            ->where('situacao_cadastral', 2)
                            ->distinct('municipio')
                            ->count('municipio');
        });
        // #######################################################################################################################################
        // #######################################################################################################################################
        // ENVIA OS DADOS PARA A VIEW
        return view('pages.empresas.localizacao.estados.index', [
            'nomeEstado' => $nomeEstado,
            'preposicao' => $preposicao, 
            'uf' => $ufUpper,
            'kpis' => $kpis,
            'top10Cidades' => $top10Cidades,
            'listaMunicipios' => $listaMunicipios,
            'top5Atividades' => $top5Atividades, 
            'balancoAnualEstado' => $balancoAnualEstado, 
            'cepsAleatorios' => $cepsAleatorios,
            'totalMunicipiosAtivos' => $totalMunicipiosAtivos,
            'faqDados' => $faqDados, 
            'nomeCapital' => $nomeCapital, 
            'ufLower' => $ufLower,
        ]);
    }
    
    // #########################################################################################################
    // #########################################################################################################
    // LISTA DE EMPRESAS PARA UM MUNICÍPIO ESPECÍFICO.
    public function porMunicipio($uf, $municipio_slug)
    {
        $ufLower = strtolower($uf);
        $ufUpper = strtoupper($ufLower);
        $nomeEstado = $this->estadosBrasileiros[$ufLower];
        $municipio = Municipio::where('descricao', 'LIKE', str_replace('-', ' ', $municipio_slug))->first();
        $nomeMunicipio = $municipio->descricao;
        $codigoMunicipio = $municipio->codigo;
        $estabelecimentos = Estabelecimento::where('uf', $ufUpper)
            ->where('municipio', $codigoMunicipio)
            ->where('situacao_cadastral', 2) 
            ->with('empresa:cnpj_basico,razao_social,capital_social')
            ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv', 'cep')
            ->paginate(50); 
         $estabelecimentos->withPath(route('portal.por-municipio', ['uf' => $ufLower, 'municipio_slug' => $municipio_slug]));
        return view('pages.empresas.localizacao.municipios.index', [
            'nomeMunicipio' => $nomeMunicipio,
            'nomeEstado' => $nomeEstado,
            'uf' => $ufUpper,
            'estabelecimentos' => $estabelecimentos,
        ]);
    }
    // #########################################################################################################
    // #########################################################################################################
    // LISTA DE EMPRESAS PARA UM CEP ESPECÍFICO.
    // TODO: IMPLEMENTAR A LÓGICA E A VIEW.
    public function porCep($cep)
    {
        // 1. Validação básica e Limpeza do CEP (remove não numéricos)
        $cepLimpo = preg_replace('/[^0-9]/', '', $cep);
        // 2. Busca o primeiro estabelecimento ativo para pegar dados de localização (UF, Município)
        $primeiroEstabelecimento = Estabelecimento::where('cep', $cepLimpo)
            ->where('situacao_cadastral', 2)
            ->select('uf', 'municipio')
            ->first();

        $ufUpper = $primeiroEstabelecimento->uf;
        $ufLower = strtolower($ufUpper);
        $codigoMunicipio = $primeiroEstabelecimento->municipio;

        // Busca nomes do estado e município
        $nomeEstado = $this->estadosBrasileiros[$ufLower] ?? $ufUpper;
        $municipio = Municipio::find($codigoMunicipio);
        $nomeMunicipio = $municipio ? $municipio->descricao : 'Desconhecido';
        $municipioSlug = $municipio ? Str::slug($nomeMunicipio) : null;


        // 3. Busca as empresas ATIVAS neste CEP com paginação
        $estabelecimentos = Estabelecimento::where('cep', $cepLimpo)
            ->where('situacao_cadastral', 2) // Apenas Ativas
            ->with('empresa:cnpj_basico,razao_social,capital_social') // Eager load
            ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv', 'nome_fantasia', 'cep') // CEP incluído para o accessor funcionar
            ->orderBy('nome_fantasia', 'asc')
            ->paginate(50); // Pagina de 50 em 50

        // Ajusta o path da paginação
        $estabelecimentos->withPath(route('portal.por-cep', ['cep' => $cepLimpo]));

        // Formata o CEP para exibição
        $cepFormatado = $estabelecimentos->isNotEmpty() ? $estabelecimentos->first()->cep_formatado : $cep;


        // ENVIA OS DADOS PARA A VIEW
        return view('pages.empresas.localizacao.cep.index', [
            'cep' => $cepLimpo,
            'cepFormatado' => $cepFormatado,
            'nomeMunicipio' => $nomeMunicipio,
            'municipioSlug' => $municipioSlug, // Para link no breadcrumb
            'nomeEstado' => $nomeEstado,
            'uf' => $ufUpper, // Passa UF maiúscula para consistência
            'ufLower' => $ufLower, // Passa UF minúscula para links
            'estabelecimentos' => $estabelecimentos,
        ]);
    }
}

