@extends('app.layouts.basico')

@section('titulo', 'Adicionar Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Visualizar Produto</p>
        </div>
        @component(
                    'app.layouts._components.menu',
                    [
                        'novo' => 'produto.create',
                        'label' => 'Voltar',
                        'link' => 'produto.index'
                    ]
                )
        @endcomponent
        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <table border="1" style="text-align: left">
                    <tr>
                        <td>Id:</td>
                        <td>{{$produto->id}}</td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td>{{$produto->nome}}</td>
                    </tr>
                    <tr>
                        <td>Descricao:</td>
                        <td>{{$produto->descricao}}</td>
                    </tr>
                    <tr>
                        <td>Peso:</td>
                        <td>{{$produto->peso}} Kg</td>
                    </tr>
                    <tr>
                        <td>Unidade Medida:</td>
                        <td>{{$produto->unidade_id}}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
@endsection
