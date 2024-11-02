@extends('paginas.base')

@section('content')
<div class="wrapper" style="display: flex;">
  <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
    <h1>Adicionar uma nova movimentação</h1>
    <br>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('CadastrandoMovimentacao') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Usuário</label>
        <input type="text" name="name_user" class="form-control" value="{{ $user->name }}" id="exampleFormControlInput1" readonly>
      </div>
      
      <div class="mb-3">
        <label for="codigo_produto" class="form-label">Código do produto</label>
        <input type="text" class="form-control" name="codigo_produto" value="{{ $produto->codigo_produto }}" id="codigo_produto" readonly>
      </div>
      
      <div class="mb-3">
        <label for="quantidadeEstoque" class="form-label">Quantidade atual no estoque</label>
        <input type="text" class="form-control" value="{{ $produto->quantidade }}" id="quantidadeEstoque" readonly>
      </div>
      
      <div class="mb-3">
        <label for="quantidadeMovimentacao" class="form-label">Quantidade para Movimentação</label>
        <input type="number" class="form-control" name="quantidade" id="quantidadeMovimentacao" min="0" placeholder="Informe a quantidade" required>
      </div>
      
      <div class="mb-3">
        <label for="codigo_entrada" class="form-label">Código de entrada</label>
        <input type="text" class="form-control" name="codigo_entrada" id="codigo_entrada" placeholder="Informe o código de entrada" required>
      </div>
      
      <div class="mb-3">
        <label for="codigo_saida" class="form-label">Código de saída</label>
        <input type="text" class="form-control" name="codigo_saida" id="codigo_saida" placeholder="Informe o código de saída" required>
      </div>
      
      <div class="mb-3">
        <label for="codigo_pedido" class="form-label">Código do pedido</label>
        <input type="text" class="form-control" name="codigo_pedido" id="codigo_pedido" placeholder="Informe o código do pedido" required>
      </div>
      
      <div class="mb-3">
        <label>Tipo de movimentação</label>
        <select class="custom-select" name="tipo_mov" id="tipoMovimentacao" required>
          <option selected disabled>Selecionar...</option>
          <option value="Entrada">Entrada</option>
          <option value="Saida">Saída</option>
          <option value="Transferencia">Transferência</option>
        </select>
      </div>
      
      <div class="mb-3" id="armazemOrigemContainer" style="display: none;">
        <label>Armazém de origem</label>
        <select class="custom-select" name="armazem_origem" id="armazemOrigem">
          <option selected disabled>Selecionar...</option>
          @foreach($armazens as $armazem)
            <option value="{{ $armazem->name }}">{{ $armazem->name }}</option>
          @endforeach
        </select>
      </div>
      
      <div class="mb-3" id="armazemDestinoContainer" style="display: none;">
        <label>Armazém de destino</label>
        <select class="custom-select" name="armazem_destino" id="armazemDestino">
          <option selected disabled>Selecionar...</option>
          @foreach($armazens as $armazem)
            <option value="{{ $armazem->name }}">{{ $armazem->name }}</option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-success">Salvar movimentação</button>
      <button type="reset" class="btn btn-dark">Cancelar movimentação</button>
    </form>
  </div>
</div>

<script>
    document.getElementById('tipoMovimentacao').addEventListener('change', function() {
        const tipo = this.value;
        const armazemOrigemContainer = document.getElementById('armazemOrigemContainer');
        const armazemDestinoContainer = document.getElementById('armazemDestinoContainer');
        
        if (tipo === 'Transferencia') {
            armazemOrigemContainer.style.display = 'block';
            armazemDestinoContainer.style.display = 'block';
        } else if (tipo === 'Entrada') {
            armazemOrigemContainer.style.display = 'none';
            armazemDestinoContainer.style.display = 'block';
        } else if (tipo === 'Saida') {
            armazemOrigemContainer.style.display = 'block';
            armazemDestinoContainer.style.display = 'none';
        } else {
            armazemOrigemContainer.style.display = 'none';
            armazemDestinoContainer.style.display = 'none';
        }
    });

    document.getElementById('tipoMovimentacao').dispatchEvent(new Event('change'));
</script>
@endsection
