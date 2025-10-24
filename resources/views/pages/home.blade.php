@extends('layouts.app')
@push('seo_tags')
    @include('components.home.tags')
@endpush
@section('content')
<!-- HERO COM CALL-TO-ACTION -->

<x-home.hero />
<x-home.consultas />
<x-home.nossos-servicos />
<x-home.portal :balanco2025="$balanco2025" :statsSituacao="$statsSituacao" :top3AtividadesBrasil="$top3AtividadesBrasil" />


@endsection

