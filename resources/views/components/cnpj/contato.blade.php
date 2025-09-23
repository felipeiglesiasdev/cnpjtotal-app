<div class="bg-white rounded-xl shadow-lg border border-gray-100 mt-8 overflow-hidden">
    {{-- Cabeçalho do Card --}}
    <h2 class="text-2xl font-semibold text-[#171717] flex items-center bg-[#f1dada] p-4 border-b border-[#171717]">
        <i class="bi bi-telephone-fill text-[#ed1c24] mr-3"></i>
        Contato
    </h2>

    {{-- Corpo do Card --}}
    <div class="p-6 sm:p-8">
        @if ($data['telefone_1'] || $data['telefone_2'] || $data['email'])
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- Telefone 1 --}}
                @if ($data['telefone_1'])
                    <div>
                        <dt class="text-sm font-bold text-black">Telefone</dt>
                        <dd class="mt-1 text-lg text-[#171717]">
                            <a href="tel:+55{{ preg_replace('/[^0-9]/', '', $data['telefone_1']) }}" 
                               rel="nofollow" 
                               class="underline hover:text-[#ed1c24] transition-colors">
                                {{ $data['telefone_1'] }}
                            </a>
                        </dd>
                    </div>
                @endif

                {{-- Telefone 2 --}}
                @if ($data['telefone_2'])
                    <div>
                        <dt class="text-sm font-bold text-black">Telefone Secundário</dt>
                        <dd class="mt-1 text-lg text-[#171717]">
                             <a href="tel:+55{{ preg_replace('/[^0-9]/', '', $data['telefone_2']) }}" 
                               rel="nofollow" 
                               class="underline hover:text-[#ed1c24] transition-colors">
                                {{ $data['telefone_2'] }}
                            </a>
                        </dd>
                    </div>
                @endif

                {{-- E-mail --}}
                @if ($data['email'])
                    <div class="md:col-span-2">
                        <dt class="text-sm font-bold text-black">E-mail</dt>
                        <dd class="mt-1 text-lg text-[#171717] break-words">
                            <a href="mailto:{{ $data['email'] }}" 
                               rel="nofollow" 
                               class="underline hover:text-[#ed1c24] transition-colors">
                                {{ $data['email'] }}
                            </a>
                        </dd>
                    </div>
                @endif
            </dl>
        @else
            <p class="text-lg text-gray-500">Nenhuma informação de contato pública foi encontrada para esta empresa.</p>
        @endif
    </div>
</div>

