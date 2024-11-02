<<<<<<< HEAD
@extends('paginas.base') 
@extends('paginas.nav')
=======
@extends('paginas.base') <!-- Mantém sua base existente -->
@extends('paginas.nav') <!-- Inclui a sidebar existente -->
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf

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
<<<<<<< HEAD
            <p class="card-text">{{ $contagemUser }} usuário(s).</p>
=======
            <p class="card-text">{{ $ContagemUser }} usuário(s).</p>
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
            <a href="{{ route('listagem/user') }}" class="btn btn-light">Listagem de usuários</a>
          </div>
        </div>
      </div>

      <!-- Total de Fornecedores -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-success h-100">
          <div class="card-body">
            <h5 class="card-title">Total de fornecedores</h5>
<<<<<<< HEAD
            <p class="card-text">{{ $contagemFornecedor }} fornecedor(es)</p>
            <a href="{{ route('listagemFornecedor') }}" class="btn btn-light">Lista de fornecedores</a>
=======
            <p class="card-text">{{ $ContagemFornecedor }} fornecedor(es)</p>
            <a href="{{ route('listagemFornecedor') }}" class="btn btn-light">Listagem de fornecedores</a>
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
          </div>
        </div>
      </div>

<<<<<<< HEAD
      <!-- Total de Produtos Cadastrados -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-warning h-100">
          <div class="card-body">
            <h5 class="card-title">Total de produtos </h5>
            <p class="card-text">{{ $contagemProduto }} produto(s).</p>
=======
      <!-- Total de Produtos -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-warning h-100">
          <div class="card-body">
            <h5 class="card-title">Total de produtos</h5>
            <p class="card-text">{{ $ContagemProduto }} produto(s)</p>
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
            <a href="{{ route('ListagemProduto') }}" class="btn btn-light">Listagem de produtos</a>
          </div>
        </div>
      </div>

      <!-- Total de Armazéns -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-danger h-100">
          <div class="card-body">
            <h5 class="card-title">Total de armazéns</h5>
<<<<<<< HEAD
            <p class="card-text">{{ $contagemArmazem }} armazém(ns).</p>
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
=======
            <p class="card-text">{{ $ContagemArmazem }} armazém(ns)</p>
            <a href="{{ route('ListagemArmazem') }}" class="btn btn-light">Listagem de armazéns</a>
          </div>
        </div>
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
      </div>
    </div>

    <br>

    <!-- Gráficos de Controle de Estoque -->
    <div class="row">
<<<<<<< HEAD
=======
      <!-- Gráfico de Controle de Estoque por Armazém -->
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Controle de Estoque por Armazém</h3>
          </div>
          <div class="card-body">
            <canvas id="stockChart" width="400" height="200"></canvas>
<<<<<<< HEAD
            <!-- Mensagem de aviso, exibida apenas se não houver dados no gráfico -->
            <div id="noArmazemData" class="alert alert-warning" style="display: none;">
              Não há armazéns para exibir no gráfico de controle de estoque.
            </div>
=======
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
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
<<<<<<< HEAD
// Dados para o gráfico de armazéns
// Dados para o gráfico de armazéns
var armazemData = {!! json_encode($estoquePorArmazem) !!}; // Dados de estoque por armazém e produto
var armazemLabels = Object.keys(armazemData); // Nomes dos armazéns
var productLabels = []; // Lista de produtos única
var datasets = [];

// Define o limite de estoque baixo
var lowStockThreshold = 50;

// Coleta os nomes dos produtos para garantir que temos rótulos consistentes em todos os armazéns
armazemLabels.forEach(armazem => {
    armazemData[armazem].forEach(produto => {
        if (!productLabels.includes(produto.produto)) {
            productLabels.push(produto.produto);
        }
    });
});

// Para cada produto, cria um dataset que representa a quantidade do produto em cada armazém
productLabels.forEach(produto => {
    var data = armazemLabels.map(armazem => {
        // Encontra o produto no armazém ou retorna 0 se o produto não estiver no armazém
        var item = armazemData[armazem].find(p => p.produto === produto);
        return item ? item.total : 0;
    });

    // Define as cores: vermelho para baixo estoque, verde para estoque normal
    var backgroundColors = data.map(quantity => quantity < lowStockThreshold ? 'rgba(255, 99, 132, 0.2)' : 'rgba(75, 192, 192, 0.2)');
    var borderColors = data.map(quantity => quantity < lowStockThreshold ? 'rgba(255, 99, 132, 1)' : 'rgba(75, 192, 192, 1)');

    datasets.push({
        label: produto, // Nome do produto
        data: data, // Quantidade do produto em cada armazém
        backgroundColor: backgroundColors,
        borderColor: borderColors,
        borderWidth: 1
    });
});

var ctx = document.getElementById('stockChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: armazemLabels, // Nomes dos armazéns
        datasets: datasets // Cada produto como uma série de dados
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Quantidade de Produtos por Armazém'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return `${context.dataset.label}: ${context.raw} unidade(s)`;
                    }
                }
            }
        },
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantidade de Produtos'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Armazéns'
                }
            }
        }
    }
});

</script>

<!-- Script para gerar o gráfico de Produtos em Estoque -->
<script>
  var ctxProducts = document.getElementById('productsChart').getContext('2d');
  
  // Dados para o gráfico de produtos
  var productLabels = {!! json_encode($estoquePorProduto->keys()) !!}; // Nomes dos produtos
  var productData = {!! json_encode($estoquePorProduto->values()) !!}; // Quantidades dos produtos
  
  var productColors = productData.map(quantity => {
    return quantity < 50 ? 'rgba(255, 99, 132, 1)' : quantity < 100 ? 'rgba(255, 206, 86, 1)' : 'rgba(75, 192, 192, 1)';
  });

  var productsChart = new Chart(ctxProducts, {
    type: 'bar',
    data: {
      labels: productLabels,
      datasets: [{
        label: 'Quantidade em Estoque',
        data: productData,
        backgroundColor: productColors,
        borderColor: productColors.map(color => color.replace('0.2', '1')),
        borderWidth: 1
=======
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
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
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
