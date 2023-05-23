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
        // seleciono a tabela fornecessdores atraves do table;
        Schema::table('fornecedores', function(Blueprint $table){
             // nullable -> aceita valores vazios;
            $table->string('site', 150)->after('nome')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fornecedores', function(Blueprint $table){
            
           $table->dropColumn('site');
       });
    }
};
