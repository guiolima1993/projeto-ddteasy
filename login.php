<?php $_login = true ?>
<?php include('header.php'); ?>

<div class="background-login">
  <div class="background-image-left">
    <img src="images/ddteasy-images/canto-1.png" alt="side-image">
  </div>

  <form action="requisicoes/solicita-login.php" class="form-login">
    <div class="card-login d-flex">
      <div class="form-login">
        <div class="already-client mb-3">
          <h2>Faça seu login</h2>
        </div>
        <div class="background-email d-flex flex-column w-75">
          <label>Email</label>
          <div class="input-default input-email input-size mb-3">
            <input type="email" name="Email" placeholder="Email" required>
          </div>
        </div>
        <div class="background-passsword d-flex flex-column w-75">
          <label>Senha</label>
          <div class="input-default input-password input-size">
            <input type="password" name="Senha" placeholder="Senha" required>
          </div>
        </div>
        <div class="forget-password mb-4">
          <a href="forgot-password.php">Esqueceu sua senha?</a>
        </div>
        <div class="button-login mb-3 w-75">
          <button class="btn">Entrar</button>
        </div>
        <div class="other-login w-75">
          <div class="button-login-facebook mb-3">
            <button onclick="loginFB()" type="button" class="btn d-flex">
              <div class="icon-face d-flex">
                <img src="images/ddteasy-images/logo-facebook-blue.svg">
              </div> 
              <span>Faça login com o Facebook</span> 
            </button>
            <fb:login-button 
              scope="public_profile,email"
              onlogin="checkLoginState();">
            </fb:login-button>
          </div>
        </div>
        <div class="make-registration mb-3">
          <a href="register.php">Faça seu cadastro</a>
        </div>
        <!-- <div class="info-login mb-2">
          <div class="border-divider mr-1"></div>
          <span>Ou</span>
          <div class="border-divider ml-1"></div>
        </div>
        <div class="button-guest">
          <span>Entre como <a href="checkout.php">visitante</a></span>
        </div> -->
      </div>

    </div>
  </form>
  <div class="background-image-right">
    <img src="images/ddteasy-images/meio.png" alt="side-image-right">
  </div>
</div>

<?php include('footer.php'); ?>

<script>
  function loginFB() {
    window.location.href = "facebook.php";
  }
</script>

<script>
  $(function(){
    // $(document).on('load', function(){

    //   var _t_cookie = getCookie("cookie");

    //   if (_t_cookie != null){
    //   }else {
    //     return;
    //   }

    // })

    $('.form-login').submit(function(e){
      e.preventDefault(); 
      var _t = $(this);
      var form = $(this)[0];
      var login_validate = $(this).valid();
      var dados = new FormData(form);
      var formAction = $(this).attr('action');

      
      var btn = _t.find('button[type=\"submit\"]').html();
      var btn_w = _t.find('button[type=\"submit\"]').width();

      $.ajax({
        url : formAction,
        type: "POST",
        data:  dados,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
          _t.find('button[type=\"submit\"]').html('<i class=\"fa fa-refresh fa-spin\"></i>').width(btn_w);
        },
        success: function(res){
          if (res == 1){

            var _t_cookie = getCookie("cookie");

            if (_t_cookie == null){
              swal({
                title: "Sucesso!",
                text: "Você acabou de entrar no sistema DDTeasy!",
                icon: "success",
                confirmButtonText: "Ok!"
              })
              $('.modal.show').modal('hide');
              window.location = 'minha-conta.php'
            } else {
              swal({
                title: "Sucesso!",
                text: "Você acabou de entrar no sistema DDTeasy!",
                icon: "success",
                confirmButtonText: "Ok!"
              })
              $('.modal.show').modal('hide');
              window.location = 'checkout.php';
            }           

          } else {
            swal({
              title: "Erro ao entrar",
              text: "Houve um erro ao acessar o sistema. Por favor, verifique seu nome de usuário e senha e tente novamente.",
              icon: "error",
              confirmButtonText: "Ok!"
            })
          }
        },
        error: function(){
          swal({
            title: "Erro!",
            text: "Houve um erro ao acessar o sistema. Por favor, tente novamente mais tarde.",
            icon: "error",
            confirmButtonText: "Ok!"
          })
        }
      })

    });
  })
</script>

</body>

</html>