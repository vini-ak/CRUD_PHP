<?php
	$id = $_GET['idDelete'];
	array_splice($_SESSION['atividades'], $id, 1);
?>