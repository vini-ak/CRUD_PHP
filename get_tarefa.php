<?php
	session_start();

	// Verificando se o usuário está autenticado. Caso não esteja, será redirecionado à index.php
	if((!isset($_SESSION['autenticado'])) || $_SESSION['autenticado'] != "SIM") {
		header("Location: index.php?login=erro_autenticacao");
	}

	
	$conn = new PDO('mysql:host=localhost;dbname=kyoto', 'root', '');

	$query = "SELECT * FROM tb_tarefas WHERE id_tarefa = :id";
	
	$stm = $conn->prepare($query);
	$stm->bindValue(':id', $_GET['id']);

	$stm->execute();

	$item = $stm->fetch(PDO::FETCH_ASSOC);
	echo json_encode($item);
?>