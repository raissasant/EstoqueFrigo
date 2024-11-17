@extends('paginas.base')

@section('content')
<div class="wrapper d-flex justify-content-center">
  <div class="content" style="padding: 0px; width: 100%; max-width: 1200px;">
    <h1 class="text-center mb-4">Listagem de Produtos</h1>

    <!-- Formulário de Busca -->
    <form action="{{ route('SearchProduto') }}" method="GET" class="mb-4">
      @csrf
      <div class="input-group">
        <input type="text" class="form-control" name="search" id="search" placeholder="Buscar por nome ou código do produto">
        <button type="submit" class="btn btn-primary">Buscar</button>
      </div>
    </form>

    <!-- Mensagem de Alerta -->
    @if(isset($message))
      <div class="alert alert-warning mt-3">
        {{ $message }}
      </div>
    @endif

    <!-- Mensagens de Erro -->
    @if($errors->any())
      <div class="alert alert-danger mt-3">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Tabela de Produtos -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped text-center mt-3">
        <thead style="background-color: #d0e9d6; color: #333;">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Código</th>
            <th>Categoria</th>
            <th>SKU</th>
            <th>Compra (R$)</th>
            <th>Venda (R$)</th>
            <th>Estoque</th>
            <th>Validade</th>
            <th>Armazém</th>
            <th>Fornecedores</th>
            <th>QR Code</th>
            <th style="min-width: 120px;">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($produtos as $produto)
            <tr>
              <td>{{ $produto->id }}</td>
              <td>{{ $produto->name }}</td>
              <td>{{ Str::limit($produto->descricao, 30) }}</td>
              <td>{{ $produto->codigo_produto }}</td>
              <td>{{ $produto->categoria }}</td>
              <td>{{ $produto->sku }}</td>
              <td>{{ number_format($produto->valor_compra, 2, ',', '.') }}</td>
              <td>{{ number_format($produto->valor_venda, 2, ',', '.') }}</td>
              <td>{{ $produto->quantidade }}</td>
              <td>{{ $produto->data_validade ? \Carbon\Carbon::parse($produto->data_validade)->format('d/m/Y') : 'N/A' }}</td>
              <td>{{ $produto->armazens->isNotEmpty() ? $produto->armazens->first()->name : 'Agro' }}</td>
              <td>
                @foreach($produto->fornecedores as $fornecedor)
                  <span>{{ $fornecedor->name }}</span><br>
                @endforeach
              </td>
              <td>
                <div id="qrcode-{{ $produto->id }}"></div>
              </td>
              <td>
                <div class="d-flex flex-column gap-1">
                  <a href="{{ route('TelaMovimentacao', ['id' => $produto->id]) }}" class="btn btn-info btn-sm thin-action mb-1">
                    <i class="fas fa-exchange-alt"></i> Movimentar
                  </a>
                  <a href="{{ route('editProduto', ['id' => $produto->id]) }}" class="btn btn-primary btn-sm thin-action mb-1">
                    <i class="fas fa-edit"></i> Editar
                  </a>
                  <form action="{{ route('deleteProduto', ['id' => $produto->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este produto?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm thin-action"><i class="fas fa-trash"></i> Deletar</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Botão para Cadastrar Produto -->
    <div class="mt-4 text-end">
      <a href="{{ route('cadastroProduto') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Cadastrar Produto
      </a>
    </div>
  </div>
</div>

<!-- Biblioteca QR Code -->
<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    @foreach ($produtos as $produto)
        var armazemName = "{{ $produto->armazens->isNotEmpty() ? $produto->armazens->first()->name : 'Agro' }}";

        // Texto do QR Code
        var qrContent = `Produto: {{ $produto->name }} | Qtd: {{ $produto->quantidade }} | Val: {{ $produto->data_validade ? \Carbon\Carbon::parse($produto->data_validade)->format('d/m/Y') : 'N/A' }} | Armazém: ${armazemName}`;

        console.log('QR Content:', qrContent);

        var qrcodeElement = document.getElementById("qrcode-{{ $produto->id }}");

        if (qrcodeElement) {
            qrcodeElement.innerHTML = ""; // Limpa o QR Code existente
            new QRCode(qrcodeElement, {
                text: qrContent, // Insere o texto diretamente
                width: 150,      // Tamanho do QR Code
                height: 150,     // Tamanho do QR Code
                correctLevel: QRCode.CorrectLevel.L // Correção mínima
            });
        }
    @endforeach
});
</script>

<!-- Estilos Personalizados -->
<style>
    .table-responsive {
        overflow-x: auto;
    }
    .content h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    .table th, .table td {
        vertical-align: middle;
        font-size: 0.9em;
        padding: 8px;
    }
    .table th {
        background-color: #d0e9d6;
        color: #333;
    }
    .btn-sm.thin-action {
        padding: 3px 6px;
        font-size: 0.75em;
        width: 100%;
    }
</style>
@endsection
