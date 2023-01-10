<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Documentação</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="div-ddt-container border-div">
				<h6>Verifique sempre a validade da sua documentação! Caso esteja desatualizada, sua empresa não será listada para clientes da plataforma!</h6>

				<div class="aviso-doc">
					<span class="aviso-doc-texto"></span>
				</div>

				<div class="my-3">
					<form action="requisicoes/envia-documento.php" class="form-doc-submit" method="POST" enctype="multipart/form-data" novalidate>
						<div class="row">
							<div class="col-xl-6 col-md-6 col-sm-12">
								<label>Que tipo de documento você está enviando?</label>
								<select name="Tipo_documento" class="form-control" required>
									<?php    
										$q = Query('SELECT * FROM tipo_documento WHERE Ativo = 1 ORDER BY Titulo ASC',0);
										if(mysqli_num_rows($q) > 0){
										  while($r_doc = mysqli_fetch_assoc($q)){
									?>
										<option value="<?php echo $r_doc['Tipo_documento'];    ?>"><?php echo $r_doc['Titulo'];    ?></option>
									<?php  }  }   ?>
								</select>
							</div>
							<div class="col-xl-6 col-md-6 col-sm-12">
								<form action="requisicoes/envia-contato.php" class="form-submit" novalidate>
									<label>Faça o upload do documento aqui</label>
									<input type="file" name="Arquivo" class="form-control" required>
									<button class="btn btn-primary mt-3"><i class="fa fa-send"></i> Enviar documento</button>
								</form>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="div-ddt-container border-div mt-4">
				<table class="table ddt-table">
					<thead>
						<tr>
							<th>Tipo</th>
							<th>CNPJ</th>
							<th>Cidade</th>
							<th>Data de envio</th>
							<th>Data de vencimento</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php    
						$q = Query('SELECT * FROM documento WHERE  Parceiro = '.$_SESSION['Parceiro'].'  ORDER BY Titulo ASC',0);
						if(mysqli_num_rows($q) > 0){
						  while($r = mysqli_fetch_assoc($q)){
					?>
						<tr>
							<td><?php echo get('tipo_documento',$r['Tipo_documento']);     ?></td>
							<td>XX.XXX.XXX/XXXX-XX</td>
							<td>Cidade/UF</td>
							<td><?php echo formata_data($r['Data']);     ?></td>
							<td><?php echo formata_data($r['Data_validade']);     ?></td>
							<td><a href="<?php echo $Config['UrlSite'];   ?>imagens/documento/<?php echo $r['Arquivo'];   ?>" target="_blank">Ver íntegra</a></td>
						</tr>
					<?php  }   }   ?>
					</tbody>
				</table>
			</div>
			
			<a href="cadastro.php" class="btn btn-hd-page mt-3">Voltar</a>
		</div>
	</div>

</section>
<?php include('footer.php'); ?>

<script>
	/*
	 * A função abaixo é ilustrativa.
	 * Ela deverá exibir uma mensagem diferente para o usuário cada o valor da   
	 * request
	 * seja 0 ou 1
	 */

	$(function(){
	 	$(window).on('load', function(){
	 		$.ajax({
	 			url: 'requisicoes/check-documentacao.php',
	 			cache: false,
	 			type: 'get',
	 			success: function(res){
	 				if(res == 1){
	 					$('.aviso-doc').css("border", "2px solid blue");
	 					$('.aviso-doc').find('.aviso-doc-texto').html("Seus documentos estão em dia! Mantenha a sua documentação atualizada!");
	 				}else {
	 					$('.aviso-doc').css("border", "2px solid red");
	 					$('.aviso-doc').find('.aviso-doc-texto').html("Ainda faltam documentos a serem enviados! Mantenha a sua documentação atualizada!");
	 				}
	 			}

	 		})
	 	})
	})
</script>
</body>
</html>