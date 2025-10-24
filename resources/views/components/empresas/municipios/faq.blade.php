@props(['nomeMunicipio', 'nomeEstado', 'uf', 'totalEmpresas'])

<div x-data="{ openFaq: null }" class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 mt-12">
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-patch-question-fill text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Perguntas Frequentes sobre {{ $nomeMunicipio }}</h2>
            <p class="text-sm text-gray-500">Informações rápidas sobre as empresas locais.</p>
        </div>
    </div>

    <div class="space-y-4">
        {{-- Pergunta 1 --}}
        <div class="border-b border-gray-200 pb-4 group">
            <button @click="openFaq = (openFaq === 1 ? null : 1)" class="flex justify-between items-center w-full text-left cursor-pointer">
                <span class="font-semibold text-gray-800 text-base md:text-lg group-hover:text-[#ED1C24]">Quantas empresas ativas existem em {{ $nomeMunicipio }}?</span>
                <i class="bi" :class="openFaq === 1 ? 'bi-chevron-up text-red-600' : 'bi-chevron-down text-gray-500'"></i>
            </button>
            <div x-show="openFaq === 1" x-collapse class="mt-3 text-gray-600 text-sm leading-relaxed">
                <p>Atualmente, existem <strong>{{ number_format($totalEmpresas, 0, ',', '.') }} empresas ativas</strong> registradas em {{ $nomeMunicipio }}, {{ $nomeEstado }}. Você pode consultar a lista completa nesta página.</p>
            </div>
        </div>

        {{-- Pergunta 2 --}}
        <div class="border-b border-gray-200 pb-4 group">
            <button @click="openFaq = (openFaq === 2 ? null : 2)" class="flex justify-between items-center w-full text-left cursor-pointer">
                <span class="font-semibold text-gray-800 text-base md:text-lg group-hover:text-[#ED1C24]">Como posso verificar os dados de uma empresa específica em {{ $nomeMunicipio }}?</span>
                 <i class="bi" :class="openFaq === 2 ? 'bi-chevron-up text-red-600' : 'bi-chevron-down text-gray-500'"></i>
            </button>
            <div x-show="openFaq === 2" x-collapse class="mt-3 text-gray-600 text-sm leading-relaxed">
                 <p>Na tabela acima, clique no número do CNPJ da empresa desejada. Você será redirecionado para a página com todos os detalhes cadastrais públicos daquele CNPJ, como endereço, atividades (CNAE), quadro societário (QSA), situação cadastral e mais.</p>
            </div>
        </div>

         {{-- Pergunta 3 --}}
        <div> {{-- Último item sem borda inferior --}}
            <button @click="openFaq = (openFaq === 3 ? null : 3)" class="flex justify-between items-center w-full text-left cursor-pointer group">
                <span class="font-semibold text-gray-800 text-base md:text-lg group-hover:text-[#ED1C24]">Os dados apresentados são oficiais?</span>
                 <i class="bi" :class="openFaq === 3 ? 'bi-chevron-up text-red-600' : 'bi-chevron-down text-gray-500'"></i>
            </button>
            <div x-show="openFaq === 3" x-collapse class="mt-3 text-gray-600 text-sm leading-relaxed">
                 <p>As informações exibidas são extraídas de fontes públicas oficiais (Receita Federal), porém nosso site não é uma ferramenta governamental e os dados podem ter alguma defasagem. Para confirmação oficial, sempre consulte os órgãos competentes.</p>
            </div>
        </div>

    </div>
</div>
