<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome do usuário
            $table->string('email')->unique(); // Email do usuário
            $table->string('password')->nullable(false); // Senha criptografada
            $table->string('cpf')->unique(); // CPF do usuário, valor único
            $table->date('data_nascimento'); // Data de nascimento do usuário
            $table->string('role')->default('user'); // Define o papel (user ou admin)
            $table->rememberToken(); // Token de 'lembrar-me'
            $table->timestamps(); // Timestamps padrão do Laravel (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}