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
use App\Models\Cnae;

class CachePortalTop10AtividadesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;
    protected $cacheKey = 'top_10_atividades_t1';
    protected $cacheDuration = 2880;

    public function handle(): void
    {
        $atividades = Estabelecimento::select('cnae_fiscal_principal', DB::raw('count(*) as total'))
            ->where('situacao_cadastral', 2)
            ->groupBy('cnae_fiscal_principal')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
        
        $cnaeIds = $atividades->pluck('cnae_fiscal_principal');
        $cnaes = Cnae::whereIn('codigo', $cnaeIds)->get()->keyBy('codigo');
        
        $dados = $atividades->map(function($atividade) use ($cnaes) {
            $cnae = $cnaes->get($atividade->cnae_fiscal_principal);
            if ($cnae) {
                $atividade->descricao = $cnae->descricao;
                $atividade->codigo = $cnae->codigo;
            }
            return $atividade;
        })->filter();

        Cache::put($this->cacheKey, $dados, now()->addMinutes($this->cacheDuration));
    }
}
