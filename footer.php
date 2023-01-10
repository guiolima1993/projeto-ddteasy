<?php 
$q = Query('SELECT * FROM dados_da_empresa WHERE Ativo = 1 ORDER BY Dados_da_empresa DESC LIMIT 1');
$r = mysqli_fetch_assoc($q);
?>
<footer>
  <div class="container">
    <div class="row">

      <div class="col-xl-4 col-md-4 col-sm-12">
        <div class="box-content">
          <h2>DDTeasy</h2>
          <hr>
          <ul class="list-ft">
            <li class="item-ft">
              <a href="index.php" class="link-ft">Home</a>
            </li>
            <li class="item-ft">
              <a href="how-works.php" class="link-ft">Como Funciona</a>
            </li>
            <li class="item-ft">
              <a href="parceiro.php" class="link-ft">Sou um Especialista</a>
            </li>
            <li class="item-ft">
              <a href="help.php" class="link-ft">Ajuda</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-xl-4 col-md-4 col-sm-12">
        <div class="box-content">
          <h2>Institucional</h2>
          <hr>
          <ul class="list-ft">
            <li class="item-ft">
              <a href="about.php" class="link-ft">Quem Somos</a>
            </li>
            <li class="item-ft">
              <a href="politica-de-privacidade.php" class="link-ft">Política de Privacidade</a>
            </li>
            <li class="item-ft">
              <a href="termos-de-uso.php" class="link-ft">Termos de Uso</a>
            </li>
            <li class="item-ft">
              <a href="blog.php" class="link-ft">Blog</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-xl-4 col-md-4 col-sm-12">
        <div class="box-content">
          <h2 class="text-center">Redes Sociais</h2>
          <hr>
          <div class="flexbox">
            <a href="<?= $r['Instagram']; ?>" target="_blank" class="flex-link instagram-flex">
              <i class="fa fa-instagram"></i>
            </a>
            <a href="https://api.whatsapp.com/send?phone=55<?= RemoveSpecialChar($r['Whatsapp']); ?>&text=Olá!%20Eu%20gostaria%20de%20um%20orçamento." target="_blank" class="flex-link whatsapp-flex">
              <i class="fa fa-whatsapp"></i>
            </a>
            <a href="<?= $r['Facebook']; ?>" target="_blank" class="flex-link facebook-flex">
              <i class="fa fa-facebook"></i>
            </a>
            <a href="<?= $r['Linkedin']; ?>" target="_blank" class="flex-link linkedin-flex">
              <i class="fa fa-linkedin"></i>
            </a>
          </div>
        </div>
      </div>


    </div>
  </div>

  <div class="copyright text-center container">
    <div class="row">
      <div class="col-md-12">
        &copy; <span class="current-year"></span>
        Todos os direitos reservados. <br class="mobile-only">Desenvolvido por <a href="https://www.makeweb.com.br/?https://www.makeweb.com.br/&gclid=Cj0KCQjwh_eFBhDZARIsALHjIKekAPBJOSbu3vW17BI2SPfW6WNhZ9LT0ETFFbM3_vf195lKWWGgkpAaAuoXEALw_wcB" target="_blank"><strong><img src="images/makeweb.png" alt="Logo Make Web"></strong></a>
      </div>
    </div>
  </div>
</footer>

<!-- <a href="https://api.whatsapp.com/send?phone=5515999999999" id="whatsapp-button" target="_blank"><i class="fa fa-whatsapp"></i></a> -->



<div id="modal-login" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Login</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="">
          <div class="form-group">
            <label for="">E-mail</label>
            <input type="email" name="Email" class="form-control" required="required">
          </div>
          <div class="form-group">
            <label for="">Senha</label>
            <input type="password" name="Senha" class="form-control" required="required">
          </div>
          <div class="form-group">
            <div class="recaptcha_el"></div>
            <button type="submit" class="btn btn-primary btn-full">Entrar</button>
            <a href="cadastro-usuario" class="btn btn-default btn-full">Faça seu cadastro</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





<div class="whatsapp-button">
  <a href="https://api.whatsapp.com/send?phone=55<?= RemoveSpecialChar($r['Whatsapp']); ?>&text=Olá!%20Eu%20gostaria%20de%20um%20orçamento." target="_blank" class="flex-link whatsapp-flex">
    <i class="fa fa-whatsapp"></i>
  </a>
</div>

<!-- <section class="cookies-background">
  <div class="cookies">
    <h4>Este site usa cookies.</h4>
    <p>
      Usamos cookies para analisar o tráfego do site e otimizar sua experiência nele. Ao aceitar nosso uso de cookies, seus dados serão agregados com os dados de todos os demais usuários. 
    </p>
    <button type="button" class="btn dismiss-cookies">Aceitar</button>
  </div>
</section> -->

<div class="loader">
  <div class="lds-ellipsis">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script src="js/jquery.validate.js"></script>
<!-- <script src="js/jquery-ui.js"></script> -->
<script src="js/venobox.js"></script>
<script src="js/wow.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.mCustomScrollbar.min.js"></script>
<script src="js/jquery.mousewheel.min.js"></script>
<script src="js/moment-with-locales.js"></script>
<script src="js/clndr.min.js"></script>
<script src="js/underscore-min.js"></script>
<script src="js/main.js"></script>
<script src="js/datatables.min.js"></script>