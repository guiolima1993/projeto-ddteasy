<?php header('Content-Type: application/json; charset=utf-8');  
include('../sistema/config/config.php');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
	
	$id    = "";
	$valor = "";
	$datas['Data_ocupado'] =  array(); 

	if(isset($_GET['id']) && $_GET['id']!=''){
		$id = clean($_GET['id']);
	}else{
		echo 0;
		exit;
	}


   $q = Query('SELECT Data FROM servico_prestado WHERE Parceiro = '.$id.'',0);
   if(mysqli_num_rows($q) > 0){
   		while($r = mysqli_fetch_assoc($q)){
   			$datas['Data_ocupado'][] = $r['Data'];
   		}
   }


   echo json_encode($datas);
   exit;