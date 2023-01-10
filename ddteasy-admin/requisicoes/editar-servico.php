<?php include('../../sistema/config/config.php');


	    if(!isset($_SESSION['Sis545IdUsuario'])){
        session_destroy();
        header("Location: ".$Config['Url']."login.php");
        exit;
    }


	//editar
	if(isset($_POST['id']) && $_POST['id']!=""){
		$id = clean($_POST['id']);


		if(isset($_POST['Titulo']) && $_POST['Titulo']!=""){
			$Titulo = clean($_POST['Titulo']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Categoria']) && $_POST['Categoria']!=""){
			$Categoria = clean($_POST['Categoria']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Licenca']) && $_POST['Licenca']!=""){
			$Licenca = clean($_POST['Licenca']);
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
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Tipo_de_servico']) && $_POST['Tipo_de_servico']!=""){
			$Tipo_de_servico = clean($_POST['Tipo_de_servico']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Servico_mae_dedetizacao']) && $_POST['Servico_mae_dedetizacao']!=""){
			$Servico_mae_dedetizacao = clean($_POST['Servico_mae_dedetizacao']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Servico_mae_dedetizacao_premium']) && $_POST['Servico_mae_dedetizacao_premium']!=""){
			$Servico_mae_dedetizacao_premium = clean($_POST['Servico_mae_dedetizacao_premium']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Servico_mae_sanitizacao_premium']) && $_POST['Servico_mae_sanitizacao_premium']!=""){
			$Servico_mae_sanitizacao_premium = clean($_POST['Servico_mae_sanitizacao_premium']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Servico_mae_sanitizacao']) && $_POST['Servico_mae_sanitizacao']!=""){
			$Servico_mae_sanitizacao = clean($_POST['Servico_mae_sanitizacao']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Descricao']) && $_POST['Descricao']!=""){
			$Descricao = clean($_POST['Descricao']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Tipo_licensa']) && $_POST['Tipo_licensa']!=""){
			$Tipo_licensa = clean($_POST['Tipo_licensa']);
		}else{
			echo 0;
			exit;
		}
   

		$q = Query('SELECT * from servico WHERE Servico = "'.$id.'"',0);
		if(mysqli_num_rows($q) > 0){
			Query('UPDATE servico SET Preco_minimo  = "'.$Preco.'",Titulo  = "'.$Titulo.'",Categoria  = "'.$Categoria.'",Ativo =  '.$Situacao.',Exige_licensa = '.$Licenca.',Servico_mae_dedetizacao = '.$Servico_mae_dedetizacao.',Servico_mae_dedetizacao_premium = '.$Servico_mae_dedetizacao_premium.',Servico_mae_sanitizacao_premium = '.$Servico_mae_sanitizacao_premium.',Servico_mae_sanitizacao = '.$Servico_mae_sanitizacao.',Resumo  = "'.$Descricao.'",Tipo_de_servico = '.$Tipo_de_servico.',Tipo_de_licensa = "'.$Tipo_licensa.'" WHERE Servico = '.$id.'',0);


				if(isset($_FILES['Icone']['tmp_name']) && ($_FILES['Icone']['tmp_name']!='') && ($_FILES['Icone']['type']!='application/octet-stream')){ 

		            $destino = '../../imagens/servico/64/';

		           


		            if(!is_dir($destino)){
		            	mkdir($destino);
		            } 
      
		  			$destino = '../../imagens/servico/64/';

		            if(!is_dir($destino)){
		            	mkdir($destino);
		            } 

		            $name_aux = explode('.',$_FILES['Icone']['name']);   
		            $ext = end($name_aux); 
		            $better_token = md5(uniqid(rand(),true));
		            $new_name = $better_token.'.'.$ext;  
		            $destino .= $new_name;
		            
		            if(move_uploaded_file($_FILES['Icone']['tmp_name'],$destino)){  

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


	

	//inserir ?
	}else{


		if(isset($_POST['Titulo']) && $_POST['Titulo']!=""){
			$Titulo = clean($_POST['Titulo']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Categoria']) && $_POST['Categoria']!=""){
			$Categoria = clean($_POST['Categoria']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Licenca']) && $_POST['Licenca']!=""){
			$Licenca = clean($_POST['Licenca']);
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
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Tipo_de_servico']) && $_POST['Tipo_de_servico']!=""){
			$Tipo_de_servico = clean($_POST['Tipo_de_servico']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Servico_mae_dedetizacao']) && $_POST['Servico_mae_dedetizacao']!=""){
			$Servico_mae_dedetizacao = clean($_POST['Servico_mae_dedetizacao']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Servico_mae_dedetizacao_premium']) && $_POST['Servico_mae_dedetizacao_premium']!=""){
			$Servico_mae_dedetizacao_premium = clean($_POST['Servico_mae_dedetizacao_premium']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Servico_mae_sanitizacao_premium']) && $_POST['Servico_mae_sanitizacao_premium']!=""){
			$Servico_mae_sanitizacao_premium = clean($_POST['Servico_mae_sanitizacao_premium']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Servico_mae_sanitizacao']) && $_POST['Servico_mae_sanitizacao']!=""){
			$Servico_mae_sanitizacao = clean($_POST['Servico_mae_sanitizacao']);
		}else{
			echo 0;
			exit;
		}


		if(isset($_POST['Descricao']) && $_POST['Descricao']!=""){
			$Descricao = clean($_POST['Descricao']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Tipo_licensa']) && $_POST['Tipo_licensa']!=""){
			$Tipo_licensa = clean($_POST['Tipo_licensa']);
		}else{
			echo 0;
			exit;
		}

		


		$q = Query('SELECT * from servico WHERE Titulo = "'.$Titulo.'"',0);
		if(mysqli_num_rows($q)==0){
			$id = Insert('INSERT INTO servico(Titulo,Categoria,Ativo,Exige_licensa,Preco_minimo,Servico_mae_dedetizacao,Servico_mae_dedetizacao_premium,Servico_mae_sanitizacao_premium,Servico_mae_sanitizacao,Resumo,Tipo_de_servico,Tipo_de_licensa) VALUES("'.$Titulo.'","'.$Categoria.'",'.$Situacao.','.$Licenca.',"'.$Preco.'",'.$Servico_mae_dedetizacao.','.$Servico_mae_dedetizacao_premium.','.$Servico_mae_sanitizacao_premium.','.$Servico_mae_sanitizacao.',"'.$Descricao.'",'.$Tipo_de_servico.',"'.$Tipo_licensa.'")');
		
			if($id!=0){



			if(isset($_FILES['Icone']['tmp_name']) && ($_FILES['Icone']['tmp_name']!='') && ($_FILES['Icone']['type']!='application/octet-stream')){ 

		            $destino = '../../imagens/servico/64/';

		           


		            if(!is_dir($destino)){
		            	mkdir($destino);
		            } 
      
		  			$destino = '../../imagens/servico/64/';

		            if(!is_dir($destino)){
		            	mkdir($destino);
		            } 

		            $name_aux = explode('.',$_FILES['Icone']['name']);   
		            $ext = end($name_aux); 
		            $better_token = md5(uniqid(rand(),true));
		            $new_name = $better_token.'.'.$ext;  
		            $destino .= $new_name;
		            
		            if(move_uploaded_file($_FILES['Icone']['tmp_name'],$destino)){  

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

		}
		
	}

	$id =  0;


