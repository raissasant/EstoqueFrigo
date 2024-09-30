<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = '_fornecedores'; // Nome da tabela, se for diferente do padrão 'fornecedores'

    // Relacionamento com Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id'); // 'admin_id' é a chave estrangeira
    }
}
