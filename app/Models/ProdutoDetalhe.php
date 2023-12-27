<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdutoDetalhe extends Model
{

    protected $fillable=[
       'produto_id',
       'comprimento',
       'largura',
       'altura',
       'unidade_id'
    ];
    use HasFactory;

    public function produto(){
       return $this->belongsTo('App\Models\Produto');
    }
}

// testando commmit 
// tes
//asd
