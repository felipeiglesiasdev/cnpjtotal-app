@extends('layouts.app')

@section('title', 'Consultar CNPJ Grátis — Rápido e Completo')

@section('content')

{{-- Seção Principal com o Formulário de Busca --}}
<section class="hero-section-cnpj">
    <div class="container">
        <h1 class="hero-title">Ferramenta de Consulta de CNPJ Grátis</h1>
        <p class="hero-subtitle">Obtenha informações completas de qualquer empresa no Brasil, diretamente da Receita Federal.</p>

        <form class="search-form" action="{{ route('cnpj.consultar') }}" method="POST">
            @csrf
            <div class="input-group">
                <i class="bi bi-search input-icon"></i>
                <input 
                    type="tel" 
                    name="cnpj" 
                    id="cnpj-input" 
                    class="search-input" 
                    placeholder="00.000.000/0000-00"
                    title="Por favor, digite 14 números.">
            </div>
            <button type="submit" class="btn btn-primary search-button">Consultar</button>
        </form>
        <div id="error-popup" class="error-popup">
            <div class="popup-content">
                <span class="popup-close" id="popup-close">&times;</span>
                
                {{-- O conteúdo aqui dentro será preenchido pelo JavaScript --}}
                <div class="popup-icon" id="popup-icon"></div>
                <h4 id="popup-title"></h4>
                <p id="popup-message"></p>
                
                <button id="popup-confirm" class="btn btn-primary popup-confirm-btn">Entendido</button>
            </div>
        </div>
    </div>
</section>


{{-- Seção de Vantagens/Recursos --}}
<section class="features-section">
    <div class="container">
        <h2 class="section-title">Uma ferramenta completa para suas necessidades</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="bi bi-shield-check"></i>
                <h3>Dados Confiáveis</h3>
                <p>Informações atualizadas e sincronizadas diretamente com a base de dados da Receita Federal.</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-speedometer2"></i>
                <h3>Consulta Rápida</h3>
                <p>Nossa interface otimizada garante que você obtenha os dados que precisa em questão de segundos.</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-phone-vibrate"></i>
                <h3>100% Responsivo</h3>
                <p>Acesse de qualquer dispositivo, seja desktop, tablet ou smartphone, com a mesma experiência.</p>
            </div>
        </div>
    </div>
</section>

{{-- Seção de Perguntas Frequentes (FAQ) --}}
<section class="faq-section">
    <div class="container">
        <h2 class="section-title">Perguntas Frequentes</h2>
        <div class="faq-container">
            <details class="faq-item">
                <summary>A consulta de CNPJ é realmente gratuita?</summary>
                <p>Sim, nossa consulta básica é e sempre será gratuita. Oferecemos todos os dados cadastrais públicos da empresa sem nenhum custo.</p>
            </details>
            <details class="faq-item">
                <summary>De onde vêm os dados exibidos?</summary>
                <p>Todos os dados são obtidos publicamente e em tempo real da base de dados da Receita Federal do Brasil, garantindo a precisão e a confiabilidade das informações.</p>
            </details>
            <details class="faq-item">
                <summary>Posso consultar um CNPJ que foi baixado (inativo)?</summary>
                <p>Sim, nossa ferramenta exibe a situação cadastral atual da empresa, seja ela 'ATIVA' ou 'BAIXADA'. Você pode consultar qualquer CNPJ que já tenha existido.</p>
            </details>
        </div>
    </div>
</section>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(session('error'))
        // Verifica se a função global 'showPopup' existe (criada no app.js)
        if (typeof window.showPopup === 'function') {
            // CHAMA O POPUP DE ERRO DE BACK-END
            window.showPopup(
                'bi-emoji-frown', // Ícone de carinha triste
                'CNPJ não encontrado',
                'Lamentamos, mas não encontramos este CNPJ em nossa base de dados. Por favor, verifique o número e tente novamente.',
                false // não é um erro crítico, é um aviso
            );
        }
    @endif
});
</script>
@endpush

@endsection