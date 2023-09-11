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
        Schema::create('produto_detalhes', function (Blueprint $table) {
            $table->id();
            // a chave estrngeira precisa ter o mesmo tipo da chave primarior da tabelas proodutos;
            $table->unsignedBigInteger('produto_id'); // é uma convenção do framework , 
            // na banco o nome da tabela é no plural, mas colocamos no singular 
            // e cocolcamos e id para dizer que é a chave strangeira da tabela produtos;
            // isso é uma padronização do laravel;
            $table->float('comprimento', 8, 2);
            $table->float('largura', 8, 2);
            $table->float('altura', 8, 2);

            // constraint de ralacionamento
            // qual a coluna de nossa tabela que vai receber a condição de chave estrangeira(produto_id)
            // referencia -> qual a coluna de referencia da tablea que manda sua chace primaria 
            // para esse tabele (que é a chave estrangeira)
            // on -> para dizer qual a tabela;
            // -- ralacionamento de 1 para 1 ;
             $table->foreign('produto_id')->references('id')->on('produtos');
             // para garantir que vair ser uma relacionamento de 1 para 1 utilizamos o unique;
             // em produto id não seja possivel a inclusão de valores repetidos(unique);
             // sem o unique , temos aqui um relacionamento de 1 para n;
             // unique - evita que produtos aponte para mais de uma produto detalhe;
             $table->unique('produto_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_detalhes');
    }
};
