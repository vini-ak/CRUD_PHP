<!-- LOGOFF -->

<?php
	session_start();

	# Destruindo a sessão
	session_destroy();
	header('Location: index.php');
?>