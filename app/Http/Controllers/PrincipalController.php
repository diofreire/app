<?php

namespace App\Http\Controllers;

use App\MotivoContato;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function principal() {

        // Recupera do banco o motivo Contato
        $motivoContatos = MotivoContato::all();

        return view('site.principal', ['motivo_contatos' => $motivoContatos]);
    }
}
