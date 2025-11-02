<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Estabelecimento; // Seu Eloquent Model
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GenerateSitemapCommand extends Command
{
    /**
     * A assinatura do comando.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * A descrição do comando.
     *
     * @var string
     */
    protected $description = 'Gera sitemaps (XML manual) em /public/sitemaps e /public/sitemap_index.xml';

    /**
     * Executa o comando.
     */
    public function handle()
    {
        $this->info('Iniciando geração otimizada dos Sitemaps...');
        Log::info('[Sitemap] Iniciando geração otimizada...');

        $chunkSize = 30000;
        $totalLimit = 1500000;
        $baseUrl = 'https://www.consultarcnpjgratis.com';
        $sitemapIndexLastMod = Carbon::now()->toDateString();
        $urlLastMod = '2025-10-28';
        $urlChangeFreq = 'monthly';
        $urlPriority = '0.5';
        $sitemapsDir = public_path('sitemaps');

        if (!File::isDirectory($sitemapsDir)) {
            File::makeDirectory($sitemapsDir, 0755, true);
        }

        $page = 1;
        $sitemapIndexUrls = [];

        try {
            DB::connection('mysql_dados')
                ->table('estabelecimentos')
                ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv')
                ->where('uf', 'MG')
                ->where('situacao_cadastral', 2)
                ->where('identificador_matriz_filial', 1)
                ->orderBy('cnpj_basico')
                ->limit($totalLimit)
                ->chunk($chunkSize, function ($rows) use (
                    &$page, 
                    &$sitemapIndexUrls, 
                    $baseUrl, 
                    $sitemapIndexLastMod, 
                    $urlLastMod, 
                    $urlChangeFreq, 
                    $urlPriority
                ) {
                    $this->info("Gerando sitemap {$page}...");

                    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
                    $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

                    foreach ($rows as $r) {
                        $cnpj = $r->cnpj_basico . $r->cnpj_ordem . $r->cnpj_dv;
                        $loc = "{$baseUrl}/cnpj/{$cnpj}";
                        $xml .= "  <url>\n";
                        $xml .= "    <loc>" . htmlspecialchars($loc) . "</loc>\n";
                        $xml .= "    <lastmod>{$urlLastMod}</lastmod>\n";
                        $xml .= "    <changefreq>{$urlChangeFreq}</changefreq>\n";
                        $xml .= "    <priority>{$urlPriority}</priority>\n";
                        $xml .= "  </url>\n";
                    }

                    $xml .= "</urlset>";

                    $filename = "cnpjs_{$page}.xml";
                    File::put(public_path("sitemaps/{$filename}"), $xml);

                    $sitemapIndexUrls[] = "{$baseUrl}/sitemaps/{$filename}";
                    $page++;


                });

            // --- sitemap_index.xml ---
            $indexXml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
            $indexXml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

            foreach ($sitemapIndexUrls as $url) {
                $indexXml .= "  <sitemap>\n";
                $indexXml .= "    <loc>" . htmlspecialchars($url) . "</loc>\n";
                $indexXml .= "    <lastmod>{$sitemapIndexLastMod}</lastmod>\n";
                $indexXml .= "  </sitemap>\n";
            }

            $indexXml .= "</sitemapindex>";
            File::put(public_path('sitemap_index.xml'), $indexXml);

            $this->info('✅ Sitemaps gerados com sucesso!');
            $this->comment('Arquivo principal: ' . $baseUrl . '/sitemap_index.xml');
        } catch (\Throwable $e) {
            Log::error('[Sitemap] Erro: ' . $e->getMessage());
            $this->error('Erro: ' . $e->getMessage());
        }
    }
}