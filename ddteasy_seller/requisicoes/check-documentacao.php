<?php  include('../../sistema/config/config.php');



       
	if(isset($_SESSION['Parceiro']) && $_SESSION['Parceiro']!=0){
		
			    
		$q = Query('SELECT * FROM documento WHERE  Parceiro = '.$_SESSION['Parceiro'].'',0);


		if(mysqli_num_rows($q) >= 3){
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