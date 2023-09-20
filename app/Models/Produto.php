<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable=[
        'nome',
        'peso',
        'descricao',
        'unidade_id'
    ];
    public function produtoDetalhe(){
        // retorno this , para referecia o proprio Produto,
        return $this->hasOne('App\Models\ProdutoDetalhe');
        // Produto tem 1 Produto Detalhe;
        // o Eloquente vai enteder que deve procurrar um registro
        // relacionado em produto-detalhes com base na FK chave estrangeira
        // no caso o produto_id é a chave estrangeira de prodtuo detalhes;
    }
}
