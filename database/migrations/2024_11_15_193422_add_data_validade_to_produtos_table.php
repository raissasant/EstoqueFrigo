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
        Schema::table('_produtos', function (Blueprint $table) {
            // Adiciona a coluna data_validade
            $table->date('data_validade')->nullable(); // A coluna será opcional (nullable)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_produtos', function (Blueprint $table) {
            // Remove a coluna data_validade
            $table->dropColumn('data_validade');
        });
    }
};
