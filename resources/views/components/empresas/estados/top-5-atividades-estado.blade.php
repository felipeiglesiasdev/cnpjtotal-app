@props(['atividades', 'preposicao', 'nomeEstado'])

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

{{-- A classe h-full e flex flex-col ajudam a alinhar verticalmente --}}
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 h-full flex flex-col">
    {{-- Cabeçalho do Card --}}
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-graph-up-arrow text-2xl text-[#ED1C24]"></i>
        </div>
        <div>
            {{-- Título Alterado --}}
            <h2 class="text-2xl font-bold text-gray-800">Top 7 Atividades no Estado {{$preposicao}} {{$nomeEstado}}</h2>
            <p class="text-sm text-gray-500">Os 7 CNAEs mais comuns como atividade principal.</p>
        </div>
    </div>

    {{-- Lista de Atividades --}}
    {{-- A classe flex-grow e justify-between distribuem o espaço --}}
    <div class="space-y-6 flex-grow flex flex-col justify-between">
        <div class="space-y-3"> {{-- Div extra para controlar o espaçamento interno --}}
            @forelse ($atividades as $atividade)
                <a href="{{ route('cnae.show', ['cnae' => $atividade->codigo]) }}"
                   class="group block p-3 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:shadow-sm border border-transparent hover:border-gray-200">
                    
                    {{-- Layout Responsivo --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-x-0 sm:space-x-3 w-full">
    {{-- Círculo de Ranking (Menor) --}}
    <div class="flex-shrink-0 w-8 h-8 font-bold text-white bg-[#ED1C24] rounded-full flex items-center justify-center shadow text-sm mb-2 sm:mb-0">
        {{ $loop->iteration }}º
    </div>

    {{-- Infos --}}
    <div class="flex-grow">
        <p class="font-semibold text-sm text-gray-900 group-hover:text-red-700 transition-colors">
            CNAE {{ formatarCnae($atividade->codigo) }}
        </p>
        <p class="text-gray-700 text-base">
            {{ Str::limit($atividade->descricao) }}
        </p>
    </div>

    {{-- Direita (desktop) / Abaixo (mobile): Total --}}
    <div class="mt-2 sm:mt-0 text-right sm:text-left flex-shrink-0 sm:self-center sm:ml-auto">
        <span class="font-bold text-red-800 bg-red-100 rounded-full px-3 py-1 text-sm inline-block">
            {{ number_format($atividade->total, 0, ',', '.') }}
        </span>
    </div>
</div>

                    </div>
                </a>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <p>Não foi possível carregar as atividades econômicas para este estado.</p>
                </div>
            @endforelse
        </div>

        {{-- Botão de Ação --}}
        <div class="mt-6 text-left">
            <a href="{{ route('cnae.index') }}" 
               class="group inline-flex items-center justify-center gap-2 rounded-lg bg-[#ED1C24] px-6 py-3 text-base font-semibold text-white shadow-md transition-colors duration-300 ease-in-out hover:bg-black">
                <span class="transition-transform duration-200 group-hover:-translate-y-0.5">Consultar todos os CNAEs</span>
                <i class="bi bi-arrow-right ml-1 transition-transform duration-200 group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</div>
