<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan; // Importar Facade Artisan

class CacheAllDataCommand extends Command
{

    protected $signature = 'cache:all'; // Comando único e fácil de lembrar
    protected $description = 'Executa todos os comandos de pré-cache do sistema (Portal, UFs, Municípios, CEPs).';

    public function handle()
    {
        $this->info('Iniciando processo completo de pré-cache...');

        $this->line(''); // Linha em branco para espaçamento
        $this->info('1/4 - Cacheando dados do Portal...');
        Artisan::call('cache:portal'); // Chama o comando existente
        $this->info(Artisan::output()); // Mostra a saída do comando chamado

        $this->line('');
        $this->info('2/4 - Cacheando dados das UFs (Estados)...');
        Artisan::call('cache:ufs'); // Chama o comando existente
        $this->info(Artisan::output());

        $this->line('');
        $this->info('3/4 - Cacheando dados dos Municípios...');
        Artisan::call('cache:municipios'); // Chama o comando existente
        $this->info(Artisan::output());


        $this->line('');
        $this->info('Processo completo de pré-cache concluído!');
        $this->warn('Certifique-se de que os workers da fila (`php artisan queue:work`) estejam rodando para processar os jobs disparados.');
    }
}
