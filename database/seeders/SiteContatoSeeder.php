<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\SiteContato;
use Carbon\Factory;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $contato = new SiteContato;
        // $contato->nome='jogn';
        // $contato->telefone='88430567';
        // $contato->email='jogn.com.br';
        // $contato->motivo_contato=1;
        // $contato->mensagem='nada';
        // $contato->save();

      \App\Models\SiteContato::factory()->count(100)->create();

    }
}
