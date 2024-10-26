<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Auth;
use App\Rules\Cpf;
use App\Rules\CnpjValid;

class FornecedorController extends Controller
{
    public function __construct()
    {
        // Middleware para restringir o acesso a usuários com o papel 'admin'
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('home')->withErrors(['Você não tem permissão para acessar esta área.']);
            }
            return $next($request);
        });
    }

    public function indexFornecedor()
    {
        return view('TelaFornecedor');
    }

    public function storeFornecedor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'cnpj' => ['nullable', 'string', new CnpjValid(), 'unique:_fornecedores,cnpj'],
            'cpf' =>  ['nullable', 'string', new Cpf(), 'unique:_fornecedores,cpf'],
            'telefone' => 'string',
            'cep' =>  'string',
            'rua' =>  'string',
            'complemento' => 'nullable|string',
            'bairro' =>  'string',
            'cidade' =>  'string',
            'uf' =>  'string',
            'email' => 'nullable|email',
            'status'=> 'required|string'],
            [
                'cnpj.unique' => 'O CNPJ digitado já está em uso.',
                'cpf.unique' => 'O CPF digitado já está em uso.',
            ]);

        $fornecedor = new Fornecedor;
        $fornecedor->user_id = Auth::id(); // Relacionando o fornecedor ao usuário logado (admin)
        $fornecedor->name = $request->input('name');
        $fornecedor->cnpj = $request->input('cnpj');
        $fornecedor->cpf = $request->input('cpf');
        $fornecedor->telefone = $request->input('telefone');
        $fornecedor->cep = $request->input('cep');
        $fornecedor->rua = $request->input('rua');
        $fornecedor->complemento = $request->input('complemento');
        $fornecedor->bairro = $request->input('bairro');
        $fornecedor->cidade = $request->input('cidade');
        $fornecedor->uf = $request->input('uf');
        $fornecedor->email = $request->input('email');
        $fornecedor->status = $request->input('status');
        $fornecedor->save();

        return redirect()->route('listagemFornecedor')->with('success', 'Fornecedor cadastrado com sucesso.');
    }

    public function listagemFornecedor()
    {
        $fornecedores = Fornecedor::all();
        return view('listagemFornecedor', ['fornecedores' => $fornecedores]);
    }

    public function EditFornecedor($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('EditFornecedor', ['fornecedor' => $fornecedor]);
    }

    public function AtualizandoFornecedor(Request $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);

        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'cep' => 'nullable|string',
            'rua' => 'string',
            'complemento' => 'nullable|string',
            'bairro' => 'string',
            'cidade' => 'string',
            'uf' => 'string',
            'status' => 'nullable|in:ativo,inativo',
        ]);

        $fornecedor->update($request->all());

        return redirect()->route('listagemFornecedor')->with('success', 'Fornecedor atualizado com sucesso.');
    }

    public function DeleteFornecedor($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('listagemFornecedor')->with('success', 'Fornecedor deletado com sucesso.');
    }

    public function searchFornecedores(Request $request)
    {
        $searchTerm = $request->input('search');
        $status = $request->input('status');

        $query = Fornecedor::query();

        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('cnpj', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $fornecedores = $query->get();

        return view('listagemFornecedor', ['fornecedores' => $fornecedores]);
    }
}
