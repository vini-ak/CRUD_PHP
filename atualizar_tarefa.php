<?php

	#importando a classe Atividade
	require('atividade.php');

	# iniciando a session
	session_start();

	$myarr = [];
	foreach ($_SESSION['atividades'] as $i => $tarefa) {
		$myarr[$i] = unserialize($tarefa);

	}

	$myJSON = json_encode($myarr);
	echo $myJSON;
?>