<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{

    public function solicitarRemocao(string $cnpj): View
    {
        // Formata o CNPJ para exibição antes de enviar para a view
        $cnpjFormatado = vsprintf('%s.%s.%s/%s-%s', [
            substr($cnpj, 0, 2), substr($cnpj, 2, 3), substr($cnpj, 5, 3),
            substr($cnpj, 8, 4), substr($cnpj, 12, 2)
        ]);

        return view('pages.solicitar-remocao', ['cnpj' => $cnpjFormatado]);
    }

    public function remocaoSuccess(): View
    {
        // Verifica se a sessão 'success' existe antes de renderizar a view
        if (!session('success')) {
            return redirect()->route('home');
        }

        return view('pages.remocao-solicitada');
    }
}

