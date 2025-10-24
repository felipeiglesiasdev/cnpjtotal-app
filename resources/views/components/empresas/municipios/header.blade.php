@props(['uf', 'nomeEstado', 'nomeMunicipio', 'totalEmpresas'])
<h1 class="text-3xl font-bold text-gray-800">Empresas em {{ $nomeMunicipio }} - {{ $uf }}</h1>
<p class="text-lg text-gray-600 mt-1">Lista de CNPJs ativos registrados neste município.</p>
<p class="text-sm text-gray-500 mt-2">Total: <strong>{{ number_format($totalEmpresas, 0, ',', '.') }}</strong> empresas ativas encontradas.</p>

