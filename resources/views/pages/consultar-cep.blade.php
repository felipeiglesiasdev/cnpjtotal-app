@extends('layouts.app')
@push('seo_tags')
    @include('components.consultarCep.tags')
@endpush
@section('content')
    <x-consultarCep.hero />
    <x-consultarCep.beneficios />
    <x-consultarCnpj.nossos-servicos />
    <x-consultarCep.outras-ferramentas />
    <x-consultarCep.faq />
@if(session('error'))
    <x-popup-error message="{{ session('error') }}" title="Ocorreu um Erro" />
@endif
@endsection
