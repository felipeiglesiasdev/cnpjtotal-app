@extends('layouts.app')

@push('seo_tags')
    @include('components.cnae.tags', ['data' => $data])
@endpush

@section('content')
<div class="bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row lg:space-x-12">

            <!-- Conteúdo Principal -->
            <main class="w-full lg:flex-1">

                {{-- Bloco de Informações do CNAE --}}
                <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg border border-gray-100">
                    <span class="bg-[#f1dada] text-[#ed1c24] text-xl font-bold px-3 py-1 rounded-full">{{ $data['cnae_codigo'] }}</span>
                    <h1 class="mt-4 text-3xl font-bold tracking-tight text-[#171717] sm:text-4xl">{{ $data['cnae_descricao'] }}</h1>
                    <div class="mt-6 border-t pt-6">
                        <div class="flex items-center text-lg text-gray-700">
                             <i class="bi bi-patch-check-fill text-green-500 mr-3 text-2xl"></i>
                             <p><strong class="font-bold text-black">{{ $data['active_count_formatado'] }}</strong> empresas ativas encontradas com este CNAE principal.</p>
                        </div>
                    </div>
                </div>

                {{-- Lista de Empresas --}}
                <div class="mt-12">
                     <h2 class="text-3xl font-bold text-[#171717] mb-6">Empresas com esta Atividade</h2>
                     @if($data['estabelecimentos']->isEmpty())
                        <div class="text-center bg-white p-8 rounded-xl shadow-md border">
                            <p class="text-gray-600">Nenhuma empresa encontrada com este CNAE como atividade principal em nossa base de dados.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($data['estabelecimentos'] as $est)
                                <a href="{{ $est['link_cnpj'] }}" 
                                   class="block bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg hover:border-[#ed1c24] transition-all duration-300">
                                    <div class="flex flex-col sm:flex-row justify-between sm:items-center">
                                        <div>
                                            <h3 class="text-xl font-bold text-[#171717]">{{ $est['razao_social'] }}</h3>
                                            <p class="text-sm text-gray-500 mt-1">{{ $est['nome_fantasia'] ?? 'Sem nome fantasia' }}</p>
                                        </div>
                                        <div class="mt-4 sm:mt-0 text-left sm:text-right flex-shrink-0">
                                            <p class="text-base text-gray-700 font-mono">{{ $est['cnpj_formatado'] }}</p>
                                            <p class="text-sm text-gray-500">{{ $est['cidade_uf'] }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                         @if ($data['active_count'] > 30)
                            <div class="text-center bg-gray-100 p-6 rounded-xl mt-8 border border-gray-200">
                                <p class="text-gray-600">Exibindo uma amostra de 30 empresas. Existem <strong class="font-bold text-black">{{ $data['active_count_formatado'] }}</strong> empresas ativas no total com este CNAE.</p>
                            </div>
                        @endif
                    @endif
                </div>

            </main>

            <!-- Sidebar -->
            <div class="w-full lg:w-96 mt-12 lg:mt-0">
                 <div>
                    <x-cnae.sidebar />
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

