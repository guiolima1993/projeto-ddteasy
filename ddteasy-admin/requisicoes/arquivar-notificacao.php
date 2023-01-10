<?php  include('../../sistema/config/config.php');


	foreach ($_POST['id'] as $k => $v) {
		Query('INSERT INTO `notificacao_arquivada`(`Notificacao`, `Parceiro`) VALUES ('.$v.',0)');
	}

	echo 1;
	exit; 