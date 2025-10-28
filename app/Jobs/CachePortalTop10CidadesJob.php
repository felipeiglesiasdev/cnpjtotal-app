<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Estabelecimento;
use App\Models\Municipio;

class CachePortalTop10CidadesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;
    public $tries = 1;
    protected $cacheKey = 'portal_top_10_cidades_t1';

    public function handle(): void
    {
        // CONSULTA COM ELOQUENT + JOIN OTIMIZADO
        $dados = Estabelecimento::join('municipios', 'estabelecimentos.municipio', '=', 'municipios.codigo')
            ->select(
                'municipios.descricao as nome',
                'estabelecimentos.uf',
                DB::raw('COUNT(*) as total')
            )
            ->where('estabelecimentos.situacao_cadastral', 2)
            ->groupBy('estabelecimentos.municipio', 'estabelecimentos.uf', 'municipios.descricao')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'nome' => $item->nome,
                    'uf' => $item->uf,
                    'total' => (int) $item->total,
                    'municipio_slug' => Str::slug($item->nome),
                ];
            });

        // CACHE POR 2 MESES (525600 minutos = 1 ano, 2 meses = 87600)
        Cache::put($this->cacheKey, $dados, now()->addMinutes(87600));

    }
}