<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\SiteContato;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $req)
    {

        // echo '<pre>';

        //  print_r($req->all());
        // echo '</pre>';
        // echo $req->input('nome'); // recupera o input com name de 'nome'
        // MOSTRA O ARRAY COM OS CONTEUDOS DO FORM
        // var_dump($_GET); // mostra o get 
        // var_dump($_POST);


        // preimeria forma de persisitir valores do formulario no BD
        // $contato = new SiteContato();
        // $contato->nome = $req->input('nome');
        // $contato->telefone = $req->input('telefone');
        // $contato->email = $req->input('email');
        // $contato->motivo_contato = $req->input('motivo_contato');
        // $contato->mensagem = $req->input('mensagem');

        // //print_r($contato->getAttributes());
        // $contato->save();

        //  segunda forma 

        // $contato = new SiteContato();
        // $contato->fill($req->all());

        // $contato->save();

        $motivo_contatos = MotivoContato::all();
        return view('site.contato', ['titulo' => 'Contato {teste-Controlle}', 'motivo_contatos'=>$motivo_contatos]);
    }
    public function salvar(Request $req)
    {

        // Poso manipular a variavel $errors aqui no controller;
        //  dd($req);
        //  print_r($req->all());
        // $contato1 = new SiteContato();
        // $contato1->nome = $req->input('nome');
        // $contato1->telefone = $req->input('telefone');
        // $contato1->email = $req->input('email');
        // $contato1->motivo_contato = $req->input('motivo_contato');
        // $contato1->mensagem = $req->input('mensagem');
        // $contato1->save();

        $req->validate([ // para validar os campos , e manipular a Variavel $errors;
            // nomes com no minimo 3 e no maxiom 40 caracteres;
            'nome'           => 'required|min:3|max:40|unique:site_contatos', // exigi que o campo seja preencido ;
            'telefone'       => 'required',
            'email'          => 'email', // verifica se é um email valdioo;
            'motivo_contatos_id' => 'required',
            'mensagem'       => 'required|max:2000',

        ],
        // especifica as mensagens de erros(feedback) de 
        // devem ser atribuidas para cada campo;

        [

            'nome.required' =>'O campo nome é obrigatrio',
            'nome.min' =>'O nome deve ter pelo menos 3 caracteres',
            'nome.max' => 'O nome deve ter no maximo 40 caracteres',
            'nome.unique' => 'O nome já existe no banco de dados',
            'telefone.required' => 'O campo telefone é obrigatrio',
            'email.email' => 'O emaill é invalido',
            'motivo_contatos_id.required' => 'O campo Motivo Contato é obrigatorio',
            'mensagem.required' => 'O campo mensagem é obrigatorio',
            'mensagem.max' => 'O campo mensagem deve conter no maximo 2000 caractereres',
            //em vez de colocar todos os campos que tenha requirede de um por um 
            // posso apenas customizar o required colocando o (:attribute) , que pega o 
            // nome do campo;
            'required' => " O campo :attribute deve ser preenchido"

        ]
    );

        SiteContato::create($req->all()); // all - retorna um arrya associativo da requisição;
         return redirect()->route('site.index');
    }
}
