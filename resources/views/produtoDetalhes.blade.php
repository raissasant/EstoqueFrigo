@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Produto</h1>
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $produto->id }}</td>
            </tr>
            <tr>
                <th>Nome</th>
                <td>{{ $produto->name }}</td>
            </tr>
            <tr>
                <th>Descrição</th>
                <td>{{ $produto->descricao }}</td>
            </tr>
            <tr>
                <th>Categoria</th>
                <td>{{ $produto->categoria }}</td>
            </tr>
            <tr>
                <th>SKU</th>
                <td>{{ $produto->sku }}</td>
            </tr>
            <tr>
                <th>Valor de Compra (R$)</th>
                <td>{{ $produto->valor_compra }}</td>
            </tr>
            <tr>
                <th>Valor de Venda (R$)</th>
                <td>{{ $produto->valor_venda }}</td>
            </tr>
            <tr>
                <th>Quantidade</th>
                <td>{{ $produto->quantidade }}</td>
            </tr>
        </table>

        <a href="{{ route('ListagemProduto') }}" class="btn btn-secondary">Voltar para a listagem de produtos</a>
    </div>
@endsection
