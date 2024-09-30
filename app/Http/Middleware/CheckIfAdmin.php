<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request); // Permite o acesso se o usuário for admin
        }

        return redirect('/login'); // Redireciona para a página inicial se o usuário não for admin
    }
}
