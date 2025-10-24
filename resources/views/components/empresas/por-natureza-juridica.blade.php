@props(['naturezas'])

<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full flex flex-col">
    {{-- Cabeçalho --}}
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-building text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Tipos de Empresa</h2>
            <p class="text-sm text-gray-500">As 10 naturezas jurídicas mais comuns.</p>
        </div>
    </div>

    {{-- Lista --}}
    <div class="space-y-4 flex-grow">
        @php
            $maiorValor = !empty($naturezas) && count($naturezas) > 0 ? ($naturezas[0]->total ?? 0) : 0;
        @endphp

        @forelse($naturezas as $natureza)
            <div>
                <div class="flex justify-between items-center mb-1">
                    {{-- Cor do texto alterada para um cinza mais escuro --}}
                    <span class="text-sm font-medium text-gray-800">{{ Str::limit($natureza->descricao, 35) }}</span>
                    <span class="text-sm font-semibold text-red-700">{{ number_format($natureza->total, 0, ',', '.') }}</span>
                </div>
                {{-- Barra de Progresso --}}
                @php
                    $percentage = ($maiorValor > 0) ? (($natureza->total ?? 0) / $maiorValor) * 100 : 0;
                @endphp
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-red-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
            </div>
        @empty
             <div class="text-center py-8 text-gray-500">
                <p>Não foi possível carregar os dados.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-6 text-left border-t border-gray-200 pt-4">
        <a href="#" 
           class="group inline-flex items-center justify-center gap-2 rounded-lg bg-[#ED1C24] px-6 py-3 text-base font-semibold text-white shadow-md transition-colors duration-300 ease-in-out hover:bg-black">
            <span class="transition-transform duration-200 group-hover:-translate-y-0.5">Explorar empresas por natureza jurídica</span>
            <i class="bi bi-arrow-right ml-1 transition-transform duration-200 group-hover:translate-x-1"></i>
        </a>
    </div>
</div>

