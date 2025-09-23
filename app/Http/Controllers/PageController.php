<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{

    /**
     * Mostra o formulário para solicitar a remoção de CNPJ.
     * Passa tanto o CNPJ formatado (para exibição) quanto o bruto (para o formulário).
     */
    public function showRemocaoForm(string $cnpj): View
    {
        // Garante que estamos lidando com um CNPJ limpo (apenas números)
        $cnpjLimpo = preg_replace('/[^0-9]/', '', $cnpj);

        // Formata o CNPJ para exibição
        $cnpjFormatado = vsprintf('%s.%s.%s/%s-%s', [
            substr($cnpjLimpo, 0, 2), substr($cnpjLimpo, 2, 3), substr($cnpjLimpo, 5, 3),
            substr($cnpjLimpo, 8, 4), substr($cnpjLimpo, 12, 2)
        ]);

        // Passa ambos os formatos para a view
        return view('pages.solicitar-remocao', [
            'cnpj_formatado' => $cnpjFormatado,
            'cnpj_raw' => $cnpjLimpo
        ]);
    }

    /**
     * Exibe a página de sucesso após a solicitação de remoção.
     */
    public function remocaoSuccess(): View|RedirectResponse
    {
        // Garante que o usuário só acesse esta página se tiver acabado de enviar o formulário
        if (!session('success')) {
            return redirect()->route('home');
        }

        return view('pages.remocao-solicitada');
    }
}


