<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Serviços</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>		

			<div class="div-ddt-container border-div">
				<h6>Lista de serviços</h6>
				<p class="my-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati aliquid saepe quibusdam repellendus molestias repudiandae nihil laborum provident cupiditate nostrum esse quia voluptate voluptas aperiam, sed dolor voluptatem! Laborum, sed?</p>
				<div class="d-block">
					<a href="novo-servico.php" class="btn btn-ddt">Adicionar novo serviço</a>
				</div>
				<hr class="mt-2" />

				<div class="row mt-4">
				<?php     
					$q_servico = Query('SELECT * FROM servico ORDER BY Servico DESC',0);
					if(mysqli_num_rows($q_servico) > 0){ 
						while($r_servico = mysqli_fetch_assoc($q_servico)){
				?>
					<div class="col-xl-12 col-sm-12">
						
						<div class="card-ddt">
							<div class="card-ddt-icon">
								<img src="<?php  echo $Config['UrlSite'];   ?>imagens/servico/64/<?php  echo $r_servico['Icone'];   ?>" alt="<?php  echo $r_servico['Titulo'];   ?>" class="card-ddt-img">
							</div>
							<div class="card-ddt-body">
								<h4 class="card-ddt-title"><?php  echo $r_servico['Titulo'];   ?></h4>
								<p class="limit-text" data-length="380"><?php  echo $r_servico['Resumo'];   ?></p>
								<hr class="mt-2" />
								<div class="card-ddt-info">
									<em>Valor R$ <?php  echo $r_servico['Preco_minimo'];   ?></em>
									<a href="editar-servico.php?1=<?php  echo $r_servico['Servico'];   ?>" class="card-ddt-info-btn">Editar</a>			
								</div>
							</div>
						</div>

					</div>
				<?php  }  }  ?>
				</div>
			</div>

			<div class="div-ddt-container border-div mt-4">
				<h6>Pragas</h6>

				<div class="add-plague row my-3">
					<div class="col-xl-6 col-md-6 col-sm-12">
						<button type="button" class="btn btn-ddt btn-add-plague">Adicionar praga</button>
					</div>

					<div class="col-xl-6 col-md-6 col-sm-12">
						<form action="requisicoes/cadastrar-praga.php" class="form-praga">
							<div class="row">
								<label class="col-sm-3"><b>Nome praga:</b></label>
								<div class="position-relative col-sm-9">
									<input type="text" name="Praga_nome" class="form-control" autocomplete="off" value="" required>
									<button class="btn btn-cadastrar">Cadastrar</button>
								</div>								
							</div>
						</form>
					</div>
				</div> 
				<hr>
				<ul class="list-pragas">
				<?php     
					$q_praga = Query('SELECT * FROM praga WHERE Ativo = 1 ORDER BY Titulo ASC',0);
					if(mysqli_num_rows($q_praga) > 0){
						while($r_praga = mysqli_fetch_assoc($q_praga)){
				?>
					<li class="list-pragas-items">
						<button class="btn btn-trash" data-id="<?php echo $r_praga['Praga'];   ?>"><i class="fa fa-trash"></i></button>
						<?php echo $r_praga['Titulo'];   ?>
					</li>
				<?php  }   }    ?>
				</ul>    
			</div>
					
		</div>
	</div>
</section>
<?php include('footer.php'); ?>

<script>
	$(function(){
		$(document).on('click', '.add-plague .btn-add-plague', function(){
			var _t = $(this);

			_t.closest('.add-plague').find('.form-praga').fadeIn();
		})

		$(document).on('submit', '.form-praga', function(e){
			e.preventDefault();
			$(this).validate();
			var tForm = $(this)[0];
			var tAction = $(this).attr('action');
			var tValid = $(this).valid();

			if (!tValid){
				return false;
			} else {
				var tDados = new FormData(tForm);
				$.ajax({
					url: tAction,
					type: "post",
					data: tDados,
					mimeType:"multipart/form-data",
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
          	if(data == 1){
          		swal({
          			title: "Sucesso",
	              text: "Envio realizado com sucesso",
	              icon: "success",
	              confirmButtonText: "Ok"
          		});
          		$('.modal.show').modal('hide');
              location.reload();
          	}else {
          		swal({
          			title: "Erro!",
	              text: "Houve um erro ao cadastrar. Tente novamente mais tarde!",
	              icon: "error",
	              confirmButtonText: "Ok"
          		});
          		$('.modal.show').modal('hide');
          	}
          }
				})
			}
		})

		$(document).on('click', '.list-pragas .list-pragas-items .btn-trash', function(){
			let pragaId = $(this).data('id');

			swal("Atenção!", "Você tem certeza que deseja apagar uma praga?", "info", {
				buttons: {
					cancel: "Cancelar",
					continuar: {
						text: "Continuar",
						value: "continuar"
					}

				}
			}).then((continuar) => {
				if(continuar){
					$.ajax({
						url: 'requisicoes/excluir-praga.php',
						data: {
							id: pragaId
						},
						type: 'post',
						cache: false,
						success: function(res){
							if(res != 0){
								swal({
									title: "Sucesso!",
									text: "Você apagou uma praga com sucesso.",
									icon: "success"
								})
								location.reload();
							}else {
								swal({
									title: "Ops!",
									text: "Houve um erro ao tentar apagar uma praga!",
									icon: "error"
								})
							}
						},
						error: function(){
							swal({
								title: "Erro!",
								text: "Houve um erro ao tentar executar esta função. Tente novamente mais tarde.",
								icon: "error"
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