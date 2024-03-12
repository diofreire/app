<?php

namespace App\Http\Middleware;

use Closure;
use http\Env\Response;
use Illuminate\Http\Request;
use App\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //LogAcesso::create(['log' => "IP {$request->server->get('REMOTE_ADDR')} requisitou a rota {$request->getRequestUri()}"]);

        return $next($request);
        //return Response('Chegamos no middleware com create');
    }
}
