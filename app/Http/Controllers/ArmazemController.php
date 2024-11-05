<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Armazem;
use Auth;


class ArmazemController extends Controller
{
    // Método para exibir a tela de criação ou visualização de armazéns
    public function TelaArmazem()
    {
        return view('TelaArmazem');
    }

    // Método para armazenar um novo armazém no banco de dados
    public function storeArmazem(Request $request)
    {
        // Validação dos dados de entrada
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

        // Obtém o usuário autenticado
        $user = Auth::user();

        // Cria uma nova instância de Armazem e associa os dados do formulário
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
        $armazem->save(); // Salva o armazém no banco de dados

        // Redireciona para a rota de listagem de armazéns
        return redirect()->route('ListagemArmazem');
    }

    // Método para listar os armazéns do usuário
    public function ListagemArmazem()
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Verifica se o usuário é admin; caso contrário, lista apenas os armazéns dele
        $armazens = $user->role === 'admin' ? Armazem::all() : $user->armazens;

        // Retorna a view com a lista de armazéns
        return view('ListagemArmazem', ['armazens' => $armazens]);
    }

    // Método para exibir a página de edição de um armazém específico
    public function editArmazem($id)
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Verifica permissões: se admin, acessa qualquer armazém; se não, acessa apenas o próprio
        $armazem = $user->role === 'admin' ? Armazem::findOrFail($id) : $user->armazens()->findOrFail($id);

        // Retorna a view de edição com os dados do armazém
        return view('editArmazem', ['armazem' => $armazem]);
    }

    // Método para atualizar um armazém específico no banco de dados
    public function AtualizandoArmazem(Request $request, $id)
    {
        // Validação dos dados de entrada para atualização
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

        // Obtém o usuário autenticado e o armazém a ser atualizado
        $user = Auth::user();
        $armazem = $user->role === 'admin' ? Armazem::findOrFail($id) : $user->armazens()->findOrFail($id);

        // Atualiza o armazém apenas com os dados preenchidos
        $armazem->update($request->only([
            'name', 'cep', 'rua', 'complemento', 'bairro', 'cidade', 'uf', 'capacidade_total', 'espaco_disponivel', 'status'
        ]));

        // Redireciona para a lista de armazéns com uma mensagem de sucesso
        return redirect()->route('ListagemArmazem')->with('success', 'Armazém atualizado com sucesso.');

        // Código opcional para verificar campos individualmente
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

        $armazem->save(); // Salva o armazém no banco de dados após alterações

        return redirect()->route('ListagemArmazem'); // Redireciona após a atualização
    }

    // Método para excluir um armazém específico
    public function deleteArmazem($id)
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Verifica permissões: se admin, pode deletar qualquer armazém; se não, deleta apenas o próprio
        $armazem = $user->role === 'admin' ? Armazem::findOrFail($id) : $user->armazens()->findOrFail($id);

        // Se o armazém for encontrado, realiza a exclusão e redireciona
        if ($armazem) {
            $armazem->delete();
            return redirect()->route('ListagemArmazem')->with('success', 'Armazém deletado com sucesso.');
        } else {
            return 'Armazém não encontrado.';
        }
    }
}
