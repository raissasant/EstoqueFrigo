@extends('paginas.base')

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 10px; padding: 20px; flex-grow: 1;">
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

      <div class="mb-3">
        <label>Data de Validade</label>
        <input type="date" class="form-control" name="data_validade" value="{{ old('data_validade', $produto->data_validade) }}">
      </div>

      <!-- Seleção de Fornecedores com Select2 -->
      <div class="mb-3">
        <label for="fornecedor_id" class="form-label">Fornecedores</label>
        <select name="fornecedor_id[]" id="fornecedor_id" class="form-control" multiple>
          @foreach($fornecedores as $fornecedor)
            <option value="{{ $fornecedor->id }}" {{ $produto->fornecedores->contains($fornecedor->id) ? 'selected' : '' }}>
              {{ $fornecedor->name }}
            </option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Atualizar dados do produto</button>
    </form>

    @if ($errors->any())
      <div class="alert alert-danger mt-3">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</div>

<!-- Inclusão do Select2 e Configuração -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
      $('#fornecedor_id').select2({
          placeholder: "Selecione os fornecedores",
          width: '100%' // Define o campo para ocupar 100% da largura do container
      });
  });
</script>

@endsection
