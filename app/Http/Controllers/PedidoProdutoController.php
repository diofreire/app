<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Produto;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Pedido $pedido)
    {
        return view('app.pedido_produto.create',
            [
                'pedido' => $pedido,
                'produtos' => Produto::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Pedido $pedido
     * @return RedirectResponse
     */
    public function store(Request $request, Pedido $pedido)
    {
        $request->validate(
            [
                'produto_id' => 'exists:produtos,id',
                'quantidade' => 'required|integer'
            ],
            [
                'required' => 'O campo :attribute precisa ser preenchido',
                'quantidade.integer' => 'O campo :attribute precisa ser inteiro',
                'produto_id.exists' => 'O produto informado não não existe',
            ]
        );

        /*
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->get('produto_id');
        $pedidoProduto->quantidade = $request->get('quantidade');
        $pedidoProduto->save();
        **/

        // Adicionar novos dados por meio do relacionamento
        $pedido
            ->produtos()
            ->attach(
                $request->get('produto_id'),
                [
                    'quantidade' => $request->get('quantidade')
                ]
            );

        // Adicionar um ou mais itens de uma só vez
        /**
        $pedido
            ->produtos()
            ->attach(
                [
                    $request->get('produto_id') => [
                        'quantidade' => $request->get('quantidade')
                    ]
                ]
            );
        */

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
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
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pedido $pedido
     * @param Produto $produto
     * @return RedirectResponse
     */
    public function destroy(Pedido $pedido, Produto $produto)
    {
        //convencional
        /*
        PedidoProduto::where([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id
        ])->delete();
        */

        //detach (delete pelo relacionamento)
        $pedido->produtos()->detach($produto->id);
        //produto_id

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
    }
}
