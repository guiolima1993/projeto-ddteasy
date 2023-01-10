<?php $_works = true ?>
<?php include('header.php');
  $r = '';

  $q = Query('SELECT * FROM como_funciona WHERE Ativo = 1 ORDER BY Como_funciona DESC LIMIT 1',0);
  if(mysqli_num_rows($q) > 0){
    $r = mysqli_fetch_assoc($q);
  }else{
    goHome();
  }



 ?>

<div class="background-work">
  <div #TopTitle></div>
  <div class="container">
    <div class="card-deck">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="icons">
              <h2>1</h2>
            </div>
            <h5 class="steps-tittle">Passo um</h5>
          </div>
          <p class="steps-text"><?php echo $r['Passo_1'];   ?></p>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="icons">
              <h2>2</h2>
            </div>
            <h5 class="steps-tittle">Passo dois</h5>
          </div>
          <p class="steps-text"><?php echo $r['Passo_2'];   ?></p>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="icons">
              <h2>3</h2>
            </div>
            <h5 class="steps-tittle">Passo Três</h5>
          </div>
          <p class="steps-text"><?php echo $r['Passo_3'];   ?></p>
        </div>
      </div>
    </div>

  </div>

  <div class="button-make-simulation mb-4 w-50">
    <a href="<?php echo $Config['UrlSite'];   ?>" class="btn">
      <span>Faça uma cotação</span>
    </a>
  </div>

  <div class="background-question">

    <div class="container">
      <h3 class="question-tittle"><?php echo $r['Titulo_duvida_passo'];   ?></h3>
      <p class="text-question"><?php echo $r['Duvida_passo'];   ?> <a href="help.php">Aqui.</a></p>

    </div>
  </div>
</div>


<?php include('footer.php'); ?>

</body>

</html>