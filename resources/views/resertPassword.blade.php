<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Solicitar nova senha</title>
</head>
<body>
	<h1>Solicitar nova senha</h1>
  <form action="{{ route('enviandoSenha') }}" method="POST">
  @csrf
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Nome completo</label>
  <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="Nome completo">
</div>
<br>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Mensagem</label>
  <textarea class="form-control" name = "mensagem" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<button  type="submit" class="btn btn-dark">Enviar</button>



</body>
</html>