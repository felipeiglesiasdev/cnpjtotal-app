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

<div class="bg-white rounded-xl shadow-lg border border-gray-100 mt-8 overflow-hidden">
    {{-- Cabeçalho do Card --}}
    <h2 class="text-2xl font-semibold text-[#171717] flex items-center bg-[#f1dada] p-4 border-b border-[#171717]">
        <i class="bi bi-building text-[#ed1c24] mr-3"></i>
        Informações Gerais
    </h2>
    
    {{-- Corpo do Card --}}
    <div class="p-6 sm:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            {{-- Razão Social --}}
            <div class="col-span-1 md:col-span-2">
                <dt class="text-sm font-bold text-black">Razão Social</dt>
                <dd class="mt-1 text-lg text-[#171717] font-semibold">{{ $data['razao_social'] }}</dd>
            </div>

            {{-- Nome Fantasia --}}
            @if($data['nome_fantasia'])
            <div>
                <dt class="text-sm font-bold text-black">Nome Fantasia</dt>
                <dd class="mt-1 text-lg text-[#171717] font-normal">{{ $data['nome_fantasia'] }}</dd>
            </div>
            @endif

            {{-- Tipo --}}
            <div>
                <dt class="text-sm font-bold text-black">Tipo</dt>
                <dd class="mt-1 text-lg text-[#171717] font-normal">{{ $data['matriz_ou_filial'] }}</dd>
            </div>

            {{-- CNPJ --}}
            <div>
                <dt class="text-sm font-bold text-black">CNPJ</dt>
                <dd class="mt-1 text-lg text-[#ed1c24]">{{ $data['cnpj_completo'] }}</dd>
            </div>

            {{-- Data de Abertura --}}
            <div>
                <dt class="text-sm font-bold text-black">Data de Abertura</dt>
                <dd class="mt-1 text-lg text-[#171717] font-normal">{{ $data['data_abertura'] }}</dd>
            </div>
            
            {{-- Idade --}}
            <div>
                <dt class="text-sm font-bold text-black">Tempo de Atividade</dt>
                <dd class="mt-1 text-lg text-[#171717] font-normal">{{ $idadeFormatada }}</dd>
            </div>
            
            {{-- Natureza Jurídica --}}
            <div>
                <dt class="text-sm font-bold text-black">Natureza Jurídica</dt>
                <dd class="mt-1 text-lg text-[#171717] font-normal">{{ $data['natureza_juridica'] }}</dd>
            </div>

            {{-- Porte --}}
            <div>
                <dt class="text-sm font-bold text-black">Porte</dt>
                <dd class="mt-1 text-lg text-[#171717] font-normal">{{ $data['porte'] }}</dd>
            </div>

            {{-- Capital Social --}}
            <div>
                <dt class="text-sm font-bold text-black">Capital Social</dt>
                <dd class="mt-1 text-lg text-[#171717] font-normal">R$ {{ $data['capital_social'] }}</dd>
            </div>
        </dl>
    </div>
</div>

