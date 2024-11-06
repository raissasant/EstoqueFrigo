<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormularioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $mensagem;

    // Construtor que recebe os dados do formulário
    public function __construct($email, $mensagem)
    {
        $this->email = $email;
        $this->mensagem = $mensagem;
    }

    // Método para montar o e-mail que será enviado
    public function build()
    {
        return $this->view('emailsenha')  // Usando a view emailsenha.blade.php
                    ->subject('Solicitação de Troca de Senha')  // Título do e-mail
                    ->with([
                        'email' => $this->email,
                        'mensagem' => $this->mensagem,
                    ]);
    }
}