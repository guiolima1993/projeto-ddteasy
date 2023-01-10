<?php $_news = true ?>
<?php include('header.php');




$_SESSION['Parceiro_orcamento'] = clean($_GET[1]);
$_SESSION['Servico_id'] = array();
$_SESSION['Valor_Servico'] = array();


$q_p = Query('SELECT * FROM parceiro WHERE Ativo = 1 AND Parceiro = ' . clean($_GET[1]) . ' ORDER BY Parceiro DESC  LIMIT 1', 0);

if (mysqli_num_rows($q_p) > 0) {
  $r = mysqli_fetch_assoc($q_p);
} else {
  goHome();
}

$q_avaliacao = Query('SELECT * FROM avaliacao WHERE Parceiro = ' . $r['Parceiro'] . '');
$n_avalia = mysqli_num_rows($q_avaliacao);

?>

<div class="perfil-company">

  <div class="background-image-left">
    <img src="images/ddteasy-images/canto-1.png" alt="side-image">
  </div>

  <div class="container">
    <div class="card col-xl-3 col-md-5">
      <div class="card-body">
        <h5 class="card-title">
          <?php echo $r['Titulo'];     ?>
        </h5>
        <div class="location">
          <?php
          $lat = explode(';', $r['Localizacao'])[0];
          $lng = explode(';', $r['Localizacao'])[1];
          ?>
          <div class="location-maps">
            <a href="https://www.google.com.br/maps/search/<?= "$lat+$lng" ?>" target="_blank"><img src="images/mapa.png" alt="Localização"></a>
          </div>
          <span id="distance<?php echo $r['Parceiro'];    ?>">Calculando...</span>
          <?php
          echo "<script> $('#distance" . $r['Parceiro'] . "').text(getDistanceInKm(" . $lat . "," . $lng . ") + ' de distância da sua residência'); </script>";
          ?>

        </div>
        <p class="card-text">
          <?php echo $r['Descritivo'];     ?>
        </p>


        <?php
        $media_r = Query('SELECT AVG(Nota) as Nota_avaliacao_geral FROM avaliacao WHERE Parceiro = ' . $r['Parceiro'] . '', 1);
        $media   = $media_r['Nota_avaliacao_geral'];
        $q_nota = Query('SELECT Avaliacao FROM avaliacao WHERE Parceiro = ' . $r['Parceiro'] . '');
        $n_avalia = mysqli_num_rows($q_nota);
        ?>
        <span class="qtd-ratings mb-2">
          <?php echo $n_avalia;  ?> avaliações
        </span>
        <div class="rating-company">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

          <?php
          echo str_repeat('<span class="fa fa-star checked"></span>', $media);
          echo str_repeat('<span class="fa fa-star"></span>', 5 - floor($media));
          ?>
        </div>

      </div>
    </div>


    <div class="servicos-prestados col-xl-9">
      <h4>Serviços Escolhidos:</h4>
      <div class="all-services">


        <?php
        if (isset($_SESSION['servico_id']) && $_SESSION['servico_id'] != '') {


          $servico_title = '';

          $servico_price = '';

          if ($_SESSION['servico_id'] == 2) {
            $servico_title = 'Dedetizacao';
            $servico_price = $r['Dedetizacao_valor'];
          } else if ($_SESSION['servico_id'] == 1) {
            $servico_title = 'Sanitizacao';
            $servico_price = $r['Sanitizacao_valor'];
          }

          $servico_id  = $_SESSION['servico_id'];


        ?>
        <div class="card-servicos">
          <div class="block-text col-md-10 col-lg-8">
            <h3>
              <?php echo  $servico_title;   ?>
            </h3>

            <!--<p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corrupti dicta nobis, soluta vel vero assumenda quia ea dolorum amet blanditiis. Repudiandae aperiam sint velit excepturi necessitatibus quam ad ratione?</p>-->

          </div>
          <div class="servicos-prices">
            <p>R$
              <?php echo $servico_price;     ?>
            </p>
          </div>
          <div class="servicos-checked">
            <input type="checkbox" name="Nome_servico" value="<?php echo $servico_id;     ?>" data-valor="<?php echo $servico_price;     ?>">
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



        <?php
        //dedetizacao
        if ($_SESSION['servico_id'] == 2 && $r['Sanitizacao'] == 1) {  ?>

        <div class="card-servicos">
          <div class="block-text col-md-10 col-lg-8">
            <h3>Sanitizacao</h3>
            <!--<p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corrupti dicta nobis, soluta vel vero assumenda quia ea dolorum amet blanditiis. Repudiandae aperiam sint velit excepturi necessitatibus quam ad ratione?</p>-->
          </div>
          <div class="servicos-prices">
            <p>R$
              <?php echo $r['Sanitizacao_valor'];    ?>
            </p>
          </div>
          <div class="servicos-checked">
            <input type="checkbox" name="Nome_servico" value="1" data-valor="<?php echo $r['Sanitizacao_valor'];    ?>">
          </div>
        </div>
        <?php  } else if ($_SESSION['servico_id'] == 1 && $r['Dedetizacao'] == 1) {   ?>
        <div class="card-servicos">
          <div class="block-text col-md-10 col-lg-8">
            <h3>Dedetizacao</h3>
            <!--<p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corrupti dicta nobis, soluta vel vero assumenda quia ea dolorum amet blanditiis. Repudiandae aperiam sint velit excepturi necessitatibus quam ad ratione?</p>-->
          </div>
          <div class="servicos-prices">
            <p>R$
              <?php echo $r['Dedetizacao_valor'];    ?>
            </p>
          </div>
          <div class="servicos-checked">
            <input type="checkbox" name="Nome_servico" value="2" data-valor="<?php echo $r['Dedetizacao_valor'];    ?>">
          </div>
        </div>
        <?php  }     ?>


        <?php if ($r['Dedetizacao_premiuw'] == 1) {  ?>

        <div class="card-servicos">
          <div class="block-text col-md-10 col-lg-8">
            <h3>Dedetizacao Premium</h3>
            <!--<p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corrupti dicta nobis, soluta vel vero assumenda quia ea dolorum amet blanditiis. Repudiandae aperiam sint velit excepturi necessitatibus quam ad ratione?</p>-->
          </div>
          <div class="servicos-prices">
            <p>R$
              <?php echo $r['Dedetizacao_premiuw_valor'];    ?>
            </p>
          </div>
          <div class="servicos-checked">
            <input type="checkbox" name="Nome_servico" value="3" data-valor="<?php echo $r['Dedetizacao_premiuw_valor'];    ?>">
          </div>
        </div>
        <?php  }   ?>


        <?php if ($r['Sanitizacao_premiuw'] == 1) {  ?>

        <div class="card-servicos">
          <div class="block-text col-md-10 col-lg-8">
            <h3>Sanitizacao Premium</h3>
            <!--<p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corrupti dicta nobis, soluta vel vero assumenda quia ea dolorum amet blanditiis. Repudiandae aperiam sint velit excepturi necessitatibus quam ad ratione?</p>-->
          </div>
          <div class="servicos-prices">
            <p>R$
              <?php echo $r['Sanitizacao_premiuw_valor'];    ?>
            </p>
          </div>
          <div class="servicos-checked">
            <input type="checkbox" name="Nome_servico" value="4" data-valor="<?php echo $r['Sanitizacao_premiuw_valor'];    ?>">
          </div>
        </div>
        <?php  }   ?>





        <div class="btn-contratar">
          <div class="btn-col">
            <input type="hidden" value="0" id="valor-servico-total">
            <p id="legenda-total">Total: 0</p>
            <span class="text-center" data-toggle="modal" data-target="#exampleModalLong">Ver formas de Pagamento</span>
          </div>
          <button class="btn-concluir">Continuar</button>
        </div>



      </div>

      <h4>Avaliações</h4>

      <?php
      if (mysqli_num_rows($q_avaliacao) > 0) {
        while ($r_p = mysqli_fetch_assoc($q_avaliacao)) {
      ?>
      <div class="rating-service collapse" id="more-news">
        <h3>
          <?php echo get('cliente', $r_p['Cliente']);    ?>
        </h3>
        <div class="rating-stars">
          <?php
              echo str_repeat('<span class="fa fa-star checked"></span>', $r_p['Nota']);
              echo str_repeat('<span class="fa fa-star"></span>', 5 - $r_p['Nota']);
              ?>
        </div>
        <p>
          <?php echo $r_p['Titulo'];    ?><br><br>
          <?php echo $r_p['Comentario'];    ?><br>
          <?php echo $r_p['Data'];    ?>
        </p>

      </div>
      <?php   }
      }    ?>

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
            <img src="images/icons/boleto-logo.png" alt="Boleto Logo">
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

<script>
$('input[type=checkbox]').change(function() {
  $(this).prop('checked', this.checked);

  var teste = $(this);


  if ($(this).is(':checked')) {
    var tValor = $(this).data("valor");
    var valor = parseFloat(tValor.replace(',', '.'));
    var total = Number($('#valor-servico-total').val());
    total = total + valor;
    $('#legenda-total').html(`Total: R$ ${total}`);
    $('#valor-servico-total').val(total)
  } else {
    var tValor = $(this).data("valor");
    var valor = parseFloat(tValor.replace(',', '.'));
    var total = Number($('#valor-servico-total').val());
    total = total - valor;
    $('#legenda-total').html(`Total: R$ ${total}`);
    $('#valor-servico-total').val(total);
  }


})


$(function() {

  $(document).on('click', '.servicos-prestados .all-services .btn-contratar .btn-concluir', function() {
    var servico_contratado = document.querySelectorAll('input[type=checkbox]:checked');

    if (!servico_contratado.length) {
      swal({
        title: "Erro",
        text: "É necessário escolher algum serviço",
        icon: "error",
        confirmButtonText: "Ok"
      });
      return;
    }

    servico_contratado.forEach(function(i) {
      var _valor = $(i).data("valor");
      var servico_id = $(i).val();

      $.ajax({
        url: "requisicoes/confirma-pedido.php",
        type: "post",
        data: {
          id: servico_id,
          Valor: _valor
        },
        success: function(res) {

        }
      })
    });

    document.cookie = "cookie=check_login; path=/"

    window.location.href = 'checkout.php';

    // var checkedAttr = [];
    // var servicosId = [];


    // var _t = $(this);

    // _t.closest('.all-services').find('.card-servicos .servicos-checked :checkbox').each(function (i, item) {

    //   var _valor = $(this).data("valor");
    //   var servico_id = $(this).val();

    //   if ($(this).prop("checked")) {
    //     checkedAttr.push(_valor);
    //     servicosId.push(servico_id);
    //   } else {
    //     checkedAttr.splice(i, 1);
    //     servicosId.splice(i, i);
    //   }

    //   console.log(_valor, servico_id);

    //   $.ajax({
    //     url: "requisicoes/confirma-pedido.php",
    //     type: "post",
    //     data: {
    //       id: servico_id,
    //       Valor: checkedAttr
    //     },
    //     success: function (res) {

    //     }
    //   })
    // })

  });
})
</script>
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