<?php
	// Caso seja passado um id a ser deletado, ele será removido da session e a página será recarregada
	if(isset($_GET['delete_id'])) {
		$conn = new PDO('mysql:host=localhost;dbname=kyoto', 'root', '');
		$query = 'DELETE FROM tb_tarefas WHERE id_tarefa = '.$_GET['delete_id'];
		$stm = $conn->query($query);
		header("Location: home.php");
	}
?>