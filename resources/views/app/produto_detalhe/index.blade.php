@extends('app.layouts.basico')

@section('titulo', 'Detalhe Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem dos Detalhes do Produtos</p>
        </div>
        @component(
                    'app.layouts._components.menu',
                    [
                        'novo' => 'produto-detalhe.create',
                        'consulta' => 'produto-detalhe.index'
                    ]
                )
        @endcomponent
        <div class="informacao-pagina">
            {{ $msg ?? ''}}
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                    <tr>
                        <th>ID do Produto</th>
                        <th>Comprimento</th>
                        <th>Largura</th>
                        <th>Altura</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($produtos_detalhe as $produtoDetalhe)
                        <tr>
                            <td>{{$produtoDetalhe->id}}</td>
                            <td>{{$produtoDetalhe->comprimento}}</td>
                            <td>{{$produtoDetalhe->largura}}</td>
                            <td>{{$produtoDetalhe->altura}}</td>
                            <td><a href="{{ route('produto.show', ['produto' => $produtoDetalhe->id]) }}">Visualizar</a></td>
                            <td>
                                <form id='form_{{$produtoDetalhe->id}}' action="{{ route('produto.destroy', ['produto' => $produtoDetalhe->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="document.getElementById('form_{{$produtoDetalhe->id}}').submit()">Excluir</a>
                                </form>
                            </td>
                            <td><a href="{{ route('produto-detalhe.edit', ['produto_detalhe' => $produtoDetalhe->id]) }}">Editar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{-- Paginação--}}
                {{-- Appends: Mantém os criterios de busca --}}

                {{ $produtos_detalhe->appends($request)->links() }}
                <!--
                 <br>
                 {{ $produtos_detalhe->count() }} - Total de registros por página
                 <br>
                 {{ $produtos_detalhe->total() }} - Total de registros
                 <br>
                 {{ $produtos_detalhe->firstItem() }} - Número do primeiro registro da página
                 -->
                Exibindo {{ $produtos_detalhe->count() }} produtos de {{ $produtos_detalhe->total() }} de {{ $produtos_detalhe->firstItem() }} a {{ $produtos_detalhe->lastItem() }}
            </div>

        </div>
    </div>
@endsection
