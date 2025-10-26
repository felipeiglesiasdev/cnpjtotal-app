@props(['uf', 'nomeEstado', 'municipioSlug', 'nomeMunicipio', 'cepFormatado'])
@php
    $nomeMunicipioFormatado = Illuminate\Support\Str::title(strtolower($nomeMunicipio));
@endphp

<nav {{ $attributes->merge(['class' => 'text-sm mb-4 text-gray-500']) }}>
    <a href="{{ route('portal.index') }}" class="hover:text-red-700">Portal de Empresas</a>
    <span class="mx-2">/</span>
    <a href="{{ route('portal.por-uf', ['uf' => $uf]) }}" class="hover:text-red-700">{{ $nomeEstado }}</a>
    <span class="mx-2">/</span>
    {{-- Link para o município só existe se tivermos o slug --}}
    @if($municipioSlug)
        <a href="{{ route('portal.por-municipio', ['uf' => $uf, 'municipio_slug' => $municipioSlug]) }}" class="hover:text-red-700">{{ $nomeMunicipioFormatado }}</a>
        <span class="mx-2">/</span>
    @else
        {{-- Caso não ache o slug, mostra só o nome sem link --}}
        <span class="text-gray-700">{{ $nomeMunicipioFormatado }}</span>
        <span class="mx-2">/</span>
    @endif
    <span class="font-medium text-gray-700">CEP: {{ $cepFormatado }}</span>
</nav>
