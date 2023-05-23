<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fornecedor = new Fornecedor();

        $fornecedor->nome = 'vincius De Souza Silva';
        $fornecedor->site='vinicius.silva.com.br';
        $fornecedor->email='ncinus@334.com';
        $fornecedor->uf='PE';
        $fornecedor->save();

        // podemos utilizar o metodo creata para fazer isso tambem;
        // para utilizamos temos que criar o atributo fillable no model forncedor;
        Fornecedor::create(['nome'=>'mate' , 'email'=>'mate3382.com' , 
       'site'=>'vnsi3382.com.br', 'uf'=>'PE']);

         // isert;

   DB::table('fornecedores')->insert([
    'nome'=>'matias',
    'email'=>'mmatisa.com',
    'site'=>'matias.com.br',
     'uf'=>'PE'
   ]);
    }

  
}
