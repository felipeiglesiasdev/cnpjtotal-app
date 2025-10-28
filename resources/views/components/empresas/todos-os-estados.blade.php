@php
    $regioes = [
        'Norte' => [
            'AC' => 'Acre', 'AM' => 'Amazonas', 'AP' => 'Amapá', 'PA' => 'Pará', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'TO' => 'Tocantins'
        ],
        'Nordeste' => [
            'AL' => 'Alagoas', 'BA' => 'Bahia', 'CE' => 'Ceará', 'MA' => 'Maranhão', 'PB' => 'Paraíba', 'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RN' => 'Rio Grande do Norte', 'SE' => 'Sergipe'
        ],
        'Centro-Oeste' => [
            'DF' => 'Distrito Federal', 'GO' => 'Goiás', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul'
        ],
        'Sudeste' => [
            'ES' => 'Espírito Santo', 'MG' => 'Minas Gerais', 'RJ' => 'Rio de Janeiro', 'SP' => 'São Paulo'
        ],
        'Sul' => [
            'PR' => 'Paraná', 'RS' => 'Rio Grande do Sul', 'SC' => 'Santa Catarina'
        ]
    ];

@endphp

<div id="todos-os-estados" class="bg-white rounded-lg p-6 sm:p-8 scroll-mt-24">
    <div class="text-center mb-10">
        <h3 class="text-3xl font-bold text-neutral-900">Explore o Mapa Empresarial do Brasil</h3>
        <p class="text-neutral-900 mt-2 max-w-3xl mx-auto">
            Navegue por cada estado e descubra insights sobre o cenário de negócios local. Encontre empresas por cidade, atividade econômica (CNAE), data de abertura e muito mais. Uma ferramenta completa para sua análise de mercado.
        </p>
    </div>
    
    <div class="space-y-10"> <!-- Container para todas as regiões com espaçamento -->
        @foreach($regioes as $nomeRegiao => $estados)
            <div>
                <h4 class="text-xl font-bold text-neutral-800 mb-4 text-center border-b pb-2 border-gray-200">
                    Empresas na Região {{ $nomeRegiao }}
                </h4>
                <div class="flex justify-center flex-wrap gap-4 pt-4">
                    @foreach($estados as $uf => $nome)
                        <a href="{{ route('portal.por-uf', ['uf' => strtolower($uf)]) }}" 
                           class="group flex flex-col items-center justify-center text-center p-3 rounded-lg w-32 border border-red-200 transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl hover:bg-[#ED1C24] hover:border-red-700">
                            <span class="font-bold text-lg text-neutral-900 group-hover:text-white transition-colors duration-300">{{ $uf }}</span>
                            <span class="text-sm text-neutral-700 group-hover:text-gray-100 transition-colors duration-300 mt-1">{{ $nome }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

