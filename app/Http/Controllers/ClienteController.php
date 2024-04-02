<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Fornecedor;
use App\Item;
use App\Unidade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('app.cliente.index',
            [
                'clientes' => Cliente::paginate(10),
                'request' => $request->all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('app.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|min:3|max:40',
            ],
            [
                'required' => 'O campo :attribute precisa ser preenchido',
                'nome.min' => 'O campo :attribute precisa ter no mínomo 3 caracteres',
                'nome.max' => 'O campo :attribute precisa ter no máximo 40 caracteres',
            ]
        );

        Cliente::create($request->all());
        // Possível realizar trativas dos metodos aqui
        return redirect()->route('cliente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cliente $cliente
     * @return Application|Factory|View
     */
    public function edit(Cliente $cliente)
    {
        return view('app.cliente.edit',
            [
                'cliente' => $cliente
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Cliente  $cliente
     * @return RedirectResponse
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate(
            [
                'nome' => 'required|min:3|max:40'
            ],
            [
                'required' => 'O campo :attribute precisa ser preenchido'
            ]
        );
        $cliente->update($request->all());
        return redirect()->route('cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cliente $cliente
     * @return Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('cliente.index');
    }
}
