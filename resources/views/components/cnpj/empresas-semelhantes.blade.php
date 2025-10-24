@if (!empty($data['empresas_semelhantes']))
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    {{-- Cabeçalho Padrão --}}
    <div class="flex items-center p-6 border-b border-gray-200 bg-gray-50">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
           <i class="bi bi-diagram-3-fill text-2xl text-[#ed1c24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Empresas Semelhantes</h2>
            <p class="text-sm text-gray-500">Negócios no mesmo ramo e região.</p>
        </div>
    </div>

    {{-- Corpo do Card --}}
    <div class="p-6 md:p-8">
        <p class="text-base text-gray-700 mb-6">
            Explore outras empresas que atuam no mesmo ramo de <strong class="font-semibold text-gray-800">{{ strtolower($data['similar_context']['cnae_descricao']) }}</strong> na região de <strong class="font-semibold text-gray-800">{{ $data['similar_context']['cidade'] }}</strong>.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($data['empresas_semelhantes'] as $empresa)
                <a href="{{ $empresa['url'] }}" class="block p-4 bg-gray-50 border border-gray-200 rounded-lg hover:bg-white hover:border-[#ed1c24] transition-all duration-300 group hover:shadow-md">
                    <p class="font-semibold text-gray-800 truncate group-hover:text-[#ed1c24] transition-colors">{{ $empresa['razao_social'] }}</p>
                    <p class="text-sm text-gray-500 flex items-center mt-1">
                        <i class="bi bi-geo-alt-fill mr-2 text-gray-400"></i>
                        {{ $empresa['cidade_uf'] }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif
