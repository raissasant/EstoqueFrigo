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
        Schema::create('fornecedor_produto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fornecedor_id');
            $table->unsignedBigInteger('produto_id');
            $table->timestamps();

            // Definindo chaves estrangeiras
            $table->foreign('fornecedor_id')->references('id')->on('_fornecedores')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('_produtos')->onDelete('cascade');

            // Definindo chave única para evitar duplicações
            $table->unique(['fornecedor_id', 'produto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedor_produto');
    }
};
