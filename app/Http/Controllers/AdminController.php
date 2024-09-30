<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;

class AdminController extends Controller
{
    // Mostrar a página de login
    public function login()
    {
        return view('login');
    }

    //  Função para cadastrar um novo admin
    public function store()
    {
        $admin = new Admin;
        $admin->name = 'Seara';
        $admin->email = 'seara@gmail.com';
        $admin->password = bcrypt('123456');
        $admin->save();

        return "Admin salvo com sucesso!";
    }

################################################################################
    // Função  para autenticar o administrador
    public function loginUpdate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Determinar o limite de tentativas do usuário
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 4)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));

        //Exibir a mensagem que o usuário excedeu o login e tem que esperar. A menssagem de erro está aqui
        throw ValidationException::withMessages([
            'email'=> [trans('auth.throttle', ['seconds' => $seconds])]
          ]);

}

        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();

            // Visualiza  o usuário autenticado
            $admin = Auth::guard('admins')->user();

            // Definindo  as variáveis de sessão
            $request->session()->put('admin_id', $admin->id);
            $request->session()->put('user_name', $admin->name);
            $request->session()->put('user_email', $admin->email);

           // Limpar as tentativas após o login com as credenciais certas
           RateLimiter::clear($this->throttleKey($request));

            return redirect()->route('homeAdmin');
        }

          //Fazer a contagem de tentativas de falhas
          RateLimiter::hit($this->throttleKey($request));


        return redirect()->route('login')->withErrors(['email' => 'Credenciais inválidas, verifique novamente']);
    }

    protected function throttleKey(Request $request){
        return strtolower($request->input('email')).'|' .$request->ip();
    }


#############################################################################
    // Página do administrador
    public function index()
    {
        return view('homeAdmin');
    }


    // Função para logout
  public function logout(Request $request)
{
    Auth::guard('admins')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}



  public function show($id)
{

    $admin = Auth::guard('admins')->user();
    $users = $admin->users;

    $fornecedores = $admin->fornecedores;

}


}



// Ges-Estoque
