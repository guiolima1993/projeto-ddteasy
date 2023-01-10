<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Clique nos botões para expandir</h1>

		<div class="page-content">
			<div class="accordion" id="accordion-ajuda">
			 <?php  
			 	$first = 0;    
			 	$q = Query('SELECT * FROM ajuda_seller WHERE Ativo = 1 ORDER BY Titulo ASC',0);
			 	if(mysqli_num_rows($q) > 0){
					while($r = mysqli_fetch_assoc($q)){
			?>
			  <div class="accordion-item">
			    <h2 class="accordion-header" id="ajudaId<?php echo $r['Ajuda_seller'];    ?>">
			      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $r['Ajuda_seller'];    ?>" <?php  if($first){  ?>aria-expanded="true"<?php  }  ?> aria-controls="collapse<?php echo $r['Ajuda_seller'];    ?>">
			        <?php echo $r['Titulo'];    ?>
			      </button>
			    </h2>
			    <div id="collapse<?php echo $r['Ajuda_seller'];    ?>" class="accordion-collapse collapse <?php  if($first){  ?>show<?php $first = 1; }  ?>" aria-labelledby="ajudaId1" data-bs-parent="#accordion-ajuda">
			      <div class="accordion-body">
			         <?php echo $r['Resposta'];    ?>
			      </div>
			    </div>
			  </div>
			<?php   }   }   ?>
			</div>   

			<div class="text-container">
				<span>Se a sua dúvida não está no FAQ acima, então clique<button type="button" class="btn-noborder btn-form-show">aqui</button>e nos envie</span>
			</div>

			<div class="form-collapse">
				<form action="./requisicoes/envia-contato.php" class="form-submit">
					<input type="hidden" name="Tipo"  value="Dica_seller" required>
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
							<textarea name="Duvida" rows="4" class="form-control" required></textarea>
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