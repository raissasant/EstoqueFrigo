@extends('paginas.base')


@extends('paginas.nav')

@section('content')

<div class="container" style="margin-left: 250px; padding: 20px; max-width: 800px;"> <!-- Ajuste de margem e largura -->
    <h1>Editar e atualizar armazém</h1>
    <form action="{{ route('atualizandoArmazem',['id' => $armazem->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $armazem->name) }}">
        </div>

        <div class="form-group">
            <label>CEP (insira o CEP e depois aperte a tecla TAB)</label>
            <input name="cep" type="text" class="form-control" id="cep" value="{{ $armazem->cep }}" maxlength="9">
        </div>

        <div class="form-group">
            <label>Rua</label>
            <input name="rua" type="text" class="form-control" id="rua" value="{{ $armazem->rua }}">
        </div>

        <div class="form-group">
            <label>Complemento</label>
            <input name="complemento" type="text" class="form-control" id="complemento" value="{{ $armazem->complemento }}">
        </div>

        <div class="form-group">
            <label>Bairro</label>
            <input name="bairro" type="text" class="form-control" id="bairro" value="{{ $armazem->bairro }}">
        </div>

        <div class="form-group">
            <label for="date">Cidade</label>
            <input name="cidade" type="text" class="form-control" id="cidade" value="{{ $armazem->cidade }}">
        </div>

        <div class="form-group">
            <label>Estado</label>
            <input name="uf" type="text" class="form-control" id="uf" maxlength="2" value="{{ $armazem->uf }}">
        </div>

        <div class="form-group">
            <label>Capacidade total</label>
            <input type="text" class="form-control" name="altura" id="altura" value="{{ old('capacidade_total', $armazem->capacidade_total) }}">
        </div>

        <div class="form-group">
            <label>Espaço disponível</label>
            <input type="text" class="form-control" name="largura" id="largura" value="{{ old('espaco_disponivel', $armazem->espaco_disponivel) }}">
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
            <select class="custom-select" name="status" id="inputGroupSelect01">
                <option value="" disabled {{ $armazem->status ? '' : 'selected' }}>Selecionar...</option>
                <option value="ativo" {{ $armazem->status === 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ $armazem->status === 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar dados do armazém</button>
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
