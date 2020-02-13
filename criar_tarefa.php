<?php
	session_start();
	include('atividade.php');	# Método para chamar a classe atividade.

	# Será um parâmetro via post com o nome da atividade o objeto atividade
	if(!isset($_SESSION['atividades'])){
		$_SESSION['atividades'] = array();
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

	$nova_atividade = new Atividade();
	$nova_atividade->mudarNomeAtividade($_GET['titulo']);
	$nova_atividade->mudarDescricao($_GET['descricao']);
	$nova_atividade->mudarDataEntrega($_GET['horas'], $_GET['minutos'], $_GET['dia'], $_GET['mes'], $_GET['ano']);

	# Serializando...
	echo "<pre>";
	print_r($nova_atividade);
	echo "</pre>";
	$nova_atividade = serialize($nova_atividade);

	array_push($_SESSION['atividades'], $nova_atividade);
	header("Location: home.php");
?>