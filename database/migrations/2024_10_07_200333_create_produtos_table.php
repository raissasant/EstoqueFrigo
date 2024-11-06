<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('_produtos', function (Blueprint $table) {  
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->string('descricao');
            $table->string('codigo_produto');
            $table->decimal('valor_compra', 10, 2);
            $table->decimal('valor_venda', 10, 2);
            $table->string('altura');
            $table->string('largura');
            $table->string('peso');
            $table->integer('quantidade');
            $table->string('categoria');
            $table->string('sku')->unique();
            $table->timestamps();

            // Chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('_produtos');  
    }
};
