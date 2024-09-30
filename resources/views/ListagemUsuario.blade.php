@extends('paginas.base')

@extends('paginas.nav')

@section('content')

<body>
	<div class="container">
        <h1 class="mt-5">Lista de usuários</h1>

        <br>
        <br>

        <table class="table mt-3">
    <tr>
        <th>ID</th>
        <th>Nome completo</th>
        <th>E-mail</th>
        <th>Data de nascimento</th>
        <th>Editar ou excluir</th>
    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ \Carbon\Carbon::parse($user->data_nascimento)->format('d/m/Y') }}</td> <!-- Formata a data para dd/mm/yyyy -->


            <td>
                <a href="{{ route('editar.usuario', ['id' => $user->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                <a href="{{ route('deletar.usuario', ['id' => $user->id]) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</a>
            </td>
        </tr>
    @endforeach
</table>

               <a href= "{{route('cadastro/user')}}" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar novo usuário</a>
          </body>
</html>

@endsection
