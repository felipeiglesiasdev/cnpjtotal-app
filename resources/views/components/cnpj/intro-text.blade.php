{{-- Componente de introdução, mantendo o layout principal mas com design padronizado --}}
<div class="bg-white p-6 sm:p-8 rounded-lg shadow-sm border border-gray-200">
    {{-- Título principal com a Razão Social --}}
    <h1 class="text-3xl lg:text-4xl font-bold text-gray-800">{{ $data['razao_social'] }}</h1>

    {{-- Nome Fantasia (se existir) --}}
    @if($data['nome_fantasia'])
        <p class="text-xl text-gray-600 mt-1">{{ $data['nome_fantasia'] }}</p>
    @endif

    {{-- Número do CNPJ --}}
    <p class="text-2xl lg:text-3xl text-[#ed1c24] mt-2 font-mono tracking-wide font-semibold">
        {{ $data['cnpj_completo'] }}
    </p>

    {{-- Parágrafo dinâmico otimizado para SEO (cores de texto ajustadas) --}}
    <div class="mt-6 pt-5 border-t border-gray-200 space-y-4 text-gray-700 leading-relaxed">
        <p>
            A empresa <strong>{{ $data['razao_social'] }}</strong>, com o CNPJ <strong>{{ $data['cnpj_completo'] }}</strong>, foi fundada em <strong>{{ $data['data_abertura'] }}</strong> e está localizada na cidade de <strong>{{ $data['cidade'] }}</strong>.
            Sua principal atividade econômica, de acordo com o CNAE (Classificação Nacional de Atividades Econômicas), é
            {{-- Adicionado link para o CNAE principal --}}
            <a href="{{ route('cnae.show', ['cnae' => preg_replace('/[^0-9]/', '', $data['cnae_principal']['codigo'])]) }}"
               class="text-[#ed1c24] hover:underline font-medium"
               title="Ver detalhes sobre {{ $data['cnae_principal']['descricao'] }}">
                <strong>{{ $data['cnae_principal']['descricao'] }}</strong>
            </a>.
        </p>
        <p>
            Registrada sob a natureza jurídica de <strong>{{ $data['natureza_juridica'] }}</strong>, a organização é classificada como uma <strong>{{ $data['porte'] }}</strong>.
            @if(!empty($data['quadro_societario']))
                Atualmente, seu quadro societário é composto por <strong>{{ count($data['quadro_societario']) }}</strong> sócio(s), o que define a estrutura de governança da empresa.
            @endif
            Todas as informações apresentadas nesta página são de domínio público e foram extraídas diretamente da base de dados da
            <a href="https://solucoes.receita.fazenda.gov.br/servicos/cnpjreva/cnpjreva_solicitacao.asp"
               target="_blank"
               rel="nofollow noopener"
               class="text-[#ed1c24] hover:underline font-medium">Receita Federal</a>,
            garantindo total transparência e confiabilidade.
        </p>
    </div>
</div>
