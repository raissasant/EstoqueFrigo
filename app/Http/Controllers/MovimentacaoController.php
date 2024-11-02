<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\Armazem;
use Auth;
use Illuminate\Support\Facades\DB;

class MovimentacaoController extends Controller
{
    // Exibe a tela de movimentação para um produto específico
    public function TelaMovimentacao($id)
    {
        $user = Auth::user();
        $produto = Produto::findOrFail($id);
        $armazens = $user->role === 'admin' ? Armazem::all() : $user->armazens;

        return view('Movimentacao', ['user' => $user, 'produto' => $produto, 'armazens' => $armazens]);
    }

    // Registra uma nova movimentação e atualiza o estoque do produto por armazém
    public function CadastrandoMovimentacao(Request $request)
    {
        $request->validate([
            'name_user' => 'nullable|string',
            'codigo_produto' => 'required|string',
            'quantidade' => 'required|integer|min:1',
            'tipo_mov' => 'required|string|in:Entrada,Saida,Transferencia',
            'armazem_origem' => 'nullable|string',
            'armazem_destino' => 'nullable|string',
        ]);

        $user = Auth::user();
        $produto = Produto::where('codigo_produto', $request->input('codigo_produto'))->first();

        if (!$produto) {
            return redirect()->back()->with('error', 'Produto não encontrado.');
        }

        $quantidade = $request->input('quantidade');
        $tipoMov = $request->input('tipo_mov');
        $armazemOrigemName = $request->input('armazem_origem');
        $armazemDestinoName = $request->input('armazem_destino');

        if ($tipoMov === 'Transferencia') {
            // Transferência entre armazéns
            $armazemOrigem = Armazem::where('name', $armazemOrigemName)->first();
            $armazemDestino = Armazem::where('name', $armazemDestinoName)->first();

            if (!$armazemOrigem || !$armazemDestino) {
                return redirect()->back()->with('error', 'Armazém de origem ou destino não encontrado.');
            }

            // Verifica a quantidade disponível no armazém de origem
            $produtoArmazemOrigem = DB::table('produto_armazem')
                ->where('produto_id', $produto->id)
                ->where('armazem_name', $armazemOrigem->name)
                ->first();

            if (!$produtoArmazemOrigem || $produtoArmazemOrigem->quantidade < $quantidade) {
                return redirect()->back()->with('error', 'Quantidade insuficiente no armazém de origem.');
            }

            // Atualiza a quantidade nos armazéns de origem e destino
            DB::table('produto_armazem')
                ->where('produto_id', $produto->id)
                ->where('armazem_name', $armazemOrigem->name)
                ->decrement('quantidade', $quantidade);

            DB::table('produto_armazem')
                ->updateOrInsert(
                    ['produto_id' => $produto->id, 'armazem_name' => $armazemDestino->name],
                    ['quantidade' => DB::raw("quantidade + $quantidade")]
                );

        } elseif ($tipoMov === 'Entrada') {
            // Entrada de produto em um armazém
            $armazemDestino = Armazem::where('name', $armazemDestinoName)->first();
            if (!$armazemDestino) {
                return redirect()->back()->with('error', 'Armazém de destino não encontrado.');
            }

            // Incrementa a quantidade no armazém de destino
            DB::table('produto_armazem')
                ->updateOrInsert(
                    ['produto_id' => $produto->id, 'armazem_name' => $armazemDestino->name],
                    ['quantidade' => DB::raw("quantidade + $quantidade")]
                );

            // Atualiza o estoque geral do produto
            $produto->increment('quantidade', $quantidade);

        } elseif ($tipoMov === 'Saida') {
            // Saída de produto de um armazém
            $armazemOrigem = Armazem::where('name', $armazemOrigemName)->first();
            if (!$armazemOrigem) {
                return redirect()->back()->with('error', 'Armazém de origem não encontrado.');
            }

            // Verifica a quantidade disponível no armazém de origem
            $produtoArmazemOrigem = DB::table('produto_armazem')
                ->where('produto_id', $produto->id)
                ->where('armazem_name', $armazemOrigem->name)
                ->first();

            if (!$produtoArmazemOrigem || $produtoArmazemOrigem->quantidade < $quantidade) {
                return redirect()->back()->with('error', 'Quantidade insuficiente no armazém de origem.');
            }

            // Diminui a quantidade no armazém de origem
            DB::table('produto_armazem')
                ->where('produto_id', $produto->id)
                ->where('armazem_name', $armazemOrigem->name)
                ->decrement('quantidade', $quantidade);

            // Atualiza o estoque geral do produto
            $produto->decrement('quantidade', $quantidade);
        }

        // Registra a movimentação
        $movimentacao = new Movimentacao;
        $movimentacao->user_id = $user->id;
        $movimentacao->name_user = $request->input('name_user');
        $movimentacao->codigo_produto = $request->input('codigo_produto');
        $movimentacao->codigo_entrada = $request->input('codigo_entrada', ''); // ou um valor padrão
        $movimentacao->codigo_saida = $request->input('codigo_saida', ''); // Ou um valor padrão, como uma string vazia
        $movimentacao->codigo_pedido = $request->input('codigo_pedido', ''); // Ou um valor padrão, como uma string vazia
        $movimentacao->tipo_mov = $tipoMov;
        $movimentacao->quantidade_mov = $quantidade;
        $movimentacao->armazem_origem = $armazemOrigemName;
        $movimentacao->armazem_destino = $armazemDestinoName;
        $movimentacao->save();

        return redirect()->route('ListagemMovimentacao')->with('success', 'Movimentação registrada com sucesso.');
    }

    // Lista todas as movimentações
    public function ListagemMovimentacao()
    {
        $user = Auth::user();
        $movimentacoes = Movimentacao::where('user_id', $user->id)->get();

        return view('ListagemMovimentacao', ['movimentacoes' => $movimentacoes]);
    }

    public function ConsultaEstoque()
{
    $estoques = DB::table('produto_armazem')
        ->join('_armazens', 'produto_armazem.armazem_name', '=', '_armazens.name')
        ->join('_produtos', 'produto_armazem.produto_id', '=', '_produtos.id')
        ->select('_armazens.name as armazem', '_produtos.descricao as produto', DB::raw('SUM(produto_armazem.quantidade) as quantidade_total'))
        ->groupBy('_armazens.name', '_produtos.descricao')
        ->get();

    return view('ConsultaEstoque', ['estoques' => $estoques]);
}

    // Exibe a tela de edição de uma movimentação específica
    public function editMovimentacao($id)
    {
        $movimentacao = Movimentacao::findOrFail($id);
        $armazens = Auth::user()->role === 'admin' ? Armazem::all() : Auth::user()->armazens;

        return view('EditMovimentacao', ['movimentacao' => $movimentacao, 'armazens' => $armazens]);
    }

    // Deleta uma movimentação específica
    public function deleteMovimentacao($id)
    {
        $movimentacao = Movimentacao::findOrFail($id);
        $movimentacao->delete();

        return redirect()->route('ListagemMovimentacao')->with('success', 'Movimentação deletada com sucesso.');
    }
}
