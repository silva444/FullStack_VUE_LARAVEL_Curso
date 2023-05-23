<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // criando Fk , para relacionamento 1 , para muitos , de site contato e motivo_contatos;

          Schema::table('site_contatos',function(Blueprint $table){

              $table->unsignedBigInteger('motivo_contatos_id');
          });
          

          // permite executar uma query no baco de dados;
          // posso escrever qualquer instrução sql ;
          // pega os valores da coluna motivo contato para todos os registros e
          // adicionando  em motivo_contatos_id;
          DB::statement('update site_contatos set motivo_contatos_id = motivo_contato');

           //criando a fk e removendo a coluna motivo_contato;
          Schema::table('site_contatos',function(Blueprint $table){
             // references -> diz que essa coluna recebe uma chave primaria da colua id
             // da tabela motivo_contatos(on(''))
             $table->foreign('motivo_contatos_id')->references('id')->on('motivo_contatos');
             $table->dropColumn('motivo_contato');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Agora precisamos fazzer todas as operações do metod up, de modo ao contrario;

        // criar a coluna motivo contato;  e removendo a fk;
        Schema::table('site_contatos',function(Blueprint $table){
             $table->integer('motivo_contato');
             // o larevel utiliza um pradrão para o nomeação
             // nome da tebela , _ o nome da coluna _foreign;
             $table->dropForeign('site_contatos_motivo_contatos_id_foreign');
           
             // atribuir motivo_contatos_id para a coluna movito contato;
             DB::statement('update site_contatos set  motivo_contato = motivo_contatos_id');

             //removendo a conluna  motivo_contatos_id;
             Schema::table('site_contatos',function(Blueprint $table){

                $table->dropColumn('motivo_contatos_id');
            });

        });

    }
};
