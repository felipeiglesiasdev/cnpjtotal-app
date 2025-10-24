<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
class PageController extends Controller
{
    // PÁGINA INICIAL
    public function home() { return view('pages.home'); }
    // PÁGINA DE CONSULTAR CNPJ
    public function consultarCnpj() { return view('pages.consultar-cnpj'); }
    // PÁGINA DE CONSULTAR CNAE
    public function consultarCnae() { return view('pages.consultar-cnae'); }
    // PÁGINA DE CONSULTAR CEP
    public function consultarCep() { return view('pages.consultar-cep'); }
    // PÁGINA DE SERVIÇOS
    public function nossosServicos() { return view('pages.nossos-servicos'); }
    // PÁGINA DE POLÍTICA DE PRIVACIDADE
    public function politicaDePrivacidade() { return view('pages.politica-de-privacidade'); }
}


