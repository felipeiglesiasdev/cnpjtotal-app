@props(['cepFormatado', 'nomeMunicipio', 'uf', 'totalEmpresas'])

<header {{ $attributes->merge(['class' => 'mb-8']) }}>
    <h1 class="text-3xl font-bold text-gray-800">Empresas no CEP {{ $cepFormatado }}</h1>
    <p class="text-lg text-gray-600 mt-1">
        Localizadas em <span class="font-medium">{{ $nomeMunicipio }} - {{ $uf }}</span>.
    </p>
    <p class="text-sm text-gray-500 mt-2">Total: <strong>{{ number_format($totalEmpresas, 0, ',', '.') }}</strong> empresas ativas encontradas neste CEP.</p>
</header>
