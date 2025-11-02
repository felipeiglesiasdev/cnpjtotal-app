{{-- resources/views/components/consultar-cnae/hero.blade.php --}}

<section class="relative bg-white pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
    {{-- Elementos Animados Sutis de Fundo --}}
    <div aria-hidden="true" class="absolute inset-0 z-0">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-red-100 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-red-100 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-4000"></div>
         <div class="absolute -bottom-8 right-20 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-6000"></div>
    </div>

    <div class="relative container mx-auto px-4 z-10">
        <div class="max-w-3xl mx-auto text-center">
            <span class="text-sm font-semibold text-[#ed1c24] uppercase tracking-wider mb-3 inline-block">Código de Atividade Econômica</span>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-5 tracking-tight leading-tight">
                Consulte qualquer CNAE
            </h1>
            <p class="text-lg text-gray-700 mb-10 max-w-xl mx-auto font-light">
                Digite o código CNAE (com ou sem formatação) para ver sua descrição detalhada e empresas relacionadas.
            </p>

            {{-- Formulário de Consulta de CNAE (Agora com Alpine.js para live search) --}}
            <div class="max-w-xl mx-auto" 
                 x-data="cnaeSearch()">
                
                <div class="relative flex flex-col items-center gap-3">
                    {{-- Input Wrapper --}}
                    <div class="relative w-full shadow-lg rounded-full">
                           <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none z-10">
                                <i class="bi bi-search text-gray-400 text-lg"></i> {{-- Ícone de Pesquisa --}}
                            </div>
                         <input
                            type="text" 
                            name="cnae"
                            id="cnae-input"
                            class="w-full text-lg text-gray-800 pl-14 pr-14 py-4 border border-gray-200 rounded-full focus:ring-2 focus:ring-[#ed1c24]/50 focus:outline-none placeholder-gray-500 bg-white shadow-md"
                            placeholder="Digite o código ou nome da atividade (ex: Comércio)"
                            required
                            aria-label="Código CNAE"
                            x-model="query"
                            @input.debounce.300ms="fetchResults"
                            @focus="open = true"
                            @keydown.escape.window="open = false"
                            autocomplete="off">
                        
                        {{-- Loading Spinner --}}
                        <div x-show="loading" class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                            <svg class="animate-spin h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Dropdown de Resultados --}}
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-96 overflow-y-auto z-50"
                         style="display: none;">
                        
                        <template x-if="!loading && results.length === 0 && query.length > 1">
                            <div class="p-4 text-gray-600 text-center">Nenhum resultado encontrado.</div>
                        </template>
                        
                        <ul class="divide-y divide-gray-100">
                            <template x-for="result in results" :key="result.codigo">
                                <li>
                                    {{-- Link para a página cnae.show, limpando o código --}}
                                    <a :href="'{{ route('cnae.index') }}/' + result.codigo.replace(/\D/g, '')" 
                                       class="flex items-center gap-4 p-4 hover:bg-gray-50 transition-colors">
                                        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-red-100 rounded-full">
                                            <i class="bi bi-briefcase text-[#ed1c24]"></i>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <p class="font-semibold text-gray-800 truncate" x-text="result.codigo"></p>
                                            <p class="text-sm text-gray-600 truncate" x-text="result.descricao"></p>
                                        </div>
                                        <i class="bi bi-chevron-right text-gray-400"></i>
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-gray-600 text-xs flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
                <span class="inline-flex items-center"><i class="bi bi-shield-check-fill text-[#ed1c24] mr-1.5"></i> Dados Oficiais IBGE/Receita</span>
                <span class="inline-flex items-center"><i class="bi bi-building text-[#ed1c24] mr-1.5"></i> Empresas Relacionadas</span>
                <span class="inline-flex items-center"><i class="bi bi-infinity text-[#ed1c24] mr-1.5"></i> 100% Gratuito</span>
            </div>
        </div>
    </div>
    
</section>

