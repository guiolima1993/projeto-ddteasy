<?php include('../../sistema/config/config.php');

	if(!isset($_SESSION['Sis545IdUsuario'])){
		session_destroy();
		header("Location: ".$Config['UrlSite']."sistema-login-master.php");
		exit;
    }

	if(isset($_POST['id']) && $_POST['id']!=""){
		$id = clean($_POST['id']);
	}else{
		echo 0;
		exit;
	}
         
    $q = Query('SELECT * FROM parceiro WHERE Parceiro = '.$id.'',0);
	if(mysqli_num_rows($q) > 0){
		$r = mysqli_fetch_assoc($q);

		$Senha = md5("#Ddteasy_01");
		Query('UPDATE parceiro SET Ativo = 1, Senha = "'.$Senha.'"WHERE Parceiro = '.$id);
		
		$conteudo = '<tr>
						<td style="background-color: #fff; line-height: 1.7; padding: 50px 30px 75px 30px; font-size: 16px; color: #646464; font-family:Arial,Helvetica,sans-serif;">
							Olá! Seja bem-vindo! Realize seu primeiro acesso e altere sua senha:<br>
							<span>E-mail:</span> '.$r['Email'].'<br>
							<span>Senha:</span> #Ddteasy_01 <br><br>
							
							<button href="'.$Config['UrlSite'].'" style="background-color:#f08f2e; 
										   border-radius:6px;
										   display:inline-block;
										   cursor:pointer;
										   color:#ffffff;
										   font-size:12px;
										   font-weight:bold;
										   padding:8px 16px;
										   text-decoration:none;" 
							>Acessar</button>
						</td> 
					</tr>';     
		
		envia_email('Ddteasy - Primeiro Login', $conteudo, $r['Email']);
		echo 1;
		exit;
	}else{ 
		echo 0;
		exit;
	} 
