<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Item;
use App\Produto;
use App\Unidade;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $produtos = Item::with(['produtoDetalhe', 'fornecedor'])->paginate(10);

        return view('app.produto.index',
            [
                'produtos' => $produtos,
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
        return view(
            'app.produto.create',
            [
                'unidades' => Unidade::all(),
                'fornecedores' => Fornecedor::all()
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
                'nome' => 'required|min:3|max:40',
                'descricao' => 'required|min:3|max:2000',
                'peso' => 'required|integer',
                'unidade_id' => 'exists:unidades,id',
                'fornecedor_id' => 'exists:fornecedores,id',
            ],
            [
                'required' => 'O campo :attribute precisa ser preenchido',
                'nome.min' => 'O campo :attribute precisa ter no mínomo 3 caracteres',
                'nome.max' => 'O campo :attribute precisa ter no máximo 40 caracteres',
                'descricao.min' => 'O campo :attribute precisa ter no mínomo 3 caracteres',
                'descricao.max' => 'O campo :attribute precisa ter no máximo 200 caracteres',
                'peso.integer' => 'O campo :attribute precisa ser inteiro',
                'unidade_id.exists' => 'A unidade de medida informada não existe',
                'fornecedor_id.exists' => 'O fornecedor informado não não existe',
            ]
        );

        Item::create($request->all());
        $msg = 'Cadastrado realizado com sucesso';

        // Possível realizar trativas dos metodos aqui
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Produto $produto
     * @param string $msg
     * @return Application|Factory|View
     */
    public function show(Produto $produto, string $msg = '')
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Produto $produto
     * @return Application|Factory|View
     */
    public function edit(Produto $produto)
    {
        return view('app.produto.edit',
            [
                'produto' => $produto,
                'unidades' => Unidade::all(),
                'fornecedores' => Fornecedor::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $produto
     * @return RedirectResponse
     */
    public function update(Request $request, Item $produto): RedirectResponse
    {
        $request->validate(
            [
                'nome' => 'required|min:3|max:40',
                'descricao' => 'required|min:3|max:2000',
                'peso' => 'required|integer',
                'unidade_id' => 'exists:unidades,id',
                'fornecedor_id' => 'exists:fornecedores,id',
            ],
            [
                'required' => 'O campo :attribute precisa ser preenchido',
                'nome.min' => 'O campo :attribute precisa ter no mínomo 3 caracteres',
                'nome.max' => 'O campo :attribute precisa ter no máximo 40 caracteres',
                'descricao.min' => 'O campo :attribute precisa ter no mínomo 3 caracteres',
                'descricao.max' => 'O campo :attribute precisa ter no máximo 200 caracteres',
                'peso.integer' => 'O campo :attribute precisa ser inteiro',
                'unidade_id.exists' => 'A unidade de medida informada não existe',
                'fornecedor_id.exists' => 'O fornecedor informado não não existe',
            ]
        );

        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id, 'msg' => 'Produto atualizado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Produto $produto
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Produto $produto): RedirectResponse
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
