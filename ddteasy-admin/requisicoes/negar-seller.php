<?php include('../../sistema/config/config.php');

	if(!isset($_SESSION['Sis545IdUsuario'])){
		session_destroy();
		header("Location: ".$Config['UrlSite']."sistema-login-master.php");
		exit;
    }

	if(isset($_POST['id']) && $_POST['id']!=""){
		$id = clean($_POST['id']);
	}else{
		echo 0;
		exit;
	}
         
    $q = Query('SELECT * FROM parceiro WHERE Parceiro = '.$id.'',0);
	if(mysqli_num_rows($q) > 0){
		Query('UPDATE parceiro SET Ativo = 0 WHERE Parceiro = '.$id);
		echo 1;
		exit;
	}else{ 
		echo 0;
		exit;
	} 
