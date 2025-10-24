<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CnpjController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CnaeController;
use App\Http\Controllers\LocalizacaoController;
use App\Http\Controllers\PortalController;

// --- ROTAS PRINCIPAIS DO SITE ---
Route::get('/', [PageController::class, 'home'])->name('home');                                                         // ROTA PÁGINA INICIAL
Route::get('/consultar-cnpj', [PageController::class, 'consultarCnpj'])->name('cnpj.index');                            // ROTA CONSULTAR CNPJ (EXIBIÇÃO DA PÁGINA)
Route::get('/consultar-cnae', [PageController::class, 'consultarCnae'])->name('cnae.index');                            // ROTA CONSULTAR CNAE (EXIBIÇÃO DA PÁGINA)
Route::get('/consultar-cep', [PageController::class, 'consultarCep'])->name('cep.index');                               // ROTA CONSULTAR CEP (EXIBIÇÃO DA PÁGINA)
Route::get('/nossos-servicos', [PageController::class, 'nossosServicos'])->name('nossosServicos');                      // ROTA NOSSOS SERVIÇOS
Route::get('/politica-de-privacidade', [PageController::class, 'politicaDePrivacidade'])->name('privacidade');          // ROTA POLÍTICA DE PRIVACIDADE
//########################################################################################################################
//########################################################################################################################
// --- ROTAS DE CONSULTA DE CNPJ ---
Route::post('/consultar-cnpj', [CnpjController::class, 'consultar'])->name('cnpj.consultar');                           // ROTA PARA PROCESSAR O FORMULÁRIO DE CONSULTA
Route::get('/cnpj/{cnpj}', [CnpjController::class, 'show'])->name('cnpj.show');                                         // ROTA PARA MOSTRAR A PÁGINA DO CNPJ
//########################################################################################################################
//########################################################################################################################
// --- ROTAS DE CONSULTA DE CNAE ---
Route::get('/api/cnae/search', [CnaeController::class, 'search'])->name('cnae.search');                                 // ROTA PARA PROCESSAR O FORMULÁRIO DE CONSULTA (TEMPO REAL)
Route::get('/cnae/{cnae}', [CnaeController::class, 'show'])->name('cnae.show');                                         // ROTA PARA MOSTRAR A PÁGINA DO CNAE
//########################################################################################################################
//########################################################################################################################
// --- ROTAS DO PORTAL DE EMPRESAS ---
Route::prefix('empresas')->name('portal.')->group(function () {
    Route::get('/', [PortalController::class, 'index'])->name('index');                                                 // ROTA PRINCIPAL DO PORTAL
    // HUBS DE LOCALIZAÇÃO
    Route::get('/cep/{cep}', [LocalizacaoController::class, 'porCep'])->name('por-cep');                                // CEP
    Route::get('/{uf}', [LocalizacaoController::class, 'porUf'])->name('por-uf');                                       // ESTADO (UF)
    Route::get('/{uf}/{municipio_slug}', [LocalizacaoController::class, 'porMunicipio'])->name('por-municipio');        // MUNICÍPIO
});