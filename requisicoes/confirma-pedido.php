<?php  include('../sistema/config/config.php');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
	$id    = "";
	$valor = "";

	if(isset($_POST['id']) && $_POST['id']!=''){
		$id = clean($_POST['id']);
	}else{
		echo 0;
		exit;
	}


	if(isset($_POST['Valor']) && $_POST['Valor']!=''){
		$valor = clean($_POST['Valor']);
	}else{
		echo 0;
		exit;
	}

	if($_SESSION['Parceiro_orcamento']){

		if(isset($_SESSION['Servico_id'])){
     		$_SESSION['Servico_id'][] = $id;
     	}else{
     		$_SESSION['Servico_id'] = array();
     		$_SESSION['Servico_id'][] = $id;
     	}


     	if(isset($_SESSION['Valor_Servico'])){
     		$_SESSION['Valor_Servico'][] = $valor;
     	}else{
     		$_SESSION['Valor_Servico'] = array();
     		$_SESSION['Valor_Servico'][] = $valor;
     	}

     	//Array ( [Sis545IdUsuario] => 1 [Sis545Nome] => admin [Nivel] => 1 [id] => 1 [email] => lucas@makeweb.com.br [Cliente] => 1 [cep] => 18090-450 [Servico_id] => Array ( ) [servico_id] => 2 [Tipo_de_praga] => Array ( [0] => 2 [1] => 3 [2] => 4 ) [Numero_de_pragas] => 3 [Tipo_imovel] => Apartamento [Tamanho_imovel] => [Dormitorios] => 3 [Parceiro_orcamento] => 1 [Valor_Servico] => Array ( ) )

     	$insert_id = 0;

     	if(isset($_SESSION['Cliente']) && $_SESSION['Cliente']!=''){

  			$insert_id = Insert('INSERT INTO servico_prestado(Parceiro,Servico,Cliente,Valor,Data_abertura,Tipo_imovel,Cep,Valor_total) VALUES('.$_SESSION['Parceiro_orcamento'].','.$id.','.$_SESSION['Cliente'].',"'.$valor.'",NOW(),'.$_SESSION['Tipo_imovel'].','.$_SESSION['Cep'].',"'.$valor.'")');
	  		if($insert_id!=0){
	  			
	  			foreach ($_SESSION['Tipo_de_praga'] as $k_praga => $v_praga) {
	  				Query('INSERT INTO praga_cotacao(Praga,Servico_prestado) VALUES('.$v_praga.','.$insert_id.')');
	  			}    

	  			echo 1;    
		  		exit; 
	  		}else{
	  			echo 0;
		  		exit;
	  		}

	    }else{
		  	echo 2;
		  	exit;
		}

		
	}





        

