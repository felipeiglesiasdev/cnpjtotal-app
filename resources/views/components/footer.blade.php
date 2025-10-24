{{--
Componente: Footer Supremo
Rodapé principal redesenhado com fundo escuro, navegação expandida e efeitos de hover.
Focado em prover uma excelente estrutura de links internos para SEO e usuário.
--}}
@php
// Helper para formatar CNAE code no footer
function formatarCnaeFooter($codigo) {
    if (!$codigo) return 'N/A';
    $codigo = str_pad($codigo, 7, '0', STR_PAD_LEFT);
    // Formato: XX.XX-X/XX
    return sprintf('%s.%s-%s/%s',
        substr($codigo, 0, 2),
        substr($codigo, 2, 2),
        substr($codigo, 4, 1),
        substr($codigo, 5, 2)
    );
}

// Mapa simplificado de capitais para gerar links (slugs podem precisar de ajuste fino)
$capitaisExemplo = [
    'sp' => 'sao-paulo',
    'rj' => 'rio-de-janeiro',
    'mg' => 'belo-horizonte',
    'ba' => 'salvador',
    'pr' => 'curitiba',
    'rs' => 'porto-alegre',
];

// CNAEs com descrições curtas para o footer
$cnaesExemplo = [
    '9602501' => 'Cabeleireiros, manicure...',
    '7319002' => 'Promoção de vendas',
    '4399103' => 'Obras de alvenaria',
    '5611203' => 'Lanchonetes, casas de chá...',
    '4712100' => 'Minimercados, mercearias...',
    '8599604' => 'Treinamento e desenvolvimento',
    '4530703' => 'Comércio de peças p/ veículos',
    '6821801' => 'Corretagem compra/venda imóveis',
];

@endphp

<footer class="bg-[#171717] text-gray-400">
    <div class="container mx-auto px-4 lg:px-6 py-16">

        {{-- Grid principal do Footer (6 colunas) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">

            {{-- Coluna 1: Logo e Descrição (Ocupa 2 colunas no mobile/tablet) --}}
            <div class="col-span-2 md:col-span-4 lg:col-span-2 mb-8 lg:mb-0">
                <a href="{{ route('home') }}" title="Voltar para a página inicial" class="mb-5 inline-block">
                    <img src="{{ asset('logo/logo-branco-vermelho.webp') }}"
                         alt="Logo CNPJ Total em fundo escuro"
                         class="h-10 w-auto transition-opacity duration-300 hover:opacity-80"
                         width="160"
                         height="40">
                </a>
                <p class="text-sm leading-relaxed pr-4">
                    Seu portal completo para consulta de CNPJ, CNAE e análise de dados empresariais no Brasil. Informações públicas da Receita Federal organizadas para você.
                </p>
                 {{-- Link discreto do WhatsApp --}}
                 <a href="https://wa.me/SEUNUMERO?text=Olá!"
                    target="_blank"
                    rel="noopener nofollow"
                    class="mt-6 inline-flex items-center text-sm text-gray-400 hover:text-white transition-colors duration-200 group">
                    <i class="bi bi-whatsapp mr-2 text-green-500 text-lg group-hover:scale-110 transition-transform"></i>
                    <span>Fale Conosco</span>
                 </a>
            </div>

            {{-- Coluna 2: Institucional e Consultas --}}
            <div class="col-span-1">
                <h3 class="text-base font-semibold text-white uppercase tracking-wider mb-5">Navegação</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Página Inicial</a></li>
                    {{-- Links de Consulta Adicionados --}}
                    <li><a href="{{ route('cnpj.index') }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Consultar CNPJ</a></li>
                    <li><a href="{{ route('cnae.index') }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Consultar CNAE</a></li>
                    <li><a href="{{ route('cep.index') }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Consultar por CEP</a></li>
                    {{-- Link do Portal Adicionado --}}
                    <li><a href="{{ route('portal.index') }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Portal de Análise</a></li>
                    <li><a href="{{ route('nossosServicos') }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Nossos Serviços</a></li>
                    <li><a href="#" rel="nofollow" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Política de Privacidade</a></li>
                    <li><a href="#" rel="nofollow" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Solicitar Remoção</a></li>
                    <li><a href="https://dados.gov.br/dados/conjuntos-dados/cadastro-nacional-da-pessoa-juridica---cnpj" target="_blank" rel="nofollow noopener" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Fonte dos Dados (Gov)</a></li>
                </ul>
            </div>

            {{-- Coluna 3: Empresas por Estado --}}
            <div class="col-span-1">
                <h3 class="text-base font-semibold text-white uppercase tracking-wider mb-5">Por Estado</h3>
                <ul class="space-y-3">
                    {{-- Links diretos para os principais estados (Nome Completo) --}}
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'sp']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas em São Paulo</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'mg']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas em Minas Gerais</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'rj']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas no Rio de Janeiro</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'pr']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas no Paraná</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'rs']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas no Rio Grande do Sul</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'ba']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas na Bahia</a></li>
                    <li><a href="{{ route('portal.por-uf', ['uf' => 'sc']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas em Santa Catarina</a></li>
                     <li><a href="{{ route('portal.por-uf', ['uf' => 'go']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas em Goiás</a></li>
                      <li><a href="{{ route('portal.por-uf', ['uf' => 'pe']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas em Pernambuco</a></li>
                      <li><a href="{{ route('portal.por-uf', ['uf' => 'ce']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas no Ceará</a></li> {{-- Adicionado --}}
                      <li><a href="{{ route('portal.por-uf', ['uf' => 'es']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas no Espírito Santo</a></li> {{-- Adicionado --}}
                </ul>
            </div>

             {{-- Coluna 4: Empresas por Capital --}}
            <div class="col-span-1">
                <h3 class="text-base font-semibold text-white uppercase tracking-wider mb-5">Capitais Populares</h3>
                <ul class="space-y-3">
                    {{-- Links para páginas de capitais --}}
                     @foreach($capitaisExemplo as $uf => $slug)
                     <li><a href="{{ route('portal.por-municipio', ['uf' => $uf, 'municipio_slug' => $slug]) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas em {{ ucwords(str_replace('-', ' ', $slug)) }}</a></li>
                     @endforeach
                     {{-- Adicionar mais capitais se desejar --}}
                     <li><a href="{{ route('portal.por-municipio', ['uf' => 'df', 'municipio_slug' => 'brasilia']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas em Brasília</a></li>
                     <li><a href="{{ route('portal.por-municipio', ['uf' => 'ce', 'municipio_slug' => 'fortaleza']) }}" class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block">Empresas em Fortaleza</a></li>
                </ul>
            </div>


            {{-- Coluna 5: Por Atividade (CNAE) --}}
             <div class="col-span-1">
                <h3 class="text-base font-semibold text-white uppercase tracking-wider mb-5">Atividades Populares</h3>
                {{-- Aumentado espaço vertical --}}
                <ul class="space-y-4">
                    {{-- Links para páginas de CNAE (exemplos com descrição curta) --}}
                     @foreach($cnaesExemplo as $codigo => $descricaoCurta)
                     <li>
                         <a href="{{ route('cnae.show', ['cnae' => $codigo]) }}"
                            class="text-sm hover:text-[#ed1c24] transition-all duration-200 transform hover:-translate-y-px inline-block"
                            {{-- Busca a descrição completa dinamicamente se disponível --}}
                            title="{{ \App\Models\Cnae::find($codigo)?->descricao ?? $descricaoCurta }}">
                            {{ $descricaoCurta }}
                         </a>
                    </li>
                     @endforeach
                </ul>
            </div>

        </div>

        {{-- Barra Inferior: Copyright --}}
        <div class="mt-12 pt-8 border-t border-gray-700/50 text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} CNPJ Total. Todos os direitos reservados. As informações exibidas são públicas e oriundas da Receita Federal.
            </p>
        </div>
    </div>
</footer>

