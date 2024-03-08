<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        // Recupera do banco o motivo Contato
        $motivoContatos = MotivoContato::all();

        return view(
            'site.contato',
            [
                'titulo' => 'Contato',
                'motivo_contatos' => $motivoContatos
            ]
        );
    }

    public function salvar(Request $request) {

        //realizar a validação dos dados do formulário recebidos no request
        $request->validate(
            [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
            ],
            [
               'required' => 'O campo :attribute precisa ser preenchido',
               'motivo_contatos_id.required' => 'O campo Motivo Contato precisa ser preenchido',
               'nome.min' => 'O campo :attribute precisa ter no mínomo 3 caracteres',
               'nome.max' => 'O campo :attribute precisa ter no máximo 40 caracteres',
               'email.email' => 'O campo :attribute precisa ser um e-mail válido',
            ]
        );

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
