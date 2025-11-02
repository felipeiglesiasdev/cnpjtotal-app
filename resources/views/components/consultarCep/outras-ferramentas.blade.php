
<section class="bg-[#171717] py-24 md:py-32 overflow-hidden">
    <div class="container mx-auto max-w-6xl px-6 sm:px-4">
        <div class="text-center max-w-3xl mx-auto">
            <span class="text-sm font-semibold text-[#ed1c24] uppercase tracking-wider mb-4 inline-block">
                Expanda Suas Consultas
            </span>
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-8 tracking-tight">
                Acesse Nossas Outras Ferramentas
            </h2>
            <p class="text-lg text-gray-300 mb-20 font-light">
                Descubra mais insights e informações com nossas ferramentas complementares gratuitas.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto">
            <a href="{{ route('cnpj.index') }}" class="group relative block rounded-xl border border-white/10 bg-white/5 p-8 shadow-lg backdrop-blur-lg transition-all duration-300 hover:bg-white/10 hover:-translate-y-1.5 overflow-hidden">
                 <div class="flex items-center">
                     <div class="mr-6 flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-[#ed1c24]/10 border border-[#ed1c24]/30 transition-all duration-300 group-hover:bg-[#ed1c24]">
                         <i class="bi bi-geo-alt-fill text-3xl text-[#ed1c24] transition-colors duration-300 group-hover:text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-white mb-1 group-hover:text-red-100 transition-colors duration-300">Consulta CNPJ Grátis</h3>
                        <p class="text-gray-300 font-light">Consulte qualquer CNPJ gratuitamente com dados atualizados da receita federal.</p>
                    </div>
                </div>
                 <div class="absolute top-1/2 right-6 -translate-y-1/2 transform text-white opacity-0 transition-all duration-300 group-hover:opacity-100 group-hover:right-8">
                    <i class="bi bi-arrow-right-circle-fill text-3xl"></i>
                </div>
                 <div class="absolute -bottom-10 -right-10 h-24 w-24 bg-[#ed1c24]/5 rounded-full filter blur-xl opacity-50 transition-all duration-300 group-hover:scale-150 group-hover:opacity-100"></div>
            </a>

            <a href="{{ route('cnae.index') }}" class="group relative block rounded-xl border border-white/10 bg-white/5 p-8 shadow-lg backdrop-blur-lg transition-all duration-300 hover:bg-white/10 hover:-translate-y-1.5 overflow-hidden">
                <div class="flex items-center">
                    <div class="mr-6 flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-[#ed1c24]/10 border border-[#ed1c24]/30 transition-all duration-300 group-hover:bg-[#ed1c24]">
                        <i class="bi bi-tags-fill text-3xl text-[#ed1c24] transition-colors duration-300 group-hover:text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-white mb-1 group-hover:text-red-100 transition-colors duration-300">Consultar CNAEs</h3>
                        <p class="text-gray-300 font-light">Encontre e explore todas as Classificações Nacionais de Atividades Econômicas.</p>
                    </div>
                </div>
                <div class="absolute top-1/2 right-6 -translate-y-1/2 transform text-white opacity-0 transition-all duration-300 group-hover:opacity-100 group-hover:right-8">
                    <i class="bi bi-arrow-right-circle-fill text-3xl"></i>
                </div>
                 <div class="absolute -bottom-10 -right-10 h-24 w-24 bg-[#ed1c24]/5 rounded-full filter blur-xl opacity-50 transition-all duration-300 group-hover:scale-150 group-hover:opacity-100"></div>
            </a>
            

        </div>
    </div>
</section>