@php
    // Verifica se a rota atual é a 'home' para aplicar o efeito de transparência inicial.
    $isHomePage = request()->routeIs('home');
@endphp

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
        class="fixed top-0 left-0 w-full z-30 transition-all duration-300"
        itemscope itemtype="https://schema.org/Organization">
    
    <div class="container mx-auto flex justify-between items-center p-4">
        {{-- Logos com troca dinâmica --}}
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

        {{-- Navegação Desktop --}}
        <nav class="hidden md:flex items-center space-x-8" role="navigation" aria-label="Navegação Principal" itemscope itemtype="https://schema.org/SiteNavigationElement">
            <ul class="flex space-x-8">
                <li itemprop="name"><a itemprop="url" href="{{ route('home') }}" title="Ir para a página inicial" class="font-medium transition-colors duration-300" :class="!scrolled ? 'text-white hover:text-gray-200' : 'text-[#171717] hover:text-[#ed1c24]'">Início</a></li>
                <li itemprop="name"><a itemprop="url" href="{{ route('cnpj.index') }}" title="Use nossa ferramenta gratuita para consultar CNPJ" class="font-medium transition-colors duration-300" :class="!scrolled ? 'text-white hover:text-gray-200' : 'text-[#171717] hover:text-[#ed1c24]'">Consultar CNPJ</a></li>
                <li itemprop="name"><a itemprop="url" href="{{ route('cnae.index') }}" title="Use nossa ferramenta gratuita para consultar CNAEs" class="font-medium transition-colors duration-300" :class="!scrolled ? 'text-white hover:text-gray-200' : 'text-[#171717] hover:text-[#ed1c24]'">Consultar CNAE</a></li>
            </ul>
        </nav>

        {{-- Botão do Menu Mobile --}}
        <div class="md:hidden">
            <button @click="open = !open" class="focus:outline-none" :class="!scrolled ? 'text-white' : 'text-[#171717]'" aria-label="Abrir menu de navegação" aria-expanded="false" :aria-expanded="open.toString()">
                <i class="bi text-3xl transition-transform duration-300" :class="open ? 'bi-x-lg' : 'bi-list'"></i>
            </button>
        </div>
    </div>

    {{-- Menu Mobile Dropdown --}}
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
            <li itemprop="name"><a itemprop="url" href="{{ route('home') }}" title="Ir para a página inicial" class="block py-3 px-4 text-center text-lg text-gray-200 hover:bg-[#ed1c24] hover:text-white transition-colors duration-300">Início</a></li>
            <li itemprop="name"><a itemprop="url" href="{{ route('cnpj.index') }}" title="Use nossa ferramenta gratuita para consultar CNPJ" class="block py-3 px-4 text-center text-lg text-gray-200 hover:bg-[#ed1c24] hover:text-white transition-colors duration-300">Consultar CNPJ</a></li>
            <li itemprop="name"><a itemprop="url" href="{{ route('cnae.index') }}" title="Use nossa ferramenta gratuita para consultar CNAES" class="block py-3 px-4 text-center text-lg text-gray-200 hover:bg-[#ed1c24] hover:text-white transition-colors duration-300">Consultar CNAE</a></li>
        </ul>
    </nav>
</header>

