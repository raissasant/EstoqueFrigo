@extends('paginas.base') <!-- Mantém sua base existente -->
@extends('paginas.nav') <!-- Inclui a sidebar existente -->

@section('content')
<div class="wrapper" style="display: flex;">

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

    <table class="table mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Categoria</th>
          <th>SKU</th>
          <th>Valor de compra(R$)</th>
          <th>Valor de venda(R$)</th>
          <th>Quantidade em estoque</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($produtos as $produto)
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
        @endforeach
      </tbody>
    </table>

    <a href="{{ route('cadastroProduto') }}" class="btn btn-dark btn-sm"><i class="fas fa-plus"></i> Cadastrar novo produto</a>
  </div>
</div>

@endsection
