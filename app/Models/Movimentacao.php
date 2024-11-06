<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table ='movimentacoes';

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'codigo_produto', 'codigo_produto');
    }
    
    public function armazem()
    {
        return $this->belongsTo(Armazem::class, 'armazem_destino', 'id');
    }
    
}