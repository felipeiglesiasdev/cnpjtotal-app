<footer class="bg-[#171717] text-white border-t border-gray-700/50">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            
            {{-- Coluna da Logo e Copyright --}}
            <div class="flex flex-col items-center md:items-start">
                <a href="{{ route('home') }}" title="Voltar para a página inicial">
                    <img src="{{ asset('logo/logo-branco-vermelho.webp') }}" 
                         alt="Logo CNPJ Total em fundo escuro" 
                         class="h-10 w-auto mb-4"
                         width="160"
                         height="40">
                </a>
                <p class="text-sm text-gray-400">&copy; {{ date('Y') }} CNPJ Total. <br>Todos os direitos reservados.</p>
            </div>

            {{-- Coluna de Texto Legal --}}
            <div class="md:col-span-2">
                <p class="text-sm text-gray-400 leading-relaxed max-w-2xl mx-auto md:mx-0">
                    As informações de CNPJ e CNAE exibidas em nosso site são dados públicos, disponibilizados pela Receita Federal. A divulgação dessas informações é permitida e respaldada pelo <strong>Decreto Nº 8.777/16</strong> e pela <strong>Lei Nº 13.709/18 (LGPD)</strong>. Nosso objetivo é apenas organizar e facilitar o acesso a esses dados.
                </p>
                <div class="mt-4">
                    <a href="{{ route('privacy.policy') }}" rel="nofollow" class="text-gray-300 hover:text-[#ed1c24] transition-colors text-sm font-medium">
                        Política de Privacidade
                    </a>
                </div>
            </div>

        </div>
    </div>
</footer>

