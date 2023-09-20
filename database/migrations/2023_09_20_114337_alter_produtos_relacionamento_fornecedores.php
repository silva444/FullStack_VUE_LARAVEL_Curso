<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Nette\Schema\Schema as SchemaSchema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // criando a coluna em produtos que vai receber a fk de Fornecedroes;
        Schema::table('produtos', function (Blueprint $table) {
            // fica após a coluna id;

            // inserirndo registro em fornecedores para estabelcer o relacionamento 
            // pois não tinha o prouto_id antes , e ja tem regiros 
            // como ja tem registro tenho que fazzer isso para não da erro
            //  se fosse a primeirar execução nã preceissario fazer isso.


            //   inseri e retorna o id(insertGetId) do registro inserido para usar como 
            //  um valor defautl para a chave estragneira que é fornecedor_id;
            $fornecedor_id = DB::table('fornecedores')->insertGetId([
                'nome' => 'Forncedor Padrão',
                'site' => 'www.forncedorepadrão.com',
                'uf' => 'PE',
                'email' => 'forncedor_padarão@gmail.com'
            ]);
            //  temos que colocar o mesmo tipo do id da tabela de fornecedores;
            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('id');
            //  constraint para dizer que é uma chave estrangeira 
            // e refereces , para dizer qual a coluno da tebela 
            //  que trouxe sua chave estrangeira para ca ,
            //  que no caso é fornecedores , e on , para dizer que é da 
            // tabela fornecedores;
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // sempre fazer do modo inverso, primeiro eu remo a contrait ,
        // temos que passa o nome da tabela , seguido de _ o nome do campo e o foreing
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign('produtos_fornecedor_id_foreing');
            $table->dropColunn('fornecedor_id');
        });
    }
};
