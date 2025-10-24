@extends('layouts.app')

@push('seo_tags')
    <title>Política de Privacidade - CNPJ Total</title>
    <meta name="description" content="Leia nossa política de privacidade para entender como lidamos com os dados em nosso site de consulta de CNPJ e CNAE.">
    <meta name="robots" content="noindex, follow">
@endpush

@section('content')
<div class="bg-white py-16 px-6 lg:px-8">
    <div class="container mx-auto max-w-3xl">
        <div class="prose prose-lg mx-auto text-gray-700">
            <h1 class="text-3xl font-semibold text-gray-900">Política de Privacidade</h1>
            <p class="text-gray-600 mt-2">Última atualização: {{ date('d/m/Y') }}</p>

            <p>A sua privacidade é importante para nós. É política do CNPJ Total respeitar a sua privacidade em relação a qualquer informação sua que possamos coletar no site.</p>

            <h2 class="text-2xl font-semibold text-gray-900 mt-8">1. Coleta de Dados</h2>
            <p>Não coletamos informações pessoais para a simples navegação e consulta de dados públicos em nosso site. A única situação em que solicitamos dados (como nome e e-mail) é quando o titular ou representante legal de uma empresa preenche o formulário para solicitar a remoção de um CNPJ. Essas informações são usadas exclusivamente para a comunicação e processamento do pedido de remoção.</p>

            <h2 class="text-2xl font-semibold text-gray-900 mt-8">2. Solicitação de Remoção de CNPJ</h2>
            <p>O titular ou representante legal que desejar solicitar a remoção dos dados de sua empresa de nosso site pode fazê-lo acessando a página específica do CNPJ e clicando no botão "Solicitar Remoção". Após o preenchimento do formulário, nossa equipe analisará o pedido e entrará em contato em um prazo de até 3 dias úteis para tratar sobre a remoção.</p>

            <h2 class="text-2xl font-semibold text-gray-900 mt-8">3. Base Legal para Divulgação dos Dados</h2>
            <p>
                A exibição dos dados de pessoas jurídicas (CNPJ) é uma atividade lícita e de interesse público, amparada pelo 
                <a href="https://www.planalto.gov.br/CCIVIL_03/_Ato2015-2018/2016/Decreto/D8777.htm" target="_blank" rel="noopener noreferrer nofollow" class="text-[#ed1c24] hover:underline">Decreto Nº 8.777/16</a> (Política de Dados Abertos do Poder Executivo Federal) e pela 
                <a href="https://www.planalto.gov.br/ccivil_03/_ato2015-2018/2018/lei/l13709.htm" target="_blank" rel="noopener noreferrer nofollow" class="text-[#ed1c24] hover:underline">Lei Nº 13.709/18 (LGPD)</a>,
                que prevê o tratamento de dados tornados manifestamente públicos pelo titular, resguardados os direitos do titular e os princípios previstos na lei.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8">4. Uso de Cookies</h2>
            <p>Podemos utilizar cookies para melhorar a experiência do usuário. Esses cookies são usados para funcionalidade do site e análise de tráfego de forma anônima, sem identificar o usuário individualmente. Você pode ajustar as configurações do seu navegador para recusar cookies.</p>

            <h2 class="text-2xl font-semibold text-gray-900 mt-8">5. Links para Sites de Terceiros</h2>
            <p>O nosso site pode conter links para sites externos que não são operados por nós. Esteja ciente de que não temos controle sobre o conteúdo e práticas desses sites e não podemos aceitar responsabilidade por suas respectivas políticas de privacidade.</p>

            <h2 class="text-2xl font-semibold text-gray-900 mt-8">Contato</h2>
            <p>Se você tiver alguma dúvida sobre nossa política de privacidade, entre em contato conosco.</p>
        </div>
    </div>
</div>
@endsection

