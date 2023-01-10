<?php include('../sistema/config/config.php');
	  session_destroy();
	  echo '<script>document.location="'.$Config['UrlSite'].'sistema-login.php";</script>';
	  exit;