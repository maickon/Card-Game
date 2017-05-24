<?php

abstract class Card{

	protected $nivel;
	protected $nome;
	protected $raridade;
	protected $sub_nome1;
	protected $sub_nome2;
	protected $descricao;

	function card_raridade(){
		$chance = rand(1,1000);
		if ($chance <= 10) {
			$this->raridade = 'Lendário';
		} elseif ($chance > 10 and $chance <= 110) {
			$this->raridade = 'Raro';
		} elseif ($chance > 110 and $chance <= 310) {
			$this->raridade = 'Incomum';
		} elseif ($chance > 310 and $chance <= 1000) {
			$this->raridade = 'Comum';
		}
		return $this->raridade;
	}

	function card_nomes(){
		$arquivos = new DirectoryIterator('arquivos/nomes/');
		foreach ($arquivos as $key => $value) {
			if ($value != '.' and $value != '..') {
				$this->nomes[] = (string)$value;
			}
		}
	}

	function card_get_nome($tipo){
		$tipo = strtolower($tipo);
		$pos = rand(0,count($this->nomes)-1);
		if ($tipo == 'todos') {
			$arquivo = file_get_contents("arquivos/nomes/{$this->nomes[$pos]}");
		} else {
			$arquivo = file_get_contents("arquivos/nomes/{$tipo}.txt");
		}
		$nomes = explode("\n",$arquivo);
		return $nomes[rand(0,count($nomes)-1)];
	}

	function card_bonus($raridade){
		$bonus = 0;
		switch ($raridade) {
			case 'Lendário':
				$bonus = 4+rand(7,8);
				break;
			case 'Raro':
				$bonus = 3+rand(5,6);
				break;
			case 'Incomum':
				$bonus = 2+rand(3,4);
				break;
			case 'Comum':
				$bonus = 1+rand(1,2);
				break;
		}
		return $bonus;
	}

	function card_cura($raridade){
		$bonus = 0;
		$tipo_cura = rand(1,2);
		if ($tipo_cura == 1) {
			switch ($raridade) {
				case 'Lendário':
					$bonus = 8+rand(18,23);
					break;
				case 'Raro':
					$bonus = 6+rand(12,17);
					break;
				case 'Incomum':
					$bonus = 4+rand(6,11);
					break;
				case 'Comum':
					$bonus = 2+rand(1,5);
					break;
			}
		} else{
			switch ($raridade) {
				case 'Lendário':
					$bonus = 4+rand(7,8);
					$bonus = "{$bonus}d10";
					break;
				case 'Raro':
					$bonus = 3+rand(5,6);
					$bonus = "{$bonus}d8";
					break;
				case 'Incomum':
					$bonus = 2+rand(3,4);
					$bonus = "{$bonus}d6";
					break;
				case 'Comum':
					$bonus = 1+rand(1,2);
					$bonus = "{$bonus}d4";
					break;
			}
		}

		return $bonus;
	}

	function card_savar_criatura($db){
		$card = new stdClass;
		$subnome = explode('-', $_REQUEST['card_sub_nome']);
		$dano_total = explode('+', $_REQUEST['card_dano_total']);

		$card->id 			= $_REQUEST['card_id'];
		$card->nivel 		= $_REQUEST['card_nivel'];
		$card->nome 		= $_REQUEST['card_nome'];
		$card->categoria 	= $_REQUEST['card_categoria'];
		$card->sub_nome1	= trim($subnome[0]);
		$card->sub_nome2 	= trim($subnome[1]);
		$card->iniciativa 	= $_REQUEST['card_iniciativa'];
		$card->raridade 	= $_REQUEST['card_raridade'];
		$card->vida 		= $_REQUEST['card_vida'];
		$card->dano 		= $dano_total[1];
		$card->dado_de_dano = $dano_total[0];
		$card->ataque 		= $_REQUEST['card_ataque'];
		$card->defesa 		= $_REQUEST['card_defesa'];
		$card->artista 		= $_REQUEST['card_artista'];
		$card->numero 		= $_REQUEST['card_numero'];
		$card->descricao 	= $_REQUEST['card_descricao'];

		if ($db->__duplicate('card', ['nome'=>$_REQUEST['card_nome']])) {
			$db->__update('card', $card);
		} else {
			$db->__insert('card', $card);
		}

	}

	function card_savar_magica($db){
		$card = new stdClass;
		$subnome = explode('-', $_REQUEST['card_sub_nome']);

		$card->id 			= $_REQUEST['card_id'];
		$card->nivel 		= $_REQUEST['card_nivel'];
		$card->nome 		= $_REQUEST['card_nome'];
		$card->sub_nome1	= trim($subnome[0]);
		$card->sub_nome2 	= trim($subnome[1]);
		$card->raridade 	= $_REQUEST['card_raridade'];
		$card->tipo 		= $_REQUEST['card_tipo'];
		$card->categoria 	= $_REQUEST['card_categoria'];
		$card->artista 		= $_REQUEST['card_artista'];
		$card->numero 		= $_REQUEST['card_numero'];
		$card->descricao 	= $_REQUEST['card_descricao'];
		
		if ($db->__duplicate('card', ['nome'=>$_REQUEST['card_nome']])) {
			$db->__update('card', $card);
		} else {
			$db->__insert('card', $card);
		}

	}
}