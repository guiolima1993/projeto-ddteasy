<?php include('../../sistema/config/config.php');

	    if(!isset($_SESSION['Sis545IdUsuario'])){
        session_destroy();
        header("Location: ".$Config['Url']."login.php");
        exit;
    }



		if(isset($_POST['Titulo']) && $_POST['Titulo']!=""){
			$Titulo = clean($_POST['Titulo']);
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

		//2022-03-23
		if(isset($_POST['Atualizacao']) && $_POST['Atualizacao']!=""){
			$Atualizacao = clean($_POST['Atualizacao']);
		}else{
			echo 0;
			exit;
		}

		if(isset($_POST['Status']) && $_POST['Status']!=""){
			$Status = clean($_POST['Status']);
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



		$q = Query('SELECT * from material_de_apoio WHERE Titulo = "'.$Titulo.'"',0);
		if(mysqli_num_rows($q)==0){
			$id = Insert('INSERT INTO material_de_apoio(Titulo,Servico,Data,Resumo,Ativo) VALUES("'.$Titulo.'",'.$Tipo_servico.',"'.$Atualizacao.'","'.$Descricao.'","'.$Status.'")');
		
			if($id!=0){



			if(isset($_FILES['Icone']['tmp_name']) && ($_FILES['Icone']['tmp_name']!='') && ($_FILES['Icone']['type']!='application/octet-stream')){ 

		            $destino = '../../imagens/material_de_apoio/';

		            if(!is_dir($destino)){
		            	mkdir($destino);
		            } 
      
		  			$destino = '../../imagens/material_de_apoio/';

		            if(!is_dir($destino)){
		            	mkdir($destino);
		            } 

		            $name_aux = explode('.',$_FILES['Icone']['name']);   
		            $ext = end($name_aux); 
		            $better_token = md5(uniqid(rand(),true));
		            $new_name = $better_token.'.'.$ext;  
		            $destino .= $new_name;
		            
		            if(move_uploaded_file($_FILES['Icone']['tmp_name'],$destino)){  

		                Query('UPDATE material_de_apoio SET Arquivo = "'.$new_name.'" WHERE Material_de_apoio = '.$id.''); 
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