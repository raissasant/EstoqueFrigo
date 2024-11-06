@extends('paginas.base')

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 10px; padding: 20px; flex-grow: 1; max-width: calc(100% - 250px);">
    <h1>Editar e atualizar fornecedor</h1>
    
    <form action="{{ route('atualizandoFornecedor', ['id' => $fornecedor->id]) }}" method="POST">
        @csrf

        <!-- Nome do Fornecedor -->
        <div class="form-group mb-3">
          <label for="name">Nome</label>
          <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $fornecedor->name) }}" required>
       </div>

        <!-- Email do Fornecedor -->
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $fornecedor->email) }}" required>
        </div>

        <!-- Telefone do Fornecedor -->
        <div class="form-group mb-3">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" name="telefone" id="telefone" value="{{ old('telefone', $fornecedor->telefone) }}" required>
        </div>

        <!-- Campos de Endereço -->

        <!-- CEP -->
        <div class="form-group mb-3">
            <label for="cep">CEP (insira o CEP e pressione TAB)</label>
            <input type="text" class="form-control" name="cep" id="cep" value="{{ old('cep', $fornecedor->cep) }}" required>
        </div>

        <!-- Rua -->
        <div class="form-group mb-3">
            <label for="rua">Rua</label>
            <input type="text" class="form-control" name="rua" id="rua" value="{{ old('rua', $fornecedor->rua) }}" required>
        </div>

        <!-- Complemento -->
        <div class="form-group mb-3">
            <label for="complemento">Complemento</label>
            <input type="text" class="form-control" name="complemento" id="complemento" value="{{ old('complemento', $fornecedor->complemento) }}">
        </div>

        <!-- Bairro -->
        <div class="form-group mb-3">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" name="bairro" id="bairro" value="{{ old('bairro', $fornecedor->bairro) }}" required>
        </div>

        <!-- Cidade -->
        <div class="form-group mb-3">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" name="cidade" id="cidade" value="{{ old('cidade', $fornecedor->cidade) }}" required>
        </div>

        <!-- Estado -->
        <div class="form-group mb-3">
            <label for="uf">Estado</label>
            <input type="text" class="form-control" name="uf" id="uf" value="{{ old('uf', $fornecedor->uf) }}" required>
        </div>

        <!-- Status do Fornecedor -->
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="ativo" {{ old('status', $fornecedor->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('status', $fornecedor->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        <!-- Botão para Submeter o Formulário -->
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>

    <!-- Exibição de Erros de Validação -->
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  </div>
</div>
@endsection
