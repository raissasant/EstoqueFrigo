@extends('paginas.base')

@extends('paginas.nav')

@section('content')

<body>
    <h1>Adicionar um novo usuário</h1>
    <br>
     
    <form action="{{ route('cadastrando/user')}}" method="POST">
      @csrf
    <div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nome</label>
        <input type="text" name ="name" class="form-control" id="exampleFormControlInput1" placeholder="Coloque seu nome completo">
      </div>
      <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">CPF</label>
      <input type="text" class="form-control" name="cpf" required id="exampleFormControlInput1" placeholder="Coloque seu CPF">
    </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Coloque seu e-mail">
      </div>
      
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Data de Nascimento</label>
  <input type="date" class="form-control" name="data_nascimento" id="exampleFormControlInput1" placeholder="">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Senha</label>
  <input type="password" class="form-control" name="password" required id="exampleFormControlInput1" placeholder="Defina sua senha">
</div>
<button  type="submit" class="btn  btn-dark">Salvar</button>
</div>
</form>
     

    </div>

</body>

@endsection






