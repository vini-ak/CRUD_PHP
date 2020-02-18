<?php
	session_start();
	require('atividade.php');



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



	// Pegando o objeto
	$sessao = unserialize($_SESSION['atividades'][$_GET['idAlteracao']]);

	// Setando os novos valores
	$sessao->mudarNomeAtividade($_GET['titulo']);
	$sessao->mudarDataEntrega($_GET['horas'], $_GET['minutos'], $_GET['dia'], $_GET['mes'], $_GET['ano']);
	$sessao->mudarDescricao($_GET['descricao']);

	// Voltando ao normal...
	$_SESSION['atividades'][$_GET['idAlteracao']] = serialize($sessao);
	header("Location: home.php");
?>