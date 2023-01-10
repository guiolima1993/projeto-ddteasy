<?php  header('Content-Type: application/json');
		
		include('../../sistema/config/config.php');


	    if(!isset($_SESSION['Sis545IdUsuario'])){
        session_destroy();
        header("Location: ".$Config['Url']."login.php");
        exit;
    }




	if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){
		$id = clean($_REQUEST['id']);
	}else{
		echo 0;
		exit;
	}



    

		$q = Query('SELECT * FROM notificacao WHERE Notificacao = '.$id.'',0);
		
		if(mysqli_num_rows($q) > 0){
			$r = mysqli_fetch_assoc($q);
			echo json_encode($r);
			exit;
		}else{ 
			echo 0;
			exit;
		} 


	