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
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('produto_id'); // Comentado caso queira adicionar posteriormente
            $table->string('name_user');
            $table->integer('quantidade_mov');
            $table->string('codigo_produto');
            $table->string('tipo_mov');
            $table->string('armazem_origem')->nullable()->change();
            $table->string('armazem_destino')->nullable()->change();
            $table->string('codigo_entrada');
            $table->string('codigo_saida');
            $table->string('codigo_pedido');
            $table->timestamps();

            // Definindo chave estrangeira para garantir integridade referencial
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
        Schema::dropIfExists('movimentacoes');
    }
};
