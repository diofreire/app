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
            ->paginate(2);

        return view('app.fornecedor.listar',
            [
                'fornecedores' => $fornecedores,
                'request' => $request->all()
            ]
        );
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function adicionar(Request $request) {

        $msg = null;
        // Valida se há token do formulário
        if($request->input('_token') && !$request->input('id')) {
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
            $msg = 'Cadastrado realizado com sucesso';
        } elseif($request->input('_token') && $request->input('id')) {
            $fornecedor = Fornecedor::find($request->input('id'));
            if ($fornecedor->update($request->all())) {
                $msg = 'Atualização realizada com sucesso';
            } else {
                $msg = 'Erro ao tentar atualizar o cadastro';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        //print_r($request->all());
        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar(int $id, string $msg = '') {
        return view('app.fornecedor.adicionar',
            [
                'fornecedor' => Fornecedor::find($id),
                'msg' => $msg
            ]
        );
    }

    public function excluir(int $id) {
        if(Fornecedor::find($id)->delete()) {
            return redirect()->route('app.fornecedor'); //['msg' => "Registro $id deletado com sucesso"]
        } else {
            echo "Falha na exclusão";
        }
    }
}
