<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormularioMail;

class ResertSenhaController extends Controller
{
    public function NovaSenha()
    {
        // Tela para pedir nova senha
        return view('resertPassword');
    }

    public function PedirSenha(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'mensagem' => 'required|string',
        ]);

        //  Array de dados com as informações do formulário
        $data = [
            'name' => $request->name,
            'mensagem' => $request->mensagem,
        ];

        // Envia o email com os dados
        Mail::to(config('mail.from.address'))->send(new FormularioMail($data));

        // Retorna uma mensagem de  que a solicitação de nova senha foi um sucesso
        return "Email enviado com sucesso";
    }
}
