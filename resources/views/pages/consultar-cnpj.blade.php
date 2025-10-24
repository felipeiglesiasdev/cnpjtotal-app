@extends('layouts.app')

@section('title', 'Consulta de CNPJ Grátis — Rápido e Completo')

@push('seo_tags')
    <meta name="description" content="Utilize nossa ferramenta gratuita para consultar informações completas de qualquer empresa no Brasil, diretamente da Receita Federal. Rápido, seguro e sempre atualizado.">
    {{-- Outras meta tags relevantes podem ser adicionadas aqui --}}
@endpush

@section('content')
{{-- Seção Hero com Formulário --}}
<section class="relative bg-white pt-32 pb-16 md:pt-40 md:pb-24 overflow-hidden">
    {{-- Elementos sutis de fundo --}}
    <div class="absolute inset-0 z-0">
         <div class="absolute -top-20 -left-20 w-80 h-80 bg-red-50/50 rounded-full filter blur-3xl opacity-60"></div>
         <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-gray-100/60 rounded-full filter blur-3xl opacity-70"></div>
    </div>

    <div class="relative container mx-auto px-4 z-10">
        <div class="max-w-3xl mx-auto text-center">
            <span class="text-sm font-semibold text-[#ed1c24] uppercase tracking-wider mb-2 inline-block">Consulta Gratuita e Ilimitada</span>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-5 tracking-tight leading-tight">
                Consulte qualquer CNPJ <br class="hidden sm:inline"> Instantaneamente
            </h1>
            <p class="text-lg text-gray-700 mb-10 max-w-xl mx-auto font-light">
                Acesse dados cadastrais completos, situação, QSA, CNAEs e mais. Informações públicas da Receita Federal na palma da sua mão.
            </p>

            <form class="max-w-xl mx-auto" action="{{ route('cnpj.consultar') }}" method="POST" novalidate>
                @csrf
                <div class="relative flex flex-col sm:flex-row items-center gap-3 bg-white p-2 rounded-full shadow-lg border border-gray-200">
                    <div class="relative w-full">
                       <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none z-10">
                           <i class="bi bi-search text-gray-400 text-lg"></i>
                       </div>
                        <input
                            type="tel"
                            name="cnpj"
                            id="cnpj-input"
                            class="w-full text-lg pl-14 pr-4 py-4 border-none rounded-full focus:ring-2 focus:ring-[#ed1c24]/50 focus:outline-none placeholder-gray-500"
                            placeholder="Digite o CNPJ"
                            required>
                    </div>
                    {{-- Botão Padronizado --}}
                    <button type="submit"
                            class="cursor-pointer w-full sm:w-auto flex-shrink-0 bg-[#171717] text-white font-medium py-4 px-8 rounded-full text-base hover:bg-[#ed1c24] transition-all duration-300 ease-out hover:-translate-y-px transform relative z-10">
                        <span>Consultar Agora</span>
                        <i class="bi bi-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-gray-500 text-xs flex items-center justify-center gap-4">
                <span><i class="bi bi-shield-check-fill text-green-600 mr-1"></i> Dados Públicos Oficiais</span>
                <span><i class="bi bi-clock-fill text-blue-600 mr-1"></i> Consulta Rápida</span>
                <span><i class="bi bi-infinity text-purple-600 mr-1"></i> 100% Gratuito</span>
            </div>
        </div>
    </div>
</section>

{{-- Seção de Vantagens/Recursos (Padrão Home Consultas) --}}
<section class="py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        {{-- Grid de Cards de Consulta --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">

            {{-- Card 1: Dados Completos --}}
            <div class="group relative bg-white border border-gray-200 rounded-xl shadow-lg pt-20 pb-10 px-8 text-center transition-all duration-300 hover:shadow-2xl hover:border-gray-300 hover:-translate-y-2">
                <div class="absolute -top-6 left-8">
                    <div class="inline-block bg-[#ed1c24] p-4 rounded-full shadow-lg transition-transform duration-300 group-hover:scale-110">
                        <i class="bi bi-database-check text-2xl text-white block"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-3 mt-4">Dados Abrangentes</h3>
                <p class="text-gray-700 text-base mb-8 font-light leading-relaxed">
                    Acesse QSA, CNAEs (principal e secundários), situação, capital social, endereço, contato e mais.
                </p>
            </div>

            {{-- Card 2: Interface Intuitiva --}}
            <div class="group relative bg-white border border-gray-200 rounded-xl shadow-lg pt-20 pb-10 px-8 text-center transition-all duration-300 hover:shadow-2xl hover:border-gray-300 hover:-translate-y-2">
                 <div class="absolute -top-6 left-8">
                    <div class="inline-block bg-[#ed1c24] p-4 rounded-full shadow-lg transition-transform duration-300 group-hover:scale-110">
                        <i class="bi bi-lightbulb text-2xl text-white block"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-3 mt-4">Simples de Usar</h3>
                <p class="text-gray-700 text-base mb-8 font-light leading-relaxed">
                    Design limpo e organizado para você encontrar a informação que precisa sem distrações.
                </p>
            </div>

            {{-- Card 3: Sempre Gratuito --}}
            <div class="group relative bg-white border border-gray-200 rounded-xl shadow-lg pt-20 pb-10 px-8 text-center transition-all duration-300 hover:shadow-2xl hover:border-gray-300 hover:-translate-y-2">
                 <div class="absolute -top-6 left-8">
                    <div class="inline-block bg-[#ed1c24] p-4 rounded-full shadow-lg transition-transform duration-300 group-hover:scale-110">
                        <i class="bi bi-infinity text-2xl text-white block"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-3 mt-4">Gratuito e Ilimitado</h3>
                <p class="text-gray-700 text-base mb-8 font-light leading-relaxed">
                    Consulte quantos CNPJs precisar, sem custos ou limites. A informação pública deve ser acessível.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- Seção de Perguntas Frequentes (FAQ) (Padrão Estado) --}}
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            {{-- Card principal com padding padronizado --}}
            <div x-data="{ openFaq: 1 }" class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8">
                {{-- Cabeçalho Padrão --}}
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
                        <i class="bi bi-patch-question-fill text-2xl text-[#ed1c24]"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Perguntas Frequentes</h2>
                        <p class="text-sm text-gray-500">Tire suas dúvidas sobre a consulta de CNPJ.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    {{-- Pergunta 1 --}}
                    <div class="border-b border-gray-200 pb-4 group">
                        <button @click="openFaq = (openFaq === 1 ? null : 1)" class="flex justify-between items-center w-full text-left cursor-pointer">
                            <span class="font-semibold text-gray-800 text-base md:text-lg group-hover:text-[#ed1c24] transition-colors duration-200">De onde vêm os dados da consulta?</span>
                            <i class="bi" :class="openFaq === 1 ? 'bi-chevron-up text-red-600' : 'bi-chevron-down text-gray-500'"></i>
                        </button>
                        <div x-show="openFaq === 1" x-collapse class="mt-3 text-gray-600 text-sm leading-relaxed">
                            <p>Todas as informações exibidas são dados públicos oficiais, disponibilizados pela <strong class="font-medium">Receita Federal do Brasil</strong>. Nosso papel é organizar e apresentar esses dados de forma clara e acessível.</p>
                        </div>
                    </div>

                    {{-- Pergunta 2 --}}
                    <div class="border-b border-gray-200 pb-4 group">
                        <button @click="openFaq = (openFaq === 2 ? null : 2)" class="flex justify-between items-center w-full text-left cursor-pointer">
                            <span class="font-semibold text-gray-800 text-base md:text-lg group-hover:text-[#ed1c24] transition-colors duration-200">A consulta é realmente gratuita?</span>
                            <i class="bi" :class="openFaq === 2 ? 'bi-chevron-up text-red-600' : 'bi-chevron-down text-gray-500'"></i>
                        </button>
                        <div x-show="openFaq === 2" x-collapse class="mt-3 text-gray-600 text-sm leading-relaxed">
                            <p>Sim, a consulta básica de informações cadastrais do CNPJ em nosso site é <strong class="font-medium">100% gratuita e ilimitada</strong>. Acreditamos no livre acesso à informação pública.</p>
                        </div>
                    </div>

                    {{-- Pergunta 3 --}}
                     <div class="border-b border-gray-200 pb-4 group">
                        <button @click="openFaq = (openFaq === 3 ? null : 3)" class="flex justify-between items-center w-full text-left cursor-pointer">
                            <span class="font-semibold text-gray-800 text-base md:text-lg group-hover:text-[#ed1c24] transition-colors duration-200">Com que frequência os dados são atualizados?</span>
                            <i class="bi" :class="openFaq === 3 ? 'bi-chevron-up text-red-600' : 'bi-chevron-down text-gray-500'"></i>
                        </button>
                        <div x-show="openFaq === 3" x-collapse class="mt-3 text-gray-600 text-sm leading-relaxed">
                            <p>Atualizamos nossa base de dados periodicamente, <strong class="font-medium">geralmente a cada 3 meses</strong>, de acordo com a liberação dos arquivos públicos pela Receita Federal. Para dados em tempo real, consulte o site oficial.</p>
                        </div>
                    </div>

                    {{-- Pergunta 4 --}}
                    <div class="group"> {{-- Último item sem borda --}}
                        <button @click="openFaq = (openFaq === 4 ? null : 4)" class="flex justify-between items-center w-full text-left cursor-pointer">
                            <span class="font-semibold text-gray-800 text-base md:text-lg group-hover:text-[#ed1c24] transition-colors duration-200">Posso usar esses dados para fins comerciais?</span>
                            <i class="bi" :class="openFaq === 4 ? 'bi-chevron-up text-red-600' : 'bi-chevron-down text-gray-500'"></i>
                        </button>
                        <div x-show="openFaq === 4" x-collapse class="mt-3 text-gray-600 text-sm leading-relaxed">
                            <p>Os dados são públicos, mas seu uso deve respeitar a <strong class="font-medium">Lei Geral de Proteção de Dados (LGPD)</strong> e outras legislações aplicáveis. Oferecemos um <a href="{{ route('nossosServicos') }}" class="text-[#ed1c24] hover:underline font-medium">serviço especializado</a> para criação de listas de prospecção B2B qualificadas e em conformidade.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- O componente do popup de erro será renderizado aqui se houver erro na sessão --}}
@if(session('error'))
    <x-popup-error
        message="{{ session('error') }}"
        title="Ocorreu um Erro"
    />
@endif

@endsection

@push('scripts')
{{-- Máscara para o campo de CNPJ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cnpjInput = document.getElementById('cnpj-input');
        if (cnpjInput) {
            const mask = IMask(cnpjInput, {
                mask: '00.000.000/0000-00'
            });

            const form = cnpjInput.closest('form');
            if (form) {
                // Remove a máscara ANTES da validação do HTML5 e do envio
                form.addEventListener('submit', function(event) {
                    mask.updateValue(); // Atualiza o valor sem máscara
                    // Se o campo for required e estiver vazio APÓS tirar a máscara (caso só tenha digitado máscara)
                    if (cnpjInput.required && !cnpjInput.value) {
                         // Você pode adicionar uma validação visual aqui se desejar
                        // event.preventDefault(); // Impede o envio se estiver vazio após desmascarar
                    }
                }, true); // Use 'true' para capturar antes da validação do browser
            }
        }
    });
</script>
{{-- AlpineJS Core e Collapse para o FAQ --}}
{{-- Certifique-se que o Core está carregado antes do Collapse --}}
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
{{-- Se Alpine não estiver via npm, descomente a linha abaixo --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
@endpush

