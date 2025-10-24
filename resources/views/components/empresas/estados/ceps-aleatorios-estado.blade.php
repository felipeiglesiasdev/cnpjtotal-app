@props(['ceps', 'uf', 'nomeEstado', 'preposicao'])

@php
// Helper function to format CEP code, to keep the template clean.
function formatarCep($cep) {
    if (!$cep || strlen($cep) < 8) return $cep;
    // Formato: XXXXX-XXX
    return sprintf('%s-%s',
        substr($cep, 0, 5),
        substr($cep, 5, 3)
    );
}
@endphp

<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full">
    {{-- Cabeçalho --}}
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-map text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            {{-- Texto alterado para refletir a nova lógica --}}
            <h2 class="text-2xl font-bold text-gray-800">Empresas por CEP no estado {{ $preposicao }} {{ $nomeEstado }}</h2>
            <p class="text-sm text-gray-500">Uma amostra aleatória de 6 CEPs de empresas ativas no estado {{ $preposicao }} {{ $nomeEstado }}.</p>
        </div>
    </div>

    {{-- Grid de 2 Linhas por 3 Colunas --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
        @forelse($ceps as $cep => $cnpjs)
            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 flex flex-col">
                {{-- Título do CEP --}}
                <a href="{{ route('portal.por-cep', ['cep' => $cep]) }}" 
                   class="font-bold text-lg text-gray-800 hover:text-red-700 hover:underline mb-2 pb-2 border-b border-gray-300">
                    <i class="bi bi-pin-map-fill text-red-600"></i>
                    CEP: {{ formatarCep($cep) }}
                </a>
                
                {{-- Lista de CNPJs --}}
                <ul class="space-y-1.5 text-sm flex-grow">
                    @foreach($cnpjs as $cnpj)
                        <li>
                            {{-- CORREÇÃO APLICADA AQUI: Passando o parâmetro 'cnpj' explicitamente pelo nome --}}
                            <a href="{{ route('cnpj.show', ['cnpj' => $cnpj->cnpj_completo]) }}" 
                               class="text-gray-700 hover:text-red-700 hover:underline"
                               title="{{ $cnpj->empresa->razao_social ?? 'Razão Social Indisponível' }}">
                                {{ ($cnpj->empresa->razao_social) }} - {{ ($cnpj->CnpjCompletoFormatado) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                 {{-- Botão "Ver todos" --}}
                 <a href="{{ route('portal.por-cep', ['cep' => $cep]) }}" 
                   class="mt-3 text-xs font-semibold text-red-600 hover:text-red-800 transition-colors duration-200 self-start">
                    Ver todos no CEP &rarr;
                </a>
            </div>
        @empty
            <div class="col-span-full text-center py-8 text-gray-500">
                <p>Não foi possível carregar os CEPs aleatórios para este estado.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-6 text-left border-t border-gray-200 pt-4">
        <a href="#" 
           class="group inline-flex items-center justify-center gap-2 rounded-lg bg-[#ED1C24] px-6 py-3 text-base font-semibold text-white shadow-md transition-colors duration-300 ease-in-out hover:bg-black">
            <span class="transition-transform duration-200 group-hover:-translate-y-0.5">Consultar empresas por CEP</span>
            <i class="bi bi-arrow-right ml-1 transition-transform duration-200 group-hover:translate-x-1"></i>
        </a>
    </div>
</div>

