<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//  RELACIONAMENTO DE 1 PARA MUITOS(N);
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('unidade',5);
            $table->string('descricao',40);
            // a chave primaria de cardialidade 1 , viaja com chave estrangeria para 
            // a tabela tenha cardinaliadade ;
            $table->timestamps();
        });

       
        // adicionar o relacionamento com a tabela produtos;
        // seleciona a tabela produtos;
        // isso adiciona uma nova coluna na table proutos;
        Schema::table('produtos', function(Blueprint $table){
            $table->unsignedBigInteger('unidade_id');

            // constraint (foreing key)
            //foreign -> qual coluna vai receber a chave estrangeira;
            //references -> referencia a origem (a coluna id da tabela unidades)
            // on-> diz qual a tabela 
            $table->foreign('unidade_id')->references('id')->on('unidades');
            // constraint de integridade referencial;


        });
        // adicionar o relacionamento  com a tabela produtos detahles;

        Schema::table('produto_detalhes', function(Blueprint $table){
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //  remover o realcionamento com a tabela produtos detalhes;
        Schema::table('produto__detalhes', function(Blueprint $table){

            // remover a FK 
            $table->dropForeign('produto__detalhes_unidade_id_foreign'); // convenção do varavel;
            // no produtos detalhes remova a conlunas unidade_id;

            
            // remover  a conluna ; é o inverso da criação ;
            $table->dropColumn('unidade_id');

        });

        Schema::table('produtos', function(Blueprint $table){

            // remover a FK 
            $table->dropForeign('produtos_unidade_id_foreign'); // convenção do varavel;
            // no produtos detalhes remova a conlunas unidade_id;


            // remover  a conluna ; é o inverso da criação ;
            $table->dropColumn('unidade_id');
        });

        // remover o relacionamento com a tablea produtos
        // e deopis apaga a tabela unidads;





        // antes de excluir a tabela unidades tenho que remover as chaves estrangeiras;
        // se não pode dar erros ;
        Schema::dropIfExists('unidades');


    }
};
