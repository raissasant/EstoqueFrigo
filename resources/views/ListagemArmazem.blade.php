@extends('paginas.base')

@extends('paginas.navUser')

@section('content')



<h1>Armazéns cadastrados</h1>

    <table class="table mt-3">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Capacidade total</th>
            <th>Espaço disponível</th>
            <th>Status</th>
            <th>Editar ou Excluir</th>
        </tr>

        @foreach($armazens as $armazem)
            <tr>
                <td>{{ $armazem->id }}</td>
                <td>{{ $armazem->name }}</td>
                <td>{{ $armazem->capacidade_total }}</td>
                <td>{{ $armazem->espaco_disponivel}}</td>
                <td class="badge {{ $armazem->status === 'inativo' ? 'bg-danger' : 'bg-success' }}">
                    {{ ucfirst($armazem->status) }}
                </td>
                <td>
                    <a href="{{ route('editArmazem', ['id' => $armazem->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                     <form action="{{ route('deleteArmazem', ['id' => $armazem->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este armazém?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
                </td>
            </tr>
        @endforeach
    </table>


<a href="{{ route('cadastroArmazem') }}" class="btn btn-dark"><i class="fas fa-plus"></i> Cadastrar novo armazém</a>

@endsection
