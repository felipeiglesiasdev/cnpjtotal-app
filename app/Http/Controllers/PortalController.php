<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Estabelecimento;
use App\Models\Cnae;
use App\Models\Municipio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str; 
use Carbon\Carbon;

class PortalController extends Controller
{
    // EXIBE A PÁGINA PRINCIPAL DO PORTAL DE ANÁLISE. (ROTA --> /empresas)
    public function index()
    {
        // BUSCA AS 10 CIDADES COM MAIS EMPRESAS ATIVAS (LÊ DO CACHE).
        $top10Cidades = Cache::get('portal_top_10_cidades', collect());
        // BUSCA OS 10 ESTADOS COM MAIS EMPRESAS ATIVAS (LÊ DO CACHE).
        $top10Estados = Cache::get('portal_top_10_estados', collect());
        // BUSCA OS 3 ESTADOS QUE MAIS FECHARAM EMPRESAS NO ANO DE 2024 (LÊ DO CACHE).
        $estadosMaisFechamentos = Cache::get('portal_estados_mais_fechamentos', collect());
        // BUSCA AS 10 ATIVIDADES ECONÔMICAS MAIS COMUNS (LÊ DO CACHE).
        $top10Atividades = Cache::get('top_10_atividades', collect());
        // ESTATÍSTICAS DE EMPRESAS ABERTAS (ANO A ANO) (LÊ DO CACHE).
        $statsAbertas = Cache::get('portal_stats_abertas_por_ano', collect());
        // ESTATÍSTICAS DE EMPRESAS FECHADAS (ANO A ANO) (LÊ DO CACHE).
        $statsFechadas = Cache::get('portal_stats_fechadas_por_ano', collect());
        // RETORNA A VIEW PRINCIPAL DO PORTAL, PASSANDO TODOS OS DADOS.
        return view('pages.empresas.index', [
            'top10Cidades' => $top10Cidades,
            'top10Estados' => $top10Estados,
            'estadosMaisFechamentos' => $estadosMaisFechamentos,
            'top10Atividades' => $top10Atividades,
            'statsAbertas' => $statsAbertas,
            'statsFechadas' => $statsFechadas,
        ]);
    }

}

