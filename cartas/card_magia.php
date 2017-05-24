<?php

class CardMagia extends Card{
	
	private $tipo;
	private $db;

	function __construct(){
		$this->db = new Dbrecord;
	}

	function card_start($nivel, $tipo, $raridade = 'null'){
		($raridade != 'null')?$this->raridade = $raridade:$this->card_raridade();
		$this->nivel 		= $nivel;
		$this->nome 		= $this->card_nome();
		$this->sub_nome1 	= $this->sub_nome1();
		$this->sub_nome2 	= $this->sub_nome2();
	}

	function get($attr){
		if (isset($this->$attr)) {
			return $this->$attr;
		} else {
			return '';
		}
	}

	function set($attr, $value){
		$this->$attr = $value;
	}

	function card_nome(){
		$modo = rand(1,3);
		$nome = '';
		if ($modo == 1) {
			global $nome_primario1, $nome_secundario1;
			$nome_primario = ucfirst($nome_primario1[array_rand($nome_primario1)]);
			$nome_secundario = ($nome_secundario1[array_rand($nome_secundario1)]);
			$nome = "{$nome_primario} {$nome_secundario}";
		} elseif ($modo == 2) {
			global $nome_primario2, $nome_secundario2;
			$nome_primario = ucfirst($nome_primario2[array_rand($nome_primario2)]);
			$nome_secundario = ($nome_secundario2[array_rand($nome_secundario2)]);
			$nome = "{$nome_primario} {$nome_secundario}";
		} else {
			global $nome_completo;
			$nome = ucfirst($nome_completo[array_rand($nome_completo)]);
		}

		return $nome;
	}

	function sub_nome1(){
		global $sub_nome1;
		return ucfirst($sub_nome1[array_rand($sub_nome1)]);

	}

	function sub_nome2(){
		global $sub_nome2;
		return ucfirst($sub_nome2[array_rand($sub_nome2)]);
	}
}