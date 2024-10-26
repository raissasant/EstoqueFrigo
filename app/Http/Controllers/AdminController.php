<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Armazem;

class AdminController extends Controller
{
    /**
     * Método que exibe a página inicial do painel do administrador.
     */
    public function index()
    {
        // Contar o número de usuários e fornecedores
        $contagemUser = User::count();  // Contar todos os usuários
        $contagemFornecedor = Fornecedor::count();  // Contar todos os fornecedores
        $contagemProduto = Produto::count();  // Contar todos os produtos
        $contagemArmazem = Armazem::count();  // Contar todos os armazéns

        // Passar as contagens para a view do painel do administrador
        return view('homeAdmin', [
            'ContagemUser' => $contagemUser,
            'ContagemFornecedor' => $contagemFornecedor,
            'ContagemProduto' => $contagemProduto,
            'ContagemArmazem' => $contagemArmazem,  // Adicionando contagem de armazéns
        ]);
    }
}
