<?php include('header.php'); 

	                  


	$insert = 0;
	$nome = "";
	if(isset($_POST['Nome']) && $_POST['Nome']!=''){
			if(isset($_POST['Telefone']) && $_POST['Telefone']!=''){
				if(isset($_POST['Rg']) && $_POST['Rg']!=''){
					if(isset($_POST['Cpf']) && $_POST['Cpf']!=''){
						if(isset($_POST['Ativo']) && $_POST['Ativo']!=''){
							if(isset($_POST['Servicos']) && $_POST['Servicos']!=''){
								if(isset($_POST['Uf']) && $_POST['Uf']!=''){
									if(isset($_POST['Cidade']) && $_POST['Cidade']!=''){
										if(isset($_POST['Descricao']) && $_POST['Descricao']!=''){
											if(isset($_POST['Filial']) && $_POST['Filial']!=''){

											$id = 0;
											$id  = Insert('INSERT INTO colaborador(Filial,Titulo,Telefone,Rg,Cpf,Ativo,Servicos_prestados,Uf,Cidade,Descricao,Parceiro) VALUES ('.clean($_POST['Filial']).',"'.clean($_POST['Nome']).'","'.clean($_POST['Telefone']).'","'.clean($_POST['Rg']).'","'.clean($_POST['Cpf']).'","'.clean($_POST['Ativo']).'","'.clean($_POST['Servicos']).'","'.clean($_POST['Uf']).'","'.clean($_POST['Cidade']).'","'.clean($_POST['Descricao']).'",'.$_SESSION['Parceiro'].')');



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
			}
		}   
          
		if($insert==1){  ?>
			<script>document.location = "<?php echo $Config['UrlSite'];   ?>ddteasy_seller/gestao-de-funcionarios.php";</script>
		<?php  }


?>
	<div class="page-container">
		<h1 class="page-title">Novo Funcionário</h1>

		<div class="page-content">
			<div class="form-wrapper-funcionario">
				<form action=""  method="POST" class="formFuncionario" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-12 col-sm-12">
							<label>Nome</label>
							<input type="text" name="Nome" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Telefone</label>
							<input type="text" name="Telefone" class="form-control cel-field" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>RG</label>
							<input type="text" name="Rg" class="form-control rg-field" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>CPF</label>
							<input type="text" name="Cpf" class="form-control cpf-field" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Situação</label>
							<select name="Ativo" class="form-control" required>
								<option selected disabled>Coloque a situação do funcionário</option>
								<option value="1">Ativo</option>
								<option value="0">Inativo</option>
							</select>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Filial</label>
							<select name="Filial" class="form-control" required>
								<option selected disabled>Selecione a filial</option>
								<?php      
									$q = Query('SELECT * FROM filial WHERE Ativo = 1 AND Parceiro = '.$_SESSION['Parceiro'].' ORDER BY Titulo ASC',0);
									if(mysqli_num_rows($q) > 0){
										while($r = mysqli_fetch_assoc($q)){
								?>
									<option value="<?php echo $r['Filial'];   ?>"><?php echo $r['Titulo'];   ?></option>
								<?php   }  }  ?>
							</select>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Serviços</label>
							<select name="Servicos" class="form-control" required>
								<option selected disabled>Serviços que o profissional presta</option>
								<?php      
									$q = Query('SELECT * FROM servicos_prestados WHERE Ativo = 1 ORDER BY Servicos_prestados ASC',0);
									if(mysqli_num_rows($q) > 0){
										while($r = mysqli_fetch_assoc($q)){
								?>
									<option value="<?php echo $r['Servicos_prestados'];   ?>"><?php echo $r['Titulo'];   ?></option>
								<?php   }  }  ?>
							</select>
						</div>
						<div class="col-lg-3 col-sm-12">
							<label>Local</label>
							<select name="Uf" class="form-control" required>
								<option value="Uf">uf</option>
								<option value="Uf">uf</option>
								<option value="Uf">uf</option>
								<option value="Uf">uf</option>
							</select>
						</div>
						<div class="col-lg-9 col-sm-12">
							<label>Cidade</label>
							<input type="text" name="Cidade" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Foto 3:4 (Tamanho 100x133)</label>
							<input type="file" name="Foto" class="form-control" accept="image/*" required>
						</div> 
						<div class="col-lg-12 col-sm-12">
							<label>Descrição</label>
							<textarea name="Descricao" rows="4" class="form-control" required></textarea>
						</div>
						<div class="col-lg-12 col-sm-12">
							<button class="btn btn-primary mt-3"><i class="fa fa-send"></i> Enviar</button>
							<button class="btn btn-danger mt-3" onclick="voltar()">Cancelar</button>
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