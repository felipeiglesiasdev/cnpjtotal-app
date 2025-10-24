<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Estabelecimento;

class CachePortalFechamentosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;
    protected $cacheKey = 'portal_estados_mais_fechamentos_2024_t1';
    protected $cacheDuration = 2880;

    public function handle(): void
    {
        $dados = Estabelecimento::select('uf', DB::raw('count(*) as total'))
            ->where('situacao_cadastral', '!=', 2)
            ->whereBetween('data_situacao_cadastral', ['2024-01-01', '2024-12-31'])
            ->groupBy('uf')
            ->orderBy('total', 'desc')
            ->limit(3)
            ->get();
        
        Cache::put($this->cacheKey, $dados, now()->addMinutes($this->cacheDuration));
    }
}
