<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produto_armazem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->string('armazem_name'); // Usando o nome do armazém
            $table->integer('quantidade');
            $table->timestamps();

            // Chave estrangeira para o produto
            $table->foreign('produto_id')->references('id')->on('_produtos')->onDelete('cascade');
            // Não estamos usando chave estrangeira para armazém, pois estamos usando o nome
            // Restrição de unicidade para garantir que um produto só possa estar em um armazém uma vez
            $table->unique(['produto_id', 'armazem_name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('produto_armazem');
    }
};
