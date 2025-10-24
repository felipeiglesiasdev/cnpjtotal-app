@props(['estados'])

@php
    // Mapa para exibir o nome completo dos estados
    $estadosNome = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
        'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
        'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
        'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
    ];
@endphp

<div class="bg-white py-8">
    {{-- Textos amigáveis e otimizados para SEO --}}
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Os 3 estados com mais empresas baixadas em 2024</h2>
        <p class="text-md text-gray-600 mt-2 max-w-2xl mx-auto">
            Veja um panorama da dinâmica do mercado, com os estados que mais registraram baixas de CNPJ no último ano, conforme dados da Receita Federal.
        </p>
    </div>

    {{-- Grid com 3 Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse ($estados as $estado)
            {{-- Card individual agora com borda e sombra --}}
            <div class="bg-white p-6 text-center rounded-lg shadow-md border border-gray-200">
                <p class="font-bold text-lg text-gray-800">{{ $estadosNome[$estado->uf] ?? $estado->uf }}</p>
                <p class="text-5xl font-bold text-[#ED1C24] my-2">{{ number_format($estado->total, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">empresas baixadas em 2024</p>
            </div>
        @empty
            <div class="md:col-span-3 bg-white p-6 rounded-lg text-center border border-gray-200">
                <p class="text-gray-500">Não foi possível carregar os dados de empresas baixadas.</p>
            </div>
        @endforelse
    </div>
</div>

