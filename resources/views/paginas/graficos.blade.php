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

<!-- Incluir a biblioteca Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Dados do gráfico de estoque por armazém
  var armazemData = {!! json_encode($estoquePorArmazem) !!};
  var armazemLabels = Object.keys(armazemData);
  var productLabels = [];
  var datasets = [];
  var lowStockThreshold = 10; // Define o limite de estoque baixo

  // Extrair todos os produtos de todos os armazéns
  armazemLabels.forEach(armazem => {
    armazemData[armazem].forEach(produto => {
      if (!productLabels.includes(produto.produto)) {
        productLabels.push(produto.produto);
      }
    });
  });

  // Configurar dados para cada produto, convertendo estoques baixos em valores negativos
  productLabels.forEach(produto => {
    var data = [];
    var backgroundColors = [];
    var borderColors = [];
    
    armazemLabels.forEach(armazem => {
      var item = armazemData[armazem].find(p => p.produto === produto);
      var quantity = item ? item.total : 0;
      
      // Converte a quantidade para negativa se estiver abaixo do limite
      var displayQuantity = quantity < lowStockThreshold ? -Math.abs(quantity) : quantity;
      data.push(displayQuantity);
      
      // Define a cor com base no estoque
      if (quantity < lowStockThreshold) {
        backgroundColors.push('rgba(255, 99, 132, 0.5)'); // Estoque baixo (vermelho)
        borderColors.push('rgba(255, 99, 132, 1)');
      } else {
        backgroundColors.push('rgba(75, 192, 192, 0.5)'); // Estoque normal (azul)
        borderColors.push('rgba(75, 192, 192, 1)');
      }
    });

    datasets.push({
      label: produto,
      data: data,
      backgroundColor: backgroundColors,
      borderColor: borderColors,
      borderWidth: 1
    });
  });

  // Inicializar o gráfico de controle de estoque por armazém
  new Chart(document.getElementById('stockChart').getContext('2d'), {
    type: 'bar',
    data: {
      labels: armazemLabels,
      datasets: datasets
    },
    options: {
      plugins: {
        title: { display: true, text: 'Quantidade de Produtos por Armazém' },
        tooltip: { 
          callbacks: { 
            label: context => {
              const rawValue = context.raw;
              const productName = context.dataset.label;
              const stockStatus = rawValue < 0 ? 'Estoque Baixo' : 'Quantidade em Estoque';
              const quantity = Math.abs(rawValue);
              
              return `${productName} - ${stockStatus}: ${quantity} unidade(s)`;
            } 
          } 
        }
      },
      responsive: true,
      scales: {
        y: { 
          beginAtZero: true, 
          title: { display: true, text: 'Quantidade de Produtos' } 
        },
        x: { title: { display: true, text: 'Armazéns' } }
      }
    }
  });
</script>

<!-- Script para gerar o gráfico de Produtos em Estoque -->
<script>
  var productLabels = {!! json_encode($estoquePorProduto->keys()) !!};
  var productData = {!! json_encode($estoquePorProduto->values()) !!};
  var productColors = productData.map(quantity => 
    quantity < 50 ? 'rgba(255, 99, 132, 1)' : 
    quantity < 100 ? 'rgba(255, 206, 86, 1)' : 
    'rgba(75, 192, 192, 1)'
  );

  new Chart(document.getElementById('productsChart').getContext('2d'), {
    type: 'bar',
    data: {
      labels: productLabels,
      datasets: [{
        label: 'Quantidade em Estoque',
        data: productData,
        backgroundColor: productColors,
        borderWidth: 1
      }]
    },
    options: {
      scales: { y: { beginAtZero: true } }
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
