<?php include('../../sistema/config/config.php');



	    if(!isset($_SESSION['Sis545IdUsuario'])){
        session_destroy();
        header("Location: ".$Config['Url']."login.php");
        exit;
    }


	if(isset($_POST['Praga_nome']) && $_POST['Praga_nome']!=""){
		$Praga_nome = clean($_POST['Praga_nome']);
	}else{
		echo 0;
		exit;
	}

	$id =  0;

	$q = Query('SELECT * from praga WHERE Titulo = "'.$Praga_nome.'"',0);
	if(mysqli_num_rows($q)==0){
		$id = Insert('INSERT INTO praga(Titulo,Ativo) VALUES("'.$Praga_nome.'",1)');
	
		if($id!=0){
			echo 1;
			exit;   
		}else{
			echo 0;
			exit;
		}

	}
