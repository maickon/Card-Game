<?php

function card_template(){
	if (isset($_REQUEST['button']) and $_REQUEST['button'] == 'carregar') {
		if ($_REQUEST['card_tipo'] == 'Criatura') {
			$card = new CardCriatura();
		} else {
			$classe = "Card{$_REQUEST['card_tipo']}";
			$card = new $classe();
		}
		$card->card_start($_REQUEST['nivel'], $_REQUEST['tipo'], $_REQUEST['raridade']);
		return $card;
	}
}

function card_criar(){
	if (isset($_REQUEST['button']) and $_REQUEST['button'] == 'salvar') {
		$classe = "Card{$_REQUEST['card_categoria']}";
		$card = new $classe();
		if ($_REQUEST['card_categoria'] == 'Criatura') {
			$card->card_savar_criatura($card->get('db'));
		} else{
			$card->card_savar_magica($card->get('db'));
		}

		if ($_REQUEST['card_id'] == '') {
			$ultimo_card_cadastrado = $card->get('db')->__selectOrder('card','id desc', 'id');
			header("Location: ".URL_BASE.'?id='.$ultimo_card_cadastrado[0]->id.'&cat='.$_REQUEST['card_categoria']);
		} else {
			header("Location: ".URL_BASE.'?id='.$_REQUEST['card_id'].'&cat='.$_REQUEST['card_categoria']);
		}
	}
}

function card_apagar(){
	if (isset($_REQUEST['deletar']) and $_REQUEST['deletar'] == 'Deletar carta') {
		$card = new CardCriatura();
		if($card->get('db')->__delete('card',$_REQUEST['id'])){
			header("Location: ".URL_BASE.'?status=sucesso');
		} else {
			header("Location: ".URL_BASE.'?status=erro');
		}
		
	}
}

function card_load(){
	if (isset($_REQUEST['id']) and isset($_REQUEST['cat'])) {
		if ($_REQUEST['cat'] == '') {
			$_REQUEST['cat'] = 'semcategoria';
		}
		$class_name = "Card{$_REQUEST['cat']}";
		if (class_exists($class_name)) {
			$card = new $class_name();
			$card_show = $card->get('db')->__select('card','*','id='.$_REQUEST['id']);
			if ($class_name == 'CardCriatura') {
				$card->set('id', $card_show[0]->id); 		
				$card->set('nivel', $card_show[0]->nivel); 		
				$card->set('nome', $card_show[0]->nome);			
				$card->set('categoria', $card_show[0]->categoria); 	
				$card->set('sub_nome1', $card_show[0]->sub_nome1); 	
				$card->set('sub_nome2', $card_show[0]->sub_nome2); 	
				$card->set('iniciativa', $card_show[0]->iniciativa); 	
				$card->set('raridade', $card_show[0]->raridade); 		
				$card->set('pv', $card_show[0]->vida); 			
				$card->set('dano', $card_show[0]->dano); 			
				$card->set('dado_de_dano', $card_show[0]->dado_de_dano); 	
				$card->set('ataque', $card_show[0]->ataque); 		
				$card->set('defesa', $card_show[0]->defesa); 		
				$card->set('numero', $card_show[0]->numero); 		
				$card->set('descricao', $card_show[0]->descricao); 	
			} else {
				$card->set('id', $card_show[0]->id); 		
				$card->set('nivel', $card_show[0]->nivel); 		
				$card->set('nome', $card_show[0]->nome);			
				$card->set('tipo', $card_show[0]->tipo);			
				$card->set('categoria', $card_show[0]->categoria); 	
				$card->set('sub_nome1', $card_show[0]->sub_nome1); 	
				$card->set('sub_nome2', $card_show[0]->sub_nome2); 	
				$card->set('raridade', $card_show[0]->raridade);
				$card->set('descricao', $card_show[0]->descricao); 	
			}
			$_REQUEST['card_tipo'] = $_REQUEST['cat'];
			return $card;
		} else {
			$card = new CardMagia;
			$_REQUEST['card_tipo'] = 'semcategoria';
			$card_show = $card->get('db')->__select('card','*','id='.$_REQUEST['id']);
			$card->set('id', $card_show[0]->id); 		
			$card->set('nivel', $card_show[0]->nivel); 		
			$card->set('nome', $card_show[0]->nome);			
			$card->set('categoria', $card_show[0]->categoria); 	
			$card->set('sub_nome1', $card_show[0]->sub_nome1); 	
			$card->set('sub_nome2', $card_show[0]->sub_nome2); 	
			$card->set('iniciativa', $card_show[0]->iniciativa); 	
			$card->set('raridade', $card_show[0]->raridade); 		
			$card->set('pv', $card_show[0]->vida); 			
			$card->set('dano', $card_show[0]->dano); 			
			$card->set('dado_de_dano', $card_show[0]->dado_de_dano); 	
			$card->set('ataque', $card_show[0]->ataque); 		
			$card->set('defesa', $card_show[0]->defesa); 		
			$card->set('numero', $card_show[0]->numero); 		
			$card->set('tipo', $card_show[0]->tipo); 		
			$card->set('descricao', $card_show[0]->descricao);
			return $card;
		}
	} else {
		return card_template();
	}
}