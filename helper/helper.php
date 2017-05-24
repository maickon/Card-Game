<?php
function helper_nomes(){
	$arquivos = new DirectoryIterator('arquivos/nomes/');
	foreach ($arquivos as $key => $value) {
		if ($value != '.' and $value != '..') {
			$nomes[] = ucfirst(substr($value, 0, -4));
		}
	}
	return $nomes;	
}