@extends('layouts.app')

@section('title', 'Consulta de CNPJ Grátis — Rápido e Completo')

@push('seo_tags')
    <meta name="description" content="Utilize nossa ferramenta gratuita para consultar informações completas de qualquer empresa no Brasil, diretamente da Receita Federal.">
@endpush

@section('content')
{{-- Seção Principal com Formulário --}}
<section class="bg-white">
    <div class="container mx-auto px-6 py-16 md:py-24">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Coluna de Conteúdo e Formulário --}}
            <div class="text-center lg:text-left">
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
                    Consulta de CNPJ Gratuita e Instantânea
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto lg:mx-0">
                    Acesse dados públicos e atualizados da Receita Federal de maneira simples, rápida e sem complicações.
                </p>

                <form class="max-w-lg mx-auto lg:mx-0" action="{{ route('cnpj.consultar') }}" method="POST" novalidate>
                    @csrf
                    <div class="relative flex flex-col sm:flex-row items-center gap-3">
                        <div class="relative w-full">
                           <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                               <i class="bi bi-search text-gray-400"></i>
                           </div>
                            <input 
                                type="tel" 
                                name="cnpj" 
                                id="cnpj-input" 
                                class="w-full text-lg pl-12 pr-4 py-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#ed1c24]/50 focus:border-[#ed1c24] transition-colors duration-300" 
                                placeholder="00.000.000/0000-00"
                                required>
                        </div>
                        <button type="submit" class="cursor-pointer w-full sm:w-auto flex-shrink-0 bg-[#ed1c24] text-white font-bold py-4 px-8 rounded-lg text-lg hover:bg-[#c11b21] hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#ed1c24]/50 flex items-center justify-center gap-2">
                            <span>Consultar</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-gray-500 text-sm">
                    <p><strong><i class="bi bi-shield-check-fill text-green-500"></i> Dados Seguros e Confiáveis:</strong> Nossa plataforma se conecta diretamente com as bases de dados da Receita Federal.</p>
                </div>
            </div>

            {{-- Coluna de Imagem/Ilustração --}}
            <div class="hidden lg:block h-full">
                <img src="{{ asset('images/consulta-cnpj.png') }}" alt="Ilustração de dados empresariais" class="h-full" width="500" >
            </div>
        </div>
    </div>
</section>

{{-- Seção de Vantagens/Recursos Adicionais --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-8 bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 transform">
                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-red-100 text-[#ed1c24] mx-auto mb-5">
                    <i class="bi bi-database-check text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Dados Completos</h3>
                <p class="text-gray-600">Acesse quadro societário, atividades (CNAEs), situação cadastral, capital social e muito mais.</p>
            </div>
            <div class="text-center p-8 bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 transform">
                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-red-100 text-[#ed1c24] mx-auto mb-5">
                    <i class="bi bi-lightbulb text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Interface Intuitiva</h3>
                <p class="text-gray-600">Navegue facilmente pelas informações com um design limpo e organizado para focar no que importa.</p>
            </div>
            <div class="text-center p-8 bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 transform">
                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-red-100 text-[#ed1c24] mx-auto mb-5">
                     <i class="bi bi-gift text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Sempre Gratuito</h3>
                <p class="text-gray-600">Acreditamos no acesso livre à informação. Nossas consultas essenciais são e sempre serão gratuitas.</p>
            </div>
        </div>
    </div>
</section>

{{-- Seção de Perguntas Frequentes (FAQ) --}}
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Perguntas Frequentes</h2>
            <p class="text-gray-600 mt-2 text-lg">Tudo o que você precisa saber sobre nosso serviço.</p>
        </div>
        <div class="max-w-3xl mx-auto" x-data="{ open: 1 }">
            <div class="border-b border-gray-200">
                <button @click="open = (open === 1 ? 0 : 1)" class="w-full text-left py-4 px-2 flex justify-between items-center focus:outline-none">
                    <span class="text-lg font-medium text-gray-800">A consulta de CNPJ é segura e legal?</span>
                    <i class="bi transition-transform duration-300" :class="open === 1 ? 'bi-chevron-up' : 'bi-chevron-down'"></i>
                </button>
                <div x-show="open === 1" x-collapse class="pt-2 pb-4 px-2">
                    <p class="text-gray-600">Sim. Todos os dados são públicos e fornecidos pela Receita Federal, em conformidade com o Decreto Nº 8.777/16 e a Lei de Acesso à Informação.</p>
                </div>
            </div>
            <div class="border-b border-gray-200">
                <button @click="open = (open === 2 ? 0 : 2)" class="w-full text-left py-4 px-2 flex justify-between items-center focus:outline-none">
                    <span class="text-lg font-medium text-gray-800">Com que frequência os dados são atualizados?</span>
                    <i class="bi transition-transform duration-300" :class="open === 2 ? 'bi-chevron-up' : 'bi-chevron-down'"></i>
                </button>
                <div x-show="open === 2" x-collapse class="pt-2 pb-4 px-2">
                    <p class="text-gray-600">Nossa plataforma busca as informações em tempo real diretamente da base de dados oficial, garantindo que você sempre tenha acesso aos dados mais recentes disponíveis.</p>
                </div>
            </div>
            <div class="border-b border-gray-200">
                <button @click="open = (open === 3 ? 0 : 3)" class="w-full text-left py-4 px-2 flex justify-between items-center focus:outline-none">
                    <span class="text-lg font-medium text-gray-800">Posso consultar um CNPJ que já foi baixado?</span>
                    <i class="bi transition-transform duration-300" :class="open === 3 ? 'bi-chevron-up' : 'bi-chevron-down'"></i>
                </button>
                <div x-show="open === 3" x-collapse class="pt-2 pb-4 px-2">
                    <p class="text-gray-600">Com certeza. Nossa ferramenta exibe a situação cadastral atual da empresa, seja ela "ATIVA", "BAIXADA", "SUSPENSA" ou qualquer outro status registrado na Receita Federal.</p>
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
                form.addEventListener('submit', function() {
                    mask.updateValue(); 
                });
            }
        }
    });
</script>
{{-- AlpineJS Collapse para o FAQ --}}
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
@endpush

