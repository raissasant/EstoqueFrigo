<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = '_produtos';

    protected $fillable = [
        'user_id', 'name', 'descricao', 'codigo_produto', 'valor_compra',
        'valor_venda', 'altura', 'largura', 'peso', 'categoria', 'quantidade',
        'sku', 'data_validade'
    ];

    public function fornecedores()
    {
        return $this->belongsToMany(Fornecedor::class, 'fornecedor_produto');
    }

    public function armazens()
    {
        return $this->belongsToMany(Armazem::class, 'produto_armazem', 'produto_id', 'armazem_name')
                    ->withPivot('quantidade')
                    ->withTimestamps();
    }

    public function getQuantidadeTotalEmArmazensAttribute()
    {
        return $this->armazens->sum('pivot.quantidade');
    }
}
