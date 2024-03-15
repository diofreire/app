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
             -- Listar
        </div>

    </div>
@endsection
