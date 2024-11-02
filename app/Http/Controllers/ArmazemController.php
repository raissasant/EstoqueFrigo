<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Armazem;
use App\Models\Movimentacao;
use Auth;
use Illuminate\Validation\ValidationException;




class ArmazemController extends Controller
{
    public function TelaArmazem()
    {
        return view('TelaArmazem');
    }

    public function storeArmazem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:80',
            'cep' => 'string',
            'rua' => 'string',
            'complemento' => 'nullable|string',
            'bairro' => 'string',
            'cidade' => 'string',
            'uf' => 'string',
            'capacidade_total' => 'string|required',
            'espaco_disponivel' => 'string|required',
            'status' => 'string|required'
        ]);

        $user = Auth::user();

        $armazem = new Armazem;
        $armazem->user_id = $user->id;
        $armazem->name = $request->input('name');
        $armazem->cep = $request->input('cep');
        $armazem->rua = $request->input('rua');
        $armazem->complemento = $request->input('complemento');
        $armazem->bairro = $request->input('bairro');
        $armazem->cidade = $request->input('cidade');
        $armazem->uf = $request->input('uf');
        $armazem->capacidade_total = $request->input('capacidade_total');
        $armazem->espaco_disponivel = $request->input('espaco_disponivel');
        $armazem->status = $request->input('status');
        $armazem->save();

        return redirect()->route('ListagemArmazem');
    }

    public function ListagemArmazem()
    {
        $user = Auth::user();



        // Verifica se o usuário logado é admin ou comum e lista os armazéns de acordo
        $armazens = $user->role === 'admin' ? Armazem::all() : $user->armazens;

        return view('ListagemArmazem', ['armazens' => $armazens]);
    }

    public function editArmazem($id)
    {
        $user = Auth::user();


        $armazem = $user->role === 'admin' ? Armazem::findOrFail($id) : $user->armazens()->findOrFail($id);

        $armazem = $user->armazens()->findOrFail($id);


        return view('editArmazem', ['armazem' => $armazem]);
    }

    public function AtualizandoArmazem(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:80',
            'cep' => 'nullable|string',
            'rua' => 'nullable|string',
            'complemento' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'uf' => 'nullable|string',
            'capacidade_total' => 'nullable|string',
            'espaco_disponivel' => 'nullable|string',
            'status' => 'nullable|in:ativo,inativo'
        ]);

        $user = Auth::user();
        $armazem = $user->armazens()->findOrFail($id);


        $armazem = $user->role === 'admin' ? Armazem::findOrFail($id) : $user->armazens()->findOrFail($id);

        $armazem->update($request->only([
            'name', 'cep', 'rua', 'complemento', 'bairro', 'cidade', 'uf', 'capacidade_total', 'espaco_disponivel', 'status'
        ]));

        return redirect()->route('ListagemArmazem')->with('success', 'Armazém atualizado com sucesso.');

        if ($request->filled('name')) {
            $armazem->name = $request->input('name');
        }
        if ($request->filled('cep')) {
            $armazem->cep = $request->input('cep');
        }
        if ($request->filled('rua')) {
            $armazem->rua = $request->input('rua');
        }
        if ($request->filled('complemento')) {
            $armazem->complemento = $request->input('complemento');
        }
        if ($request->filled('bairro')) {
            $armazem->bairro = $request->input('bairro');
        }
        if ($request->filled('cidade')) {
            $armazem->cidade = $request->input('cidade');
        }
        if ($request->filled('uf')) {
            $armazem->uf = $request->input('uf');
        }
        if ($request->filled('capacidade_total')) {
            $armazem->capacidade_total = $request->input('capacidade_total');
        }
        if ($request->filled('espaco_disponivel')) {
            $armazem->espaco_disponivel = $request->input('espaco_disponivel');
        }
        if ($request->filled('status')) {
            $armazem->status = $request->input('status');
        }

        $armazem->save();

        return redirect()->route('ListagemArmazem');

    }

    


    public function deleteArmazem($id)
    {
        $user = Auth::user();

        $armazem = $user->role === 'admin' ? Armazem::findOrFail($id) : $user->armazens()->findOrFail($id);


        if ($armazem) {
            $armazem->delete();
            return redirect()->route('ListagemArmazem')->with('success', 'Armazém deletado com sucesso.');
        } else {
            return 'Armazém não encontrado.';
        }
    }
}
