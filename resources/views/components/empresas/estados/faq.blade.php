@props([
    'nomeEstado',
    'preposicao',
    'ufLower', // UF minúscula para links
    'nomeCapital',
    'kpis',
    'top5Atividades', // Top 5 atividades ainda podem ser úteis para contexto
    'faqDados' // Objeto com dados específicos: totalSupermercados, totalIndustrias, totalCapital, slugCapital
])

{{-- Formatação de número helper --}}
@php
function formatarNumero($num) {
    return number_format($num ?? 0, 0, ',', '.');
}
// Pega dados específicos do objeto faqDados
$totalSupermercados = $faqDados->totalSupermercados ?? 0;
$totalIndustrias = $faqDados->totalIndustrias ?? 0;
$totalCapital = $faqDados->totalCapital ?? 0;
$capitalSlug = $faqDados->slugCapital ?? Str::slug($nomeCapital);
$ufUpper = strtoupper($ufLower); // Para consistência
@endphp

{{-- Padding ajustado para p-6 md:p-8 --}}
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full" x-data="{ openFaq: null }">
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-patch-question-fill text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            {{-- Texto do título ajustado --}}
            <h2 class="text-2xl font-bold text-gray-800">Dúvidas Frequentes sobre Empresas {{ $preposicao }} {{ $nomeEstado }} ({{ $ufUpper }})</h2>
            <p class="text-base text-gray-700">Informações e respostas otimizadas para SEO.</p>
        </div>
    </div>

    <div class="space-y-6">
        {{-- Pergunta 1: Maiores Empresas --}}
        <div class="border-b border-gray-200 pb-4">
            {{-- Tamanho da fonte aumentado (text-base md:text-lg), cursor-pointer adicionado --}}
            <button @click="openFaq = (openFaq === 1 ? null : 1)" class="flex justify-between items-center w-full text-left cursor-pointer group">
                {{-- Cor do texto ajustada para #171717 / text-gray-800 --}}
                <span class="font-semibold text-[#171717] group-hover:text-[#ED1C24] transition-colors text-base md:text-lg">Quais são as <strong class="font-bold">maiores empresas de {{ $nomeEstado }}</strong>?</span>
                <i class="bi" :class="openFaq === 1 ? 'bi-chevron-up text-[#ED1C24]' : 'bi-chevron-down text-gray-500'"></i>
            </button>
            <div x-show="openFaq === 1" x-collapse class="mt-3 text-gray-800 text-base leading-relaxed">
                 <p>Embora nossa plataforma não classifique as <strong class="font-medium">maiores empresas de {{ $nomeEstado }}</strong> por receita, você pode identificar negócios relevantes explorando a <strong class="font-medium">lista de empresas em {{ strtolower($ufUpper) }}</strong> nos municípios mais populosos, como a capital <strong class="font-medium">{{ $nomeCapital }}</strong> (que possui cerca de {{ formatarNumero($totalCapital) }} <strong class="font-medium">empresas ativas</strong>) ou analisando os setores econômicos predominantes.</p>
            </div>
        </div>

        {{-- Pergunta 2: Supermercados --}}
        <div class="border-b border-gray-200 pb-4">
            <button @click="openFaq = (openFaq === 2 ? null : 2)" class="flex justify-between items-center w-full text-left cursor-pointer group">
                <span class="font-semibold text-[#171717] group-hover:text-[#ED1C24] transition-colors text-base md:text-lg">Existem quantos <strong class="font-bold">supermercados em {{ $nomeEstado }}</strong>?</span>
                 <i class="bi" :class="openFaq === 2 ? 'bi-chevron-up text-[#ED1C24]' : 'bi-chevron-down text-gray-500'"></i>
            </button>
            <div x-show="openFaq === 2" x-collapse class="mt-3 text-gray-800 text-base leading-relaxed">
                <p>O setor varejista é significativo {{ $preposicao }} {{ $nomeEstado }}. Atualmente, existem aproximadamente <strong class="font-medium">{{ formatarNumero($totalSupermercados) }} supermercados em {{ $nomeEstado }}</strong> registrados e ativos (CNAE 4711-3/02). Você pode encontrar uma <strong class="font-medium">lista de empresas em {{ strtolower($ufUpper) }}</strong> deste setor utilizando nossa ferramenta de busca por CNAE.</p>
            </div>
        </div>

        {{-- Pergunta 3: Indústrias --}}
        <div class="border-b border-gray-200 pb-4">
            <button @click="openFaq = (openFaq === 3 ? null : 3)" class="flex justify-between items-center w-full text-left cursor-pointer group">
                <span class="font-semibold text-[#171717] group-hover:text-[#ED1C24] transition-colors text-base md:text-lg">Existem quantas <strong class="font-bold">indústrias {{ $nomeEstado }}</strong>?</span>
                 <i class="bi" :class="openFaq === 3 ? 'bi-chevron-up text-[#ED1C24]' : 'bi-chevron-down text-gray-500'"></i>
            </button>
            <div x-show="openFaq === 3" x-collapse class="mt-3 text-gray-800 text-base leading-relaxed">
                <p>O estado conta com um número expressivo de <strong class="font-medium">indústrias {{ $nomeEstado }}</strong>. Nossa contagem indica cerca de <strong class="font-medium">{{ formatarNumero($totalIndustrias) }} empresas ativas</strong> classificadas em CNAEs industriais (como extrativismo, transformação e construção). A principal atividade econômica registrada entre as <strong class="font-medium">empresas em {{ $nomeEstado }}</strong> é "{{ $top5Atividades->first()->descricao ?? 'N/A' }}".</p>
                <p class="mt-1">Para explorar setores industriais específicos, utilize nossa <a href="{{ route('cnae.search') }}" class="text-[#ED1C24] hover:underline font-medium">consulta de CNAE</a>.</p>
            </div>
        </div>

         {{-- Pergunta 4: Empresas na Capital --}}
        <div class="border-b border-gray-200 pb-4">
            <button @click="openFaq = (openFaq === 4 ? null : 4)" class="flex justify-between items-center w-full text-left cursor-pointer group">
                <span class="font-semibold text-[#171717] group-hover:text-[#ED1C24] transition-colors text-base md:text-lg">Quantas <strong class="font-bold">empresas tem em {{ $nomeCapital }}</strong>?</span>
                 <i class="bi" :class="openFaq === 4 ? 'bi-chevron-up text-[#ED1C24]' : 'bi-chevron-down text-gray-500'"></i>
            </button>
            <div x-show="openFaq === 4" x-collapse class="mt-3 text-gray-800 text-base leading-relaxed">
                 {{-- Adiciona link para a página do município se o slug estiver disponível --}}
                <p>A capital, <strong class="font-medium">{{ $nomeCapital }}</strong>, é um polo importante de <strong class="font-medium">empresas {{ $preposicao }} {{ $nomeEstado }}</strong>. Atualmente, existem cerca de <strong class="font-medium">{{ formatarNumero($totalCapital) }} empresas ativas</strong> registradas na cidade.
                @if($capitalSlug)
                    Para acessar a <strong class="font-medium">lista de empresas em {{ $nomeCapital }}</strong>,
                    <a href="{{ route('portal.por-municipio', ['uf' => $ufLower, 'municipio_slug' => $capitalSlug]) }}" class="text-[#ED1C24] hover:underline font-medium">clique aqui</a>
                    ou navegue pela seção de municípios nesta página.
                @else
                    Para acessar a <strong class="font-medium">lista de empresas em {{ $nomeCapital }}</strong>, navegue até a seção de municípios nesta página e clique no link correspondente.
                @endif
                </p>
            </div>
        </div>


         {{-- Pergunta 5: Atualização dos Dados --}}
        <div> {{-- Último item sem borda inferior --}}
            <button @click="openFaq = (openFaq === 5 ? null : 5)" class="flex justify-between items-center w-full text-left cursor-pointer group">
                <span class="font-semibold text-[#171717] group-hover:text-[#ED1C24] transition-colors text-base md:text-lg">Os dados das <strong class="font-bold">empresas {{ $preposicao }} {{ $nomeEstado }}</strong> estão atualizados?</span>
                 <i class="bi" :class="openFaq === 5 ? 'bi-chevron-up text-[#ED1C24]' : 'bi-chevron-down text-gray-500'"></i>
            </button>
            <div x-show="openFaq === 5" x-collapse class="mt-3 text-gray-800 text-base leading-relaxed">
                 <p>Nossa base de dados sobre <strong class="font-medium">empresas em {{ strtolower($ufUpper) }}</strong> é atualizada periodicamente com informações públicas da Receita Federal. Embora busquemos a maior precisão possível para a <strong class="font-medium">lista de empresas em {{ $nomeEstado }}</strong>, pode haver um intervalo entre a atualização oficial e a nossa. Para dados 100% atualizados ou validação oficial, consulte diretamente a Receita Federal ou a Junta Comercial {{ $preposicao }} {{ $nomeEstado }}.</p>
            </div>
        </div>

    </div>
</div>

