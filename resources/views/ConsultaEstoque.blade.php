@extends('paginas.base')
@extends('paginas.nav')

@section('content')
<div class="container" style="margin-left: 250px; padding: 20px; max-width: 800px;">
    <h1>Consulta de Estoque</h1>

    @if($estoques->isEmpty())
        <div class="alert alert-info">Nenhum dado de estoque encontrado.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Armazém</th>
                    <th>Produto</th>
                    <th>Quantidade Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estoques as $estoque)
                    <tr>
                        <td>{{ $estoque->armazem }}</td>
                        <td>{{ $estoque->produto }}</td>
                        <td>{{ $estoque->quantidade_total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
