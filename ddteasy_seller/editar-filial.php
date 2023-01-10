<?php include('header.php'); 

	$r = '';
	if(isset($_GET[1]) && $_GET[1]!=''){
		$id = clean($_GET[1]);
		$q = Query('SELECT * FROM filial WHERE Parceiro = '.$_SESSION['Parceiro'].' AND Filial = '.$id.'');
		if(mysqli_num_rows($q) > 0){
			$r = mysqli_fetch_assoc($q);
		}else{
			goHome();
		}
	}
	


	
	$insert = 0;
	$nome = "";
	if(isset($_GET['Nome']) && $_GET['Nome']!=''){
			if(isset($_GET['Cnpj']) && $_GET['Cnpj']!=''){
				if(isset($_GET['Telefone']) && $_GET['Telefone']!=''){
					if(isset($_GET['Email']) && $_GET['Email']!=''){
						if(isset($_GET['Cidade']) && $_GET['Cidade']!=''){
							if(isset($_GET['Uf']) && $_GET['Uf']!=''){

								$dedetizacao = 0;
								if(isset($_GET['Dedetizacao']) && $_GET['Dedetizacao']==1){
									$dedetizacao = 1;
								}

								$dedetizacao_premiuw = 0;
								if(isset($_GET['Dedetizacao_premiuw']) && $_GET['Dedetizacao_premiuw']==1){
									$dedetizacao_premiuw = 1;
								}


								$sanitizacao = 0;
								if(isset($_GET['Sanitizacao']) && $_GET['Sanitizacao']==1){
									$sanitizacao = 1;
								}

								$sanitizacao_premiuw = 0;
								if(isset($_GET['Sanitizacao_premiuw']) && $_GET['Sanitizacao_premiuw']==1){
									$sanitizacao_premiuw = 1;
								}

								$id = 0;


								Query('UPDATE filial SET Titulo = "'.clean($_GET['Nome']).'",Cnpj = "'.clean($_GET['Cnpj']).'",Telefone = "'.clean($_GET['Telefone']).'",Email = "'.clean($_GET['Email']).'",Cidade ="'.clean($_GET['Cidade']).'",Local="'.clean($_GET['Uf']).'",Ativo = 1,Dedetizacao ='.$dedetizacao.',Dedetizacao_premiuw ='.$dedetizacao_premiuw.',Sanitizacao='.$sanitizacao.',Sanitizacao_premium='.$sanitizacao_premiuw.' WHERE Filial = '.clean($_GET['Filial']).' AND Parceiro = '.$_SESSION['Parceiro'].'');

								
									$insert = 1;
								
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
		<h1 class="page-title">Editar filial</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>
			<div class="form-wrapper-funcionario border-div">
				<form action="" class="formFuncionario">
					<input type="hidden" name="Filial" value="<?php echo $_GET[1];   ?>" required>
					<div class="row">
						<div class="col-lg-12 col-sm-12">
							<label>Nome</label>
							<input type="text" name="Nome" class="form-control" autocomplete="off" value="<?php echo $r['Titulo'];   ?>" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>CNPJ</label>
							<input type="text" name="Cnpj" class="form-control cnpj-field" autocomplete="off" value="<?php echo $r['Cnpj'];   ?>" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Telefone</label>
							<input type="text" name="Telefone" class="form-control cel-field" autocomplete="off" value="<?php echo $r['Telefone'];   ?>" required>
						</div>						
						<div class="col-lg-12 col-sm-12">
							<label>E-mail</label>
							<input type="email" name="Email" class="form-control" autocomplete="off" value="<?php echo $r['Email'];   ?>" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Serviços</label>
							<div class="row my-3">
								<div class="col-xl-3 col-sm-12">
									<input type="checkbox" name="Dedetizacao" id="dedetizacao" value="1" <?php if($r['Dedetizacao']==1){ echo 'checked'; }    ?>> Dedetização
								</div>
								<div class="col-xl-3 col-sm-12">
									<input type="checkbox" name="Sanitizacao" id="sanitizacao" value="1" <?php if($r['Sanitizacao']==1){ echo 'checked'; }    ?>> Sanitização
								</div>
								<div class="col-xl-3 col-sm-12">
									<input type="checkbox" name="Dedetizacao_premium" id="dedetizacao_premium" value="1" <?php if($r['Dedetizacao_premiuw']==1){ echo 'checked'; }    ?>> Dedetização Premium
								</div>
								<div class="col-xl-3 col-sm-12">
									<input type="checkbox" name="Sanitizacao_premium" id="sanitizacao_premium" value="1" <?php if($r['Sanitizacao_premiuw']==1){ echo 'checked'; }    ?>> Sanitização Premium
								</div>
							</div> 
						</div>


						<?php /*usar jquery para dar selected na opcao correta <?php echo $r['Uf'];   ?>*/   ?>
						<div class="col-lg-3 col-sm-12">
							<label>Local</label>
							<select name="Uf" class="form-control" required>
								<option value="AC">AC</option>
								<option value="AL">AL</option>
								<option value="AP">AP</option>
								<option value="AM">AM</option>
								<option value="BA">BA</option>
								<option value="CE">CE</option>
								<option value="DF">DF</option>
								<option value="ES">ES</option>
								<option value="GO">GO</option>
								<option value="MA">MA</option>
								<option value="MT">MT</option>
								<option value="MS">MS</option>
								<option value="MG">MG</option>
								<option value="PA">PA</option>
								<option value="PB">PB</option>
								<option value="PR">PR</option>
								<option value="PE">PE</option>
								<option value="PI">PI</option>
								<option value="RJ">RJ</option>
								<option value="RN">RN</option>
								<option value="RS">RS</option>
								<option value="RO">RO</option>
								<option value="RR">RR</option>
								<option value="SC">SC</option>
								<option value="SP">SP</option>
								<option value="SE">SE</option>
								<option value="TO">TO</option>
							</select>
						</div>
						<div class="col-lg-9 col-sm-12">
							<label>Cidade</label>
							<input type="text" name="Cidade" class="form-control" autocomplete="off" value="<?php echo $r['Cidade'];   ?>" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<button class="btn btn-primary mt-3"><i class="fa fa-send"></i> Enviar</button>
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
	function voltar() {
		window.history.back();
	}
</script>
</body>
</html>