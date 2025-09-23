<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\SolicitacaoRemocao;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RemocaoController extends Controller
{
    /**
     * Armazena uma nova solicitação de remoção.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validação dos dados do formulário
        $validated = $request->validate([
            'cnpj' => 'required|string|max:18',
            'nome_solicitante' => 'required|string|max:255',
            'email_solicitante' => 'required|email|max:255',
            'motivo' => 'required|string|min:20',
        ]);

        try {
            // Limpa o CNPJ para buscar a razão social
            $cnpjLimpo = preg_replace('/[^0-9]/', '', $validated['cnpj']);
            $cnpjBase = substr($cnpjLimpo, 0, 8);
            
            // Busca a empresa para obter a razão social
            $empresa = Empresa::find($cnpjBase);
            $razaoSocial = $empresa ? $empresa->razao_social : 'Razão Social não encontrada';

            // 2. Cria e salva a solicitação no banco de dados
            SolicitacaoRemocao::create([
                'cnpj' => $validated['cnpj'],
                'razao_social' => $razaoSocial,
                'nome_solicitante' => $validated['nome_solicitante'],
                'email_solicitante' => $validated['email_solicitante'],
                'motivo' => $validated['motivo'],
                'status' => 'pendente', // Status inicial padrão
            ]);

            // 3. Redireciona para uma página de sucesso
            return redirect()->route('remocao.success')->with('success', 'Sua solicitação foi enviada com sucesso!');

        } catch (\Exception $e) {
            // Loga o erro para depuração
            Log::error('Falha ao salvar solicitação de remoção: ' . $e->getMessage());

            // Retorna para o formulário com uma mensagem de erro genérica
            return back()->withInput()->with('error', 'Ocorreu um erro ao processar sua solicitação. Por favor, tente novamente.');
        }
    }
}
