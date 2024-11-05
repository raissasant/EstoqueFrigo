@extends('paginas.navUser')

@section('content')
<div class="container my-5">
    <div class="text-center">
        <h1>Bem-vindo(a), {{ session('user_name') }}</h1>
    </div>
    
    <div class="row mt-5">
        <div class="col-sm-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de produtos listados</h5>
                    <p class="card-text">{{ $ContagemProdutos }} produto(s).</p>
                    <a href="{{ route('ListagemProduto') }}" class="btn btn-primary">Listagem de produtos</a>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de armazéns listados</h5>
                    <p class="card-text">{{ $ContagemArmazens }} armazém(ns)</p>
                    <a href="{{ route('ListagemArmazem') }}" class="btn btn-primary">Listagens de armazéns</a>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de movimentações</h5>
                    <p class="card-text">{{ $ContagemMovimentacao }} movimentação(s).</p>
                    <a href="{{ route('ListagemMovimentacao') }}" class="btn btn-primary">Ver movimentação(s)</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
