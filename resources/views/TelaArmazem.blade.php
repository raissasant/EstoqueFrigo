@extends('paginas.base')

@extends('paginas.navUser')

@section('content')



<body>
    <h1>Inserir novo armazém </h1>
    <br>

    <form action="{{ route('storeArmazem')}}" method="POST">
      @csrf
    <div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nome</label>
        <input type="text" name ="name" class="form-control" required id="exampleFormControlInput1" placeholder="Coloque o nome do armazém">
      </div>
      <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Localização:</label>
    </div>
    <label>Cep: (insira o CEP e depois aperte a tecla TAB)
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" /></label><br />
        <label>Rua:
        <input name="rua" type="text" id="rua" size="60" /></label><br />
        <label>Complemento: (se tiver)
        <input name="complemento" type="text" id="complemento" size="60" /></label><br />
        <label>Bairro:
        <input name="bairro" type="text" id="bairro" size="40" /></label><br />
        <label>Cidade:
        <input name="cidade" type="text" id="cidade" size="40" /></label><br />
        <label>Estado:
        <input name="uf" type="text" id="uf" size="2" /></label><br/>
      </div>

      <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Capacidade total</label>
      <input type="text" class="form-control" name="capacidade_total"  required  id="exampleFormControlInput1" placeholder="Informe a capacidade total, coloque somente números inteiros">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Espaço disponivel </label>
      <input type="text" class="form-control" name="espaco_disponivel" required id="exampleFormControlInput1" placeholder="Informe o espaço disponivel, coloque somente números inteiros">
    </div>
      <div class="mb-3">
      <label>Status</label>
      <select class="custom-select" name = "status" id="inputGroupSelect01">
        <option selected>Selecionar...</option>
        <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
        </select>
        </div>



<button  type="submit" class="btn btn-success">Salvar armazém</button>
<button  type="reset" class="btn  btn-dark">Cancelar cadastro de armazém</button>

  </div>
  </form>
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif


      </div>

  </body>



@endsection
