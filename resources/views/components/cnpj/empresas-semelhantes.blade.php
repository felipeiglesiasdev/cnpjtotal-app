@if (!empty($data['empresas_semelhantes']))
<div class="bg-white rounded-xl shadow-lg border border-gray-100 mt-8 overflow-hidden">
    {{-- Cabeçalho do Card --}}
    <h2 class="text-2xl font-semibold text-[#171717] flex items-center bg-[#f1dada] p-4 border-b border-[#171717]">
        <i class="bi bi-diagram-3-fill text-[#ed1c24] mr-3"></i>
        Empresas Semelhantes
    </h2>

    {{-- Corpo do Card --}}
    <div class="p-6 sm:p-8">
        <p class="text-base text-[#171717] mb-6">
            Explore outras empresas que atuam no mesmo ramo de <strong class="font-semibold">{{ strtolower($data['similar_context']['cnae_descricao']) }}</strong> na região de <strong class="font-semibold">{{ $data['similar_context']['cidade'] }}</strong>.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($data['empresas_semelhantes'] as $empresa)
                <a href="{{ $empresa['url'] }}" class="block p-4 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 hover:border-gray-300 transition-all duration-300 group">
                    <p class="font-semibold text-black truncate group-hover:text-[#ed1c24]">{{ $empresa['razao_social'] }}</p>
                    <p class="text-sm text-gray-600 flex items-center mt-1">
                        <i class="bi bi-geo-alt-fill mr-2"></i>
                        {{ $empresa['cidade_uf'] }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif