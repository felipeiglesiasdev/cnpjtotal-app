<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CacheUfJob;
use Illuminate\Support\Facades\Log;

class CacheUfsDataCommand extends Command
{
    protected $signature = 'cache:ufs';
    protected $description = 'Gera o cache completo para todas as UFs brasileiras.';
    public function handle()
    {
        $ufs = [
            'AC', 'AL', 'AM'
        ];

        $this->info('Iniciando cacheamento completo das UFs...');
        Log::info('🔄 [CacheUfsDataCommand] Iniciando cacheamento completo das UFs...');

        foreach ($ufs as $uf) {
            dispatch(new CacheUfJob($uf));
            $this->info("⏳ Cache agendado para UF: {$uf}");
            Log::info("📦 CacheUfJob disparado para UF: {$uf}");
        }

        $this->info('✅ Todos os jobs foram disparados!');
        Log::info('✅ [CacheUfsDataCommand] Todos os jobs foram disparados.');
    }
}
