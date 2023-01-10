<?php  include('../../sistema/config/config.php');


		$id_seller = 0;
		if(isset($_SESSION['Parceiro']) && $_SESSION['Parceiro']!=''){
			$id_seller = clean($_SESSION['Parceiro']);
		}else{
			echo 0;
			exit;
		}


		$tipo_documento = 0;
		if(isset($_POST['Tipo_documento']) && $_POST['Tipo_documento']!=''){
			$tipo_documento = clean($_POST['Tipo_documento']);
		}else{
			echo 0;
			exit;
		}

  
		$curriculo = '';   

        if(isset($_FILES['Arquivo']['tmp_name']) && ($_FILES['Arquivo']['tmp_name']!='') && ($_FILES['Arquivo']['type']!='application/octet-stream')){     
            $destino = '../../imagens/documento/';

            if(!is_dir($destino)){
            	mkdir($destino);
            } 

  			$destino = '../../imagens/documento/';

            if(!is_dir($destino)){
            	mkdir($destino);
            } 

            $name_aux = explode('.',$_FILES['Arquivo']['name']);   
            $ext = end($name_aux); 
            $better_token = md5(uniqid(rand(),true));
            $new_name = $better_token.'.'.$ext;  
            $destino .= $new_name;
            
            if(move_uploaded_file($_FILES['Arquivo']['tmp_name'],$destino)){    
                Query('INSERT INTO documento(Arquivo,Tipo_documento,Parceiro,Data,Data_validade) VALUES ("'.$new_name.'",'.$tipo_documento.','.$id_seller.',NOW(),DATE_ADD(NOW(), INTERVAL 1 YEAR) )');  
                echo 1;
				exit;
            }
              
        }   
 
									
									
								
										


echo 0;
exit;