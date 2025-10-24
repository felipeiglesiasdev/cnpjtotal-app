@props(['kpis', 'nomeEstado', 'preposicao', 'totalMunicipiosAtivos'])

<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8">

    {{-- Layout de Duas Colunas (em telas grandes) --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Coluna da Esquerda: KPIs Compactos --}}
        <div>
            {{-- Seção Raio-X --}}
            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-1">Raio-X {{ $preposicao }} {{ $nomeEstado }}</h2>
                <p class="text-sm text-gray-500 mb-4">Um resumo dos dados empresariais {{ $preposicao }} estado.</p>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Total Ativas --}}
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="w-8 h-8 flex-shrink-0 mr-3 flex items-center justify-center bg-green-100 rounded-full">
                            <i class="bi bi-building-check text-lg text-green-700"></i>
                        </div>
                        <div>
                            {{-- Tamanho da fonte reduzido --}}
                            <div class="text-2xl font-bold text-gray-800">{{ number_format($kpis->total_ativas, 0, ',', '.') }}</div>
                            <div class="text-xs font-medium text-gray-500">Empresas Ativas</div>
                        </div>
                    </div>
                    {{-- Total Municípios --}}
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="w-8 h-8 flex-shrink-0 mr-3 flex items-center justify-center bg-gray-100 rounded-full">
                             <i class="bi bi-geo-alt-fill text-lg text-gray-700"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ number_format($totalMunicipiosAtivos, 0, ',', '.') }}</div>
                            <div class="text-xs font-medium text-gray-500">Municípios Ativos</div>
                        </div>
                    </div>
                    {{-- Total Matrizes --}}
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="w-8 h-8 flex-shrink-0 mr-3 flex items-center justify-center bg-gray-100 rounded-full">
                             <i class="bi bi-building-fill text-lg text-gray-700"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ number_format($kpis->total_matrizes, 0, ',', '.') }}</div>
                            <div class="text-xs font-medium text-gray-500">Matrizes</div>
                        </div>
                    </div>
                     {{-- Total Filiais --}}
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="w-8 h-8 flex-shrink-0 mr-3 flex items-center justify-center bg-gray-100 rounded-full">
                             <i class="bi bi-buildings text-lg text-gray-700"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-800">{{ number_format($kpis->total_filiais, 0, ',', '.') }}</div>
                            <div class="text-xs font-medium text-gray-500">Filiais</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Divisor (só aparece em telas pequenas) --}}
            <div class="border-t border-gray-200 my-6 lg:hidden"></div>

            {{-- Seção Balanço 2025 --}}
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-3">Balanço Parcial de 2025</h3>
                 <div class="grid grid-cols-1 gap-4">
                     {{-- Abertas em 2025 --}}
                    <div class="flex items-center p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="w-8 h-8 flex-shrink-0 mr-3 flex items-center justify-center bg-green-100 rounded-full">
                            <i class="bi bi-graph-up-arrow text-lg text-green-700"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-green-700">{{ number_format($kpis->abertas_2025_parcial, 0, ',', '.') }}</div>
                            <div class="text-xs font-medium text-green-600">Empresas Abertas em 2025</div>
                        </div>
                    </div>
                     {{-- Encerradas em 2025 --}}
                    <div class="flex items-center p-3 bg-red-50 border border-red-200 rounded-lg">
                        <div class="w-8 h-8 flex-shrink-0 mr-3 flex items-center justify-center bg-red-100 rounded-full">
                             <i class="bi bi-graph-down-arrow text-lg text-red-700"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-red-700">{{ number_format($kpis->fechadas_2025_parcial, 0, ',', '.') }}</div>
                            <div class="text-xs font-medium text-red-600">Empresas Encerradas em 2025</div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>

        {{-- Coluna da Direita: Formulário de Consulta --}}
        <div class="mt-8 lg:mt-0 lg:border-l lg:border-gray-200 lg:pl-8">
            <h2 class="text-xl font-bold text-gray-800 mb-1">Consultar outro CNPJ</h2>
            <p class="text-sm text-gray-500 mb-6">Digite um CNPJ para ver os detalhes da empresa.</p>

            <form action="{{ route('cnpj.consultar') }}" method="POST" id="form-cnpj-resumo-estado">
                @csrf
                <div class="relative w-full mb-3">
                   <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                       <i class="bi bi-search text-gray-400"></i>
                   </div>
                    <input
                        type="tel"
                        name="cnpj"
                        id="cnpj-input-resumo-estado"
                        class="w-full text-base pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#ed1c24]/50 focus:border-[#ed1c24] transition-colors duration-300"
                        placeholder="00.000.000/0000-00"
                        required>
                </div>
                <button type="submit" class="cursor-pointer w-full bg-[#ed1c24] text-white font-bold py-3 px-6 rounded-lg text-lg hover:bg-[#c11b21] hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#ed1c24]/50 flex items-center justify-center gap-2">
                    <span>Consultar</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>

    </div>
</div>


