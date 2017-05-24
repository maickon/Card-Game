<?php

$arquivos_de_classes = [
'criatura','guerreiro','barbaro','samurai','monge','ranger','arqueiro','gladiador','paladino','assassino',
'algoz','ninja','mago','feiticeiro','bruxo','curandeiro','clerigo','druida','bardo'];

$inimigo_predileto = [
'anjo','demônio','meio-anjo','meio-demônio','anão','elfo','goblin','orc','morto-vivo','humano','fada','dragão','dinosauro',
'gorila','urso','serpente','cobra','inseto','lobo','macaco','javali','leão','morcego','rato','aberração','constructo','elemental',
'planta'];

$i = array_rand($inimigo_predileto);
$inimigo_predileto = $inimigo_predileto[$i];

foreach ($arquivos_de_classes as $key => $value) {
	require_once("{$value}/habilidades.php");
}

$hab_classes = [
	'criatura' 	=> $criatura,
	'guerreiro' => $guerreiro,
	'barbaro' 	=> $barbaro,
	'samurai' 	=> $samurai,
	'monge' 	=> $monge,
	'ranger' 	=> $ranger,
	'arqueiro' 	=> $arqueiro,
	'gladiador' => $gladiador,
	'paladino' 	=> $paladino,
	'assassino' => $assassino,
	'algoz' 	=> $algoz,
	'ninja' 	=> $ninja,
	'mago'		=> $mago,
	'feiticeiro'=> $feiticeiro,
	'bruxo'		=> $bruxo,
	'curandeiro'=> $curandeiro,
	'clerigo'	=> $clerigo,
	'druida'	=> $druida,
	'bardo'		=> $bardo
];