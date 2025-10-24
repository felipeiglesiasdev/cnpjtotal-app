<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\Estabelecimento;
use App\Models\Municipio;
use App\Models\Empresa;
use App\Models\NaturezaJuridica; // Adicionado
use Carbon\Carbon;

class EstadoCacheService
{
    private $estadosBrasileiros = [
        'ac' => 'Acre', 'al' => 'Alagoas', 'ap' => 'Amapá', 'am' => 'Amazonas',
        'ba' => 'Bahia', 'ce' => 'Ceará', 'df' => 'Distrito Federal', 'es' => 'Espírito Santo',
        'go' => 'Goiás', 'ma' => 'Maranhão', 'mt' => 'Mato Grosso', 'ms' => 'Mato Grosso do Sul',
        'mg' => 'Minas Gerais', 'pa' => 'Pará', 'pb' => 'Paraíba', 'pr' => 'Paraná',
        'pe' => 'Pernambuco', 'pi' => 'Piauí', 'rj' => 'Rio de Janeiro', 'rn' => 'Rio Grande do Norte',
        'rs' => 'Rio Grande do Sul', 'ro' => 'Rondônia', 'rr' => 'Roraima', 'sc' => 'Santa Catarina',
        'sp' => 'São Paulo', 'se' => 'Sergipe', 'to' => 'Tocantins'
    ];
    private $preposicoesEstado = [
        'ac' => 'do', 'al' => 'de', 'ap' => 'do', 'am' => 'do',
        'ba' => 'da', 'ce' => 'do', 'df' => 'do', 'es' => 'do',
        'go' => 'de', 'ma' => 'do', 'mt' => 'de', 'ms' => 'de',
        'mg' => 'de', 'pa' => 'do', 'pb' => 'da', 'pr' => 'do',
        'pe' => 'de', 'pi' => 'do', 'rj' => 'do', 'rn' => 'do',
        'rs' => 'do', 'ro' => 'de', 'rr' => 'de', 'sc' => 'de',
        'sp' => 'de', 'se' => 'de', 'to' => 'de'
    ];
    public function buscarDadosEstado(string $ufSigla): ?array
    {
        $ufSigla = strtolower($ufSigla);
        $nomeEstado = $this->estadosBrasileiros[$ufSigla];
        $ufUpper = strtoupper($ufSigla);
        $preposicao = $this->preposicoesEstado[$ufSigla] ?? 'de';
        $hoje = Carbon::now()->toDateString();
        $inicioAno = '2025-01-01'; // Início do ano corrente

        // --- KPIs ---
        //$kpis = $this->buscarKpis($ufUpper, $inicioAno, $hoje);

        // --- Top 10 Cidades ---
        $top10Cidades = $this->buscarTop10Cidades($ufUpper, $ufSigla);

        // --- Top 5 Atividades ---555
        $top5Atividades = $this->buscarTop5Atividades($ufUpper);

        // --- Balanço Anual 5 Anos ---
        $balancoAnualEstado = $this->buscarBalancoAnual($ufUpper);

        // --- CEPs Aleatórios ---555
        $cepsAleatorios = $this->buscarCepsAleatorios($ufUpper);

        // --- Top 5 Naturezas Jurídicas ---
        $top5NaturezasJuridicasEstado = $this->buscarTop5NaturezasJuridicas($ufUpper);

        // --- Total de Municípios Ativos ---
        //$totalMunicipiosAtivos = $this->contarMunicipiosAtivos($ufUpper);

        // --- Lista de Municípios (primeira página, para cache inicial) ---
        // A paginação real será tratada no controller ao buscar do cache
        //$listaMunicipiosPage1 = $this->buscarListaMunicipiosPaginada($ufUpper, $ufSigla, 1);

        return [
            //'nomeEstado' => $nomeEstado,
            //'preposicao' => $preposicao,
            //'uf' => $ufUpper, // Mantém maiúsculo para consistência, se necessário
            //'uf_lower' => $ufSigla, // Adiciona minúsculo para rotas
            //'kpis' => $kpis,
            'top10Cidades' => $top10Cidades,
            'top5Atividades' => $top5Atividades,
            'balancoAnualEstado' => $balancoAnualEstado,
            'cepsAleatorios' => $cepsAleatorios,
            'top5NaturezasJuridicasEstado' => $top5NaturezasJuridicasEstado,
            //'totalMunicipiosAtivos' => $totalMunicipiosAtivos,
            //'listaMunicipiosPage1' => $listaMunicipiosPage1,
        ];
    }

    // Métodos privados para cada busca (lógica extraída do controller original)

    // BUSCAR KIPS CORRETO, FALTA VERIFICAR ÍNDICES NO BD!!
    private function buscarKpis($ufUpper, $inicioAno, $hoje) {
         return Estabelecimento::query()
            ->where('uf', $ufUpper)
            ->selectRaw("
                SUM(situacao_cadastral = 2) AS total_ativas,
                SUM(situacao_cadastral = 2 AND identificador_matriz_filial = 1) AS total_matrizes,
                SUM(situacao_cadastral = 2 AND identificador_matriz_filial = 2) AS total_filiais,
                SUM(data_inicio_atividade BETWEEN ? AND ?) AS abertas_2025_parcial,
                SUM(situacao_cadastral != 2 AND data_situacao_cadastral BETWEEN ? AND ?) AS fechadas_2025_parcial
            ", [$inicioAno, $hoje, $inicioAno, $hoje])
            ->first();
    }

    // Busca uma página específica de municípios (para o Job e para o Controller)
    public function buscarListaMunicipiosPaginada($ufUpper, $ufLower, $page = 1) {
        $subquery = Estabelecimento::select('municipio', DB::raw('COUNT(*) AS total'))
            ->where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->groupBy('municipio');

        $municipiosPaginados = Municipio::query()
            ->joinSub($subquery, 'e', 'e.municipio', '=', 'municipios.codigo')
            ->select(
                'municipios.codigo',
                'municipios.descricao',
                'e.total',
                DB::raw("REPLACE(LOWER(municipios.descricao), ' ', '-') AS municipio_slug"),
                DB::raw("'{$ufLower}' AS uf") // Usa UF minúscula para rotas
            )
            ->orderBy('municipios.descricao', 'asc')
            ->paginate(21); 
        return $municipiosPaginados;
    }
    // #######################################################################################################################################
    // #######################################################################################################################################
    // BUSCAR TOP 10 CIDADES CORRETO 
    private function buscarTop10Cidades($ufUpper, $ufLower) {
         $municipiosPopulares = Estabelecimento::select('municipio', DB::raw('count(*) as total'))
            ->where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->groupBy('municipio')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
        $codigos = $municipiosPopulares->pluck('municipio');
        $municipiosNomes = Municipio::whereIn('codigo', $codigos)->pluck('descricao', 'codigo');
        return $municipiosPopulares->map(function ($item) use ($municipiosNomes, $ufLower) {
            $item->nome = $municipiosNomes[$item->municipio] ?? 'N/A';
            $item->municipio_slug = Str::slug($item->nome);
            $item->uf = $ufLower; // Usa UF minúscula para rota
            return $item;
        });
    }
    // #######################################################################################################################################
    // #######################################################################################################################################
    // MÉTODO CORRETO E 100% OTIMIZADO - NÃO MEXER!!
    private function buscarTop5Atividades($ufUpper) {
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
    }
    // #######################################################################################################################################
    // #######################################################################################################################################
    // MÉTODO CORRETO E 100% OTIMIZADO - NÃO MEXER!!
    private function buscarBalancoAnual($ufUpper) {
        $anoAtual = date('Y') -1; // Começa do ano anterior completo
        $anos = range($anoAtual, $anoAtual - 4); // Pega 5 anos

        $abertas = Estabelecimento::select(
                DB::raw('YEAR(data_inicio_atividade) as ano'),
                DB::raw('COUNT(*) as total_abertas')
            )
            ->where('uf', $ufUpper)
            ->whereBetween('data_inicio_atividade', [min($anos) . '-01-01', max($anos) . '-12-31'])
            ->groupBy('ano')
            ->pluck('total_abertas', 'ano');

        $inativas = Estabelecimento::select(
                DB::raw('YEAR(data_situacao_cadastral) as ano'),
                DB::raw('COUNT(*) as total_inativas')
            )
            ->where('uf', $ufUpper)
            ->where('situacao_cadastral', '!=', 2) // Que não esteja ATIVA
            ->whereBetween('data_situacao_cadastral', [min($anos) . '-01-01', max($anos) . '-12-31'])
            ->groupBy('ano')
            ->pluck('total_inativas', 'ano');

        return collect($anos)->mapWithKeys(function ($ano) use ($abertas, $inativas) {
            return [
                $ano => [
                    'abertas'  => $abertas[$ano] ?? 0,
                    'inativas' => $inativas[$ano] ?? 0,
                ],
            ];
        });
    }
    // #######################################################################################################################################
    // #######################################################################################################################################
    // MÉTODO CORRETO E 100% OTIMIZADO - NÃO MEXER!!
    private function buscarCepsAleatorios($ufUpper) {
        $municipios = Estabelecimento::select('municipio')
            ->where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->distinct()
            ->inRandomOrder()
            ->limit(6) // Busca 6 municípios
            ->pluck('municipio');
        $dadosCeps = collect();
        foreach ($municipios as $municipio) {
            $cepAleatorio = Estabelecimento::select('cep')
                ->where('uf', $ufUpper)
                ->where('municipio', $municipio)
                ->where('situacao_cadastral', 2)
                ->whereNotNull('cep')->where('cep', '!=', '')
                ->inRandomOrder()
                ->first();
            if ($cepAleatorio) {
                $cep = $cepAleatorio->cep;
                $cnpjs = Estabelecimento::where('cep', $cep)
                    ->where('situacao_cadastral', 2)
                    ->where('uf', $ufUpper)
                    ->where('municipio', $municipio) 
                    ->with('empresa:cnpj_basico,razao_social')
                    ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv', 'cep')
                    ->limit(5)
                    ->get();
                if ($cnpjs->isNotEmpty()) {
                    $dadosCeps->put($cep,  $cnpjs);
                }
            }
        }
        return $dadosCeps;
    }
    // #######################################################################################################################################
    // #######################################################################################################################################
    // MÉTODO CORRETO E 100% OTIMIZADO - NÃO MEXER!!
    private function buscarTop5NaturezasJuridicas($ufUpper) {
        return Empresa::join('naturezas_juridicas AS nj' , 'empresas.natureza_juridica', '=', 'nj.codigo')
            ->whereIn('empresas.cnpj_basico', function($query) use ($ufUpper) {
                $query->select('cnpj_basico')
                    ->from('estabelecimentos')
                    ->where('uf', $ufUpper)
                    ->where('situacao_cadastral', 2);
            })
            ->select('nj.descricao', DB::raw('COUNT(*) AS total'))
            ->groupBy('nj.codigo', 'nj.descricao')
            ->orderByDesc('total')
            ->limit(1)
            ->get();
    }
    // #######################################################################################################################################
    // #######################################################################################################################################
    // MÉTODO CORRETO E 100% OTIMIZADO - NÃO MEXER!!
    private function contarMunicipiosAtivos($ufUpper) {
         return Estabelecimento::where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->distinct('municipio')
            ->count('municipio');
    }

    
}
