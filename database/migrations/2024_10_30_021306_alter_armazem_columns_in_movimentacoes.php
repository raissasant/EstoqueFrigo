<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterArmazemColumnsInMovimentacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            // Altere o tipo das colunas para string
            $table->string('armazem_origem')->change();
            $table->string('armazem_destino')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            // Reverte o tipo das colunas para unsignedBigInteger, se necessário
            $table->unsignedBigInteger('armazem_origem')->change();
            $table->unsignedBigInteger('armazem_destino')->change();
        });
    }
}
