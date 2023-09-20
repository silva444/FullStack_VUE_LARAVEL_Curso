<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table='produtos';

    protected $fillable=[
        'nome',
        'peso',
        'descricao',
        'unidade_id'
    ];
    // Item tem um itemDetalhe 
    //  e Item detalhe Pertence a um Item;
    // relacionamento de 1 para 1 
    public function ItemDetalhe(){
        // retorno this , para referecia o proprio Produto,
        // temos que definir a Fk , pois o Eloquente ira procuar por 
        // item_id , mas eu quero procurar por produto_id
        // e temos que definir também a pk , da tabela que esta sendo 
        // mapeada pela Model Item , que no caso é produtos e a pk é id

        return $this->hasOne('App\Models\ItemDetalhe','produto_id' , 'id');
        // Produto tem 1 Produto Detalhe;
        // o Eloquente vai enteder que deve procurrar um registro
        // relacionado em produto-detalhes com base na FK chave estrangeira
        // no caso o produto_id é a chave estrangeira de prodtuo detalhes;
    }

    public function fornecedor(){
        // poderai usar o fornecedor_id de forma explicita da mesma 
        //  form que esta na função Item detalhes
        return $this->belongsTo('App\Models\fornecedor');
    }
        
    
}
