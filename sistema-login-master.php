<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8" />
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="description" content="Login no sistema DDTEASY" />

	  <title>Login</title>

		<script src="js/jquery.3.2.1.js"></script>
		<link rel="stylesheet" href="css/sweetalert.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		
	</head>
	<body>

		<section class="login-sistema-page">
			<div class="row justify-content-center">
				<div class="col-xl-3 col-md-4 col-sm-12">
					<img src="images/ddteasy-images/logo.png" alt="Logo DDTEASY" class="img-logo-ddteasy">

					<div class="form-container">
						<form id="form-login">
							<fieldset>
								<legend class="text-center">Entre com usuário e senha para se logar.</legend>
								<label for="email">E-mail:</label>
								<input type="text" name="Email" id="email" class="form-login-input" autocomplete="off" value="" required>
								<label for="senha">Senha:</label>
								<input type="password" name="Senha" id="senha" class="form-login-input" autocomplete="off" value="" required>

								<div class="button-box">
									<button type="submit" class="btn-logar">Entrar</button>
									<button type="button" class="btn-senha">Esqueci a senha</button>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</section>

		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.mask.js"></script>
		<script src="js/jquery.validate.js"></script>
		<script src="js/sweetalert.min.js"></script>
		<script src="js/main.js"></script>

		<script>
			$(function(){
				var emailVal = '';
				var senhaVal = '';

				$('#form-login').submit(function(e){
					e.preventDefault();
					emailVal = $('#email').val();
					senhaVal = $('#senha').val();

					if (emailVal != '' && senhaVal != ''){
						$.ajax({
							url: "requisicoes/solicita-login-master.php",
							type: "post",
							data: "Email=" + emailVal + "&Senha=" + senhaVal,
							success: function(res){
								if(res == 1){
									window.location.href = "ddteasy-admin/index.php";
								}else {

									//3 usuario nao encontrado
									//4 senha errada


									swal({
										title: "Erro",
										text: "Usuário e/ou senha errados",
										icon: "error",
										confirmButtonText: "Ok"
									})
								}
							},
							error: function(){
								swal({
									title: "Error",
									text: "Houve um problema ao tentar acessar o sistema. Tente novamente mais tarde.",
									icon: "error",
									confirmButtonText: "Ok"
								})
							}
						})
					} else {
						swal({
							title: "Atenção!",
							text: "Preencha os campos e-mail e senha para entrar!",
							icon: "warning",
							confirmButtonText: "Ok"
						})
					}
				});

				$('.btn-senha').on('click', function(){
					emailVal = $('#email').val();	

					if (emailVal == '' && emailVal == null){
						swal({
							title: "Erro",
							text: "Você precisa informar o seu e-mail para que a senha seja resetada.",
							icon: "error",
							confirmButtonText: "Entendi"

						})
					}else {
						swal({
							title: "Atenção!",
							text: "Se você continuar, a sua senha será redefinida.",
							icon: "warning",
							buttons: true,
							confirmButtonText: "Prosseguir"
						})
						.then((prosseguir) =>{
							if(prosseguir){
								$.ajax({
									url: "requisicoes/nova-senha.php",
									type: "post",
									data: "Email=" + emailVal,
									cache: false,
									success: function(res){
										if (res != 0) {
											swal({
												title: "Sua senha foi redefinida.",
												text: "A sua senha foi redefinida e enviada para o e-mail cadastrado.",
												icon: "success",
												confirmButtonText: "Ok!",
											});
										}else {
											swal({
												title: "Erro",
												text: "Houve um erro no processo.",
												icon: "error",
												confirmButtonText: "Ok"
											})
										}
									}
								});
							} else {
								swal("Você cancelou a operação.");
							}
						})

						
					}
				})



			})
		</script>

	</body>
</html>
