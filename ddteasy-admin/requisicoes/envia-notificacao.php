<?php include('../../sistema/config/config.php');


	    if(!isset($_SESSION['Sis545IdUsuario'])){
        session_destroy();
        header("Location: ".$Config['Url']."login.php");
        exit;
    }




	if(isset($_REQUEST['Id']) && $_REQUEST['Id']!=""){
		$parceiro_id = clean($_REQUEST['Id']);
	}else{
		echo 0;
		exit;
	}


	if(isset($_REQUEST['Assunto']) && $_REQUEST['Assunto']!=""){
		$Assunto = clean($_REQUEST['Assunto']);
	}else{
		echo 0;
		exit;
	}

	if(isset($_REQUEST['Mensagem']) && $_REQUEST['Mensagem']!=""){
		$Mensagem = clean($_REQUEST['Mensagem']);
	}else{
		echo 0;
		exit;
	}


    

		$id = Insert('INSERT INTO notificacao(Parceiro,Titulo,Resumo,Texto,Ativo) VALUES('.$parceiro_id.',"'.$Assunto.'","'.$Mensagem.'","'.$Mensagem.'",1)');
		
		if($id!=0){
			echo 1;
			exit;
		}else{ 
			echo 0;
			exit;
		} 


	