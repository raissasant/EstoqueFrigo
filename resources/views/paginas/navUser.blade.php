<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Painel do usuário</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Link para o Início -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('user.dashboard') }}">Início</a>
        </li>

        <!-- Menu de Produtos -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Produtos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('cadastroProduto') }}">Inserir um novo produto</a></li>
            <li><a class="dropdown-item" href="{{ route('ListagemProduto') }}">Listagem de produtos</a></li>
          </ul>
        </li>

        <!-- Menu de Armazéns -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gerenciar armazém
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('cadastroArmazem') }}">Inserir novo armazém</a></li>
            <li><a class="dropdown-item" href="{{ route('ListagemArmazem') }}">Gerenciar movimentação</a></li>
          </ul>
        </li>
      </ul>

      <!-- Botão de Logout -->
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-primary" type="submit">Sair</button>
      </form>
    </div>
  </div>
</nav>
