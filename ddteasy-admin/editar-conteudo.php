<?php include('header.php'); ?>

<div class="page-container">
	<h1 class="page-title">Adicione novo conteúdo</h1>

	<div class="page-content">
		<?php include('top-box.php'); ?>

		<div class="div-ddt-container border-div">
			<h6>Preencha os campos do formulário para adição de um novo conteúdo</h6>
			<form id="form-conteudo" action="requisicoes/envia-contato.php" class="form-submit mt-5">
				<div class="row">
					
					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Título
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<input type="text" name="Titulo" class="form-control" autocomplete="off" value="Títulos do conteúdo" required>
					</div>

					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Serviço
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<input list="listaServico" name="Tipo-servico" value="Dedetização Premium" class="form-control" required>
						<datalist id="listaServico">
							<option value="Dedetização"></option>
							<option value="Sanitização"></option>
							<option value="Dedetização Premium"></option>
							<option value="Sanitização Premium"></option>
							<option value="Dedetização/Sanitização"></option>
						</datalist>
					</div>

					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Data da última atualização
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<input type="date" name="Atualizacao" class="form-control" value="2020-06-20" required>
					</div>

					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Status
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<input type="radio" name="Status" value="Ativo" checked="true"> Ativo
						<input type="radio" name="Status" value="Inativo" class="ms-4"> Inativo
					</div>

					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Upload
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<input type="file" name="Upload-conteudo" class="form-control" accept=".pdf" required>
						<a href="documentos/Doc_teste.pdf" target="_blank" class="mt-2">conteudo_atual.pdf</a>
					</div>

					<label class="col-xl-3 col-md-3 col-sm-12 mb-2">
						Descrição
					</label>
					<div class="col-xl-9 col-md-9 col-sm-12 mb-2">
						<textarea name="Descricao" rows="4" class="form-control" required></textarea>
					</div>

					<div class="col-xl-12 col-sm-12">
						<button class="btn btn-ddt">Enviar</button>
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
</script>
</body>
</html>