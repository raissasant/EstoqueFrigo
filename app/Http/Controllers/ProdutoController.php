<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;   // Certifique-se de que o modelo Produto está importado
use Illuminate\Support\Facades\Auth;  // Certifique-se de que o Auth está importado corretamente

class ProdutoController extends Controller
{
    // Exibe a tela para cadastro de produtos
    public function TelaProduto(){
        return view('Produtos');
    }

    // Armazena um novo produto no banco de dados
    public function storeProduto(Request $request)
    {
        $request->validate([
            'name' => 'string|max:80',
            'descricao' => 'string',
            'valor_compra' => 'required|numeric|min:0',
            'valor_venda' => 'required|numeric|min:0|gte:valor_compra',
            'altura' => 'string',
            'largura' => 'string',
            'peso' => 'string',
            'categoria' => 'string',
            'quantidade' => 'required|integer|min:0',
            'sku' => ['string', 'required', 'unique:_produtos,sku']  // Nome da tabela ajustado para _produtos
        ], [
            'sku.unique' => 'O SKU informado já está em uso.',
            'valor_venda.gte' => 'O Valor de Venda deve ser maior ou igual ao valor de compra.',
        ]);

        $user = Auth::user();  // Recupera o usuário autenticado

        $produto = new Produto;
        $produto->user_id = $user->id;  // Define o user_id
        $produto->name = $request->input('name');
        $produto->descricao = $request->input('descricao');
        $produto->valor_compra = $request->input('valor_compra');
        $produto->valor_venda = $request->input('valor_venda');
        $produto->altura = $request->input('altura');
        $produto->largura = $request->input('largura');
        $produto->peso = $request->input('peso');
        $produto->categoria = $request->input('categoria');
        $produto->quantidade = $request->input('quantidade');
        $produto->sku = $request->input('sku');
        $produto->save();

        return redirect()->route('ListagemProduto');
    }

    // Lista os produtos do usuário autenticado
    public function listagemProduto()
    {
        $user = Auth::user();  // Recupera o usuário autenticado
        $produtos = $user->produtos;  // Acessa os produtos do usuário

        return view('ProdutoListagem', ['produtos' => $produtos]);
    }

    // Edita um produto específico
    public function editProduto($id)
    {
        $user = Auth::user();
        $produto = $user->produtos()->findOrFail($id);  // Busca o produto do usuário autenticado

        return view('editProduto', ['produto' => $produto]);
    }

    // Atualiza um produto específico
    public function AtualizandoProduto(Request $request, $id)
    {
        $user = Auth::user();
        $produto = $user->produtos()->findOrFail($id);  // Busca o produto do usuário autenticado

        $request->validate([
            'name' => 'nullable|string|max:80',
            'descricao' => 'nullable|string',
            'valor_compra' => 'nullable|numeric|min:0',
            'valor_venda' => 'nullable|numeric|min:0|gte:valor_compra',
            'altura' => 'nullable|string',
            'largura' => 'nullable|string',
            'peso' => 'nullable|string',
            'categoria' => 'nullable|string',
            'quantidade' => 'nullable|integer|min:0',
        ], [
            'valor_venda.gte' => 'O Valor de Venda deve ser maior ou igual ao valor de compra.',
        ]);

        // Atualiza os dados do produto
        if ($request->filled('name')) {
            $produto->name = $request->input('name');
        }
        if ($request->filled('descricao')) {
            $produto->descricao = $request->input('descricao');
        }
        if ($request->filled('valor_compra')) {
            $produto->valor_compra = $request->input('valor_compra');
        }
        if ($request->filled('valor_venda')) {
            $produto->valor_venda = $request->input('valor_venda');
        }
        if ($request->filled('altura')) {
            $produto->altura = $request->input('altura');
        }
        if ($request->filled('largura')) {
            $produto->largura = $request->input('largura');
        }
        if ($request->filled('peso')) {
            $produto->peso = $request->input('peso');
        }
        if ($request->filled('categoria')) {
            $produto->categoria = $request->input('categoria');
        }
        if ($request->filled('quantidade')) {
            $produto->quantidade = $request->input('quantidade');
        }

        $produto->save();

        return redirect()->route('ListagemProduto');
    }

    // Deleta um produto específico
    public function deleteProduto($id)
    {
        $user = Auth::user();
        $produto = $user->produtos()->findOrFail($id);  // Busca o produto do usuário autenticado

        if ($produto) {
            $produto->delete();
            return redirect()->route('ListagemProduto');
        } else {
            return 'Produto não encontrado.';
        }
    }

    // Busca de produtos
    public function SearchProduto(Request $request)
    {
        $user_id = Auth::user()->id;  // Obtém o ID do usuário autenticado
        $search = $request->input('search');

        // Consulta produtos do usuário autenticado
        $query = Produto::where('user_id', $user_id);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('sku', 'LIKE', '%' . $search . '%');
            });
        }

        $produtos = $query->get();

        if ($produtos->isEmpty()) {
            return view('ProdutoListagem', [
                'produtos' => $produtos,
                'message' => 'Nenhum produto encontrado para a busca "' . $search . '"'
            ]);
        }

        return view('ProdutoListagem', ['produtos' => $produtos]);
    }
}
