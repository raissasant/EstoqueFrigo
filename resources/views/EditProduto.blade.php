@extends('paginas.base')

@extends('paginas.navUser')

@section('content')


    <div class="container">
    <h1>Editar e atualizar produto</h1>
    <form action="{{ route('atualizandoProduto',['id' => $produto->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $produto->name) }}">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descricao" value="{{ old('descricao', $produto->descricao) }}">
        </div>
        <div class="form-group">
            <label>Valor compra (R$)</label>
            <input type="text" class="form-control" name="valor_compra" id="valor_compra"
            value="{{ old('valor_compra', $produto->valor_compra) }}">

        </div>
          <div class="form-group">
            <label>Valor venda (R$)</label>
            <input type="text" class="form-control" name="valor_venda" id="valor_venda"
            value="{{ old('valor_venda', $produto->valor_venda) }}">

        </div>
        <div class="form-group">
            <label>Altura</label>
            <input type="text" class="form-control" name="altura" id="altura" value="{{ old('altura', $produto->altura) }}">
        </div>
        <div class="form-group">
            <label>Largura</label>
            <input type="text" class="form-control" name="largura" id="largura" value="{{ old('largura', $produto->largura) }}">
        </div>
        <div class="form-group">
            <label>Peso(Kg)</label>
            <input type="text" class="form-control" name="peso" id="peso" value="{{ old('peso', $produto->peso) }}">
        </div>

        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" class="form-control" name="sku" id="sku" value="{{ $produto->sku }}" required>
            @if ($errors->has('sku'))
                <div class="alert alert-danger">{{ $errors->first('sku') }}</div>
            @endif
        </div>
         <div class="form-group">
            <label>Quantidade em estoque<label>
            <input type="text" class="form-control" name="quantidade" id="quantidade"
            value="{{ old('quantidade', $produto->quantidade)}}">

        </div>


        <button type="submit" class="btn btn-primary">Atualizar dados do produto </button>
    </form>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
