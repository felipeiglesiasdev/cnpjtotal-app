<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    {{-- Cabeçalho Padrão --}}
    <div class="flex items-center p-6 border-b border-gray-200 bg-gray-50">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-telephone-fill text-2xl text-[#ed1c24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Contato</h2>
            <p class="text-sm text-gray-500">Informações de contato da empresa.</p>
        </div>
    </div>

    {{-- Corpo do Card --}}
    <div class="p-6 md:p-8">
        @if ($data['telefone_1'] || $data['telefone_2'] || $data['email'])
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                {{-- Telefone 1 --}}
                @if ($data['telefone_1'])
                    <div>
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Telefone</dt>
                        <dd class="mt-1 text-base font-semibold text-gray-800">
                            <a href="tel:+55{{ preg_replace('/[^0-9]/', '', $data['telefone_1']) }}"
                               rel="nofollow"
                               class="text-[#ed1c24] hover:text-[#c11b21] hover:underline transition-colors">
                                {{ $data['telefone_1'] }}
                            </a>
                        </dd>
                    </div>
                @endif

                {{-- Telefone 2 --}}
                @if ($data['telefone_2'])
                    <div>
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Telefone Secundário</dt>
                        <dd class="mt-1 text-base font-semibold text-gray-800">
                             <a href="tel:+55{{ preg_replace('/[^0-9]/', '', $data['telefone_2']) }}"
                                rel="nofollow"
                                class="text-[#ed1c24] hover:text-[#c11b21] hover:underline transition-colors">
                                {{ $data['telefone_2'] }}
                            </a>
                        </dd>
                    </div>
                @endif

                {{-- E-mail --}}
                @if ($data['email'])
                    <div class="md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">E-mail</dt>
                        <dd class="mt-1 text-base font-semibold text-gray-800 break-words">
                            <a href="mailto:{{ strtolower($data['email']) }}"
                               rel="nofollow"
                               class="text-[#ed1c24] hover:text-[#c11b21] hover:underline transition-colors">
                                {{ strtolower($data['email']) }}
                            </a>
                        </dd>
                    </div>
                @endif
            </dl>
        @else
            <p class="text-base text-gray-500">Nenhuma informação de contato pública foi encontrada para esta empresa.</p>
        @endif
    </div>
</div>
