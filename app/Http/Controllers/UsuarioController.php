<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Cpf; // Importação da regra personalizada de CPF
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Exibir o formulário de cadastro de usuário
    public function index()
    {
        return view('cadastroUser');
    }

    // Função para cadastrar um novo usuário
    public function store(Request $request)
    {
        // Validação dos campos com a regra CPF
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'cpf' => ['required', 'string', 'unique:users,cpf', new Cpf()], // Validação do CPF com a regra
            'data_nascimento' => 'required|date',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user',
        ]);

        // Cria o novo usuário
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->cpf = $request->input('cpf');
        $user->data_nascimento = $request->input('data_nascimento');
        $user->role = $request->input('role');
        $user->password = Hash::make($request->input('password'));

        // Salva o usuário
        if (!$user->save()) {
            return redirect()->back()->withErrors(['Erro ao salvar o usuário.']);
        }

        return redirect()->route('listagem/user')->with('success', 'Usuário cadastrado com sucesso!');
    }

    // Listagem de usuários
    public function listagemUser()
    {
        $users = User::all(); // Buscar todos os usuários
        return view('ListagemUsuario', ['users' => $users]);
    }

    // Exibir formulário de edição de um usuário específico
    public function editUsuario($id)
    {
        $user = User::findOrFail($id);
        return view('EditarUsuario', ['user' => $user]);
    }

    // Atualizar um usuário específico
    public function atualizarUsuario(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validação dos dados
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'data_nascimento' => 'nullable|date',
            'role' => 'required|string|in:admin,user', // Inclua a validação para o campo role
            'cpf' => ['required', 'string', 'unique:users,cpf,' . $id, new Cpf()], // Validação do CPF também na atualização
        ]);

        // Atualizar os dados conforme o formulário
        if ($request->filled('name')) {
            $user->name = $request->input('name');
        }
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }
        if ($request->filled('data_nascimento')) {
            $user->data_nascimento = $request->input('data_nascimento');
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Atualiza o papel do usuário
        $user->role = $request->input('role');
        $user->cpf = $request->input('cpf'); // Atualiza o CPF

        $user->save();

        return redirect()->route('listagem/user')->with('success', 'Usuário atualizado com sucesso.');
    }

    // Deletar um usuário específico
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('listagem/user')->with('success', 'Usuário deletado com sucesso.');
    }

    // Página inicial do usuário comum
    public function homeUsuario()
    {
        $user = auth()->user(); // Usuário autenticado
        $produtos = $user->produtos; // Supondo que o relacionamento produtos esteja configurado
        $armazens = $user->armazens; // Supondo que o relacionamento armazens esteja configurado

        $ContagemProdutos = $produtos->count();
        $ContagemArmazens = $armazens->count();

        return view('Usuario', [
            'ContagemProdutos' => $ContagemProdutos,
            'ContagemArmazens' => $ContagemArmazens,
        ]);
    }
}
