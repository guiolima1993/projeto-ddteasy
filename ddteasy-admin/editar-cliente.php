<?php include('header.php'); 

	
	$url = "";

	if(isset($_GET[1]) && $_GET[1]!=''){
		$url = clean($_GET[1]);
	}else{
		echo 0;
		exit;
	}


	$q = Query('SELECT * FROM cliente WHERE Cliente = '.$url.'',0);

	if(mysqli_num_rows($q) > 0){
		$r = mysqli_fetch_assoc($q);
	}else{
		echo 0;
		exit;
	}

?>
	<div class="page-container">
		<h1 class="page-title">Visão cliente</h1>

		<div class="page-content">
			<div class="form-wrapper-cliente div-ddt-container border-div">
				<h6 class="mb-5">Nome Sobrenome Cliente:</h6>
				<form action="" class="form-validate formCliente">
					<div class="row">
						<?php /*<div class="col-lg-12 col-sm-12">
							<div class="mt-1">
								<img src="images/icons/162-100x133.jpg" alt="Foto_funcionario" class="img-funcionario">
							</div>
						</div> */ ?>
						<div class="col-lg-12 col-sm-12">
							<label>Nome</label>
							<input type="text" name="Nome" class="form-control" autocomplete="off" value="<?php  echo $r['Titulo'];   ?> (Não editável)" disabled required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>CPF</label>
							<input type="text" name="Cpf" class="form-control cpf-field" autocomplete="off" value="<?php  echo $r['Cpf'];   ?>" disabled required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Data de cadastro</label>
							<input type="text" name="Data-cadastro" class="form-control" value="<?php  echo formata_data($r['Data_cadastro']);   ?>" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>E-mail</label>
							<input type="email" name="Email" class="form-control" autocomplete="off" value="<?php echo $r['Email'];   ?>" required>
						</div>
						<div class="col-lg-7 col-sm-12">
							<label>Endereço</label>
							<input type="text" name="Endereco" class="form-control" autocomplete="off" value="<?php  echo $r['Endereco'];   ?>" required>
						</div>
						<div class="col-lg-1 col-sm-12">
							<label>Número</label>
							<input type="number" name="Numero" class="form-control" autocomplete="off" value="<?php echo $r['Numero'];   ?>" required>
						</div>
						<div class="col-lg-2 col-sm-12">
							<label>Complemento</label>
							<input type="text" name="Complemento" class="form-control" autocomplete="off" value="<?php echo $r['Complemento'];   ?>">
						</div>
						<div class="col-lg-2 col-sm-12">
							<label>CEP</label>
							<input type="text" name="CEP" class="form-control cep-field" autocomplete="off" value="<?php echo  $r['Cep'];   ?>" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Telefone</label>
							<input type="text" name="Telefone" class="form-control cel-field" autocomplete="off" value="<?php echo $r['Telefone'];   ?>" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Situação</label>
							<input type="text" name="Situacao" class="form-control" autocomplete="off" value="<?php  if($r['Ativo']==1){   ?>Ativo<?php }else{   ?>Desativado<?php }  ?>" disabled required>
						</div>						
						<div class="col-lg-3 col-sm-12">
							<label>Local</label>
							<select name="Uf" class="form-control" required>
								<option value="Uf">uf</option>
								<option value="Uf">uf</option>
								<option value="Uf">uf</option>
								<option value="Uf">uf</option>
							</select>
						</div>
						<div class="col-lg-9 col-sm-12">
							<label>Cidade</label>
							<input type="text" name="Cidade" class="form-control" autocomplete="off" value="<?php echo $r['Cidade'];   ?>" required>
						</div>						
						<div class="col-lg-3 col-sm-12 mt-1">
							<label>Quantidade de chamados:</label> 
							<span><?php  echo $chamados_count;   ?></span>
						</div>
						<div class="col-lg-3 col-sm-12 mt-1">
							<label>Avaliação média:</label> 
							<span><?php  echo $avaliacao_media;   ?></span>
						</div>
						<div class="col-lg-12 col-sm-12 mt-1">
							<label>Observacao</label>
							<textarea name="Observacao" rows="4" value="<?php echo $r['Observacao'];   ?>" class="form-control" required></textarea>
						</div>
						<div class="col-lg-12 col-sm-12">
							<button class="btn btn-ddt mt-3">Enviar observação</button>
							
						<?php  if($r['Ativo']==1){   ?>
							<button type="button" id="btn-suspender" class="btn btn-ddt-b mt-3">Suspender</button>
						<?php  }else{   ?>
							<button type="button" id="btn-reativar" class="btn btn-ddt mt-3">Reativar</button>
						<?php  }      ?>
							
							<?php /*<button type="button" id="btn-excluir" class="btn btn-danger mt-3">Excluir</button> */?>
							<button type="button" class="btn btn-voltar mt-3" onclick="voltar()">Voltar</button>
						</div>
					</div>
				</form>
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
		var getUrlParam = window.location.search.substring(1);
		var getValue = getUrlParam.split("=");
		var customerId = getValue[1];

		$(document).on('click', '#btn-suspender', function(){
			swal("Você tem certeza de que deseja suspender este cliente?", {
				buttons: {
					cancel: "Cancelar suspensão",
					continuar: {
						text: "Suspender cliente",
						value: "continuar"
					}
				}
			}).then((continuar) => {
				if(continuar){
					$.ajax({
						url: 'requisicoes/suspender-cliente.php',
						data: {
							id: customerId
						},
						type: "post",
						cache: false,
						success: function(res){
							if(res == 1){
								swal("Ok!", "Você acabou de suspender este cliente.", "success");
							}else {
								swal("Ops!", "Houve um problema ao tentar suspender o cliente.", "error");
							}
						},
						error: function(){
							swal("Erro", "Houve um erro ao tentar executar esta função.", "error");
						}
					})
				}
			})
		})

		$(document).on('click', '#btn-reativar', function(){
			swal("Você tem certeza de que deseja reativar este cliente?", {
				buttons: {
					cancel: "Manter suspensão",
					continuar: {
						text: "Reativar cliente",
						value: "continuar"
					}
				}
			}).then((continuar) => {
				if(continuar){
					$.ajax({
						url: 'requisicoes/reativar-cliente.php',
						data: {
							id: customerId
						},
						type: "post",
						cache: false,
						success: function(res){
							if(res == 1){
								swal("Ok!", "Você reativou este cliente com sucesso!.", "success");
							}else {
								swal("Ops!", "Houve um problema ao tentar reativar o cliente.", "error");
							}
						},
						error: function(){
							swal("Erro", "Houve um erro ao tentar executar esta função.", "error");
						}
					})
				}
			})
		})

		$(document).on('click', '#btn-excluir', function(){
			swal("Você tem certeza de que deseja apagar permanentemente este cliente?", {
				buttons: {
					cancel: "Não apagar",
					continuar: {
						text: "Apagar cliente",
						value: "continuar"
					}
				}
			}).then((continuar) => {
				if(continuar){
					$.ajax({
						url: 'requisicoes/excluir-cliente.php',
						data: {
							id: customerId
						},
						type: "post",
						cache: false,
						success: function(res){
							if(res == 1){
								swal("Ok!", "Você apagou permanentemente este cliente.", "success");
							}else {
								swal("Ops!", "Houve um problema ao tentar apagar o cliente.", "error");
							}
						},
						error: function(){
							swal("Erro", "Houve um erro ao tentar executar esta função.", "error");
						}
					})
				}
			})
		})

	})
</script>
</body>
</html>