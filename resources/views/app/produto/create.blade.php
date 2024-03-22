@extends('app.layouts.basico')

@section('titulo', 'Adicionar Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Adicionar Produto</p>
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

            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component(
                    'app.produto._components.form_create_edit',
                    [
                        'edit' => false,
                        'unidades' => $unidades
                    ]
                )
                @endcomponent
            </div>
        </div>

    </div>
@endsection
