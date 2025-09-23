
@extends('layouts.app')
@push('seo_tags')
    @include('components.cnpj.tags', ['data' => $data])
@endpush


@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 ">
            {{-- Coluna Principal de Conteúdo --}}
            <main class="lg:col-span-8 mt-12 space-y-8">
                <x-cnpj.intro-text :data="$data" />
                <x-cnpj.informacoes-cnpj :data="$data" />
                <x-cnpj.situacao-cadastral :data="$data" />
                <x-cnpj.atividades-economicas :data="$data" />
                <x-cnpj.endereco :data="$data" />
                <x-cnpj.contato :data="$data" />
                <x-cnpj.qsa :data="$data" />
                <x-cnpj.empresas-semelhantes :data="$data" />
                <x-cnpj.remocao :data="$data" />
            </main>
            
            {{-- Barra Lateral --}}
            <aside class="lg:col-span-4 mt-12 lg:mt-0">
                <div class="sticky top-24 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Nova Consulta</h2>
                    <p class="text-gray-600 mb-6">Deseja consultar outro CNPJ?</p>
                    <form action="{{ route('cnpj.consultar') }}" method="POST" novalidate>
                        @csrf
                        <div class="relative w-full mb-4">
                           <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                               <i class="bi bi-search text-gray-400"></i>
                           </div>
                            <input 
                                type="tel" 
                                name="cnpj" 
                                id="cnpj-input-aside" 
                                class="w-full text-lg pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#ed1c24]/50 focus:border-[#ed1c24] transition-colors duration-300" 
                                placeholder="00.000.000/0000-00"
                                required>
                        </div>
                        <button type="submit" class="cursor-pointer w-full bg-[#ed1c24] text-white font-bold py-3 px-6 rounded-lg text-lg hover:bg-[#c11b21] hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#ed1c24]/50 flex items-center justify-center gap-2">
                            <span>Consultar</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Máscara para o campo de CNPJ na barra lateral --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cnpjInput = document.getElementById('cnpj-input-aside');
        if (cnpjInput) {
            const mask = IMask(cnpjInput, { mask: '00.000.000/0000-00' });
            const form = cnpjInput.closest('form');
            if (form) {
                form.addEventListener('submit', function() { mask.updateValue(); });
            }
        }
    });
</script>
@endpush


