<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armazem extends Model
{
    protected $table = '_armazens';

    protected $fillable = [
        'name', 'cep', 'rua', 'complemento', 'bairro', 'cidade', 'uf',
        'capacidade_total', 'espaco_disponivel', 'status', 'user_id'
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produto_armazem', 'armazem_name', 'produto_id')
                    ->withPivot('quantidade')
                    ->withTimestamps();
    }
}
