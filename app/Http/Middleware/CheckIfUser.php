<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfUser
{
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado e se é um usuário comum
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request);
        }

        // Redireciona para o painel de admin se o usuário for admin, ou para o login se não estiver autenticado
        return Auth::check() 
            ? redirect()->route('admin.dashboard')->with('error', 'Acesso negado: esta área é restrita a usuários comuns.')
            : redirect('/login')->with('error', 'Você precisa estar autenticado para acessar esta área.');
    }
}
