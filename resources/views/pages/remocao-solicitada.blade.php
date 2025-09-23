@extends('layouts.app')

@push('seo_tags')
    <title>Solicitação Enviada com Sucesso | {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
@endpush

@section('content')
<div class="bg-white py-24 sm:py-32 mt-15">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <div class="text-6xl text-green-500 mb-4">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h1 class="text-4xl font-bold tracking-tight text-[#171717] sm:text-5xl">Solicitação Recebida!</h1>
            <p class="mt-6 text-lg leading-8 text-gray-600">
                Obrigado! Recebemos sua solicitação de remoção e nossa equipe já está analisando. Entraremos em contato através do e-mail fornecido em até 3 dias úteis.
            </p>
            <div class="mt-10">
                <a href="{{ route('home') }}" class="text-base font-semibold leading-7 text-[#ed1c24] hover:underline">
                    <span aria-hidden="true">&larr;</span> Voltar para a página inicial
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
