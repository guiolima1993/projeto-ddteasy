<?php include('header.php'); 

	if(isset($_GET[1]) && $_GET[1]!=''){
		$url = clean($_GET[1]);
	}else{
		goHome();
	}


	$q = Query('SELECT * FROM parceiro WHERE Parceiro = '.$url.'',0);
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
									<?php     
										$qForma_contato = Query('SELECT * FROM forma_contato WHERE Forma_contato ='.$r['Forma_contato']);
										$rForma_contato = mysqli_fetch_assoc($qForma_contato);
										$Forma_contato = "";
				
										if($rForma_contato['Telefone'] == 1){
											$Forma_contato .= 'Telefone';
										}
				
										if($rForma_contato['Whatsapp'] == 1){
											if($Forma_contato != ""){
												$Forma_contato .= ', Whatsapp';
											}else{
												$Forma_contato .= 'Whatsapp';
											}
										}
				
										if($rForma_contato['Email'] == 1){
											if($Forma_contato != ""){
												$Forma_contato .= ', Email';
											}else{
												$Forma_contato .= 'Email';
											}
										}
									?>
								<span><?= $Forma_contato; ?></span>
							</div>
							<label class="col-xl-3 col-md-3 col-sm-12 mb-2"><b>Data de cadastro:</b></label>
							<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
								<span>
									<?php $oldDate = strtotime($r['Data_cadastro']);
										$newDate = date('d/m/Y', $oldDate);
										echo $newDate;
									?>
								</span>
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
					<h6>Documentação enviada</h6>
					<div class="row justify-content-between mt-3">
						<div class="col-xl-7 col-md-7 col-sm-12">
							<table id="table-seller-doc" class="table">
								<thead>
									<tr>
										<th>Tipo de documento</th>
										<th>Documento (íntegra)</th>
										<th>Validade</th>
									</tr>
								</thead>
								<tbody>
								<?php      
									$q_doc_parceiro = Query('SELECT * FROM documento WHERE Parceiro  = '.$url.'',0);
									if(mysqli_num_rows($q_doc_parceiro) > 0){
										while($r_doc_parceiro = mysqli_fetch_assoc($q_doc_parceiro)){							
								?>
									<tr>
										<td><?php echo get('tipo_documento',$r_doc_parceiro['Tipo_documento']);    ?></td>
										<td><a href="<?php echo $Config['UrlSite'];    ?>imagens/documento/<?php echo $r_doc_parceiro['Arquivo'];    ?>"><?php echo $r_doc_parceiro['Arquivo'];    ?></a></td>
										<td class="td-validade">
											<span class="validar-data">20/12/2022</span>
											<button type="button" class="btn btn-ddt hidden-btn" data-bs-toggle="modal" data-bs-target="#modal-data">Adicionar data</button>
										</td>
									</tr>
								<?php  }   }   ?>
								</tbody>
							</table>
						</div>
						<div class="col-xl-4 col-md-5 col-sm-12">
							<em>
								Atenção! <br />
								<br />
								Antes de selecionar a data de vencimento, veja se a data é a mesma referenciada no documento enviado pelo parceiro!
							</em>
						</div>
					</div>
				</div>

				<div class="mt-5">
					<button type="button" class="btn btn-ddt" data-bs-toggle="modal" data-bs-target="#modal-notificacao">Enviar Notificação</button>
					<?php if($r['Ativo'] == 1){ ?>
						<button type="button" id="btn-suspender" class="btn btn-ddt-b">Suspender</button>
						<button type="button" id="btn-reativar" class="btn btn-ddt invisible-button">Ativar</button>
					<?php } else { ?>
						<button type="button" id="btn-suspender" class="btn btn-ddt-b invisible-button">Suspender</button>
						<button type="button" id="btn-reativar" class="btn btn-ddt">Ativar</button>
					<?php } ?>
					<button type="button" id="btn-encerrar" class="btn btn-danger">Encerrar Parceria</button>
					<button type="button" class="btn btn-voltar" onclick="voltar()">Voltar</button>
				</div>
			</div>
		</div>

	</div>    

</section>
<?php include('footer.php'); ?>

<!-- MODAL VENCIMENTO -->
<div class="modal fade" id="modal-data" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atribuir vencimentos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Atribua a data de vencimento ao documento XXXX</p>

        <form action="requisicoes/envia-contato.php" class="mt-4 form-vencimento">
        	<div class="form-row">
        		<div class="col-md-12 col-sm-12">
        			<label>Informe a data de vencimento</label>
        			<input type="date" name="" name="Data-vencimento" class="form-control" value="" required>
        		</div>
        		<div class="col-md-12 col-sm-12 mt-2">
        			<button class="btn btn-ddt">Atribuir</button>
        		</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
	function voltar(){
		window.history.back();
	}

	var i;
	var tdValidate = document.querySelectorAll(".td-validade");

	for (i = 0; i < tdValidate.length; i++){

		var dataVerify = document.querySelectorAll(".td-validade")[i].getElementsByClassName("validar-data")[0].innerHTML;

		if (dataVerify == "" || dataVerify == null){

			document.querySelectorAll(".td-validade")[i].getElementsByClassName("validar-data")[0].style.display='none';

			document.querySelectorAll(".td-validade")[i].getElementsByClassName("hidden-btn")[0].style.display='block';

		}

	}

	$(function(){
		var url_local = window.location.href;
		var param = url_local.split('?');
		var id_param = param[1];
		var id_divisor = id_param.split('=');
		var n_id = id_divisor[1];

		$(document).on('click', '#btn-suspender', function(){
			swal("Atenção!", "Atenção: você tem certeza de que deseja suspender este seller da plataforma?", {

				buttons: {
					cancel: "Cancelar",
					continuar: {
						text: "Suspender seller",
						value: "suspender"
					}
				}
			}).then((suspender) => {
				if(suspender){
					$.ajax({
						url: 'requisicoes/negar-seller.php',
						data: {
							id: n_id
						},
						type: "post",
						cache: false,
						success: function(res){
							if (res != 0){
								swal({
									title: 'Sucesso!',
									text: 'O seller foi suspenso com sucesso!',
									icon: 'success',
									confirmButtonText: 'Ok!'
								})
								$('#btn-suspender').addClass('invisible-button');
								$('#btn-reativar').removeClass('invisible-button');
							}else {
								swal({
									title: 'Erro',
									text: 'Houve um erro ao suspender o seller. Por favor, tente novamente mais tarde',
									icon: 'error',
									confirmButtonText: 'Ok!'
								})
							}
						},
						error: function(){
							swal({
								title: 'Erro',
								text: 'Houve um erro ao suspender o seller. Por favor, tente novamente mais tarde',
								icon: 'error',
								confirmButtonText: 'Ok!'
							})
						}
					})
				}
			})			
		})

		$(document).on('click', '#btn-reativar', function(){
			swal("Atenção", "Atenção: você tem certeza de que deseja reativar este seller?",{
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
						url: 'requisicoes/aceitar-seller.php',
						data: {
							id: n_id
						},
						type: "post",
						cache: false,
						success: function(res){
							if (res != 0){
								swal({
									title: 'Sucesso!',
									text: 'O seller foi ativo com sucesso!',
									icon: 'success',
									confirmButtonText: 'Ok!'
								})

								$('#btn-reativar').addClass('invisible-button');
								$('#btn-suspender').removeClass('invisible-button');
							}else {
								swal({
									title: 'Erro',
									text: 'Houve um erro ao ativar o seller. Por favor, tente novamente mais tarde',
									icon: 'error',
									confirmButtonText: 'Ok!'
								})
							}
						},
						error: function(){
							swal({
								title: 'Erro',
								text: 'Houve um erro ao ativar o seller. Por favor, tente novamente mais tarde',
								icon: 'error',
								confirmButtonText: 'Ok!'
							})
						}
					})
				}
			})			
		})

		$(document).on('click', '#btn-encerrar', function(){
			swal("Atenção!", "Você tem certeza de que deseja encerrar permanentemente a parceria com este seller?", {

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
						url: 'requisicoes/excluir-parceiro.php',
						data: {
							id: n_id
						},
						type: "post",
						cache: false,
						success: function(res){
							if(res != 0){
								swal({
									title: 'Parceria encerrada',
									text: 'Você acabou de encerrar esta parceria.',
									icon: 'success',
									confirmButtonText: 'Ok'
								})
							}else {
								swal({
									title: 'Erro',
									text: 'Houve um erro ao tentar encerrar esta parceria. Tente novamente mais tarde',
									icon: 'error',
									confirmButtonText: 'Ok'
								})
							}
						},
						error: function(){
							swal({
								title: 'Erro',
								text: 'Houve um erro ao tentar encerrar esta parceria. Tente novamente mais tarde',
								icon: 'error',
								confirmButtonText: 'Ok'
							})
						}
					})
				}
			})
		})

		$('.form-vencimento').submit(function(e){
			e.preventDefault();
			let tAction = $(this).attr('action');
			let _t_form = $(this);
			let f_data = new FormData(form);

			$.ajax({
				url: tAction,
				data: f_data,
				type: "post",
				mimeType: "multipart/form-data",
				cache: false,
				success: function(res){
					if(res != 0){
						swal({
							title: "Sucesso!",
							text: "Notificação enviada!",
							icon: "success",
							confirmButtonText: "Ok!"
						})
					}else {
						swal({
							title: "Erro",
							text: "Houve um erro ao enviar a notificação.",
							icon: "error",
							confirmButtonText: "Ok!"
						})
					}
				}
			})

		})
	})
</script>
</body>
</html>