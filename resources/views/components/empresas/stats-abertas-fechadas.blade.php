@props(['abertas', 'fechadas'])

{{-- A classe h-full e flex-col garantem que o card ocupe a altura total e que os itens internos sejam empilhados --}}
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full flex flex-col">
    {{-- Cabeçalho --}}
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-bar-chart-line-fill text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Balanço Anual</h2>
            <p class="text-sm text-gray-500">Empresas abertas vs. inativas nos últimos anos.</p>
        </div>
    </div>

    {{-- Conteúdo com espaçamento --}}
    {{-- As classes flex-grow e justify-around distribuem o espaço vertical entre os anos --}}
    <div class="flex-grow flex flex-col justify-around gap-4">
        @foreach($abertas as $ano => $totalAbertas)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <p class="text-center font-bold text-gray-600 mb-2">{{ $ano }}</p>
                <div class="flex justify-around items-center text-center">
                    {{-- Abertas --}}
                    <div>
                        <p class="text-xs font-semibold text-green-600 uppercase">ABERTAS</p>
                        <p class="text-2xl font-bold text-green-600">{{ number_format($totalAbertas, 0, ',', '.') }}</p>
                    </div>
                    {{-- Divisor --}}
                    <div class="h-10 w-px bg-gray-300"></div>
                    {{-- Inativas --}}
                    <div>
                        <p class="text-xs font-semibold text-red-600 uppercase">INATIVAS</p>
                        <p class="text-2xl font-bold text-red-600">{{ number_format($fechadas[$ano] ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

