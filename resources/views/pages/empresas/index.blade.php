@extends('layouts.app')

@section('title', 'Portal de Análise de Empresas do Brasil')
@section('description', 'Explore dados e estatísticas de CNPJs. Encontre empresas por estado, cidade, atividade econômica, data de abertura e muito mais.')

@section('content')
<div class="bg-white mt-16">
    <div class="container mx-auto px-4 py-12">
        <div class="mt-16">
            <x-empresas.todos-os-estados />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-16">
            <div class="lg:col-span-1">
                <x-empresas.top-10-cidades :cidades="$top10Cidades" /> 
            </div>
            <div class="lg:col-span-1">
                <x-empresas.top-10-estados :estados="$top10Estados" /> 
            </div>
        </div>
        <div class="mt-16">
            <x-empresas.estados-mais-fechamentos :estados="$estadosMaisFechamentos" />
        </div>
        <div class="mt-16">
            <x-empresas.top-10-atividades :atividades="$top10Atividades" />
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-16">
            <div>
                <x-empresas.stats-abertas-fechadas :abertas="$statsAbertas" :fechadas="$statsFechadas" />
            </div>
        </div>
    </div>
</div>
@endsection

