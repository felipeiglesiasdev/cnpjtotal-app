<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    {{-- Cabeçalho Padrão --}}
    <div class="flex items-center p-6 border-b border-gray-200 bg-gray-50">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-geo-alt-fill text-2xl text-[#ed1c24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Endereço</h2>
            <p class="text-sm text-gray-500">Localização oficial do estabelecimento.</p>
        </div>
    </div>

    {{-- Corpo do Card --}}
    <div class="p-6 md:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
            {{-- Logradouro --}}
            <div class="md:col-span-2">
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Logradouro</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['logradouro'] }}</dd>
            </div>

            {{-- Complemento --}}
            @if($data['complemento'])
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Complemento</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['complemento'] }}</dd>
            </div>
            @endif

            {{-- Bairro --}}
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Bairro</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['bairro'] }}</dd>
            </div>

            {{-- Cidade / UF --}}
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Cidade / UF</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['cidade_uf'] }}</dd>
            </div>

            {{-- CEP --}}
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">CEP</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800 font-mono">
                    {{-- Adicionado link para o CEP --}}
                    <a href="{{ route('portal.por-cep', ['cep' => preg_replace('/[^0-9]/', '', $data['cep'])]) }}"
                       class="text-[#ed1c24] hover:text-[#c11b21] hover:underline"
                       title="Ver empresas neste CEP">
                        {{ $data['cep'] }}
                    </a>
                </dd>
            </div>
        </dl>

        {{-- Link para o Google Maps (Botão padronizado) --}}
        <div class="mt-8 border-t border-gray-200 pt-6">
            <a href="{{ $data['google_maps_url'] }}"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center bg-[#171717] text-white font-medium py-2.5 px-6 rounded-full text-sm hover:bg-gray-700 transition-all duration-300 ease-out hover:-translate-y-1 transform">
                <i class="bi bi-map-fill mr-2"></i>
                Ver no Google Maps
            </a>
        </div>
    </div>
</div>
