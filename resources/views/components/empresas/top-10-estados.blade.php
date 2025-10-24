@props(['estados'])

@php
    $estadosNome = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
        'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
        'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
        'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
    ];
@endphp

<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full flex flex-col">
    {{-- Cabeçalho --}}
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-map-fill text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Estados em Destaque</h2>
            <p class="text-sm text-gray-500">Os 10 estados com mais empresas ativas.</p>
        </div>
    </div>

    {{-- Lista de Estados --}}
    <div class="space-y-1 flex-grow">
        @forelse ($estados as $estado)
             <a href="{{ route('portal.por-uf', ['uf' => strtolower($estado->uf)]) }}"
               class="group block p-2 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:shadow-md hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    {{-- Lado Esquerdo: Ranking e Nome --}}
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 w-8 h-8 text-sm font-bold text-white bg-[#ED1C24] rounded-full flex items-center justify-center shadow">
                           {{ $loop->iteration }}º
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 group-hover:text-red-700 transition-colors">
                               {{ $estadosNome[$estado->uf] ?? $estado->uf }}
                            </p>
                        </div>
                    </div>

                    {{-- Lado Direito: Total --}}
                    <span class="font-bold text-red-800 bg-red-100 rounded-full px-3 py-1 text-sm">
                        {{ number_format($estado->total, 0, ',', '.') }}
                    </span>
                </div>
            </a>
        @empty
            <div class="text-center py-8 text-gray-500">
                <p>Não foi possível carregar os estados.</p>
            </div>
        @endforelse
    </div>

    {{-- Botão "Veja todos" --}}
    <div class="mt-6 text-left border-t border-gray-200 pt-4">
        <a href="" class="group inline-flex items-center justify-center gap-2 rounded-lg bg-[#ED1C24] px-6 py-3 text-base font-semibold text-white shadow-md transition-colors duration-300 ease-in-out hover:bg-black">
            <span class="transition-transform duration-200 group-hover:-translate-y-0.5">Navegar por todos os estados</span>
            <i class="bi bi-arrow-right ml-1 transition-transform duration-200 group-hover:translate-x-1"></i>
        </a>
    </div>
</div>

