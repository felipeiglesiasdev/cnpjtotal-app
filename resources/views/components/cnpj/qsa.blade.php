<div class="bg-white rounded-xl shadow-lg border border-gray-100 mt-8 overflow-hidden">
    {{-- Cabeçalho do Card --}}
    <h2 class="text-2xl font-semibold text-[#171717] flex items-center bg-[#f1dada] p-4 border-b border-[#171717]">
        <i class="bi bi-people-fill text-[#ed1c24] mr-3"></i>
        Quadro de Sócios e Administradores (QSA)
    </h2>

    {{-- Corpo do Card --}}
    <div class="p-6 sm:p-8">
        @if (!empty($data['quadro_societario']))
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-black uppercase tracking-wider">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-black uppercase tracking-wider">
                                Qualificação
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-black uppercase tracking-wider">
                                Data de Entrada
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($data['quadro_societario'] as $socio)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-lg text-[#171717]">{{ $socio['nome'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg text-[#171717]">{{ $socio['qualificacao'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg text-[#171717]">{{ $socio['data_entrada'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-lg text-gray-500">Não há informações sobre o quadro de sócios e administradores para esta empresa.</p>
        @endif
    </div>
</div>