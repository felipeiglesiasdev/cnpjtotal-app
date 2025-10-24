{{--
Componente: Footer
Este é o rodapé principal do site, com fundo escuro, navegação rica em links (ótimo para SEO)
e informações de copyright.
--}}
<footer class="bg-[#171717] text-gray-300">
    <div class="container mx-auto px-4 lg:px-6 py-16">
        
        {{-- Grid principal do Footer (expandido para 5 colunas) --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

            {{-- Coluna 1: Logo e Descrição (Ocupa 2 colunas no mobile) --}}
            <div class="col-span-2 md:col-span-3 lg:col-span-1">
                <a href="{{ route('home') }}" title="Voltar para a página inicial" class="mb-4 inline-block">
                    <img src="{{ asset('logo/logo-branco-vermelho.webp') }}" 
                         alt="Logo CNPJ Total em fundo escuro" 
                         class="h-10 w-auto"
                         width="160"
                         height="40">
                </a>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Portal de análise de dados públicos de CNPJs. Explore o cenário empresarial brasileiro com estatísticas e informações detalhadas.
                </p>
            </div>

            {{-- Coluna 2: Portal de Análise --}}
            <div>
                <h3 class="text-base font-semibold text-white uppercase tracking-wider mb-4">Portal</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('portal.index') }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Visão Geral</a></li>
                    <li><a href="" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Consultar CNPJ</a></li>
                    <li><a href="" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Consultar CNAE</a></li>
                    <li><a href="{{ route('portal.index') }}#todos-os-estados" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Empresas por Estado</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Empresas por Município</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Empresas por CEP</a></li>
                </ul>
            </div>

            {{-- Coluna 3: Navegue por Estados --}}
            <div>
                <h3 class="text-base font-semibold text-white uppercase tracking-wider mb-4">Por Estado</h3>
                <ul class="space-y-2">
                    {{-- Links diretos para os principais estados --}}
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'sp']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Empresas em São Paulo</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'rj']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Empresas no Rio de Janeiro</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'mg']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Empresas em Minas Gerais</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'pr']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Empresas no Paraná</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'rs']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Empresas no Rio Grande do Sul</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'ba']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Empresas na Bahia</a></li>
                </ul>
            </div>

            {{-- Coluna 4: Principais Atividades --}}
            <div>
                <h3 class="text-base font-semibold text-white uppercase tracking-wider mb-4">Por Atividade</h3>
                <ul class="space-y-2">
                    {{-- Links para páginas de CNAE (assumindo os códigos) --}}
                    <li><a href="{{ route('cnae.show', ['cnae' => '4712100']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Comércio Varejista</a></li>
                    <li><a href="{{ route('cnae.show', ['cnae' => '5611201']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Restaurantes e Bares</a></li>
                    <li><a href="{{ route('cnae.show', ['cnae' => '8630503']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Atividade Médica</a></li>
                    <li><a href="{{ route('cnae.show', ['cnae' => '4120400']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Construção de Edifícios</a></li>
                    <li><a href="{{ route('cnae.show', ['cnae' => '7319002']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Promoção de Vendas</a></li>
                    <li><a href="{{ route('cnae.show', ['cnae' => '7020400']) }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Consultoria Empresarial</a></li>
                </ul>
            </div>

            {{-- Coluna 5: Institucional --}}
            <div>
                <h3 class="text-base font-semibold text-white uppercase tracking-wider mb-4">Institucional</h3>
                <ul class="space-y-2">
                    <li><a href="" rel="nofollow" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Política de Privacidade</a></li>
                    <li><a href="" rel="nofollow" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Solicitar Remoção de Dados</a></li>
                    {{-- <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Sobre Nós</a></li> --}}
                    {{-- <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">Contato</a></li> --}}
                </ul>
            </div>

        </div>

        {{-- Barra Inferior: Copyright e Link Discreto --}}
        <div class="mt-12 pt-8 border-t border-gray-700/50 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-400 text-center md:text-left">
                &copy; {{ date('Y') }} CNPJ Total. Todos os direitos reservados.
            </p>
            
            {{-- Link discreto do WhatsApp --}}
            <a href="https://wa.me/SEUNUMERO?text=Olá!" 
               target="_blank" 
               rel="noopener nofollow" 
               class="flex items-center text-sm text-gray-400 hover:text-white transition-colors duration-200 mt-4 md:mt-0">
                <i class="bi bi-whatsapp mr-2 text-green-500"></i>
                <span>Fale Conosco (WhatsApp)</span>
            </a>
        </div>
    </div>
</footer>

