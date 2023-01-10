<?php include('../sistema/config/config.php');  

	$Email = "";

	if(isset($_POST['Email']) && $_POST['Email']!=''){
		$Email = clean($_POST['Email']);
	}else{
		echo 0;
		exit;
	}

	$Senha = "";

	if(isset($_POST['Senha']) && $_POST['Senha']!=''){
		$Senha = clean($_POST['Senha']);
	}else{
		echo 0;
		exit;
	}

	$q = Query('SELECT Cliente,Contador FROM cliente WHERE Email = "'.$Email.'" AND Senha = "'.md5($Senha).'"');
	if(mysqli_num_rows($q) > 0){
		
		$r = mysqli_fetch_assoc($q);

		$contador = $r['Contador'] + 1;
		Query('UPDATE cliente SET Contador =  '.$contador.' where Cliente = '.$r['Cliente'].'',0);
		$_SESSION['Cliente'] = $r['Cliente'];

		echo 1;
		exit;
		
	}else{
		echo 0;
		exit;
	}