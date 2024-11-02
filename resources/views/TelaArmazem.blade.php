@extends('paginas.base') <!-- Mantém sua base existente -->
@extends('paginas.nav') <!-- Inclui a sidebar existente -->

@section('content')
<div class="wrapper" style="display: flex;">

  <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
    <h1>Cadastro de Armazém</h1>
    <br>

    <form action="{{ route('storeArmazem') }}" method="POST">
      @csrf
      <div>
        <!-- Nome do Armazém -->
        <div class="mb-3">
          <label for="nome" class="form-label">Nome do Armazém</label>
          <input type="text" name="name" class="form-control" id="nome" placeholder="Informe o nome do armazém" required>
        </div>

        <!-- CEP -->
        <div class="mb-3">
          <label for="cep" class="form-label">CEP</label>
          <input type="text" class="form-control" name="cep" id="cep" placeholder="Informe o CEP" required>
        </div>

        <!-- Rua (sem readonly) -->
        <div class="mb-3">
          <label for="rua" class="form-label">Rua</label>
          <input type="text" name="rua" class="form-control" id="rua" placeholder="Rua">
        </div>

        <!-- Bairro -->
        <div class="mb-3">
          <label for="bairro" class="form-label">Bairro</label>
          <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro">
        </div>

        <!-- Cidade -->
        <div class="mb-3">
          <label for="cidade" class="form-label">Cidade</label>
          <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" readonly>
        </div>

        <!-- Estado -->
        <div class="mb-3">
          <label for="uf" class="form-label">Estado</label>
          <input type="text" class="form-control" name="uf" id="uf" placeholder="Estado" readonly>
        </div>

        <!-- Capacidade de Armazenamento -->
        <div class="mb-3">
          <label for="capacidade_total" class="form-label">Capacidade de Armazenamento (m³)</label>
          <input type="text" class="form-control" name="capacidade_total" id="capacidade_total" placeholder="Informe a capacidade em metros cúbicos" required>
        </div>

        <!-- Espaço Disponível -->
        <div class="mb-3">
          <label for="espaco_disponivel" class="form-label">Espaço Disponível</label>
          <input type="text" class="form-control" name="espaco_disponivel" id="espaco_disponivel" placeholder="Informe o espaço disponível" required>
        </div>

        <!-- Status do Armazém -->
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-control" name="status" id="status" required>
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
          </select>
        </div>

        <!-- Botões de Ação -->
        <button type="submit" class="btn btn-success">Salvar</button>
        <button type="reset" class="btn btn-dark">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- JavaScript para API ViaCEP -->
<script>
document.getElementById('cep').addEventListener('blur', function() {
    const cep = this.value.replace(/\D/g, '');
    if (cep) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    // Apenas preenche automaticamente bairro, cidade e estado
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('uf').value = data.uf;
                } else {
                    alert('CEP não encontrado.');
                }
            })
            .catch(error => console.error('Erro ao buscar o CEP:', error));
    }
});
</script>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
