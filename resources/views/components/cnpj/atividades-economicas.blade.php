<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    {{-- Cabeçalho Padrão --}}
    <div class="flex items-center p-6 border-b border-gray-200 bg-gray-50">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-briefcase-fill text-2xl text-[#ed1c24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Atividades Econômicas</h2>
            <p class="text-sm text-gray-500">Classificação Nacional de Atividades Econômicas (CNAE).</p>
        </div>
    </div>

    {{-- Corpo do Card --}}
    <div class="p-6 md:p-8">
        {{-- Atividade Principal --}}
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="text-base font-semibold text-gray-800 mb-4">Atividade Principal (CNAE)</h3>
            <dl class="grid grid-cols-1 sm:grid-cols-4 gap-x-6 gap-y-4">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Código</dt>
                    <dd class="mt-1 text-base text-gray-800 font-mono">
                        {{-- Adicionado link ao CNAE --}}
                        <a href="{{ route('cnae.show', ['cnae' => preg_replace('/[^0-9]/', '', $data['cnae_principal']['codigo'])]) }}"
                           class="text-[#ed1c24] hover:text-[#c11b21] hover:underline"
                           title="Ver detalhes sobre este CNAE">
                           {{ $data['cnae_principal']['codigo'] }}
                        </a>
                    </dd>
                </div>
                <div class="sm:col-span-3">
                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Descrição</dt>
                    <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['cnae_principal']['descricao'] }}</dd>
                </div>
            </dl>
        </div>

        {{-- Atividades Secundárias --}}
        @if (!empty($data['cnaes_secundarios']))
            <div class="mt-8">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Atividades Secundárias</h3>
                <ul class="space-y-5">
                    @foreach ($data['cnaes_secundarios'] as $cnae)
                        <li class="border-t border-gray-200 pt-5">
                            <dl class="grid grid-cols-1 sm:grid-cols-4 gap-x-6 gap-y-4">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Código</dt>
                                    <dd class="mt-1 text-base text-gray-800 font-mono">
                                        {{-- Adicionado link ao CNAE --}}
                                        <a href="{{ route('cnae.show', ['cnae' => preg_replace('/[^0-9]/', '', $cnae['codigo'])]) }}"
                                           class="text-[#ed1c24] hover:text-[#c11b21] hover:underline"
                                           title="Ver detalhes sobre este CNAE">
                                            {{ $cnae['codigo'] }}
                                        </a>
                                    </dd>
                                </div>
                                <div class="sm:col-span-3">
                                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Descrição</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-800">{{ $cnae['descricao'] }}</dd>
                                </div>
                            </dl>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
