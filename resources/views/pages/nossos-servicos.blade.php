@extends('layouts.app')

@section('content')
<section id="nossos-servicos" class="bg-[#171717] py-16 md:py-24 relative overflow-hidden">
    {{-- Bolas Animadas no Fundo --}}
    <div aria-hidden="true" class="absolute inset-0 z-0 opacity-40">
        <div class="absolute top-[-10%] left-[-15%] w-[400px] h-[400px] md:w-[600px] md:h-[600px] bg-[#ed1c24] rounded-full filter blur-3xl animated-blob"></div>
        <div class="absolute bottom-[-15%] right-[-10%] w-[350px] h-[350px] md:w-[500px] md:h-[500px] bg-[#ed1c24] rounded-full filter blur-3xl animated-blob blob-delay-1"></div>
        <div class="absolute top-[30%] right-[5%] w-[200px] h-[200px] md:w-[300px] md:h-[300px] bg-[#c11b21] rounded-full filter blur-3xl animated-blob blob-delay-2"></div>
    </div>

    {{-- Conteúdo principal com z-index maior para ficar na frente --}}
    <div class="container mx-auto px-4 relative z-10">

        {{-- 1. Cabeçalho da Seção --}}
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                Transforme Dados Públicos<br class="hidden md:block"> em Oportunidades <span class="text-[#ed1c24]">B2B Reais</span>
            </h2>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                Alavanque suas vendas B2B com listas de leads segmentadas, criadas a partir da base de CNPJs mais atualizada do Brasil.
            </p>
        </div>

        {{-- 2. Banner (Frase de Impacto) --}}
        <div class="text-center my-16 md:my-24">
            <p class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight shadow-text-red">
                Encontre <span class="text-[#ed1c24]">Exatamente</span> Quem Compra de Você.
            </p>
             <style> .shadow-text-red { text-shadow: 0 0 15px rgba(237, 28, 36, 0.5); } </style>
        </div>


        {{-- 3. Benefícios (Os 3 Cards) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10 mb-16 md:mb-24">

            {{-- Card 1: Dados Precisos --}}
            <div class="glass-card p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center transform hover:-translate-y-1">
                <div class="mb-5 w-16 h-16 flex items-center justify-center bg-white/10 rounded-full text-[#ed1c24] border border-white/10">
                    <i class="bi bi-database-check text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Base de CNPJs Atualizada</h3>
                <p class="text-gray-300 text-sm">
                    Utilizamos dados públicos diretamente da Receita Federal, garantindo a informação mais recente para sua prospecção B2B.
                </p>
            </div>

            {{-- Card 2: Estratégia Personalizada --}}
            <div class="glass-card p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center transform hover:-translate-y-1">
                <div class="mb-5 w-16 h-16 flex items-center justify-center bg-white/10 rounded-full text-[#ed1c24] border border-white/10">
                    <i class="bi bi-sliders text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Segmentação Sob Medida</h3>
                <p class="text-gray-300 text-sm">
                    Entendemos seu negócio e seu cliente ideal para criar filtros precisos (CNAE, localização, porte, etc.) e encontrar seus potenciais clientes.
                </p>
            </div>

            {{-- Card 3: Aumento de Faturamento --}}
            <div class="glass-card p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center transform hover:-translate-y-1">
                <div class="mb-5 w-16 h-16 flex items-center justify-center bg-white/10 rounded-full text-[#ed1c24] border border-white/10">
                    <i class="bi bi-graph-up-arrow text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Acelere seu Faturamento</h3>
                <p class="text-gray-300 text-sm">
                    Receba listas de leads B2B qualificados, prontos para sua equipe comercial abordar e converter em novos negócios e mais receita.
                </p>
            </div>

        </div>

        {{-- 4. Processo Passo a Passo --}}
        <div class="mb-16 md:mb-24">
            <div class="text-center mb-10 md:mb-14">
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">Como Funciona? Nosso Processo Simplificado</h3>
                <p class="text-gray-300 max-w-2xl mx-auto">Em apenas 4 passos, conectamos você aos seus futuros clientes.</p>
            </div>

            {{-- Grid do Passo a Passo (4 Colunas em Desktop) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-6 relative">

                {{-- Passo 1: Contato Inicial --}}
                <div class="glass-card p-5 rounded-lg flex flex-col items-center text-center relative lg:step-connector lg:last:after:hidden">
                    <div class="mb-4 w-12 h-12 flex items-center justify-center bg-white/10 rounded-full text-[#ed1c24] border border-white/10 text-xl font-bold">1</div>
                    <i class="bi bi-chat-dots-fill text-3xl text-white/80 mb-3"></i>
                    <h4 class="text-lg font-semibold text-white mb-1">Contato</h4>
                    <p class="text-gray-300 text-xs">Você entra em contato e nos conta sobre seu negócio e seu público-alvo B2B.</p>
                </div>

                {{-- Passo 2: Entendimento --}}
                <div class="glass-card p-5 rounded-lg flex flex-col items-center text-center relative lg:step-connector lg:last:after:hidden">
                    <div class="mb-4 w-12 h-12 flex items-center justify-center bg-white/10 rounded-full text-[#ed1c24] border border-white/10 text-xl font-bold">2</div>
                    <i class="bi bi-binoculars-fill text-3xl text-white/80 mb-3"></i>
                    <h4 class="text-lg font-semibold text-white mb-1">Análise</h4>
                    <p class="text-gray-300 text-xs">Analisamos suas necessidades e o perfil do seu cliente ideal para definir a melhor estratégia.</p>
                </div>

                {{-- Passo 3: Plano e Segmentação --}}
                <div class="glass-card p-5 rounded-lg flex flex-col items-center text-center relative lg:step-connector lg:last:after:hidden">
                    <div class="mb-4 w-12 h-12 flex items-center justify-center bg-white/10 rounded-full text-[#ed1c24] border border-white/10 text-xl font-bold">3</div>
                    <i class="bi bi-clipboard-data-fill text-3xl text-white/80 mb-3"></i>
                    <h4 class="text-lg font-semibold text-white mb-1">Plano</h4>
                    <p class="text-gray-300 text-xs">Elaboramos um plano detalhado e aplicamos filtros avançados na base de CNPJs.</p>
                </div>

                {{-- Passo 4: Entrega dos Leads --}}
                <div class="glass-card p-5 rounded-lg flex flex-col items-center text-center relative lg:last:after:hidden"> {{-- Remover step-connector do último --}}
                    <div class="mb-4 w-12 h-12 flex items-center justify-center bg-white/10 rounded-full text-[#ed1c24] border border-white/10 text-xl font-bold">4</div>
                    <i class="bi bi-send-check-fill text-3xl text-white/80 mb-3"></i>
                    <h4 class="text-lg font-semibold text-white mb-1">Entrega</h4>
                    <p class="text-gray-300 text-xs">Você recebe a lista de leads B2B segmentada, pronta para impulsionar suas vendas.</p>
                </div>

            </div>
        </div>

        {{-- 5. Seção de Contato/CTA (Estilo Vidro Vermelho) --}}
        <div class="text-center glass-cta p-8 md:p-12 rounded-xl shadow-lg">
             <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">Pronto para Encontrar Seus Próximos Clientes B2B?</h3>
             <p class="text-gray-200 mb-6 max-w-xl mx-auto">
                 Vamos conversar sobre como podemos criar a lista de leads perfeita para o seu negócio crescer.
             </p>
             <a href="#contato" {{-- Ou a rota/URL correta --}}
                class="inline-block bg-[#ed1c24] text-white font-bold py-3 px-8 rounded-lg text-lg hover:bg-[#c11b21] hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#ed1c24]/50">
                 Solicitar Orçamento
             </a>
        </div>

    </div>
</section>


@endsection
@once
    @push('styles')
        <style>
            /* Keyframes para a animação das bolas */
            @keyframes pulse-fade-slow {
                0%, 100% { opacity: 0.1; transform: scale(0.95); }
                50% { opacity: 0.3; transform: scale(1); }
            }
            .animated-blob {
                animation: pulse-fade-slow 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            .blob-delay-1 { animation-delay: -2s; }
            .blob-delay-2 { animation-delay: -4s; }

             /* Estilo Glassmorphism para os cards */
            .glass-card {
                background: rgba(255, 255, 255, 0.05); /* Fundo branco com baixa opacidade */
                backdrop-filter: blur(12px); /* Efeito de desfoque */
                -webkit-backdrop-filter: blur(12px); /* Suporte para Safari */
                border: 1px solid rgba(255, 255, 255, 0.1); /* Borda sutil */
                transition: background 0.3s ease, border 0.3s ease; /* Transição suave */
            }
            .glass-card:hover {
                 background: rgba(255, 255, 255, 0.1);
                 border: 1px solid rgba(255, 255, 255, 0.2);
            }
             /* Estilo Glassmorphism para o CTA */
             .glass-cta {
                background: rgba(237, 28, 36, 0.1); /* Fundo vermelho BEM sutil */
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(237, 28, 36, 0.2);
            }
             /* Estilo para conectar os passos */
            .step-connector::after {
                content: '';
                position: absolute;
                top: 2rem; /* Alinha com o centro do ícone */
                right: -1.5rem; /* Posiciona entre os cards */
                width: 1.5rem; /* Largura da linha/seta */
                height: 2px;
                background-color: rgba(255, 255, 255, 0.2); /* Cor da linha */
                /* Opcional: Adicionar uma seta (requer mais CSS ou SVG) */
            }
             /* Esconder o conector no último item e em telas pequenas */
             .lg\:last\:after\:hidden::after { display: none; } /* Esconder no último item em LG+ */
             @media (max-width: 1023px) { /* Breakpoint lg do Tailwind */
                .step-connector::after { display: none; } /* Esconder em telas menores que LG */
             }

        </style>
    @endpush
@endonce