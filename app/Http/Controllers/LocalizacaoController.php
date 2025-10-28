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
    public function porUf($uf) // $uf chega minúsculo
    {
        $ufLower = strtolower($uf); 
        $ufUpper = strtoupper($uf); 
        
        // 1. Pega os dados estáticos da UF
        $nomeEstado = $this->estadosBrasileiros[$ufLower];
        $preposicao = $this->preposicoesEstado[$ufLower];
        $nomeCapital = $this->capitais[$ufLower];

        // 2. Define a chave de cache base
        $cacheKeyBase = "portal_estado_{$ufUpper}";
        
        // 3. Pega a página da requisição
        $page = request()->get('page', 1);

        // 4. Busca todos os dados do Cache usando Cache::get()
        
        // KPIs
        $totalAtivas = Cache::get("{$cacheKeyBase}_kpi_ativas");
        $totalMatrizes = Cache::get("{$cacheKeyBase}_kpi_matrizes");
        $totalFiliais = Cache::get("{$cacheKeyBase}_kpi_filiais");
        $abertas2025Parcial = Cache::get("{$cacheKeyBase}_kpi_abertas_2025");
        $fechadas2025Parcial = Cache::get("{$cacheKeyBase}_kpi_fechadas_2025");

        $kpis = (object) [
            'total_ativas' => $totalAtivas,
            'total_matrizes' => $totalMatrizes,
            'total_filiais' => $totalFiliais,
            'abertas_2025_parcial' => $abertas2025Parcial,
            'fechadas_2025_parcial' => $fechadas2025Parcial,
        ];
        
        // ##################################################
        // AJUSTE: Buscando o FAQ do cache
        // ##################################################
        $faqDados = Cache::get("{$cacheKeyBase}_faq_dados");
        
        // Outros blocos
        $top10Cidades = Cache::get("{$cacheKeyBase}_top_10_cidades");
        $top5Atividades = Cache::get("{$cacheKeyBase}_top_7_atividades_gptp");
        $balancoAnualEstado = Cache::get("{$cacheKeyBase}_balanco_anualv2");
        $cepsAleatorios = Cache::get("{$cacheKeyBase}_ceps_aleatorios");
        $totalMunicipiosAtivos = Cache::get("{$cacheKeyBase}_total_municipios_ativos");

        // O Bloco Paginado
        $cacheKeyPaginada = "{$cacheKeyBase}_lista_municipios_otimizada2_page_{$page}";
        $listaMunicipios = Cache::get($cacheKeyPaginada);

        // 5. Verifica se os dados essenciais existem
        if ($kpis->total_ativas === null || $listaMunicipios === null) {
            abort(404, "Página não encontrada no cache. Aguarde o processamento.");
        }
        
        // 6. ENVIA OS DADOS (LIDOS DO CACHE) PARA A VIEW
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
        $page = request()->get('page', 1);

        // Monta a mesma key usada pelo job
        $cacheKey = "municipio_{$ufLower}_{$municipio_slug}_page_{$page}";

        // Busca no cache
        $viewData = Cache::get($cacheKey);

        
        // Caso o cache ainda não exista (ex: job não rodou ou expirou)
        if (!$viewData) {
            // Busca o município pelo slug
            $municipio = \App\Models\Municipio::whereRaw('LOWER(REPLACE(descricao, " ", "-")) = ?', [$municipio_slug])->first();

            if (!$municipio) {
                abort(404, 'Município não encontrado');
            }

            // Descobre a UF real (garantindo consistência)
            $firstEstab = \App\Models\Estabelecimento::where('municipio', $municipio->codigo)->select('uf')->first();
            if (!$firstEstab) {
                abort(404, 'Nenhum estabelecimento encontrado para este município');
            }

            // Reaproveita a lógica do Job para montar dinamicamente (fallback)
            $ufUpper = $firstEstab->uf;
            $nomeEstado = [
                'ac'=>'Acre','al'=>'Alagoas','ap'=>'Amapá','am'=>'Amazonas','ba'=>'Bahia','ce'=>'Ceará','df'=>'Distrito Federal','es'=>'Espírito Santo',
                'go'=>'Goiás','ma'=>'Maranhão','mt'=>'Mato Grosso','ms'=>'Mato Grosso do Sul','mg'=>'Minas Gerais','pa'=>'Pará','pb'=>'Paraíba',
                'pr'=>'Paraná','pe'=>'Pernambuco','pi'=>'Piauí','rj'=>'Rio de Janeiro','rn'=>'Rio Grande do Norte','rs'=>'Rio Grande do Sul',
                'ro'=>'Rondônia','rr'=>'Roraima','sc'=>'Santa Catarina','sp'=>'São Paulo','se'=>'Sergipe','to'=>'Tocantins'
            ][$ufLower] ?? $ufUpper;

            $perPage = 50;
            $query = \App\Models\Estabelecimento::where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->where('municipio', $municipio->codigo)
                ->with('empresa:cnpj_basico,razao_social,capital_social')
                ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv', 'cep');

            $estabelecimentos = $query->paginate($perPage)->withPath(url("empresas/{$ufLower}/{$municipio_slug}"));

            $viewData = [
                'nomeMunicipio' => $municipio->descricao,
                'nomeEstado' => $nomeEstado,
                'uf' => $ufUpper,
                'estabelecimentos' => $estabelecimentos,
            ];

            // Armazena em cache para as próximas requisições
            Cache::put($cacheKey, $viewData, now()->addMonths(2));
        }

        // Renderiza normalmente
        return view('pages.empresas.localizacao.municipios.index', $viewData);
    }
    // #########################################################################################################
    // #########################################################################################################
    // LISTA DE EMPRESAS PARA UM CEP ESPECÍFICO.
    public function porCep($cep)
    {
        $cepLimpo = preg_replace('/[^0-9]/', '', $cep);
        $page = request()->get('page', 1);
        $cacheKey = "cep_{$cepLimpo}_page_{$page}";
        $viewData = Cache::get($cacheKey);
        $estabelecimentos = $viewData['estabelecimentos'];
        $cepFormatado = $viewData['cepFormatado'] ?? $cepLimpo;
        return view('pages.empresas.localizacao.cep.index', [
            'cep' => $cepLimpo,
            'cepFormatado' => $cepFormatado,
            'nomeMunicipio' => $viewData['nomeMunicipio'],
            'municipioSlug' => $viewData['municipioSlug'],
            'nomeEstado' => $viewData['nomeEstado'],
            'uf' => $viewData['uf'],
            'ufLower' => $viewData['ufLower'],
            'estabelecimentos' => $estabelecimentos,
        ]);
    }
}

