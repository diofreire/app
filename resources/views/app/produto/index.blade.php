@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Produtos</p>
        </div>
        @component(
                    'app.layouts._components.menu',
                    [
                        'novo' => 'produto.create',
                        'consulta' => 'produto.index'
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
                        <th>Descrição</th>
                        <th>Fornecedor</th>
                        <th>Peso</th>
                        <th>Unidade</th>
                        <th>Comprimento</th>
                        <th>Altura</th>
                        <th>Largura</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($produtos as $produto)
                        <tr>
                            <td>{{$produto->nome}}</td>
                            <td>{{$produto->descricao}}</td>
                            <td>{{$produto->fornecedor->nome}}</td>
                            <td>{{$produto->peso}}</td>
                            <td>{{$produto->unidade_id}}</td>
                            <td>{{$produto->produtoDetalhe->comprimento ?? ''}}</td>
                            <td>{{$produto->produtoDetalhe->altura ?? ''}}</td>
                            <td>{{$produto->produtoDetalhe->largura ?? ''}}</td>
                            <td><a href="{{ route('produto.show', ['produto' => $produto->id]) }}">Visualizar</a></td>
                            <td>
                                <form id='form_{{$produto->id}}' action="{{ route('produto.destroy', ['produto' => $produto->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="document.getElementById('form_{{$produto->id}}').submit()">Excluir</a>
                                </form>
                            </td>
                            <td><a href="{{ route('produto.edit', ['produto' => $produto->id]) }}">Editar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{-- Paginação--}}
                {{-- Appends: Mantém os criterios de busca --}}

                {{ $produtos->appends($request)->links() }}
                <!--
                 <br>
                 {{ $produtos->count() }} - Total de registros por página
                 <br>
                 {{ $produtos->total() }} - Total de registros
                 <br>
                 {{ $produtos->firstItem() }} - Número do primeiro registro da página
                 -->
                Exibindo {{ $produtos->count() }} produtos de {{ $produtos->total() }} de {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }}
            </div>

        </div>
    </div>
@endsection
