<?php  include('../../sistema/config/config.php');


	foreach ($_POST['id'] as $k => $v) {
		Query('DELETE FROM `notificacao` WHERE `Notificacao` = '.$v.'');
	}

	echo 1;
	exit;