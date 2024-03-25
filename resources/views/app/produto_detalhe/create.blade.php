@extends('app.layouts.basico')

@section('titulo', 'Detalhes do Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Adicionar Detalhe do Produto</p>
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

            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component(
                    'app.produto_detalhe._components.form_create_edit',
                    [
                        'edit' => false,
                        'produtos' => $produtos,
                        'unidades' => $unidades
                    ]
                )
                @endcomponent
            </div>
        </div>

    </div>
@endsection
