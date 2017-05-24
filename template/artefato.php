<input name="card_nivel" value="<?php echo $card->get('nivel'); ?>" class="card_nivel">
<input name="card_nome" value="<?php echo $card->get('nome'); ?>" class="card_nome">
<input name="card_sub_nome" value="<?php echo $card->get('sub_nome1').' - '.$card->get('sub_nome2'); ?>" class="sub_nome">
<div class="card_imagem"></div>

<select name="card_tipo" class="card_tipo">
<?php foreach ($tipo_artefato as $key => $value): ?>
	<?php if ($card->get('tipo') == $value): ?>
	<option selected><?php echo $value; ?></option>
	<?php else: ?>
	<option><?php echo $value ?></option>
	<?php endif; ?>
<?php endforeach ?>
</select>

<select name="card_raridade" class="card_raridade_tipo2">
<?php if ($card->get('raridade') != ''): ?>
	<option selected><?php echo $card->get('raridade'); ?></option>
<?php endif; ?>
	<option class="com">Comum</option>
	<option class="inc">Incomum</option>
	<option class="rar">Raro</option>
	<option class="len">Lendário</option>
</select>

<textarea name="card_descricao" class="card_descricao_tipo2"><?php echo $card->get('descricao'); ?></textarea>
<input name="card_numero" value="0001" class="card_numero_tipo2">
<input name="card_artista" value="Desconhecido" class="card_artista_tipo2">
<input type="hidden" name="card_categoria" value="Artefato">
<input type="hidden" name="card_id" value="<?php echo $card->get('id'); ?>">
<input type="submit" name="button" value="salvar" class="button_salvar">