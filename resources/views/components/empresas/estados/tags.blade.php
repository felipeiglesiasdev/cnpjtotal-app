@props(['nomeEstado', 'preposicao', 'nomeCapital', 'ufLower'])
<title>Lista de Empresas {{ $preposicao }} {{ $nomeEstado }} ({{ strtoupper($ufLower) }}) | CNPJ Total</title>
<meta name="description" content="Lista de empresas no estado {{ $preposicao }} {{ $nomeEstado }}. Consulte CNPJs ativos, descubra as principais atividades econômicas e veja os dados empresariais de todos os municípios, incluindo {{ $nomeCapital }}.">
<meta name="keywords" content="lista de empresas {{ $preposicao }} {{ $nomeEstado }}, lista de empresas no estado {{ $preposicao }} {{ $nomeEstado }}, empresas em {{ $ufLower }}, lista de empresas {{ $ufLower }}, lista de empresas em {{ $nomeCapital }}, consultar cnpj, lista de empresas">
<meta name="robots" content="index, follow">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="Lista de Empresas {{ $preposicao }} {{ $nomeEstado }} ({{ strtoupper($ufLower) }}) | CNPJ Total">
<meta property="og:description" content="Lista de empresas no estado {{ $preposicao }} {{ $nomeEstado }}. Consulte CNPJs ativos, descubra as principais atividades econômicas e veja os dados empresariais de todos os municípios, incluindo {{ $nomeCapital }}.">
<meta property="og:image" content="{{ asset('images/social.webp') }}">
<meta property="og:site_name" content="CNPJ Total">
<meta property="og:locale" content="pt_BR">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="Lista de Empresas {{ $preposicao }} {{ $nomeEstado }} ({{ strtoupper($ufLower) }}) | CNPJ Total">
<meta name="twitter:description" content="Lista de empresas no estado {{ $preposicao }} {{ $nomeEstado }}. Consulte CNPJs ativos, descubra as principais atividades econômicas e veja os dados empresariais de todos os municípios, incluindo {{ $nomeCapital }}.">
<meta name="twitter:image" content="{{ asset('images/social.webp') }}">
<link rel="canonical" href="{{ url()->current() }}" />