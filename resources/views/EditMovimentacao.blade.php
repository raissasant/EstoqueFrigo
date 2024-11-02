@extends('paginas.base')
@extends('paginas.nav')

@section('content')
<div class="wrapper" style="display: flex;">
  <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
    <h1>Editar movimentação</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('atualizandoMovimentacao', $movimentacao->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" name="quantidade" id="quantidade" value="{{ $movimentacao->quantidade_mov }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo_mov" class="form-label">Tipo de Movimentação</label>
            <select class="form-control" name="tipo_mov" id="tipo_mov" required>
                <option value="Entrada" {{ $movimentacao->tipo_mov == 'Entrada' ? 'selected' : '' }}>Entrada</option>
                <option value="Saida" {{ $movimentacao->tipo_mov == 'Saida' ? 'selected' : '' }}>Saída</option>
                <option value="Transferencia" {{ $movimentacao->tipo_mov == 'Transferencia' ? 'selected' : '' }}>Transferência</option>
            </select>
        </div>

        <div class="mb-3" id="armazemOrigemContainer" style="display: none;">
            <label for="armazem_origem" class="form-label">Armazém de Origem</label>
            <select class="form-control" name="armazem_origem" id="armazem_origem">
                <option value="">Selecione</option>
                @foreach($armazens as $armazem)
                    <option value="{{ $armazem->name }}" {{ $armazem->name == $movimentacao->armazem_origem ? 'selected' : '' }}>{{ $armazem->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3" id="armazemDestinoContainer" style="display: none;">
            <label for="armazem_destino" class="form-label">Armazém Destino</label>
            <select class="form-control" name="armazem_destino" id="armazem_destino">
                <option value="">Selecione</option>
                @foreach($armazens as $armazem)
                    <option value="{{ $armazem->name }}" {{ $armazem->name == $movimentacao->armazem_destino ? 'selected' : '' }}>{{ $armazem->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="codigo_entrada" class="form-label">Código de Entrada</label>
            <input type="text" class="form-control" name="codigo_entrada" id="codigo_entrada" value="{{ $movimentacao->codigo_entrada }}">
        </div>

        <div class="mb-3">
            <label for="codigo_saida" class="form-label">Código de Saída</label>
            <input type="text" class="form-control" name="codigo_saida" id="codigo_saida" value="{{ $movimentacao->codigo_saida }}">
        </div>

        <div class="mb-3">
            <label for="codigo_pedido" class="form-label">Código do Pedido</label>
            <input type="text" class="form-control" name="codigo_pedido" id="codigo_pedido" value="{{ $movimentacao->codigo_pedido }}">
        </div>

        <button type="submit" class="btn btn-success">Atualizar Movimentação</button>
        <a href="{{ route('ListagemMovimentacao') }}" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</div>

<script>
    document.getElementById('tipo_mov').addEventListener('change', function() {
        const tipo = this.value;
        const armazemOrigemContainer = document.getElementById('armazemOrigemContainer');
        const armazemDestinoContainer = document.getElementById('armazemDestinoContainer');
        
        if (tipo === 'Transferencia') {
            armazemOrigemContainer.style.display = 'block';
            armazemDestinoContainer.style.display = 'block';
        } else if (tipo === 'Entrada') {
            armazemOrigemContainer.style.display = 'none';
            armazemDestinoContainer.style.display = 'block';
        } else if (tipo === 'Saida') {
            armazemOrigemContainer.style.display = 'block';
            armazemDestinoContainer.style.display = 'none';
        } else {
            armazemOrigemContainer.style.display = 'none';
            armazemDestinoContainer.style.display = 'none';
        }
    });

    document.getElementById('tipo_mov').dispatchEvent(new Event('change'));
</script>
@endsection
