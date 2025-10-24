<?php

namespace App\Http\Controllers;

use App\Models\Cnae;
use App\Models\Estabelecimento;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CnaeController extends Controller
{

    /**
     * Realiza a busca de CNAEs em tempo real para o formulário.
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->input('q', '');

        // Retorna um array vazio se a busca tiver menos de 2 caracteres
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $cnaes = Cnae::query()
            ->where('codigo', 'LIKE', "%{$query}%")
            ->orWhere('descricao', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['codigo', 'descricao']);

        return response()->json($cnaes);
    }

    /**
     * Exibe os detalhes de um CNAE específico e as empresas relacionadas.
     */
    public function show(string $cnae): View
    {
        $cnaeData = Cnae::where('codigo', $cnae)->firstOrFail();

        // VALIDAÇÃO: Cria a query base para buscar apenas estabelecimentos ATIVOS (situação 2)
        $baseQuery = Estabelecimento::where('cnae_fiscal_principal', $cnaeData->codigo)
            ->where('situacao_cadastral', 2);

        // Conta o total de empresas ativas com este CNAE
        $activeCount = $baseQuery->count();

        // Pega uma amostra de até 30 estabelecimentos ATIVOS
        $estabelecimentos = (clone $baseQuery)
            ->with(['empresa', 'municipio']) // Carrega relações para otimizar
            ->limit(30)
            ->get();

        
        // MONTAGEM DO DICIONÁRIO DE DADOS PARA OS ESTABELECIMENTOS
        $estabelecimentosData = $estabelecimentos->map(function ($est) {
            $fullCnpj = $est->cnpj_basico . $est->cnpj_ordem . $est->cnpj_dv;
            $nomeMunicipio = $est->municipioRel->descricao ?? 'Não informado';
            return [
                'razao_social'  => $est->empresa->razao_social ?? 'Razão Social não informada',
                'nome_fantasia' => $est->nome_fantasia,
                'cnpj_formatado'=> $est->getFormattedCnpj(),
                'cidade_uf'     => $nomeMunicipio . ' - ' . $est->uf,
                'link_cnpj'     => route('cnpj.show', $fullCnpj),
            ];
        });

        // Monta o dicionário de dados final para a view
        $data = [
            'cnae_codigo'            => $cnaeData->codigo,
            'cnae_descricao'         => $cnaeData->descricao,
            'active_count'           => $activeCount, // Mantém o número bruto para lógicas como (if > 30)
            'active_count_formatado' => number_format($activeCount, 0, ',', '.'),
            'estabelecimentos'       => $estabelecimentosData,
        ];

        return view('cnae.show', compact('data'));
    }
}

