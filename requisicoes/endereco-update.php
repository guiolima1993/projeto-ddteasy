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




	if(isset($_POST['Cep']) && $_POST['Cep']!=''){
		$Cep = clean($_POST['Cep']);
	}else{
		echo 0;
		exit;
	}




	if(isset($_POST['Endereco']) && $_POST['Endereco']!=''){
		$Endereco = clean($_POST['Endereco']);
	}else{
		echo 0;
		exit;
	}

	if(isset($_POST['Numero']) && $_POST['Numero']!=''){
		$Numero = clean($_POST['Numero']);
	}else{
		echo 0;
		exit;
	}


	if(isset($_POST['Complemento']) && $_POST['Complemento']!=''){
		$Complemento = clean($_POST['Complemento']);
	}else{
		echo 0;
		exit;
	}



	Query('UPDATE cliente SET Cep = "'.$Cep.'",Endereco = "'.$Endereco.'",Numero = "'.$Numero.'",Complemento = "'.$Complemento.'" WHERE Cliente  = '. $cli_id.'');

   echo 1;
   exit; 