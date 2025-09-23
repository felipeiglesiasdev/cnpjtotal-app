@extends('layouts.app')

@push('seo_tags')
    <title>Consultar CNAE por Código ou Atividade | {{ config('app.name') }}</title>
    <meta name="description" content="Utilize nossa ferramenta gratuita para buscar e consultar códigos CNAE (Classificação Nacional de Atividades Econômicas) por número ou descrição da atividade.">
@endpush

@section('content')

<div class="bg-white py-12 sm:py-16 mt-12">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h1 class="text-4xl font-bold tracking-tight text-[#171717] sm:text-5xl">Consulta de CNAE</h1>
            <p class="mt-6 text-lg leading-8 text-gray-600">
                Digite um código ou parte da descrição da atividade econômica para encontrar o CNAE correspondente. Os resultados aparecerão em tempo real.
            </p>
        </div>

        <div class="max-w-2xl mx-auto mt-10" 
             x-data="{ 
                search: '', 
                results: [], 
                loading: false,
                open: false,
                // Define a URL base da rota de exibição, com um placeholder
                cnaeShowUrl: '{{ route('cnae.show', ['cnae' => 'CNAE_PLACEHOLDER']) }}',
                fetchResults() {
                    if (this.search.length < 2) {
                        this.results = [];
                        this.open = false;
                        return;
                    }
                    this.loading = true;
                    fetch(`{{ route('cnae.search') }}?q=${this.search}`)
                        .then(response => response.json())
                        .then(data => {
                            this.results = data;
                            this.loading = false;
                            this.open = this.results.length > 0;
                        });
                }
             }"
             @click.away="open = false">

            <!-- Formulário de Busca -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="bi bi-search text-gray-400"></i>
                </div>
                <input 
                    type="text"
                    x-model="search"
                    @input.debounce.300ms="fetchResults()"
                    @focus="open = true"
                    placeholder="Ex: 4781-4/00 ou Comércio varejista"
                    class="block w-full rounded-full border-0 py-4 pl-10 pr-4 text-gray-900 shadow-lg ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#ed1c24] text-lg"
                >
                <div x-show="loading" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="animate-spin h-5 w-5 text-[#ed1c24]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <!-- Resultados da Busca -->
            <div x-show="open && results.length > 0" x-transition class="absolute z-10 mt-2 w-full max-w-2xl bg-white rounded-xl shadow-2xl border max-h-80 overflow-y-auto">
                <ul>
                    <template x-for="cnae in results" :key="cnae.codigo">
                        <li>
                            {{-- Constrói a URL dinamicamente substituindo o placeholder --}}
                            <a :href="cnaeShowUrl.replace('CNAE_PLACEHOLDER', cnae.codigo)" class="block p-4 hover:bg-gray-100 transition-colors duration-200">
                                <p class="font-bold text-[#171717]" x-text="cnae.codigo"></p>
                                <p class="text-sm text-gray-600" x-text="cnae.descricao"></p>
                            </a>
                        </li>
                    </template>
                </ul>
            </div>
             <div x-show="open && search.length > 1 && results.length === 0 && !loading" class="absolute z-10 mt-2 w-full max-w-2xl bg-white rounded-xl shadow-2xl border p-4">
                <p class="text-center text-gray-500">Nenhum resultado encontrado.</p>
            </div>
        </div>
    </div>
</div>
@endsection

