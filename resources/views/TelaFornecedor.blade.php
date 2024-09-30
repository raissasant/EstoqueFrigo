@extends('paginas.base')

@extends('paginas.nav')

@section('content')

<body>
    <h1>Adicionar um novo fornecedor</h1>
    <br>

    <form action="{{ route('storeFornecedor')}}" method="POST">
      @csrf
    <div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nome</label>
        <input type="text" name ="name" class="form-control" id="exampleFormControlInput1" placeholder="Coloque o nome completo do fornecedor">
      </div>
       <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">CNPJ</label>
      <input type="text" class="form-control" name="cnpj"  id="exampleFormControlInput1" placeholder="Coloque o CNPJ, somente números">
    </div>
      <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">CPF (se for necessario)</label>
      <input type="text" class="form-control" name="cpf"  id="exampleFormControlInput1" placeholder="Coloque o CPF, somente números">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Telefone</label>
      <input type="text" class="form-control" name="telefone" required id="exampleFormControlInput1" placeholder="Coloque o telefone">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Endereço:</label>
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

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Coloque o e-mail">
      </div>

      <div class="mb-3">
      <label>Status</label>
      <select class="custom-select" name = "status" id="inputGroupSelect01">
        <option selected>Selecionar...</option>
        <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
        </select>
        </div>


<button  type="submit" class="btn btn-success">Salvar os dados do fornecedor</button>
<button  type="reset" class="btn  btn-dark">Cancelar cadastro de fornecedor</button>

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
