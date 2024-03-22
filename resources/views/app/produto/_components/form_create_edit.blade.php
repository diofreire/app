@if(isset($produto->id))
    <form action="{{ route('produto.update', ['produto' => $produto->id]) }}" method="post">
        @method('PUT')
@else
    <form action="{{ route('produto.store') }}" method="post">
@endif
        @csrf
        <input type="hidden" name="id" value="{{ $produto->id ?? ''}}">
        <input name="nome" value="{{ $produto->nome ?? old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
        {{ $errors->has('nome') ? $errors->first('nome') : '' }}<br>
        <input name="descricao" value="{{ $produto->descricao ?? old('descricao') }}" type="text" placeholder="Descricao" class="borda-preta">
        {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}<br>
        <input name="peso" value="{{ $produto->peso ?? old('peso') }}" type="text" placeholder="Peso" class="borda-preta">
        {{ $errors->has('peso') ? $errors->first('peso') : '' }}<br>
        <select name="unidade_id">
            <option>-- Selecione a Unidade de Medida --</option>

            @foreach($unidades as $unidade)
                <option value="{{ $unidade->id }}" {{ ($produto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }} >{{ $unidade->descricao }}</option>
            @endforeach
        </select>
        {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}<br>
        <button type="submit" class="borda-preta">{{ $edit ? 'SALVAR' : 'CADASTRAR'}}</button>
    </form>
