<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Estabelecimento;
use App\Jobs\CacheCepJob;

class CacheCepsDataCommand extends Command
{
    /**
     * Nome e assinatura do comando Artisan.
     */
    protected $signature = 'cache:ceps';

    /**
     * Descrição do comando.
     */
    protected $description = 'Dispara jobs para cachear múltiplas páginas de todos os CEPs com empresas ativas, iterando por UF.';

    /**
     * Lista das UFs brasileiras.
     */
    private $ufs = [
            'AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO',
            'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR',
            'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO'
        ];

    /**
     * Executa o comando.
     */
    public function handle()
    {
        $this->info('🔍 Iniciando varredura de CEPs por UF...');
        $totalJobsDisparados = 0;

        $ufBar = $this->output->createProgressBar(count($this->ufs));
        $ufBar->start();

        foreach ($this->ufs as $ufUpper) {
            $this->newLine();
            $this->info("➡️  Processando UF: {$ufUpper}");

            $countJobsUf = 0;

            // Consulta Eloquent otimizada
            Estabelecimento::query()
                ->select('cep')
                ->where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->whereNotNull('cep')
                ->distinct()
                ->orderBy('cep')
                ->chunk(2000, function ($rows) use (&$countJobsUf, &$totalJobsDisparados) {

                    $ceps = $rows->pluck('cep')->filter()->unique()->values()->toArray();

                    if (!empty($ceps)) {
                        CacheCepJob::dispatch($ceps);

                        $countJobsUf++;
                        $totalJobsDisparados++;
                    }
                });

            $ufBar->advance();
            $this->line(" ✅ UF {$ufUpper}: {$countJobsUf} jobs enviados.");
        }

        $ufBar->finish();
        $this->newLine(2);
        $this->info("🎉 Concluído! {$totalJobsDisparados} jobs (em blocos) foram enviados para a fila 'default'.");
    }
}
