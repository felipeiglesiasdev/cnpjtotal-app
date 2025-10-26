@extends('layouts.app')
@push('seo_tags')
    {{-- 
      Inclui o novo componente de tags.
      Todas essas variáveis ($cep, $cepFormatado, $nomeMunicipio, $nomeEstado, $uf)
      já estão vindo do $viewData que o Cache::get() retorna.
    --}}
    @include('components.empresas.cep.tags', [
        'cep' => $cep,
        'cepFormatado' => $cepFormatado,
        'nomeMunicipio' => $nomeMunicipio,
        'nomeEstado' => $nomeEstado,
        'uf' => $uf
    ])
@endpush
@section('content')
<div class="bg-white mt-16">
    <div class="container mx-auto px-4 py-12">

        {{-- Componente Breadcrumbs --}}
        <x-empresas.cep.breadcrumbs
            :uf="$ufLower"
            :nomeEstado="$nomeEstado"
            :municipioSlug="$municipioSlug"
            :nomeMunicipio="$nomeMunicipio"
            :cepFormatado="$cepFormatado"
        />

        {{-- Componente Header --}}
        <x-empresas.cep.header
            :cepFormatado="$cepFormatado"
            :nomeMunicipio="$nomeMunicipio"
            :uf="$uf"
            :totalEmpresas="$estabelecimentos->total()"
        />

        {{-- Componente Tabela de Empresas --}}
        <x-empresas.cep.tabela-empresas :estabelecimentos="$estabelecimentos" />

        {{-- Paginação --}}
        <div class="mt-8">
            {{ $estabelecimentos->links('vendor.pagination.tailwind') }}
        </div>

        {{-- Componente FAQ (Opcional - Pode criar um específico ou usar um genérico) --}}
        {{-- <x-empresas.cep.faq /> --}}

    </div>
</div>
@endsection
