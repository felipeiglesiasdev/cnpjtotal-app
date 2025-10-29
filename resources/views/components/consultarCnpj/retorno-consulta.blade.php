@php
    $dados = [
        ['icon' => 'bi-building', 'text' => 'Razão Social'],
        ['icon' => 'bi-easel', 'text' => 'Nome Fantasia'],
        ['icon' => 'bi-check-all', 'text' => 'Situação Cadastral'],
        ['icon' => 'bi-calendar-range', 'text' => 'Tempo de Atividade'],
        ['icon' => 'bi-bar-chart-fill', 'text' => 'Porte da Empresa'],
        ['icon' => 'bi-cash-coin', 'text' => 'Capital Social'],
        ['icon' => 'bi-geo-alt-fill', 'text' => 'Endereço Completo'],
        ['icon' => 'bi-telephone-fill', 'text' => 'Contatos (E-mail e Telefone)'],
        ['icon' => 'bi-tags-fill', 'text' => 'CNAE Principal e Secundários'],
        ['icon' => 'bi-briefcase-fill', 'text' => 'Natureza Jurídica'],
        ['icon' => 'bi-people-fill', 'text' => 'Sócios e Administradores (QSA)'],
        ['icon' => 'bi-diagram-3-fill', 'text' => 'Empresas no mesmo ramo']
    ];
@endphp

{{-- AJUSTE: Padding vertical da seção reduzido --}}
<section class="bg-white py-16 md:py-24 overflow-hidden">
    <div class="container mx-auto max-w-6xl px-6 sm:px-4">
        <div class="text-center max-w-3xl mx-auto">
            <span class="text-sm font-semibold text-[#ed1c24] uppercase tracking-wider mb-4 inline-block">
                O QUE NOSSA CONSULTA RETORNA?
            </span>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-8 tracking-tight">
                Informações Completas da Empresa
            </h2>
            <p class="text-lg text-gray-700 mb-20 font-light">
                Todos os dados públicos que você precisa, 100% atualizados e consolidados em um só lugar para sua análise.
            </p>
        </div>

        {{-- Grade de Dados --}}
        {{-- AJUSTE: Layout do Card, Hover, Borda --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($dados as $dado)
            {{-- Card Individual --}}
            <div class="group relative flex items-center rounded-xl border border-gray-300 bg-white p-5 shadow-sm transition-all duration-300 hover:shadow-lg hover:border-[#ed1c24]/50 hover:-translate-y-1.5">
                {{-- Círculo do Ícone --}}
                <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-50 transition-all duration-300 group-hover:bg-[#ed1c24] group-hover:scale-105">
                    {{-- Ícone --}}
                    <i class="{{ $dado['icon'] }} text-2xl text-[#ed1c24] transition-all duration-300 group-hover:text-white"></i>
                </div>
                {{-- Texto --}}
                <h3 class="text-base font-semibold text-gray-800 group-hover:text-gray-900">{{ $dado['text'] }}</h3>
            </div>
            @endforeach
        </div>
        {{-- FIM DOS AJUSTES --}}

        {{-- Observação Legal --}}
        <div class="mt-20 text-center max-w-3xl mx-auto">
            <p class="text-base text-[#171717] leading-relaxed font-light">
                O <strong class="font-medium text-gray-700">CNPJ Total</strong> atua como um facilitador, compilando e organizando dados públicos disponibilizados pela Receita Federal do Brasil. Nossas informações são nada menos do que os dados oficiais.
                Para consultar diretamente na fonte, acesse o
                <a href="https://solucoes.receita.fazenda.gov.br/servicos/cnpjreva/cnpjreva_solicitacao.asp"
                   target="_blank" rel="noopener nofollow"
                   class="font-medium text-[#ed1c24] underline transition-colors hover:text-red-700">
                    site oficial da Receita Federal
                </a>.
            </p>
        </div>
    </div>
</section>