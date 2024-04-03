@extends('app.layouts.basico')

@section('titulo', 'Editar Cliente')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Editar Pedido</p>
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
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component(
                     'app.pedido._components.form_create_edit',
                     [
                         'edit' => true,
                         'pedido' => $pedido,
                         'clientes' => $clientes
                     ]
                 )
                @endcomponent
            </div>
        </div>

    </div>
@endsection
