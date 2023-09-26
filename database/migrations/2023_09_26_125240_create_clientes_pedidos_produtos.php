<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->timestamps();
        });
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();
            // criação da constraint 
            // o cliente id cem da tabela clientes da coluna id 
            // é uma chave estrangeira FK;
            // relacionamento 1, n ,
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
        Schema::create('pedidos_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('produto_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // desabilita as contrains para poder apagar as tabelas 
        // caso não faça isso vai da erro ao apgar as tabelas 
        // pois a tabela tem relacinamento ente elas;
        
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('clientes');
        Schema::dropIfExists('pedidos');
        Schema::dropIfExists('pedidos_produtos');
        // deopis de apagar reabilitamos a validação de contraint;
        Schema::enableForeignKeyConstraints();
    }
};
