@extends('paginas.base') <!-- Mantém sua base existente -->

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 10px; padding: 20px; flex-grow: 1;">
    <h1 class="mt-5">Usuários Cadastrados</h1>
    <br>

    <table class="table table-bordered table-striped mt-3">
      <thead style="background-color: #6c757d; color: #f8f9fa;"> <!-- Cor mais suave -->
        <tr>
          <th>ID</th>
          <th>Nome completo</th>
          <th>CPF</th>
          <th>E-mail</th>
          <th>Data de nascimento</th>
          <th>Tipo de Usuário</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->cpf }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->data_nascimento }}</td>
            <td>{{ $user->role === 'admin' ? 'Administrador' : 'Usuário Comum' }}</td>
            <td>
              <div class="d-flex" style="gap: 10px;"> <!-- Maior espaçamento entre os botões -->
                <a href="{{ route('editar.usuario', ['id' => $user->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>
                <form action="{{ route('deletar.usuario', ['id' => $user->id]) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Excluir</button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <a href="{{ route('cadastro/user') }}" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar novo usuário</a>
  </div>
</div>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
