@props(['cidades', 'uf'])

{{-- Componente: Top 10 Cidades do Estado --}}
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full flex flex-col">
    {{-- Cabeçalho --}}
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-geo-alt-fill text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Top 10 Cidades ({{$uf}})</h2>
            <p class="text-sm text-gray-500">Municípios com mais empresas ativas.</p>
        </div>
    </div>

    {{-- Lista de Cidades --}}
    <div class="space-y-2 flex-grow">
        @forelse($cidades as $cidade)
            <a href="{{ route('portal.por-municipio', ['uf' => $cidade->uf, 'municipio_slug' => $cidade->municipio_slug]) }}" 
               class="group flex items-center justify-between p-2.5 rounded-lg transition-all duration-200 hover:bg-gray-50 hover:shadow-sm">
                
                <div class="flex items-center">
                    {{-- Ranking --}}
                    <div class="flex-shrink-0 w-8 h-8 font-bold text-sm text-white bg-[#ED1C24] rounded-full flex items-center justify-center shadow-sm">
                        {{ $loop->iteration }}º
                    </div>
                    {{-- Nome da Cidade --}}
                    <span class="ml-3 font-medium text-gray-700 group-hover:text-red-700">
                        {{ ucwords(strtolower($cidade->nome)) }}
                    </span>
                </div>

                {{-- Total --}}
                <span class="font-bold text-sm text-gray-800 bg-gray-100 rounded-full px-2.5 py-0.5">
                    {{ number_format($cidade->total, 0, ',', '.') }}
                </span>
            </a>
        @empty
            <div class="text-center py-8 text-gray-500">
                <p>Não há dados de cidades para este estado.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-6 text-left">
        <a href="" 
            class="group inline-flex items-center justify-center gap-2 rounded-lg bg-[#ED1C24] px-6 py-3 text-base font-semibold text-white shadow-md transition-colors duration-300 ease-in-out hover:bg-black">
            <span class="transition-transform duration-200 group-hover:-translate-y-0.5">Ver Lista Completa</span>
            <i class="bi bi-arrow-up ml-1 transition-transform duration-200 group-hover:translate-x-1"></i>
        </a>
    </div>
</div>

