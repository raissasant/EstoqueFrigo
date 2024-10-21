@extends('paginas.base')

@extends('paginas.nav')

@section('content')

   <body>
    <div>
      <br>
   <center> <h1>Bem vindo(a): {{ session('user_name') }}</h1>
    </div>
    <br>
    <br>
       <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <center><h5 class="card-title">Total de usuários listados</h5>
           <p class="card-text">{{ $ContagemUser }} usuario(s).</p>
        <a href="{{route('listagem/user')}}" class="btn btn-primary">Listagem de usuários</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total de fornecedores listados</h5>
       <center><p class="card-text">{{ $ContagemFornecedor}} fornecedor(s)</p>
        <center><a href="{{route('listagemFornecedor')}}" class="btn btn-primary">Listagem de fornecedores</a>
      </div>
    </div>
  </div>
</div>
</div>
<br>
<br>

      </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>

@endsection
