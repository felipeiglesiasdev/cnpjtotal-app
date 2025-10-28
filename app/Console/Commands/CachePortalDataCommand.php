<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CachePortalTop10CidadesJob;
use App\Jobs\CachePortalTop10EstadosJob;
use App\Jobs\CachePortalFechamentosJob;
use App\Jobs\CachePortalTop10AtividadesJob;
use App\Jobs\CachePortalStatsAbertasJob;
use App\Jobs\CachePortalStatsFechadasJob;

class CachePortalDataCommand extends Command
{
    protected $signature = 'cache:portal';
    protected $description = 'Dispara todos os jobs para cachear os dados da página principal do portal de empresas.';

    public function handle()
    {
        $this->info('Disparando jobs de cache para o Portal...');

        CachePortalTop10CidadesJob::dispatch();
        //CachePortalTop10EstadosJob::dispatch();
        //CachePortalFechamentosJob::dispatch();
        //CachePortalTop10AtividadesJob::dispatch();
        //CachePortalStatsAbertasJob::dispatch();
        //CachePortalStatsFechadasJob::dispatch();

        $this->info('Todos os 6 jobs foram enviados para a fila.');
    }
}