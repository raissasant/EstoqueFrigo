@extends('paginas.base') <!-- Este é o layout principal -->

@include('paginas.navUser') <!-- Inclui o arquivo de navegação -->

@section('content')

<body>
    <div>
        <br>
        <center>
            <h1>Bem-vindo(a): {{ session('user_name') }}</h1>
        </center>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h5 class="card-title">Total de produtos listados</h5>
                    </center>
                    <p class="card-text">{{ $ContagemProdutos }} produto(s).</p>
                    <a href="{{ route('ListagemProduto') }}" class="btn btn-primary">Listagem de produtos</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h5 class="card-title">Total de armazéns listados</h5>
                    </center>
                    <p class="card-text">{{ $ContagemArmazens }} armazém(s)</p>
                    <a href="{{ route('ListagemArmazem') }}" class="btn btn-primary">Listagens de armazéns</a>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
</body>

@endsection
