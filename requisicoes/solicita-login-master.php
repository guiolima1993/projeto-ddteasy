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

	$DadosUsuario = Query("SELECT * FROM usuario WHERE  Email = '".$Email."' AND Senha = MD5('".$Senha."');", 1);  

	if(isset($DadosUsuario) && $DadosUsuario != "" && isset($DadosUsuario["Usuario"]) && is_numeric($DadosUsuario["Usuario"])) {
	
		$_SESSION[$Config["PrefixoSessao"]."IdUsuario"] = $DadosUsuario["Usuario"];
		$_SESSION[$Config["PrefixoSessao"]."Nome"] = $DadosUsuario["Titulo"];
		$_SESSION['Nivel'] = $DadosUsuario["Nivel_usuario"]; 
	
		$_SESSION['id'] = $DadosUsuario['Usuario'];
		$_SESSION['email'] = $DadosUsuario['Email'];
		if(isset($Config["Backlog"]) && $Config["Backlog"]==1){  
			Query('INSERT INTO historico_uso_sistema(Titulo,Data_hora,Acao,Usuario) VALUES("Login - '.$DadosUsuario["Usuario"].'",NOW(),"Login",'.$DadosUsuario["Usuario"].')');
		}
	
		echo 1;
		exit;

	} else {
		$Erro = "Login e senha ou senha não localizados.";  
	}
?>