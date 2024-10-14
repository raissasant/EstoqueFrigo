@extends('paginas.base')

@extends('paginas.navUser')

@section('content')

<form action="{{  route('SearchProduto') }}" method="GET">
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



<h1>Listagem de produtos</h1>
    <table class="table mt-3">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>SKU</th>
            <th>Valor de compra(R$)</th>
            <th>Valor de venda(R$)</th>
            <th>Quantidade em estoque</th>
            <th>Qr Code</th>
            <th>Editar ou Excluir</th>
        </tr>
        @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->id }}</td>
                <td>{{ $produto->name }}</td>
                <td>{{ $produto->descricao }}</td>
                <td>{{ $produto->categoria }}</td>
                <td>{{ $produto->sku }}</td>
                <td>{{ $produto->valor_compra}}</td>
                <td>{{ $produto->valor_venda }}</td>
                <td>{{ $produto->quantidade }}</td>
               
                <td>
                     <div id="qrcode-{{ $produto->id }}"></div> 
            </td>
            <td>


                    <a href="{{ route('editProduto', ['id' => $produto->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                     <form action="{{ route('deleteProduto', ['id' => $produto->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este produto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
                </td>
            </tr>
        @endforeach
    </table>

    <a href="{{ route('cadastroProduto') }}" class="btn btn-dark"><i class="fas fa-plus"></i> Cadastrar novo produto</a>

<!-- Geração de  Qr Code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($produtos as $produto)
            var qrContent = 'Produto: {{ $produto->name }} - Categoria: {{ $produto->categoria }} - SKU: {{ $produto->sku }} - Valor compra(R$): {{ $produto->valor_compra }} - Valor venda(R$): {{ $produto->valor_venda }} - Quantidade: {{ $produto->quantidade}}'; 
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


@endsection