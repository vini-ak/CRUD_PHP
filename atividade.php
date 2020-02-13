<?php

	class Atividade {
		
		private $nome = null;
		private $data_entrega = null;
		private $descricao = null;

		/* 
		Tempo:

		private $deadline = null;
		private $hora = null;
		private $minutos = null;
		private $dia = null;
		private $mes = null;
		private $ano = null; 
		*/

		public function __get($attr) {
			return $this->$attr;
		}

		public function __set($attr, $valor) {
			$this->$attr = $valor;
		}

		public function mudarNomeAtividade($novo_nome) {
			$this->__set('nome', $novo_nome);
		}

		public function mudarDataEntrega($hora, $minutos, $dia, $mes, $ano) {
			/*
			$this->__set('hora', $hora);
			$this->__set('minutos', $minutos);
			$this->__set('dia', $dia);
			$this->__set('mes', $mes);
			$this->__set('ano', $ano);
			*/
			$this->__set('deadline', date("d-m-Y H:i:s",mktime($hora, $minutos, 00, $mes, $dia, $ano)));
		}

		public function mudarDescricao($nova_descricao) {
			$this->__set('descricao', $nova_descricao);
		}

		public function tempoRestante($nova_descricao) {
			/*
			Este método vai comparar o prazo com o tempo atual e retorna um bg-color.
			Se a diferença for de mais de um doze horas, bg-success.
			Se tiver mais de uma hora de antecedência, bg-warning.
			Se tiver menos de uma hora ou se já tiver atrasado, bg-danger.
			*/
			$prazo = $this->__get('data_entrega'); # Retorna a deadline
			$agora = date();	# Retorna o tempo atual

			# A função strtotime() retorna a quantidade em segundos desde 1970.
			# Fazendo a subtração das datas, encontramos a quantidade de segundos até a conclusão do prazo.

			$diferenca = strtotime($prazo) - $strtotime($agora);

			# Convertendo esse valor em horas:
			$diferenca = $diferenca / (60*60); # Dividindo por 60s e 60m.

			if($diferenca > 12.0) {
				$bg_color = "bg-success";
			} else if($diferenca > 1.0) {
				$bg_color = "bg-warning";
 			} else {
 				$bg_color = "bg-danger";
 			}

 			return $bg_color;
		}
	}	

?>