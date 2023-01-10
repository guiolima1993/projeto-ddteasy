<?php include('../../sistema/config/config.php');

    if(!isset($_SESSION['Sis545IdUsuario'])){
        session_destroy();
        header("Location: ".$Config['Url']."login.php");
        exit;
    }

   /* if(isset($_POST['Servico_nome']) && $_POST['Servico_nome']!=""){
		$Servico_nome = clean($_POST['Servico_nome']);
	}else{
		echo 0;
		exit;
	}

    if(isset($_POST['Tipo_categoria']) && $_POST['Tipo_categoria']!=""){
		$Tipo_categoria = clean($_POST['Tipo_categoria']);
	}else{
		echo 0;
		exit;
	}

    if(isset($_POST['Licenca']) && $_POST['Licenca']!=""){

		$Licenca = clean($_POST['Licenca']);

		if($Licenca=='Nao'){
			$Licenca = 0;
		}else{
			$Licenca = 1;
		}

	}else{
		echo 0;
		exit;
	}

    if(isset($_POST['Tipo_licenca']) && $_POST['Tipo_licenca']!=""){
		$Tipo_licenca = clean($_POST['Tipo_licenca']);
	}

    if(isset($_POST['Preco']) && $_POST['Preco']!=""){
		$Preco = clean($_POST['Preco']);
	}else{
		echo 0;
		exit;
	}

    if(isset($_POST['Situacao']) && $_POST['Situacao']!=""){
		$Situacao = clean($_POST['Situacao']);
		if($Situacao=='Habilitado'){
			$Situacao = 1;
		}else{
			$Situacao = 0;
		}
	}else{
		echo 0;
		exit;
	}

    if(isset($_POST['Tipo_servico']) && $_POST['Tipo_servico']!=""){
		$Tipo_servico = clean($_POST['Tipo_servico']);
	}else{
		echo 0;
		exit;
	}

    if(isset($_POST['Servico_pai']) && $_POST['Servico_pai']!=""){
		$Servico_pai = clean($_POST['Servico_pai']);
	}



    if(isset($_POST['Descricao_servico']) && $_POST['Descricao_servico']!=""){
		$Descricao_servico = clean($_POST['Descricao_servico']);
	}else{
		echo 0;
		exit;
	}
	*/



		if(isset($_POST['Servico_nome']) && $_POST['Servico_nome']!=""){
			$Servico_nome = clean($_POST['Servico_nome']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Tipo_categoria']) && $_POST['Tipo_categoria']!=""){
			$Categoria = clean($_POST['Tipo_categoria']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Licenca']) && $_POST['Licenca']!=""){
			
			$Licenca = clean($_POST['Licenca']);

			if($Licenca=='Nao'){
				$Licenca = 0;
			}else{
				$Licenca = 1;
			}


		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Preco']) && $_POST['Preco']!=""){
			$Preco = clean($_POST['Preco']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Situacao']) && $_POST['Situacao']!=""){
				
			$Situacao = clean($_POST['Situacao']);

			if($Situacao=='Habilitado'){
				$Situacao = 1;
			}else{
				$Situacao = 0;
			}

		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Tipo_servico']) && $_POST['Tipo_servico']!=""){
			$Tipo_de_servico = clean($_POST['Tipo_servico']);
		}else{
			echo 0;
			exit;
		}


		$Servico_mae_dedetizacao = 0;
		if(isset($_POST['Servico_mae_dedetizacao']) && $_POST['Servico_mae_dedetizacao']!=""){
			$Servico_mae_dedetizacao = clean($_POST['Servico_mae_dedetizacao']);
		}

		$Servico_mae_dedetizacao_premium = 0;
		if(isset($_POST['Servico_mae_dedetizacao_premium']) && $_POST['Servico_mae_dedetizacao_premium']!=""){
			$Servico_mae_dedetizacao_premium = clean($_POST['Servico_mae_dedetizacao_premium']);
		}

		$Servico_mae_sanitizacao_premium = 0;
		if(isset($_POST['Servico_mae_sanitizacao_premium']) && $_POST['Servico_mae_sanitizacao_premium']!=""){
			$Servico_mae_sanitizacao_premium = clean($_POST['Servico_mae_sanitizacao_premium']);
		}

		$Servico_mae_sanitizacao = 0;
		if(isset($_POST['Servico_mae_sanitizacao']) && $_POST['Servico_mae_sanitizacao']!=""){
			$Servico_mae_sanitizacao = clean($_POST['Servico_mae_sanitizacao']);
		}



		if(isset($_POST['Descricao_servico']) && $_POST['Descricao_servico']!=""){
			$Descricao_servico = clean($_POST['Descricao_servico']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Tipo_licensa']) && $_POST['Tipo_licensa']!=""){
			$Tipo_licensa = clean($_POST['Tipo_licensa']);
		}

	$id = 0; 





	$id = Insert('INSERT INTO servico(Titulo,Preco_minimo,Exige_licensa,Resumo,Categoria,Ativo,Servico_mae_dedetizacao,Servico_mae_dedetizacao_premium,Servico_mae_sanitizacao_premium,Servico_mae_sanitizacao) VALUES("'.$Servico_nome.'","'.$Preco.'","'.$Licenca.'","'.$Descricao_servico.'","'.$Tipo_categoria.'",'.$Situacao.','.$Servico_mae_dedetizacao.','.$Servico_mae_dedetizacao_premium.','.$Servico_mae_sanitizacao_premium.','.$Servico_mae_sanitizacao.')',0);
	
	if($id!=0){

			if(isset($_FILES['Foto_icone']['tmp_name']) && ($_FILES['Foto_icone']['tmp_name']!='') && ($_FILES['Foto_icone']['type']!='application/octet-stream')){ 

		  			$destino = '../../imagens/servico/64/';

		            if(!is_dir($destino)){
		            	mkdir($destino);
		            } 

		            $name_aux = explode('.',$_FILES['Foto_icone']['name']);   
		            $ext = end($name_aux); 
		            $better_token = md5(uniqid(rand(),true));
		            $new_name = $better_token.'.'.$ext;  
		            $destino .= $new_name;
		            
		            if(move_uploaded_file($_FILES['Foto_icone']['tmp_name'],$destino)){  

		                Query('UPDATE servico SET Icone = "'.$new_name.'" WHERE Servico = '.$id.''); 
		                echo 1;
						exit; 
		            }
		              
		        } 

		echo 1;
    	exit;
	}else{
		echo 0;
		exit;
	}

