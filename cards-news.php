<?php $_home = true ?>
<?php include('header.php'); 

  
  $url = '';
  if(isset($_GET[1]) && $_GET[1]!=''){
    $url = clean($_GET[1]);
  }else{
    goHome();
  }

  $q = Query('SELECT * FROM blog WHERE Url = "'.$url.'" AND Ativo = 1',0);
  if(mysqli_num_rows($q) > 0){
    $r = mysqli_fetch_assoc($q);
  }else{
    goHome();
  }



?>

<div class="cards-news">
  <div class="container">
    <h3><?php  echo $r['Titulo'];   ?></h3>
    <div class="img-news">
      <img src="<?php  echo $Config['UrlSite'];   ?>imagens/blog/1000/<?php  echo $r['Imagem_interna'];   ?>" alt="<?php  echo $r['Titulo'];   ?>">
    </div>
    <div>
      <p><?php  echo html_entity_decode($r['Texto']);   ?></p>
    </div>

    <div class="btn-voltar">
      <a href=""><img src="images/arrow-back-circle-outline.svg" alt="Botão Voltar"><span> Voltar</span></a>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

</body>

</html>