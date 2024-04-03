<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Pedido;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('app.pedido.index',
            [
                'pedidos' => Pedido::with(['cliente'])->paginate(10),
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
        return view(
            'app.pedido.create',
            [
                'clientes' => Cliente::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'cliente_id' => 'exists:clientes,id',
            ],
            [
                'cliente_id.exists' => 'O Cliente informado não não existe',
            ]
        );

        Pedido::create($request->all());

        // Possível realizar trativas dos metodos aqui
        return redirect()->route('pedido.index');
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
     * @param Pedido $pedido
     * @return Application|Factory|View
     */
    public function edit(Pedido $pedido)
    {
        return view('app.pedido.edit',
            [
                'pedido' => $pedido,
                'clientes' => Cliente::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Pedido $pedido
     * @return RedirectResponse
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate(
            [
                'cliente_id' => 'exists:clientes,id',
            ],
            [
                'cliente_id.exists' => 'O Cliente informado não não existe',
            ]
        );

        $pedido->update($request->all());
        return redirect()->route('pedido.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pedido $pedido
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedido.index');
    }
}
