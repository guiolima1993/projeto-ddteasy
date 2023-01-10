<?php include('../../sistema/config/config.php');


	    if(!isset($_SESSION['Sis545IdUsuario'])){
        session_destroy();
        header("Location: ".$Config['Url']."login.php");
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
		$r = mysqli_fetch_assoc($q);
		Query('DELETE FROM parceiro WHERE Parceiro = '.$id.'');

		$qForma_contato = Query('DELETE FROM forma_contato WHERE Forma_contato ='.$r['Forma_contato'].'');
		echo 1;
		exit;
	}else{ 
		echo 0;
		exit;
	} 
	