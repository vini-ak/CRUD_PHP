<?php
	
	# Iniciando a sessão do PHP...
	session_start();


	$usuarios = array(
		['email' => "vinicius.vdes@gmail.com", 'senha' => "aleatoria1"],
		['email' => "kyotoloja@gmail.com", 'senha' => "aleatoria2"],
		['email' => "rikardo_cavaleiro@gmail.com", 'senha' => "aleatoria3"]
	);

	$usuario_autenticado = false; # Variável de autenticação

	foreach ($usuarios as $usuario) {
		if($_POST['email'] == $usuario['email'] && $_POST['senha'] == $usuario['senha']){
			$usuario_autenticado = true;
			break;
		}
	}

	if($usuario_autenticado) {
		header("Location: home.php");
		$_SESSION['autenticado'] = 'SIM';
	} else {
		header("Location: index.php?login=usuario_senha");
		$_SESSION['autenticado'] = 'NAO';
	}
?>