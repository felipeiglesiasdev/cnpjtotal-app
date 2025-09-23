<div class="bg-white rounded-xl shadow-lg border border-gray-100 mt-8 overflow-hidden">
    {{-- Cabeçalho do Card --}}
    <h2 class="text-2xl font-semibold text-[#171717] flex items-center bg-[#f1dada] p-4 border-b border-[#171717]">
        <i class="bi bi-shield-lock-fill text-[#ed1c24] mr-3"></i>
        Privacidade e Remoção de Dados
    </h2>

    {{-- Corpo do Card --}}
    <div class="p-6 sm:p-8 space-y-4 text-base text-[#171717]">
        <p>
            As informações exibidas nesta página são dados públicos, disponibilizados pela Receita Federal e abertos para consulta por qualquer cidadão, conforme o <strong class="font-semibold">Decreto nº 8.777/2016</strong> e a <strong class="font-semibold">Lei de Acesso à Informação</strong>. Nosso site atua como um facilitador, organizando esses dados para uma consulta mais simples.
        </p>
        <p>
            Respeitamos a sua privacidade. De acordo com a <strong class="font-semibold">Lei Geral de Proteção de Dados (LGPD)</strong>, se você é o titular ou representante legal deste CNPJ e deseja solicitar a remoção destas informações de nossa plataforma, por favor, clique no botão abaixo.
        </p>
        <div class="border-t border-gray-200 pt-6">
            <a href="{{ route('remocao.form', ['cnpj' => preg_replace('/[^0-9]/', '', $data['cnpj_completo'])]) }}"
               class="inline-flex items-center text-white bg-[#171717] hover:bg-black font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                <i class="bi bi-trash-fill mr-2"></i>
                Solicitar Remoção de CNPJ
            </a>
        </div>
    </div>
</div>
