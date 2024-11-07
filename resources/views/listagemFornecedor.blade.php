@extends('paginas.base')

@section('content')
<div class="wrapper" style="display: flex;">
  <div class="content" style="margin-left: 10px; padding: 20px; flex-grow: 1;">
    
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
        <button type="submit" class="btn btn-primary btn-custom">Buscar</button>
    </form>

    <h1 class="mt-5">Fornecedores cadastrados</h1>

    @if(!isset($fornecedores) || $fornecedores->isEmpty())
        <p>Nenhum fornecedor encontrado.</p>
    @else
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
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
                            <!-- Contêiner flexível para alinhar os botões lado a lado -->
                            <div style="display: flex; gap: 5px;">
                                <a href="{{ route('EditFornecedor', ['id' => $fornecedor->id]) }}" class="btn btn-primary btn-sm" style="padding: 4px 8px; font-size: 0.875rem;">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('deleteFornecedor', ['id' => $fornecedor->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="padding: 4px 8px; font-size: 0.875rem;" onclick="return confirm('Tem certeza que deseja excluir?');">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('indexFornecedor') }}" class="btn btn-dark btn-custom"><i class="fas fa-plus"></i> Cadastrar novo fornecedor</a>
  </div>
</div>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection
