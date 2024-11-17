<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = '_fornecedores';

    protected $fillable = [
        'user_id',
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
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Relacionamento muitos-para-muitos com produtos
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'fornecedor_produto');
    }
}
