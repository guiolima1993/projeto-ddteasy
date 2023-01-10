<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Adicionar novo serviço</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="div-ddt-container border-div">
				<h6>Preencha os campos do formulário para fazer a adição de um novo serviço na plataforma</h6>

				<p class="my-4">Lorem ipsum, dolor sit amet consectetur, adipisicing elit. Molestias ad voluptas nulla beatae ipsam aliquam sint! Nulla quia nobis maxime voluptatem placeat sequi id, maiores sit unde cum quaerat eaque.</p>

				<div class="row">
					<div class="col-xl-8 col-md-8 col-sm-12">
						<form action="requisicoes/cadastrar-servico.php" id="form-servico" class="form-submit">
							<div class="row">

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Serviço</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="text" name="Servico_nome" class="form-control" value="" autocomplete="off" required>
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Categoria</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="radio" name="Tipo_categoria" value="Standard"> Standard
									<input type="radio" name="Tipo_categoria" value="Premium"> Premium
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Exige licença? </label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="radio" name="Licenca" value="Sim"> Sim
									<input type="radio" name="Licenca" value="Nao"> Não
								</div>
							
								<label class="col-xl-3 col-md-3 col-sm-12 mb-2 invisible-licenca">Tipo de licença</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2 invisible-licenca">
									<select name="Tipo_licenca" class="form-control" required>
										<option selected disabled>Escolha...</option>
										<?php 
											$qDoc = Query('SELECT * FROM tipo_documento WHERE Ativo = 1 ORDER BY Titulo ASC');
											while ($rDoc = mysqli_fetch_assoc($qDoc)){
										?>
											<option value="<?= $rDoc['Tipo_documento']; ?>"><?= $rDoc['Titulo']; ?></option>
										<?php } ?>
									</select>
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Valor mínimo (R$)</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="text" name="Preco" class="form-control money-field" autocomplete="off" value="" required>
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Situação</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="radio" name="Situacao" value="Habilitado"> Habilitado
									<input type="radio" name="Situacao" value="Desabilitado"> Desabilitado
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Tipo de serviço</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="radio" name="Tipo_servico" value="Servico"> Serviço padrão
									<input type="radio" name="Tipo_servico" value="Subservico"> Subserviço
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2 invisible-servico">Este subserviço é atrelado a qual serviço?</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2 invisible-servico">
									<input type="checkbox" name="Servico_mae_dedetizacao" value="1"> Dedetização <br />
									<input type="checkbox" name="Servico_mae_dedetizacao_premium" value="1">
									Dedetização Premium <br />
									<input type="checkbox" name="Servico_mae_sanitizacao" value="1">
									Sanitização <br />
									<input type="checkbox" name="Servico_mae_sanitizacao_premium" value="1">
									Sanitização Premium
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Ícone</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<input type="file" name="Foto_icone" class="form-control" accept="image/*" required>
								</div>

								<label class="col-xl-3 col-md-3 col-sm-12 mb-2">Descrição</label>
								<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
									<textarea name="Descricao_servico" rows="4" class="form-control" required></textarea>
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

			if(_t.val() == "Sim") {

				_t.closest("form").find('.invisible-licenca').fadeIn();
			}else {
				_t.closest("form").find('.invisible-licenca').fadeOut();
			}
		})

		$(document).on('click', "input[name$='Tipo_servico']", function(){
			var _t = $(this);

			if(_t.val() == "Subservico") {
				_t.closest("form").find('.invisible-servico').fadeIn();
			}else {
				_t.closest("form").find('.invisible-servico').fadeOut();
			}
		})

	})
</script>

</body>
</html>