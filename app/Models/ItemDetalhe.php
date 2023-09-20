<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetalhe extends Model
{
    protected $table='produto_detalhes';
    protected $fillable=[
        'produto_id',
        'comprimento',
        'largura',
        'altura',
        'unidade_id'
     ];
    use HasFactory;

    public function item(){
        
        // no hasone eu indico a chave fk de produto detalhe,e a pk de produtos que esta 
        // na variavel $tabnle = 'produtos'
        // ----------------------------------------------------------------
        // e no belogs to eu indico a chave fk da tabela mapeada pelo modelo Item Detelhe
        // que no caso é a $table ='produto_detalhes' , a a pk(chave primaria) da 
        // model item , que no caso é a $table = 'produtos';  
        // relacionamento de 1 para 1 
        return $this->belongsTo('App\Models\Item', 'produto_id' , 'id');
     }
}
