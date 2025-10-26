@props(['nomeMunicipio', 'nomeEstado', 'uf'])
@php
    $ufLower = strtolower($uf);
    $municipioSlug = Illuminate\Support\Str::slug($nomeMunicipio);
    $canonicalUrl = route('portal.por-municipio', ['uf' => $ufLower, 'municipio_slug' => $municipioSlug]);
    $nomeMunicipioFormatado = Illuminate\Support\Str::title(strtolower($nomeMunicipio));
@endphp
<title>Lista de empresas em {{ $nomeMunicipioFormatado }} - {{ $uf }} | CNPJ Total</title>
<meta name="description" content="Lista de empresas em {{ $nomeMunicipioFormatado }}, {{ $nomeEstado }} ({{ $uf }}). Consulte CNPJs, atividades econômicas (CNAE) e dados cadastrais completos.">
<meta name="keywords" content="lista de empresas em {{ $nomeMunicipioFormatado }}, empresas em {{ $nomeMunicipioFormatado }}, cnpjs em {{ $nomeMunicipioFormatado }}, cnpj {{ $nomeMunicipioFormatado }}, {{ $nomeMunicipioFormatado }} {{ $uf }}, empresas {{ $uf }}, consulta cnpj, lista de cnpjs em {{ $nomeMunicipioFormatado }}, lista de cnpjs em {{ $uf }}, lista de empresas em {{ $nomeEstado }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $canonicalUrl }}" />
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="Lista de empresas em {{ $nomeMunicipioFormatado }} - {{ $uf }} | CNPJ Total">
<meta property="og:description" content="Lista de empresas ativas em {{ $nomeMunicipio }}, {{ $nomeEstado }} ({{ $uf }}). Consulte CNPJs, atividades econômicas (CNAE) e dados cadastrais completos.">
<meta property="og:image" content="{{ asset('images/social.webp') }}"> 
<meta property="og:site_name" content="CNPJ Total">
<meta property="og:locale" content="pt_BR">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $canonicalUrl }}">
<meta name="twitter:title" content="Lista de empresas em {{ $nomeMunicipioFormatado }} - {{ $uf }} | CNPJ Total">
<meta name="twitter:description" content="Lista de empresas ativas em {{ $nomeMunicipio }}, {{ $nomeEstado }} ({{ $uf }}). Consulte CNPJs, atividades econômicas (CNAE) e dados cadastrais completos.">
<meta name="twitter:image" content="{{ asset('images/social.webp') }}"> 