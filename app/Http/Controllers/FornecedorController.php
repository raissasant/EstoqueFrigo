<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class FornecedorController extends Controller
{
    // Método para listar todos os fornecedores
    public function listagemFornecedor()
    {
        $fornecedores = Fornecedor::with('produtos')->get(); // Carrega fornecedores com produtos associados
        return view('listagemFornecedor', compact('fornecedores'));
    }

    // Método para exibir a tela de criação de fornecedor
    public function indexFornecedor()
    {
        // Permite apenas para administradores
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

        return view('TelaFornecedor');
    }

    // Método para cadastrar um novo fornecedor
    public function storeFornecedor(Request $request)
    {
        // Permite apenas para administradores
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

        $request->validate([
            'name' => 'required|string|max:60',
            'cnpj' => 'nullable|string|unique:_fornecedores,cnpj',
            'cpf' => 'nullable|string|unique:_fornecedores,cpf',
            'telefone' => 'required|string',
            'cep' => 'required|string',
            'rua' => 'required|string',
            'complemento' => 'nullable|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'uf' => 'required|string',
            'email' => 'nullable|email',
            'status' => 'required|string'
        ], [
            'cnpj.unique' => 'O CNPJ digitado já está em uso.',
            'cpf.unique' => 'O CPF digitado já está em uso.',
        ]);

        $fornecedor = Fornecedor::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'cnpj' => $request->input('cnpj'),
            'cpf' => $request->input('cpf'),
            'telefone' => $request->input('telefone'),
            'cep' => $request->input('cep'),
            'rua' => $request->input('rua'),
            'complemento' => $request->input('complemento'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'uf' => $request->input('uf'),
            'email' => $request->input('email'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('listagemFornecedor')->with('success', 'Fornecedor cadastrado com sucesso.');
    }

    // Método para exibir a tela de edição de um fornecedor específico
    public function EditFornecedor($id)
    {
        // Permite apenas para administradores
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

        $fornecedor = Fornecedor::with('produtos')->findOrFail($id);
        return view('EditFornecedor', compact('fornecedor'));
    }

    // Método para atualizar um fornecedor específico
    public function AtualizandoFornecedor(Request $request, $id)
    {
        // Permite apenas para administradores
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

        $fornecedor = Fornecedor::findOrFail($id);

        $request->validate([
            'name' => 'nullable|string|max:60',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'cep' => 'nullable|string',
            'rua' => 'nullable|string',
            'complemento' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'uf' => 'nullable|string',
            'status' => 'nullable|in:ativo,inativo',
        ]);

        $fornecedor->update($request->all());

        return redirect()->route('listagemFornecedor')->with('success', 'Fornecedor atualizado com sucesso.');
    }

    // Método para excluir um fornecedor específico
    public function DeleteFornecedor($id)
    {
        // Permite apenas para administradores
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('homeUsuario')->withErrors(['Você não tem permissão para acessar esta área.']);
        }

        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->produtos()->detach(); // Remove a associação com produtos antes de excluir
        $fornecedor->delete();

        return redirect()->route('listagemFornecedor')->with('success', 'Fornecedor deletado com sucesso.');
    }

    // Método de pesquisa de fornecedores
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

        $fornecedores = $query->with('produtos')->get();

        return view('listagemFornecedor', compact('fornecedores'));
    }
}
