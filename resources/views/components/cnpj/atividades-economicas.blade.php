<div class="bg-white rounded-xl shadow-lg border border-gray-100 mt-8 overflow-hidden">
    {{-- Cabeçalho do Card --}}
    <h2 class="text-2xl font-semibold text-[#171717] flex items-center bg-[#f1dada] p-4 border-b border-[#171717]">
        <i class="bi bi-briefcase-fill text-[#ed1c24] mr-3"></i>
        Atividades Econômicas
    </h2>

    {{-- Corpo do Card --}}
    <div class="p-6 sm:p-8">
        {{-- Atividade Principal --}}
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-bold text-black mb-4">Atividade Principal (CNAE)</h3>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div class="sm:col-span-1">
                    <p class="text-sm font-bold text-black">Código</p>
                    <p class="mt-1 text-base text-[#171717] font-mono">{{ $data['cnae_principal']['codigo'] }}</p>
                </div>
                <div class="sm:col-span-3">
                    <p class="text-sm font-bold text-black">Descrição</p>
                    <p class="mt-1 text-base text-[#171717]">{{ $data['cnae_principal']['descricao'] }}</p>
                </div>
            </div>
        </div>

        {{-- Atividades Secundárias --}}
        @if (!empty($data['cnaes_secundarios']))
            <div class="mt-8">
                <h3 class="text-lg font-bold text-black mb-4">Atividades Secundárias</h3>
                <ul class="space-y-4">
                    @foreach ($data['cnaes_secundarios'] as $cnae)
                        <li class="border-t border-gray-200 pt-4">
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-bold text-black">Código</p>
                                    <p class="mt-1 text-base text-[#171717] font-mono">{{ $cnae['codigo'] }}</p>
                                </div>
                                <div class="sm:col-span-3">
                                    <p class="text-sm font-bold text-black">Descrição</p>
                                    <p class="mt-1 text-base text-[#171717]">{{ $cnae['descricao'] }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

