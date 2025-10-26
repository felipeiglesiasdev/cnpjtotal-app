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
use Illuminate\Pagination\LengthAwarePaginator;

class CacheCepJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1200; // 20 minutos
    protected $ceps; // <-- agora é um array de CEPs

    private $estadosBrasileiros = [
        'ac' => 'Acre', 'al' => 'Alagoas', 'ap' => 'Amapá', 'am' => 'Amazonas',
        'ba' => 'Bahia', 'ce' => 'Ceará', 'df' => 'Distrito Federal', 'es' => 'Espírito Santo',
        'go' => 'Goiás', 'ma' => 'Maranhão', 'mt' => 'Mato Grosso', 'ms' => 'Mato Grosso do Sul',
        'mg' => 'Minas Gerais', 'pa' => 'Pará', 'pb' => 'Paraíba', 'pr' => 'Paraná',
        'pe' => 'Pernambuco', 'pi' => 'Piauí', 'rj' => 'Rio de Janeiro', 'rn' => 'Rio Grande do Norte',
        'rs' => 'Rio Grande do Sul', 'ro' => 'Rondônia', 'rr' => 'Roraima', 'sc' => 'Santa Catarina',
        'sp' => 'São Paulo', 'se' => 'Sergipe', 'to' => 'Tocantins'
    ];

    /**
     * @param array|string $ceps - Pode receber um único CEP ou um array
     */
    public function __construct($ceps)
    {
        // Garante que seja sempre array
        $this->ceps = is_array($ceps) ? $ceps : [$ceps];
    }

    /**
     * Executa o job.
     */
    public function handle(): void
    {
        foreach ($this->ceps as $cep) {
            $cepLimpo = preg_replace('/[^0-9]/', '', $cep);

            if (empty($cepLimpo)) {
                continue;
            }

            // 1️⃣ Busca o primeiro estabelecimento ativo para metadados
            $primeiro = Estabelecimento::where('cep', $cepLimpo)
                ->where('situacao_cadastral', 2)
                ->select('uf', 'municipio')
                ->first();

            if (!$primeiro) {
                continue;
            }

            $ufUpper = $primeiro->uf;
            $ufLower = strtolower($ufUpper);
            $codigoMunicipio = $primeiro->municipio;

            $nomeEstado = $this->estadosBrasileiros[$ufLower] ?? $ufUpper;
            $municipio = Municipio::find($codigoMunicipio);
            $nomeMunicipio = $municipio?->descricao ?? 'Desconhecido';
            $municipioSlug = $municipio ? Str::slug($nomeMunicipio) : null;
            $cepFormatado = substr($cepLimpo, 0, 5) . '-' . substr($cepLimpo, 5, 3);

            // 2️⃣ Conta empresas ativas
            $totalAtivos = Estabelecimento::where('cep', $cepLimpo)
                ->where('uf', $ufUpper)
                ->where('municipio', $codigoMunicipio)
                ->where('situacao_cadastral', 2)
                ->count();

            if ($totalAtivos === 0) {
                continue;
            }

            // 3️⃣ Paginação simulada e cacheamento
            $totalPages = ceil($totalAtivos / 50);
            $cacheDuration = now()->addDays(7);

            for ($page = 1; $page <= $totalPages; $page++) {
                $cacheKey = "cep_{$cepLimpo}_page_{$page}";

                Cache::remember($cacheKey, $cacheDuration, function () use (
                    $cepLimpo,
                    $ufUpper,
                    $ufLower,
                    $nomeEstado,
                    $nomeMunicipio,
                    $codigoMunicipio,
                    $municipioSlug,
                    $cepFormatado,
                    $page,
                    $totalAtivos
                ) {
                    $items = Estabelecimento::where('cep', $cepLimpo)
                        ->where('uf', $ufUpper)
                        ->where('municipio', $codigoMunicipio)
                        ->where('situacao_cadastral', 2)
                        ->with('empresa:cnpj_basico,razao_social,capital_social')
                        ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv', 'cep')
                        ->forPage($page, 50)
                        ->get();

                    return [
                        'cep' => $cepLimpo,
                        'cepFormatado' => $cepFormatado,
                        'nomeMunicipio' => $nomeMunicipio,
                        'municipioSlug' => $municipioSlug,
                        'nomeEstado' => $nomeEstado,
                        'uf' => $ufUpper,
                        'ufLower' => $ufLower,
                        'estabelecimentos' => new LengthAwarePaginator(
                            $items,
                            $totalAtivos,
                            50,
                            $page,
                            ['path' => url("cep/{$cepLimpo}")]
                        ),
                    ];
                });
            }
        }
    }
}
