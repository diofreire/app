@extends('app.layouts.basico')

@section('titulo', 'Editar Cliente')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Editar Cliente</p>
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
                         'edit' => true,
                         'cliente' => $cliente
                     ]
                 )
                @endcomponent
            </div>
        </div>

    </div>
@endsection
