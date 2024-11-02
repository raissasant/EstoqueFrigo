<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\User;
use App\Models\Admin;
use Auth;
use App\Models\Fornecedor;
use App\Rules\Cpf;
use App\Rules\CnpjValid;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProdutoController extends Controller
{
    public function TelaProduto()
    {
        return view('Produtos');
    }

    public function storeProduto(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:80',
            'descricao' => 'required|string',
            'codigo_produto' => 'required|string',
            'valor_compra' => 'required|numeric|min:0',
            'valor_venda' => 'required|numeric|min:0|gte:valor_compra',
            'altura' => 'required|string',
            'largura' => 'required|string',
            'peso' => 'required|string',
            'categoria' => 'required|string',
            'quantidade' => 'required|integer|min:0',
            'sku' => 'required|string|unique:_produtos,sku', // Ajuste para _produtos
        ], [
            'sku.unique' => 'O SKU informado já está em uso.',
            'valor_venda.gte' => 'O Valor de Venda deve ser maior ou igual ao valor de compra.',
        ]);

        $user = Auth::user();
        $produto = new Produto;
        $produto->user_id = $user->id;
        $produto->name = $request->input('name');
        $produto->descricao = $request->input('descricao');
        $produto->codigo_produto = $request->input('codigo_produto');
        $produto->valor_compra = $request->input('valor_compra');
        $produto->valor_venda = $request->input('valor_venda');
        $produto->altura = $request->input('altura');
        $produto->largura = $request->input('largura');
        $produto->peso = $request->input('peso');
        $produto->categoria = $request->input('categoria');
        $produto->quantidade = $request->input('quantidade');
        $produto->sku = $request->input('sku');
        $produto->save();

        return redirect()->route('ListagemProduto')->with('success', 'Produto cadastrado com sucesso.');
    }

    public function listagemProduto()
    {
        $user = Auth::user();

        // Admin vê todos os produtos; usuário comum vê apenas os próprios
        $produtos = $user->role === 'admin' ? Produto::all() : $user->produtos;

        return view('ProdutoListagem', ['produtos' => $produtos]);
    }

    public function editProduto($id)
    {
        $user = Auth::user();

        // Admin pode editar qualquer produto; usuário comum apenas os próprios
        $produto = $user->role === 'admin' ? Produto::findOrFail($id) : $user->produtos()->findOrFail($id);

        return view('editProduto', ['produto' => $produto]);
    }

    public function AtualizandoProduto(Request $request, $id)
    {
        $user = Auth::user();
        
        // Admin pode atualizar qualquer produto; usuário comum apenas os próprios
        $produto = $user->role === 'admin' ? Produto::findOrFail($id) : $user->produtos()->findOrFail($id);

        $request->validate([
            'name' => 'nullable|string|max:80',
            'descricao' => 'nullable|string',
            'codigo_produto' => 'nullable|string',
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

        // Atualiza os campos fornecidos
        $produto->update($request->only([
            'name', 'descricao', 'codigo_produto', 'valor_compra', 'valor_venda', 'altura', 'largura', 'peso', 'categoria', 'quantidade'
        ]));

        return redirect()->route('ListagemProduto')->with('success', 'Produto atualizado com sucesso.');
    }

    public function deleteProduto($id)
    {
        $user = Auth::user();
    
        // Admin pode deletar qualquer produto; usuário comum apenas os próprios
        $produto = $user->role === 'admin' ? Produto::findOrFail($id) : $user->produtos()->findOrFail($id);
    
        if ($produto) {
            $produto->delete();
            return redirect()->route('homeAdmin')->with('success', 'Produto deletado com sucesso e gráfico atualizado.');
        } else {
            return 'Produto não encontrado.';
        }
    }
    

    public function SearchProduto(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Admin pesquisa entre todos os produtos; usuário comum entre os próprios
        $query = $user->role === 'admin' ? Produto::query() : Produto::where('user_id', $user->id);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('sku', 'LIKE', '%' . $search . '%');
            });
        }

        $produtos = $query->get();

        return view('ProdutoListagem', [
            'produtos' => $produtos,
            'message' => $produtos->isEmpty() ? 'Nenhum produto encontrado para a busca "' . $search . '"' : null
        ]);
    }
}
