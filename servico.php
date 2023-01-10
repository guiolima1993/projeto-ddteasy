<?php $_home = true ?>
<?php include('header.php'); 

  $url = '';
  if(isset($_GET[1]) && $_GET[1]!=''){
    $url = clean($_GET[1]);
  }else{
    goHome();
  }


  $q = Query('SELECT * FROM servico WHERE Url = "'.$url.'" AND Ativo = 1 ORDER BY Servico DESC LIMIT 1');
  if(mysqli_num_rows($q) > 0){
    $r = mysqli_fetch_assoc($q);
  }else{
    goHome();
  }


?>

<section class="dedetizacao-all">

  <div class="container">

    <div class="tittle">
      <div class="ask-circle">
        <p>?</p>
      </div>
      <h3><?php echo $r['Titulo'];    ?></h3>
    </div>
    <p>

     <?php echo html_entity_decode($r['Texto_1']);    ?>
      <img src="<?php echo $Config['UrlSite'];  ?>imagens/servico/1000/<?php echo $r['Imagem'];   ?>" class="img-svc">
      <?php echo html_entity_decode($r['Texto_2']);    ?>

    </p>

    <div class="button-make-simulation mt-3 mb-4 w-50">
      <a href="#" class="btn">
        <span>Faça uma cotação</span>
      </a>
    </div>
  </div>
  </div>
</section>


<?php include('footer.php'); ?>

</body>

</html>