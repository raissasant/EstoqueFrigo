@extends('paginas.base')

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 5px; padding: 20px; flex-grow: 1;">
    <h1>Listagem de produtos</h1>

    <form action="{{ route('SearchProduto') }}" method="GET">
      @csrf
      <div class="mb-3">
        <label for="search">Buscar produto</label>
        <input type="text" class="form-control" name="search" id="search" placeholder="Digite o nome ou Código"> 
      </div>
      <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
    </form>

    @if(isset($message))
      <div class="alert alert-warning mt-3">
        {{ $message }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger mt-3">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <br>

    <table class="table mt-3 table-bordered">
      <thead style="background-color: #d0e9d6; color: #333;">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Código produto</th>
          <th>Categoria</th>
          <th>SKU</th>
          <th>Valor compra (R$)</th>
          <th>Valor venda (R$)</th>
          <th>Quantidade em estoque</th>
          <th>QR Code</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($produtos as $index => $produto)
          <tr style="background-color: {{ $index % 2 == 0 ? '#f5faf5' : '#ffffff' }};">
            <td>{{ $produto->id }}</td>
            <td>{{ $produto->name }}</td>
            <td>{{ $produto->descricao }}</td>
            <td>{{ $produto->codigo_produto }}</td>
            <td>{{ $produto->categoria }}</td>
            <td>{{ $produto->sku }}</td>
            <td>{{ $produto->valor_compra }}</td>
            <td>{{ $produto->valor_venda }}</td>
            <td>{{ $produto->quantidade }}</td>
            <td>
              <div id="qrcode-{{ $produto->id }}"></div>
            </td>
            <td>
              <a href="{{ route('TelaMovimentacao', ['id' => $produto->id]) }}" class="btn btn-info btn-sm action-btn"><i class="fas fa-exchange-alt"></i> Movimentar</a>
              <a href="{{ route('editProduto', ['id' => $produto->id]) }}" class="btn btn-primary btn-sm action-btn"><i class="fas fa-edit"></i> Editar</a>
              <form action="{{ route('deleteProduto', ['id' => $produto->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este produto?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm action-btn"><i class="fas fa-trash"></i> Deletar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <a href="{{ route('cadastroProduto') }}" class="btn btn-dark btn-sm"><i class="fas fa-plus"></i> Cadastrar novo produto</a>
  </div>
</div>

<!-- Geração de QR Code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($produtos as $produto)
            var qrContent = 'Produto: {{ $produto->name }} - Categoria: {{ $produto->categoria }} - SKU: {{ $produto->sku }} - Valor compra(R$): {{ $produto->valor_compra }} - Valor venda(R$): {{ $produto->valor_venda }} - Quantidade: {{ $produto->quantidade }}'; 
            var qrcodeElement = document.getElementById("qrcode-{{ $produto->id }}");

            if (qrcodeElement) {
                new QRCode(qrcodeElement, {
                    text: qrContent,
                    width: 100,
                    height: 100
                });
            }
        @endforeach
    });
</script>

<!-- Estilo para os botões em coluna -->
<style>
    .action-btn {
        display: block;
        width: 100%; /* Mantém todos os botões da mesma largura */
        margin-bottom: 5px; /* Espaçamento entre os botões */
    }
</style>
@endsection
