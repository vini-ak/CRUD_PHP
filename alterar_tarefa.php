<?php
	session_start();

	// Verificando se o usuário está autenticado. Caso não esteja, será redirecionado à index.php
	if((!isset($_SESSION['autenticado'])) || $_SESSION['autenticado'] != "SIM") {
		header("Location: index.php?login=erro_autenticacao");
	}


	# Verificando os nomes das atividades:
	# Para ser validado, o título deve ter mais de três caracteres e não nulo.
	if(mb_strlen($_GET['titulo']) < 3) {
		header("Location: home.php?erro_atividade=nome_invalido");
	}

	# Verificando os formatos de data e hora:
	# Formato hora: 24
	# Usando checkdate() para verificar se a data inputada é válida.
	if(!checkdate($_GET['mes'], $_GET['dia'], $_GET['ano']) || !($_GET['horas'] >= 0 && $_GET['horas'] < 24) || !($_GET['minutos'] >= 0 && $_GET['minutos'] < 60)) {
		header("Location: home.php?erro_atividade=horario_invalido");
	}



	$conn = new PDO('mysql:host=localhost;dbname=kyoto', 'root', '');
	$query = "UPDATE tb_tarefas SET ";
	$query .= "titulo = :titulo, descricao = :descricao, data_hora = :novoHorario ";
	$query .= "WHERE id_tarefa = :id_tarefa"; 

	# Preparando a execução da query.
	$stm = $conn->prepare($query);

	$stm->bindValue(':titulo', $_GET['titulo']);
	$stm->bindValue(':descricao', $_GET['descricao']);
	$novoHorario = $_GET['ano'].'/'.$_GET['mes'].'/'.$_GET['dia'].' '.$_GET['horas'].':'.$_GET['minutos'].':00';
	$stm->bindValue(':novoHorario', $novoHorario);
	$stm->bindValue(':id_tarefa', $_GET['idAlteracao']);

	$stm->execute();
	
	header("Location: home.php");
?>