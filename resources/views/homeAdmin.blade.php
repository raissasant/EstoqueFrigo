@extends('paginas.base') <!-- Mantém sua base existente -->
@extends('paginas.nav') <!-- Inclui a sidebar existente -->

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
    <h1 class="text-center">Bem-vindo(a), {{ session('user_name') }}</h1>

    <br>

    <div class="row">
      <!-- Total de Usuários -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-info h-100">
          <div class="card-body">
            <h5 class="card-title">Total de usuários</h5>
            <p class="card-text">{{ $ContagemUser }} usuário(s).</p>
            <a href="{{ route('listagem/user') }}" class="btn btn-light">Listagem de usuários</a>
          </div>
        </div>
      </div>

      <!-- Total de Fornecedores -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-success h-100">
          <div class="card-body">
            <h5 class="card-title">Total de fornecedores</h5>
            <p class="card-text">{{ $ContagemFornecedor }} fornecedor(es)</p>
            <a href="{{ route('listagemFornecedor') }}" class="btn btn-light">Listagem de fornecedores</a>
          </div>
        </div>
      </div>

      <!-- Total de Produtos -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-warning h-100">
          <div class="card-body">
            <h5 class="card-title">Total de produtos</h5>
            <p class="card-text">{{ $ContagemProduto }} produto(s)</p>
            <a href="{{ route('ListagemProduto') }}" class="btn btn-light">Listagem de produtos</a>
          </div>
        </div>
      </div>

      <!-- Total de Armazéns -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-danger h-100">
          <div class="card-body">
            <h5 class="card-title">Total de armazéns</h5>
            <p class="card-text">{{ $ContagemArmazem }} armazém(ns)</p>
            <a href="{{ route('ListagemArmazem') }}" class="btn btn-light">Listagem de armazéns</a>
          </div>
        </div>
      </div>
    </div>

    <br>

    <!-- Gráficos de Controle de Estoque -->
    <div class="row">
      <!-- Gráfico de Controle de Estoque por Armazém -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Controle de Estoque por Armazém</h3>
          </div>
          <div class="card-body">
            <canvas id="stockChart" width="400" height="200"></canvas>
          </div>
        </div>
      </div>

      <!-- Gráfico de Produtos -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Controle de Produtos em Estoque</h3>
          </div>
          <div class="card-body">
            <canvas id="productsChart" width="400" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Incluir a biblioteca Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script para gerar o gráfico dos armazéns -->
<script>
  var ctx = document.getElementById('stockChart').getContext('2d');
  var stockChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Armazém 1', 'Armazém 2', 'Armazém 3'], // Substitua pelos nomes reais
      datasets: [{
        label: 'Produtos em Estoque',
        data: [120, 150, 180], // Exemplo de dados (substitua pelos dados reais)
        backgroundColor: [
          'rgba(54, 162, 235, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(54, 162, 235, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<!-- Script para gerar o gráfico de produtos -->
<script>
  var ctxProducts = document.getElementById('productsChart').getContext('2d');
  var productsChart = new Chart(ctxProducts, {
    type: 'line',
    data: {
      labels: ['Produto A', 'Produto B', 'Produto C'], // Substitua pelos nomes reais
      datasets: [{
        label: 'Quantidade em Estoque',
        data: [50, 100, 75], // Exemplo de dados (substitua pelos dados reais)
        fill: false,
        borderColor: 'rgba(75, 192, 192, 1)',
        tension: 0.1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<!-- Scripts Bootstrap e FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
