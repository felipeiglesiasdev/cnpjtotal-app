<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Municipio;
use App\Models\Estabelecimento;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator; // Importar o Paginator

class CacheMunicipioJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1800; // 30 minutos
    public $municipio; // <-- Propriedade para guardar o objeto

    // Mapa de estados (necessário para o job)
    public $estadosBrasileiros = [
        'ac' => 'Acre', 'al' => 'Alagoas', 'ap' => 'Amapá', 'am' => 'Amazonas',
        'ba' => 'Bahia', 'ce' => 'Ceará', 'df' => 'Distrito Federal', 'es' => 'Espírito Santo',
        'go' => 'Goiás', 'ma' => 'Maranhão', 'mt' => 'Mato Grosso', 'ms' => 'Mato Grosso do Sul',
        'mg' => 'Minas Gerais', 'pa' => 'Pará', 'pb' => 'Paraíba', 'pr' => 'Paraná',
        'pe' => 'Pernambuco', 'pi' => 'Piauí', 'rj' => 'Rio de Janeiro', 'rn' => 'Rio Grande do Norte',
        'rs' => 'Rio Grande do Sul', 'ro' => 'Rondônia', 'rr' => 'Roraima', 'sc' => 'Santa Catarina',
        'sp' => 'São Paulo', 'se' => 'Sergipe', 'to' => 'Tocantins'
    ];


    public function __construct(Municipio $municipio)
    {
        $this->municipio = $municipio;
    }

    public function handle(): void
    {
        
        $municipio = $this->municipio;
        $cidade_slug = Str::slug($municipio->descricao);
        
        // 1. Pega o primeiro estabelecimento para descobrir a UF
        $firstEstabelecimento = Estabelecimento::where('municipio', $municipio->codigo)->select('uf')->first();
        if (!$firstEstabelecimento) return;

        
        $ufUpper = $firstEstabelecimento->uf;
        $ufLower = strtolower($ufUpper);
        $nomeEstado = $this->estadosBrasileiros[$ufLower];

        // 2. Conta o total de empresas ATIVAS (como você pediu)
        $totalEmpresasAtivas = Estabelecimento::where('uf', $ufUpper)
            ->where('municipio', $municipio->codigo)
            ->where('situacao_cadastral', '2') 
            ->count();


        if ($totalEmpresasAtivas === 0) return;

        $totalParaPaginator = $totalEmpresasAtivas;
        $totalPagesToCache = ceil($totalParaPaginator / 50);
        $cacheDuration = now()->addMonths(2); 

        // 3. Loop para cachear CADA PÁGINA
        for ($page = 1; $page <= $totalPagesToCache; $page++) {
            
            $cacheKey = "municipio_{$ufLower}_{$cidade_slug}_page_{$page}";

            // Usamos Cache::remember para ser mais robusto a falhas no meio
            $viewData = Cache::remember($cacheKey, $cacheDuration, function () use ($ufUpper, $nomeEstado, $municipio, $page, $totalParaPaginator, $ufLower, $cidade_slug) {

                // Busca SOMENTE os 50 itens desta página
                $itemsForThisPage = Estabelecimento::where('uf', $ufUpper)
                    ->where('municipio', $municipio->codigo)
                    ->where('situacao_cadastral', 2)
                    ->with('empresa:cnpj_basico,razao_social,capital_social') 
                    ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv', 'cep')
                    ->forPage($page, 50) 
                    ->get();

                // Cria manualmente o objeto Paginator
                $estabelecimentosPaginados = new LengthAwarePaginator(
                    $itemsForThisPage,
                    $totalParaPaginator, // Total real
                    50, // Itens por página
                    $page, // Página atual
                    // Garante que a URL base está correta (lendo do .env)
                    ['path' => url("empresas/{$ufLower}/{$cidade_slug}")] 
                );

                // Monta o array de dados a ser cacheado
                return [
                    'nomeMunicipio' => $municipio->descricao,
                    'nomeEstado' => $nomeEstado,
                    'uf' => $ufUpper,
                    'estabelecimentos' => $estabelecimentosPaginados,
                ];
            });
        } // Fim do loop de páginas
    }
}