<?php $_news = true ?>
<?php include('header.php'); 


  $r = '';

  $q = Query('SELECT * FROM sobre_nos WHERE Ativo = 1 ORDER BY Sobre_nos DESC LIMIT 1',0);
  if(mysqli_num_rows($q) > 0){
    $r = mysqli_fetch_assoc($q);
  }else{
    goHome();
  }



?>


<!--Banner imagens/sobre_nos/1800/<?php //echo $r['Banner'];    ?> -->
<div class="about-content background-all">
  <div class="banner-img" #topTitle>
    <div class="container">
      <h2 class="banner-tittle col-md-12 animated fadeInDown"><?php echo $r['Titulo'];    ?></h2>
      <p class="banner-subtittle col-md-12 animated fadeInDown"><?php echo $r['Resumo'];    ?></p>
    </div>
  </div>
</div>

<div class="container">
  <div class="textbox-back">
    <div class="text-about container">
      <p><?php echo html_entity_decode($r['Texto']);    ?></p>
    </div>
    <div class="container">
      <h2 class="services">SERVIÇOS</h2>
      <div class="about-content">
        <p class="text-services"><?php echo html_entity_decode($r['Texto_servicos']);    ?></p>
        <div class="container col-md-4">
          <img src="<?php  echo $Config['UrlSite'];   ?>imagens/sobre_nos/1000/<?php echo $r['Imagem_servicos'];    ?>" alt="Trabalhador DDTeasy" class="worker-ddteasy">
        </div>
      </div>
    </div>
  </div>
</div>
<div>
  <div>
    <div class="security">
      <div class="container">
        <h2 class="tittle-security">SEGURANÇA E EFICIÊNCIA</h2>
        <div class="about-content">
          <div class="container col-md-4">
            <img src="<?php  echo $Config['UrlSite'];   ?>imagens/sobre_nos/1000/<?php echo $r['Imagem_seguranca'];    ?>" alt="Trabalhador DDTeasy" class="security-img">
          </div>
          <p class="text-security"><?php echo html_entity_decode($r['Texto_seguranca']);    ?></p>
        </div>
      </div>
    </div>
  </div>

</div>


<?php include('footer.php'); ?>

</body>

</html>