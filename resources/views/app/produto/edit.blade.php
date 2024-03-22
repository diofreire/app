@extends('app.layouts.basico')

@section('titulo', 'Adicionar Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Editar Produto</p>
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
                <form action="{{ route('produto.update', ['produto' => $produto->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $produto->id ?? ''}}">
                    <input name="nome" value="{{ $produto->nome ?? old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
                    @if($errors->has('nome'))
                        {{$errors->first('nome')}}
                        <br>
                    @endif
                    <input name="descricao" value="{{ $produto->descricao ?? old('descricao') }}" type="text" placeholder="Descricao" class="borda-preta">
                    @if($errors->has('descricao'))
                        {{$errors->first('descricao')}}
                        <br>
                    @endif
                    <input name="peso" value="{{ $produto->peso ?? old('peso') }}" type="text" placeholder="Peso" class="borda-preta">
                    @if($errors->has('descricao'))
                        {{$errors->first('descricao')}}
                        <br>
                    @endif
                    <select name="unidade_id" class="borda-preta">
                        <option value="">-- Selecione a Unidade de Medida --</option>
                        @foreach($unidades as $key => $unidade)
                            <option value="{{$unidade->id}}" {{ ($produto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>{{$unidade->descricao}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('unidade_id'))
                        {{$errors->first('unidade_id')}}
                        <br>
                    @endif
                    <button type="submit" class="borda-preta">SALVAR</button>
                </form>
            </div>
        </div>

    </div>
@endsection
