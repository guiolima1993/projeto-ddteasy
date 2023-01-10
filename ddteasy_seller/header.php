<?php include('../sistema/config/config.php');   

 //$_SESSION['Parceiro'] = 1;
 

  if(isset($_SESSION['Parceiro']) && $_SESSION['Parceiro']!=''){

    $r_p = '';
    
    $q_p = Query('SELECT * FROM parceiro WHERE Parceiro = '.$_SESSION['Parceiro'].' AND Ativo = 1',0);
    if(mysqli_num_rows($q_p) > 0){
      $r_p = mysqli_fetch_assoc($q_p);
    }else{
      goHome();
    }

  }else{
    goHome();
  }

?>
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

  <title>Home</title>
  <base href="./" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="js/jquery.3.2.1.js"></script>
  <script src="js/owl2carousel.js"></script>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/owl2carousel.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/sweetalert.css">
  <link rel="stylesheet" href="css/venobox.css">
  <!-- <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css"> -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/datatables.min.css">
  <!-- <link rel="stylesheet" href="css/evo-calendar.min.css"> -->
  
  <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" />
  <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css" />
  <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css" />

  <!-- <style>
    <?php echo file_get_contents('css/styles.css'); ?>
  </style> -->
  <!-- <script src="https://www.paypal.com/sdk/js?client-id=CLIENT_ID"></script> -->
  <script src="https://www.google.com/recaptcha/api.js?onload=captchaCallback&render=explicit"></script>

  <!-- recaptcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

  
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

   
  <!-- <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script> -->

<section class="d-section"> 
  <header>
    <div class="container-fluid">
      <nav class="navbar px-2 navbar-expand-xl">
        <a href="#" class="navbar-brand">
          <img src="images/logo.png" alt="Logo_ddteasy">
        </a>
        <h5 class="text-center">Bem vindo, <?php echo get('parceiro',$_SESSION['Parceiro']);     ?>!</h5>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars text-dark"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="agenda.php" class="nav-link">Agenda</a>
            </li>
            <li class="nav-item">
              <a href="avaliacao.php" class="nav-link">Avaliações</a>
            </li>            
            <li class="nav-item">
              <a href="https://www.paypal.com/signin" target="_blank" class="nav-link">Carteira digital</a>
            </li>
            <li class="nav-item">
              <a href="cadastro.php" class="nav-link">Cadastro</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="gestao-de-funcionarios.php" class="nav-link">Gestão de Funcionários</a>
            </li>
            <li class="nav-item">
              <a href="material-de-apoio.php" class="nav-link">Material de Apoio</a>
            </li>
            <li class="nav-item">
              <a href="notificacao.php" class="nav-link">Notificações</a>
            </li>
            <li class="nav-item">
              <a href="servicos.php" class="nav-link">Serviços</a>
            </li>
            <li class="nav-item">
              <a href="sair.php" class="nav-link">Sair</a>
            </li>
          </ul>
        </div>
        <div class="mt-3 text-center">
          <a href="ajuda.php" class="btn btn-ajuda">Ajuda</a>
        </div>
      </nav>
    </div>
  </header>
  <!-- <script>
    paypal.Buttons().render('#paypal-button-container');
  </script> -->