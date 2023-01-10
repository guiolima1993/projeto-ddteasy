<?php include('header.php'); 

	$r = '';
	$q = Query('SELECT * FROM parceiro WHERE Parceiro = '.$_SESSION['Parceiro'].'');
	if(mysqli_num_rows($q) > 0){
		$r = mysqli_fetch_assoc($q);
	}else{
		goHome();
	}




	if(isset($_POST['Razao_social']) && $_POST['Razao_social']!=''){
				if(isset($_POST['Nome_fantasia']) && $_POST['Nome_fantasia']!=''){
					if(isset($_POST['Cnpj']) && $_POST['Cnpj']!=''){
						if(isset($_POST['Localizacao']) && $_POST['Localizacao']!=''){
							if(isset($_POST['Telefone']) && $_POST['Telefone']!=''){
								if(isset($_POST['Email']) && $_POST['Email']!=''){


									$id = clean($_POST['id']);


									Query('UPDATE parceiro SET Titulo = "'.clean($_POST['Nome_fantasia']).'",Cnpj = "'.clean($_POST['Cnpj']).'",Localizacao = "'.clean($_POST['Localizacao']).'",Telefone = "'.clean($_POST['Telefone']).'",Email = "'.clean($_POST['Email']).'",Razao_social = "'.clean($_POST['Razao_social']).'" WHERE  Parceiro = '.$_SESSION['Parceiro'].'');


									$curriculo = '';   

						            if(isset($_FILES['Foto']['tmp_name']) && ($_FILES['Foto']['tmp_name']!='') && ($_FILES['Foto']['type']!='application/octet-stream')){     
						                $destino = '../imagens/parceiro/';

						                if(!is_dir($destino)){
						                	mkdir($destino);
						                } 

						      			$destino = '../imagens/parceiro/200/';

						                if(!is_dir($destino)){
						                	mkdir($destino);
						                } 

						                $name_aux = explode('.',$_FILES['Foto']['name']);   
						                $ext = end($name_aux); 
						                $better_token = md5(uniqid(rand(),true));
						                $new_name = $better_token.'.'.$ext;  
						                $destino .= $new_name;
						                
						                if(move_uploaded_file($_FILES['Foto']['tmp_name'],$destino)){   
						                    Query('UPDATE parceiro SET Imagem = "'.$new_name.'" WHERE Parceiro = '.$_SESSION['Parceiro'].'');  
						                }
						                  
						            }   
 
									if($id!=0){
										$insert = 1;
									}
								}
							}
						}
					}
				}	
			}
				

		if($insert==1){  ?>
			<script>document.location = "<?php echo $Config['UrlSite'];   ?>ddteasy_seller/cadastro.php";</script>
		<?php  }


?>




	<div class="page-container">
		<h1 class="page-title">Editar cadastro</h1>
		<div class="page-content">
			<?php include('top-box.php'); ?>
			
			<div class="div-ddt-container border-div">
				<form action="requisicoes/editar-seller.php" class="formEdit"  enctype="multipart/form-data" method="POST">
					<input type="hidden" name="editar-cadastro" value="editar-cadastro">
					<div class="row">
						<h6 class="my-3">Informações administrativas</h6>
						<div class="col-lg-12 col-md-12">
							<label>Razão Social</label>
							<input type="text" name="Razao_social" class="form-control razao-field" autocomplete="off" value="<?php echo $r['Titulo'];  ?>" required>
						</div>
						<div class="col-lg-12 col-md-12">
							<label>Nome Fantasia</label>
							<input type="text" name="Nome_fantasia" class="form-control fantasia-field" autocomplete="off" value="<?php echo $r['Nome_empresa'];  ?>" required>
						</div>
						<div class="col-lg-12 col-md-12">
							<label>CNPJ</label>
							<input type="text" name="Cnpj" class="form-control cnpj-field" autocomplete="off" value="<?php echo $r['Cnpj'];  ?>" required>
						</div>
						<div class="col-lg-12 col-md-12">
							<label>Localização</label>
							<input type="text" name="Localizacao" class="form-control" autocomplete="off" value="<?php echo $r['Localizacao'];  ?>" required>
						</div>
						<div class="col-lg-12 col-md-12">
							<label>Telefone</label>
							<input type="text" name="Telefone" class="form-control cel-field" autocomplete="off" value="<?php echo $r['Telefone'];  ?>" required>
						</div>
						<div class="col-lg-12 col-md-12">
							<label>E-mail</label>
							<input type="email" name="Email" class="form-control" autocomplete="off" value="<?php echo $r['Email'];  ?>" required>
						</div>
						<h6 class="my-3">Informações adicionais</h6>
						<div class="col-lg-12 col-md-12">
							<label>Imagem do logo</label>
							<?php  if(isset($r['Imagem']) && $r['Imagem']!=""){   ?>
								<img src="../imagens/parceiro/200/<?php echo $r['Imagem'];   ?>" alt="Logo_atual" class="img-logo-atual">
							<?php  }   ?>
							<input type="file" name="Foto" class="form-control" accept="image/*">
						</div>
						<div class="col-lg-12 col-md-12">
							<label>Tamanho</label>
							<select name="Tamanho" class="form-control" required="">
								<option value="1" <?php if($r['Tamanho']==1){  echo 'selected'; }  ?>  >De 1 a 10 funcionários</option>
								<option value="2" <?php if($r['Tamanho']==2){  echo 'selected'; }  ?>  >De 11 a 20 funcionários</option>
								<option value="3" <?php if($r['Tamanho']==3){  echo 'selected'; }  ?>>De 21 a 30 funcionários</option>
								<option value="4" <?php if($r['Tamanho']==4){  echo 'selected'; }  ?>>De 31 a 40 funcionários</option>
								<option value="5" <?php if($r['Tamanho']==5){  echo 'selected'; }  ?>>De 41 a 50 funcionários</option>
							</select>
						</div>
						<div class="col-lg-6 col-md-12">
							<label>Local de atendimento</label>
							<input type="text" name="Local_atendimento" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-6 col-md-12">
							<label>Proximidades</label>
							<select name="Proximidade" class="form-control" required>
								<option value="0">Apenas na cidade estabelecida</option>
								<option value="1"  <?php if($r['Proximidade']==1){  echo 'selected'; }  ?>>Até 5 quilômetros</option>
								<option value="2" <?php if($r['Proximidade']==2){  echo 'selected'; }  ?>>Até 10 quilômetros</option>
								<option value="3" <?php if($r['Proximidade']==3){  echo 'selected'; }  ?>>Até 20 quilômetros</option>
								<option value="4" <?php if($r['Proximidade']==4){  echo 'selected'; }  ?>>Até 30 quilômetros</option>
								<option value="5" <?php if($r['Proximidade']==5){  echo 'selected';}  ?>>Até 40 quilômetros</option>
								<option value="6" <?php if($r['Proximidade']==6){  echo 'selected'; }  ?>>Até 50 quilômetros</option>
							</select>
						</div>
						<div class="col-lg-6 col-md-12">
							<label>Horário inicial</label>
							<input type="text" name="Horario_inicial" class="form-control h-atendimento" autocomplete="off" value="<?php echo $r['Horario_inicial']; ?>" required>
						</div>
						<div class="col-lg-6 col-md-12">
							<label>Horário final</label>
							<input type="text" name="Horario_final" class="form-control h-atendimento" autocomplete="off" value="<?php echo $r['Horario_final']; ?>" required>
						</div>
						<div class="col-lg-12 col-md-12">
							<label>Dias da semana</label>
							<div class="row my-3">
								<div class="col-md-12">
									<input type="checkbox" name="Dias_semana" id="segunda-feira" value="2" <?php if($r['Segunda']==1){  echo 'checked'; }  ?>> Segunda-feira
								</div>
								<div class="col-md-12">
									<input type="checkbox" name="Dias_semana" id="terca-feira" value="3" <?php if($r['Terca']==1){  echo 'checked'; }  ?>> Terça-feira									
								</div>
								<div class="col-md-12">
									<input type="checkbox" name="Dias_semana" id="quarta-feira" value="4" <?php if($r['Quarta']==1){  echo 'checked'; }  ?>> Quarta-feira
								</div>
								<div class="col-md-12">
									<input type="checkbox" name="Dias_semana" id="quinta-feira" value="5" <?php if($r['Quinta']==1){  echo 'checked'; }  ?>> Quinta-feira
								</div>
								<div class="col-md-12">
									<input type="checkbox" name="Dias_semana" id="sexta-feira" value="6" <?php if($r['Sexta']==1){  echo 'checked'; }  ?>> Sexta-feira
								</div>
								<div class="col-md-12">
									<input type="checkbox" name="Dias_semana" id="sabado" value="7" <?php if($r['Sabado']==1){  echo 'checked'; }  ?>> Sábado
								</div>
								<div class="col-md-12">
									<input type="checkbox" name="Dias_semana" id="domingo" value="1" <?php if($r['Domingo']==1){  echo 'checked'; }  ?>> Domingo
									
								</div>
							</div>    
						</div>
						<div class="col-lg-12 col-md-12 servicos-div">
							<label>Serviços</label>
							<div class="row underline-service my-2">								
								<div class="col-xl-4 col-sm-12">
									<input type="checkbox" name="Servicos" id="dedetizacao" value="1" <?php if($r['Dedetizacao']==1){ echo 'checked'; }    ?>>
									Dedetização
								</div>
								<div class="col-xl-4 col-sm-12">
									<input type="text" name="Dedetizacao-price" class="form-control form-price money" placeholder="Inclua o valor" value="<?php echo $r['Dedetizacao'];    ?>" required>
								</div>
								<div class="col-xl-4 col-sm-12">
									<small class="d-block"><em><b>Preço mínimo: R$200,00</b></em></small>
									<small class="d-block"><em><b>Preço médio: R$250,00</b></em></small>
									<small class="d-block"><em><b>Preço máximo: R$270,00</b></em></small>
								</div>
							</div>

							<div class="row underline-service my-2">								
								<div class="col-xl-4 col-sm-12">
									<input type="checkbox"  name="Servicos" id="sanitizacao" value="1" <?php if($r['Sanitizacao']==1){ echo 'checked'; }    ?>>
									Sanitização
								</div>
								<div class="col-xl-4 col-sm-12">									
									<input type="text" name="Preco-sanitizacao" class="form-control form-price money" placeholder="Inclua o valor" value="<?php echo $r['Sanitizacao_valor'];    ?>" required>
								</div>
								<div class="col-xl-4 col-sm-12">
									<small class="d-block"><em><b>Preço mínimo: R$200,00</b></em></small>
									<small class="d-block"><em><b>Preço médio: R$250,00</b></em></small>
									<small class="d-block"><em><b>Preço máximo: R$270,00</b></em></small>
								</div>
							</div>

							<div class="row underline-service my-2">								
								<div class="col-xl-4 col-sm-12">
									<input type="checkbox" name="Servicos" id="dedetizacao-premium" value="1" <?php if($r['Dedetizacao_premiuw']==1){ echo 'checked'; }    ?>>
									Dedetização Premium
								</div>
								<div class="col-xl-4 col-sm-12">
									<input type="text" name="Preco-dedetizacao-premium" class="form-control form-price money" placeholder="Inclua o valor" value="<?php echo $r['Dedetizacao_premiuw_valor'];    ?>" required>
								</div>
								<div class="col-xl-4 col-sm-12">
									<small class="d-block"><em><b>Preço mínimo: R$200,00</b></em></small>
									<small class="d-block"><em><b>Preço médio: R$250,00</b></em></small>
									<small class="d-block"><em><b>Preço máximo: R$270,00</b></em></small>
								</div>
							</div>

							<div class="row underline-service my-2">								
								<div class="col-xl-4 col-sm-12">
									<input type="checkbox" name="Servicos" id="sanitizacao-premium" value="1" <?php if($r['Sanitizacao_premiuw']==1){ echo 'checked'; }    ?>>
									Sanitização Premium		
								</div>
								<div class="col-xl-4 col-sm-12">
									<input type="text" name="Preco-sanitizacao-premium" class="form-control form-price money" placeholder="Inclua o valor" value="<?php echo $r['Sanitizacao_premiuw_valor'];    ?>" required>
								</div>
								<div class="col-xl-4 col-sm-12">
									<small class="d-block"><em><b>Preço mínimo: R$200,00</b></em></small>
									<small class="d-block"><em><b>Preço médio: R$250,00</b></em></small>
									<small class="d-block"><em><b>Preço máximo: R$270,00</b></em></small>
								</div>
							</div>
						</div>

						<div class="col-lg-12 col-md-12">
							<label>Descrição</label>
							<textarea name="Descricao" rows="4" maxlength="200"  class="form-control" required><?php echo $r['Descricao']; ?></textarea>
						</div>
						<div class="col-lg-12 col-md-12">
							<button class="btn btn-primary mt-3"><i class="fa fa-send"></i> Atualizar</button>
							<a href="cadastro.php" class="btn btn-hd-page mt-3">Voltar</a>
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>

<script>
	$(function(){
		$(document).on('click', "input[name$='Servicos']", function(){

			var _t = $(this);

			if (_t.prop("checked") == true){
				var _t_val = _t.val();

				if (_t_val == "dedetizacao") {

					_t.closest(".row").find("input[name$='Dedetizacao-price']").fadeIn();
				} else if (_t_val == "sanitizacao") {
					
					_t.closest(".row").find("input[name$='Preco-sanitizacao']").fadeIn();
				} else if (_t_val == "dedetizacao-premium") {

					_t.closest(".row").find("input[name$='Preco-dedetizacao-premium']").fadeIn();
				} else if (_t_val == "sanitizacao-premium") {

					_t.closest(".row").find("input[name$='Preco-sanitizacao-premium']").fadeIn();
				}

			}else {
				var _t_val = _t.val();

				if (_t_val == "dedetizacao") {

					_t.closest(".row").find("input[name$='Dedetizacao-price']").fadeOut();
				}else if (_t_val == "sanitizacao") {

					_t.closest(".row").find("input[name$='Preco-sanitizacao']").fadeOut();
				}else if (_t_val == "dedetizacao-premium") {

					_t.closest(".row").find("input[name$='Preco-dedetizacao-premium']").fadeOut();
				}else if (_t_val == "sanitizacao-premium") {

					_t.closest(".row").find("input[name$='Preco-sanitizacao-premium']").fadeOut();
				}
			}
		});

		$(document).on('focusout', '.razao-field', function(){
			var _t = $(this);
			var nomeRazao = $(this).val();
			var fantasiaCampo = $(this).closest('form').find('.fantasia-field');

			if(fantasiaCampo.val() == "" || fantasiaCampo.val() == null){
				_t.closest('form').find('.fantasia-field').val(nomeRazao);
			}

		})

		$('.formEdit').submit(function(e){
			e.preventDefault();
			var _this = $(this);
      var form = $(this)[0];
      var formAction = $(this).attr('action');
      var valid = $(this).valid();
	    var btn = _this.find('button[type=\"submit\"]').html();
      var btn_w = _this.find('button[type=\"submit\"]').width();
      var dados = new FormData(form);

      $.ajax({
      	url : formAction,
          type: "POST",
          data:  dados,
          mimeType:"multipart/form-data",
          contentType: false,
          cache: false,
          processData:false,
          beforeSend: function() {
            _this.find('button[type=\"submit\"]').html('<i class=\"fa fa-refresh fa-spin\"></i>').width(btn_w);
          },
          success: function(data){
            if (data == 1) {
            swal({
              title: "Sucesso",
              text: "Envio realizado com sucesso",
              icon: "success",
              confirmButtonText: "Ok"
            });
            $('.modal.show').modal('hide');
            _this[0].reset();
            } else {
              swal({
                title: "Erro",
                text: data.message ? data.message : "Erro no envio",
                icon: "error",
                confirmButtonText: "Fechar"
              });
            }
            _this.find('button[type=\"submit\"]').html(btn);
          },
          error: function() {
            _this.find('button[type=\"submit\"]').html(btn);
          }
      });
		})

	})
</script>
</body>
</html>