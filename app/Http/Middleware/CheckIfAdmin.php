<?php
namespace App\Http\Middleware;

// app/Http/Middleware/CheckIfAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    public function handle($request, Closure $next)
    {
        // Permitir acesso se o usuário estiver autenticado
        if (Auth::check()) {
            return $next($request);
        }

        // Redirecionar para a página de login se não estiver autenticado
        return redirect('/login')->with('error', 'Você precisa estar autenticado para acessar esta área.');
    }
}
