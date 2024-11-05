@extends('paginas.base') <!-- Mantém sua base existente -->


@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 10px; padding: 20px; flex-grow: 1;">
    <h1>Cadastro de produto</h1>
    <br>

    <form action="{{ route('storeProduto') }}" method="POST">
      @csrf
      <div>
        <!-- Campo Código do Produto -->
        <div class="mb-3">
          <label for="codigo_produto" class="form-label">Código do Produto</label>
          <input type="text" name="codigo_produto" class="form-control" required id="codigo_produto" placeholder="Informe o código do produto">
        </div>

        <div class="mb-3">
          <label for="name" class="form-label">Nome</label>
          <input type="text" name="name" class="form-control" required id="name" placeholder="Coloque o nome do produto">
        </div>
        <div class="mb-3">
          <label for="descricao" class="form-label">Descrição</label>
          <input type="text" class="form-control" name="descricao" required id="descricao" placeholder="Informe a descrição">
        </div>
        <div class="mb-3">
          <label for="valor_compra" class="form-label">Valor de compra (R$)</label>
          <input type="text" class="form-control" name="valor_compra" required id="valor_compra" placeholder="Informe o valor de compra, somente números inteiros">
        </div>
        <div class="mb-3">
          <label for="valor_venda" class="form-label">Valor de venda (R$)</label>
          <input type="text" class="form-control" name="valor_venda" required id="valor_venda" placeholder="Informe o valor de venda, somente números inteiros">
        </div>
        <div class="mb-3">
          <label for="altura" class="form-label">Altura</label>
          <input type="text" class="form-control" name="altura" required id="altura" placeholder="Informe a altura do produto, somente números inteiros">
        </div>
        <div class="mb-3">
          <label for="largura" class="form-label">Largura</label>
          <input type="text" class="form-control" name="largura" required id="largura" placeholder="Informe a largura do produto, somente números inteiros">
        </div>
        <div class="mb-3">
          <label for="peso" class="form-label">Peso (Kg)</label>
          <input type="text" class="form-control" name="peso" required id="peso" placeholder="Informe o peso do produto, somente números inteiros">
        </div>
        <div class="mb-3">
          <label for="quantidade" class="form-label">Quantidade</label>
          <input type="text" class="form-control" name="quantidade" required id="quantidade" placeholder="Coloque números sem a vírgula">
        </div>
        <div class="mb-3">
          <label>Categoria</label>
          <select class="custom-select" required name="categoria" id="categoria">
            <option selected>Selecionar...</option>
            <option value="Matérias primas (Rações, Vacinas)">Matérias primas (Rações, Vacinas)</option>
            <option value="Higiene/Limpeza (Produtos químicos)">Higiene/Limpeza (Produtos químicos)</option>
            <option value="Equipamentos (Máquinas de corte)">Equipamentos (Máquinas de corte)</option>
            <option value="Alimentos (Produtos no geral)">Alimentos (Produtos no geral)</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="sku" class="form-label">SKU</label>
          <input type="text" class="form-control" required name="sku" id="sku" placeholder="Informe o SKU do produto">
        </div>
        <button type="submit" class="btn btn-success">Salvar os dados do produto</button>
        <button type="reset" class="btn btn-dark">Cancelar cadastro de produto</button>
      </div>
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

@endsection
