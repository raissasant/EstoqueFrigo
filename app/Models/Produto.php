<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    // Especificando o nome da tabela personalizada no banco de dados
    protected $table = '_produtos';

    /**
     * Relacionamento: um produto pertence a um usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Define a relação com a tabela de usuários através de 'user_id'
    }
}
