<<<<<<< HEAD
@extends('paginas.base')
@extends('paginas.nav')
=======
@extends('paginas.base') <!-- Mantém sua base existente -->
@extends('paginas.nav') <!-- Inclui a sidebar existente -->
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf

@section('content')
<div class="wrapper" style="display: flex;">

<<<<<<< HEAD
<div class="content" style="margin-left: 230px; padding: 10px; flex-grow: 1;">
    <form action="{{ route('SearchProduto') }}" method="GET">
        @csrf
        <div class="mb-3">
            <label for="search">Buscar produto</label>
            <input type="text" class="form-control" name="search" id="search" placeholder="Digite o nome ou SKU">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    
    @if(isset($message))
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <br>
    <h1>Listagem de produtos</h1>

=======
  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
    <h1>Listagem de produtos</h1>
    
    <form action="{{ route('SearchProduto') }}" method="GET">
      @csrf
      <div class="mb-3">
        <label for="search">Buscar produto</label>
        <input type="text" class="form-control" name="search" id="search" placeholder="Digite o nome ou SKU">
      </div>
      <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
    </form>

    @if(isset($message))
      <div class="alert alert-warning">
        {{ $message }}
      </div>
    @endif

>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
    <table class="table mt-3">
      <thead>
        <tr>
<<<<<<< HEAD
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Código produto</th>
            <th>Categoria</th>
            <th>SKU</th>
            <th>Valor de compra(R$)</th>
            <th>Valor de venda(R$)</th>
            <th>Quantidade em estoque</th>
            <th>Qr Code</th>
            <th>Ações</th>
=======
          <th>ID</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Categoria</th>
          <th>SKU</th>
          <th>Valor de compra(R$)</th>
          <th>Valor de venda(R$)</th>
          <th>Quantidade em estoque</th>
          <th>Ações</th>
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
        </tr>
      </thead>
      <tbody>
        @foreach($produtos as $produto)
<<<<<<< HEAD
            <tr>
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
=======
          <tr>
            <td>{{ $produto->id }}</td>
            <td>{{ $produto->name }}</td>
            <td>{{ $produto->descricao }}</td>
            <td>{{ $produto->categoria }}</td>
            <td>{{ $produto->sku }}</td>
            <td>{{ $produto->valor_compra }}</td>
            <td>{{ $produto->valor_venda }}</td>
            <td>{{ $produto->quantidade }}</td>
            <td>
              <a href="{{ route('editProduto', ['id' => $produto->id]) }}" class="btn btn-primary btn-sm mb-2" style="padding: 4px 8px; font-size: 0.875rem;">
                <i class="fas fa-edit"></i> Editar
              </a>
              <form action="{{ route('deleteProduto', ['id' => $produto->id]) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" style="padding: 4px 8px; font-size: 0.875rem;" onclick="return confirm('Tem certeza que deseja excluir?');">
                  <i class="fas fa-trash-alt"></i> Excluir
                </button>
              </form>
            </td>
          </tr>
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
        @endforeach
      </tbody>
    </table>

<<<<<<< HEAD
    <a href="{{ route('cadastroProduto') }}" class="btn btn-dark"><i class="fas fa-plus"></i> Cadastrar novo produto</a>

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
</div> <!-- Fechando div .content -->

<!-- Estilo para os botões em coluna -->
<style>
    .action-btn {
        display: block;
        width: 100%; /* Mantém todos os botões da mesma largura */
        margin-bottom: 5px; /* Espaçamento entre os botões */
    }
</style>
=======
    <a href="{{ route('cadastroProduto') }}" class="btn btn-dark btn-sm"><i class="fas fa-plus"></i> Cadastrar novo produto</a>
  </div>
</div>
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf

@endsection
