@extends('app.layouts.basico')

@section('titulo', 'Pedido Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Adicionar Produtos ao Pedido</p>
        </div>
        @component(
                    'app.layouts._components.menu',
                    [
                        'novo' => 'pedido.create',
                        'label' => 'Voltar',
                        'link' => 'pedido.index'
                    ]
                )
        @endcomponent
        <div class="informacao-pagina">
            <h4> Detalhes do Pedido</h4>
            <p>ID do Pedido: {{ $pedido->id }}</p>
            <p>Cliente: {{ $pedido->cliente_id }}</p>
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <h4> Itens Pedido</h4>
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome do Produto</th>
                            <th>Data de inclusão do pedido</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pedido->produtos as $produto)
                        <tr>
                            <td>{{$produto->id}}</td>
                            <td>{{$produto->nome}}</td>
                            <td>{{$produto->pivot->created_at->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @component(
                    'app.pedido_produto._components.form_create',
                    [
                        'pedido' => $pedido,
                        'produtos' => $produtos
                    ]
                )
                @endcomponent
            </div>
        </div>

    </div>
@endsection
