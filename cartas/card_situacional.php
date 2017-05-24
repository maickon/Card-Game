<?php

class CardSituacional extends Card{
	
	private $tipo;
	private $db;

	function __construct(){
		$this->db = new Dbrecord;
	}

	function card_start($nivel, $tipo, $raridade = 'null'){
		($raridade != 'null')?$this->raridade = $raridade:$this->card_raridade();
		$this->nivel 		= $nivel;
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
}