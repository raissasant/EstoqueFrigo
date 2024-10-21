<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Fornecedor;
use App\Rules\Cpf;
use App\Rules\CnpjValid;
use Illuminate\Validation\ValidationException;



class FornecedorController extends Controller
{
    //

    public function indexFornecedor(){
        return view('TelaFornecedor');
        //return view('EditFornecedor');

    }


    public function storeFornecedor(Request $request){
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
            'status'=> 'string|required'],
            [
            'cnpj.unique' => 'O CNPJ digitado já está em uso.',
            'cpf.unique' => 'O CPF digitado já está em uso.',
        ]);

        $admin = Auth::guard('admins')->user();

        $fornecedor = new Fornecedor;
        $fornecedor->admin_id = $admin->id;
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

        //return 'Fornecedor salvo com sucesso';
        return redirect()->route('listagemFornecedor');



    }

    public function listagemFornecedor(){
        $admin = Auth::guard('admins')->user();
        $fornecedores = $admin->fornecedores;

        return view('listagemFornecedor', ['fornecedores' => $fornecedores]);
    }

    public function EditFornecedor($id)
    {
        /** @var Admin $admin */
        $admin = Auth::guard('admins')->user();

        // Busca o fornecedor associado ao admin logado
        $fornecedor = $admin->fornecedores()->where('id', $id)->firstOrFail();

        // Retorna a view de edição com o fornecedor encontrado
        return view('EditFornecedor', ['fornecedor' => $fornecedor]);
    }


    public function AtualizandoFornecedor(Request $request, $id)
    {
        /** @var Admin $admin */
        $admin = Auth::guard('admins')->user();

        // Busca o fornecedor associado ao admin logado
        $fornecedor = $admin->fornecedores()->where('id', $id)->firstOrFail();

        // Validação dos dados do formulário
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

        // Atualizando os campos preenchidos
        if ($request->filled('name')) {
            $fornecedor->name = $request->input('name');
        }
        if ($request->filled('email')) {
            $fornecedor->email = $request->input('email');
        }
        if ($request->filled('telefone')) {
            $fornecedor->telefone = $request->input('telefone');
        }
        if ($request->filled('cep')) {
            $fornecedor->cep = $request->input('cep');
        }
        if ($request->filled('rua')) {
            $fornecedor->rua = $request->input('rua');
        }
        if ($request->filled('complemento')) {
            $fornecedor->complemento = $request->input('complemento');
        }
        if ($request->filled('bairro')) {
            $fornecedor->bairro = $request->input('bairro');
        }
        if ($request->filled('cidade')) {
            $fornecedor->cidade = $request->input('cidade');
        }
        if ($request->filled('uf')) {
            $fornecedor->uf = $request->input('uf');
        }
        if ($request->filled('status')) {
            $fornecedor->status = $request->input('status');
        }

        // Salva as alterações no banco de dados
        $fornecedor->save();

        // Redireciona para a listagem de fornecedores com uma mensagem de sucesso
        return redirect()->route('listagemFornecedor')->with('success', 'Fornecedor atualizado com sucesso.');
    }

    public function DeleteFornecedor($id)
    {
        /** @var Admin $admin */
        $admin = Auth::guard('admins')->user();

        // Busca o fornecedor associado ao admin logado
        $fornecedor = $admin->fornecedores()->findOrFail($id);

        // Deleta o fornecedor
        $fornecedor->delete();

        // Redireciona para a listagem de fornecedores com uma mensagem de sucesso
        return redirect()->route('listagemFornecedor')->with('success', 'Fornecedor deletado com sucesso.');
    }


    public function searchFornecedores(Request $request)
{
    /** @var Admin $admin */
    $admin = Auth::guard('admins')->user();

    // Obtendo os parâmetros de busca do request
    $searchTerm = $request->input('search');
    $status = $request->input('status');

    // Iniciando a query para buscar fornecedores do admin logado
    $query = $admin->fornecedores();

    // Se houver um termo de busca, aplica o filtro na query
    if ($searchTerm) {
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('cnpj', 'LIKE', '%' . $searchTerm . '%');
        });
    }

    // Se houver um filtro de status, aplica o filtro na query
    if ($status) {
        $query->where('status', $status);
    }

    // Executa a query e busca os fornecedores
    $fornecedores = $query->get();

    // Retorna a view com os fornecedores filtrados
    return view('listagemFornecedor', ['fornecedores' => $fornecedores]);
}









}













