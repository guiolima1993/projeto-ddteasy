<?php include('../sistema/config/config.php');  
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

		$obj = json_decode('{"success":true,"challenge_ts":"2019-01-23T18:39:39Z","hostname":"localhost"}');
		$obj->success = 1;
     
	if($obj->success!='' && $obj->success==1){

		if(isset($_POST['Tipo']) && $_POST['Tipo']=='Parceiro'){    
			
			//DADOS DA Pessoa
			if(isset($_POST['Nome']) && $_POST['Nome']!=''){
				$Nome = clean($_POST['Nome']);
			}else{
				echo 0;
				exit;
			}

			if(isset($_POST['Cnpj']) && $_POST['Cnpj']!=''){
				$Cnpj = clean($_POST['Cnpj']);
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


			if(isset($_POST['Telefone']) && $_POST['Telefone']!=''){
				$Telefone = clean($_POST['Telefone']);
			}else{
				echo 0;
				exit;
			}



			if(isset($_POST['Nome_empresa']) && $_POST['Nome_empresa']!=''){
				$Nome_empresa = clean($_POST['Nome_empresa']);
			}else{
				echo 0;
				exit;
			}


			// if(isset($_POST['Forma_contato']) && $_POST['Forma_contato']!=''){
			// 	$Forma_contato = clean($_POST['Forma_contato']);
			// }else{
			// 	echo 0;
			// 	exit;
			// }    
			
			if(isset($_POST['Forma_contato_Telefone']) && $_POST['Forma_contato_Telefone']!=''){
				$Forma_contato_Telefone = clean($_POST['Forma_contato_Telefone']);
			}else{
				$Forma_contato_Telefone = 0;
			}
  
			if(isset($_POST['Forma_contato_Whatsapp']) && $_POST['Forma_contato_Whatsapp']!=''){
				$Forma_contato_Whatsapp = clean($_POST['Forma_contato_Whatsapp']);
			}else{
				$Forma_contato_Whatsapp = 0;
			}
			
			if(isset($_POST['Forma_contato_Email']) && $_POST['Forma_contato_Email']!=''){
				$Forma_contato_Email = clean($_POST['Forma_contato_Email']);
			}else{
				$Forma_contato_Email = 0;
			}

			$idForma_contato = Insert('INSERT INTO `forma_contato`(`Telefone`, `Whatsapp`, `Email`) VALUES ('.$Forma_contato_Telefone.','.$Forma_contato_Whatsapp.','.$Forma_contato_Email.')');

			if($idForma_contato!=0){
				$Data = date('Y-m-d');
				// $id = Insert('INSERT INTO `parceiro`(`Titulo`,`Cnpj`,`Email`,`Telefone`,`Nome_empresa`,`Como_podemos_falar`,`Ativo`) VALUES ("'.$Nome.'","'.$Cnpj.'","'.$Email.'","'.$Telefone.'","'.$Nome_empresa.'","'.$Forma_contato.'",0)');      
				$id = Insert('INSERT INTO `parceiro`(`Titulo`,`Cnpj`,`Email`,`Telefone`,`Nome_empresa`,`Forma_contato`,`Ativo`,`Data_cadastro`) VALUES ("'.$Nome.'","'.$Cnpj.'","'.$Email.'","'.$Telefone.'","'.$Nome_empresa.'","'.$idForma_contato.'",0,"'.$Data.'")');      
			  
					if($id!=0){    
						$qParceiro = Query('SELECT * FROM parceiro WHERE Parceiro ='. $id);
						$rParceiro = mysqli_fetch_assoc($qParceiro);


						$qForma_contato = Query('SELECT * FROM forma_contato WHERE Forma_contato ='.$rParceiro['Forma_contato']);
						$rForma_contato = mysqli_fetch_assoc($qForma_contato);
						$Forma_contato = "";

						if($rForma_contato['Telefone'] == 1){
							$Forma_contato .= 'Telefone';
						}

						if($rForma_contato['Whatsapp'] == 1){
							if($Forma_contato != ""){
								$Forma_contato .= ', Whatsapp';
							}else{
								$Forma_contato .= 'Whatsapp';
							}
						}

						if($rForma_contato['Email'] == 1){
							if($Forma_contato != ""){
								$Forma_contato .= ', Email';
							}else{
								$Forma_contato .= 'Email';
							}
						}

						$conteudo = '<tr>
							<td style="background-color: #fff; line-height: 1.7; padding: 50px 30px 75px 30px; font-size: 16px; color: #646464; font-family:Arial,Helvetica,sans-serif;">
								Olá, um novo parceiro:<br>
								<span>Nome:</span> '.$Titulo.'<br>
								<span>Email:</span> '.$Email.'<br>
								<span>Telefone:</span> '.$Telefone.'<br>
								<span>Nome da empresa:</span> '.$Nome_empresa.'<br>
								<span>Forma de contato:</span> '.$Forma_contato.'<br>
								<span><a href="'.$Config['Url'].'gerenciar.php?1=contato&2='.$id.'">ver no sistema</a></span>                
								</td> 
							</tr>';     
						
	
						$config_smtp = Query('SELECT * FROM configuracao_smtp WHERE Ativo = 1 ORDER BY Configuracao_smtp DESC LIMIT 1',1);
						$destinatarios = $config_smtp['Destinatarios'];
	
						$dest_arr = explode(',',$destinatarios);
						foreach ($dest_arr as $key => $value){
							envia_email('Novo Parceiro',$conteudo,$value);
						}       
	
						  
						echo 1;
						exit;  
					}else{
						echo 0;
						exit; 
					}
				echo 1;
				exit;
			}else{
				echo 0;
				exit;
			}

		}else if(isset($_POST['Tipo']) && $_POST['Tipo']=='Cliente'){
			
			//DADOS DA Pessoa
			if(isset($_POST['Nome']) && $_POST['Nome']!=''){
				$Nome = clean($_POST['Nome']);
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

			if(isset($_POST['Email']) && $_POST['Email']!=''){
				$Email = clean($_POST['Email']);
			}else{
				echo 0;
				exit;
			}

			if(isset($_POST['Senha']) && $_POST['Senha']!=''){
				$Senha = md5($_POST['Senha']);
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
			}

			// if(isset($_POST['Forma_contato']) && $_POST['Forma_contato']!=''){
			// 	$Forma_contato = clean($_POST['Forma_contato']);
			// }else{
			// 	echo 0;
			// 	exit;
			// }    
			
			if(isset($_POST['Forma_contato_Sms']) && $_POST['Forma_contato_Sms']!=''){
				$Forma_contato_Sms = clean($_POST['Forma_contato_Sms']);
			}else{
				$Forma_contato_Sms = 0;
			}
  
			if(isset($_POST['Forma_contato_Whatsapp']) && $_POST['Forma_contato_Whatsapp']!=''){
				$Forma_contato_Whatsapp = clean($_POST['Forma_contato_Whatsapp']);
			}else{
				$Forma_contato_Whatsapp = 0;
			}
			
			if(isset($_POST['Forma_contato_Email']) && $_POST['Forma_contato_Email']!=''){
				$Forma_contato_Email = clean($_POST['Forma_contato_Email']);
			}else{
				$Forma_contato_Email = 0;
			}


			$Concordo = 0;
			if(isset($_POST['Termos_de_uso']) && $_POST['Termos_de_uso']==1){
				$Concordo = clean($_POST['Termos_de_uso']);
			}else{
				echo 0;
				exit;
			}

			$Quero_novidades = 0;
			if(isset($_POST['Quero_novidades']) && $_POST['Quero_novidades']==1){
				$Quero_novidades = clean($_POST['Forma_contato']);
			}

			$idForma_contato_cliente = Insert('INSERT INTO `forma_contato_cliente`(`Sms`, `Whatsapp`, `Email`) VALUES ('.$Forma_contato_Sms.','.$Forma_contato_Whatsapp.','.$Forma_contato_Email.')');

			if($idForma_contato_cliente !=0){
				$Complemento = (isset($Complemento)) ? $Complemento : 'não informado';
				$id = Insert('INSERT INTO `cliente`(`Titulo`,`Email`,`Telefone`,`Senha`,`Cpf`,`Cep`,`Endereco`,`Numero`,`Complemento`,`Forma_contato_cliente`,`Concordo_com_termos`,`Quer_novidades`,`Data_cadastro`) VALUES ("'.$Nome.'","'.$Email.'","'.$Telefone.'","'.$Senha.'","'.$Cpf.'","'.$Cep.'","'.$Endereco.'","'.$Numero.'","'.$Complemento.'","'.$idForma_contato_cliente.'","'.$Concordo.'","'.$Quero_novidades.'",NOW())');      
		  
				 if($id!=0){      
					$qCliente = Query('SELECT * FROM cliente WHERE Cliente ='. $id);
					$rCliente = mysqli_fetch_assoc($qCliente);


					$qForma_contato = Query('SELECT * FROM forma_contato_cliente WHERE Forma_contato_cliente ='.$rCliente['Forma_contato_cliente']);
					$rForma_contato = mysqli_fetch_assoc($qForma_contato);
					$Forma_contato = "";

					if($rForma_contato['Sms'] == 1){
						$Forma_contato .= 'SMS';
					}

					if($rForma_contato['Whatsapp'] == 1){
						if($Forma_contato != ""){
							$Forma_contato .= ', Whatsapp';
						}else{
							$Forma_contato .= 'Whatsapp';
						}
					}

					if($rForma_contato['Email'] == 1){
						if($Forma_contato != ""){
							$Forma_contato .= ', Email';
						}else{
							$Forma_contato .= 'Email';
						}
					}

					$conteudo = '<tr>
						<td style="background-color: #fff; line-height: 1.7; padding: 50px 30px 75px 30px; font-size: 16px; color: #646464; font-family:Arial,Helvetica,sans-serif;">
							Olá, um novo cadastro de cliente no site:<br>
							<span>Nome:</span> '.$Nome.'<br>
							<span>Telefone:</span> '.$Telefone.'<br>
							<span>Email:</span> '.$Email.'<br>
							<span>Cpf:</span> '.$Cpf.'<br>
							<span>CEP:</span> '.$Cep.'<br>
							<span>Endereço:</span> '.$Endereco.'<br>
							<span>Número:</span> '.$Numero.'<br>
							<span>Complemento:</span> '.$Complemento.'<br>
							<span>Forma de contato:</span> '.$Forma_contato.'<br>
							<span>Concorda com os termos:</span> '.$Concordo.'<br>
							<span>Quer novidades:</span> '.$Quero_novidades.'<br>
							</td> 
						</tr>';     
					
	
					$config_smtp = Query('SELECT * FROM configuracao_smtp WHERE Ativo = 1 ORDER BY Configuracao_smtp DESC LIMIT 1',1);
					$destinatarios = $config_smtp['Destinatarios'];
	
					$dest_arr = explode(',',$destinatarios);
					foreach ($dest_arr as $key => $value){
						envia_email('Novo Cliente',$conteudo,$value);
					}       
	
					  
					echo 1;
					exit;  
				}else{
					echo 0;   
					exit; 
				}     
			}

		}else if(isset($_POST['Tipo']) && $_POST['Tipo']=='Ajuda'){     
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


			$id = Insert('INSERT INTO `duvida_cliente`(`Titulo`,`Email`,`Duvida`) VALUES ("'.$Nome.'","'.$Email.'","'.$Duvida.'")');      
			if($id!=0){    

				$conteudo = '<tr>
					<td style="background-color: #fff; line-height: 1.7; padding: 50px 30px 75px 30px; font-size: 16px; color: #646464; font-family:Arial,Helvetica,sans-serif;">
						Olá, uma nova dúvida:<br>
						<span>Nome:</span> '.$Nome.'<br>
						<span>Email:</span> '.$Email.'<br>
						<span>Dúvida:</span> '.$Duvida.'<br>
						<span><a href="'.$Config['Url'].'gerenciar.php?1=duvida_cliente&2='.$id.'">ver no sistema</a></span>                
						</td> 
					</tr>';     

					$config_smtp = Query('SELECT * FROM configuracao_smtp WHERE Ativo = 1 ORDER BY Configuracao_smtp DESC LIMIT 1',1);
					$destinatarios = $config_smtp['Destinatarios'];

					$dest_arr = explode(',',$destinatarios);
					foreach ($dest_arr as $key => $value){
						envia_email('Duvida no Site',$conteudo,$value);
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


		

