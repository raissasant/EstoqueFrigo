<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoArmazem extends Model
{
    protected $table = 'produto_armazem';

    protected $fillable = [
        'produto_id', // ID do produto na tabela _produtos
        'armazem_name', // Nome do armazém
        'quantidade' // Quantidade de produtos no armazém
    ];

    /**
     * Relacionamento com Produto: um ProdutoArmazem pertence a um Produto.
     */
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    /**
     * Relacionamento com Armazem: um ProdutoArmazem pertence a um Armazem.
     * Usamos a chave 'name' como identificador do armazém em vez de um id único.
     */
   public function armazens()
{
    return $this->belongsToMany(Armazem::class, 'produto_armazem', 'produto_id', 'armazem_name', 'id', 'name')
                ->withPivot('quantidade')
                ->withTimestamps();
}
}
