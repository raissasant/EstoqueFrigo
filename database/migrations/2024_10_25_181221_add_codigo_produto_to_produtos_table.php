<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodigoProdutoToProdutosTable extends Migration
{
    public function up()
    {
        Schema::table('_produtos', function (Blueprint $table) {
            $table->string('codigo_produto')->after('descricao'); // Adiciona o campo após a coluna 'descricao'
        });
    }

    public function down()
    {
        Schema::table('_produtos', function (Blueprint $table) {
            $table->dropColumn('codigo_produto');
        });
    }
}
