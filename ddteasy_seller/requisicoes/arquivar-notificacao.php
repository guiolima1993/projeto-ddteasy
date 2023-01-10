<?php  include('../../sistema/config/config.php');


	foreach ($_POST['Notificacao'] as $k => $v) {
		Query('INSERT INTO `notificacao_arquivada`(`Notificacao`, `Parceiro`) VALUES ('.$v.','.$_SESSION['Parceiro'].')');
	}

	echo 1;
	exit; 