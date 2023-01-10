<?php  include('../../sistema/config/config.php');


	if(isset($_GET['id']) && $_GET['id']!=''){
		$id = clean($_GET['id']);
	}else{
		echo 0;
		exit;
	}
       
	$q = Query('SELECT * FROM servico_prestado WHERE  Parceiro = '.$_SESSION['Parceiro'].' AND Servico_prestado = '.$id.'',0);
	
	if(mysqli_num_rows($q) > 0){


	//echo 'DELETE from servico_prestado WHERE Servico_prestado = '.$id.'';


		Query('DELETE from servico_prestado WHERE Servico_prestado = '.$id.'');
		echo 1;
		exit;
	}else{
		echo 0;
		exit;
	}
        

