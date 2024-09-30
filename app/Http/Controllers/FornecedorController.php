<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fornecedor;
use App\Rules\Cpf;
use App\Rules\CnpjValid;




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

        return 'Fornecedor salvo com sucesso';

    }

    public function listagemFornecedor(){
        $admin = Auth::guard('admins')->user();
        $fornecedores = $admin->fornecedor;

        return view('listagemFornecedor', ['fornecedores' => $fornecedores]);
    }

       public function EditFornecedor($id)
    {
        $admin = Auth::guard('admins')->user();
        $fornecedor = $admin->fornecedor()->where('id', $id)->firstOrFail();
        //dd($fornecedor);

        return view('EditFornecedor', ['fornecedor' => $fornecedor]);
    }

    public function AtualizandoFornecedor(Request $request, $id)
    {
        $admin = Auth::guard('admins')->user();
        $fornecedor = $admin->fornecedor()->where('id', $id)->firstOrFail();


        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'cep' =>  'nullable|string',
            'rua' =>  'string',
            'complemento' =>  'nullable|string',
            'bairro' =>  'string',
            'cidade' =>  'string',
            'uf' =>  'string',
            'email' => 'nullable|email',
            'status' => 'nullable|in:ativo,inativo',
        ]);



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



            $fornecedor->save();

           //return 'Fornecedor atualizado com sucesso';
            return redirect()->route('listagemFornecedor');


    }


    public function DeleteFornecedor($id){
        $admin = Auth::guard('admins')->user();


    $fornecedor = $admin->fornecedor()->find($id);


    if ($fornecedor) {
        $fornecedor->delete();
        //return 'Fornecedor deletado com sucesso.';
        return redirect()->route('listagemFornecedor');
    } else {
        return 'Fornecedor não encontrado.';
    }

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
















