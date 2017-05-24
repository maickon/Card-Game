<?php
require_once 'config.php';
require_once 'gerenciador.php';

$nomes = helper_nomes();
$card = card_load();
card_criar();
card_apagar();
?>	
<!DOCTYPE html>
<html>
<head>
	<title>Gerador de Cartas - Imperius Card Game</title>
	<link href="css/card.css" rel="stylesheet" />
	<link href="css/index.css" rel="stylesheet" />
	<!-- <script type="text/javascript" src="js/jquery-pack.js"></script> -->
	<script src="js/jquery.min.js"></script>
	<script src="js/html2canvas.js"></script>
	<!-- <script type="text/javascript" src="js/html2canvas.js"></script> -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<script type="text/javascript">
	$(document).ready(function(){

		var element = $("#card_image"); // global variable
		var getCanvas; // global variable

		$("#exportar_imagem").on('click', function () {
	         html2canvas(element, {
	         onrendered: function (canvas) {
	         	 	$("#previewImage").empty();
	                $("#previewImage").append(canvas);
	                getCanvas = canvas;
	             }
	         });
	    });

		$("#salvar_imagem").on('click', function () {
		    var imgageData = getCanvas.toDataURL("image/png");
		    // Now browser starts downloading it instead of just showing it
		    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
		    var card_nome = $(".card_nome").val();
		    console.log(card_nome);
		    $("#salvar_imagem").attr("download", card_nome+".png").attr("href", newData);
		});

		$('.card_raridade_tipo2').change(function() {
			var raridade = $('.card_raridade_tipo2 option:selected').val();
			var colors = [];
			colors['Comum'] 	= '000000';
			colors['Incomum'] 	= '0000FF';
			colors['Raro'] 		= 'D93600';
			colors['Lendário'] 	= '8B7500';
			console.log(colors[raridade]);
			$('.card_raridade_tipo2').css({
			      'color': '#'+colors[raridade]
			});
		});

		$('.card_raridade').change(function() {
			var raridade = $('.card_raridade option:selected').val();
			var colors = [];
			colors['Comum'] 	= '000000';
			colors['Incomum'] 	= '0000FF';
			colors['Raro'] 		= 'D93600';
			colors['Lendário'] 	= '8B7500';
			console.log(colors[raridade]);
			$('.card_raridade').css({
			      'color': '#'+colors[raridade]
			});
		});
	});
	
	function deletar_carta(id,nome,categoria){
		$("#card_nome").empty();
		$("#card_categoria").empty();
		$("#card_nome").append(nome);
		$("#card_categoria").append(categoria);
		$("#card_id").val(id);
		document.getElementById("bord_card_deletar").showModal();
	}

	function card_btn_close(){
		document.getElementById("bord_card_deletar").close();
	}

	</script>
	<div class="container">
		<form method="post" action="/cargame/">
			<div class="menu_box">
				<label class="label">Nível</label>
				<input type="text" name="nivel" value="<?php echo rand(1,10); ?>" class="input">
			</div>
			<div class="menu_box">
				<label class="label">Raridade do Card</label>
				<select name="raridade" class="select">
					<option value="null">Qualquer</option>
					<option>Lendário</option>
					<option>Raro</option>
					<option>Incomum</option>
					<option>Comum</option>
				</select>
			</div>
			<div class="menu_box">
				<label class="label">Tipo de nome</label>
				<select name="tipo" class="select">
					<option>Todos</option>
					<?php foreach ($nomes as $key => $value): ?>
					<option><?php echo $value; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="menu_box">
				<label class="label">Tipo de Card</label>
				<select name="card_tipo" class="select">
					<option>Criatura</option>
					<option>Magia</option>
					<option>Situacional</option>
					<option>Talento</option>
					<option>Terreno</option>
					<option>Artefato</option>
				</select>
			</div>
			<div class="menu_box">
				<br>
				<input type="submit" name="button" value="carregar" class="button">
			</div>
		</form>

		<?php if (isset($_REQUEST['status'])): ?>
			<div class="<?php echo $_REQUEST['status']; ?>"><?php echo $menssagem[$_REQUEST['status']]; ?></div>
		<?php else: ?>
			<div class="line"></div>
		<?php endif; ?>

		<form method="post" action="/cargame/">
				<?php 
				if (isset($_REQUEST['card_tipo'])){
					$file = strtolower($_REQUEST['card_tipo']);
					if (file_exists("template/{$file}.php")) {
						echo '<div class="card-border '.$file.'" id="card_image">';
						// echo '<div id="card_image">';
						require_once "template/{$file}.php";
						// echo '</div>';
						echo '<input type="submit" name="button" value="salvar" class="button_salvar">';
						echo '<input type="button" id="exportar_imagem" value="Exportar Imagem" class="button_salvar">';
						echo '<a href="#" id="salvar_imagem" class="link_salvar_imagem">Salvar imagem da carta</a>';
						echo '<div id="previewImage"></div>';
						echo '</div>';
					} 
				} else {
					echo '<div class="card-border semcategoria" id="card_image"></div>';
				}
				?>
		</form>

		<div class="card-info">
			<div class="menu">
				<span class="item-menu"><a href="?list=Criatura">Criatura</a></span>
				<span class="item-menu"><a href="?list=Magia">Magia</a></span>
				<span class="item-menu"><a href="?list=Situacional">Situacional</a></span>
				<span class="item-menu"><a href="?list=Talento">Talento</a></span>
				<span class="item-menu"><a href="?list=Terreno">Terreno</a></span>
				<span class="item-menu"><a href="?list=Artefato">Artefato</a></span>
				<span class="item-menu"><a href="?list=regras">Regras</a></span>
				<span class="item-menu"><a href="?list=expanssao">Gerar expanssão</a></span>
			</div>
			<table class="card_table">
				<?php 
				$cards = new CardCriatura();
				$list = '';
				if (isset($_REQUEST['list'])) {
					$list = $_REQUEST['list']; 
					if ($_REQUEST['list'] == 'regras') {
						require_once 'template/regras.php';
					} elseif ($_REQUEST['list'] == 'expanssao') {
						require_once 'template/expanssao.php';
					} elseif ($_REQUEST['list'] == 'Todos' || $_REQUEST['list'] == '') {
						$cartas = $cards->get('db')->__selectOrder('card','numero asc');
					} else {
						$cartas = $cards->get('db')->__selectOrder('card','numero asc','*','categoria=\''.$_REQUEST['list'].'\'');
					}
				} else {
					$cartas = $cards->get('db')->__selectOrder('card','numero asc');
				}

				?>
				<?php if (!isset($_REQUEST['list']) || $_REQUEST['list'] != 'regras'): ?>
					<?php if (!isset($_REQUEST['list']) || $_REQUEST['list'] != 'expanssao'): ?>
						<tr class="card_table_header">
							<th>Número</th>
							<th>Nível</th>
							<th>Categoria</th>
							<th>Nome</th>
							<th>Sub Nome 1</th>
							<th>Sub Nome 2</th>
							<th>Raridade</th>
							<th></th>
							<th></th>
						</tr>
					<?php endif ?>
				<?php endif ?>
				<?php if (empty($cartas)) { ?>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				<?php } else { ?>
					<?php foreach ($cartas as $key => $value): ?>
						<tr>
							<td><?php echo $value->numero; ?></td>
							<td><?php echo $value->nivel; ?></td>
							<td><?php echo $value->categoria; ?></td>
							<td><?php echo $value->nome; ?></td>
							<td><?php echo $value->sub_nome1; ?></td>
							<td><?php echo $value->sub_nome2; ?></td>
							<td><?php echo $value->raridade; ?></td>
							<td><div class="carregar"><a href="<?php echo URL_BASE.'?id='.$value->id.'&cat='.$value->categoria.'&list='.$list; ?>">Carregar</a></div></td>
							<td><div class="carregar" onclick="deletar_carta('<?php echo $value->id; ?>','<?php echo $value->nome; ?>','<?php echo $value->categoria; ?>');">Remover</div></td>
						</tr>		
					<?php endforeach ?>
				<?php } ?>
			</table>
		</div>
		
		<dialog id="bord_card_deletar">
			<?php //echo URL_BASE.'?id='.$value->id; ?>
			<h1>Deletar Carta - <span id="card_nome"></span></h1>
			<p>Deseja deletar este card <span id="card_categoria"></span>?</p>
			<form id="card_img_form" name="photo" method="post">
				<input type="hidden" name="id" id="card_id" value="" />
				<input type="submit" name="deletar" value="Deletar carta" class="btn-fechar">
			</form>
			<div onclick="card_btn_close();" class="btn-fechar">Fechar</div>
		</dialog>
	</div>
</body>
</html>