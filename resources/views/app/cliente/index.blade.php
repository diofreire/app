@extends('app.layouts.basico')

@section('titulo', 'Cliente')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Clientes</p>
        </div>
        @component(
                    'app.layouts._components.menu',
                    [
                        'novo' => 'cliente.create',
                        'label' => 'Atualizar Clientes',
                        'link' => 'cliente.index'
                    ]
                )
        @endcomponent
        <div class="informacao-pagina">
            {{ $msg ?? ''}}
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{$cliente->nome}}</td>
                            <td>
                                <form id='form_{{$cliente->id}}' action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="document.getElementById('form_{{$cliente->id}}').submit()">Excluir</a>
                                </form>
                            </td>
                            <td><a href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}">Editar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{-- Paginação--}}
                {{-- Appends: Mantém os criterios de busca --}}

                {{ $clientes->appends($request)->links() }}
                <!--
                 <br>
                 {{ $clientes->count() }} - Total de registros por página
                 <br>
                 {{ $clientes->total() }} - Total de registros
                 <br>
                 {{ $clientes->firstItem() }} - Número do primeiro registro da página
                 -->
                Exibindo {{ $clientes->count() }} clientes de {{ $clientes->total() }} de {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }}
            </div>

        </div>
    </div>
@endsection
