<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Armazem;
use App\Models\Movimentacao;
use DB;

class AdminController extends Controller
{
    /**
     * Método que exibe a página inicial do painel do administrador.
     */
    public function index()
    {
        $contagemUser = User::count();
        $contagemFornecedor = Fornecedor::count();
        $contagemProduto = Produto::count();
        $contagemArmazem = Armazem::count();
    
        // Agrupa por armazém e produto para obter o nome do produto e a quantidade
        $estoquePorArmazem = DB::table('produto_armazem')
            ->join('_armazens', 'produto_armazem.armazem_name', '=', '_armazens.name')
            ->join('_produtos', 'produto_armazem.produto_id', '=', '_produtos.id')
            ->select('_armazens.name as armazem', '_produtos.descricao as produto', DB::raw('SUM(produto_armazem.quantidade) as total'))
            ->groupBy('_armazens.name', '_produtos.descricao')
            ->get()
            ->groupBy('armazem'); // Agrupado por armazém para fácil acesso na view
    
        $estoquePorProduto = Produto::select('descricao', 'quantidade')->pluck('quantidade', 'descricao');
        $totalProdutosEmEstoque = Produto::sum('quantidade');
    
        return view('homeAdmin', [
            'contagemUser' => $contagemUser,
            'contagemFornecedor' => $contagemFornecedor,
            'contagemProduto' => $contagemProduto,
            'contagemArmazem' => $contagemArmazem,
            'estoquePorArmazem' => $estoquePorArmazem,
            'estoquePorProduto' => $estoquePorProduto,
            'totalProdutosEmEstoque' => $totalProdutosEmEstoque,
        ]);
    }
    
}