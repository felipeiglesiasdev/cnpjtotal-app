<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Estabelecimento;
use App\Models\Municipio;
use App\Models\Cnae;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator; // Importar

class CacheUfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3600; // 1 hora (SP é pesado)
    protected $ufUpper;

    // ##################################################
    // MAPAS COPIADOS DO CONTROLLER (Necessários para o Job)
    // ##################################################
    private $estadosBrasileiros = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
        'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
        'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
        'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
    ];
    private $capitais = [
        'AC' => 'Rio Branco', 'AL' => 'Maceió', 'AP' => 'Macapá', 'AM' => 'Manaus',
        'BA' => 'Salvador', 'CE' => 'Fortaleza', 'DF' => 'Brasília', 'ES' => 'Vitória',
        'GO' => 'Goiânia', 'MA' => 'São Luís', 'MT' => 'Cuiabá', 'MS' => 'Campo Grande',
        'MG' => 'Belo Horizonte', 'PA' => 'Belém', 'PB' => 'João Pessoa', 'PR' => 'Curitiba',
        'PE' => 'Recife', 'PI' => 'Teresina', 'RJ' => 'Rio de Janeiro', 'RN' => 'Natal',
        'RS' => 'Porto Alegre', 'RO' => 'Porto Velho', 'RR' => 'Boa Vista', 'SC' => 'Florianópolis',
        'SP' => 'São Paulo', 'SE' => 'Aracaju', 'TO' => 'Palmas'
    ];
    private $cnaePrefixosIndustrias = ['05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','35','36','37','38','39','41','42','43'];
    // ##################################################


    /**
     * Construtor
     */
    public function __construct($ufUpper)
    {
        $this->ufUpper = $ufUpper;
    }

    /**
     * Executa o job.
     */
    public function handle(): void
    {
        $ufUpper = $this->ufUpper;
        $ufLower = strtolower($ufUpper); 
        
        $cacheKeyBase = "portal_estado_{$ufUpper}";
        $cacheDuration = now()->addMonths(2); 
        $nomeCapital = $this->capitais[$ufUpper] ?? 'Capital';

        // Datas
        $hoje = Carbon::now()->toDateString();
        $inicioAno = Carbon::now()->startOfYear()->toDateString();
        
        // Limpa caches antigos (caso o paginador mude)
        // Opcional, mas recomendado antes de um loop de páginas
        $page = 1;
        while (Cache::has("{$cacheKeyBase}_lista_municipios_otimizada2_page_{$page}")) {
            Cache::forget("{$cacheKeyBase}_lista_municipios_otimizada2_page_{$page}");
            $page++;
        }

        // 1. CACHE KPIs (5 chaves)
        $kpiAtivas = Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->count();
        Cache::put("{$cacheKeyBase}_kpi_ativas", $kpiAtivas, $cacheDuration);

        $kpiMatrizes = Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->where('identificador_matriz_filial', 1)->count();
        Cache::put("{$cacheKeyBase}_kpi_matrizes", $kpiMatrizes, $cacheDuration);

        $kpiFiliais = Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->where('identificador_matriz_filial', 2)->count();
        Cache::put("{$cacheKeyBase}_kpi_filiais", $kpiFiliais, $cacheDuration);

        $kpiAbertasAno = Estabelecimento::where('uf', $ufUpper)->whereBetween('data_inicio_atividade', [$inicioAno, $hoje])->count();
        Cache::put("{$cacheKeyBase}_kpi_abertas_2025", $kpiAbertasAno, $cacheDuration); // Mantendo sua chave original

        $kpiFechadasAno = Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', '!=', 2)->whereBetween('data_situacao_cadastral', [$inicioAno, $hoje])->count();
        Cache::put("{$cacheKeyBase}_kpi_fechadas_2025", $kpiFechadasAno, $cacheDuration); // Mantendo sua chave original
        
        // 2. CACHE FAQ 
        $totalSupermercados = Estabelecimento::where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->where('cnae_fiscal_principal', '4711302') // CNAE Exato
            ->count();
            
        $totalIndustrias = Estabelecimento::where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->where(function ($query) {
                foreach ($this->cnaePrefixosIndustrias as $prefixo) {
                    $query->orWhere('cnae_fiscal_principal', 'LIKE', "{$prefixo}%")
                          ->orWhere('cnae_fiscal_secundaria', 'LIKE', "%{$prefixo}%");
                }
            })->count();
            
        $municipioCapital = Municipio::where('descricao', $nomeCapital)->first();
        $totalCapital = 0;
        $codigoMunicipioCapital = null;
        if ($municipioCapital) {
             $codigoMunicipioCapital = $municipioCapital->codigo;
             $totalCapital = Estabelecimento::where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->where('municipio', $codigoMunicipioCapital)
                ->count();
        }
        $faqDados = (object) [
            'totalSupermercados' => $totalSupermercados,
            'totalIndustrias' => $totalIndustrias,
            'totalCapital' => $totalCapital,
            'codigoMunicipioCapital' => $codigoMunicipioCapital,
            'slugCapital' => Str::slug($nomeCapital)
        ];
        Cache::put("{$cacheKeyBase}_faq_dados", $faqDados, $cacheDuration);

        // 3. CACHE TOP 10 CIDADES
        $municipiosPopulares = Estabelecimento::select('municipio', DB::raw('count(*) as total'))
            ->where('uf', $ufUpper)->where('situacao_cadastral', 2)
            ->groupBy('municipio')->orderBy('total', 'desc')->limit(10)->get();
        $codigos = $municipiosPopulares->pluck('municipio');
        $municipiosNomes = Municipio::whereIn('codigo', $codigos)->pluck('descricao', 'codigo');
        $top10Cidades = $municipiosPopulares->map(function ($item) use ($municipiosNomes, $ufLower) {
            $item->nome = $municipiosNomes[$item->municipio] ?? 'N/A';
            $item->municipio_slug = Str::slug($item->nome);
            $item->uf = $ufLower; // Passa UF minúscula para o link
            return $item;
        });
        Cache::put("{$cacheKeyBase}_top_10_cidades", $top10Cidades, $cacheDuration);

        // 4. CACHE TOP 7 ATIVIDADES
        $topAtividades = Estabelecimento::join('cnaes as c', 'estabelecimentos.cnae_fiscal_principal', '=', 'c.codigo')
            ->select('estabelecimentos.cnae_fiscal_principal as codigo', 'c.descricao', DB::raw('COUNT(*) as total'))
            ->where('estabelecimentos.uf', $ufUpper)->where('estabelecimentos.situacao_cadastral', 2)
            ->groupBy('estabelecimentos.cnae_fiscal_principal', 'c.descricao')->orderByDesc('total')->limit(7)->get();
        Cache::put("{$cacheKeyBase}_top_7_atividades_gptp", $topAtividades, $cacheDuration); 

        // 5. CACHE BALANÇO ANUAL
        $anoAtual = date('Y') - 1;
        $anos = range($anoAtual, $anoAtual - 3); 
        $abertas = Estabelecimento::select(DB::raw('YEAR(data_inicio_atividade) as ano'), DB::raw('COUNT(*) as total_abertas'))
            ->where('uf', $ufUpper)->whereBetween('data_inicio_atividade', [min($anos) . '-01-01', max($anos) . '-12-31'])
            ->groupBy('ano')->pluck('total_abertas', 'ano');
        $inativas = Estabelecimento::select(DB::raw('YEAR(data_situacao_cadastral) as ano'), DB::raw('COUNT(*) as total_inativas'))
            ->where('uf', $ufUpper)->where('situacao_cadastral', '!=', 2)->whereBetween('data_situacao_cadastral', [min($anos) . '-01-01', max($anos) . '-12-31'])
            ->groupBy('ano')->pluck('total_inativas', 'ano');
        $balancoAnualEstado = collect($anos)->mapWithKeys(function ($ano) use ($abertas, $inativas) {
            return [$ano => ['abertas'  => $abertas[$ano] ?? 0, 'inativas' => $inativas[$ano] ?? 0]];
        });
        Cache::put("{$cacheKeyBase}_balanco_anualv2", $balancoAnualEstado, $cacheDuration);

        // 6. CACHE CEPS ALEATÓRIOS
        $municipiosRand = Estabelecimento::select('municipio')->where('uf', $ufUpper)->where('situacao_cadastral', 2)
            ->distinct()->inRandomOrder()->limit(6)->pluck('municipio');
        $dadosCeps = collect();
        foreach ($municipiosRand as $municipio) {
            $cepAleatorio = Estabelecimento::select('cep')
                ->where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->where('municipio', $municipio)
                ->inRandomOrder()->first();
            if ($cepAleatorio) {
                $cep = $cepAleatorio->cep;
                $cnpjs = Estabelecimento::where('uf', $ufUpper)
                    ->where('situacao_cadastral', 2)
                    ->where('municipio', $municipio)
                    ->where('cep', $cep)
                    ->with('empresa:cnpj_basico,razao_social')->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv', 'cep')->limit(5)->get();
                if ($cnpjs->isNotEmpty()) {
                    $dadosCeps->put($cep, $cnpjs);
                }
            }
        }
        Cache::put("{$cacheKeyBase}_ceps_aleatorios", $dadosCeps, $cacheDuration);

        // 7. CACHE TOTAL MUNICÍPIOS ATIVOS
        $totalMunicipiosAtivos = Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->distinct('municipio')->count('municipio');
        Cache::put("{$cacheKeyBase}_total_municipios_ativos", $totalMunicipiosAtivos, $cacheDuration);
        
        // 8. CACHE LISTA DE MUNICÍPIOS (PAGINADO)
        $subquery = Estabelecimento::select('municipio', DB::raw('COUNT(*) AS total'))
            ->where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->groupBy('municipio');
            
        $totalMunicipios = Municipio::query()
            ->joinSub($subquery, 'e', 'e.municipio', '=', 'municipios.codigo')
            ->count();
        
        if ($totalMunicipios > 0) {
            $totalPagesToCache = ceil($totalMunicipios / 21); // 21 por página
            
            for ($page = 1; $page <= $totalPagesToCache; $page++) {
                $cacheKey = "{$cacheKeyBase}_lista_municipios_otimizada2_page_{$page}";
                
                $municipiosPaginados = Municipio::query()
                    ->joinSub($subquery, 'e', 'e.municipio', '=', 'municipios.codigo')
                    ->select(
                        'municipios.codigo',
                        'municipios.descricao',
                        'e.total',
                        DB::raw("REPLACE(LOWER(municipios.descricao), ' ', '-') AS municipio_slug"),
                        DB::raw("'{$ufLower}' AS uf") 
                    )
                    ->orderBy('municipios.descricao', 'asc')
                    ->paginate(21, ['*'], 'page', $page); 

                // Define o path (lendo do .env)
                $municipiosPaginados->withPath(url("empresas/{$ufLower}"));

                Cache::put($cacheKey, $municipiosPaginados, $cacheDuration);
            }
        }
    }
}