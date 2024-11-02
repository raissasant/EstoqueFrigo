<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoArmazemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_armazem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id'); // Referência para a tabela _produtos
            $table->string('armazem_name'); // Nome do armazém como string
            $table->integer('quantidade')->default(0);
            $table->timestamps();

            // Define a chave estrangeira para 'produto_id' com 'id' em '_produtos'
            $table->foreign('produto_id')->references('id')->on('_produtos')->onDelete('cascade');

            // Índice único para garantir que cada combinação de produto e armazém seja única
            $table->unique(['produto_id', 'armazem_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_armazem');
    }
}
