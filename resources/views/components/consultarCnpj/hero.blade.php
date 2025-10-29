<section class="relative bg-white pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
    <div aria-hidden="true" class="absolute inset-0 z-0">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-red-100 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-red-100 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-4000"></div>
         <div class="absolute -bottom-8 right-20 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-6000"></div>
    </div>
    <div class="relative container mx-auto px-4 z-10">
        <div class="max-w-3xl mx-auto text-center">
            <span class="text-sm font-semibold text-[#ed1c24] uppercase tracking-wider mb-3 inline-block">Consulta Gratuita e Ilimitada</span>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-5 tracking-tight leading-tight">
                Consulte qualquer CNPJ <br class="hidden sm:inline"> Instantaneamente
            </h1>
            <p class="text-lg text-gray-700 mb-10 max-w-xl mx-auto font-light">
                Acesse dados cadastrais completos, situação, QSA, CNAEs e mais. Informações públicas da Receita Federal na palma da sua mão.
            </p>
            <form class="max-w-3xl mx-auto" action="{{ route('cnpj.consultar') }}" method="POST" novalidate>
                @csrf
                <div class="relative flex flex-col sm:flex-row items-center gap-3 sm:bg-white sm:p-2 sm:rounded-full sm:shadow-lg">
                    <div class="relative w-full mb-3 sm:mb-0">
                           <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none z-10">
                                <i class="bi bi-search text-gray-400 text-lg"></i>
                            </div>
                         <input
                            type="tel" 
                            name="cnpj" 
                            id="cnpj-input-aside" 
                            class="w-full text-lg text-gray-800 pl-14 pr-4 py-4 border border-gray-200 sm:border-none rounded-full focus:ring-2 focus:ring-[#ed1c24]/50 focus:outline-none placeholder-gray-500 bg-white sm:bg-transparent shadow-md sm:shadow-none"
                            placeholder="00.000.000/0000-00"
                            required
                            aria-label="Número do CNPJ">
                    </div>
                    <button type="submit"
                            class="inline-flex items-center justify-center cursor-pointer w-full sm:w-auto flex-shrink-0 bg-[#171717] text-white font-medium py-4 px-8 rounded-full text-base hover:bg-[#ed1c24] transition-all duration-300 ease-out hover:-translate-y-px transform relative z-10 shadow-md sm:shadow-none">
                        <span>Consultar Agora</span>
                        <i class="bi bi-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
            <div class="mt-8 text-gray-600 text-xs flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
                <span class="inline-flex items-center"><i class="bi bi-shield-check-fill text-[#ed1c24] mr-1.5"></i> Dados Públicos Oficiais</span>
                <span class="inline-flex items-center"><i class="bi bi-clock-fill text-[#ed1c24] mr-1.5"></i> Consulta Rápida</span>
                <span class="inline-flex items-center"><i class="bi bi-infinity text-[#ed1c24] mr-1.5"></i> 100% Gratuito</span>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        .animation-delay-6000 { animation-delay: 6s; }

        /* Remove setas do input numérico */
        input[type="tel"]::-webkit-outer-spin-button,
        input[type="tel"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="tel"] {
            -moz-appearance: textfield; /* Firefox */
        }
    </style>
</section>

@push('scripts')
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