<!DOCTYPE html>
<html>
<head>
    <title>Solicitação de Nova Senha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Solicitar Nova Senha</h1>

        <!-- Exibe mensagem de sucesso após envio do formulário -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Exibe erros de validação, se houver -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário para solicitar nova senha -->
        <form method="POST" action="{{ route('enviandoSenha') }}">
            @csrf  <!-- Token CSRF para segurança -->
            
            <!-- Campo para inserir o e-mail -->
            <div class="form-group">
                <label for="email">Seu E-mail</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu e-mail" required>
            </div>

            <!-- Campo para inserir a mensagem -->
            <div class="form-group">
                <label for="mensagem">Mensagem</label>
                <textarea name="mensagem" id="mensagem" class="form-control" rows="4" placeholder="Digite sua mensagem" required></textarea>
            </div>

            <!-- Botão de submissão -->
            <button type="submit" class="btn btn-primary">Enviar Solicitação</button>
        </form>
    </div>

    <!-- Bootstrap JS, Popper.js e jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
