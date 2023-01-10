<?php //ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
	@session_start();     
	date_default_timezone_set('America/Sao_Paulo');  
	@header('Content-Type: text/html; charset=utf-8');
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	$DEBUG = 0;   
	$SQLDEBUG = array();      
              
    
    /*Banco Principal*/                                     
	$Config = array(                                                                                                                                                               
		"Url" => "https://ddteasy.com.br/sistema/",     
		"UrlSite" => "https://ddteasy.com.br/",       
		//"Url" => "http://localhost/ddteasy/sistema/",
		//"UrlSite" => "http://localhost/ddteasy/",
		"Banco" => array("mysql.ddteasy.com.br","ddteasy","0T6vg6Jz0pLx","ddteasy"),         
		"Dev" => "1",
		"Secret_key_google" => "", 
		"PrefixoControle" => "SisValCmp",                 
		"PrefixoSessao" => "Sis545", 
		"NomeCliente" => "alere",  
		"Backlog" => "1",      
		"RootDir" => $_SERVER['DOCUMENT_ROOT']."/",
		"RootDirAdm" => $_SERVER['DOCUMENT_ROOT']."/sistema/", 
		"Versao" => "1.1 (Dezembro/2021)" 
	);                 
	              
	include "projeto_sis.php";
	include "dados.php";   
	include "idioma.php";   
	include "funcoes.php";  

	global $dados_empresa;
	$q = Query('SELECT * from dados_da_empresa WHERE Ativo = 1 ORDER BY Dados_da_empresa DESC LIMIT 1',0);
	if(mysqli_num_rows($q) > 0){
		$dados_empresa = mysqli_fetch_assoc($q);
	}

	//Query('ALTER TABLE dados_da_empresa ADD Texto_cookie  TEXT');

	function get_parameter(){
		$url_atual = "http" . (isset($_SERVER['HTTPS']) ? (($_SERVER['HTTPS']=="on") ? "s" : "") : "") . "://" . "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url_ex = explode('/',$url_atual);
		$param = end($url_ex);
		return $param;
	}


	

    function envia_email($assunto,$corpo,$email){ 
 
		global $Config;
   
		//$message = $corpo;			
		$destino = $email; 

		$config_smtp = Query('SELECT * FROM configuracao_smtp WHERE Ativo = 1 ORDER BY Configuracao_smtp DESC LIMIT 1',1);
  
        
		$usuario = $config_smtp['Email_sender'];      
		$senha   = $config_smtp['Senha_sender']; 
	//$destinatarios = $config_smtp['Destinatarios'];
            
 
	   $conteudo = '
		<!DOCTYPE html
		PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">   
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<title>CRMake</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			</head>
			<body bgcolor="#eee" style="margin: 0; padding: 50px 0 50px 0; background-color: #eee; padding: 30px 0;">
				<table bgcolor="#eee"align="center" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #eee">
					<table align="center" bgcolor="transparent" border="0" bordercolor="#e13a4a" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: transparent; width: 600px; margin: 0 auto;">
						<tr>     
							<td align="center" style="padding: 0;">
								<img src="'.$Config['Url'].'img/top.png" alt="Audax Cursos Profissionalizantes" width="600" height="130" style="display: block; margin-bottom: -20px;" />
							</td>
						</tr>
						<tr bgcolor="#fff" style="font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: #989898; background-color: #fff;">';
							$conteudo .=  $corpo; 
							$conteudo .= '<tr>
							<td align="center" bgcolor="transparent" style="padding: 0;">
								<img src="'.$Config['Url'].'img/bottom.png" alt="Audax Cursos Profissionalizantes" width="600" height="51" style="display: block; border-radius: 0 0 15px 15px; margin-top: -20px;" />
							</td>
						</tr>
					</table>
				</table>
			</body>
		</html>';



		$message = $conteudo;



	/***********************************A PARTIR DAQUI NAO ALTERAR*********************************** */

		require_once('class.phpmailer.php');  

		$Subject = utf8_decode($assunto);
		$Message = utf8_decode($message);    

		$Host = 'mail.'.substr(strstr($usuario,'@'),1);
		//$Host = 'smtp.desenvolvimentomw.com.br'; 
		$Username = $usuario;
		$Password = $senha;
		$Port = "587"; 
          
		$mail = new PHPMailer();    
		$body = $Message;   
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host = $Host; // SMTP server
		$mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
		$mail->SMTPAuth = true; // enable SMTP authentication
		$mail->Port = $Port; // set the SMTP port for the service server
		$mail->Username = $usuario; // account username
		$mail->Password = $senha; // account password
		$mail->SetFrom($usuario, $assunto);    
		$mail->Subject = $Subject;
		$mail->MsgHTML($body);    
		//$mail->AddAttachment($_FILES['arquivo']['tmp_name'], $_FILES['arquivo']['name']);
	   		
		$mail->AddAddress($email,$email);


	   		        
	    // $mail->AddAddress('lucas@makeweb.com.br',"Contato");
		if($mail->Send()){
			return 1;
		}else{ 
			return 0;
		}

	} 























	







   	
?>
