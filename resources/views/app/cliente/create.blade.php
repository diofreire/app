@extends('app.layouts.basico')

@section('titulo', 'Adicionar Cliente')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Adicionar Cliente</p>
        </div>
        @component(
                    'app.layouts._components.menu',
                    [
                        'novo' => 'cliente.create',
                        'label' => 'Voltar',
                        'link' => 'cliente.index'
                    ]
                )
        @endcomponent
        <div class="informacao-pagina">

            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component(
                    'app.cliente._components.form_create_edit',
                    [
                        'edit' => false
                    ]
                )
                @endcomponent
            </div>
        </div>

    </div>
@endsection
