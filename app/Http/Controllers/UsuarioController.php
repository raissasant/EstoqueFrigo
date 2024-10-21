<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Cpf; #--- Importando o Rules CPF do Laravel --# php artisan make:rule CPF
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;


class UsuarioController extends Controller
{
    //

    public function index(){
        return view('cadastroUser');
    }


    public function store(Request $request){
        //validação dos dados do form
        $request->validate([
        'name' => 'required|string|max:60',
        'email' => 'required|email',
        'password' => 'required|string|max:8',
        'cpf' => ['required', 'string', new Cpf], //Aqui valida o CPF
        'data_nascimento' => 'required|string',

       ]);

        $admin = Auth::guard('admins')->user();


        $user = new User;
        $user->admin_id = $admin->id;
        $user->name= $request->input('name');
        $user->email= $request->input('email');
        $user->password= bcrypt($request->input('password'));
        $user->cpf = $request->input('cpf');
        $user->data_nascimento= $request->input('data_nascimento');
        $user->save();

        //return "Salvo com sucesso";
        return redirect()->route('listagem/user');


   }

    public function ListagemUser(){
        $admin = Auth::guard('admins')->user();

        // Buscar usuários associados ao admin logado
         $users = $admin->users;


        return view('ListagemUsuario',['users' => $users]);

    }

    public function editUsuario($id)
    {
        /** @var Admin $admin */
        $admin = Auth::guard('admins')->user();

        // Busca o usuário associado ao admin logado pelo ID
        $user = $admin->users()->where('id', $id)->firstOrFail();

        // Retorna a view de edição do usuário
        return view('EditarUsuario', ['user' => $user]);
    }


    public function atualizarUsuario(Request $request, $id)
    {
        /** @var Admin $admin */
        $admin = Auth::guard('admins')->user();

        // Busca o usuário associado ao admin logado
        $user = $admin->users()->where('id', $id)->firstOrFail();

        // Validação dos dados do formulário
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string|min:6',
            'data_nascimento' => 'nullable|date',
        ]);

        // Atualiza os campos preenchidos
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
            $user->password = bcrypt($request->input('password'));
        }

        // Salva as alterações no banco de dados
        $user->save();

        // Redireciona com mensagem de sucesso
        return redirect()->route('listagem/user')->with('success', 'Usuário atualizado com sucesso.');
    }


    public function destroy($id)
    {
        /** @var Admin $admin */
        $admin = Auth::guard('admins')->user();

        // Busca o usuário associado ao admin logado
        /** @var User|null $user */
        $user = $admin->users()->where('id', $id)->first();

        // Verifica se o usuário foi encontrado antes de tentar deletar
        if ($user) {
            $user->delete();
            return 'Usuário deletado(a) com sucesso';
        }

        return 'Usuário não encontrado';
    }




    public function loginUser(){
        return view('loginUsuario');
    }



    public function logandoUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|max:8',
        ]);



        $credentials = $request->only('email', 'password');

        // Determinar o limite de tentativas do usuário
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 4)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));

        //Exibir a mensagem que o usuário excedeu o login e tem que esperar. A menssagem de erro está aqui
        throw ValidationException::withMessages([
            'email'=> [trans('auth.throttle', ['seconds' => $seconds])]
          ]);

}


        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida
            $request->session()->regenerate();

        // Obter o usuário autenticado
        $user = Auth::user();


            // Definindo as variáveis de sessão
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_name', $user->name);
            $request->session()->put('user_email', $user->email);

           // Limpar as tentativas após o login com as credenciais certas
           RateLimiter::clear($this->throttleKey($request));

            return redirect()->route('homeUsuario');
        }

          //Fazer a contagem de tentativas de falhas
          RateLimiter::hit($this->throttleKey($request));


        return redirect()->route('login-user')->withErrors(['email' => 'Credenciais inválidas, verifique novamente']);
    }

    protected function throttleKey(Request $request){
        return strtolower($request->input('email')).'|' .$request->ip();

    }


    public function homeUsuario(){
        $user = Auth::user();
        $produtos = $user->produtos;
        $armazens = $user->armazens;

        $ContagemProdutos = $produtos->count();
        $ContagemArmazens = $armazens->count();

        return view('Usuario',['ContagemProdutos' => $ContagemProdutos, 'ContagemArmazens' => $ContagemArmazens]);
    }






 public function logout(Request $request)
{
    $user = Auth::user();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login-user');
}



}
