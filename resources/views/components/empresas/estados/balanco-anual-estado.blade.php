@props(['balanco' , 'nomeEstado', 'preposicao'])

<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full flex flex-col">
    {{-- Cabeçalho --}}
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-bar-chart-line-fill text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Balanço dos Últimos 4 Anos no estado {{ $preposicao }} {{ $nomeEstado }}</h2>
            <p class="text-sm text-gray-500">Empresas abertas VS Empresas encerradas.</p>
        </div>
    </div>

    {{-- Conteúdo com espaçamento --}}
    <div class="flex-grow grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
        
        @forelse($balanco as $ano => $stats)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <p class="text-center font-bold text-gray-600 mb-2">{{ $ano }}</p>
                <div class="flex justify-around items-center text-center">
                    {{-- Abertas --}}
                    <div>
                        <p class="text-xs font-semibold text-green-600 uppercase">ABERTAS</p>
                        <p class="text-2xl font-bold text-green-600">{{ number_format($stats['abertas'], 0, ',', '.') }}</p>
                    </div>
                    {{-- Divisor --}}
                    <div class="h-10 w-px bg-gray-300"></div>
                    {{-- Inativas --}}
                    <div>
                        <p class="text-xs font-semibold text-red-600 uppercase">ENCERRADAS</p>
                        <p class="text-2xl font-bold text-red-600">{{ number_format($stats['inativas'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @empty
             <div class="col-span-full text-center py-8 text-gray-500">
                <p>Não foi possível carregar o balanço anual.</p>
            </div>
        @endforelse
    </div>
</div>
