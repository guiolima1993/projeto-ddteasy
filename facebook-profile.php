<?php 
include('./sistema/config/config.php');  

$q = Query("SELECT * FROM cliente WHERE Email = '".$_SESSION['fb_email']."'");
if (mysqli_num_rows($q) > 0) {
    $r = mysqli_fetch_assoc($q);

    $contador = $r['Contador'] + 1;
    Query('UPDATE cliente SET Contador =  '.$contador.' where Cliente = '.$r['Cliente'].'',0);
    $_SESSION['Cliente'] = $r['Cliente'];
} else {
    Query("INSERT INTO cliente(Titulo, Email) VALUES(".$_SESSION['fb_name'].", ".$_SESSION['fb_email'].")", 0);
    $q = Query("SELECT * FROM cliente WHERE Email = '.$Email.'");
    $r = mysqli_fetch_assoc($q);
    $_SESSION['Cliente'] = $r['Cliente'];
}
Header('Location: minha-conta.php');
?>