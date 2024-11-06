@extends('paginas.base') <!-- Mantém sua base existente -->


@section('content')
<style>
  /* CSS para botões menores */
  .btn-custom {
      padding: 0.25rem 0.0rem; /* Ajusta o padding para menor */
      font-size: 0.890rem; /* Tamanho da fonte padrão */
      line-height: 1.5; /* Mantém o espaçamento interno */
      border-radius: 0.4rem; /* Arredonda os cantos do botão */
      width: 80px; /* Define uma largura fixa para o botão */
      /* ou você pode usar width: auto; se quiser que a largura se ajuste ao conteúdo */
  }
</style>

<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 10px; padding: 20px; flex-grow: 1;">
    <h1>Adicionar um Novo Fornecedor</h1>
    <br>

    <form action="{{ route('storeFornecedor') }}" method="POST">
      @csrf
      <div>
        <div class="mb-3">
          <label for="name" class="form-label">Nome</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Coloque o nome completo do fornecedor" required>
        </div>

        <div class="mb-3">
          <label for="cnpj" class="form-label">CNPJ</label>
          <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="Coloque o CNPJ, somente números" required>
        </div>

        <div class="mb-3">
          <label for="cpf" class="form-label">CPF (se necessário)</label>
          <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Coloque o CPF, somente números">
        </div>

        <div class="mb-3">
          <label for="telefone" class="form-label">Telefone</label>
          <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Coloque o telefone" required>
        </div>

        <div class="mb-3">
          <label for="cep" class="form-label">CEP</label>
          <input type="text" name="cep" class="form-control" id="cep" placeholder="Insira o CEP" required>
        </div>

        <div class="mb-3">
          <label for="rua" class="form-label">Rua</label>
          <input type="text" name="rua" class="form-control" id="rua" placeholder="Insira a rua" required>
        </div>

        <div class="mb-3">
          <label for="complemento" class="form-label">Complemento (se houver)</label>
          <input type="text" name="complemento" class="form-control" id="complemento" placeholder="Complemento">
        </div>

        <div class="mb-3">
          <label for="bairro" class="form-label">Bairro</label>
          <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Insira o bairro" required>
        </div>

        <div class="mb-3">
          <label for="cidade" class="form-label">Cidade</label>
          <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Insira a cidade" required>
        </div>

        <div class="mb-3">
          <label for="uf" class="form-label">Estado</label>
          <input type="text" name="uf" class="form-control" id="uf" placeholder="Insira o estado" maxlength="2" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Coloque o e-mail" required>
        </div>

        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-control" name="status" id="status" required>
            <option value="" disabled selected>Selecionar...</option>
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
          </select>
        </div>

        <button type="submit" class="btn btn-success btn-custom">Salvar </button>
        <button type="reset" class="btn btn-dark btn-custom">Cancelar </button>
      </div>
    </form>

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

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection

