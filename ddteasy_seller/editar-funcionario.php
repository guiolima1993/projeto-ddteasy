<?php include('header.php'); 
     	                 
	$insert = 0;
	$nome = "";
	
	$id = '';

	$r = '';

	if(isset($_GET['id']) && $_GET['id']!=''){

			$id = clean($_GET['id']);

			$q = Query('SELECT * FROM colaborador WHERE Colaborador = '.$id.' AND Parceiro = '.$_SESSION['Parceiro'].'',0);

			if(mysqli_num_rows($q) > 0){
				$r = mysqli_fetch_assoc($q);
			}else{
				goHome();
			}


		if(isset($_POST['id']) && $_POST['id']!=''){
			if(isset($_POST['Telefone']) && $_POST['Telefone']!=''){
						if(isset($_POST['Situacao']) && $_POST['Situacao']!=''){
							if(isset($_POST['Servicos']) && $_POST['Servicos']!=''){
								if(isset($_POST['Uf']) && $_POST['Uf']!=''){
									if(isset($_POST['Cidade']) && $_POST['Cidade']!=''){
										if(isset($_POST['Descricao']) && $_POST['Descricao']!=''){
											if(isset($_POST['Filial']) && $_POST['Filial']!=''){


													$id = clean($_POST['id']);
		 

													Query('UPDATE colaborador SET Filial = '.clean($_POST['Filial']).',Ativo = "'.clean($_POST['Situacao']).'",Servicos_prestados = "'.clean($_POST['Servicos']).'",Uf = "'.clean($_POST['Uf']).'",Cidade = "'.clean($_POST['Cidade']).'",Descricao = "'.clean($_POST['Descricao']).'",Telefone = "'.clean($_POST['Telefone']).'" WHERE Colaborador = '.$id.' AND Parceiro = '.$_SESSION['Parceiro'].'');


													$curriculo = '';   

										            if(isset($_FILES['Foto']['tmp_name']) && ($_FILES['Foto']['tmp_name']!='') && ($_FILES['Foto']['type']!='application/octet-stream')){     
										                $destino = '../imagens/colaborador/';

										                if(!is_dir($destino)){
										                	mkdir($destino);
										                } 

										      			$destino = '../imagens/colaborador/100/';

										                if(!is_dir($destino)){
										                	mkdir($destino);
										                } 

										                $name_aux = explode('.',$_FILES['Foto']['name']);   
										                $ext = end($name_aux); 
										                $better_token = md5(uniqid(rand(),true));
										                $new_name = $better_token.'.'.$ext;  
										                $destino .= $new_name;
										                
										                if(move_uploaded_file($_FILES['Foto']['tmp_name'],$destino)){   
										                    Query('UPDATE colaborador SET Imagem = "'.$new_name.'" WHERE Colaborador = '.$id.' AND Parceiro = '.$_SESSION['Parceiro'].'');  
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
					}
				}
				}else{
					goHome();
				}

		if($insert==1){  ?>
			<script>document.location = "<?php echo $Config['UrlSite'];   ?>ddteasy_seller/gestao-de-funcionarios.php";</script>
		<?php  }


?>
	<div class="page-container">
		<h1 class="page-title">Editar Funcionário</h1>

		<div class="page-content">
			<div class="form-wrapper-funcionario">
				<form action="" method="POST" class="form-validate formFuncionario" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $r['Colaborador'];   ?>">
					<div class="row">
						<div class="col-lg-12 col-sm-12">
							<label>Nome</label>
							<input type="text" name="Nome" class="form-control" autocomplete="off" value="<?php echo $r['Titulo'];   ?>" disabled required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>RG</label>
							<input type="text" name="Rg" class="form-control" autocomplete="off" value="<?php echo $r['Rg'];   ?>" disabled required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>CPF</label>
							<input type="text" name="Cpf" class="form-control" autocomplete="off" value="<?php echo $r['Cpf'];   ?>" disabled required>
						</div>						
						<div class="col-lg-12 col-sm-12">
							<label>Telefone</label>
							<input type="text" name="Telefone" class="form-control cel-field" autocomplete="off" value="<?php echo $r['Telefone'];   ?>" required>
						</div>     
						<div class="col-lg-12 col-sm-12">
							<label>Situação</label>
							<select name="Situacao" class="form-control" required>
								<option selected>Coloque a situação do funcionário</option>
								<option value="1" <?php if($r['Ativo']==1){ echo 'selected'; }   ?>>Ativo</option>
								<option value="0" <?php if($r['Ativo']==0){ echo 'selected'; }   ?>>Inativo</option>
							</select>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Filial</label>
							<select name="Filial" class="form-control" required>
								<option selected disabled>Selecione a filial</option>
								<?php      
									$q_f = Query('SELECT * FROM filial WHERE Ativo = 1 AND Parceiro = '.$_SESSION['Parceiro'].' ORDER BY Titulo ASC',0);
									if(mysqli_num_rows($q_f) > 0){
										while($r_f = mysqli_fetch_assoc($q_f)){
								?>
									<option value="<?php echo $r_f['Filial'];   ?>" <?php if($r_f['Filial']==$r['Filial']){ echo 'selected'; }   ?>><?php echo $r_f['Titulo'];   ?></option>
								<?php   }  }  ?>
							</select>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Serviços</label>
							<select name="Servicos" class="form-control" required>
								<option value="" selected>Serviços que o profissional presta</option>
								<?php      
									$q_s = Query('SELECT * FROM servicos_prestados WHERE Ativo = 1 ORDER BY Servicos_prestados ASC',0);
									if(mysqli_num_rows($q_s) > 0){
										while($r_s = mysqli_fetch_assoc($q_s)){
								?>
									<option value="<?php echo $r_s['Servicos_prestados'];   ?>" <?php if($r_s['Servicos_prestados']==$r['Servicos_prestados']){ echo 'selected'; }   ?>><?php echo $r_s['Titulo'];   ?></option>
								<?php   }  }  ?>
							</select>     
						</div>
						<div class="col-lg-9 col-sm-12">
							<label>Cidade</label>
							<input type="text" name="Cidade" class="form-control" autocomplete="off" value="<?php echo $r['Cidade'];   ?>" required>
						</div>
						<div class="col-lg-3 col-sm-12">
							<label>Local</label>
							<select name="Uf" class="form-control" required>
								<option value="Uf" <?php if($r['Uf']=='Uf'){  echo 'selected';     }     ?>>uf</option>
								<option value="Uf">uf</option>
								<option value="Uf">uf</option>
								<option value="Uf">uf</option>
							</select>
						</div>						
						<div class="col-lg-12 col-sm-12">
							<label>Foto 3:4 (Tamanho 100x133)</label>
							<input type="file" name="Foto" class="form-control" accept="image/*" >
							<span>Foto atual:</span>
							<img src="../imagens/colaborador/100/<?php  echo $r['Imagem'];    ?>" alt="Foto_funcionario" class="img-funcionario">
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Descrição</label>
							<textarea name="Descricao" rows="4" class="form-control"  required><?php echo $r['Descricao'];   ?></textarea>
						</div>
						<div class="col-lg-12 col-sm-12">
							<button class="btn btn-primary mt-3"><i class="fa fa-send"></i> Enviar</button>
							<button type="button" id="excluir-funcionario" class="btn btn-secondary mt-3"><i class="fa fa-trash-o"></i> Excluir</button>
							<button type="button" class="btn btn-danger mt-3" onclick="voltar()">Cancelar</button>
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
		var url_local = window.location.href;
		var param = url_local.split('?');
		var id_param = param[1];
		var id_divisor = id_param.split('=');
		var n_id = id_divisor[1];

		$(document).on('click', '#excluir-funcionario', function(e){
			e.preventDefault();

			$.ajax({
				url: "requisicoes/deleta-funcionario.php",
				data: {
					id: n_id
				},
				cache: false,
				success: function(res){
					if (res != 0){
						swal({
							title: "Sucesso!",
							text: "O usuário foi deletado da sua conta.",
							icon: "success",
							confirmButtonText: "Ok!"
						})
						window.location.href = "ddteasy_seller/gestao-de-funcionarios.php";
					} else {
						swal({
							title: "Ops!",
							text: "Não foi possível deletar o usuário ou o usário já não existe mais no sistema.",
							icon: "alert",
							confirmButtonText: "Ok!"
						})
					}
				},
				error: function(){
					swal({
						title: "Erro",
						text: "Houve um problema ao processar sua requisição. Tente novamente mais tarde.",
						icon: "error",
						confirmButtonText: "Ok!"
					})
				}
			})
		})

	})
</script>
</body>
</html>