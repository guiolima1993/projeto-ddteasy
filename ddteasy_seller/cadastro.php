<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Cadastro</h1>
		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="div-ddt-container">
				<span>Aqui estão disponíveis as informações referentes ao cadastro da sua empresa. Por favor, analise se as informações dispostas aqui estão corretas e mantenha sempre atualizado! Lembre-se sempre de manter seu registro atualizado para poder continuar utilizando a nossa plataforma sem qualquer problema! Clique <a href="documentacao.php">aqui</a> e verifique se sua documentação está em dia!</span>
			</div>
			<div class="info-wrapper">
				<div class="button-box mt-4">
					<a href="editar-cadastro.php" class="btn btn-info-edit"><i class="fa fa-edit"></i> Editar Informações</a>
				</div>
				<div class="info-review border-div">
					<div class="info-header">
						<h4 class="info-text">Informações de administrativas</h4>
					</div>
					<div class="info-line-bold">Razão Social:</div>
					<div class="info-line"><?php echo $r_p['Razao_social'];  ?></div>
					<div class="info-line-bold">Nome Fantasia:</div>
					<div class="info-line"><?php echo $r_p['Nome_fantasia'];  ?></div>
					<div class="info-line-bold">CNPJ:</div>
					<div class="info-line"><?php echo $r_p['Cnpj'];  ?></div>
					<div class="info-line-bold">Localização:</div>
					<div class="info-line"><?php echo $r_p['Localizacao'];  ?></div>
					<div class="info-line-bold">Telefone:</div>
					<div class="info-line"><?php echo $r_p['Telefone'];  ?></div>
					<div class="info-line-bold">E-mail:</div>
					<div class="info-line"><?php echo $r_p['Email'];  ?></div>
				</div>
				<div class="button-box">
					<a href="editar-cadastro.php" class="btn btn-info-edit"><i class="fa fa-edit"></i> Editar Informações</a>
				</div>
				<div class="info-review border-div">
					<div class="info-header">
						<h4 class="info-text">Informações adicionais</h4>
					</div>
					<div class="info-line-bold">Logo:</div>
					<div class="info-line">							<?php  if(isset($r_p['Imagem']) && $r_p['Imagem']!=""){   ?>
								<img src="../imagens/parceiro/200/<?php echo $r_p['Imagem'];   ?>" alt="Logo_atual" class="img-logo-atual">
							<?php  }   ?></div>
					<div class="info-line-bold">Tamanho:</div>
					<div class="info-line">								 <?php if($r_p['Tamanho']==1){    ?>  >De 1 a 10 funcionários<?php  }  ?>
								 <?php if($r_p['Tamanho']==2){    ?>  >De 11 a 20 funcionários<?php  }  ?>
								<?php if($r_p['Tamanho']==3){    ?>De 21 a 30 funcionários<?php  }  ?>
								<?php if($r_p['Tamanho']==4){    ?>De 31 a 40 funcionários<?php  }  ?>
								 <?php if($r_p['Tamanho']==5){    ?>De 41 a 50 funcionários<?php  }  ?></div>
					<div class="info-line-bold">Locais de atendimento:</div>
					<div class="info-line"><?php echo $r_p['Local_atendimento'];  ?> (até XX quilômetros)</div>
					<div class="info-line-bold">Horário de atendimento:</div>
					<div class="info-line"><?php echo $r_p['Horario_inicial'];  ?> - <?php echo $r_p['Horario_final'];  ?></div>
					<div class="info-line-bold">Serviços:</div>
					<div class="info-line">dedetização, dedetização premium, sanitização, sanitização premium</div>
					<div class="info-line-bold">Descrição</div>
					<div class="info-line"><?php echo $r_p['Descricao'];  ?></div>
				</div>
				<div class="button-box">
					<a href="adicionar-filial.php" class="btn btn-info-edit"><i class="fa fa-plus-circle"></i> Adicionar Filial</a>
				</div>
				<div class="info-review border-div">
					<div class="info-header">
						<h4 class="info-text">Informações de filiais</h4>
					</div>

					<table class="table ddt-table">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Local</th>
								<th>CNPJ</th>
								<th>Telefone</th>
								<th>E-mail</th>
								<th>Editar</th>
							</tr>
						</thead>
						<tbody>
						<?php    
							$q = Query('SELECT * FROM filial WHERE Parceiro = '.$_SESSION['Parceiro'].' AND Ativo = 1 ORDER BY Titulo ASC',0);
							if(mysqli_num_rows($q) > 0){
								while($r = mysqli_fetch_assoc($q)){
						?>
							<tr>
								<td><?php echo $r['Titulo'];   ?></td>
								<td><?php echo $r['Cidade'];   ?>/<?php echo $r['Local'];   ?></td>
								<td><?php echo $r['Cnpj'];   ?></td>
								<td><?php echo $r['Telefone'];   ?></td>
								<td><a href="mailto:<?php echo $r['Email'];   ?>"><?php echo $r['Email'];   ?></a></td>
								<td><a href="editar-filial.php?1=<?php echo $r['Filial'];   ?>" class="btn-table-edit"><img src="images/icons/pencil.png" alt="btn-icon" class="img-fluid"></a></td>
							</tr>
						<?php  }  }  ?>
						</tbody>
					</table>
					
				</div>
			</div>
			<!-- <div class="button-box">
				<button type="button" class="btn btn-info-edit" data-bs-toggle="modal" data-bs-target="#modalInfo"><i class="fa fa-edit"></i> Editar Informações</button>
			</div> -->
		</div>
	</div>
</section>
<?php include('footer.php'); ?>

<!-- Modal -->
<!-- <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalInfoHeader">Editar Informações</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div> -->
<?php include ('footer.php'); ?>

</body>
</html>