@extends('layouts.app')
@push('seo_tags')
    @include('components.consultarCnpj.tags')
@endpush
@section('content')
    <x-consultarCnpj.hero />
    <x-consultarCnpj.beneficios />
    <x-consultarCnpj.retorno-consulta />
    <x-consultarCnpj.outras-ferramentas />
    <x-consultarCnpj.nossos-servicos />
    <x-consultarCnpj.faq />
@if(session('error'))
    <x-popup-error message="{{ session('error') }}" title="Ocorreu um Erro" />
@endif
@endsection
