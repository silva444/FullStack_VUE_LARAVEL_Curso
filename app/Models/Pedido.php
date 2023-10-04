<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    //teremos a relação de produtos associados a pedidos;
    // ou seja totos os protuos que tiverem o id de pedios;
    public function produtos(){
        // o model Produot tem um relacionamento pertece a muitos 
        // estabelecido pela tabela auxiliar pediods prodtuos;
        //  
        //  na tanle pedios produots , pesquise pela coluna pedido id , 
        // por que ela representa a fk que vem da tabela pediods,
        // o quarto paramentos é a fk que item . que no caos mapea protuos,
        // então será produto_id;
        // ou seja passamos como parametros auxiliares o fk de da model atual 
        //  e a fk da model Item , que no caso é produtos;

        //  ou para simplificar as fks da tabela do relacionamento 
        // (que no caso é produto_id e pediod_id),
        //  sendo a primeira fk , a pk(chave primaria da model do primeiro paramento)
        // que nesta caso é o Item;

        // quando o nome não é padronizado fazemos desssa forma;
        // utilizamos o withPivot , para trazer a coluna da data como pivot;

        return $this->belongsToMany('App\Models\Item','pedidos_produtos',
         'pedido_id','produto_id' )->withPivot('created_at','updated_at','id');
        // quando os nome sõa padronizados fazamos dessa forma ;
        // return $this->belongsToMany('App\Models\Produto','pedidos_produtos' );
    }
}
