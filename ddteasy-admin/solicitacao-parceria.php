<?php include('header.php'); ?>
	
	<div class="page-container">
		<h1 class="page-title">Solicitações de parceria</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="div-ddt-container border-div">
				
				<h6 class="mb-5">Solicitações novas e pendentes</h6>

				<table id="table-solicitacao" class="table">
					<thead>
						<tr>
							<th>Nome Fantasia</th>
							<th>Data da Solicitação</th>
							<th>Ver Solicitação</th>
						</tr>
					</thead>
					<tbody>
					<?php    
						$q_parceiro = Query('SELECT * FROM parceiro WHERE Ativo = 0 ORDER BY Parceiro DESC',0);
						if(mysqli_num_rows($q_parceiro) > 0){
							while($r_p = mysqli_fetch_assoc($q_parceiro)){
					?>
						<tr>
							<td><?php echo $r_p['Nome_fantasia'];  ?></td>
							<td><?php echo formata_data($r_p['Data_cadastro']);  ?></td>
							<td><a href="novo-seller.php?1=<?php echo $r_p['Parceiro'];  ?>">Ver solicitação</a></td>
						</tr>
					<?php  }   }   ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</section>
<?php include('footer.php'); ?>

<script>
	$(function(){

		$('#table-solicitacao').dataTable(_dt_options);
	})
</script>
</body>
</html>