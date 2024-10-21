<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\User;
use App\Models\Admin;
use Auth;
use App\Models\Fornecedor;



class ProdutoController extends Controller
{
    //

    public function TelaProduto(){
        return view('Produtos');
    }


    public function storeProduto(Request $request)
{
    $request->validate([
        'name' => 'string|max:80',
        'descricao' => 'string',
        'codigo_produto' => 'string|required',
        'valor_compra' => 'required|numeric|min:0', 
        'valor_venda' => 'required|numeric|min:0|gte:valor_compra', 
        'altura' => 'string',
        'largura' => 'string',
        'peso' => 'string',
        'categoria' => 'string',
        'quantidade' => 'required|integer|min:0',
        'sku' => ['string', 'required', 'unique:_produtos,sku']
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

        //return 'Produto salvo com sucesso';
         return redirect()->route('ListagemProduto');


    }


        public function listagemProduto()
    {
        $user = Auth::user();
        $produtos = $user->produtos;
        

        

        return view('ProdutoListagem', ['produtos' => $produtos]);
    }



        public function editProduto($id){
          $user = Auth::user();

        
        $produto = $user->produtos()->findOrFail($id);
        return view('editProduto', ['produto' => $produto]);
    }
            
        

        public function AtualizandoProduto(Request $request, $id){
             $user = Auth::user();
             $produto = $user->produtos()->findOrFail($id);

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
                'quantidade' => 'nullable|integer|min:0',],

                ['valor_venda.gte' => 'O Valor de Venda deve ser maior ou igual ao valor de compra.',
 



            ]);


             if ($request->filled('name')) {
              $produto->name = $request->input('name');
            }
            if ($request->filled('descricao')) {
              $produto->descricao = $request->input('descricao');
            }
            if ($request->filled('codigo_produto')) {
              $produto->codigo_produto = $request->input('codigo_produto');
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

            //return 'Produto atualizado com sucesso';
            return redirect()->route('ListagemProduto');


        

        }


        public function deleteProduto($id){
            $user = Auth::user();
            $produto = $user->produtos()->findOrFail($id);


            if ($produto) {
                $produto->delete();
                //return 'Produto deletado com sucesso.';
                return redirect()->route('ListagemProduto');
            } else {
                return 'Produto não encontrado.';
            }

                

    }  


    public function SearchProduto(Request $request)
{
    
    $user_id = auth()->user()->id;

    
    $search = $request->input('search');

    
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