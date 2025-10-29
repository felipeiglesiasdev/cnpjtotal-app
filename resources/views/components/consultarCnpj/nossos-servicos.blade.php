<section class="bg-white py-24 md:py-32 overflow-hidden">
    <div class="container mx-auto max-w-6xl px-6 sm:px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="lg:order-first text-center lg:text-left">
                <span class="text-sm font-semibold text-[#ed1c24] uppercase tracking-wider mb-4 inline-block">
                    Potencialize suas Vendas
                </span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 tracking-tight leading-tight">
                    Nossos Serviços de Prospecção B2B
                </h2>
                <div class="block lg:hidden my-8">
                     <img src="{{ asset('images/leads-b2b.png') }}"
                         alt="[Imagem de] Prospecção de Leads B2B com dados de CNPJ"
                         class="w-full h-auto mx-auto max-w-md"
                         loading="lazy">
                </div>

                <p class="text-lg text-gray-800 mb-10 font-light leading-relaxed">
                    Transforme dados em resultados! Acesse listas de empresas segmentadas por CNAE, localização, porte e muito mais. Ideal para equipes de vendas e marketing que buscam leads qualificados.
                </p>
                <a href="{{ route('nossosServicos') }}"
                   class="inline-block cursor-pointer bg-[#171717] text-white font-medium py-4 px-8 rounded-full text-base hover:bg-[#ed1c24] transition-all duration-300 ease-out hover:-translate-y-px transform relative z-10">
                    <span>Conheça Nossas Soluções</span>
                    <i class="bi bi-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="hidden lg:block lg:order-last">
                 <img src="{{ asset('images/leads-b2b.png') }}"
                     alt="Prospecção de Leads B2B com dados de CNPJ"
                     class="w-full h-auto transform transition-transform duration-500 hover:scale-105 mx-auto lg:max-w-lg"
                     loading="lazy">
            </div>
        </div>
    </div>
</section>

