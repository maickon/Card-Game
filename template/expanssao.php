<?php

function card_expanssao($tipo){
	$lvs = ['lv1','lv2','lv3','lv4','lv5','lv6','lv7','lv8','lv9','lv10'];
	$raridades = ['comum','comum','comum','comum','incomum','incomum','incomum','raro','raro','lendario'];
	shuffle($lvs);
	shuffle($raridades);
	$tipo = strtolower($tipo);
	echo "<div class=\"{$tipo}\">";
	echo "<p>[{$tipo}]</p>";
	for ($i=0; $i <count($lvs) ; $i++) {
		$habilidade = card_efect($raridades[$i]); 
		echo "<span class=\"lvs\">2 {$lvs[$i]}-{$raridades[$i]}</span><span class=\"habilidade\">{$habilidade}</span>";
		echo '<br>';
	}
	echo '</div>';
}

function card_efect($raridade){
	$efeito = 'Habilidade';
	if ($raridade == 'comum') {
		$chance = rand(1,100);
		if ($chance <= 20) {
			$efeito .= ':Sim';
		} else {
			$efeito .= ':Não';
		}
	} elseif ($raridade == 'incomum') {
		$chance = rand(1,100);
		if ($chance <= 40) {
			$efeito .= ':Sim';
		} else {
			$efeito .= ':Não';
		}
	} elseif ($raridade == 'raro') {
		$chance = rand(1,100);
		if ($chance <= 60) {
			$efeito .= ':Sim';
		} else {
			$efeito .= ':Não';
		}
	} elseif ($raridade == 'lendario') {
		$chance = rand(1,100);
		if ($chance <= 80) {
			$efeito .= ':Sim';
		} else {
			$efeito .= ':Não';
		}
	}
	return $efeito;
}

echo '<div class="expanssao">';
echo '<p>Expanssão 120 cartas</p>';
card_expanssao('Criaturas');
card_expanssao('Magias');
card_expanssao('Artefatos');
card_expanssao('Terrenos');
card_expanssao('Talentos');
card_expanssao('Situacionais');
echo '</div>';