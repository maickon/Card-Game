<input name="card_nivel" value="<?php echo $card->get('nivel'); ?>" class="card_nivel">
<input name="card_nome" value="<?php echo $card->get('nome'); ?>" class="card_nome">
<input name="card_sub_nome" value="<?php echo $card->get('sub_nome1').' - '.$card->get('sub_nome2'); ?>" class="sub_nome">
<div class="card_imagem"></div>
<input name="card_iniciativa" value="<?php echo $card->get('iniciativa'); ?>" class="card_iniciativa">
<select name="card_raridade" class="card_raridade">
<?php if ($card->get('raridade') != ''): ?>
	<option selected><?php echo $card->get('raridade'); ?></option>
<?php endif; ?>
	<option class="com">Comum</option>
	<option class="inc">Incomum</option>
	<option class="rar">Raro</option>
	<option class="len">Lendário</option>
</select>
<input name="card_dano_total" value="<?php echo $card->get('dado_de_dano').'+'.$card->get('dano'); ?>" class="card_dano">
<textarea name="card_descricao" class="card_descricao"><?php echo $card->get('descricao'); ?></textarea>
<input name="card_vida" value="<?php echo $card->get('pv'); ?>" class="card_vida">
<input name="card_ataque" value="<?php echo $card->get('ataque'); ?>" class="card_ataque">
<input name="card_defesa" value="<?php echo $card->get('defesa'); ?>" class="card_defesa">
<input name="card_numero" value="<?php echo $card->get('numero'); ?>" class="card_numero">
<input name="card_artista" value="Desconhecido" class="card_artista">
<input type="hidden" name="card_categoria" value="Criatura">
<input type="hidden" name="card_id" value="<?php echo $card->get('id'); ?>">