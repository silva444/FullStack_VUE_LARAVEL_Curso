<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model


{

    use SoftDeletes; // trait; 
    // especifica para o eloquente o nome da tabela do banco de dados 
    // pois o mesmo coloca um s no final para encontrar a tabela no banco de dados ,
    // caso esse comando não seja digitado;
    protected $table='fornecedores';
    // autorizamos atreaves da variavel fillable que o metodo create receba 
    // atraves de um array os paramentros e que esses paramentros recebidos ,
    //seja adicionados como atributo do proprrio objeto =, para que possar ser 
    // persistido no banco de dados;
    protected $fillable=['nome','site','uf','email']; // esse não precisa ser criado caso utilia o save();
    use HasFactory;
}
