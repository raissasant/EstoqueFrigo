<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'data_nascimento', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Verifica se o usuário é administrador
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Relacionamento com Produtos (um usuário tem muitos produtos)
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class); // Define que um usuário pode ter muitos produtos
    }

    /**
     * Relacionamento com Armazéns (um usuário tem muitos armazéns)
     */
    public function armazens()
    {
        return $this->hasMany(Armazem::class); // Define que um usuário pode ter muitos armazéns
    }
}
