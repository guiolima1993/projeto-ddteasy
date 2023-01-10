<?php  include('../../sistema/config/config.php');


	if(isset($_GET['id']) && $_GET['id']!=''){
		$id = clean($_GET['id']);
	}else{
		echo 0;
		exit;
	}
       
	$q = Query('DELETE FROM colaborador WHERE  Parceiro = '.$_SESSION['Parceiro'].' AND Colaborador = '.$id.'',0);	
	echo 1;
	exit;     
