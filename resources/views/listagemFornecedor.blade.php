@extends('paginas.base')

@extends('paginas.nav')

@section('content')

<form action="{{ route('searchFornecedores') }}" method="GET">
    @csrf
     <div class="mb-3">
        <label for="search">Buscar Fornecedores</label>
        <input type="text" class="form-control" name="search" id="search" placeholder="Digite o nome ou CNPJ">
    </div>
    <h5> Ou procure por</h5>
    <div class="mb-3">
        <label for="status">Status</label>
        <select class="form-control" name="status" id="status">
            <option value="">Todos</option>
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<h1>Fornecedores cadastrados</h1>

@if(isset($fornecedores) && $fornecedores->isEmpty())
    <p>Nenhum fornecedor encontrado.</p>
@else
    <table class="table mt-3">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Status</th>
            <th>Editar ou Excluir</th>
        </tr>
        @foreach($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->id }}</td>
                <td>{{ $fornecedor->name }}</td>
                <td>{{ $fornecedor->cnpj }}</td>
                <td>{{ $fornecedor->cpf }}</td>
                <td>{{ $fornecedor->telefone }}</td>
                <td>{{ $fornecedor->email }}</td>
                <td class="badge {{ $fornecedor->status === 'inativo' ? 'bg-danger' : 'bg-success' }}">
                    {{ ucfirst($fornecedor->status) }}
                </td>
                <td>
                    <a href="{{ route('EditFornecedor', ['id' => $fornecedor->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                    <a href="{{ route('DeleteFornecedor', ['id' => $fornecedor->id]) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</a>
                </td>
            </tr>
        @endforeach
    </table>
@endif

<a href="{{ route('indexFornecedor') }}" class="btn btn-dark"><i class="fas fa-plus"></i> Cadastrar novo fornecedor</a>

@endsection
