<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\Armazem;
use App\Models\Movimentacao;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        // Contagens para os cards
        $contagemUser = User::count();
        $contagemFornecedor = Fornecedor::count();
        $contagemProduto = Produto::count();
        $contagemArmazem = Armazem::count();

        // Contagem total de itens em estoque (soma das quantidades de todos os produtos)
        $totalProdutosEmEstoque = Produto::sum('quantidade');

        // Dados para o gráfico de estoque por armazém
        $estoquePorArmazem = Movimentacao::select('armazem_destino', DB::raw('SUM(quantidade_mov) as total'))
            ->groupBy('armazem_destino')
            ->pluck('total', 'armazem_destino');

        // Dados para o gráfico de produtos em estoque
        $estoquePorProduto = Movimentacao::select('codigo_produto', DB::raw('SUM(quantidade_mov) as total'))
            ->groupBy('codigo_produto')
            ->pluck('total', 'codigo_produto');

        return view('home', [
            'contagemUser' => $contagemUser,
            'contagemFornecedor' => $contagemFornecedor,
            'contagemProduto' => $contagemProduto,
            'contagemArmazem' => $contagemArmazem,
            'totalProdutosEmEstoque' => $totalProdutosEmEstoque, // Adiciona o total de itens em estoque
            'estoquePorArmazem' => $estoquePorArmazem,
            'estoquePorProduto' => $estoquePorProduto
        ]);
    }
}
