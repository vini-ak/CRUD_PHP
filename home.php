<?php
	#Chamando a classe Atividade só para não haver erros
	require('atividade.php');

	# Iniciando a sessão do PHP
	session_start();

	if((!isset($_SESSION['autenticado'])) || $_SESSION['autenticado'] != "SIM") {
		header("Location: index.php?login=erro_autenticacao");
	}
	require_once('navbar.html');


	if(isset($_GET['id'])) {
		$sessao = unserialize($_SESSION['atividades']);
		echo $_GET['id'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Página Inicial</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		body {
			background: linear-gradient(to right, #c7ea46, #d0f0c0, #98fb98);
		}
	</style>

	<script type="text/javascript">
		function getTarefa(indice) {
			
			let ajax = new XMLHttpRequest()
			ajax.open('GET', 'converter_SESSION_to_JSON.php')
			ajax.onreadystatechange = () => {
				if(ajax.readyState == 4 && ajax.status == 200) {
					let atividades = JSON.parse(ajax.responseText)
					console.log(atividades)

					if(atividades){
						document.getElementById('titulo_atividade').innerHTML = atividades[indice]['nome']
						document.getElementById('descricao_atividade').innerHTML = atividades[indice]['descricao']
						document.getElementById('prazo_atividade').innerHTML = atividades[indice]['deadline']
					}
				}
			}

			ajax.send()
		}
	</script>

</head>
<body style="font-family: monospace, OCR A Std">
	<h1 class="text-success text-center text-monospace" style="padding-top: 200px; padding-bottom: 40px">Atividades</h1>
	<?php
		/*
		Caso não hajam tarefas a serem executadas, será mostrada uma mensagem de que não há tarefas
		*/
		if(!isset($_SESSION['atividades']) || $_SESSION['atividades'] == []){
			?>
			<h3 class="text-secondary text-center" style="padding-top: 20px;">Você ainda não possui atividades :/</h3>
			<?php
		/*
		Caso hajam tarefas, será criada uma lista de tarefas com variação de cores.
		*/
		} else {
			$idButton = 0;
			foreach ($_SESSION['atividades'] as $atividade) {
				$atividade = unserialize($atividade);
				echo "<button type='button' onclick='getTarefa(\"$idButton\")'' class='btn btn-md btn-block btn-outline-success' data-toggle='modal' data-target='#idModalAtividade'>";
					echo $atividade->__get('nome');	
				echo "</button>";
				
				$idButton += 1;
			}
		}
	?>

	<button class="btn btn-link btn-block" style="padding-top: 15px; margin-top: 30px" data-toggle="modal" data-target='#modal_cadastro'>
		<img src="imagens/plus.png" style="display: inline-block" width="15px" height="15px">
		<p class="font-weight-bold" style="display: inline-block" >Adicionar tarefa</p>
	</button>

	<div class="modal fade" tabindex="-1" id="modal_cadastro" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Definindo uma nova tarefa</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="criar_tarefa.php" method='get'>
						<div class="form-group">
							<label for="#idNome">Título</label>
							<input type="text" name="titulo" class="form-control" id="idNome" aria-describedby="Título da atividade" placeholder="Insira um título para a atividade">
						</div>
						<div class="form-group">
							<label for="idDescricao">Descrição</label>
							<textarea type="text" rowspan=1 name="descricao" class="form-control" id="idDescricao" aria-describedby="Descrição da atividade" placeholder="Descreva um pouco mais sobre sua tarefa..."></textarea>
						</div>
						<div class="form-group">
							<label for="#idHora">Prazo</label>
							<div id="idHora" aria-describedby="Horário limite para a realização da tarefa">
								<div class="form-control" style="display: inline-block;">
									<input type="text" name="horas" size="2" style="display: inline-block;" maxlength="2" placeholder="hh">
									<p style="display: inline-block;"> : </p>
									<input type="text" name="minutos" size="2" style="display: inline-block;" maxlength="2" placeholder="mm">
								</div>
								<div class="form-control" style="display: inline-block;">
									<input type="text" name="dia" size="2" style="display: inline-block;" maxlength="2" placeholder="DD">
									<p style="display: inline-block;"> / </p>
									<input type="text" name="mes" size="2" style="display: inline-block;" maxlength="2" placeholder="MM">
									<p style="display: inline-block;"> / </p>
									<input type="text" name="ano" size="4" style="display: inline-block;" maxlength="4" placeholder="AAAA">
								</div>	
							</div>
						</div>			
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal" aria-label="Fechar">Fechar</button>
					<button type="submit" class="btn btn-primary">Salvar atividade</button>
				</div>
			</form>
			</div>
		</div>	
	</div>


	<div class="modal fade" id = "idModalAtividade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 id="titulo_atividade">Titulo</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p id="descricao_atividade">Descrição</p>
					<p id="prazo_atividade">00:00</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal" aria-label="Fechar">Fechar</button>
					<button class="btn btn-danger" type="button">Deletar atividade</button>
					<button class="btn btn-primary" type="button">Editar</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Verificação de cadastro das atividades -->
	<?php
		if(isset($_GET['erro_atividade'])) {
			if($_GET['erro_atividade'] == 'nome_invalido') {
				?>
				<p class="text-secondary" style="padding-top: 20px; padding-left: 50px">Insira um título válido para a sua atividade</p>
				<?php 
			} else if($_GET['erro_atividade'] == 'horario_invalido') {
				?>
				<p class="text-secondary" style="padding-top: 20px; padding-left: 50px">Insira um horário válido para a sua tarefa</p>
				<?php
			}
		}
	?>


	<!-- BOOTSTRAP JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>