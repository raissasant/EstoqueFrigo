@extends('paginas.base')

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 15-110px; padding: 20px; flex-grow: 1;">
    <h1 class="text-center">Bem-vindo(a), {{ session('user_name') }}</h1>
    <br>

    <div class="row">
      <!-- Total de Usuários -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-info h-100">
          <div class="card-body">
            <h5 class="card-title">Total de usuários</h5>
            <p class="card-text">{{ $contagemUser }} usuário(s).</p>
            <a href="{{ route('listagem/user') }}" class="btn btn-light">Listagem de usuários</a>
          </div>
        </div>
      </div>

      <!-- Total de Fornecedores -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-success h-100">
          <div class="card-body">
            <h5 class="card-title">Total de fornecedores</h5>
            <p class="card-text">{{ $contagemFornecedor }} fornecedor(es)</p>
            <a href="{{ route('listagemFornecedor') }}" class="btn btn-light">Lista de fornecedores</a>
          </div>
        </div>
      </div>

      <!-- Total de Produtos -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-warning h-100">
          <div class="card-body">
            <h5 class="card-title">Total de produtos</h5>
            <p class="card-text">{{ $contagemProduto }} produto(s)</p>
            <a href="{{ route('ListagemProduto') }}" class="btn btn-light">Listagem de produtos</a>
          </div>
        </div>
      </div>

      <!-- Total de Armazéns -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-danger h-100">
          <div class="card-body">
            <h5 class="card-title">Total de armazéns</h5>
            <p class="card-text">{{ $contagemArmazem }} armazém(ns)</p>
            <a href="{{ route('ListagemArmazem') }}" class="btn btn-light">Listagem de armazéns</a>
          </div>
        </div>
      </div>

      <!-- Total de Produtos em Estoque -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-primary h-100">
          <div class="card-body">
            <h5 class="card-title">Total de produtos em estoque</h5>
            <p class="card-text">{{ $totalProdutosEmEstoque }} item(ns)</p>
            <a href="{{ route('ListagemProduto') }}" class="btn btn-light">Ver todos os produtos</a>
          </div>
        </div>
      </div>
    </div>

    <br>

    <!-- Gráficos de Controle de Estoque -->
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Controle de Estoque por Armazém</h3>
          </div>
          <div class="card-body">
            <canvas id="stockChart" width="400" height="200"></canvas>
            <div id="noArmazemData" class="alert alert-warning" style="display: none;">
              Não há armazéns para exibir no gráfico de controle de estoque.
            </div>
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
  var armazemData = {!! json_encode($estoquePorArmazem) !!};
  var armazemLabels = Object.keys(armazemData);
  var productLabels = [];
  var datasets = [];
  var lowStockThreshold = 50;

  armazemLabels.forEach(armazem => {
    armazemData[armazem].forEach(produto => {
        if (!productLabels.includes(produto.produto)) {
            productLabels.push(produto.produto);
        }
    });
  });

  productLabels.forEach(produto => {
    var data = armazemLabels.map(armazem => {
        var item = armazemData[armazem].find(p => p.produto === produto);
        return item ? item.total : 0;
    });

    var backgroundColors = data.map(quantity => quantity < lowStockThreshold ? 'rgba(255, 99, 132, 0.2)' : 'rgba(75, 192, 192, 0.2)');
    var borderColors = data.map(quantity => quantity < lowStockThreshold ? 'rgba(255, 99, 132, 1)' : 'rgba(75, 192, 192, 1)');

    datasets.push({
        label: produto,
        data: data,
        backgroundColor: backgroundColors,
        borderColor: borderColors,
        borderWidth: 1
    });
  });

  new Chart(document.getElementById('stockChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: armazemLabels,
        datasets: datasets
    },
    options: {
        plugins: {
            title: { display: true, text: 'Quantidade de Produtos por Armazém' },
            tooltip: { callbacks: { label: context => `${context.dataset.label}: ${context.raw} unidade(s)` } }
        },
        responsive: true,
        scales: {
            y: { beginAtZero: true, title: { display: true, text: 'Quantidade de Produtos' } },
            x: { title: { display: true, text: 'Armazéns' } }
        }
    }
  });
</script>

<!-- Script para gerar o gráfico de Produtos em Estoque -->
<script>
  var productLabels = {!! json_encode($estoquePorProduto->keys()) !!};
  var productData = {!! json_encode($estoquePorProduto->values()) !!};
  var productColors = productData.map(quantity => quantity < 50 ? 'rgba(255, 99, 132, 1)' : quantity < 100 ? 'rgba(255, 206, 86, 1)' : 'rgba(75, 192, 192, 1)');

  new Chart(document.getElementById('productsChart').getContext('2d'), {
    type: 'bar',
    data: {
      labels: productLabels,
      datasets: [{ label: 'Quantidade em Estoque', data: productData, backgroundColor: productColors, borderWidth: 1 }]
    },
    options: {
      scales: { y: { beginAtZero: true } }
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
