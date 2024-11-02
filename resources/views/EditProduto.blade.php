@extends('paginas.base') <!-- Mantém sua base existente -->
@extends('paginas.nav') <!-- Inclui a sidebar existente -->

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
    <h1>Editar produto</h1>
    
    <form action="{{ route('atualizandoProduto', ['id' => $produto->id]) }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $produto->name) }}">
      </div>
      <div class="mb-3">
        <label>Descrição</label>
        <input type="text" class="form-control" name="descricao" value="{{ old('descricao', $produto->descricao) }}">
      </div>
      <div class="mb-3">
        <label>Valor compra (R$)</label>
        <input type="text" class="form-control" name="valor_compra" value="{{ old('valor_compra', $produto->valor_compra) }}">
      </div>
      <div class="mb-3">
        <label>Valor venda (R$)</label>
        <input type="text" class="form-control" name="valor_venda" value="{{ old('valor_venda', $produto->valor_venda) }}">
      </div>
      <div class="mb-3">
        <label>Altura</label>
        <input type="text" class="form-control" name="altura" value="{{ old('altura', $produto->altura) }}">
      </div>
      <div class="mb-3">
        <label>Largura</label>
        <input type="text" class="form-control" name="largura" value="{{ old('largura', $produto->largura) }}">
      </div>
      <div class="mb-3">
        <label>Peso(Kg)</label>
        <input type="text" class="form-control" name="peso" value="{{ old('peso', $produto->peso) }}">
      </div>
      <div class="mb-3">
        <label>SKU</label>
        <input type="text" class="form-control" name="sku" value="{{ $produto->sku }}" required>
      </div>
      <div class="mb-3">
        <label>Quantidade em estoque</label>
        <input type="text" class="form-control" name="quantidade" value="{{ old('quantidade', $produto->quantidade) }}">
      </div>
      <button type="submit" class="btn btn-primary">Atualizar dados do produto</button>
    </form>
<<<<<<< HEAD
=======

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</div>
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</div>

@endsection