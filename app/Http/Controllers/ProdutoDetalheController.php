<?php

namespace App\Http\Controllers;

use App\ItemDetalhe;
use App\Produto;
use App\ProdutoDetalhe;
use App\Unidade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        // Carregamento Eager
        $produtosDetalhes = ItemDetalhe::with(['itemDetalhe'])->paginate(10);

        return view('app.produto_detalhe.index',
            [
                'produtos_detalhe' => $produtosDetalhes,
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
        // Recupera do banco o motivo Contato
        return view('app.produto_detalhe.create',
            [
                'unidades' => Unidade::all(),
                'produtos' => Produto::all(),
            ]);
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
                'comprimento' => 'required',
                'largura' => 'required',
                'altura' => 'required',
                'produto_id' => 'exists:produtos,id',
                'unidade_id' => 'exists:unidades,id'
            ],
            [
                'required' => 'O campo :attribute precisa ser preenchido',
//                'double' => 'O campo :attribute precisa ser inteiro',
                'produto_id.exists' => 'A unidade de medida informada não existe',
                'unidade_id.exists' => 'A unidade de medida informada não existe',
            ]
        );


        ProdutoDetalhe::create($request->all());
//        $msg = 'Cadastrado realizado com sucesso';

        // Possível realizar trativas dos metodos aqui
        return redirect()->route('produto-detalhe.index');
    }

    /**
     * Display the specified resource.
     *
     * @param ProdutoDetalhe $produtoDetalhe
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(ProdutoDetalhe $produtoDetalhe, Request $request)
    {
        return view('app.produto_detalhe.index',
            [
                'produtos_detalhe' => ProdutoDetalhe::paginate(10),
                'request' => $request->all()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProdutoDetalhe $produto_detalhe
     * @return Application|Factory|View
     */
    public function edit(ProdutoDetalhe $produto_detalhe)
    {
        return view('app.produto_detalhe.edit',
            [
                'produto_detalhe' => $produto_detalhe,
                'unidades' => Unidade::all(),
                'produtos' => Produto::all(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ProdutoDetalhe $produtoDetalhe
     * @return RedirectResponse
     */
    public function update(Request $request, ProdutoDetalhe $produtoDetalhe)
    {
        $produtoDetalhe->update($request->all());
        return redirect()->route('produto-detalhe.show', ['produto_detalhe' => $produtoDetalhe->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
