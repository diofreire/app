<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index() {
       return view('app.fornecedor.index');
    }

    public function listar(Request $request) {

        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('site', 'like', '%'.$request->input('site').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->get();

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function adicionar(Request $request) {

        $msgSucesso = null;
        // Valida se há token do formulário
        if($request->input('_token')) {
            $request->validate(
                [
                    'nome' => 'required|min:3|max:40',
                    'site' => 'required',
                    'uf' => 'required|min:2|max:2',
                    'email' => 'email'
                ],
                [
                    'required' => 'O campo :attribute precisa ser preenchido',
                    'uf.min' => 'O campo :attribute precisa ter no mínomo 3 caracteres',
                    'uf.max' => 'O campo :attribute precisa ter no máximo 40 caracteres',
                    'email.email' => 'O campo :attribute precisa ser um e-mail válido',
                ]
            );

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());
            $msgSucesso = 'Cadastrado realizado com sucesso';

        }

        //print_r($request->all());
        return view('app.fornecedor.adicionar', ['msg' => $msgSucesso]);
    }
}
