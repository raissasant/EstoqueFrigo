<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armazem extends Model
{
    use HasFactory;


    protected $table = '_armazens';

    // Campos permitidos para atribuição em massa
    protected $fillable = [
        'name',
        'cep',
        'rua',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'capacidade_total',
        'espaco_disponivel',
        'status',
        'user_id'
    ];


    // Especificando o nome da tabela no banco de dados
    protected $table = '_armazens';


    /**
     * Relacionamento: um armazém pertence a um usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function movimentacoes()
{
    return $this->hasMany(Movimentacao::class, 'armazem_destino', 'id');
}

public function produtos()
{
    return $this->hasMany(ProdutoArmazem::class, 'armazem_name', 'name');
}

}
