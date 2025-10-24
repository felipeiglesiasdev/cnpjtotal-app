@php
    try {
        $dataAbertura = \Carbon\Carbon::createFromFormat('d/m/Y', $data['data_abertura']);
        $idade = $dataAbertura->diff(\Carbon\Carbon::now());

        $partesIdade = [];
        if ($idade->y > 0) {
            $partesIdade[] = $idade->y . ($idade->y > 1 ? ' anos' : ' ano');
        }
        if ($idade->m > 0) {
            $partesIdade[] = $idade->m . ($idade->m > 1 ? ' meses' : ' mês');
        }
        if ($idade->d > 0 && empty($partesIdade)) {
             $partesIdade[] = $idade->d . ($idade->d > 1 ? ' dias' : ' dia');
        }

        $idadeFormatada = !empty($partesIdade) ? implode(' e ', $partesIdade) : 'Menos de um dia';

    } catch (\Exception $e) {
        $idadeFormatada = 'Data inválida';
    }
@endphp

{{-- Card padronizado --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    {{-- Cabeçalho Padrão --}}
    <div class="flex items-center p-6 border-b border-gray-200 bg-gray-50">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-building-check text-2xl text-[#ed1c24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Informações Gerais</h2>
            <p class="text-sm text-gray-500">Dados cadastrais da empresa.</p>
        </div>
    </div>

    {{-- Corpo do Card --}}
    <div class="p-6 md:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
            {{-- Razão Social --}}
            <div class="col-span-1 md:col-span-2">
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Razão Social</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['razao_social'] }}</dd>
            </div>

            {{-- Nome Fantasia --}}
            @if($data['nome_fantasia'])
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Nome Fantasia</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['nome_fantasia'] }}</dd>
            </div>
            @endif

            {{-- Tipo --}}
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tipo</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['matriz_ou_filial'] }}</dd>
            </div>

            {{-- CNPJ --}}
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">CNPJ</dt>
                <dd class="mt-1 text-base font-semibold text-[#ed1c24] font-mono">{{ $data['cnpj_completo'] }}</dd>
            </div>

            {{-- Data de Abertura --}}
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Data de Abertura</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['data_abertura'] }}</dd>
            </div>

            {{-- Idade --}}
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tempo de Atividade</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $idadeFormatada }}</dd>
            </div>

            {{-- Natureza Jurídica --}}
            <div class="md:col-span-2">
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Natureza Jurídica</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['natureza_juridica'] }}</dd>
            </div>

            {{-- Porte --}}
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Porte</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">{{ $data['porte'] }}</dd>
            </div>

            {{-- Capital Social --}}
            <div>
                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Capital Social</dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">R$ {{ $data['capital_social'] }}</dd>
            </div>
        </dl>
    </div>
</div>
