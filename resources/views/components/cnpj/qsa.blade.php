<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    {{-- Cabeçalho Padrão --}}
    <div class="flex items-center p-6 border-b border-gray-200 bg-gray-50">
        <div class="w-12 h-12 flex-shrink-0 mr-4 flex items-center justify-center bg-red-100 rounded-full">
            <i class="bi bi-people-fill text-2xl text-[#ed1c24]"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Quadro de Sócios e Administradores (QSA)</h2>
            <p class="text-sm text-gray-500">Relação de sócios e responsáveis pela empresa.</p>
        </div>
    </div>

    {{-- Corpo do Card --}}
    <div class="p-0 md:p-0"> {{-- Padding removido para a tabela encostar nas bordas --}}
        @if (!empty($data['quadro_societario']))
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Qualificação
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Data de Entrada
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($data['quadro_societario'] as $socio)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $socio['nome'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $socio['qualificacao'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $socio['data_entrada'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="p-6 md:p-8 text-base text-gray-500">Não há informações sobre o quadro de sócios e administradores para esta empresa.</p>
        @endif
    </div>
</div>
