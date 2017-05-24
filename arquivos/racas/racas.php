<?php

$racas_com_classe = [

	'anjo'		=>[
		'iniciativa'=>rand(1,6), 
		'vida'		=>rand(1,6), 
		'ataque'	=>rand(1,6), 
		'defesa'	=>rand(1,6), 
		'dano'		=>rand(1,6)
				],
	'demônio'	=>[
		'iniciativa'=>rand(1,6), 
		'vida'		=>rand(1,6), 
		'ataque'	=>rand(1,6), 
		'defesa'	=>rand(1,6), 
		'dano'		=>rand(1,6)
				],
	'meio-anjo'		=>[
		'iniciativa'=>rand(1,3), 
		'vida'		=>rand(1,3), 
		'ataque'	=>rand(1,3), 
		'defesa'	=>rand(1,3), 
		'dano'		=>rand(1,3)
				],
	'meio-demônio'	=>[
		'iniciativa'=>rand(1,3), 
		'vida'		=>rand(1,3), 
		'ataque'	=>rand(1,3), 
		'defesa'	=>rand(1,3), 
		'dano'		=>rand(1,3)
				],
	'anão'		=>[
		'iniciativa'=>0, 
		'vida'		=>rand(1,6), 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'elfo'		=>[
		'iniciativa'=>rand(1,6), 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
				],
	'goblin'	=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>rand(1,6), 
		'defesa'	=>0, 
		'dano'		=>0
				],
	'orc'	=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>rand(1,6)
				],
	'morto-vivo'=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>rand(1,6), 
		'dano'		=>0
				],
	'humano'	=>[
		'iniciativa'=>rand(1,2), 
		'vida'		=>rand(1,2), 
		'ataque'	=>rand(1,2), 
		'defesa'	=>rand(1,2), 
		'dano'		=>rand(1,2)
				],
	'fada'	=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
				]
];


$racas_sem_classe = [

	'dragão'		=>[
		'iniciativa'=>rand(3,10), 
		'vida'		=>rand(3,10), 
		'ataque'	=>rand(3,10), 
		'defesa'	=>rand(3,10), 
		'dano'		=>rand(3,10)
		],
	'dinosauro'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'gorila'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'urso'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'serpente'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'cobra'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'inseto'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'lobo'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'macaco'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'javali'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'leão'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'morcego'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'rato'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'aberração'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'constructo'	=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'elemental'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
	'planta'		=>[
		'iniciativa'=>0, 
		'vida'		=>0, 
		'ataque'	=>0, 
		'defesa'	=>0, 
		'dano'		=>0
		],
];