@extends('paginas.base')

@extends('paginas.navr')

@section('content')





<body>
    <div>
      <br>
   <center> <h1>Bem vindo(a): {{ session('user_name') }}</h1>
    <div>
      <br>
      <br>
      </body>

       <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <center><h5 class="card-title">Total de produtos listados</h5>
           <p class="card-text">{{ $ContagemProdutos }} produto(s).</p>
        <a href="{{route('ListagemProduto')}}" class="btn btn-primary">Listagem de produtos</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total de armazéns listados</h5>
        <p class="card-text">{{$ContagemArmazens}} armazém(s)</p>
        <a href="{{route('ListagemArmazem')}}" class="btn btn-primary">Listagens de armazéns</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <center><h5 class="card-title">Total de movimentações</h5>
           <p class="card-text">{{ $ContagemMovimentacao }} movimentação(s).</p>
        <a href="{{route('ListagemMovimentacao')}}" class="btn btn-primary">Ver movimentação(s)</a>
      </div>
    </div>
  </div>
</div>
</div>
<br>
<br>
                
  </body>



@endsection