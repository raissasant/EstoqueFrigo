@extends('paginas.base')
@extends('paginas.nav')

@section('content')
<div class="container" style="margin-left: 250px; padding: 20px; max-width: 800px;">
    <h1>Editar e atualizar armazém</h1>
    <form action="{{ route('atualizandoArmazem', ['id' => $armazem->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $armazem->name) }}">
        </div>

        <div class="form-group">
            <label>CEP</label>
            <input name="cep" type="text" class="form-control" id="cep" value="{{ old('cep', $armazem->cep) }}" maxlength="9">
        </div>

        <div class="form-group">
            <label>Rua</label>
            <input name="rua" type="text" class="form-control" id="rua" value="{{ old('rua', $armazem->rua) }}">
        </div>

        <div class="form-group">
            <label>Complemento</label>
            <input name="complemento" type="text" class="form-control" id="complemento" value="{{ old('complemento', $armazem->complemento) }}">
        </div>

        <div class="form-group">
            <label>Bairro</label>
            <input name="bairro" type="text" class="form-control" id="bairro" value="{{ old('bairro', $armazem->bairro) }}">
        </div>

        <div class="form-group">
            <label>Cidade</label>
            <input name="cidade" type="text" class="form-control" id="cidade" value="{{ old('cidade', $armazem->cidade) }}">
        </div>

        <div class="form-group">
            <label>Estado</label>
            <input name="uf" type="text" class="form-control" id="uf" maxlength="2" value="{{ old('uf', $armazem->uf) }}">
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

        <button type="submit" class="btn btn-primary">Atualizar dados do armazém</button>
    </form>
</div>
@endsection
