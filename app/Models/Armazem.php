<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Armazem extends Model
{
    use HasFactory;

    // Especificando o nome da tabela no banco de dados
    protected $table = '_armazens';

    /**
     * Relacionamento: um armazém pertence a um usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Cada armazém pertence a um usuário
    }
}
