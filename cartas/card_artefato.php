<?php

class CardArtefato extends Card{

	private $tipo;
	private $db;

	function __construct(){
		$this->db = new Dbrecord;
	}

	function card_start($nivel, $tipo, $raridade = 'null'){
		($raridade != 'null')?$this->raridade = $raridade:$this->card_raridade();
		$this->nivel = $nivel;
		$this->nome = $this->card_nome();
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
		global $nome_primario, $nome_secundario;
		$nome_primario = $nome_primario[array_rand($nome_primario)];
		$nome_secundario = $nome_secundario[array_rand($nome_secundario)];
		return "{$nome_primario} {$nome_secundario}";
	}
}