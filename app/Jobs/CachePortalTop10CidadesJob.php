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

    public $timeout = 600; // 10 minutos de timeout para o job
    protected $cacheKey = 'portal_top_10_cidades_t3';
    protected $cacheDuration = 2880; // 48 horas (em minutos)

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        // LÓGICA MOVIDA DO CONTROLLER PARA CÁ
        $topCidadesResult = Estabelecimento::with('municipioRel')
            ->where('situacao_cadastral', 2)
            ->select('municipio', 'uf', DB::raw('count(*) as total'))
            ->groupBy('municipio', 'uf')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        $dados = $topCidadesResult->map(function ($item) {
            $nome = $item->municipioRel->descricao ?? 'Não encontrado';
            return (object) [
                'nome' => $nome,
                'uf' => $item->uf,
                'total' => $item->total,
                'municipio_slug' => Str::slug($nome),
            ];
        });

        Cache::put($this->cacheKey, $dados, now()->addMinutes($this->cacheDuration));
    }
}
