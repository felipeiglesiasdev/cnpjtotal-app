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
        $cidadeSlug = Str::slug($municipio->descricao);

        // Primeiro estabelecimento para identificar UF
        $firstEstab = Estabelecimento::where('municipio', $municipio->codigo)
            ->select('uf')
            ->first();

        if (!$firstEstab) return;

        $ufUpper = $firstEstab->uf;
        $ufLower = strtolower($ufUpper);
        $nomeEstado = $this->estadosBrasileiros[$ufLower] ?? $ufUpper;

        // Total de empresas ativas
        $totalAtivas = Estabelecimento::where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->where('municipio', $municipio->codigo)
            ->count();

        if ($totalAtivas === 0) return;

        $perPage = 50;
        $totalPages = ceil($totalAtivas / $perPage);
        $cacheDuration = now()->addMonths(2);

        for ($page = 1; $page <= $totalPages; $page++) {
            $cacheKey = "municipio_{$ufLower}_{$cidadeSlug}_page_{$page}";

            // Salva cache apenas se ainda não existir
            if (!Cache::has($cacheKey)) {

                // Busca só os registros dessa página
                $items = Estabelecimento::where('uf', $ufUpper)
                    ->where('situacao_cadastral', 2)
                    ->where('municipio', $municipio->codigo)
                    ->with('empresa:cnpj_basico,razao_social,capital_social')
                    ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv', 'cep')
                    ->forPage($page, $perPage)
                    ->get();

                // Cria um Paginator igualzinho ao Laravel
                $paginator = new LengthAwarePaginator(
                    $items,
                    $totalAtivas,
                    $perPage,
                    $page,
                    ['path' => url("empresas/{$ufLower}/{$cidadeSlug}")]
                );

                // View espera essas variáveis
                $viewData = [
                    'nomeMunicipio' => $municipio->descricao,
                    'nomeEstado' => $nomeEstado,
                    'uf' => $ufUpper,
                    'estabelecimentos' => $paginator,
                ];

                Cache::put($cacheKey, $viewData, $cacheDuration);
            }
        }
    }
}