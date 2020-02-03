<?php
	$usuarios = array(
		['email' => "vinicius.vdes@gmail.com", 'senha' => "aleatoria1"],
		['email' => "kyotoloja@gmail.com", 'senha' => "aleatoria2"],
		['email' => "rikardo_cavaleiro@gmail.com", 'senha' => "aleatoria3"]
	);

	$autenticado = false; # Variável de autenticação

	foreach ($usuarios as $usuario) {
		if($_POST['email'] == $usuario['email'] && $_POST['senha'] == $usuario['senha']){
			$autenticado = true;
			break;
		}
	}

	if($autenticado) {
		header("Location: home.php");
	} else {
		header("Location: index.php?login=erro");
	}
?>