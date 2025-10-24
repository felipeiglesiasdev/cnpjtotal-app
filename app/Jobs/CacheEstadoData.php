<?php

namespace App\Jobs;

use App\Services\EstadoCacheService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheEstadoData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $ufSigla;
    protected int $cacheDuration; // Tempo de cache em segundos (ex: 3 meses)

    /**
     * Create a new job instance.
     * @param string $ufSigla Sigla do estado em minúsculo (ex: 'mg')
     * @param int $cacheDuration Tempo de cache em segundos (default 90 dias)
     */
    public function __construct(string $ufSigla, int $cacheDuration = 7776000) // 90 dias * 24 horas * 60 min * 60 seg
    {
        $this->ufSigla = $ufSigla;
        $this->cacheDuration = $cacheDuration;
    }

    /**
     * Execute the job.
     */
    public function handle(EstadoCacheService $estadoCacheService): void
    {
        Log::info("Iniciando job de cache para o estado: " . strtoupper($this->ufSigla));

        try {
            $dados = $estadoCacheService->buscarDadosEstado($this->ufSigla);

            if ($dados) {
                $cacheKeyBase = "portal_estado_" . strtoupper($this->ufSigla);

                // Armazena todos os dados exceto a lista paginada
                $dadosPrincipais = collect($dados)->except(['listaMunicipiosPage1'])->all();
                Cache::put("{$cacheKeyBase}_principal", $dadosPrincipais, $this->cacheDuration);

                // Armazena a primeira página da lista de municípios separadamente
                if (isset($dados['listaMunicipiosPage1'])) {
                     Cache::put("{$cacheKeyBase}_lista_municipios_paginada_page_1", $dados['listaMunicipiosPage1'], $this->cacheDuration);
                }

                 Log::info("Cache gerado com sucesso para o estado: " . strtoupper($this->ufSigla));
            } else {
                 Log::warning("Não foi possível gerar cache para UF inválida: " . $this->ufSigla);
            }

        } catch (\Exception $e) {
            Log::error("Erro ao gerar cache para o estado {$this->ufSigla}: " . $e->getMessage());
            // Opcional: relançar a exceção para o job tentar novamente se configurado
            // throw $e;
        }
    }
}
