<?php   $connection = mysql_connect("bdantigo.mysql.dbaas.com.br","bdantigo","Conte@7735BD")or die(mysql_error("não conectado"));
		$db = mysql_select_db("bdantigo", $connection)or die(mysql_error("não conectado"));