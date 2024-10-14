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
        Schema::create('_produtos', function (Blueprint $table) {  
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');  // Coluna user_id para associar com a tabela users
            $table->string('descricao');
            $table->decimal('valor_compra', 10, 2);  // Valores monetários  "decimal"
            $table->decimal('valor_venda', 10, 2);
            $table->string('altura');
            $table->string('largura');
            $table->string('peso');
            $table->integer('quantidade');  // Quantidade deve ser um número inteiro
            $table->string('categoria');
            $table->string('sku')->unique();  // O SKU é único
            $table->timestamps();

            // Definindo a chave estrangeira que referencia a tabela users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_produtos');  
    }
};
