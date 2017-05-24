<?php

define("URL_BASE", "http://127.0.0.1/cargame/");

define("DB_NAME", "cardgame");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");

$raridade 			= ['Comum','Incomum','Raro','Lendário'];
$tipo_magia 		= ['Instante','Prevista','Consistente'];
$tipo_artefato 		= ['Consistente','Momentâneo','Equipamento','Equip. Instante', 'Consis. Instante'];
$tipo_terreno		= ['Terreno Global','Terreno Local','Terreno Pessoal'];
$tipo_talento 		= ['Instante','Previsto','Permanente'];
$tipo_situacional 	= ['Instante','Prevista','Consistente'];

$menssagem = [
	'sucesso'	=>'Esta carta foi deletada com sucesso.',
	'erro'		=>'Um erro ocorreu. A carta selecionada não pode ser deletada.'
	];

require_once 'helper/helper.php';
require_once 'db/dbrecord.php';

require_once 'arquivos/racas/racas.php';
require_once 'arquivos/artefatos/artefatos.php';
require_once 'arquivos/classes/classes.php';
require_once 'arquivos/magias/magias.php';
require_once 'arquivos/habilidades/classes.php';

require_once 'cartas/card.php';
require_once 'cartas/card_criatura.php';
require_once 'cartas/card_magia.php';
require_once 'cartas/card_situacional.php';
require_once 'cartas/card_talento.php';
require_once 'cartas/card_terreno.php';
require_once 'cartas/card_artefato.php';

