<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistema de Controle</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);
        .btn { display: inline-block; padding: 4px 10px; font-size: 13px; line-height: 18px; color: #333333; text-align: center; background-color: #f5f5f5; border: 1px solid #e6e6e6; border-radius: 4px; box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); cursor: pointer; }
        .btn:hover { background-color: #e6e6e6; }
        .btn-primary { background-color: #4a77d4; border: 1px solid #3762bc; color: #ffffff; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); }
        .btn-primary:hover { background-color: #4a77d4; }
        .btn-block { width: 100%; display:block; }

        * { box-sizing: border-box; }

        html, body { width: 100%; height:100%; overflow:hidden; font-family: 'Open Sans', sans-serif; background: #092756; }

        body { 
            background: radial-gradient(ellipse at 0% 100%, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), 
                        linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), 
                        linear-gradient(135deg,  #670d10 0%, #092756 100%);
        }

        .login { 
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -150px 0 0 -150px;
            width:300px;
            height:300px;
        }

        .login h1 { 
            color: #fff; 
            text-shadow: 0 0 10px rgba(0,0,0,0.3); 
            letter-spacing:1px; 
            text-align:center; 
        }

        input { 
            width: 100%; 
            margin-bottom: 10px; 
            background: rgba(0,0,0,0.3);
            border: none;
            outline: none;
            padding: 10px;
            font-size: 13px;
            color: #fff;
            text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
            border: 1px solid rgba(0,0,0,0.3);
            border-radius: 4px;
            box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
            transition: box-shadow .5s ease;
        }

        input:focus { 
            box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); 
        }

        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: white;
        }
    </style>
</head>

<body>

<div class="login">
    <h1>Login</h1>
    
    <!-- Formulário de login -->
    <form action="{{ route('logando') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="E-mail" required="required" />
        <input type="password" name="password" placeholder="Senha" required="required" />
        
        <button type="submit" class="btn btn-primary btn-block btn-large">Entrar</button>

        <!-- Link para recuperação de senha -->
        <a href="{{ route('senha') }}" class="forgot-password">Esqueci minha senha</a>
    </form>

    <!-- Mensagens de erro -->
    @if($errors->any())
        <div class="alert alert-danger" style="color: white; margin-top: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

</body>
</html>