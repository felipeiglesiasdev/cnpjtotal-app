@props(['estabelecimentos'])

<div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    CNPJ
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Razão Social 
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    CEP
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Capital Social
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($estabelecimentos as $estabelecimento)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <a href="{{ route('cnpj.show', ['cnpj' => $estabelecimento->cnpj_completo]) }}" class="text-red-600 hover:text-red-800 hover:underline" target="_blank">
                            {{ $estabelecimento->cnpj_completo_formatado }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-700">
                        <span class="font-medium">{{ $estabelecimento->empresa->razao_social ?? 'N/A' }}</span>
                    </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <a href="{{ route('portal.por-cep', ['cep' => $estabelecimento->cep]) }}" class="text-red-600 hover:text-red-800 hover:underline" target="_blank">
                                {{ $estabelecimento->cep_formatado ?? 'N/A' }}
                            </a>
                    </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                        {{ $estabelecimento->empresa->capital_social_formatado ?? 'N/A' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        Nenhuma empresa ativa encontrada para este município.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
