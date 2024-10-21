<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    /**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Produto[] $produtos
 */
    protected $table = '_produtos';
    // Definindo o relacionamento com o User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
