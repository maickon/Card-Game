<?php

class CardCriatura extends Card{

	private $db;
	private $pv;
	private $ataque;
	private $defesa;
	private $bonus;
	private $dano;
	private $iniciativa;
	private $raca_classe;
	
	function __construct(){
		$this->db = new Dbrecord;
	}

	function card_start($nivel, $tipo, $raridade = 'null'){
		($raridade == 'null')?$this->card_raridade():$this->raridade = $raridade;
		$this->card_nomes();
		$this->nivel 		= $nivel;
		$this->iniciativa 	= $this->card_iniciativa($this->raridade);
		$this->nome 		= $this->card_get_nome($tipo);
		$this->sub_nome1	= $this->card_raca();
		$this->sub_nome2	= $this->card_classe();
		$this->descricao 	= $this->card_descricao($this->raridade);
		$this->pv 			= $this->card_pv($this->raridade);
		$this->ataque 		= $this->card_ataque($this->raridade);
		$this->defesa 		= $this->card_defesa($this->raridade);
		$this->dano 		= $this->card_dano($this->raridade, $nivel);
		$this->dado_de_dano = $this->card_dado_de_dano($this->raridade);
		$this->card_ajustar_raca();
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

	function card_ajustar_raca(){
		global $racas_com_classe, $racas_sem_classe;

		if ($this->tipo_de_raca == 1) {
			$racas = $racas_com_classe;
		} else {
			$racas = $racas_sem_classe;
		}

		$raca = strtolower($this->sub_nome1);
		$this->iniciativa 	+= $racas[$raca]['iniciativa'];
		$this->pv 			+= $racas[$raca]['vida'];
		$this->ataque 		+= $racas[$raca]['ataque'];
		$this->defesa 		+= $racas[$raca]['defesa'];
		$this->dano 		+= $racas[$raca]['dano'];
	}

	function card_descricao($raridade){
		global $hab_classes;
		$habilidades = $hab_classes[strtolower($this->sub_nome2)];
		$indice = array_rand($habilidades);
		$habilidade_selecionada = $habilidades[$indice];
		$bonus = 0;
		switch ($raridade) {
			case 'Lendário':
				$bonus = 3+rand(4,5);
				break;
			case 'Raro':
				$bonus = 2+rand(3,4);
				break;
			case 'Incomum':
				$bonus = 1+rand(2,3);
				break;
			case 'Comum':
				$bonus = rand(1,2);
				break;
		}

		return str_replace("*", $bonus, $habilidade_selecionada);
	}

	/*
		Regra
		Pv base da raridade [comum:5,incomum:10,raro:20,Lendario:35] + um numero entre 1 e 10
	 */
	function card_pv($raridade){
		$pv = 0;
		switch ($raridade) {
			case 'Lendário':
				$pv = 35+rand(1,10);
				break;
			case 'Raro':
				$pv = 20+rand(1,10);
				break;
			case 'Incomum':
				$pv = 10+rand(1,10);
				break;
			case 'Comum':
				$pv = 5+rand(1,10);
				break;
		}
		return $pv;
	}

	/*
		Ataque =  comum = 1,3 - incomum = 4,5 - raro = 6,7 e lendario 8,9
	 */
	function card_ataque($raridade){
		$ataque = 0;
		switch ($raridade) {
			case 'Lendário':
				$ataque = rand(9,10);
				break;
			case 'Raro':
				$ataque = rand(7,8);
				break;
			case 'Incomum':
				$ataque = rand(5,6);
				break;
			case 'Comum':
				$ataque = rand(2,4);
				break;
		}
		return $ataque;
	}

	/*
		Defesa = Nível+10+Raridade: comum = 3,5 - incomum = 6,8 - raro = 9,11 e lendario = 12,14
	 */
	function card_defesa($raridade){
		$defesa = 0;
		switch ($raridade) {
			case 'Lendário':
				$defesa = 10+rand(12,14);
				break;
			case 'Raro':
				$defesa = 10+rand(9,11);
				break;
			case 'Incomum':
				$defesa = 10+rand(6,8);
				break;
			case 'Comum':
				$defesa = 10+rand(3,5);
				break;
		}
		return $defesa;
	}

	/*
		Dano = comum = 1+1,4 - incomum = 2+5,8 - raro = 3+9,12 e lendario = 4+1+13,16
	 */
	function card_dano($raridade, $nivel){
		$dano = 0;
		switch ($raridade) {
			case 'Lendário':
				$dano = 4+rand(13,16);
				break;
			case 'Raro':
				$dano = 3+rand(9,12);
				break;
			case 'Incomum':
				$dano = 2+rand(5,8);
				break;
			case 'Comum':
				$dano = 1+rand(1,4);
				break;
		}
		return $dano;
	}

	/*
		Dado de dano = comum-1d6 - incomum-1d8 - raro-1d10 - lendario-1d12
	*/
	function card_dado_de_dano($raridade){
		$dano = 0;
		switch ($raridade) {
			case 'Lendário':
				$dano = "1d12";
				break;
			case 'Raro':
				$dano = "1d10";
				break;
			case 'Incomum':
				$dano = "1d8";
				break;
			case 'Comum':
				$dano = "1d6";
				break;
		}
		return $dano;
	}

	function card_iniciativa($raridade){
		$bonus = 0;
		switch ($raridade) {
			case 'Lendário':
				$bonus = 3+rand(8,9);
				break;
			case 'Raro':
				$bonus = 2+rand(6,7);
				break;
			case 'Incomum':
				$bonus = 1+rand(4,5);
				break;
			case 'Comum':
				$bonus = rand(2,3);
				break;
		}
		return $bonus;
	}

	function card_classe(){
		global $classes;
		if ($this->tipo_de_raca == 1) {
			$indice = array_rand($classes);
			return ucfirst($classes[$indice]);
		} else {
			return ucfirst($classes[0]);
		}
	}

	function card_raca(){
		$this->tipo_de_raca = rand(1,2);
		if ($this->tipo_de_raca == 1) {
			global $racas_com_classe;
			$raca = array_rand($racas_com_classe);
		} else {
			global $racas_sem_classe;
			$raca = array_rand($racas_sem_classe);
		}
		return ucfirst($raca);
	}
}