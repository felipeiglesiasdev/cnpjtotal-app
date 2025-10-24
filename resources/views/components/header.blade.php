@php
    // Verifica se a rota atual é a 'home' para aplicar o efeito de transparência inicial.
    $isHomePage = request()->routeIs('home');
@endphp

{{--
    Header com lógica Alpine.js:
    - open: Controla o menu mobile.
    - scrolled: Controla o estado de transparência. Começa 'true' (sólido) em todas as páginas, exceto na 'home'.
    - @scroll.window: Apenas na 'home', atualiza 'scrolled' se o scroll passar de 50px.
--}}
<header x-data="{
            open: false,
            scrolled: {{ !$isHomePage ? 'true' : 'false' }}
        }"
        @if($isHomePage)
            @scroll.window="scrolled = (window.scrollY > 50)"
        @endif
        :class="{
            'bg-transparent text-white': !scrolled,
            'bg-white text-[#171717] shadow-md': scrolled
        }"
        class="fixed top-0 left-0 w-full z-30 transition-all duration-300 ease-in-out"
        itemscope itemtype="https://schema.org/Organization">

    <div class="container mx-auto flex justify-between items-center p-4">
        {{-- Logos com troca dinâmica baseada no estado 'scrolled' --}}
        <div class="flex-shrink-0">
            <a href="{{ route('home') }}" itemprop="url" title="Voltar para a página inicial do CNPJ Total">
                {{-- Logo para fundo transparente (topo da home) --}}
                <img x-show="!scrolled" src="{{ asset('logo/logo-branco-vermelho.webp') }}"
                     alt="Logo CNPJ Total - Consulta de CNPJ Online"
                     width="160" height="40" itemprop="logo"
                     class="h-10 w-auto transition-opacity duration-300 ease-in-out">

                {{-- Logo para fundo branco (após rolar ou em outras páginas) --}}
                <img x-show="scrolled" src="{{ asset('logo/logo-preto-vermelho.webp') }}"
                     alt="Logo CNPJ Total - Consulta de CNPJ Online"
                     width="160" height="40" itemprop="logo"
                     class="h-10 w-auto transition-opacity duration-300 ease-in-out" style="display: none;">
            </a>
        </div>

        {{-- Navegação Desktop (Menu Atualizado) --}}
        <nav class="hidden md:flex items-center space-x-6 lg:space-x-8" role="navigation" aria-label="Navegação Principal" itemscope itemtype="https://schema.org/SiteNavigationElement">
            {{-- Mantido items-center para alinhamento vertical --}}
            <ul class="flex items-center space-x-6 lg:space-x-8">
                 {{-- Estilo de texto aplicado --}}
                <li itemprop="name"><a itemprop="url" href="{{ route('home') }}" title="Ir para a página inicial" class="font-medium text-sm uppercase tracking-wider transition-colors duration-300" :class="!scrolled ? 'text-white hover:text-gray-200' : 'text-[#171717] hover:text-[#ed1c24]'">Início</a></li>

                {{-- Dropdown de Consultas --}}
                {{-- CORREÇÃO: pb-4 (reduzido) para ponte sutil --}}
                <li x-data="{ open: false }" class="relative" @mouseleave="open = false">
                     {{-- Estilo de texto aplicado --}}
                    <button @mouseover="open = true" class="flex items-center font-medium text-sm uppercase tracking-wider transition-colors duration-300" :class="!scrolled ? 'text-white hover:text-gray-200' : 'text-[#171717] hover:text-[#ed1c24]'">
                        <span>Consultar</span>
                        <i class="bi bi-chevron-down text-xs ml-1 transform transition-transform" :class="{ 'rotate-180': open }"></i>
                    </button>
                    {{-- CORREÇÃO: mt-1 para leve ajuste para baixo --}}
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute z-10 -ml-4 w-64 rounded-xl bg-white shadow-lg ring-1 ring-gray-900/5" {{-- mt-1 --}}
                         style="display: none;">
                        <div class="py-2">
                             {{-- Estilo de texto NÃO aplicado aqui para manter legibilidade no dropdown --}}
                            <a href="{{ route('cnpj.index') }}" title="Use nossa ferramenta gratuita para consultar CNPJ" class="flex items-center gap-x-4 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <i class="bi bi-building-check text-xl text-[#ed1c24] w-6 text-center"></i>
                                <span>Consultar CNPJ</span>
                            </a>
                            <a href="{{ route('cnae.index') }}" title="Use nossa ferramenta gratuita para consultar CNAEs" class="flex items-center gap-x-4 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <i class="bi bi-briefcase-fill text-xl text-[#ed1c24] w-6 text-center"></i>
                                <span>Consultar CNAE</span>
                            </a>
                            <a href="{{ route('cep.index') }}" title="Use nossa ferramenta gratuita para consultar por CEP" class="flex items-center gap-x-4 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <i class="bi bi-pin-map-fill text-xl text-[#ed1c24] w-6 text-center"></i>
                                <span>Consultar por CEP</span>
                            </a>
                        </div>
                    </div>
                </li>

                 {{-- Estilo de texto aplicado --}}
                <li itemprop="name"><a itemprop="url" href="{{ route('portal.index') }}" title="Acesse nosso portal de análise de dados" class="font-medium text-sm uppercase tracking-wider transition-colors duration-300" :class="!scrolled ? 'text-white hover:text-gray-200' : 'text-[#171717] hover:text-[#ed1c24]'">Portal de Análise</a></li>
                 {{-- Estilo de texto aplicado --}}
                <li itemprop="name"><a itemprop="url" href="{{ route('nossosServicos') }}" title="Conheça nossos serviços de prospecção" class="font-medium text-sm uppercase tracking-wider transition-colors duration-300" :class="!scrolled ? 'text-white hover:text-gray-200' : 'text-[#171717] hover:text-[#ed1c24]'">Nossos Serviços</a></li>
            </ul>
        </nav>

        {{-- Botão do Menu Mobile --}}
        <div class="md:hidden">
            <button @click="open = !open" class="focus:outline-none" :class="!scrolled ? 'text-white' : 'text-[#171717]'" aria-label="Abrir menu de navegação" aria-expanded="false" :aria-expanded="open.toString()">
                <i class="bi text-3xl transition-transform duration-300" :class="open ? 'bi-x-lg' : 'bi-list'"></i>
            </button>
        </div>
    </div>

    {{-- Menu Mobile Dropdown (Menu Atualizado) --}}
    <nav x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         @click.away="open = false"
         class="md:hidden bg-[#171717] border-t border-gray-700/50"
         role="navigation" aria-label="Navegação Mobile" itemscope itemtype="https://schema.org/SiteNavigationElement"
         style="display: none;">
        <ul class="flex flex-col">
            {{-- Estilo de texto aplicado --}}
            <li itemprop="name"><a itemprop="url" href="{{ route('home') }}" title="Ir para a página inicial" class="block py-3 px-4 text-center text-lg uppercase tracking-wider text-gray-200 hover:bg-[#ed1c24] hover:text-white transition-colors duration-300">Início</a></li>
            <li itemprop="name"><a itemprop="url" href="{{ route('cnpj.index') }}" title="Use nossa ferramenta gratuita para consultar CNPJ" class="block py-3 px-4 text-center text-lg uppercase tracking-wider text-gray-200 hover:bg-[#ed1c24] hover:text-white transition-colors duration-300">Consultar CNPJ</a></li>
            <li itemprop="name"><a itemprop="url" href="{{ route('cnae.index') }}" title="Use nossa ferramenta gratuita para consultar CNAEs" class="block py-3 px-4 text-center text-lg uppercase tracking-wider text-gray-200 hover:bg-[#ed1c24] hover:text-white transition-colors duration-300">Consultar CNAE</a></li>
            <li itemprop="name"><a itemprop="url" href="{{ route('cep.index') }}" title="Use nossa ferramenta gratuita para consultar por CEP" class="block py-3 px-4 text-center text-lg uppercase tracking-wider text-gray-200 hover:bg-[#ed1c24] hover:text-white transition-colors duration-300">Consultar por CEP</a></li>
            <li itemprop="name"><a itemprop="url" href="{{ route('portal.index') }}" title="Acesse nosso portal de análise de dados" class="block py-3 px-4 text-center text-lg uppercase tracking-wider text-gray-200 hover:bg-[#ed1c24] hover:text-white transition-colors duration-300">Portal de Análise</a></li>
            <li itemprop="name"><a itemprop="url" href="{{ route('nossosServicos') }}" title="Conheça nossos serviços de prospecção" class="block py-3 px-4 text-center text-lg uppercase tracking-wider text-gray-200 hover:bg-[#ed1c24] hover:text-white transition-colors duration-300">Nossos Serviços</a></li>
        </ul>
    </nav>
</header>

