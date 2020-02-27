<?php
	
	# Iniciando a sessão do PHP...
	session_start();

	// Verificando se o usuário está autenticado. Caso não esteja, será redirecionado à index.php
	if((!isset($_SESSION['autenticado'])) || $_SESSION['autenticado'] != "SIM") {
		header("Location: index.php?login=erro_autenticacao");
	}

	
	$conexao = new PDO('mysql:host=localhost;dbname=kyoto', 'root', '');

	try {
		$query = 'SELECT id_user FROM tb_usuarios WHERE ';
		$query .= "email = :email ";
		$query .= "AND senha = :senha ";

		$stm = $conexao->prepare($query);

		$stm->bindValue(':email', $_POST['email']);
		$stm->bindValue(':senha', $_POST['senha']);

		$stm->execute();

		$_SESSION['id_user'] = $stm->fetchAll(PDO::FETCH_ASSOC)[0]['id_user'];

		if($_SESSION['id_user'] != []) {
			$usuario_autenticado = true;
		} else {
			$usuario_autenticado = false;
		}

	} catch (Exception $e){
		$usuario_autenticado = false;
	}

	if($usuario_autenticado) {
		$_SESSION['autenticado'] = 'SIM';
		header("Location: home.php");
	} else {
		$_SESSION['autenticado'] = 'NAO';
		header("Location: index.php?login=usuario_senha");
	}
?>