<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    // Definindo a tabela associada ao modelo
    protected $table = 'movimentacoes';

    // Adicionando o campo 'user_id' ao array $fillable para permitir a atribuição em massa
    protected $fillable = [
        'user_id',  // Adicione 'user_id' ao array fillable
        'codigo_produto',
        'quantidade_mov',
        'tipo_mov',
        'armazem_origem',
        'armazem_destino',
    ];

    // Relacionamento com o Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'codigo_produto', 'codigo_produto');
    }

    // Relacionamento com o Armazem
    public function armazem()
    {
        return $this->belongsTo(Armazem::class, 'armazem_destino', 'id');
    }
}
