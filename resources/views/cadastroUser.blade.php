@extends('paginas.base') <!-- Mantém sua base existente -->
@extends('paginas.nav') <!-- Inclui a sidebar existente -->

@section('content')
<div class="wrapper" style="display: flex;">

  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
    <h1>Adicionar um novo usuário</h1>
    <br>

    <!-- Exibe erros gerais de validação -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cadastrando/user') }}" method="POST">
      @csrf
      <div>
        <div class="mb-3">
          <label for="name" class="form-label">Nome</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Coloque seu nome completo" required value="{{ old('name') }}">
          @error('name')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="cpf" class="form-label">CPF</label>
          <input type="text" class="form-control" name="cpf" required id="cpf" placeholder="Coloque seu CPF" value="{{ old('cpf') }}">
          @error('cpf')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Coloque seu e-mail" required value="{{ old('email') }}">
          @error('email')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="data_nascimento" class="form-label">Data de Nascimento</label>
          <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" required value="{{ old('data_nascimento') }}">
          @error('data_nascimento')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Defina sua senha" required>
          @error('password')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <!-- Campo para definir o papel do usuário -->
        <div class="mb-3">
          <label for="role" class="form-label">Tipo de Usuário</label>
          <select class="form-control" name="role" id="role" required>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário Comum</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
          </select>
          @error('role')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit" class="btn btn-dark">Salvar</button>
      </div>
    </form>
  </div>
</div>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
