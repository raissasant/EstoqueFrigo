<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoArmazem extends Model
{
    protected $table = 'produto_armazem';
    protected $fillable = ['produto_id', 'armazem_name', 'quantidade'];
    
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function armazem()
    {
        return $this->belongsTo(Armazem::class, 'armazem_name', 'name');
    }
}
