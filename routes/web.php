<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CnpjController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RemocaoController;

// Rota para a página inicial
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Rota para a página de Política de Privacidade
Route::get('/politica-de-privacidade', function () {
    return view('pages.privacy-policy');
})->name('privacy.policy');

// Rota para a página com o formulário de consulta de CNPJ
Route::get('/consultar-cnpj', [CnpjController::class, 'index'])->name('cnpj.index');

// Rota para processar o formulário de consulta de CNPJ
Route::post('/consultar-cnpj', [CnpjController::class, 'consultar'])->name('cnpj.consultar');

// Rota para exibir os detalhes de um CNPJ
Route::get('/cnpj/{cnpj}', [CnpjController::class, 'show'])->name('cnpj.show');

// Rotas para Solicitação de Remoção
Route::get('/solicitar-remocao/{cnpj}', [PageController::class, 'solicitarRemocao'])->name('remocao.form');
Route::post('/solicitar-remocao', [RemocaoController::class, 'store'])->name('remocao.store');
Route::get('/remocao-solicitada', [PageController::class, 'remocaoSuccess'])->name('remocao.success');