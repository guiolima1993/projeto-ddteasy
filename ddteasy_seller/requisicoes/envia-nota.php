<?php  include('../../sistema/config/config.php');




		if(isset($_POST['Servico_prestado']) && $_POST['Servico_prestado']!=''){

				$id = clean($_POST['Servico_prestado']);

		        if(isset($_FILES['Upload']['tmp_name']) && ($_FILES['Upload']['tmp_name']!='') && ($_FILES['Upload']['type']!='application/octet-stream')){     
		            $destino = '../../imagens/servico_prestado/';

		           


		            if(!is_dir($destino)){
		            	mkdir($destino);
		            } 
      
		  			$destino = '../../imagens/servico_prestado/';

		            if(!is_dir($destino)){
		            	mkdir($destino);
		            } 

		            $name_aux = explode('.',$_FILES['Upload']['name']);   
		            $ext = end($name_aux); 
		            $better_token = md5(uniqid(rand(),true));
		            $new_name = $better_token.'.'.$ext;  
		            $destino .= $new_name;
		            
		            if(move_uploaded_file($_FILES['Upload']['tmp_name'],$destino)){  

		                Query('UPDATE servico_prestado SET Arquivo_nota_fiscal = "'.$new_name.'" WHERE Servico_prestado = '.$id.''); 
		                echo 1;
						exit; 
		            }
		              
		        }   

		
			
								
										
		}


echo 0;
exit;