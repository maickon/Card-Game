<?php 
$regras_criaturas = [
	[
		'raridade'		=>'Comum',
		'pv'			=>'5 + 1~10',
		'ataque'		=>'2~4',
		'defesa'		=>'10 + 3~5',
		'dano'			=>'1 + 1~4',
		'dado_de_dano'	=>'d6',
		'iniciativa'	=>'2~3'
	],
	[
		'raridade'		=>'Incomum',
		'pv'			=>'10 + 1~10',
		'ataque'		=>'5~6',
		'defesa'		=>'10 + 6~8',
		'dano'			=>'2 + 5~8',
		'dado_de_dano'	=>'d8',
		'iniciativa'	=>'4~5'
	],
	[
		'raridade'		=>'Raro',
		'pv'			=>'20 + 1~10',
		'ataque'		=>'7~8',
		'defesa'		=>'10 + 9~11',
		'dano'			=>'3 + 9~12',
		'dado_de_dano'	=>'d10',
		'iniciativa'	=>'6~7'
	],
	[
		'raridade'		=>'Lendário',
		'pv'			=>'35 + 1~10',
		'ataque'		=>'9~10',
		'defesa'		=>'10 + 12~14',
		'dano'			=>'4 + 13~16',
		'dado_de_dano'	=>'d12',
		'iniciativa'	=>'8~9'
	],
];

$regras_magias = [
	[
		'raridade'		=>'Comum',
		'pv'			=>'1 + 1~2',
		'ataque'		=>'1~2',
		'defesa'		=>'2~3',
		'dano'			=>'1~4',
		'dado_de_dano'	=>'d6',
		'iniciativa'	=>'1~2'
	],
	[
		'raridade'		=>'Incomum',
		'pv'			=>'2 + 2~4',
		'ataque'		=>'2~4',
		'defesa'		=>'4~6',
		'dano'			=>'2~8',
		'dado_de_dano'	=>'d8',
		'iniciativa'	=>'2~4'
	],
	[
		'raridade'		=>'Raro',
		'pv'			=>'4 + 4~8',
		'ataque'		=>'4~8',
		'defesa'		=>'8~12',
		'dano'			=>'4~12',
		'dado_de_dano'	=>'d10',
		'iniciativa'	=>'4~8'
	],
	[
		'raridade'		=>'Lendário',
		'pv'			=>'8 + 8~16',
		'ataque'		=>'8~12',
		'defesa'		=>'12~16',
		'dano'			=>'8~16',
		'dado_de_dano'	=>'d12',
		'iniciativa'	=>'8~16'
	],
];
?>
<td><b title="Valores padrão para os atributos de criaturas.">Criaturas</b></td>
<tr class="card_table_header">
	<th>Raridade</th>
	<th>Pv</th>
	<th>Ataque</th>
	<th>Defesa</th>
	<th>Dano</th>
	<th>Dado de dano</th>
	<th>Iniciativa</th>
</tr>

<?php foreach ($regras_criaturas as $value): ?>
	<tr>
		<td><?php echo $value['raridade']; ?></td>
		<td><?php echo $value['pv']; ?></td>
		<td><?php echo $value['ataque']; ?></td>
		<td><?php echo $value['defesa']; ?></td>
		<td><?php echo $value['dano']; ?></td>
		<td><?php echo $value['dado_de_dano']; ?></td>
		<td><?php echo $value['iniciativa']; ?></td>
	</tr>
<?php endforeach ?>

<td><b title="Valores de melhoria ou penalidade para habilidades das cartas.">Habilidades de suporte</b></td>
<tr class="card_table_header">
	<th>Raridade</th>
	<th>Pv</th>
	<th>Ataque</th>
	<th>Defesa</th>
	<th>Dano</th>	
	<th>Dado de dano</th>
	<th>Iniciativa</th>
</tr>

<?php foreach ($regras_magias as $value): ?>
	<tr>
		<td><?php echo $value['raridade']; ?></td>
		<td><?php echo $value['pv']; ?></td>
		<td><?php echo $value['ataque']; ?></td>
		<td><?php echo $value['defesa']; ?></td>
		<td><?php echo $value['dano']; ?></td>
		<td><?php echo $value['dado_de_dano']; ?></td>
		<td><?php echo $value['iniciativa']; ?></td>
	</tr>
<?php endforeach ?>