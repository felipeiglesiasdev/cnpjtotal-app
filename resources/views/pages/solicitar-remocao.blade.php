@extends('layouts.app')

@push('seo_tags')
    <title>Solicitar Remoção de CNPJ | {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
@endpush

@section('content')
<div class="bg-white py-12 sm:py-16">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h1 class="text-4xl font-bold tracking-tight text-[#171717] sm:text-5xl">Solicitação de Remoção de CNPJ</h1>
            <p class="mt-6 text-lg leading-8 text-gray-600">
                Para iniciar o processo de remoção dos dados deste CNPJ de nossa plataforma, por favor, preencha o formulário abaixo. Nossa equipe analisará a solicitação e entrará em contato em até 3 dias úteis.
            </p>
        </div>

        {{-- Alerta de Erro de Validação --}}
        @if ($errors->any())
            <div class="max-w-xl mx-auto mt-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Ocorreram alguns erros:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        {{-- Alerta de Erro Geral --}}
        @if(session('error'))
            <div class="max-w-xl mx-auto mt-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Ocorreu um erro!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="max-w-xl mx-auto mt-8">
            <form action="{{ route('remocao.store') }}" method="POST" class="space-y-6">
                @csrf
                {{-- Adiciona o CNPJ bruto como um campo oculto para envio --}}
                <input type="hidden" name="cnpj" value="{{ $cnpj_raw }}">
                
                <div>
                    <label for="cnpj_display" class="block text-sm font-semibold leading-6 text-gray-900">CNPJ</label>
                    <div class="mt-2.5">
                        {{-- Este campo é apenas para exibição --}}
                        <input type="text" name="cnpj_display" id="cnpj_display" value="{{ $cnpj_formatado }}" readonly class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 bg-gray-100 cursor-not-allowed focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="nome_solicitante" class="block text-sm font-semibold leading-6 text-gray-900">Seu nome completo</label>
                    <div class="mt-2.5">
                        <input type="text" name="nome_solicitante" id="nome_solicitante" value="{{ old('nome_solicitante') }}" autocomplete="name" required class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="email_solicitante" class="block text-sm font-semibold leading-6 text-gray-900">Seu e-mail de contato</label>
                    <div class="mt-2.5">
                        <input type="email" name="email_solicitante" id="email_solicitante" value="{{ old('email_solicitante') }}" autocomplete="email" required class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="motivo" class="block text-sm font-semibold leading-6 text-gray-900">Motivo da Solicitação</label>
                    <div class="mt-2.5">
                        <textarea name="motivo" id="motivo" rows="4" required class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">{{ old('motivo') }}</textarea>
                    </div>
                </div>

                <div class="mt-10">
                    <button type="submit" class="w-full bg-[#ed1c24] text-white font-bold py-3 px-8 rounded-full text-lg hover:bg-[#c11b21] transition-all transform hover:scale-105 duration-300 shadow-lg flex items-center justify-center">
                        <i class="bi bi-send-fill mr-2"></i>
                        Enviar Solicitação
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

