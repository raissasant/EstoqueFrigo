@extends('paginas.base') <!-- Mantém sua base existente -->

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 10px; padding: 20px; flex-grow: 1;">
    <h1>Editar Usuário: {{ $user->name }}</h1>
    <br>

    <form action="{{ route('atualizar.usuario', ['id' => $user->id]) }}" method="POST">
      @csrf
      <div>
        <div class="mb-3">
          <label for="name" class="form-label">Nome</label>
          <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" placeholder="Coloque seu nome completo" required>
        </div>

        <div class="mb-3">
          <label for="cpf" class="form-label">CPF</label>
          <input type="text" class="form-control" name="cpf" id="cpf" value="{{ old('cpf', $user->cpf) }}" placeholder="Coloque seu CPF" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="Coloque seu e-mail" required>
        </div>

        <div class="mb-3">
          <label for="data_nascimento" class="form-label">Data de Nascimento</label>
          <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento', $user->data_nascimento) }}" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Defina sua senha (deixe em branco para não alterar)">
        </div>

        <!-- Campo para definir se o usuário é Administrador ou Usuário Comum -->
        <div class="mb-3">
          <label for="role" class="form-label">Tipo de Usuário</label>
          <select class="form-control" name="role" id="role" required>
            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuário Comum</option>
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
          </select>
        </div>

        <button type="submit" class="btn btn-dark">Salvar</button>
      </div>
    </form>
  </div>
</div>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
