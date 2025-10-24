@props(['atividades'])

@php
// Helper function to format CNAE code, to keep the template clean.
function formatarCnae($codigo) {
    if (!$codigo) return 'N/A';
    $codigo = str_pad($codigo, 7, '0', STR_PAD_LEFT);
    // Formato: XX.XX-X/XX
    return sprintf('%s.%s-%s/%s',
        substr($codigo, 0, 2),
        substr($codigo, 2, 2),
        substr($codigo, 4, 1),
        substr($codigo, 5, 2)
    );
}
@endphp

<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full flex flex-col">
    {{-- Cabeçalho do Card --}}
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            {{-- Ícone do Bootstrap Icons --}}
            <i class="bi bi-graph-up-arrow text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Principais Atividades no Brasil</h2>
            <p class="text-sm text-gray-500">Os 10 setores mais comuns como atividade principal.</p>
        </div>
    </div>

    {{-- Lista de Atividades --}}
    <div class="space-y-3 flex-grow">
        @forelse ($atividades as $atividade)
            <a href="{{ route('cnae.show', ['cnae' => $atividade->codigo]) }}"
               class="group block p-4 rounded-lg border border-transparent transition-all duration-300 hover:bg-gray-50 hover:shadow-md hover:border-red-100 hover:-translate-y-1">
                
                {{-- Flex container that changes direction based on screen size --}}
                <div class="flex flex-col sm:flex-row sm:items-start sm:gap-4">
                    {{-- Círculo de Ranking --}}
                    <div class="flex-shrink-0 w-10 h-10 mb-2 sm:mb-0 font-bold text-white bg-[#ED1C24] rounded-full flex items-center justify-center shadow">
                       {{ $loop->iteration }}º
                    </div>

                    {{-- Conteúdo Principal --}}
                    <div class="flex flex-col flex-grow">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-baseline">
                             {{-- Código CNAE e Descrição --}}
                            <div class="flex-grow">
                                <p class="font-semibold text-sm text-gray-800 font-mono group-hover:text-red-700 transition-colors">
                                    CNAE {{ formatarCnae($atividade->codigo) }}
                                </p>
                                <p class="text-gray-700 text-base mt-1">
                                    {{ $atividade->descricao }}
                                </p>
                            </div>
                             {{-- Etiqueta com Total (embaixo no mobile, na direita no desktop) --}}
                            <div class="mt-2 sm:mt-0 sm:ml-4 flex-shrink-0 self-start sm:self-center">
                                 <span class="font-bold text-red-800 bg-red-100 rounded-full px-3 py-1 text-sm">
                                    {{ number_format($atividade->total, 0, ',', '.') }}
                                 </span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-8 text-gray-500">
                <p>Não foi possível carregar as atividades econômicas.</p>
            </div>
        @endforelse
    </div>
    
    {{-- Botão de Ação --}}
    <div class="mt-6 text-left border-t border-gray-200 pt-4">
        <a href="#" 
           class="group inline-flex items-center justify-center gap-2 rounded-lg bg-[#ED1C24] px-6 py-3 text-base font-semibold text-white shadow-md transition-colors duration-300 ease-in-out hover:bg-black">
            <span class="transition-transform duration-200 group-hover:-translate-y-0.5">Consultar todos os CNAEs</span>
            <i class="bi bi-arrow-right ml-1 transition-transform duration-200 group-hover:translate-x-1"></i>
        </a>
    </div>
</div>

