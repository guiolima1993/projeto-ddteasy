<?php include('header.php'); 


	if(isset($_GET[1]) && $_GET[1]!=''){
		$url = clean($_GET[1]);
	}else{
		goHome();
	}


	$q = Query('SELECT * FROM parceiro WHERE  Parceiro = '.$url.'',0);
	if(mysqli_num_rows($q) > 0){
		$r = mysqli_fetch_assoc($q);


		//print_r($r);

	}else{
		goHome();
	}


?>

	<div class="page-container">
		<h1 class="page-title">Nova solicitação de parceria</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="div-ddt-container border-div">
				<h6>Um novo pedido de parceria foi solicitado!</h6>

				<div class="row mt-5">
					<div class="col-xl-8 col-md-7 col-sm-12">
						<div class="row">
							<label class="col-xl-3 col-md-3 col-sm-12 mb-2"><b>Nome Fantasia:</b></label>
							<div class="col-xl-9 col-md-9 col-sm-12 col-mb-2">
								<span><?php echo $r['Titulo'];    ?></span>
							</div>

							<label class="col-xl-3 col-md-3 col-sm-12 mb-2"><b>Razão Social:</b></label>
							<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
								<span><?php echo $r['Nome_empresa'];    ?></span>
							</div>

							<label class="col-xl-3 col-md-3 col-sm-12 mb-2"><b>Nome Contato:</b></label>
							<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
								<span>Nome Contato</span>
							</div>

							<label class="col-xl-3 col-md-3 col-sm-12 mb-2"><b>CNPJ:</b></label>
							<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
								<span><?php echo $r['Cnpj'];    ?></span>
							</div>							

							<label class="col-xl-3 col-md-3 col-sm-12 mb-2"><b>E-mail Corporativo:</b></label>
							<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
								<span><?php echo $r['Email'];    ?></span>
							</div>

							<label class="col-xl-3 col-md-3 col-sm-12 mb-2"><b>Telefone:</b></label>
							<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
								<span><?php echo $r['Telefone'];    ?></span>
							</div>

							<label class="col-xl-3 col-md-3 col-sm-12 mb-2"><b>Forma de contato preferencial:</b></label>
							<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
								<span><?php echo $r['Como_podemos_falar'];    ?></span>
							</div>

							<label class="col-xl-3 col-md-3 col-sm-12 mb-2"><b>Status:</b></label>
							<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
								<span><?php if(isset($r['Ativo']) && $r['Ativo']==1){ echo 'Ativo'; }else{ echo 'Desativado'; }    ?></span>
							</div>
 

						</div>
					</div>

					<div class="col-xl-4 col-md-5 col-sm-12">
						<em>
							Atenção! <br />

							Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa, beatae, eaque. Nobis eum maiores, deleniti doloribus quae sunt, perferendis accusantium est officiis consequatur culpa repellat error quo magnam voluptate rerum.
						</em>
					</div>
				</div>
	
				<div class="mt-5">
					<button type="button" id="btn-aceitar" class="btn btn-ddt">Aceitar parceiro</button>
					<button type="button" id="btn-recusar" class="btn btn-danger">Recusar parceiro</button>
					<button class="btn btn-voltar" onclick="voltar()">Voltar</button>
				</div>
				
			</div>
		</div>

	</div>

</section>
<?php include('footer.php'); ?>
<script>
	function voltar(){
		window.history.back();
	}

	$(function(){
		var url_local = window.location.href;
		var param = url_local.split('?');
		var id_param = param[1];
		var id_divisor = id_param.split('=');
		var n_id = id_divisor[1];

		$(document).on('click', '#btn-aceitar', function(){
			swal("Atenção!", "Você tem certeza de que quer aceitar a parceria com este seller?", {
				buttons: {
					cancel: "Cancelar",
					continuar: {
						text: "Aceitar",
						value: "continuar"
					}
				}
			}).then((continuar) => {
				if(continuar){
					$.ajax({
						url: 'requisicoes/aceitar-seller.php',
						data: {
							id: n_id
						},
						cache: false,
						method: 'POST',
						success: function(res){
							if (res != 0){
								swal({
									title: 'Sucesso!',
									text: 'Você acabou de aceitar parceria com um novo seller!',
									icon: 'success',
									confirmButtonText: 'Ok!'
								}).then((ok) => {
									if(ok){
										window.history.back();
									}
								})
							}else {
								swal({
									title: 'Erro',
									text: 'Houve um erro ao aceitar esta parceria. Por favor, tente novamente mais tarde',
									icon: 'error',
									confirmButtonText: 'Ok!'
								})
							}
						},
						error: function(){
							swal({
								title: 'Erro',
								text: 'Houve um erro ao aceitar esta parceria. Por favor, tente novamente mais tarde',
								icon: 'error',
								confirmButtonText: 'Ok!'
							})
						}
					})
				}
			})
		})

		$(document).on('click', '#btn-recusar', function(){
			swal("Atenção!", "Você tem certeza de que deseja recusar a parceria com este seller?", {
				buttons: {
					cancel: "Cancelar",
					continuar: {
						text: "Recusar",
						value: "continuar"
					}
				}
			}).then((continuar) => {
				if(continuar){
					$.ajax({
						url: 'requisicoes/negar-seller.php',
						data: {
							Id: n_id
						},
						cache: false,
						success: function(res){
							if(res != 0){
								swal({
									title: 'Parceria recusada',
									text: 'Você recusou a parceria.',
									icon: 'success',
									confirmButtonText: 'Ok'
								}).then((ok) => {
									if(ok){
										window.history.back();
									}
								})
							}else {
								swal({
									title: 'Error',
									text: 'Houve um erro ao tentar recusada esta parceria. Tente novamente mais tarde',
									icon: 'error',
									confirmButtonText: 'Ok'
								})
							}
						},
						error: function(){
							swal({
								title: 'Error',
								text: 'Houve um erro ao tentar encerrar esta parceria. Tente novamente mais tarde',
								icon: 'error',
								confirmButtonText: 'Ok'
							})
						}
					})
				}
			})
		})
	})
</script>
</body>
</html>