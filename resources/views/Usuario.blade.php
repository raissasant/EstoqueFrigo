@extends('paginas.base')

@section('content')
<div class="container my-5">
    <div class="text-center">
        <h1>Bem-vindo(a), {{ session('user_name') }}</h1>
    </div>
    
    <div class="row mt-5">
        <!-- Total de Fornecedores -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Total de fornecedores</h5>
                    <p class="card-text">{{ $contagemFornecedor }} fornecedor(es)</p>
                    <a href="{{ route('listagemFornecedor') }}" class="btn btn-light">Lista de fornecedores</a>
                </div>
            </div>
        </div>

        <!-- Total de Produtos -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Total de produtos</h5>
                    <p class="card-text">{{ $contagemProduto }} produto(s)</p>
                    <a href="{{ route('ListagemProduto') }}" class="btn btn-light">Listagem de produtos</a>
                </div>
            </div>
        </div>

        <!-- Total de Armazéns -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Total de armazéns</h5>
                    <p class="card-text">{{ $contagemArmazem }} armazém(ns)</p>
                    <a href="{{ route('ListagemArmazem') }}" class="btn btn-light">Listagem de armazéns</a>
                </div>
            </div>
        </div>

        <!-- Total de Movimentações -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card text-white bg-secondary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total de movimentações</h5>
                    <p class="card-text">{{ $contagemMovimentacao }} movimentação(s)</p>
                    <a href="{{ route('ListagemMovimentacao') }}" class="btn btn-light">Ver movimentação(s)</a>
                </div>
            </div>
        </div>

        <!-- Total de Produtos em Estoque -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total de produtos em estoque</h5>
                    <p class="card-text">{{ $totalProdutosEmEstoque }} item(ns)</p>
                    <a href="{{ route('ListagemProduto') }}" class="btn btn-light">Ver todos os produtos</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluindo gráficos de controle de estoque -->
    @include('paginas.graficos')
</div>
@endsection
