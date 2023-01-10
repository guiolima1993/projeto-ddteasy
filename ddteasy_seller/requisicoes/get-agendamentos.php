<?php  include('../../sistema/config/config.php');


	$resposta = array();
	$q = "";

	$q = Query('SELECT * FROM servico_prestado WHERE  Parceiro = '.$_SESSION['Parceiro'].' ORDER BY Servico_prestado DESC',0);

	if(mysqli_num_rows($q) > 0){
		while($r = mysqli_fetch_assoc($q)){
			
			$resp = array();      

			//id do agendamento
			$resp['id'] = $r['Servico_prestado'];
			
			//nome do cliente
			$resp['title'] = $r['Nome_responsavel'];

			$resp['start'] = $r['Data_abertura'];
			$resp['end'] = $r['Data_abertura'];
			$resp['category'] = "allday";

			$resposta[] = $resp;
		}
	}
        

	echo json_encode($resposta);
	exit;