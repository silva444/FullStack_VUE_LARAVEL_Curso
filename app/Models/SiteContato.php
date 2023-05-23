<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // esse model é o mapeamentoo objetp relcional desta clase =;


// apos o primeiro caracter maisculos , todos os demais catacteres maiusculos  deve haver um _
//Site_Contato
// em sequencia pe convertida para caixa baixa (minusculo);
//cite_contato

// e por sim o nome é acrescido de um s no final;

// o eloquent faz a conversão dessa forma citada acima;
class SiteContato extends Model

{

    protected $fillable= [
        'nome',
        'telefone',
        'email',
        'motivo_contatos_id',
        'mensagem'
    ];
    use HasFactory;
}
