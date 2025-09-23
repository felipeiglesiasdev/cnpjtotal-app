<div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
    <h3 class="text-2xl font-bold text-[#171717] flex items-center mb-4">
        <i class="bi bi-search text-[#ed1c24] mr-3"></i>
        Consultar CNPJ Grátis
    </h3>
    <p class="text-gray-600 mb-6">
        Deseja consultar um CNPJ? Digite o número abaixo.
    </p>
    
    <form action="{{ route('cnpj.consultar') }}" method="POST" id="sidebar-cnpj-form">
        @csrf
        <div>
            <label for="cnpj_sidebar" class="sr-only">CNPJ</label>
            <input type="text" 
                   name="cnpj" 
                   id="cnpj_sidebar" 
                   required 
                   placeholder="00.000.000/0000-00"
                   class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
        </div>
        <div class="mt-4">
            <button type="submit" class="cursor-pointer w-full bg-[#ed1c24] text-white font-bold py-3 px-6 rounded-lg text-lg hover:bg-[#c11b21] hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#ed1c24]/50 flex items-center justify-center gap-2">
                Consultar CNPJ
            </button>
        </div>
    </form>
    
</div>

{{-- Bloco do Anúncio --}}
<div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mt-12">
    <a href="https://hostinger.com.br?REFERRALCODE=XOJFELIPEFOS" target="_blank" rel="noopener noreferrer sponsored" title="Anúncio da Hostinger">
        <img src="{{ asset('images/hostinger.webp') }}" alt="Anúncio da Hostinger com oferta de hospedagem de site" class="w-full h-auto">
    </a>
</div>

{{-- Adiciona o script iMask se ainda não estiver na página --}}
@push('scripts')
<script src="https://unpkg.com/imask@7.1.3/dist/imask.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cnpjSidebar = document.getElementById('cnpj_sidebar');
        if (cnpjSidebar) {
            const cnpjMask = IMask(cnpjSidebar, {
                mask: '00.000.000/0000-00'
            });
            
            const sidebarForm = document.getElementById('sidebar-cnpj-form');
            if(sidebarForm) {
                sidebarForm.addEventListener('submit', function() {
                    cnpjSidebar.value = cnpjMask.unmaskedValue;
                });
            }
        }
    });
</script>
@endpush
