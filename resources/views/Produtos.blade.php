@extends('paginas.base')

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 10px; padding: 20px; flex-grow: 1;">
    <h1>Cadastro de produto</h1>
    <br>

    <form action="{{ route('storeProduto') }}" method="POST">
      @csrf
      <div>
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
          <input type="text" class="form-control" name="valor_compra" required id="valor_compra" placeholder="Informe o valor de compra">
        </div>

        <div class="mb-3">
          <label for="valor_venda" class="form-label">Valor de venda (R$)</label>
          <input type="text" class="form-control" name="valor_venda" required id="valor_venda" placeholder="Informe o valor de venda">
        </div>

        <div class="mb-3">
          <label for="altura" class="form-label">Altura</label>
          <input type="text" class="form-control" name="altura" required id="altura" placeholder="Informe a altura do produto">
        </div>

        <div class="mb-3">
          <label for="largura" class="form-label">Largura</label>
          <input type="text" class="form-control" name="largura" required id="largura" placeholder="Informe a largura do produto">
        </div>

        <div class="mb-3">
          <label for="peso" class="form-label">Peso (Kg)</label>
          <input type="text" class="form-control" name="peso" required id="peso" placeholder="Informe o peso do produto">
        </div>

        <div class="mb-3">
          <label for="quantidade" class="form-label">Quantidade</label>
          <input type="text" class="form-control" name="quantidade" required id="quantidade" placeholder="Coloque a quantidade em estoque">
        </div>

        <div class="form-group">
    <label for="armazem">Armazém</label>
    <!-- Input escondido para enviar o valor fixo -->
    <input type="hidden" name="armazem" value="Agro">
    <!-- Select visível, mas desabilitado -->
    <select id="armazem" class="form-control" disabled>
        <option value="Agro" selected>Agro</option>
    </select>
    <p class="text-muted">O produto será automaticamente associado ao armazém <strong>Agro</strong>.</p>
</div>



        <div class="mb-3">
          <label>Categoria</label>
          <select class="custom-select" required name="categoria" id="categoria">
            <option selected>Selecionar...</option>
            <option value="Alimentos">Alimentos</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="sku" class="form-label">SKU</label>
          <input type="text" class="form-control" required name="sku" id="sku" placeholder="Informe o SKU do produto">
        </div>

        <div class="mb-3">
          <label for="data_validade" class="form-label">Data de Validade</label>
          <input type="date" class="form-control" name="data_validade" id="data_validade" placeholder="Informe a data de validade do produto">
        </div>

        <!-- Seleção de Fornecedores com Select2 -->
        <div class="mb-3">
          <label for="fornecedor_id" class="form-label">Fornecedores</label>
          <select name="fornecedor_id[]" id="fornecedor_id" class="form-control" multiple="multiple">
            @foreach($fornecedores as $fornecedor)
              <option value="{{ $fornecedor->id }}">{{ $fornecedor->name }}</option>
            @endforeach
          </select>
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

<!-- Inclusão do Select2 e Configuração -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
      $('#fornecedor_id').select2({
          placeholder: "Selecione um ou mais fornecedores",
          width: '100%'
      });
  });
</script>

@endsection
