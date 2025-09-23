<div class="bg-white rounded-xl shadow-lg border border-gray-100 mt-8 overflow-hidden">
    {{-- Cabeçalho do Card --}}
    <h2 class="text-2xl font-semibold text-[#171717] flex items-center bg-[#f1dada] p-4 border-b border-[#171717]">
        <i class="bi bi-patch-check-fill text-[#ed1c24] mr-3"></i>
        Situação Cadastral
    </h2>

    {{-- Corpo do Card --}}
    <div class="p-6 sm:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            <div>
                <dt class="text-sm font-bold text-black">Status</dt>
                <dd class="mt-1 text-lg font-semibold flex items-center {{ $data['situacao_cadastral_classe'] }}">
                    @if ($data['situacao_cadastral'] === 'ATIVA')
                        <i class="bi bi-check-circle-fill mr-2"></i>
                    @endif
                    <span>{{ $data['situacao_cadastral'] }}</span>
                </dd>
            </div>
            <div>
                <dt class="text-sm font-bold text-black">Data da Situação</dt>
                <dd class="mt-1 text-lg text-[#171717] font-normal">{{ $data['data_situacao_cadastral'] }}</dd>
            </div>
        </dl>
    </div>
</div>

{{-- Bloco de Estilos para as classes de status --}}
@push('styles')
<style>
    .status-active {
        color: #16a34a; /* Verde */
    }
    .status-suspended {
        color: #d97706; /* Laranja */
    }
    .status-inactive {
        color: #dc2626; /* Vermelho */
    }
</style>
@endpush

