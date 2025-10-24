@props(['municipios', 'nomeEstado', 'preposicao'])
<div id="lista-municipios" class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full">
    <div class="flex flex-col md:flex-row justify-between md:items-center mb-6">
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
                <i class="bi bi-list-columns text-2xl text-[#ED1C24]"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Navegue por todos os Município {{$preposicao}} {{$nomeEstado}}</h2>
                <p class="text-sm text-gray-500">Encontre empresas ativas em cada cidade.</p>
            </div>
        </div>      
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($municipios as $municipio)
            <a href="{{ route('portal.por-municipio', ['uf' => $municipio->uf, 'municipio_slug' => $municipio->municipio_slug]) }}"
               class="group block p-4 border border-gray-200 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:shadow-md hover:-translate-y-1">
                <p class="font-semibold text-gray-800 group-hover:text-red-700 truncate" title="{{ $municipio->descricao }}">
                    {{ $municipio->descricao }}
                </p>
                <p class="text-sm font-bold text-gray-600 mt-1">
                    {{ number_format($municipio->total, 0, ',', '.') }} <span class="font-normal text-gray-500">empresas</span>
                </p>
            </a>
        @empty
            <div class="col-span-full text-center py-8 text-gray-500">
                <p>Nenhum município com empresas ativas encontrado para este estado.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $municipios->fragment('lista-municipios')->links() }}
    </div>
</div>

