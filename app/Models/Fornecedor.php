<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = '_fornecedores'; // Nome da tabela

    protected $fillable = [
        'admin_id',
        'name',
        'cnpj',
        'cpf',
        'telefone',
        'cep',
        'rua',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'email',
        'status',
    ];

    // Relacionamento com o administrador
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}