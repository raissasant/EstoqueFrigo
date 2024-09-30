@extends('paginas.base')

@extends('paginas.nav')

@section('content')



<br>



    <div class="container">
    <h1>Editar e atualizar fornecedor</h1>
    <form action="{{  route('AtualizandoFornecedor', ['id' => $fornecedor->id]) }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" name="name" id="name" value="{{ $fornecedor->name }}">
       </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $fornecedor->email }}">
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" name="telefone" id="telefone" value="{{ $fornecedor->telefone }}">
        </div>

        <div class="form-group">
            <label>CEP(insira o CEP e depois aperte a tecla TAB)</label>
            <input  name="cep" type="text" id="cep" value="" size="10" maxlength="9" 
            value="{{ $fornecedor->cep}}">

        </div>
        <div class="form-group">
            <label>Rua</label>
            <input name="rua" type="text" id="rua" size="60"
            value="{{ $fornecedor->rua}}">

        </div>
        <div class="form-group">
            <label>Complemento</label>
            <input name="complemento" type="text" id="complemento" size="60"
            value="{{ $fornecedor->complemento}}">

        </div>
        <div class="form-group">
            <label >Bairro</label>
            <input name="bairro" type="text" id="bairro" size="40" 
            value="{{$fornecedor->bairro }}">

        </div>
        <div class="form-group">
            <label for="date">Cidade</label>
            <input name="cidade" type="text" id="cidade" size="40" 
            value="{{ $fornecedor->cidade }}">

        </div>
        <div class="form-group">
            <label>Estado</label>
            <input  name="uf" type="text" id="uf" size="2"
            value="{{ $fornecedor->uf }}">

        </div>
        <div class="mb-3">
    <label for="status">Status</label>
    <select class="custom-select" name="status" id="inputGroupSelect01">
        <option value="" disabled {{ $fornecedor->status ? '' : 'selected' }}>Selecionar...</option>
        <option value="ativo" {{ $fornecedor->status === 'ativo' ? 'selected' : '' }}>Ativo</option>
        <option value="inativo" {{ $fornecedor->status === 'inativo' ? 'selected' : '' }}>Inativo</option>
    </select>
</div>
        

        <button type="submit" class="btn btn-primary">Atualizar dados do usuário </button>
    </form>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection