<div class="bg-white rounded-xl shadow-lg border border-gray-100 mt-8 overflow-hidden">
    {{-- Cabeçalho do Card --}}
    <h2 class="text-2xl font-semibold text-[#171717] flex items-center bg-[#f1dada] p-4 border-b border-[#171717]">
        <i class="bi bi-geo-alt-fill text-[#ed1c24] mr-3"></i>
        Endereço
    </h2>

    {{-- Corpo do Card --}}
    <div class="p-6 sm:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            {{-- Logradouro --}}
            <div class="md:col-span-2">
                <dt class="text-sm font-bold text-black">Logradouro</dt>
                <dd class="mt-1 text-lg text-[#171717]">{{ $data['logradouro'] }}</dd>
            </div>

            {{-- Complemento --}}
            @if($data['complemento'])
            <div>
                <dt class="text-sm font-bold text-black">Complemento</dt>
                <dd class="mt-1 text-lg text-[#171717]">{{ $data['complemento'] }}</dd>
            </div>
            @endif

            {{-- Bairro --}}
            <div>
                <dt class="text-sm font-bold text-black">Bairro</dt>
                <dd class="mt-1 text-lg text-[#171717]">{{ $data['bairro'] }}</dd>
            </div>

            {{-- Cidade / UF --}}
            <div>
                <dt class="text-sm font-bold text-black">Cidade / UF</dt>
                <dd class="mt-1 text-lg text-[#171717]">{{ $data['cidade_uf'] }}</dd>
            </div>

            {{-- CEP --}}
            <div>
                <dt class="text-sm font-bold text-black">CEP</dt>
                <dd class="mt-1 text-lg text-[#171717]">{{ $data['cep'] }}</dd>
            </div>
        </dl>

        {{-- Link para o Google Maps --}}
        <div class="mt-6 border-t border-gray-200 pt-6">
            <a href="{{ $data['google_maps_url'] }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="inline-flex items-center text-white bg-[#171717] hover:bg-#252525 hover:text-[#fff] py-2 px-4 rounded-lg transition-colors duration-300 ">
                <i class="bi bi-map-fill mr-2"></i>
                Ver no Google Maps
            </a>
        </div>
    </div>
</div>

