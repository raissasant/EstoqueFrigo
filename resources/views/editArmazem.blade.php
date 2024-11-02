@extends('paginas.base')
<<<<<<< HEAD
@extends('paginas.nav')

@section('content')
<div class="container" style="margin-left: 250px; padding: 20px; max-width: 800px;">
=======


@extends('paginas.nav')

@section('content')

<div class="container" style="margin-left: 250px; padding: 20px; max-width: 800px;"> <!-- Ajuste de margem e largura -->
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
    <h1>Editar e atualizar armazém</h1>
    <form action="{{ route('atualizandoArmazem', ['id' => $armazem->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $armazem->name) }}">
        </div>

        <div class="form-group">
<<<<<<< HEAD
            <label>CEP</label>
            <input name="cep" type="text" class="form-control" id="cep" value="{{ old('cep', $armazem->cep) }}" maxlength="9">
=======
            <label>CEP (insira o CEP e depois aperte a tecla TAB)</label>
            <input name="cep" type="text" class="form-control" id="cep" value="{{ $armazem->cep }}" maxlength="9">
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
        </div>

        <div class="form-group">
            <label>Rua</label>
<<<<<<< HEAD
            <input name="rua" type="text" class="form-control" id="rua" value="{{ old('rua', $armazem->rua) }}">
=======
            <input name="rua" type="text" class="form-control" id="rua" value="{{ $armazem->rua }}">
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
        </div>

        <div class="form-group">
            <label>Complemento</label>
<<<<<<< HEAD
            <input name="complemento" type="text" class="form-control" id="complemento" value="{{ old('complemento', $armazem->complemento) }}">
=======
            <input name="complemento" type="text" class="form-control" id="complemento" value="{{ $armazem->complemento }}">
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
        </div>

        <div class="form-group">
            <label>Bairro</label>
<<<<<<< HEAD
            <input name="bairro" type="text" class="form-control" id="bairro" value="{{ old('bairro', $armazem->bairro) }}">
        </div>

        <div class="form-group">
            <label>Cidade</label>
            <input name="cidade" type="text" class="form-control" id="cidade" value="{{ old('cidade', $armazem->cidade) }}">
=======
            <input name="bairro" type="text" class="form-control" id="bairro" value="{{ $armazem->bairro }}">
        </div>

        <div class="form-group">
            <label for="date">Cidade</label>
            <input name="cidade" type="text" class="form-control" id="cidade" value="{{ $armazem->cidade }}">
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
        </div>

        <div class="form-group">
            <label>Estado</label>
<<<<<<< HEAD
            <input name="uf" type="text" class="form-control" id="uf" maxlength="2" value="{{ old('uf', $armazem->uf) }}">
=======
            <input name="uf" type="text" class="form-control" id="uf" maxlength="2" value="{{ $armazem->uf }}">
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
        </div>

        <div class="form-group">
            <label>Capacidade total</label>
            <input type="text" class="form-control" name="capacidade_total" id="capacidade_total" value="{{ old('capacidade_total', $armazem->capacidade_total) }}">
        </div>

        <div class="form-group">
            <label>Espaço disponível</label>
            <input type="text" class="form-control" name="espaco_disponivel" id="espaco_disponivel" value="{{ old('espaco_disponivel', $armazem->espaco_disponivel) }}">
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
            <select class="custom-select" name="status" id="inputGroupSelect01">
                <option value="" disabled {{ $armazem->status ? '' : 'selected' }}>Selecionar...</option>
                <option value="ativo" {{ $armazem->status === 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ $armazem->status === 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>
<<<<<<< HEAD
=======

        <div class="mb-3">
            <label for="status">Status</label>
            <select class="custom-select" name="status" id="inputGroupSelect01">
                <option value="" disabled {{ $armazem->status ? '' : 'selected' }}>Selecionar...</option>
                <option value="ativo" {{ $armazem->status === 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ $armazem->status === 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf

        <button type="submit" class="btn btn-primary">Atualizar dados do armazém</button>
    </form>
</div>
<<<<<<< HEAD
=======

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
@endsection
