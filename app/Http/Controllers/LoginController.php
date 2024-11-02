<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Exibir o formulário de login.
     */
    public function showLoginForm()
    {
        return view('login'); // Exibe o formulário de login
    }

    /**
     * Processar o login (unificado para admin e usuário comum).
     */
    public function login(Request $request)
    {
        // Validação das credenciais (email e senha)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Tentativa de login com as credenciais fornecidas
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Regenerar a sessão para segurança
            $request->session()->regenerate();

            // Obter o usuário autenticado
            $user = Auth::user();

            // Verificar o papel do usuário
            if ($user->role === 'admin') { // Usando role para verificar se é admin
                return redirect()->route('homeAdmin'); // Redirecionar para o painel do admin
            } else {
                return redirect()->route('user.dashboard'); // Redirecionar para o painel do usuário comum
            }
        }

        // Lançar exceção se as credenciais estiverem incorretas
        throw ValidationException::withMessages([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    /**
     * Logout (para admin e usuário comum).
     */
    public function logout(Request $request)
    {
        // Deslogar o usuário
        Auth::logout();

        // Invalida a sessão
        $request->session()->invalidate();

        // Regenera o token CSRF
        $request->session()->regenerateToken();

        // Redireciona para a página de login
        return redirect('/login');
    }
}