

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; top: 0; bottom: 0; left: 0; z-index: 99; width: 200px; box-shadow: none;">
  <!-- Brand Logo -->
  <a href="{{ route('homeAdmin') }}" class="brand-link">
    <span class="brand-text font-weight-light">Painel do Administrador</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Início -->
        <li class="nav-item">
          <a href="{{ route('homeAdmin') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Início</p>
          </a>
        </li>

        <!-- Usuários -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Usuários<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('cadastro/user') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Adicionar um novo usuário</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('listagem/user') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Usuários cadastrados</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Fornecedores -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
            <p>Fornecedores<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('indexFornecedor') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Adicionar um novo fornecedor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('listagemFornecedor') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Fornecedores cadastrados</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Produtos -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>Produtos<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('cadastroProduto') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Adicionar um novo produto</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('ListagemProduto') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Produtos cadastrados</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Armazéns -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>Armazéns<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('cadastroArmazem') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Adicionar um novo armazém</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('ListagemArmazem') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Armazéns cadastrados</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Botão de Logout -->
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger w-100" type="submit">
              <i class="fas fa-sign-out-alt"></i> Sair
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>
