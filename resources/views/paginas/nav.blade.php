<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Painel do Administrador</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{  route('homeAdmin') }}">Início</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Usuários
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('cadastro/user') }}">Adicionar um novo usuário</a></li>
            <li><a class="dropdown-item" href="{{ route('listagem/user') }}">Usuários cadastrados</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gerenciar Fornecedores
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('indexFornecedor') }}">Adicionar um novo fornecedor</a></li>
            <li><a class="dropdown-item" href="{{ route('listagemFornecedor')}}">Fornecedores cadastrados</a></li>
          </ul>
        </li>        
      </ul>       

      <!-- Adicionando o formulário de logout -->
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-primary" type="submit">Sair</button>
      </form>
    </div>
  </div>
</nav>
