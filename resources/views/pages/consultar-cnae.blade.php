@extends('layouts.app')

@push('seo_tags')
    @include('components.consultarCep.tags')
@endpush

@section('content')
    <x-consultarCnae.hero />
    <x-consultarCnae.outras-ferramentas />
    <x-consultarCnpj.nossos-servicos />
    <x-consultarCnae.faq />
@endsection

