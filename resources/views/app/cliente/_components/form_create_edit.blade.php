@if(isset($cliente->id))
    <form action="{{ route('cliente.update', ['cliente' => $cliente->id]) }}" method="post">
        @method('PUT')
@else
    <form action="{{ route('cliente.store') }}" method="post">
@endif
    @csrf
    <input type="hidden" name="id" value="{{ $cliente->id ?? ''}}">
    <input name="nome" value="{{ $cliente->nome ?? old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
    {{ $errors->has('nome') ? $errors->first('nome') : '' }}<br>
    <button type="submit" class="borda-preta">{{ $edit ? 'SALVAR' : 'CADASTRAR'}}</button>
</form>
