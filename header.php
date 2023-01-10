<?php  include('sistema/config/config.php');   ?>
<!DOCTYPE html>

<html lang="pt-br">
<!--<![endif]-->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="images/favicon.png">

  <?php if (isset($facebook) && $facebook) { ?>
  <!-- TODO: Configurar opengraph  -->
  <meta property="og:url" content="https://www.your-domain.com/your-page.html" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Your Website Title" />
  <meta property="og:description" content="Your description" />
  <meta property="og:image" content="https://www.your-domain.com/path/image.jpg" />
  <?php } ?>

  <title>Ddteasy</title>
  <base href="<?php  echo $Config['UrlSite'];   ?>" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="js/jquery.3.2.1.js"></script>
  <script src="js/owl2carousel.js"></script>
  <script src="js/location.js"></script>
  <script src="js/jquery.mask.js"></script>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/owl2carousel.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/sweetalert.css">
  <link rel="stylesheet" href="css/venobox.css">
  <!-- <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css"> -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/datatables.min.css">
  <!-- <style>
    <?php echo file_get_contents('css/styles.css'); ?>
  </style> -->
  <script src="https://www.google.com/recaptcha/api.js?onload=captchaCallback&render=explicit"></script>

  <!-- recaptcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

  <?php if (isset($facebook) && $facebook) { ?>
  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  </script>
  <?php } ?>

  <header class="header-sticky">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg">
        <a href="index.php" class="navbar-brand">
          <img src="images/ddteasy-images/logo.png" alt="logo-image">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars menu-mobile"></i>
        </button> 
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="container">
            <ul class="navbar-nav justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Serviços
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <?php  
                    $q_s = Query('SELECT * FROM servico WHERE Ativo = 1 ORDER BY Titulo ASC',0);
                    if(mysqli_num_rows($q_s) >0){
                      while($r_s = mysqli_fetch_assoc($q_s)){
                  ?>
                  <a href="<?php  echo $Config['UrlSite'];   ?>servico/<?php echo $r_s['Url'];  ?>" class="dropdown-item"><?php echo $r_s['Titulo'];   ?></a>
                  <?php  }  }  ?>
                </div>
              </li>
              <li class="nav-item active">
                <a href="how-works.php" class="nav-link">Como funciona</a>
              </li>
              <li class="nav-item actived">
                <a href="parceiro.php" class="nav-link ">Seja um Parceiro</a>
              </li>
              <li class="nav-item">
                <a href="help.php" class="nav-link">Ajuda</a>
              </li>
              <?php 
                if(!isset($_SESSION['Cliente'])){
              ?>
                <li onclick="location.href='login.php'" class="nav-item login">
                  <div class="icon-login">
                    <img src="images/ddteasy-images/person-outline.svg" name="person-outline">
                    <img src="images/ddteasy-images/person-outline-white.svg" name="person-outline">
                  </div>
                  <a class="nav-link-login">Login</a>
                </li>
              <?php } else { 
                $q = Query('SELECT * FROM cliente WHERE Cliente = '. $_SESSION['Cliente']);
                $r = mysqli_fetch_assoc($q);
              ?>
                <li class="nav-item login">
                    <div class="icon-login">
                      <img src="images/ddteasy-images/person-outline.svg" name="person-outline">
                      <img src="images/ddteasy-images/person-outline-white.svg" name="person-outline">
                    </div>
                    <a class="nav-link-login" href="<?php echo $Config['UrlSite'];  ?>minha-conta">
                      <?php 
                        $firstName = explode(" ", $r['Titulo']);
                        echo $firstName[0];
                      ?>
                    </a>
                </li>

                <!-- BOTÃO SAIR -->
                <li onclick="location.href='requisicoes/sair.php'" class="nav-item">

                    <a class="nav-link">Sair</a>
                </li>
              
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <!-- <div id="search-wrapper">
    <button class="dismiss">
      <img src="images/cross-out.png" alt="">
    </button>
    <div class="nice-input-wrapper">
      <input type="text" id="search" class="nice-input">
      <label id="search-label" class="nice-input-label">
        O que você está procurando?
      </label>
    </div>
    <ul id="search-results">
      <li>
        <a href="#">
          <img src="images/jeans_01.png" alt="">
          <h4>Título</h4>
          <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
        </a>
      </li>
    </ul>
  </div> -->