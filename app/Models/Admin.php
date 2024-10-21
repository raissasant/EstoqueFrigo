<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;


    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = [
        'password',
    ];

    public function users(){

        return $this->hasMany(User::class, 'admin_id');
    }

    public function fornecedores(){

         return $this->hasMany(Fornecedor::class);
}



}
