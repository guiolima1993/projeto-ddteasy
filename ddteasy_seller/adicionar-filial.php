<?php include('header.php'); 

	
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


								$id  = Insert('INSERT INTO filial(Titulo,Cnpj,Telefone,Email,Cidade,Local,Parceiro,Ativo,Dedetizacao,Dedetizacao_premiuw,Sanitizacao,Sanitizacao_premium) VALUES ("'.clean($_GET['Nome']).'","'.clean($_GET['Cnpj']).'","'.clean($_GET['Telefone']).'","'.clean($_GET['Email']).'","'.clean($_GET['Cidade']).'","'.clean($_GET['Uf']).'",'.$_SESSION['Parceiro'].',1,'.$dedetizacao.','.$dedetizacao_premiuw.','.$sanitizacao.','.$sanitizacao_premiuw.')');

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
		<h1 class="page-title">Adicionar filial</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>
			<div class="form-wrapper-funcionario border-div">
				<form action="" class="formFuncionario">
					<div class="row">
						<div class="col-lg-12 col-sm-12">
							<label>Nome</label>
							<input type="text" name="Nome" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>CNPJ</label>
							<input type="text" name="Cnpj" class="form-control cnpj-field" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Telefone</label>
							<input type="text" name="Telefone" class="form-control cel-field" autocomplete="off" value="" required>
						</div>						
						<div class="col-lg-12 col-sm-12">
							<label>E-mail</label>
							<input type="email" name="Email" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Serviços</label>
							<div class="row my-3">
								<div class="col-xl-3 col-sm-12">
									<input type="checkbox" name="Dedetizacao" id="dedetizacao" value="1"> Dedetização
								</div>
								<div class="col-xl-3 col-sm-12">
									<input type="checkbox" name="Sanitizacao" id="sanitizacao" value="1"> Sanitização
								</div>
								<div class="col-xl-3 col-sm-12">
									<input type="checkbox" name="Dedetizacao_premium" id="dedetizacao_premium" value="1"> Dedetização Premium
								</div>
								<div class="col-xl-3 col-sm-12">
									<input type="checkbox" name="Sanitizacao_premium" id="sanitizacao_premium" value="1"> Sanitização Premium
								</div>
							</div> 
						</div>
						<div class="col-lg-4 col-sm-12">
							<label>Cidade</label>
							<input type="text" name="Cidade" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-4 col-sm-12">
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
						<div class="col-lg-4 col-sm-12">
							<label>CEP</label>
							<input type="text" name="Cep" class="form-control cep-field" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-6 col-sm-12">
							<label>Logradouro</label>
							<input type="text" name="Logradouro" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-3 col-sm-12">
							<label>Número</label>
							<input type="text" name="Numero" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-3 col-sm-12">
							<label>Complemento</label>
							<input type="text" name="Complemento" class="form-control" autocomplete="off" value="">
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Bairro</label>
							<input type="text" name="Bairro" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-6 col-sm-12">
							<label>Local de atendimento</label>
							<input type="text" name="Local-atendimento" class="form-control" autocomplete="off" value="" required>
						</div>
						<div class="col-lg-6 col-sm-12">
							<label>Proximidades</label>
							<select name="Proximidade" class="form-control" required>
								<option value="0">Apenas na cidade estabelecida</option>
								<option value="1">Até 5 quilômetros</option>
								<option value="2">Até 10 quilômetros</option>
								<option value="3">Até 20 quilômetros</option>
								<option value="4">Até 30 quilômetros</option>
								<option value="5">Até 40 quilômetros</option>
								<option value="6">Até 50 quilômetros</option>
							</select>
						</div>
						<div class="col-lg-12 col-sm-12">
							<label>Descrição</label>
							<textarea name="Descricao" rows="4" class="form-control" required></textarea>
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