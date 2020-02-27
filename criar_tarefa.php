<?php
	session_start();

	// Verificando se o usuário está autenticado. Caso não esteja, será redirecionado à index.php
	if((!isset($_SESSION['autenticado'])) || $_SESSION['autenticado'] != "SIM") {
		header("Location: index.php?login=erro_autenticacao");
	}

	
	try {
		$conexao = new PDO('mysql:host=localhost;dbname=kyoto', 'root', '');

		$query = 'INSERT INTO tb_tarefas(id_user, titulo, descricao, data_hora)';
		$query .= "VALUES(:usuario, :titulo, :descricao, :data_hora)";

		$stm = $conexao->prepare($query);

		$stm->bindValue(':usuario', $_SESSION['id_user']);
		$stm->bindValue(':titulo', $_GET['titulo']);
		$stm->bindValue(':descricao', $_GET['descricao']);

		$data_hora = $_GET['ano'].'/'.$_GET['mes'].'/'.$_GET['dia'].' '.$_GET['horas'].':'.$_GET['minutos'].':00';
		$stm->bindValue(':data_hora', $data_hora);

		$stm->execute();

		$usuario_autenticado = true;

	} catch (Exception $e){
		$usuario_autenticado = false;
	}

	header("Location: home.php");
?>