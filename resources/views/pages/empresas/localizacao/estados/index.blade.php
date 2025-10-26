@extends('layouts.app')

@push('seo_tags')
    @include('components.empresas.estados.tags', [
        'nomeEstado' => $nomeEstado, 
        'preposicao' => $preposicao,
        'ufLower' => $ufLower
        ])
@endpush

@section('content')
<div class="bg-white mt-16">
    <div class="container mx-auto px-4 py-12">

        <div class="text-center mt-12">
            <h1 class="text-4xl font-bold text-gray-800">Empresas {{ $preposicao }} {{ $nomeEstado }} ({{ $uf }})</h1>
            <p class="text-lg text-gray-600 mt-2 max-w-4xl mx-auto">
                Uma análise completa do cenário empresarial {{ $preposicao }} {{ $nomeEstado }}. Encontre dados de CNPJs por município, veja as atividades mais comuns e explore o balanço de empresas ativas e encerradas no estado.
            </p>
        </div>

        <div class="mt-12">
           <x-empresas.estados.resumo-estado :kpis="$kpis" :totalMunicipiosAtivos="$totalMunicipiosAtivos" :nomeEstado="$nomeEstado" :preposicao="$preposicao" /> 
        </div>

        <div class="mt-12">
            <x-empresas.estados.lista-municipios :municipios="$listaMunicipios" :nomeEstado="$nomeEstado" :preposicao="$preposicao" />
        </div>

        <div class="mt-12">
            <x-empresas.estados.balanco-anual-estado :balanco="$balancoAnualEstado" :nomeEstado="$nomeEstado" :preposicao="$preposicao" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-12">
            <div class="lg:col-span-2">
                <x-empresas.estados.top-5-atividades-estado :atividades="$top5Atividades" :nomeEstado="$nomeEstado" :preposicao="$preposicao" />
            </div>
            <div class="lg:col-span-1">
                <x-empresas.estados.top-10-cidades-estado :cidades="$top10Cidades" :uf="$uf" />
            </div>
        </div>
        <div class="mt-12">
            <x-empresas.estados.ceps-aleatorios-estado :ceps="$cepsAleatorios" :uf="$uf" :nomeEstado="$nomeEstado" :preposicao="$preposicao"/>
        </div>
        <div class="mt-12">
            <x-empresas.estados.faq :nomeEstado="$nomeEstado" :preposicao="$preposicao" :ufLower="$ufLower" 
            :nomeCapital="$nomeCapital" :kpis="$kpis" :top5Atividades="$top5Atividades" :faqDados="$faqDados" />
        </div>
        <x-lgpd />
    </div>
</div>
@endsection

