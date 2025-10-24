<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\Models\Estabelecimento;

class CachePortalStatsAbertasJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;
    protected $cacheKey = 'portal_stats_abertas_por_ano_t1';
    protected $cacheDuration = 2880;

    public function handle(): void
    {
        $anos = ['2024', '2023', '2022'];
        $dados = collect();
        foreach($anos as $ano) {
            $total = Estabelecimento::whereBetween('data_inicio_atividade', ["{$ano}-01-01", "{$ano}-12-31"])->count();
            $dados->put($ano, $total);
        }
        
        Cache::put($this->cacheKey, $dados, now()->addMinutes($this->cacheDuration));
    }
}
