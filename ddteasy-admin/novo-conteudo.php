<?php include('header.php'); ?>

<div class="page-container">
	<h1 class="page-title">Adicione novo conteúdo</h1>

	<div class="page-content">
		<?php include('top-box.php'); ?>

		<div class="div-ddt-container border-div">
			<h6>Preencha os campos do formulário para adição de um novo conteúdo</h6>
			<form id="form-conteudo" action="requisicoes/envia-novo-conteudo.php" class="form-submit mt-5">
				<div class="row">
					
					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Título
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<input type="text" name="Titulo" class="form-control" autocomplete="off" value="" required>
					</div>

					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Serviço
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<select name="Tipo_servico" class="form-control" required>
							<?php      
								$q = Query('SELECT * FROM servico WHERE Ativo = 1 ORDER BY Titulo ASC',0);
								if(mysqli_num_rows($q) > 0){
									while($r = mysqli_fetch_assoc($q)){
							?>
								<option value="<?php echo $r['Servico'];    ?>"><?php echo $r['Titulo'];    ?></option>
							<?php  }  } ?>
						</select>
					</div>

					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Data da última atualização
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<input type="date" name="Atualizacao" class="form-control" required>
					</div>  

					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Status
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<input type="radio" name="Status" value="1" checked="true"> Ativo
						<input type="radio" name="Status" value="0" class="ms-4"> Inativo
					</div>
     
					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Upload
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<input type="file" name="Icone" class="form-control" accept=".pdf" required>
					</div>

					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Descrição
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<textarea name="Descricao" rows="4" class="form-control" required></textarea>
					</div>

					<div class="col-xl-12 col-sm-12">
						<button class="btn btn-ddt">Enviar</button>
						<button type="button" class="btn btn-danger" onclick="cleanForm()">Cancelar</button>
						<button type="button" class="btn btn-voltar" onclick="voltar()">Voltar</button>
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

	function cleanForm(){
		document.getElementById("form-conteudo").reset();
	}
</script>
</body>
</html>