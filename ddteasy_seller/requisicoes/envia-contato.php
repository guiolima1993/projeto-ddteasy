<?php include ('../../sistema/config/config.php');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

		/*$data = http_build_query(
	    array(
	        'secret' => '6LfJBzsUAAAAAJYnWFyfGyYrsrbEw5a-R6VRAG8o', 
	        'response' => $_POST['g-recaptcha-response'],
	        'remoteip' => $_SERVER['REMOTE_ADDR']
	    	)  
		);      

		$stream = array('http' => 
	    	array(  
	        	'method'  => 'POST',
	        	'header'  => 'Content-type: application/x-www-form-urlencoded',
	        	'content' => $data
	    	)
		);      

		$context  = stream_context_create($stream);
		$result = file_get_contents('https://www.google.com/recaptcha/api/siteverify',false,$context);

		$obj = json_decode($result);*/

    $obj->success = 1;
     
	if($obj->success!='' && $obj->success==1){

		if(isset($_POST['Tipo']) && $_POST['Tipo']=='Dica_seller'){     
			//DADOS DA Pessoa


			if(isset($_POST['Nome']) && $_POST['Nome']!=''){
				$Nome = clean($_POST['Nome']);
			}else{
				echo 0;
				exit;
			}

			if(isset($_POST['Email']) && $_POST['Email']!=''){
				$Email = clean($_POST['Email']);
			}else{
				echo 0;
				exit;
			}

			if(isset($_POST['Duvida']) && $_POST['Duvida']!=''){
				$Duvida = clean($_POST['Duvida']);
			}else{
				echo 0;
				exit;
			}


			$id = Insert('INSERT INTO `duvida_seller`(`Titulo`,`Email`,`Duvida`) VALUES ("'.$Nome.'","'.$Email.'","'.$Duvida.'")');      
			if($id!=0){    

				$conteudo = '<tr>
					<td style="background-color: #fff; line-height: 1.7; padding: 50px 30px 75px 30px; font-size: 16px; color: #646464; font-family:Arial,Helvetica,sans-serif;">
						Olá, uma nova dúvida:<br>
						<span>Nome:</span> '.$Nome.'<br>
						<span>Email:</span> '.$Email.'<br>
						<span>Dúvida:</span> '.$Duvida.'<br>
						<span><a href="'.$Config['Url'].'gerenciar.php?1=duvida_seller&2='.$id.'">ver no sistema</a></span>                
						</td> 
					</tr>';     

					$config_smtp = Query('SELECT * FROM configuracao_smtp WHERE Ativo = 1 ORDER BY Configuracao_smtp DESC LIMIT 1',1);
					$destinatarios = $config_smtp['Destinatarios'];

					$dest_arr = explode(',',$destinatarios);
					foreach ($dest_arr as $key => $value){
						envia_email('Duvida Seller',$conteudo,$value);
					}    

				echo 1;        
				exit;  
			}else{
				echo 0;
				exit; 
			}

		}else{
			echo 0;
			exit; 
		}

	}else{
		echo 2;
		exit;
	}