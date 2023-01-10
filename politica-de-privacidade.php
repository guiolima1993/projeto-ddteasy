<?php $_home = true ?>
<?php include('header.php'); 
  
    $r = '';

  $q = Query('SELECT * FROM politica_de_privacidade WHERE Ativo = 1 ORDER BY Politica_de_privacidade DESC LIMIT 1',0);
  if(mysqli_num_rows($q) > 0){
    $r = mysqli_fetch_assoc($q);
  }else{
    goHome();
  }



?>

<div class="politica-e-termos">
  <div class="container">
    <div class="text">
      <h3><?php  echo $r['Titulo'];  ?></h3>
      <p><?php  echo html_entity_decode($r['Texto']);  ?></p>
    </div>
  </div>
</div>


<?php include('footer.php'); ?>

</body>

</html>