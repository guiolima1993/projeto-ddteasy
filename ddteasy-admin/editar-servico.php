<?php include('header.php'); 

	
	if(isset($_GET[1]) && $_GET[1]!=''){
		$url = clean($_GET[1]);
	}else{
		goHome();
	}


	$q = Query('SELECT * FROM servico WHERE Servico = '.$url.'',0);
	if(mysqli_num_rows($q) > 0){
		$r = mysqli_fetch_assoc($q);


		//print_r($r);

	}else{
		goHome();
	}


?>
	<div class="page-container">
		<h1 class="page-title">Adicionar novo serviço</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="div-ddt-container border-div">
				<h6>Preencha os campos do formulário para fazer a adição de um novo serviço na plataforma</h6>

				<p class="my-4">Lorem ipsum, dolor sit amet consectetur, adipisicing elit. Molestias ad voluptas nulla beatae ipsam aliquam sint! Nulla quia nobis maxime voluptatem placeat sequi id, maiores sit unde cum quaerat eaque.</p>

				<div class="row">
					<div class="col-xl-8 col-md-8 col-sm-12">
						<form action="requisicoes/editar-servico.php" id="form-editar-servico" class="form-submit">
							<input type="hidden" value="<?php echo $_GET[1];   ?>" name="id">
							<div class="row">
    
								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Serviço</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="text" name="Titulo" class="form-control" value="<?php echo $r['Titulo'];   ?>" autocomplete="off" required>
								</div>   

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Categoria</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="radio" name="Categoria" value="0" <?php  if(isset($r['Categoria']) && $r['Categoria']==0){ echo 'checked'; }   ?>> Standard
									<input type="radio" name="Categoria" value="1" <?php  if(isset($r['Categoria']) && $r['Categoria']==1){ echo 'checked'; }   ?>> Premium
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Exige licença? </label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="radio" name="Licenca" value="1"  <?php  if(isset($r['Exige_licensa']) && $r['Exige_licensa']==1){ echo 'checked'; }   ?>> Sim
									<input type="radio" name="Licenca" value="0" <?php  if(isset($r['Exige_licensa']) && $r['Exige_licensa']==0){ echo 'checked'; }   ?>> Não       
								</div>
							
								<label class="col-xl-3 col-md-3 col-sm-12 mb-2 invisible-licenca">Tipo de licença</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2 invisible-licenca">
									<select name="Tipo_licensa" class="form-control" required>
										<option selected disabled>Escolha...</option>
										<?php     
											$q_tipo_doc = Query('SELECT * FROM tipo_documento WHERE Ativo = 1 ORDER BY Titulo ASC',0);
											if(mysqli_num_rows($q_tipo_doc) > 0){
												while($r_tipo_doc = mysqli_fetch_assoc($q_tipo_doc)){
										?>
											<option value="<?php echo $r_tipo_doc['Tipo_documento'];   ?>"  <?php if(isset($r['Tipo_de_licensa']) && $r['Tipo_de_licensa']==$r_tipo_doc['Tipo_documento']){ echo 'selected'; }   ?>><?php echo $r_tipo_doc['Titulo'];   ?></option>
										<?php  }   }   ?>
									</select>     
								</div> 

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Valor mínimo (R$)</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="text" name="Preco" class="form-control money-field" autocomplete="off" value="<?php echo $r['Preco_minimo'];   ?>" required>
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Situação</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="radio" name="Situacao" value="1" checked="true" <?php  if(isset($r['Ativo']) && $r['Ativo']==1){ echo 'selected'; }   ?>> Habilitado
									<input type="radio" name="Situacao" value="0"  <?php  if(isset($r['Ativo']) && $r['Ativo']==0){ echo 'selected'; }   ?>> Desabilitado
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Tipo de serviço</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="radio" name="Tipo_de_servico" value="1" <?php  if(isset($r['Tipo_de_servico']) && $r['Tipo_de_servico']==1){ echo 'checked'; }   ?>> Serviço padrão
									<input type="radio" name="Tipo_de_servico" value="0" <?php  if(isset($r['Tipo_de_servico']) && $r['Tipo_de_servico']==0){ echo 'checked'; }   ?>> Subserviço
								</div>     

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2 invisible-servico">Este subserviço é atrelado a qual serviço?</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2 invisible-servico">
									<input type="checkbox" name="Servico_mae_dedetizacao" value="1"  <?php  if(isset($r['Servico_mae_dedetizacao']) && $r['Servico_mae_dedetizacao']==1){ echo 'checked'; }   ?>> Dedetização <br />
									<input type="checkbox" name="Servico_mae_dedetizacao_premium" value="1"  <?php  if(isset($r['Servico_mae_dedetizacao_premium']) && $r['Servico_mae_dedetizacao_premium']==1){ echo 'checked'; }   ?>>
									Dedetização Premium <br />
									<input type="checkbox" name="Servico_mae_sanitizacao" value="1"  <?php  if(isset($r['Servico_mae_sanitizacao']) && $r['Servico_mae_sanitizacao']==1){ echo 'checked'; }   ?>>
									Sanitização <br />
									<input type="checkbox" name="Servico_mae_sanitizacao_premium" value="1"  <?php  if(isset($r['Servico_mae_sanitizacao_premium']) && $r['Servico_mae_sanitizacao_premium']==1){ echo 'checked'; }   ?>>
									Sanitização Premium
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Ícone</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="file" name="Icone" class="form-control" accept="image/*" >
									<?php if(isset($r['Icone']) && $r['Icone']!=''){   ?>
										<img class="img-fluid" src="<?php echo $Config['UrlSite'];  ?>imagens/servico/64/<?php  echo $r['Icone'];   ?>">
									<?php }    ?>
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Descrição</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<textarea name="Descricao" rows="4"  class="form-control" required><?php echo $r['Resumo'];   ?></textarea>
								</div>

								<div class="col-xl-12 col-md-12 col-sm-12">
									<button class="btn btn-ddt">Adicionar</button>
									<button type="button" class="btn btn-danger" onclick="cleanForm()">Cancelar</button>
									<button type="button" class="btn btn-voltar" onclick="voltar()">Voltar</button>
								</div>

							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>

<script>
	function cleanForm(){
		document.getElementById("form-servico").reset();
	}

	function voltar(){
		window.history.back();
	}

	$(function(){

		$(document).on('click', "input[name$='Licenca']", function(){
			var _t = $(this);

			if(_t.val() == "1") {

				_t.closest("form").find('.invisible-licenca').fadeIn();
			}else {
				_t.closest("form").find('.invisible-licenca').fadeOut();
			}
		})

		$(document).on('click', "input[name$='Tipo-servico']", function(){
			var _t = $(this);

			if(_t.val() == "Subservico") {
				_t.closest("form").find('.invisible-servico').fadeIn();
			}else {
				_t.closest("form").find('.invisible-servico').fadeOut();
			}
		})

		$(document).ready(function(){
			var iptLicenca = $("input[name$='Licenca']:checked");
			var iptServico = $("input[name$='Tipo-servico']:checked");

			if (iptLicenca.val() == "1") {
				$('.invisible-licenca').show();
			}

			if(iptServico.val() == "Subservico") {
				$('.invisible-servico').show();
			}
		})

	})
</script>

</body>
</html>