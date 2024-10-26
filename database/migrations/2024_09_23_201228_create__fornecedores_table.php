<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_fornecedores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Adicionando a coluna user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Chave estrangeira
            $table->string('name');
            $table->string('cnpj', 18)->unique();
            $table->string('cpf', 14)->unique()->nullable();
            $table->string('telefone');
            $table->string('cep');
            $table->string('rua');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->string('email');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_fornecedores');
    }
};
