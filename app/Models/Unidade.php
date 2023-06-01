<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    
    // isso permite a inserção de dados em massa ,
    // por exemplo um factory e para utilizar o metodo create ,
    //pois o create exige que essa variavel estaja declarada na model ,
    // para que ele possa fazer uma inserção;
    protected $fillable=[
        'unidade',
        'descricao',
    ];
    use HasFactory;
}
