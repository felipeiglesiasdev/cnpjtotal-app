{{-- resources/views/components/home/consultas.blade.php --}}
{{-- Refatorado para o padrão de design "Triunfal" (Fundo Branco) --}}

<section {{ $attributes->merge(['class' => 'relative bg-gradient-to-b from-white to-gray-50 py-24 md:py-32 overflow-hidden']) }}>

    {{-- Container --}}
    <div class="container mx-auto px-6">

        {{-- Cabeçalho da Seção --}}
        <div class="text-center mb-20 max-w-3xl mx-auto"> {{-- Aumentada margem inferior --}}
             <span class="text-sm font-semibold text-[#ed1c24] uppercase tracking-wider mb-2 inline-block">Explore Nossas Ferramentas</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-5 leading-tight">
                Consulte Dados Públicos Facilmente
            </h2>
            <p class="text-lg text-gray-700 font-light">
                Acesse informações atualizadas de CNPJ, CNAE e localize empresas por CEP. Tudo gratuito e de forma simplificada.
            </p>
        </div>

        {{-- Grid de Cards de Consulta --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">

            {{-- Card 1: Consultar CNPJ --}}
            <div class="group relative rounded-xl border border-gray-200 bg-white p-8 pt-16 shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.03] hover:-translate-y-1.5">
                {{-- Ícone no Padrão (Canto) --}}
                <div class="absolute -top-4 -left-4 sm:-top-6 sm:-left-6 flex w-14 h-14 sm:w-16 sm:h-16 items-center justify-center rounded-full bg-[#ed1c24] border-4 border-white shadow-xl transition-all duration-300 group-hover:rotate-[-12deg] group-hover:scale-110 group-hover:bg-[#171717]">
                    <i class="bi bi-building-check text-2xl sm:text-3xl text-white transition-colors duration-300 group-hover:text-white"></i>
                </div>
                
                <h3 class="text-2xl font-semibold text-gray-900 mb-3 mt-4 text-left">Consulta de CNPJ</h3>
                <p class="text-gray-700 text-base mb-8 font-light leading-relaxed text-left">
                    Acesse dados cadastrais completos de qualquer empresa brasileira. Gratuito e rápido.
                </p>
                
                {{-- Botão Padronizado --}}
                <a href="{{ route('cnpj.index') }}"
                   class="inline-flex items-center justify-center cursor-pointer w-full sm:w-auto bg-[#171717] text-white font-medium py-3 px-8 rounded-full text-base hover:bg-[#ed1c24] transition-all duration-300 ease-out hover:-translate-y-px transform relative z-10">
                    <span>Consultar CNPJ</span>
                    <i class="bi bi-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- Card 2: Consultar CNAE --}}
            <div class="group relative rounded-xl border border-gray-200 bg-white p-8 pt-16 shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.03] hover:-translate-y-1.5">
                {{-- Ícone no Padrão (Canto) --}}
                <div class="absolute -top-4 -left-4 sm:-top-6 sm:-left-6 flex w-14 h-14 sm:w-16 sm:h-16 items-center justify-center rounded-full bg-[#ed1c24] border-4 border-white shadow-xl transition-all duration-300 group-hover:rotate-[-12deg] group-hover:scale-110 group-hover:bg-[#171717]">
                    <i class="bi bi-briefcase-fill text-2xl sm:text-3xl text-white transition-colors duration-300 group-hover:text-white"></i>
                </div>
                
                <h3 class="text-2xl font-semibold text-gray-900 mb-3 mt-4 text-left">Consulta de CNAE</h3>
                <p class="text-gray-700 text-base mb-8 font-light leading-relaxed text-left">
                    Descubra o significado de cada código de atividade econômica e veja empresas relacionadas.
                </p>
                
                {{-- Botão Padronizado --}}
                <a href="{{ route('cnae.index') }}"
                   class="inline-flex items-center justify-center cursor-pointer w-full sm:w-auto bg-[#171717] text-white font-medium py-3 px-8 rounded-full text-base hover:bg-[#ed1c24] transition-all duration-300 ease-out hover:-translate-y-px transform relative z-10">
                    <span>Consultar CNAE</span>
                    <i class="bi bi-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- Card 3: Consultar por CEP --}}
            <div class="group relative rounded-xl border border-gray-200 bg-white p-8 pt-16 shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.03] hover:-translate-y-1.5">
                {{-- Ícone no Padrão (Canto) --}}
                <div class="absolute -top-4 -left-4 sm:-top-6 sm:-left-6 flex w-14 h-14 sm:w-16 sm:h-16 items-center justify-center rounded-full bg-[#ed1c24] border-4 border-white shadow-xl transition-all duration-300 group-hover:rotate-[-12deg] group-hover:scale-110 group-hover:bg-[#171717]">
                    <i class="bi bi-pin-map-fill text-2xl sm:text-3xl text-white transition-colors duration-300 group-hover:text-white"></i>
                </div>
                
                <h3 class="text-2xl font-semibold text-gray-900 mb-3 mt-4 text-left">Consulta por CEP</h3>
                <p class="text-gray-700 text-base mb-8 font-light leading-relaxed text-left">
                    Localize empresas ativas em um CEP específico e explore negócios na sua vizinhança.
                </p>
                
                {{-- Botão Padronizado --}}
                <a href="{{ route('cep.index') }}"
                   class="inline-flex items-center justify-center cursor-pointer w-full sm:w-auto bg-[#171717] text-white font-medium py-3 px-8 rounded-full text-base hover:bg-[#ed1c24] transition-all duration-300 ease-out hover:-translate-y-px transform relative z-10">
                    <span>Consultar por CEP</span>
                    <i class="bi bi-arrow-right ml-2"></i>
                </a>
            </div>

        </div>
    </div>
</section>
