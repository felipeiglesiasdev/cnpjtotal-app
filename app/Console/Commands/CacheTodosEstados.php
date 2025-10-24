<?php

namespace App\Console\Commands;

use App\Jobs\CacheEstadoData;
use Illuminate\Console\Command;

class CacheTodosEstados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:estados {--queue=default} {--ttl=7776000}'; // ttl em segundos (90 dias)

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispara jobs para cachear os dados das páginas de todos os 27 estados.';

    // Array com todas as UFs
    private $ufs = [
        'ac', 'al', 'ap'
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $queueName = $this->option('queue');
        $cacheTtl = (int) $this->option('ttl');

        $this->info("Disparando jobs para cachear dados dos estados na fila '{$queueName}' com TTL de {$cacheTtl} segundos...");

        $bar = $this->output->createProgressBar(count($this->ufs));
        $bar->start();

        foreach ($this->ufs as $uf) {
            CacheEstadoData::dispatch($uf, $cacheTtl)->onQueue($queueName);
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nTodos os jobs foram disparados com sucesso!");

        return Command::SUCCESS;
    }
}
