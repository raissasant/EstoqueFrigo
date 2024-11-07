<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Cpf;
use App\Models\User;
use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Armazem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            'cpf' => ['required', 'string', 'unique:users,cpf', new Cpf()],
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
        $users = User::all();
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
            'role' => 'required|string|in:admin,user',
            'cpf' => ['required', 'string', 'unique:users,cpf,' . $id, new Cpf()],
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

        // Atualiza o papel do usuário e o CPF
        $user->role = $request->input('role');
        $user->cpf = $request->input('cpf');

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

        // Relacionamentos para produtos, armazéns e movimentações
        $produtos = $user->produtos;
        $armazens = $user->armazens;
        $movimentacoes = $user->movimentacoes;

        // Contagens para o dashboard do usuário comum
        $contagemProduto = $produtos->count();
        $contagemArmazem = $armazens->count();
        $contagemMovimentacao = $movimentacoes->count();
        
        // Contagem dos fornecedores para listagem (para ambos tipos de usuário)
        $contagemFornecedor = Fornecedor::count();
        $totalProdutosEmEstoque = Produto::sum('quantidade');

        // Dados para os gráficos usando '_armazens' e '_produtos' como nomes das tabelas
        $estoquePorArmazem = DB::table('produto_armazem')
            ->join('_armazens', 'produto_armazem.armazem_name', '=', '_armazens.name')
            ->join('_produtos', 'produto_armazem.produto_id', '=', '_produtos.id')
            ->select('_armazens.name as armazem', '_produtos.descricao as produto', DB::raw('SUM(produto_armazem.quantidade) as total'))
            ->groupBy('_armazens.name', '_produtos.descricao')
            ->get()
            ->groupBy('armazem');

        $estoquePorProduto = Produto::select('descricao', 'quantidade')->pluck('quantidade', 'descricao');

        return view('Usuario', [
            'contagemProduto' => $contagemProduto,
            'contagemArmazem' => $contagemArmazem,
            'contagemMovimentacao' => $contagemMovimentacao,
            'contagemFornecedor' => $contagemFornecedor,
            'totalProdutosEmEstoque' => $totalProdutosEmEstoque,
            'estoquePorArmazem' => $estoquePorArmazem,
            'estoquePorProduto' => $estoquePorProduto,
        ]);
    }
}
