<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void


    {

        // criar para unidade um seed , pois ele tem relacionamento com produto;

        // coloquei o motivo contato em primeiro pois ele tem um relacionamento,
        // com site contato , por esse motivo, 
        // ela deve ser executad primeiro, se não da erro;
        $this->call(MotivoContatoSeeder::class);
        $this->call(FornecedorSeeder::class);
        $this->call(SiteContatoSeeder::class);
       
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
