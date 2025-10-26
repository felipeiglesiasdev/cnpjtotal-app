@extends('layouts.app')

@push('seo_tags')
    @include('components.empresas.municipios.tags', [
        'nomeMunicipio' => $nomeMunicipio,
        'nomeEstado' => $nomeEstado,
        'uf' => $uf
    ])
@endpush

@section('content')
<div class="bg-white mt-16">
    <div class="container mx-auto px-4 py-12">
        <x-empresas.municipios.breadcrumbs :uf="$uf" :nomeEstado="$nomeEstado" :nomeMunicipio="$nomeMunicipio" />
        <x-empresas.municipios.header :uf="$uf" :nomeEstado="$nomeEstado" :nomeMunicipio="$nomeMunicipio" :totalEmpresas="$estabelecimentos->total()" />
        <x-empresas.municipios.tabela-empresas :estabelecimentos="$estabelecimentos" />
        <div class="mt-8">{{ $estabelecimentos->links('vendor.pagination.tailwind') }}</div>
        <div class="mt-12">
            <x-empresas.municipios.faq :nomeMunicipio="$nomeMunicipio" :nomeEstado="$nomeEstado" :uf="$uf" :totalEmpresas="$estabelecimentos->total()" />
        </div>
    </div>
</div>
@endsection



