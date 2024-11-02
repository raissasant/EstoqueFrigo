@extends('paginas.base') <!-- Mantém sua base existente -->
<<<<<<< HEAD

=======
@extends('paginas.nav') <!-- Inclui a sidebar existente -->
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
<<<<<<< HEAD
  <div class="content" style="margin-left: 220px; padding: 20px; flex-grow: 1;">
=======
  <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
    <h1 class="mt-5">Lista de usuários</h1>
                
    <br>

    <table class="table table-bordered table-striped mt-3">
      <thead class="thead-dark">
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
              <a href="{{ route('editar.usuario', ['id' => $user->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
              <form action="{{ route('deletar.usuario', ['id' => $user->id]) }}" method="DELETE" style="display:inline;">
                @csrf
                @method('DELETE') <!-- Adiciona o método DELETE -->
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
              </form>
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
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
