<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado e se é um administrador
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Redireciona para o painel de usuário comum (homeUsuario) se não for admin, ou para login se não estiver autenticado
        return Auth::check() 
            ? redirect()->route('homeUsuario')->with('error', 'Acesso negado: área restrita ao administrador.')
            : redirect('/login')->with('error', 'Você precisa estar autenticado para acessar esta área.');
    }
}
