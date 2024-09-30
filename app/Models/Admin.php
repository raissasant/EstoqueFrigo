<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Fornecedor;
use App\Models\User;


class Admin extends Authenticatable
{
    use HasFactory;


    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = [
        'password',
    ];

    public function users()
    {

        return $this->hasMany(User::class, 'admin_id');
    }

    public function fornecedor()
    {
        return $this->hasMany(Fornecedor::class, 'admin_id');  // Certifique-se de que a chave estrangeira está correta
    }
}
