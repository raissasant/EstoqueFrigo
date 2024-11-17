<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Armazem;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProdutoController extends Controller
{
    // Método para exibir a tela de criação de produto
    public function TelaProduto()
    {
        $armazens = Armazem::all(); // Carrega todos os armazéns para selecionar na criação
        $fornecedores = Fornecedor::all(); // Carrega todos os fornecedores
        return view('Produtos', compact('armazens', 'fornecedores'));
    }

    // Método para armazenar um novo produto
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
            'sku' => 'required|string|unique:_produtos,sku',
            'fornecedor_id' => 'required|array',
            'data_validade' => 'nullable|date|after_or_equal:today'
        ], [
            'sku.unique' => 'O SKU informado já está em uso.',
            'valor_venda.gte' => 'O Valor de Venda deve ser maior ou igual ao valor de compra.',
        ]);
    
        // Fixando o armazém como "Agro"
        $armazem = Armazem::where('name', 'Agro')->first();
        if (!$armazem) {
            return redirect()->back()->withErrors(['armazem' => 'O armazém "Agro" não foi encontrado no sistema.']);
        }
    
        // Criando o produto
        $produto = Produto::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'descricao' => $request->input('descricao'),
            'codigo_produto' => $request->input('codigo_produto'),
            'valor_compra' => $request->input('valor_compra'),
            'valor_venda' => $request->input('valor_venda'),
            'altura' => $request->input('altura'),
            'largura' => $request->input('largura'),
            'peso' => $request->input('peso'),
            'categoria' => $request->input('categoria'),
            'quantidade' => $request->input('quantidade'),
            'sku' => $request->input('sku'),
            'data_validade' => $request->input('data_validade'),
        ]);
    
        // Associando fornecedores ao produto
        $produto->fornecedores()->attach($request->input('fornecedor_id'));
    
        // Associando o produto ao armazém "Agro"
        $produto->armazens()->attach($armazem->id, ['quantidade' => $request->input('quantidade')]);
    
        return redirect()->route('ListagemProduto')->with('success', 'Produto cadastrado no armazém "Agro" com sucesso.');
    }
    

    // Método para listar todos os produtos com fornecedores e armazéns
    public function listagemProduto()
    {
        $produtos = Produto::with(['fornecedores', 'armazens'])->get();
    
        // Normaliza os dados relevantes
        foreach ($produtos as $produto) {
            $produto->name = utf8_encode($produto->name);
            $produto->descricao = utf8_encode($produto->descricao);
            if ($produto->armazens->isNotEmpty()) {
                $produto->armazens->first()->name = utf8_encode($produto->armazens->first()->name);
            }
        }
    
        return view('ProdutoListagem', compact('produtos'));
    }

    // Método para exibir a tela de edição de um produto
    public function editProduto($id)
    {
        $produto = Produto::with(['fornecedores', 'armazens'])->findOrFail($id);
        $armazens = Armazem::all(); // Carrega todos os armazéns
        $fornecedores = Fornecedor::all();
        return view('editProduto', compact('produto', 'armazens', 'fornecedores'));
    }

    // Método para atualizar um produto específico
    public function AtualizandoProduto(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

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
            'fornecedor_id' => 'nullable|array',
            'armazem_name' => 'nullable|string|exists:_armazens,name',
            'data_validade' => 'nullable|date|after_or_equal:today'
        ], [
            'valor_venda.gte' => 'O Valor de Venda deve ser maior ou igual ao valor de compra.',
        ]);

        // Atualização do produto com os dados validados
        $produto->update($request->only([
            'name', 'descricao', 'codigo_produto', 'valor_compra', 'valor_venda', 
            'altura', 'largura', 'peso', 'categoria', 'quantidade', 'data_validade'
        ]));

        // Atualizar fornecedores associados ao produto
        $produto->fornecedores()->sync($request->input('fornecedor_id', []));

        // Atualiza o armazém do produto, se necessário
        if ($request->has('armazem_name')) {
            $armazem = Armazem::where('name', $request->input('armazem_name'))->first();
            if ($armazem) {
                $produto->armazens()->sync([$armazem->id]);
            }
        }

        return redirect()->route('ListagemProduto')->with('success', 'Produto atualizado com sucesso.');
    }

    // Método para excluir um produto específico
    public function deleteProduto($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->fornecedores()->detach();
        $produto->armazens()->detach(); // Desvincula o armazém
        $produto->delete();

        return redirect()->route('ListagemProduto')->with('success', 'Produto deletado com sucesso.');
    }


    public function getProdutoAtualizado($id)
{
    // Busca o produto pelo ID com os relacionamentos necessários
    $produto = Produto::with(['armazem', 'fornecedores'])->findOrFail($id);

    // Retorna o produto no formato JSON
    return response()->json([
        'id' => $produto->id,
        'name' => $produto->name,
        'categoria' => $produto->categoria,
        'sku' => $produto->sku,
        'valor_compra' => number_format($produto->valor_compra, 2, ',', '.'),
        'valor_venda' => number_format($produto->valor_venda, 2, ',', '.'),
        'quantidade' => $produto->quantidade,
        'armazem' => [
            'nome' => $produto->armazem->nome ?? 'N/A'
        ],
        'fornecedores' => $produto->fornecedores->map(function ($fornecedor) {
            return ['name' => $fornecedor->name];
        }),
    ]);
}



    // Método de busca de produtos por nome ou código
    public function SearchProduto(Request $request)
    {
        $search = $request->input('search');
        $query = Produto::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('codigo_produto', 'LIKE', '%' . $search . '%');
            });
        }

        $produtos = $query->with(['fornecedores', 'armazens'])->get();

        return view('ProdutoListagem', [
            'produtos' => $produtos,
            'message' => $produtos->isEmpty() ? 'Nenhum produto encontrado para a busca "' . $search . '"' : null
        ]);
    }

    // Método para fornecer os detalhes de um produto (API para QR Code)
    public function DetalhesProduto($id)
    {
        $produto = Produto::with('armazens')->findOrFail($id);

        return response()->json([
            'produto' => [
                'id' => $produto->id,
                'name' => $produto->name,
                'descricao' => $produto->descricao,
                'sku' => $produto->sku,
                'quantidade' => $produto->quantidade,
            ],
            'armazens' => $produto->armazens->map(function ($armazem) {
                return [
                    'name' => $armazem->name,
                    'quantidade' => $armazem->pivot->quantidade,
                ];
            }),
        ]);
    }
}
