@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor</p>
        </div>
        @component(
                    'app.layouts._components.menu',
                    [
                        'novo' => 'app.fornecedor.adicionar',
                        'label' => 'Listagem de Fornecedor',
                        'link' => 'app.fornecedor.listar'
                    ]
                )
        @endcomponent
        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form action="{{ route('app.fornecedor.listar') }}" method="post">
                    @csrf
                    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
                    <input name="site" value="{{ old('site') }}" type="text" placeholder="Site" class="borda-preta">
                    <input name="uf" value="{{ old('uf') }}" type="text" placeholder="UF" class="borda-preta">
                    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="borda-preta">

                    <button type="submit" class="borda-preta">PESQUISAR</button>
                </form>
            </div>
        </div>

    </div>
@endsection
