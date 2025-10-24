@props([
    'balanco2025',
    'statsSituacao',
    'top3AtividadesBrasil'
])

@php
// Helper para formatar números grandes
function formatarNumeroK($num) {
    if ($num >= 1000000) {
        return round($num / 1000000, 1) . 'M';
    } elseif ($num >= 1000) {
        return round($num / 1000, 0) . 'K';
    }
    return number_format($num ?? 0, 0, ',', '.'); // Adiciona formatação padrão para números menores
}

// Pega o total de empresas ativas
$totalAtivas = $statsSituacao['Ativa'] ?? 0;

@endphp

{{-- Seção CTA para o Portal de Empresas - Versão Sofisticada Branca --}}
<section {{ $attributes->merge(['class' => 'relative bg-white py-24 md:py-32 overflow-hidden']) }}>
    {{-- Elementos sutis de fundo (gradiente ou formas leves) --}}
    <div class="absolute inset-0 z-0">
         <div class="absolute top-0 left-0 w-1/2 h-full bg-gradient-to-r from-red-50/50 to-transparent opacity-50"></div>
         <div class="absolute bottom-0 right-0 w-1/3 h-1/2 bg-gradient-to-t from-gray-100/50 to-transparent opacity-70 rounded-full blur-3xl"></div>
    </div>

    <div class="relative container mx-auto px-6 z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Coluna de Texto --}}
            <div class="text-center lg:text-left">
                 <span class="text-sm font-semibold text-[#ed1c24] uppercase tracking-wider mb-2 inline-block">Portal de Análise</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    Mergulhe nos Dados Empresariais do Brasil
                </h2>
                 {{-- Texto escurecido --}}
                <p class="text-lg text-gray-700 mb-8 font-light max-w-xl mx-auto lg:mx-0">
                    Acesse estatísticas atualizadas, explore <strong class="font-semibold text-gray-800">empresas por estado e município</strong>, descubra tendências por atividade econômica (CNAE) e muito mais. Uma ferramenta poderosa para suas análises.
                </p>
                 <a href="{{ route('portal.index') }}"
                   class="inline-block bg-[#ed1c24] text-white font-bold py-3 px-10 rounded-full text-lg hover:bg-[#c11b21] transition-all transform hover:scale-105 duration-300 shadow-lg group relative overflow-hidden">
                    <span class="relative z-10 transition-transform duration-300 group-hover:-translate-y-px">
                        Acessar Portal de Análise
                    </span>
                    <span class="absolute inset-0 bg-white opacity-0 transition-opacity duration-300 group-hover:opacity-10"></span>
                    <i class="bi bi-arrow-right ml-2 relative z-10 transition-transform duration-300 group-hover:translate-x-1"></i>
                </a>
            </div>

            {{-- Coluna de "Preview" com Dados Reais --}}
            <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-200/80 rounded-2xl shadow-lg p-8 space-y-6 transition-all duration-500 hover:shadow-xl relative overflow-hidden">
                 {{-- Fundo sutil interno --}}
                 <div class="absolute -top-10 -right-10 w-40 h-40 bg-red-100/50 rounded-full filter blur-2xl opacity-70"></div>

                 <div class="relative z-10">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Brasil em Números (Prévia)</h3>

                    {{-- Indicador de Empresas Ativas --}}
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow-sm border border-gray-100 mb-4">
                        <div class="flex items-center">
                             <div class="w-10 h-10 flex-shrink-0 mr-3 flex items-center justify-center bg-green-100 rounded-full">
                                <i class="bi bi-building-check text-lg text-green-700"></i>
                            </div>
                             {{-- Texto escurecido --}}
                            <span class="text-base font-medium text-gray-700">Empresas Ativas</span>
                        </div>
                        <span class="text-2xl font-bold text-gray-900">{{ formatarNumeroK($totalAtivas) }}</span>
                    </div>

                     {{-- Balanço 2025 --}}
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow-sm border border-gray-100 mb-4">
                        <div class="flex items-center">
                             <div class="w-10 h-10 flex-shrink-0 mr-3 flex items-center justify-center bg-gray-100 rounded-full">
                                <i class="bi bi-calendar-check text-lg text-gray-700"></i>
                            </div>
                              {{-- Texto escurecido --}}
                             <span class="text-base font-medium text-gray-700">Balanço 2025 (Parcial)</span>
                        </div>
                        <div class="text-right">
                             <span class="block text-sm font-bold text-green-600">
                                +{{ formatarNumeroK($balanco2025['abertas']) }} <span class="text-xs font-normal text-gray-600">Abertas</span>
                             </span>
                              <span class="block text-sm font-bold text-red-600">
                                -{{ formatarNumeroK($balanco2025['encerradas_inativas']) }} <span class="text-xs font-normal text-gray-600">Inativas</span>
                             </span>
                        </div>
                    </div>

                    {{-- Ranking Top 3 Atividades --}}
                    <div class="p-4 bg-white rounded-lg shadow-sm border border-gray-100">
                         <div class="flex items-center mb-4"> {{-- Aumentado margin-bottom --}}
                             <div class="w-10 h-10 flex-shrink-0 mr-3 flex items-center justify-center bg-red-100 rounded-full">
                                <i class="bi bi-briefcase-fill text-lg text-[#ed1c24]"></i>
                            </div>
                            {{-- Texto escurecido --}}
                             <span class="text-base font-medium text-gray-700">Principais Atividades (Brasil)</span>
                        </div>
                        {{-- Lista Rankeada --}}
                        <div class="space-y-3 pl-2"> {{-- Adicionado padding left --}}
                            @forelse ($top3AtividadesBrasil as $atividade)
                                <div class="flex items-start">
                                    {{-- Ranking --}}
                                    <span class="mr-2 font-bold text-sm text-[#ed1c24]">{{ $loop->iteration }}º</span>
                                    {{-- Descrição e Total --}}
                                    <div>
                                         {{-- Texto escurecido --}}
                                        <p class="text-sm text-gray-700 leading-snug font-medium">
                                            {{ Str::limit($atividade->descricao, 55) }}
                                        </p>
                                         {{-- Texto escurecido --}}
                                        <p class="text-xs text-gray-500">
                                            ({{ formatarNumeroK($atividade->total) }} empresas)
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 pl-6">Dados de atividades indisponíveis.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

