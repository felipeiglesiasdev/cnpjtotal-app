@extends('layouts.app')

@section('title', 'Consultar Empresas por CEP')
@section('description', 'Encontre empresas ativas em um CEP específico. Insira o CEP e veja a lista de CNPJs registrados no endereço.')

@section('content')
<div class="bg-gray-100 min-h-screen py-16">
    <div class="container mx-auto px-4">

        <div class="max-w-xl mx-auto bg-white rounded-lg shadow-lg p-8 md:p-12 border border-gray-200">

            {{-- Cabeçalho --}}
            <div class="text-center mb-8">
                 <div class="inline-block bg-red-100 p-3 rounded-full mb-4">
                     <i class="bi bi-mailbox2 text-3xl text-[#ED1C24]"></i>
                 </div>
                <h1 class="text-3xl font-bold text-gray-800">Consultar Empresas por CEP</h1>
                <p class="text-gray-600 mt-2">Digite um CEP (apenas números) para ver a lista de empresas ativas registradas nele.</p>
            </div>

            {{-- Formulário de Consulta --}}
            <form action="{{ route('cep.consultar.submit') }}" method="GET" class="space-y-6">
                {{-- Campo CEP --}}
                <div>
                    <label for="cep" class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                    <input type="text" name="cep" id="cep-input" {{-- ID para o iMask --}}
                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#ED1C24] focus:border-[#ED1C24] placeholder-gray-400"
                           placeholder="Digite os 8 dígitos do CEP"
                           maxlength="9" {{-- Com o traço --}}
                           required
                           pattern="[0-9]{8}" {{-- Validação HTML5 para 8 dígitos --}}
                           title="Digite apenas os 8 números do CEP.">
                    {{-- Mensagem de erro (se houver validação no backend) --}}
                     @error('cep')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botão de Envio --}}
                <div>
                    <button type="submit"
                            class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#ED1C24] hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out group">
                        Consultar CEP
                        <i class="bi bi-search ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </form>

             {{-- Link para o Portal --}}
            <div class="text-center mt-8">
                <a href="{{ route('portal.index') }}" class="text-sm text-gray-500 hover:text-red-700 hover:underline">
                    &larr; Voltar ao Portal de Empresas
                </a>
            </div>

        </div>

    </div>
</div>

@endsection
