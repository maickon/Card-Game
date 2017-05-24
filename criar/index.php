<?php

require_once '../config.php';

$classe = "Card{$_REQUEST['card_tipo']}";
$card = new $classe();
if ($_REQUEST['card_tipo'] == 'Criatura') {
	$card->card_savar_criatura($card->get('db'));
} else{
	$card->card_savar_magica($card->get('db'));
}

$ultimo_card_cadastrado = $card->get('db')->__selectOrder('card','id desc', 'id');
header("Location: ".URL_BASE.'?id='.$ultimo_card_cadastrado[0]->id.'&cat='.$_REQUEST['card_tipo']);
