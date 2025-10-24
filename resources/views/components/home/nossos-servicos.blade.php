{{-- Seção "Nossos Serviços" - Seleção de Empresas --}}
<section {{ $attributes->merge(['class' => 'relative bg-[#171717] text-white py-24 md:py-32 overflow-hidden']) }}>
    
    {{-- Elementos de fundo animados (bolhas vermelhas discretas) --}}
    <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-red-800 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-red-900 rounded-full mix-blend-screen filter blur-3xl opacity-15 animate-blob animation-delay-4000"></div>
    <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-red-700 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob"></div>

    <div class="relative container mx-auto px-6 z-10">
        
        {{-- Cabeçalho da Seção --}}
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <span class="text-sm font-semibold text-red-400 uppercase tracking-wider">Nossos Serviços</span>
            <h2 class="text-4xl md:text-5xl font-bold text-white mt-3 mb-5 leading-tight">
                Encontre Seus Próximos Clientes B2B
            </h2>
            <p class="text-lg text-gray-300 font-light">
                Transformamos dados públicos em listas de leads qualificados. Fornecemos seleções personalizadas de empresas ativas, filtradas exatamente como você precisa.
            </p>
        </div>

        {{-- Cards Verticais (Passo a Passo) --}}
        <div class="max-w-4xl mx-auto space-y-8">
            
            {{-- Passo 1: Definição --}}
            <div class="flex items-start group">
                {{-- Numeração --}}
                <div class="flex-shrink-0 mr-6 md:mr-8">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-white/10 border border-white/20 rounded-full flex items-center justify-center text-red-400 text-3xl md:text-4xl font-bold transition-all duration-300 group-hover:bg-red-500 group-hover:text-white group-hover:scale-105 shadow-lg">
                        1
                    </div>
                </div>
                {{-- Card de Vidro --}}
                <div class="flex-grow bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-6 md:p-8 shadow-lg transition-all duration-300 group-hover:border-white/30 group-hover:shadow-xl">
                    <div class="flex items-center mb-3">
                        <i class="bi bi-bullseye text-2xl text-red-400 mr-3"></i>
                        <h3 class="text-xl md:text-2xl font-semibold text-white">Defina seu Alvo</h3>
                    </div>
                    <p class="text-gray-300 text-sm md:text-base font-light leading-relaxed">
                        Você nos diz o perfil ideal: localização (estado, cidade, CEP), atividade principal (CNAE), porte da empresa, data de abertura ou outros critérios relevantes.
                    </p>
                </div>
            </div>

            {{-- Passo 2: Filtragem --}}
             <div class="flex items-start group">
                 {{-- Numeração --}}
                <div class="flex-shrink-0 mr-6 md:mr-8">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-white/10 border border-white/20 rounded-full flex items-center justify-center text-red-400 text-3xl md:text-4xl font-bold transition-all duration-300 group-hover:bg-red-500 group-hover:text-white group-hover:scale-105 shadow-lg">
                        2
                    </div>
                </div>
                 {{-- Card de Vidro --}}
                <div class="flex-grow bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-6 md:p-8 shadow-lg transition-all duration-300 group-hover:border-white/30 group-hover:shadow-xl">
                    <div class="flex items-center mb-3">
                        <i class="bi bi-funnel-fill text-2xl text-red-400 mr-3"></i>
                        <h3 class="text-xl md:text-2xl font-semibold text-white">Filtragem Inteligente</h3>
                    </div>
                    <p class="text-gray-300 text-sm md:text-base font-light leading-relaxed">
                        Nossa equipe utiliza os filtros definidos para selecionar apenas <strong class="font-medium text-white">empresas ativas</strong> que correspondem exatamente aos seus critérios, garantindo leads de alta qualidade.
                    </p>
                </div>
            </div>

             {{-- Passo 3: Entrega --}}
             <div class="flex items-start group">
                 {{-- Numeração --}}
                <div class="flex-shrink-0 mr-6 md:mr-8">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-white/10 border border-white/20 rounded-full flex items-center justify-center text-red-400 text-3xl md:text-4xl font-bold transition-all duration-300 group-hover:bg-red-500 group-hover:text-white group-hover:scale-105 shadow-lg">
                        3
                    </div>
                </div>
                 {{-- Card de Vidro --}}
                <div class="flex-grow bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-6 md:p-8 shadow-lg transition-all duration-300 group-hover:border-white/30 group-hover:shadow-xl">
                    <div class="flex items-center mb-3">
                         <i class="bi bi-table text-2xl text-red-400 mr-3"></i>
                        <h3 class="text-xl md:text-2xl font-semibold text-white">Lista Organizada</h3>
                    </div>
                    <p class="text-gray-300 text-sm md:text-base font-light leading-relaxed">
                        Entregamos a seleção final em uma <strong class="font-medium text-white">tabela organizada</strong> (Excel ou similar), pronta para você importar no seu CRM ou iniciar sua prospecção.
                    </p>
                </div>
            </div>

        </div>

        <div class="text-center mt-16">
             <a href="{{ route('nossosServicos') }}"
               class="inline-block bg-[#ed1c24] text-white font-bold py-3 px-10 rounded-full text-lg hover:bg-[#c11b21] transition-all transform hover:scale-105 duration-300 shadow-lg group relative overflow-hidden">
                <span class="relative z-10 transition-transform duration-300 group-hover:-translate-y-px">
                    Quero saber mais
                </span>
                <span class="absolute inset-0 bg-white opacity-0 transition-opacity duration-300 group-hover:opacity-10"></span>
                <i class="bi bi-arrow-right ml-2 relative z-10 transition-transform duration-300 group-hover:translate-x-1"></i> 
            </a>
        </div>

    </div>
</section>

{{-- Adiciona os estilos da animação de blob (se ainda não existirem) --}}
@pushOnce('styles')
<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 10s infinite cubic-bezier(0.68, -0.55, 0.27, 1.55); /* Ajuste a duração e timing */
    }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>
@endPushOnce
