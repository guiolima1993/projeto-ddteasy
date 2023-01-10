<?php $_news = true ?>
<?php include('header.php'); ?>

<div class="background-help">
   

  <div class="accordion-help d-flex flex-column m-auto pb-4" id="accordion" #topTitle>
  <?php  
    $first = 1;    
    $q = Query('SELECT * FROM ajuda WHERE Ativo = 1 ORDER BY Ajuda ASC LIMIT 20',0);
    if(mysqli_num_rows($q) > 0){
        while($r = mysqli_fetch_assoc($q)){
  ?>
    <div class="card">
      <div class="card-header d-flex flex-row" id="heading<?php echo $r['Ajuda']   ?>">
        <h5 class="mb-0 mt-0 w-100">
          <button class="btn btn-link w-100" data-toggle="collapse" data-target="#collapse<?php echo $r['Ajuda']   ?>" aria-expanded="true" aria-controls="collapse<?php echo $r['Ajuda']   ?>">
            <?php echo $r['Titulo'];     ?>
            <img src="images/ddteasy-images/chevron-down-outline.svg" alt="icon-arrow">
          </button>

        </h5>
      </div>

      <div id="collapse<?php echo $r['Ajuda']   ?>" class="collapse <?php  if($first){  ?>show<?php  }  ?>" aria-labelledby="heading<?php echo $r['Ajuda']   ?>" data-parent="#accordion">
        <div class="card-body">
          <?php echo $r['Resposta'];     ?>
        </div>
      </div>
    </div>
  <?php $first = 0; }  }  ?>
  </div>

  <div class="contact-us">
    <form action="requisicoes/envia-contato.php" class="needs-validation form-submit" id="form-ajuda">
    <input type="hidden" name="Tipo" value="Ajuda">
    <div class="question">
      <h2>Não encontrou o que procurava?</h2>
    </div>
    <div class="contact">
      <p>Entre em contato com o nosso pessoal!</p>
    </div>

    <div class="background-inputs d-flex flex-column">
      <label class="">Nome</label>
      <div class="input-default input-contact input-size mb-3">
        <input type="text" placeholder="Nome" name="Nome">
      </div>
    </div>

    <div class="background-inputs d-flex flex-column">
      <label class="">Email</label>
      <div class="input-default input-contact input-size mb-3">
        <input type="email" placeholder="Email" name="Email">
      </div>
    </div>

    <div class="background-inputs d-flex flex-column">
      <label class="">Duvida</label>
      <div class="input-default input-contact mb-3">
        <textarea class="question-field" name="Duvida" placeholder="Escreva sua duvida..." rows="3"></textarea>
      </div>  
    </div>

    <div class="button-help d-flex justify-content-center mb-3">
      <button type="submit" class="btn">Enviar</button>
    </div>
  </form>
  </div>


</div>

<?php include('footer.php'); ?>

</body>

</html>