<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CacheMunicipioJob; // O Job que vamos usar
use App\Models\Municipio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CacheMunicipiosDataCommand extends Command
{

    protected $signature = 'cache:municipios';
    protected $description = 'Dispara jobs para cachear MÚLTIPLAS PÁGINAS de TODOS os municípios, iterando pela tabela de Municípios.';
    public function handle()
    {
        $this->info('Buscando TODOS os municípios que possuem estabelecimentos...');
        //$todosMunicipios = Municipio::has('estabelecimentos')->get();
        $todosMunicipios = Municipio::where('codigo', 4733)->get();
        $this->info("Encontrados " . $todosMunicipios->count() . " municípios. Disparando jobs...");
        $bar = $this->output->createProgressBar($todosMunicipios->count());
        $bar->start();
        $count = 0;
        foreach ($todosMunicipios as $municipio) {
            CacheMunicipioJob::dispatch($municipio); 
            $count++;
            $bar->advance();
        }
        $bar->finish();
        $this->info("\nConcluído! {$count} jobs para pré-cachear municípios foram enviados para a fila 'default'.");
    }
}