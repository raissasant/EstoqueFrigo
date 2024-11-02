@extends('paginas.base')
@extends('paginas.nav')

@section('content')

<div class="wrapper" style="display: flex;">
  <!-- Conteúdo Principal -->
  <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1;">
    <h1>Armazéns cadastrados</h1>

    <table class="table table-hover mt-3">
      <thead style="background-color: #e9ecef;"> <!-- Cabeçalho com um cinza claro -->
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Cidade</th> <!-- Nova coluna para a cidade -->
          <th>Capacidade total</th>
          <th>Espaço disponível</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($armazens as $armazem)
          <tr>
            <td>{{ $armazem->id }}</td>
            <td>{{ $armazem->name }}</td>
            <td>{{ $armazem->cidade }}</td> <!-- Exibindo o campo cidade -->
            <td>{{ $armazem->capacidade_total }}</td>
            <td>{{ $armazem->espaco_disponivel }}</td>
            <td>
              <span class="badge {{ $armazem->status === 'inativo' ? 'bg-danger' : 'bg-success' }} p-2">
                {{ ucfirst($armazem->status) }}
              </span>
            </td>
            <td>
              <div style="display: flex; gap: 8px; align-items: center;"> <!-- Mantém ambos os botões alinhados horizontalmente -->
                <a href="{{ route('editArmazem', ['id' => $armazem->id]) }}" class="btn btn-primary btn-sm" style="height: 100%;">
                  <i class="fas fa-edit"></i> Editar
                </a>
                <form action="{{ route('deleteArmazem', ['id' => $armazem->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este armazém?');" style="margin: 0;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" style="height: 100%;">
                    <i class="fas fa-trash-alt"></i> Excluir
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <a href="{{ route('cadastroArmazem') }}" class="btn btn-dark btn-sm">
      <i class="fas fa-plus"></i> Cadastrar novo armazém
    </a>
  </div>
</div>

<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 49c95c28e4adee3a8cb2153f6bbd8ebe8fe9fecf
