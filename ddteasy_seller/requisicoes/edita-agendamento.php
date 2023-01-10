<?php  include('../../sistema/config/config.php');

	
	$Data_start = "";
	$Data_end = "";


	if(isset($_GET['id']) && $_GET['id']!=''){
		$id = clean($_GET['id']);
	}else{
		echo 0;
		exit;
	}


	if(isset($_GET['Data']['data_start']) && $_GET['Data']['data_start']!=''){
		$Data_start = clean($_GET['Data']['data_start']);

		$Data_aux_0 = explode(' ',$Data_start);
		$Data_aux_1 = explode('/',$Data_aux_0[0]);
		$Data_start = $Data_aux_1[2].'-'.$Data_aux_1[1].'-'.$Data_aux_1[0].' '.$Data_aux_0[1];


	}else{
		echo 0;
		exit;   
	}
   

	if(isset($_GET['Data']['data_end']) && $_GET['Data']['data_end']!=''){
		$Data_end = clean($_GET['Data']['data_end']);

		$Data_aux_0 = explode(' ',$Data_end);
		$Data_aux_1 = explode('/',$Data_aux_0[0]);
		$Data_end = $Data_aux_1[2].'-'.$Data_aux_1[1].'-'.$Data_aux_1[0].' '.$Data_aux_0[1];
	}else{
		echo 0;
		exit;   
	}
           
	$q = Query('SELECT * FROM servico_prestado WHERE  Parceiro = '.$_SESSION['Parceiro'].' AND Servico_prestado = '.$id.'',0);
	
	if(mysqli_num_rows($q) > 0){

		Query('UPDATE servico_prestado set Data_agendamento = "'.$Data_start.'",Data_agendamento_fim = "'.$Data_end.'" WHERE Servico_prestado = '.$id.'');
		echo 1;
		exit;
	}else{
		echo 0;
		exit;
	}
        

