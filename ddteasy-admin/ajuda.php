<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Clique nos botões para expandir</h1>

		<div class="page-content">
			<div class="accordion" id="accordion-ajuda">
			  <div class="accordion-item">
			    <h2 class="accordion-header" id="ajudaId1">
			      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
			        Accordion Item #1
			      </button>
			    </h2>
			    <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="ajudaId1" data-bs-parent="#accordion-ajuda">
			      <div class="accordion-body">
			        Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Quam eos maiores, omnis nesciunt temporibus placeat aperiam, sunt quia unde vitae qui natus accusamus dignissimos corporis sequi ipsam laboriosam magni incidunt.
			      </div>
			    </div>
			  </div>
			  <div class="accordion-item">
			    <h2 class="accordion-header" id="ajudaId2">
			      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
			        Accordion Item #2
			      </button>
			    </h2>
			    <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="ajudaId2" data-bs-parent="#accordion-ajuda">
			      <div class="accordion-body">
			        Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Quam eos maiores, omnis nesciunt temporibus placeat aperiam, sunt quia unde vitae qui natus accusamus dignissimos corporis sequi ipsam laboriosam magni incidunt.
			      </div>
			    </div>
			  </div>
			  <div class="accordion-item">
			    <h2 class="accordion-header" id="ajudaId3">
			      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
			        Accordion Item #3
			      </button>
			    </h2>
			    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="ajudaId3" data-bs-parent="#accordion-ajuda">
			      <div class="accordion-body">
			        Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Quam eos maiores, omnis nesciunt temporibus placeat aperiam, sunt quia unde vitae qui natus accusamus dignissimos corporis sequi ipsam laboriosam magni incidunt.
			      </div>
			    </div>
			  </div>
			</div>

			<?php /*
			<div class="text-container">
				<span>Se a sua dúvida não está no FAQ acima, então clique <button type="button" class="btn-noborder btn-form-show">aqui</button> e nos envie</span>
			</div> */ ?>

			<div class="form-collapse">
				<form action="requisicoes/envia-contato.php" class="form-submit">
					<div class="row">
						<div class="col-xl-12 col-md-12 col-sm-12">
							<label>Nome</label>
							<input type="text" name="Nome" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-xl-12 col-md-12 col-sm-12">
							<label>E-mail</label>
							<input type="email" name="Email" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-xl-12 col-md-12 col-sm-12">
							<label>Deixe a sua dúvida abaixo</label>
							<textarea name="Mensagem" rows="4" class="form-control" required></textarea>
						</div>
						<div class="col-xl-12 col-md-12 col-sm-12">
							<button class="btn btn-enviar mt-3"><i class="fa fa-send"></i> Enviar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>
<script>
	$(function() {

		$(document).on('click', '.page-container .page-content .text-container button.btn-form-show', function(){
			var _t = $(this);

			_t.closest('.page-content').find('.form-collapse').toggle('slow');
		})
	});
</script>
</body>
</html>