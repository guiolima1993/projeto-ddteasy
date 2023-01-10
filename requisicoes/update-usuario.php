<?php header('Content-Type: application/json; charset=utf-8');  
include('../sistema/config/config.php');

	$id    = "";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	/*
	Nome: Lucas
Email: lucas@makeweb.com.br
Nacimento: 04/09/1991
Cpf: 405.341.418-03
Telefone: (15) 3232-3232
	*/

  if(isset($_SESSION['Cliente']) && $_SESSION['Cliente']!=''){
      
      $cli_id =  $_SESSION['Cliente'];
	  
	  $q = Query('SELECT * FROM cliente WHERE Cliente = '.$cli_id.'');
	  if(mysqli_num_rows($q) > 0){
	    $r = mysqli_fetch_assoc($q);
	  }else{
	   	echo '<script>document.location = "'.$Config['UrlSite'].'login";</script>';
		exit;
	  }


  }else{
  		echo 0;
  		exit;
  }




	if(isset($_POST['Nome']) && $_POST['Nome']!=''){
		$Titulo = clean($_POST['Nome']);
	}else{
		echo 0;
		exit;
	}

	if(isset($_POST['Email']) && $_POST['Email']!=''){
		$Email = clean($_POST['Email']);

		//email tentando usar ja existe na plataforma
		$q_check = Query('SELECT Cliente FROM cliente WHERE Cliente <> '.$cli_id.' AND Email = "'.$Email.'"',0);
		if(mysqli_num_rows($q_check) > 0){
			echo 9;
			exit;
		}

	}else{
		echo 0;
		exit;
	}


	if(isset($_POST['Nacimento']) && $_POST['Nacimento']!=''){
		$Nascimento = clean($_POST['Nacimento']);

		$data = explode('/',$Nascimento);
		$data = $data[2].'-'.$data[1].'-'.$data[0];

		$Nascimento = $data;

	}else{
		echo 0;
		exit;
	}

	if(isset($_POST['Cpf']) && $_POST['Cpf']!=''){
		$Cpf = clean($_POST['Cpf']);
	}else{
		echo 0;
		exit;
	}

	if(isset($_POST['Telefone']) && $_POST['Telefone']!=''){
		$Telefone = clean($_POST['Telefone']);
	}else{
		echo 0;
		exit;
	}

	Query('UPDATE cliente SET Titulo = "'.$Titulo.'",Email = "'.$Email.'",Data_nascimento = "'.$Nascimento.'",Cpf = "'.$Cpf.'",Telefone = "'.$Telefone.'" WHERE Cliente  = '. $cli_id.'');

   echo 1;
   exit; 