<?php

namespace App\Http\Controllers;

use App\Models\Cnae;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Gera o sitemap para todas as páginas de CNAE.
     */
    public function cnaes(): Response
    {
        $cnaes = Cnae::all();

        return response()
            ->view('sitemap.cnaes', ['cnaes' => $cnaes])
            ->header('Content-Type', 'text/xml');
    }
}
