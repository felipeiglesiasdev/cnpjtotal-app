@php
    // Lógica para classes do Tailwind, removendo a necessidade do @push('styles')
    $classeStatus = '';
    $iconeStatus = '';

    switch ($data['situacao_cadastral']) {
        case 'ATIVA':
            $classeStatus = 'text-green-600';
            $iconeStatus = '<i class="bi bi-check-circle-fill mr-2"></i>';
            break;
        case 'SUSPENSA':
            $classeStatus = 'text-amber-600';
            $iconeStatus = '<i class="bi bi-exclamation-triangle-fill mr-2"></i>';
            break;
        case 'BAIXADA':
        case 'NULA':
        case 'INAPTA':
            $classeStatus = 'text-red-600';
            $iconeStatus = '<i class="bi bi-x-circle-fill mr-2"></i>';
            break;
        default:
            $classeStatus = 'text-gray-600';
            $iconeStatus = '<i class="bi bi-question-circle-fill mr-2"></i>';
    }
@endphp

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    {{-- Cabeçalho Padrão --}}
    <div class="flex items-center p-6 border-b border-gray-200 bg-gray-50">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-patch-check-fill text-2xl text-[#ed1c24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Situação Cadastral</h2>
            <p class="text-sm text-gray-500">Status atual da empresa na Receita Federal.</p>
        </div>
    </div>

    {{-- Corpo do Card --}}
    <div class="p-6 md:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Status</dt>
                <dd class="mt-1 text-lg font-semibold flex items-center {{ $classeStatus }}">
                    {!! $iconeStatus !!} {{-- Exibe o ícone e o texto --}}
                    <span>{{ $data['situacao_cadastral'] }}</span>
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Data da Situação</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['data_situacao_cadastral'] }}</dd>
            </div>
        </dl>
    </div>
</div>

{{-- Bloco @push('styles') removido pois as classes agora são Tailwind --}}
