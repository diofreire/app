@extends('app.layouts.basico')

@section('titulo', 'Pedido')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Pedidos</p>
        </div>
        @component(
                    'app.layouts._components.menu',
                    [
                        'novo' => 'pedido.create',
                        'consulta' => 'pedido.index'
                    ]
                )
        @endcomponent
        <div class="informacao-pagina">
            {{ $msg ?? ''}}
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{$pedido->id}}</td>
                            <td>{{$pedido->cliente->nome}}</td>
                            <td>
                                <form id='form_{{$pedido->id}}' action="{{ route('pedido.destroy', ['pedido' => $pedido->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="document.getElementById('form_{{$pedido->id}}').submit()">Excluir</a>
                                </form>
                            </td>
                            <td><a href="{{ route('pedido.edit', ['pedido' => $pedido->id]) }}">Editar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{-- Paginação--}}
                {{-- Appends: Mantém os criterios de busca --}}

                {{ $pedidos->appends($request)->links() }}
                <!--
                 <br>
                 {{ $pedidos->count() }} - Total de registros por página
                 <br>
                 {{ $pedidos->total() }} - Total de registros
                 <br>
                 {{ $pedidos->firstItem() }} - Número do primeiro registro da página
                 -->
                Exibindo {{ $pedidos->count() }} pedido de {{ $pedidos->total() }} de {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }}
            </div>

        </div>
    </div>
@endsection
