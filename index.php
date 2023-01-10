<?php $_home = true ?>
<?php include('header.php'); ?>

<!-- Main Banner -->

<div class="background-specialist">

  <div class="image-side">
    <img class="image-side" src="images/ddteasy-images/canto-1.png">
  </div>

<?php   
    $q = Query('SELECT * FROM introducao_home WHERE Ativo = 1 ORDER BY Introducao_home DESC LIMIT 1');
    if(mysqli_num_rows($q) > 0){
      $r = mysqli_fetch_assoc($q);
?>
  <div class="title-specialist">
    <h2><?php echo $r['Titulo'];   ?></h2>
    <h4><?php echo $r['Resumo'];   ?></h4>
  </div>
<?php  }  ?>   

  <div class="service-type">
    <div class="background-services">
      <div class="background-type">
        <div class="choose-service">
          <div class="header-item">
            <div class="number-one">
              <span>01</span>
            </div>
            <div class="number-one-info">
              <span>Escolha o serviço desejado.</span>
            </div>
          </div>
          <a href="index#prague" style="text-decoration: none;">
            <div class="dedetizacao active-class">
              <input type="radio" name="Tipo_de_servico" value="Pragas" checked="true">
              <div class="icon">
                <img src="images/ddteasy-images/bug.png" alt="bug">
              </div>
              <div class="info">
                <span>Dedetização</span>
              </div>
            </div>
          </a>
          <a href="index#prague" style="text-decoration: none;">
            <div class="sanitizacao disable-class">
              <input type="radio" name="Tipo_de_servico" value="Pragas" href="index#prague">
              <div class="icon">
                <img src="images/ddteasy-images/potion.png" alt="potion">
              </div>
              <div class="info">
                <span>Sanitização</span>
              </div>
            </div>
          </a>
          <?php   
              $q = Query('SELECT * FROM cotacao_texto WHERE Ativo = 1 ORDER BY Cotacao_texto DESC LIMIT 1');
              if(mysqli_num_rows($q) > 0){
                $r = mysqli_fetch_assoc($q);
          ?>
          <div class="description">
            <p><?php echo $r['Texto'];   ?></p>
          </div>
          <?php  }  ?> 
        </div>
      </div>
      <div class="background-form" id="prague">
        <div class="form-service">
          <div class="header-item">
            <div class="number-two">
              <span>02</span>
            </div>
            <div class="number-two-info">
              <span>Preencha as informações abaixo e busque um especialista.</span>
            </div>
          </div>
            
          <form action="filtro-especialista.php" method="GET">
            <input type="hidden" name="Tipo_de_servico" value="dedetizacao">


            <div class="type-prague-det active-det">
              <div class="icon">
                <img src="images/ddteasy-images/bug-icon.png" alt="bug_icon">
              </div>
              <div class="description">
                <span>Tipo de Praga</span>
              </div>
              <div class="super-select">
                <button type="button" class="select-prague"><img src="images/ddteasy-images/chevron-down-outline.svg">
                  Selecionados: <b class="selected">0</b></button>
                <div class="super-select-component">
                <?php      
                  $q = Query('SELECT * FROM praga WHERE Ativo = 1 ORDER BY Praga ASC',0);
                  if(mysqli_num_rows($q) > 0){
                    while($r = mysqli_fetch_assoc($q)){
                ?>
                  <div class="super-select-checkbox">
                    <input type="checkbox" class="input-identify" name="Tipo_de_praga[]" data-value="<?php echo $r['Titulo'];   ?>" value="<?php echo $r['Praga'];   ?>">
                    <i class="fa fa-square"></i> <?php echo $r['Titulo'];   ?>
                  </div>
                <?php  }  } ?>
                </div>
              </div>
            </div>

            <div class="type-prague-san">
              <div class="icon">
                <img src="images/ddteasy-images/bug-icon.png" alt="bug_icon">
              </div>
              <div class="description">
                <span>Necessidade</span>
              </div>
              <div class="super-select">
                <button type="button" class="select-prague"><img src="images/ddteasy-images/chevron-down-outline.svg">
                  Selecionados: <b class="selected">0</b></button>
                <div class="super-select-component">
                  <div class="super-select-checkbox">
                    <input type="checkbox" name="Tipo_de_praga[]" class="input-identify" data-value="Prevenção" value="insetos_voadores">
                    <i class="fa fa-square"></i> Prevenção
                  </div>
                  <div class="super-select-checkbox">
                    <input type="checkbox" name="Tipo_de_praga[]" class="input-identify" data-value="Tive contato" id="insetos_rasteiros">
                    <i class="fa fa-square"></i> Desinfecção
                  </div>
                </div>
              </div>
            </div>

            <div class="type-home">
              <div class="icon">
                <img src="images/ddteasy-images/House.png" alt="home_icon">
              </div>
              <div class="description">
                <span>Tipo de imóvel</span>
              </div>
              <div class="select-home-background">
                <select id="residencia" name="Tipo_imovel" class="select-home" required>
                  <option value="">Selecione</option>
                <?php     
                    $q_tipo_imovel = Query('SELECT * FROM tipo_imovel WHERE Ativo = 1 order by Tipo_imovel ASC');
                    if(mysqli_num_rows($q_tipo_imovel) > 0){
                      while($r_tipo_imovel = mysqli_fetch_assoc($q_tipo_imovel)){
                ?>
                    <option value="<?php echo $r_tipo_imovel['Tipo_imovel'];    ?>"><?php echo $r_tipo_imovel['Titulo'];    ?></option>
                <?php  } } ?>
                </select>
              </div>
            </div>    

            <div class="size-home active">
              <div class="icon">
                <img src="images/ddteasy-images/size.png" alt="Size-Icon">
              </div>
              <div class="description">
                <span>Tamanho</span>
              </div>
              <div class="select-size-background">
                <!-- <input class="size-input" type="number" placeholder="Informe quantos m²" value=""> -->
                <select class="select-home" id="tamanho-imovel" name="Tamanho_imovel" required>
                  <option value="">Selecione</option>
                  <option value="100m-150m">100m² - 150m²</option>
                  <option value="150m-200m">150m² - 200m²</option>
                  <option value="200m-400m">200m² - 400m²</option>
                  <option value="400m-600m">400m² - 600m²</option>
                </select>
                <div class="hint-size-toggle">
                  <button type="button" class="btn" data-toggle="tooltip" data-placement="top"
                    title="Tamanho do Imóvel">?</button>
                </div>

              </div>
            </div>

            <div class="size-apart disable-class">
              <div class="icon">
                <img src="images/ddteasy-images/size.png" alt="Size-Icon">
              </div>
              <div class="description">
                <span>Dormitórios:</span>
              </div>
              <div class="select-size-background d-flex">
                <div class="qtd-home d-flex align-items-center">
                  <button class="btn btn-menos qtd-minus" type="button">-</button>
                  <input type="text" id="qtd-rooms" name="Dormitorios" value="1">
                  <button class="btn btn-mais qtd-plus" type="button">+</button>
                </div>
                <div class="hint-size-toggle-apart">
                  <button type="button" class="btn" data-toggle="tooltip" data-placement="top"
                    title="Quantidade de quartos do apartamento">?</button>
                </div>

              </div>
            </div>

            <div class="cep">
              <div class="icon">
                <img src="images/ddteasy-images/Marker.png" alt="Marker">
              </div>
              <div class="description">
                <span>CEP</span>
              </div>
              <div class="verificar-cep d-flex flex-column align-items-end">
                <div class="input-default input-size">
                  <input id="endereco-campo" class="cep-field " name="Cep" placeholder="Digite o cep" value="">
                </div>
                <label id="endereco" class="fill-endereco"></label>
              </div>
            </div>
            <div class="button-search">
              <button id="search-job" class="btn btn-primary" type="submit" disabled>Buscar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="banner col-12">
  <div class="how-works">
      <a href="index.php#funciona">
          <span>COMO FUNCIONA</span>
      </a>
  </div>
  <div class="divider"></div>
  <div class="be-partener">
      <a href="index.php#parceiro">
          <span>SEJA UM PARCEIRO</span>
      </a>
  </div>
  <div class="divider"></div>
  <div class="who-uses">
      <a href="index.php#quemusou">
          <span>QUEM JÁ USOU</span>
      </a>
  </div>
</div>


<?php  
  $i = 0;
  $class = array('first','second','third');  
  $q = Query('SELECT * FROM como_funciona_home WHERE Ativo = 1 ORDER BY como_funciona_home ASC LIMIT 3');
    if(mysqli_num_rows($q) > 0){
?>
<div class="how-work">
  <div class="title-how-work" id="funciona">
      <h1>Como Funciona</h1>
  </div>
  <div class="container-work">
    <?php  while($r = mysqli_fetch_assoc($q)){ ?>
      <div class="<?php echo $class[$i];   ?>-content">
          <div class="image">
              <img src="<?php echo $Config['UrlSite'];   ?>imagens/como_funciona_home/349/<?php echo $r['Imagem'];   ?>" alt="<?php echo $r['Titulo'];   ?>">
          </div>
          <div class="info">
              <p><?php echo $r['Resumo'];   ?></p>
          </div>
      </div>
    <?php $i++; }  ?>
  </div>
  <div class="container-image-middle">
      <img src="images/ddteasy-images/meio.png">
  </div>
</div>
<?php  }  ?>  

<?php  
  $i = 0;
  $class = array('first','second','third','fourth');  
  $q = Query('SELECT * FROM parceiro_home WHERE Ativo = 1 ORDER BY Parceiro_home ASC LIMIT 4');
    if(mysqli_num_rows($q) > 0){
?>
<div class="be-partern">
  <div class="title-be-partern" id="parceiro">
      <h1>Seja um Parceiro DDTeasy</h1>
  </div>
  <div class="container-partern">
    <?php while($r = mysqli_fetch_assoc($q)){     ?>
      <div class="first-content">
          <div class="image">
              <img src="<?php echo $Config['UrlSite'];   ?>imagens/parceiro_home/306/<?php echo $r['Imagem'];   ?>" alt="celular_image">
          </div>
          <div class="title">
              <h4><?php echo $r['Titulo'];   ?></h4>
          </div>
          <div class="info">
              <p><?php echo $r['Resumo'];   ?></p>
          </div>
      </div>
    <?php  }   ?>    
  </div>
</div>
<?php   }  ?>  

    

<?php  
  $q = Query('SELECT * FROM quem_ja_usou WHERE Ativo = 1 ORDER BY Quem_ja_usou ASC LIMIT 4');
    if(mysqli_num_rows($q) > 0){
?>
<div class="who-uses-already">

  <div class="image-side-carousel">
      <img src="images/ddteasy-images/canto-2.png">
  </div>

  <div class="title-who-uses" id="quemusou">
      <h1>Quem já usou?</h1>
  </div>

  <div class="carousel-area ">
    <div class="basic-carousel owl-carousel" data-autoplay="true" data-nav="true" data-items="2" data-dots="true" data-loop="true">
      <?php  while($r = mysqli_fetch_assoc($q)){   ?>
        <div class="item">
          <div class="owl-text d-flex justify-content-center">
            <div class="content-item">
              <div class="title-name">
                  <h3><?php echo $r['Titulo'];   ?></h3>
              </div>
              <div class="title-name">
                  <h3><?php echo $r['Sobrenome'];   ?></h3>
              </div>
              <div class="info">
                  <p>
                    <?php echo $r['Resumo'];   ?>
                  </p>
              </div>
          </div>
          </div>
        </div>
      <?php   }  ?>
    </div>
  </div>
</div>
<?php   }   ?>


<?php  
  $q = Query('SELECT * FROM sobre_nos_home WHERE Ativo = 1 ORDER BY Sobre_nos_home DESC LIMIT 1');
    if(mysqli_num_rows($q) > 0){
      $r = mysqli_fetch_assoc($q);
?>
<div class="about-us">
  <div class="container-about-us col-12">
      <div class="image col-6 col-md-4 col-sm-4">
          <img src="<?php echo $Config['UrlSite'];   ?>imagens/sobre_nos_home/2305/<?php echo $r['Imagem'];   ?>" alt="sobre-nos_image">
      </div>
      <div class="content col-6">
          <div class="title">
              <h4><?php echo $r['Titulo'];   ?></h4>
              <div class="border-hor"></div>
          </div>
          <div class="info">
              <p><?php echo $r['Resumo'];   ?></p>
          </div>
          <div class="see-more">
              <button onclick="location.href='about.php'" type="button" class="btn btn-secondary">Ver Mais</button>
          </div>
      </div>
  </div>
</div>
<?php   }   ?>

<?php include('footer.php'); ?>


<script type="text/javascript">
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

<script type="text/javascript">
  $('.qtd-plus').click(function(){
   document.getElementById('qtd-rooms').value++;
  });
  
  $('.qtd-minus').click(function(){
    if(document.getElementById('qtd-rooms').value > 1) {
      document.getElementById('qtd-rooms').value--;
    }
  });
  
  </script>

<script text="text/javascript">
  $('a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function(event) {
      // On-page links
      if (
        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
        && 
        location.hostname == this.hostname
      ) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
          // Only prevent default if animation is actually gonna happen
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000, function() {
            // Callback after animation
            // Must change focus!
            var $target = $(target);
            $target.focus();
            if ($target.is(":focus")) { // Checking if the target was focused
              return false;
            } else {
              $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again
            };
          });
        }
      }
    });
    </script>

<script>
  $(".dedetizacao").click(function () {
    $(".dedetizacao").removeClass("disable-class");
    $(".dedetizacao").addClass("active-class");
    $(".dedetizacao").find("input[type='radio']").prop('checked', true);

    $(".form-submit").find("input[type='hidden']").val("dedetizacao")

    if (!$(".type-prague-det").hasClass("active-det")) {
      $(".type-prague-san").removeClass("active-san");
      $(".type-prague-det").addClass("active-det");
    }


    $(".sanitizacao").removeClass("active-class-sanetiza");
    $(".sanitizacao").addClass("disable-class");
    $(".sanitizacao").find("input[type='radio']").prop('checked', false);

   

  });


  $(".sanitizacao").click(function () {
    $(".sanitizacao").removeClass("disable-class");
    $(".sanitizacao").addClass("active-class-sanetiza");
    $(".sanitizacao").find("input[type='radio']").prop('checked', true);

    $(".form-submit").find("input[type='hidden']").val("sanitizacao")

    if (!$(".type-prague-san").hasClass("active-san")) {
      $(".type-prague-det").removeClass("active-det");
      $(".type-prague-san").addClass("active-san");
    }


    $(".dedetizacao").removeClass("active-class");
    $(".dedetizacao").addClass("disable-class");
    $(".dedetizacao").find("input[type='radio']").prop('checked', false);

  });

  // Metodo para trocar o select do tamanho
  $('#residencia').on('change', function () {
    if ($(this).val() == "1") {
      $(".size-home").removeClass("active");
      $(".size-home").addClass("disable-class");
      $(".size-home").find("#tamanho-imovel").removeAttr("required");

      $(".size-apart").removeClass("disable-class");
      $(".size-apart").addClass("active");
      $(".size-apart").find("#qtd-rooms").attr("required");

    } else {
      $(".size-home").removeClass("disable-class");
      $(".size-home").addClass("active");
      $(".size-home").find("#tamanho-imovel").attr("required");


      $(".size-apart").removeClass("active");
      $(".size-apart").addClass("disable-class");
      $(".size-apart").find("#qtd-rooms").removeAttr("required");   
    }
  })

    // $('.cep-field').change(function() {
    //   if($(this).val().length != 8) {
    //     $('#search-job').attr('disabled', true);
    //   }
      
    // });


  // Super Select - Checkbox
  $(document).on('click', '.super-select button', function () {

    $('.super-select').removeClass('active');

    $(this).closest('.super-select').toggleClass('active');

  });


  $(document).on('click', '.super-select-checkbox', function () {

    var _this = $(this);

    var check = $(this).find('input:checkbox');

    $(this).find('i.fa').toggleClass('fa-check-square fa-square');

    check.prop("checked", !check.prop("checked"));

    var checkedItems = $(this).closest('.super-select').find('input:checked').length;

    $(this).closest('.super-select').find('.selected').text(checkedItems);

    var checkArr = [];

    if (checkedItems > 0) {

      var qSelector = document.querySelectorAll(".super-select-checkbox");

      for(var i = 0; i < qSelector.length; i++){
        var checkValue = qSelector[i].querySelector(".input-identify").dataset.value;

        if(qSelector[i].querySelector(".input-identify").checked){
          checkArr.push(checkValue+", ");

          $(this).closest('.super-select').find('.selected').html(checkArr);
        }
      }

      $(this).closest('.super-select').addClass('has-selected');
    } else {
      $(this).closest('.super-select').removeClass('has-selected');
    }

  });


  $(document).mouseup(function (e) {

    var container = $('.super-select');

    if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('.super-select').removeClass('active');
    }

  });

</script>

</body>

</html>