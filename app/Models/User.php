<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Armazem;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Armazem[] $armazens
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'data_nascimento',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin(){

        return $this->belongsTo(Admin::class, 'admin_id');

    }

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'user_id');
    }

    public function armazens()
{
    return $this->hasMany(Armazem::class, 'user_id');
}
}
