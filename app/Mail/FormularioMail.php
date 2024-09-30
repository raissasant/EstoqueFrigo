<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormularioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Cria uma nova instância da mensagem.
     *
     * @param array $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this
            ->from(config('mail.from.address'))
            ->subject('Contato suporte Gestão Estoque')
            ->view('emailsenha')
            ->with('data', $this->data);  // Passa a variável $data para a visão
    }
}
