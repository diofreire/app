<?php

namespace App\Http\Middleware;

use Closure;
use http\Env\Response;
use Illuminate\Http\Request;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $metodoAutenticacao
     * @return mixed
     */
    public function handle(
        Request $request,
        Closure $next,
        string $metodoAutenticacao,
        string $perfil
    ) {

        echo $metodoAutenticacao .' - '. $perfil;
        echo "<br/>";
        // Verifica se o usuário possui acesso a rota
        if($metodoAutenticacao == 'padrao') {
            echo "Verifica o usuário e senha no banco de dados";
        } elseif($metodoAutenticacao == 'ldap') {
            echo "Verifica o usuário e senha no banco de AD";
        }
        echo "<br/>";

        if(false) {
            return $next($request);
        } else {
            return Response('Acesso negado! Rota exige autenticação');
        }


    }
}
