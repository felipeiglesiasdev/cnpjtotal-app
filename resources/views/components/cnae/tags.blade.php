@php
    $pageTitle = "CNAE " . $data['cnae_codigo'] . ' - ' . $data['cnae_descricao'] . ' | ' . 'CNPJ Total';
    $pageDescription = "Saiba tudo sobre o CNAE " . $data['cnae_codigo'] . " (" . $data['cnae_descricao'] . "). Veja quais atividades esta classificação abrange, consulte a lista de empresas e CNPJs deste ramo e acesse dados públicos e atualizados.";
    $keywords = $data['cnae_codigo'] . ", cnae " . $data['cnae_codigo'] . ", " . $data['cnae_descricao'] . ", consulta cnae, lista de empresas por cnae, atividade econômica, cnpj por cnae";
    $canonicalUrl = route('cnae.show', preg_replace('/\D/', '', $data['cnae_codigo']));
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:site_name" content="CNPJ Total">

{{-- Twitter --}}
<meta property="twitter:card" content="summary">
<meta property="twitter:url" content="{{ $canonicalUrl }}">
<meta property="twitter:title" content="{{ $pageTitle }}">
<meta property="twitter:description" content="{{ $pageDescription }}">
