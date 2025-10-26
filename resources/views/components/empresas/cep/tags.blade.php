@props(['cep', 'cepFormatado', 'nomeMunicipio', 'nomeEstado', 'uf'])

@php
    $nomeMunicipioFormatado = Illuminate\Support\Str::title(strtolower($nomeMunicipio));
    $canonicalUrl = route('portal.por-cep', ['cep' => $cep]);
@endphp

<title>Empresas no CEP {{ $cepFormatado }} em {{ $nomeMunicipioFormatado }} - {{ $uf }} | CNPJ Total</title>
<meta name="description" content="Lista de empresas ativas localizadas no CEP {{ $cepFormatado }} ({{ $nomeMunicipioFormatado }}, {{ $nomeEstado }}). Consulte CNPJs, atividades e dados cadastrais completos.">
<meta name="keywords" content="empresas no CEP {{ $cepFormatado }}, cnpj cep {{ $cep }}, {{ $cep }}, lista de empresas {{ $cepFormatado }}, cep {{ $cep }} {{ $nomeMunicipioFormatado }}, empresas em {{ $nomeMunicipioFormatado }}, cnpj por cep">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $canonicalUrl }}" />
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="Empresas no CEP {{ $cepFormatado }} em {{ $nomeMunicipioFormatado }} - {{ $uf }} | CNPJ Total">
<meta property="og:description" content="Lista de empresas ativas localizadas no CEP {{ $cepFormatado }} ({{ $nomeMunicipioFormatado }}, {{ $nomeEstado }}). Consulte CNPJs, atividades e dados cadastrais completos.">
<meta property="og:image" content="{{ asset('images/share.webp') }}">
<meta property="og:site_name" content="CNPJ Total">
<meta property="og:locale" content="pt_BR">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $canonicalUrl }}">
<meta name="twitter:title" content="Empresas no CEP {{ $cepFormatado }} em {{ $nomeMunicipioFormatado }} - {{ $uf }} | CNPJ Total">
<meta name="twitter:description" content="Lista de empresas ativas localizadas no CEP {{ $cepFormatado }} ({{ $nomeMunicipioFormatado }}, {{ $nomeEstado }}). Consulte CNPJs, atividades e dados cadastrais completos.">
<meta name="twitter:image" content="{{ asset('images/share.webp') }}">