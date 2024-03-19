@extends('app.layouts.basico')

@section('titulo', 'Listar Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor</p>
        </div>
        @component('app.fornecedor._components.menu')

        @endcomponent
        <div class="informacao-pagina">
             <div style="width: 90%; margin-left: auto; margin-right: auto;">
                 <table border="1" width="100%">
                     <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>UF</th>
                            <th>Email</th>
                            <th></th>
                            <th></th>
                        </tr>
                     </thead>
                     <tbody>
                         @foreach($fornecedores as $fornecedor)
                             <tr>
                                 <th>{{$fornecedor->nome}}</th>
                                 <th>{{$fornecedor->site}}</th>
                                 <th>{{$fornecedor->uf}}</th>
                                 <th>{{$fornecedor->email}}</th>
                                 <th><a href="{{ route('app.fornecedor.excluir', $fornecedor->id) }}">Excluir</a></th>
                                 <th><a href="{{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></th>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
                 {{-- Paginação--}}
                 {{-- Appends: Mantém os criterios de busca --}}

                 {{ $fornecedores->appends($request)->links() }}
                 <!--
                 <br>
                 {{ $fornecedores->count() }} - Total de registros por página
                 <br>
                 {{ $fornecedores->total() }} - Total de registros
                 <br>
                 {{ $fornecedores->firstItem() }} - Número do primeiro registro da página
                 -->
                 Exibindo {{ $fornecedores->count() }} fornecedores de {{ $fornecedores->total() }} de {{ $fornecedores->firstItem() }} a {{ $fornecedores->lastItem() }}
             </div>

        </div>
    </div>
@endsection
