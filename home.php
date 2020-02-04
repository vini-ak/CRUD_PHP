<?php
	
	# Iniciando a sessão do PHP
	session_start();

	if(!isset($_SESSION['autenticado']) || $_SESSION != 'SIM') {
		header("Location: index.php?login=erro_autenticacao");
	}
	require_once('navbar.html');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Página Inicial</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
	<h1 class="text-success" style="padding-top: 200px; padding-left: 50px">Conseguimos entrar na Home!</h1>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>