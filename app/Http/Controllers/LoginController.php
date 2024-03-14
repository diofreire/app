<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function index(Request $request) {

        $erro = '';
        if($request->get('erro') == 1) {
            $erro = 'Usuário e/ou Senha não existe';
        }

        if($request->get('erro') == 2) {
            $erro = 'Necessário realizar login para ter acesso a página';
        }

        return view(
            'site.login',
            [
                'titulo' => 'Login',
                'erro' => $erro
            ]
        );
    }

    public function autenticar(Request $request)
    {
        //se não passar no validate
        $request->validate(
            [
            'usuario' => 'email',
            'senha' => 'required'
            ],
            [
                'usuario.email' => 'O campo usuário (e-mail) é obrigatório',
                'senha.required' => 'O campo senha é obrigatório'
            ]
        );

        //recuperamos os parâmetros do formulário
        $email = $request->get('usuario');
        $password = $request->get('senha');

        echo "Usuário: $email | Senha: $password";
        echo "<br>";

        //iniciar o Model User
        $user = new User();

        $usuario = $user->where('email', $email)
            ->where('password', $password)
            ->get()
            ->first();

        if(isset($usuario->name)) {
            // Inicia sessão
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.clientes');
        } else {
            return redirect()->route(
                'site.login',
                [
                    'erro' => 1
                ]
            );
        }
    }

}
