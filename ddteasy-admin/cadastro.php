<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Conteúdos Disponíveis para Sellers</h1>
		<div class="page-content">
			<?php include('top-box.php'); ?>
			
			<div class="row row-ddt">
				<div class="col-xl-12 col-md-12 col-sm-12 content-placer">
					<article>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores officiis, ab sit odit delectus? Hic adipisci, esse minima at molestias consequuntur ullam, ea consectetur, aperiam ipsum quae, laudantium sunt vero.</article>					
				</div>

				<div class="col-xl-6 col-md-6 col-sm-12 half-col-adjust content-placer mt-4">
					<div class="form-holder">
						<form action="requisicoes/envia-contato.php" class="form-submit" novalidate>
							<div class="row">
								<div class="col-sm-12">
									<label>Nome do arquivo:</label>
									<input type="text" name="Arquivo_nome" class="form-control" aria-label="Nome do arquivo" autocomplete="off" value="" required>
								</div>
								<div class="col-sm-12">
									<label>Serviço</label>
									<select name="Tipo_servico" class="form-control form-select" aria-label="Tipo serviço" selected>
										<option disabled selected>Selecione o serviço</option>
										<option value="Dedetizacao">Dedetização</option>
										<option value="Dedetizacao Premium">Dedetização Premium</option>
										<option value="Sanitizacao">Sanitização</option>
										<option value="Sanitizacao Premium">Sanitização Premium</option>
									</select>
								</div>
								<div class="col-sm-12">
									<label>Escolha o arquivo <strong>(PDF)</strong></label>
									<input type="file" name="Arquivo" class="form-control" accept=".pdf" required>
								</div>
								<div class="col-sm-12">
									<label>Descrição</label>
									<textarea name="Descricao" rows="4" class="form-control" required></textarea>
								</div>
								<div class="col-sm-12 mt-3">
									<button class="btn btn-primary"><i class="fa fa-send"></i> Enviar</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="col-xl-6 col-md-6 col-sm-12 half-col-adjust content-placer mt-4">
					<div class="row info-docs">
						<div class="col-md-12 col-sm-12 mb-5">
							<h6 class="txt-info">Quantidade de documentos cadastrados</h6>
							<span>No total, há 20 documentos cadastrados</span>
						</div>
						<div class="col-md-12 col-sm-12 mb-5">
							<h6 class="txt-info">Dedetização</h6>
							<span>10 documentos são relacionados a dedetização sendo 5 deles Premium</span>
						</div>
						<div class="col-md-12 col-sm-12 mb-5">
							<h6 class="txt-info">Sanitização</h6>
							<span>10 documentos são relacionados a sanitização sendo 5 deles Premium</span>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<?php include('footer.php'); ?>
</body>
</html>