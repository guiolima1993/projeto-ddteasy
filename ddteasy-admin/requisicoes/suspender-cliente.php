<?php include('../../sistema/config/config.php');



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
          
    
	$q = Query('UPDATE cliente SET Ativo = 0 WHERE Cliente = '.$id.'',0);
	echo 1;
	exit;
