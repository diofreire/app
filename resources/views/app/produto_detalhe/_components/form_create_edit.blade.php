@if(isset($produto_detalhe->id))
    <form action="{{ route('produto-detalhe.update', ['produto_detalhe' => $produto_detalhe->id]) }}" method="post">
        @method('PUT')
@else
    <form action="{{ route('produto-detalhe.store') }}" method="post">
        <select name="produto_id">
            <option>-- Selecione o Produto --</option>

            @foreach($produtos as $produto)
                <option value="{{ $produto->id }}" {{ ($produto_detalhe->produto_id ?? old('produto_id')) == $produto->id ? 'selected' : '' }}>{{ $produto->nome }}</option>
            @endforeach
        </select>
        {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}<br>
@endif
        @csrf
        <input type="hidden" name="id" value="{{ $produto_detalhe->id ?? ''}}">
        <div style="text-align: left">Comprimento</div>
        <input name="comprimento" value="{{ $produto_detalhe->comprimento ?? old('comprimento') }}" type="text" placeholder="Comprimento" class="borda-preta">
        {{ $errors->has('comprimento') ? $errors->first('comprimento') : '' }}<br>
        <div style="text-align: left">Largura</div>
        <input name="largura" value="{{ $produto_detalhe->largura ?? old('largura') }}" type="text" placeholder="Largura" class="borda-preta">
        {{ $errors->has('largura') ? $errors->first('largura') : '' }}<br>
        <div style="text-align: left">Altura</div>
        <input name="altura" value="{{ $produto_detalhe->altura ?? old('largura') }}" type="text" placeholder="Altura" class="borda-preta">
        {{ $errors->has('Altura') ? $errors->first('Altura') : '' }}<br>
        <div style="text-align: left">Unidade</div>
        <select name="unidade_id">
            <option>-- Selecione a Unidade de Medida --</option>

            @foreach($unidades as $unidade)
                <option value="{{ $unidade->id }}" {{ ($produto_detalhe->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>{{ $unidade->descricao }}</option>
            @endforeach
        </select>
        {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}<br>
        <button type="submit" class="borda-preta">{{ $edit ? 'SALVAR' : 'CADASTRAR'}}</button>
    </form>
