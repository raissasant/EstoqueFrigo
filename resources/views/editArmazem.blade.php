@extends('paginas.base')

@extends('paginas.navUser')

@section('content')


    <div class="container">
    <h1>Editar e atualizar armazém</h1>
    <form action="{{ route('atualizandoArmazem',['id' => $armazem->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $armazem->name) }}">
        </div>

        <div class="form-group">
            <label>CEP(insira o CEP e depois aperte a tecla TAB)</label>
            <input  name="cep" type="text" id="cep" value="" size="10" maxlength="9"
            value="{{ $armazem->cep}}">

        </div>
        <div class="form-group">
            <label>Rua</label>
            <input name="rua" type="text" id="rua" size="60"
            value="{{ $armazem->rua}}">

        </div>
        <div class="form-group">
            <label>Complemento</label>
            <input name="complemento" type="text" id="complemento" size="60"
            value="{{ $armazem->complemento}}">

        </div>
        <div class="form-group">
            <label >Bairro</label>
            <input name="bairro" type="text" id="bairro" size="40"
            value="{{$armazem->bairro }}">

        </div>
        <div class="form-group">
            <label for="date">Cidade</label>
            <input name="cidade" type="text" id="cidade" size="40"
            value="{{ $armazem->cidade }}">

        </div>
        <div class="form-group">
            <label>Estado</label>
            <input  name="uf" type="text" id="uf" size="2"
            value="{{ $armazem->uf }}">

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
