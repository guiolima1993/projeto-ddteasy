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

	$q = Query('SELECT Parceiro,Senha FROM parceiro WHERE Email = "'.$Email.'"');
	if(mysqli_num_rows($q) > 0){
		$r = mysqli_fetch_assoc($q);

		if($r['Senha']==md5($Senha)){
			$_SESSION['Parceiro'] = $r['Parceiro'];
			echo 1;
			exit;
		}else{
			echo 4;
			exit;
		}
		
	//usuario nao encontrado
	}else{
		echo 3;
		exit;
	}