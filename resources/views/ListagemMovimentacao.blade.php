@extends('paginas.base')
@extends('paginas.nav')

@section('content')

<br>
<div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
    <h1>Lista de Movimentações</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Botão de download do relatório completo em verde e tamanho compacto -->
    <button class="btn btn-success btn-sm mb-3" id="downloadPdf">
        <i class="fas fa-download"></i> Baixar Relatório Completo
    </button>

    <div id="pdf-content">
        <table class="table table-bordered table-striped mt-3" style="width: 100%; font-size: 0.9em;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Tipo de Movimentação</th>
                    <th>Quantidade</th>
                    <th>Código do Produto</th>
                    <th>Armazém de Origem</th>
                    <th>Armazém de Destino</th>
                    <th>Código de Entrada</th>
                    <th>Código de Saída</th>
                    <th>Código de Pedido</th>
                    <th>Data da Movimentação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movimentacoes as $movimentacao)
                    <tr id="movimentacao-{{ $movimentacao->id }}">
                        <td>{{ $movimentacao->id }}</td>
                        <td>{{ $movimentacao->name_user }}</td>
                        <td>{{ $movimentacao->tipo_mov }}</td>
                        <td>{{ $movimentacao->quantidade_mov }}</td>
                        <td>{{ $movimentacao->codigo_produto }}</td>
                        <td>{{ $movimentacao->armazem_origem }}</td>
                        <td>{{ $movimentacao->armazem_destino }}</td>
                        <td>{{ $movimentacao->codigo_entrada }}</td>
                        <td>{{ $movimentacao->codigo_saida }}</td>
                        <td>{{ $movimentacao->codigo_pedido }}</td>
                        <td>{{ $movimentacao->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('editMovimentacao', ['id' => $movimentacao->id]) }}" class="btn btn-primary btn-sm mb-1" style="min-width: 80px;">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('deleteMovimentacao', ['id' => $movimentacao->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar esta movimentação?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="min-width: 80px; margin-top: 5px;">
                                    <i class="fas fa-trash"></i> Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Script para download do relatório completo em PDF -->
    <script>
        document.getElementById('downloadPdf').addEventListener('click', function() {
            const pdfTable = document.querySelector('#pdf-content').cloneNode(true);
            pdfTable.querySelectorAll('td:last-child, th:last-child').forEach(cell => cell.remove()); // Remove a coluna de ações

            const element = document.createElement('div');
            element.innerHTML = `<h2 style="text-align: center;">Relatório Completo de Movimentações</h2>` + pdfTable.outerHTML;

            const options = {
                margin: [0.5, 0.5, 0.5, 0.5],
                filename: 'relatorio_completo_movimentacoes.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true, logging: true, scrollX: 0, scrollY: 0 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
            };

            html2pdf().from(element).set(options).save();
        });
    </script>
</div>
@endsection
