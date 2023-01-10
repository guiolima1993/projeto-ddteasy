<?php $_news = true ?>
<?php include('header.php'); 

      
      $_SESSION['Parceiro_orcamento'] = clean($_GET[1]);



      $q_p = Query('SELECT * FROM parceiro WHERE Ativo = 1 AND Parceiro = '.clean($_GET[1]).' ORDER BY Parceiro DESC  LIMIT 1',0);

      if(mysqli_num_rows($q_p) > 0){
        $r = mysqli_fetch_assoc($q_p);
      }else{
        goHome();
      }

  $q_avaliacao = Query('SELECT * FROM avaliacao WHERE Parceiro = '.$r['Parceiro'].'');
  $n_avalia = mysqli_num_rows($q_avaliacao);

?>

<div class="perfil-company">

  <div class="background-image-left">
    <img src="images/ddteasy-images/canto-1.png" alt="side-image">
  </div>

  <div class="container">
    <div class="card col-xl-3 col-md-5">
      <div class="card-body">
        <h5 class="card-title"><?php echo $r['Titulo'];     ?></h5>
        <div class="location">
          <div class="location-maps">
            <a href="https://www.google.com/search?q=ossel%20vila%20assis&oq=ossel+vila+assis&aqs=chrome..69i57j0j0i175i199j0j0i22i30l5.3095j0j7&sourceid=chrome&ie=UTF-8&tbs=lf:1,lf_ui:14&tbm=lcl&sxsrf=ALeKk00l8KU5RZQtyRgHr1qxT4RtDHQCKA:1623238764486&rflfq=1&num=10&rldimm=1554011003089827906&lqi=ChBvc3NlbCB2aWxhIGFzc2lzWhIiEG9zc2VsIHZpbGEgYXNzaXOSAQxmdW5lcmFsX2hvbWWaASRDaGREU1VoTk1HOW5TMFZKUTBGblNVUTROMXBsWWpkUlJSQUKqAQ0QASoJIgVvc3NlbCgM&ved=2ahUKEwiu9MTPu4rxAhUqJ7kGHXT7D2sQvS4wAXoECBEQQQ&rlst=f#rlfi=hd:;si:1554011003089827906,l,ChBvc3NlbCB2aWxhIGFzc2lzWhIiEG9zc2VsIHZpbGEgYXNzaXOSAQxmdW5lcmFsX2hvbWWaASRDaGREU1VoTk1HOW5TMFZKUTBGblNVUTROMXBsWWpkUlJSQUKqAQ0QASoJIgVvc3NlbCgM;mv:[[-23.4926054,-47.4467764],[-23.512426599999998,-47.461305599999996]];tbs:lrf:!1m4!1u3!2m2!3m1!1e1!1m4!1u2!2m2!2m1!1e1!2m1!1e2!2m1!1e3!2m4!1e17!4m2!17m1!1e2!3sIAE,lf:1,lf_ui:14" target="_blank"><img src="images/mapa.png" alt="Localização"></a>
          </div>
          <span>X Km de distância da sua residência</span>

        </div>
        <p class="card-text"><?php echo $r['Descritivo'];     ?></p>

        
         <?php 
              $media_r = Query('SELECT AVG(Nota) as Nota_avaliacao_geral FROM avaliacao WHERE Parceiro = '.$r['Parceiro'].'',1);
              $media   = $media_r['Nota_avaliacao_geral']; 
              $q_nota = Query('SELECT Avaliacao FROM avaliacao WHERE Parceiro = '.$r['Parceiro'].'');
              $n_avalia = mysqli_num_rows($q_nota); 
        ?>
        <span class="qtd-ratings mb-2"><?php  echo $n_avalia;  ?> avaliações</span>
        <div class="rating-company">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
                    <span class="fa fa-star <?php if($media>=1){   ?>checked<?php  }  ?>"></span>
                    <span class="fa fa-star <?php if($media>=2){   ?>checked<?php  }  ?>"></span>
                    <span class="fa fa-star <?php if($media>=3){   ?>checked<?php  }  ?>"></span>
                    <span class="fa fa-star <?php if($media>=4){   ?>checked<?php  }  ?>"></span>
                    <span class="fa fa-star <?php if($media>=5){   ?>checked<?php  }  ?>"></span>

        </div>

      </div>
    </div>


    <div class="servicos-prestados">
      <h4>Serviços Escolhidos:</h4>
      <div class="all-services">
        

      <?php  
          if(isset($_SESSION['servico_id']) && $_SESSION['servico_id']!=''){         


            $servico_title = '';

            $servico_price = '';

          if($_SESSION['servico_id']==2){
            $servico_title = 'Dedetizacao';
            $servico_price = $r['Dedetizacao_valor'];
          }else if($_SESSION['servico_id']==1){
            $servico_title = 'Sanitizacao';
            $servico_price = $r['Sanitizacao_valor'];
          }

          $_SESSION['servico_id'] = $servico_id;


      ?>
        <div class="card-servicos">
          <div class="block-text col-md-10 col-lg-9">
            <h3><?php  echo  $servico_title;   ?></h3>

            <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corrupti dicta nobis, soluta vel vero assumenda quia ea dolorum amet blanditiis. Repudiandae aperiam sint velit excepturi necessitatibus quam ad ratione?</p>

          </div>
          <div class="servicos-prices">
            <p>R$ <?php echo $servico_price;     ?></p>
          </div>
          <div class="servicos-checked">
            <input type="checkbox">
          </div>

        </div>
      <?php   }  ?>

<!--         <div class="card-servicos">
          <div class="block-text col-md-10 col-lg-9">
            <h3>Serviço 2</h3>

            <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corrupti dicta nobis, soluta vel vero assumenda quia ea dolorum amet blanditiis. Repudiandae aperiam sint velit excepturi necessitatibus quam ad ratione?</p>

          </div>


          <div class="servicos-prices">
            <p>R$ 150</p>
          </div>
          <div class="servicos-checked">
            <input type="checkbox">
          </div>
        </div> -->

        <h4>Serviços Adicionais:</h4>
        <div class="card-servicos">
          <div class="block-text col-md-10 col-lg-9">
            <h3>Serviço 1</h3>

            <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corrupti dicta nobis, soluta vel vero assumenda quia ea dolorum amet blanditiis. Repudiandae aperiam sint velit excepturi necessitatibus quam ad ratione?</p>

          </div>


          <div class="servicos-prices">
            <p>R$ 150</p>
          </div>
          <div class="servicos-checked">
            <input type="checkbox">
          </div>
        </div>

        <div class="card-servicos">
          <div class="block-text col-md-10 col-lg-9">
            <h3>Serviço 2</h3>

            <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corrupti dicta nobis, soluta vel vero assumenda quia ea dolorum amet blanditiis. Repudiandae aperiam sint velit excepturi necessitatibus quam ad ratione?</p>

          </div>


          <div class="servicos-prices">
            <p>R$ 150</p>
          </div>
          <div class="servicos-checked">
            <input type="checkbox">
          </div>
        </div>

        <div class="btn-contratar">
          <div class="btn-col">
            <p>Total: R$ Valor</p>
            <span class="text-center" data-toggle="modal" data-target="#exampleModalLong">Ver formas de Pagamento</span>
          </div>
          <a href="login.php"><button>Continuar</button></a>
        </div>
      </div>

      <h4>Avaliações</h4>
       
      <?php 
          if(mysqli_num_rows($q_avaliacao) > 0){   
            while($r_p = mysqli_fetch_assoc($q_avaliacao)){
        ?>
      <div class="rating-service collapse" id="more-news">
        <h3><?php echo get('cliente',$r_p['Cliente']);    ?></h3>
        <div class="rating-stars">
          <span class="fa fa-star <?php if($r_p['Nota_avaliacao_geral']>=1){   ?>checked<?php  }  ?>"></span>
          <span class="fa fa-star <?php if($r_p['Nota_avaliacao_geral']>=2){   ?>checked<?php  }  ?>"></span>
          <span class="fa fa-star <?php if($r_p['Nota_avaliacao_geral']>=3){   ?>checked<?php  }  ?>"></span>
          <span class="fa fa-star <?php if($r_p['Nota_avaliacao_geral']>=4){   ?>checked<?php  }  ?>"></span>
          <span class="fa fa-star <?php if($r_p['Nota_avaliacao_geral']>=5){   ?>checked<?php  }  ?>"></span>
        </div>
        <p><?php echo $r_p['Titulo'];    ?></p>

      </div>
    <?php   }  }    ?>

      <div class="button-see-more-news">
        <button id="btn-news" class="btn" type="button" data-toggle="collapse" data-target="#more-news" aria-expanded="false" aria-controls="more-news" onclick="changeText()">Carregar mais</button>
      </div>







    </div>

  </div>
  <!--------------------------------------------Modal---------------------------------------------------->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Formas de Pagamento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="formas-pagamento">
            <img src="images//icons/boleto-logo.png" alt="Boleto Logo">
            <span>Boleto Bancário</span>
          </div>

          <div class="formas-pagamento">
            <img src="images/icons/money.png" alt="Deposito Logo">
            <span>Depósito Bancário</span>
          </div>

          <div class="formas-pagamento">
            <img src="images/icons/elo-logo.png" alt="Elo Logo">
            <span>Cartão Elo</span>
          </div>

          <div class="formas-pagamento">
            <img src="images/icons/hiper-card.svg" alt="Hiper Logo">
            <span>Cartão Hiper</span>
          </div>

          <div class="formas-pagamento">
            <img src="images/icons/mastercard.png" alt="Mastercard Logo">
            <span>Cartão MasterCard</span>
          </div>

          <div class="formas-pagamento">
            <img src="images/icons/visa-logo.png" alt="Visa Logo">
            <span>Cartão Visa</span>
          </div>

        </div>
      </div>
    </div>
  </div>


  <div class="background-image-right">
    <img src="images/ddteasy-images/meio.png" alt="side-image-right">
  </div>
</div>



<?php include('footer.php'); ?>

</body>

</html>

<script type="text/javascript">
function changeText() {
  if (document.getElementById("btn-news").innerText == "Carregar mais") {
    document.getElementById("btn-news").innerText = "Carregar menos";
  } else {
    document.getElementById("btn-news").innerText = "Carregar mais"
  }
}
</script>