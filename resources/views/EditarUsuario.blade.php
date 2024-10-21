@extends('paginas.base')

@extends('paginas.nav')

@section('content')
    <br>

    <div class="container">
        <h1>Editar e atualizar usuário</h1>
        <form action="{{ route('atualizar.usuario', $user->id) }}" method="POST">
            @method('PUT') <!-- Método PUT para atualização -->
            @csrf <!-- Proteção contra CSRF -->
            
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
            </div>
            
            <div class="form-group">
                <label for="data_nascimento">Data de nascimento</label>
                <input type="text" class="form-control" name="data_nascimento" id="data_nascimento"
                value="{{ \Carbon\Carbon::parse($user->data_nascimento)->format('d/m/Y') }}">
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Deixe em branco para manter a mesma senha">
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Atualizar dados do usuário </button>
        </form>
    </div>
@endsection
