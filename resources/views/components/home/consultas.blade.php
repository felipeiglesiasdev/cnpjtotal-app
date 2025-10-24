{{-- Seção de Destaque das Consultas - Versão Branca Finalizada --}}
{{-- Removido fade-in --}}
<section {{ $attributes->merge(['class' => 'relative bg-gradient-to-b from-white to-gray-50 py-24 md:py-32 overflow-hidden']) }}>

    {{-- Container --}}
    <div class="container mx-auto px-6">

        {{-- Cabeçalho da Seção --}}
        <div class="text-center mb-16 max-w-3xl mx-auto">
             <span class="text-sm font-semibold text-[#ed1c24] uppercase tracking-wider mb-2 inline-block">Explore Nossas Ferramentas</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-5 leading-tight">
                Consulte Dados Públicos Facilmente
            </h2>
            {{-- Texto escurecido --}}
            <p class="text-lg text-gray-700 font-light">
                Acesse informações atualizadas de CNPJ, CNAE e localize empresas por CEP. Tudo gratuito e de forma simplificada.
            </p>
        </div>

        {{-- Grid de Cards de Consulta --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto"> {{-- Aumentado gap --}}

            {{-- Card 1: Consultar CNPJ --}}
            {{-- Aumentado padding top para compensar ícone --}}
            <div class="group relative bg-white border border-gray-200 rounded-xl shadow-lg pt-20 pb-10 px-8 text-center transition-all duration-300 hover:shadow-2xl hover:border-gray-300 hover:-translate-y-2">
                {{-- Ícone Vazado (sobrepondo borda esquerda, tamanho ajustado) --}}
                <div class="absolute -top-6 left-8"> {{-- Posicionado na esquerda --}}
                    <div class="inline-block bg-[#ed1c24] p-4 rounded-full shadow-lg transition-transform duration-300 group-hover:scale-110">
                        {{-- Tamanho do ícone reduzido --}}
                        <i class="bi bi-building-check text-2xl text-white block"></i>
                    </div>
                </div>

                <h3 class="text-2xl font-semibold text-gray-800 mb-3 mt-4">Consulta de CNPJ</h3>
                 {{-- Texto base e mais escuro --}}
                <p class="text-gray-700 text-base mb-8 font-light leading-relaxed">
                    Acesse dados cadastrais completos de qualquer empresa brasileira. Gratuito e rápido.
                </p>
                {{-- Botão com nova cor, hover vermelho e translateY --}}
                <a href="{{ route('cnpj.index') }}"
                   class="inline-block bg-[#171717] text-white font-medium py-2.5 px-8 rounded-full text-base hover:bg-[#ed1c24] transition-all duration-300 ease-out hover:-translate-y-1 transform relative z-10">
                    Consultar CNPJ Agora
                    <i class="bi bi-arrow-right ml-1"></i>
                </a>
            </div>

            {{-- Card 2: Consultar CNAE --}}
            <div class="group relative bg-white border border-gray-200 rounded-xl shadow-lg pt-20 pb-10 px-8 text-center transition-all duration-300 hover:shadow-2xl hover:border-gray-300 hover:-translate-y-2">
                 {{-- Ícone Vazado --}}
                <div class="absolute -top-6 left-8">
                    <div class="inline-block bg-[#ed1c24] p-4 rounded-full shadow-lg transition-transform duration-300 group-hover:scale-110">
                         {{-- Tamanho do ícone reduzido --}}
                        <i class="bi bi-briefcase-fill text-2xl text-white block"></i>
                    </div>
                </div>

                <h3 class="text-2xl font-semibold text-gray-800 mb-3 mt-4">Consulta de CNAE</h3>
                {{-- Texto base e mais escuro --}}
                <p class="text-gray-700 text-base mb-8 font-light leading-relaxed">
                    Descubra o significado de cada código de atividade econômica e veja empresas relacionadas.
                </p>
                {{-- Botão com nova cor, hover vermelho e translateY --}}
                 <a href="{{ route('cnae.index') }}"
                   class="inline-block bg-[#171717] text-white font-medium py-2.5 px-8 rounded-full text-base hover:bg-[#ed1c24] transition-all duration-300 ease-out hover:-translate-y-1 transform relative z-10">
                    Consultar CNAE Agora
                    <i class="bi bi-arrow-right ml-1"></i>
                </a>
            </div>

            {{-- Card 3: Consultar por CEP --}}
            <div class="group relative bg-white border border-gray-200 rounded-xl shadow-lg pt-20 pb-10 px-8 text-center transition-all duration-300 hover:shadow-2xl hover:border-gray-300 hover:-translate-y-2">
                 {{-- Ícone Vazado --}}
                <div class="absolute -top-6 left-8">
                    <div class="inline-block bg-[#ed1c24] p-4 rounded-full shadow-lg transition-transform duration-300 group-hover:scale-110">
                         {{-- Tamanho do ícone reduzido --}}
                        <i class="bi bi-pin-map-fill text-2xl text-white block"></i>
                    </div>
                </div>

                <h3 class="text-2xl font-semibold text-gray-800 mb-3 mt-4">Consulta por CEP</h3>
                 {{-- Texto base e mais escuro --}}
                <p class="text-gray-700 text-base mb-8 font-light leading-relaxed">
                    Localize empresas ativas em um CEP específico e explore negócios na sua vizinhança.
                </p>
                {{-- Botão com nova cor, hover vermelho e translateY --}}
                 <a href="{{ route('cep.index') }}"
                   class="inline-block bg-[#171717] text-white font-medium py-2.5 px-8 rounded-full text-base hover:bg-[#ed1c24] transition-all duration-300 ease-out hover:-translate-y-1 transform relative z-10">
                    Consultar por CEP Agora
                    <i class="bi bi-arrow-right ml-1"></i>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- Removido o pushOnce('styles') do fade-in --}}

