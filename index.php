<?php
	# Importando a navbar
	require_once('navbar.html');
	session_start();

	if(isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == 'SIM') {
		header('Location: home.php');
	}
?>

<!DOCTYPE html>
<!-- NAVBAR da aplicação -->
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	</head>
	<body style="font-family: Courier New">
		<!-- Formulário -->
		<form action="valida_login.php" method="post" style="padding-top: 200px; padding-left: 50px">
		  <!-- Email -->
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Insira seu Email..." name="email" style="width: 500px">
		  </div>

		  <!-- Senha -->
		  <div class="form-group">
		    <label for="exampleInputPassword1">Senha</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Digite sua senha..." name="senha" style="width: 500px">
		  </div>


		  <!-- Apresentação de mensagens de erro. -->
		  <?php
			if(isset($_GET['login'])){
			  # Verificação de validez de usuário
		  	  if($_GET['login'] == 'usuario_senha') {
		  ?>
				<p class="text-danger">Email ou senha inválidos.</p>
		  <?php
		  	  # Proteção de rotas
		  	  } else if($_GET['login'] == 'erro_autenticacao') {  		
		  ?>
		  		<p class="text-info">Problema de autenticação. Faça login novamente.</p>
		  <?php
			  }
			}
		  ?>

		  <button type="submit" class="btn btn-success mt-5">Login</button>
		</form>




		<!-- BOOTSTRAP JS -->

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>