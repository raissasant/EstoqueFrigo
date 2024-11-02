<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'data_nascimento', 'role'

    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Verifica se o usuário é administrador
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


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
        return $this->hasMany(Armazem::class);
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }
}
