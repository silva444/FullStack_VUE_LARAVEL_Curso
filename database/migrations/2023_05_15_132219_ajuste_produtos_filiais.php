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
        // criando a tabela filiais
        Schema::create('filiais' , function(Blueprint $table){
            $table->id();
            $table->string('filial',30);
            $table->timestamps();
        });

        // criando a tablea  produto_filiais
        Schema::create('produto_filiais' , function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('filial_id');
            $table->unsignedBigInteger('produto_id');
            // como estas colunas variam de filial para filial 
            // temos que replicalas aqui -> e remover da tabela produtos;
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');
            $table->timestamps();

            // constraint de ralcionamento;

            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

        // removendo colunas da tabela produto , pois elas tem depencia com a filial;
         
        Schema::table('produtos' , function(Blueprint $table){

            // $table->dropColumn('preco_venda');
            // $table->dropColumn('estoque_minimo');
            // $table->dropColumn('estoque_maximo');

             $table->dropColumn(['preco_venda','estoque_minimo','estoque_maximo']);

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // adicionar colunas na tabela produtos 
        Schema::table('produtos' , function(Blueprint $table){
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');

        });

        // como as contrains estão relacionadas a tabela produto filiais;
        // podemos apagar a tabela direto sem precisasr antes remover as chvas FK e colunas ;


        // remover caso exista essa tabela;
        Schema::dropIfExists('produto_filiais');
        Schema::dropIfExists('filiais');
    }
};
