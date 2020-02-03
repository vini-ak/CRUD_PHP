<?php
	$usuarios = array(
		['email' => "vinicius.vdes@gmail.com", 'senha' => "aleatoria1"],
		['email' => "kyotoloja@gmail.com", 'senha' => "aleatoria2"],
		['email' => "rikardo_cavaleiro@gmail.com", 'senha' => "aleatoria3"]
	);

	$autenticado = false;

	foreach ($usuarios as $usuario) {
		if($_POST['email'] == $usuario['email'] && $_POST['senha'] == $usuario['senha']){
			$autenticado = true;
			break;
		}
	}

	if($autenticado) {
		echo "Usuário autenticado";
	} else {
		echo "Fudeu.";
	}
?>