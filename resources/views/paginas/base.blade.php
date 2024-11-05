<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel Administrativo</title>

    <!-- Inclui estilos Bootstrap e AdminLTE -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

    <!-- Script JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Script para preenchimento automático de endereço pelo CEP -->
    <script>
        $(document).ready(function() {
            function limpa_formulário_cep() {
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }

            $("#cep").blur(function() {
                var cep = $(this).val().replace(/\D/g, '');
                if (cep !== "") {
                    var validacep = /^[0-9]{8}$/;
                    if (validacep.test(cep)) {
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } else {
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } else {
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } else {
                    limpa_formulário_cep();
                }
            });
        });
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Menu lateral fixo -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; top: 0; bottom: 0; left: 0; width: 250px; z-index: 1000;">
    <a href="{{ route('homeAdmin') }}" class="brand-link">
      <span class="brand-text font-weight-light">Painel do Administrador</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
              <li class="nav-item">
                <a href="{{ route('ListagemMovimentacao') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listagem de Movimentações</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ConsultaEstoque') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consulta de Estoque</p>
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

  <!-- Conteúdo principal ao lado do menu lateral -->
  <div class="content-wrapper" style="margin-left: 250px;">
    <section class="content pt-3">
      @yield('content')
    </section>
  </div>

  <!-- Rodapé ao final do conteúdo principal -->
  <footer class="main-footer text-center" style="margin-left: 250px;">
    <strong>Gestão de estoque frigorífico.</strong> Todos os direitos reservados.
  </footer>

</div>

<!-- Scripts Necessários -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

</body>
</html>
