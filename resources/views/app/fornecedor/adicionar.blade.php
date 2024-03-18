@extends('app.layouts.basico')

@section('titulo', 'Fornecedor Adicionar')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor</p>
        </div>
        @component('app.fornecedor._components.menu')

        @endcomponent
        <div class="informacao-pagina">
            {{ $msg }}
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form action="{{ route('app.fornecedor.adicionar') }}" method="post">
                    @csrf
                    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
                    @if($errors->has('nome'))
                        {{$errors->first('nome')}}
                        <br>
                    @endif
                    <input name="site" value="{{ old('site') }}" type="text" placeholder="Site" class="borda-preta">
                    @if($errors->has('site'))
                        {{$errors->first('site')}}
                        <br>
                    @endif
                    <input name="uf" value="{{ old('uf') }}" type="text" placeholder="UF" class="borda-preta">
                    @if($errors->has('uf'))
                        {{$errors->first('uf')}}
                        <br>
                    @endif
                    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="borda-preta">
                    @if($errors->has('email'))
                        {{$errors->first('email')}}
                        <br>
                    @endif
                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>

    </div>
@endsection
