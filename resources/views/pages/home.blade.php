@extends('layouts.app')

@push('seo_tags')
    @include('components.home.tags')
@endpush

@section('title', 'Consulta CNPJ e CNAE Grátis — Dados da Receita Federal')

@push('styles')
<style>
    /* Animação das Bolhas */
    @keyframes rise {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 0;
        }
        10%, 90% {
            opacity: 0.4;
        }
        100% {
            transform: translateY(-120vh) rotate(720deg);
            opacity: 0;
        }
    }

    .ball {
        position: absolute;
        bottom: -200px;
        background-color: #ed1c24;
        border-radius: 50%;
        animation: rise 25s infinite linear;
    }
</style>
@endpush


@section('content')

{{-- Seção Hero com animação --}}
<div class="relative bg-[#171717] text-white overflow-hidden">
    {{-- Container para as bolas da animação --}}
    <div class="absolute inset-0 z-0">
        <div class="ball" style="left: 10%; width: 40px; height: 40px; animation-duration: 14s; animation-delay: 0s;"></div>
        <div class="ball" style="left: 20%; width: 20px; height: 20px; animation-duration: 12s; animation-delay: 2s;"></div>
        <div class="ball" style="left: 30%; width: 60px; height: 60px; animation-duration: 21s; animation-delay: 4s;"></div>
        <div class="ball" style="left: 40%; width: 30px; height: 30px; animation-duration: 13s; animation-delay: 1s;"></div>
        <div class="ball" style="left: 50%; width: 80px; height: 80px; animation-duration: 20; animation-delay: 5s;"></div>
        <div class="ball" style="left: 60%; width: 25px; height: 25px; animation-duration: 14s; animation-delay: 3s;"></div>
        <div class="ball" style="left: 70%; width: 45px; height: 45px; animation-duration: 19s; animation-delay: 6s;"></div>
        <div class="ball" style="left: 80%; width: 55px; height: 55px; animation-duration: 23s; animation-delay: 8s;"></div>
        <div class="ball" style="left: 90%; width: 35px; height: 35px; animation-duration: 16s; animation-delay: 7s;"></div>
    </div>

    {{-- Conteúdo da Hero Section --}}
    <div class="relative container mx-auto px-6 lg:px-8 py-28 md:py-40 text-center z-10">
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight leading-tight mb-4">
            A forma mais simples de consultar CNPJ e CNAE
        </h1>
        <p class="max-w-3xl mx-auto text-lg text-gray-300 mb-8 font-light">
            Acesse dados públicos e atualizados da Receita Federal de maneira gratuita, rápida e sem complicações.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('cnpj.index') }}" class="w-full sm:w-auto bg-[#ed1c24] text-white font-bold py-3 px-8 rounded-full text-lg hover:bg-[#c11b21] transition-all transform hover:scale-105 duration-300 shadow-lg">
                <i class="bi bi-search mr-2"></i> Consultar CNPJ
            </a>
            <a href="{{ route('cnae.index') }}" class="w-full sm:w-auto bg-gray-700 text-white font-bold py-3 px-8 rounded-full text-lg hover:bg-gray-600 transition-all transform hover:scale-105 duration-300">
                Consultar CNAE
            </a>
        </div>
    </div>
</div>

{{-- Seção de Vantagens/Recursos --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-semibold">Por que usar nossa plataforma?</h2>
            <p class="text-gray-600 mt-2 text-lg">Focamos no que realmente importa: velocidade, precisão e simplicidade.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            {{-- Card 1 --}}
            <div class="text-center p-8 bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 transform">
                <div class="flex items-center justify-center h-20 w-20 rounded-full bg-red-100 text-[#ed1c24] mx-auto mb-5">
                    <i class="bi bi-shield-check text-4xl"></i>
                </div>
                <h3 class="text-2xl font-medium mb-3">Dados Confiáveis</h3>
                <p class="text-gray-600">Informações atualizadas e sincronizadas diretamente com a base de dados da Receita Federal.</p>
            </div>
             {{-- Card 2 --}}
            <div class="text-center p-8 bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 transform">
                <div class="flex items-center justify-center h-20 w-20 rounded-full bg-red-100 text-[#ed1c24] mx-auto mb-5">
                    <i class="bi bi-speedometer2 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-medium mb-3">Consulta Rápida</h3>
                <p class="text-gray-600">Nossa interface otimizada garante que você obtenha os dados que precisa em questão de segundos.</p>
            </div>
             {{-- Card 3 --}}
            <div class="text-center p-8 bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 transform">
                <div class="flex items-center justify-center h-20 w-20 rounded-full bg-red-100 text-[#ed1c24] mx-auto mb-5">
                     <i class="bi bi-gift-fill text-4xl"></i>
                </div>
                <h3 class="text-2xl font-medium mb-3">100% Gratuito</h3>
                <p class="text-gray-600">Acesse de forma ilimitada, sem custos ou necessidade de cadastro para as consultas essenciais.</p>
            </div>
        </div>
    </div>
</section>

@endsection

