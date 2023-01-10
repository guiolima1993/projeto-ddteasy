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

	$q = Query('SELECT * FROM cliente WHERE Cliente = '.$id.'',0);
	if(mysqli_num_rows($q) > 0){
		Query('DELETE FROM cliente WHERE Cliente = '.$id.'');
		echo 1;
		exit;
	}else{ 
		echo 0;
		exit;
	} 
	