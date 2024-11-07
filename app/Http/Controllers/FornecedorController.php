<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Auth;
use App\Rules\Cpf;
use App\Rules\CnpjValid;

class FornecedorController extends Controller
{
    // Método para listar todos os fornecedores - acessível para todos os usuários
    public function listagemFornecedor()
    {
        $fornecedores = Fornecedor::all();
        return view('listagemFornecedor', ['fornecedores' => $fornecedores]);
    }

    // Método para exibir a tela de criação de fornecedor - acessível apenas para administradores
    public function indexFornecedor()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

        return view('TelaFornecedor');
    }

    // Método para cadastrar um novo fornecedor - acessível apenas para administradores
    public function storeFornecedor(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

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
            'status' => 'required|string'
        ], [
            'cnpj.unique' => 'O CNPJ digitado já está em uso.',
            'cpf.unique' => 'O CPF digitado já está em uso.',
        ]);

        $fornecedor = new Fornecedor;
        $fornecedor->user_id = Auth::id();
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

    // Método para editar um fornecedor específico - acessível apenas para administradores
    public function EditFornecedor($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

        $fornecedor = Fornecedor::findOrFail($id);
        return view('EditFornecedor', ['fornecedor' => $fornecedor]);
    }

    // Método para atualizar um fornecedor específico - acessível apenas para administradores
    public function AtualizandoFornecedor(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

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

    // Método para excluir um fornecedor específico - acessível apenas para administradores
    public function DeleteFornecedor($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('listagemFornecedor')->with('success', 'Fornecedor deletado com sucesso.');
    }

    // Método de pesquisa de fornecedores - acessível para todos os usuários
    public function searchFornecedores(Request $request)
    {
        $searchTerm = $request->input('search');
        $status = $request->input('status');

        $query = Fornecedor::query();

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
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
