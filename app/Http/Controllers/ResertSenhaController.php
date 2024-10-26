<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormularioMail;

class ResertSenhaController extends Controller
{
    // Exibe a view para solicitar nova senha
    public function NovaSenha()
    {
        return view('resertPassword'); // Renderiza a view do formulário
    }

    // Lida com o envio de e-mail após a solicitação
    public function PedirSenha(Request $request)
    {
        // Valida os campos do formulário com mensagens personalizadas
        $request->validate([
            'email' => 'required|email',
            'mensagem' => 'required|string',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Insira um endereço de email válido.',
            'mensagem.required' => 'O campo mensagem é obrigatório.',
        ]);

        // Captura os dados diretamente dos campos do formulário
        $email = $request->input('email');
        $mensagem = $request->input('mensagem');

        // Envia o e-mail com os dados capturados
        Mail::to($email)->send(new FormularioMail($email, $mensagem));

        // Retorna uma mensagem de sucesso após o envio do e-mail
        return back()->with('success', 'E-mail enviado com sucesso!');
    }
}
