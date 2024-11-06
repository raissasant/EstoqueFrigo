<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Armazem;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Método que exibe a página inicial do painel do administrador.
     */
    public function index()
    {
        // Contagens para o dashboard
        $contagemUser = User::count();
        $contagemFornecedor = Fornecedor::count();
        $contagemProduto = Produto::count();
        $contagemArmazem = Armazem::count();
        $contagemMovimentacao = Movimentacao::count();
        $totalProdutosEmEstoque = Produto::sum('quantidade');

        // Dados para os gráficos usando '_armazens' e '_produtos' como nomes das tabelas
        $estoquePorArmazem = DB::table('produto_armazem')
            ->join('_armazens', 'produto_armazem.armazem_name', '=', '_armazens.name')
            ->join('_produtos', 'produto_armazem.produto_id', '=', '_produtos.id')
            ->select('_armazens.name as armazem', '_produtos.descricao as produto', DB::raw('SUM(produto_armazem.quantidade) as total'))
            ->groupBy('_armazens.name', '_produtos.descricao')
            ->get()
            ->groupBy('armazem');

        $estoquePorProduto = Produto::select('descricao', 'quantidade')->pluck('quantidade', 'descricao');

        return view('homeAdmin', [
            'contagemUser' => $contagemUser,
            'contagemFornecedor' => $contagemFornecedor,
            'contagemProduto' => $contagemProduto,
            'contagemArmazem' => $contagemArmazem,
            'contagemMovimentacao' => $contagemMovimentacao,
            'estoquePorArmazem' => $estoquePorArmazem,
            'estoquePorProduto' => $estoquePorProduto,
            'totalProdutosEmEstoque' => $totalProdutosEmEstoque,
        ]);
    }
}
