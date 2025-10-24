@props(['uf', 'nomeEstado', 'nomeMunicipio'])

<nav {{ $attributes->merge(['class' => 'text-sm mb-4 text-gray-500']) }}>
    <a href="{{ route('portal.index') }}" class="hover:text-red-700">Portal de Empresas</a>
    <span class="mx-2">/</span>
    <a href="{{ route('portal.por-uf', ['uf' => strtolower($uf)]) }}" class="hover:text-red-700">{{ $nomeEstado }}</a>
    <span class="mx-2">/</span>
    <span class="font-medium text-gray-700">{{ $nomeMunicipio }}</span>
</nav>
