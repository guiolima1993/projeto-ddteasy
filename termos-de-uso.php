<?php $_home = true ?>
<?php include('header.php'); 

  $r = '';

  $q = Query('SELECT * FROM termos_de_uso WHERE Ativo = 1 ORDER BY Termos_de_uso DESC LIMIT 1',0);
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
      <p><?php  echo html_entity_decode($r['Texto']);  ?>
      </p>
    </div>
  </div>
</div>


<?php include('footer.php'); ?>

</body>

</html>