<?php include('header.php');	 ?>
	<div class="page-container">
		<h1 class="page-title">Avaliações</h1>

		<div class="page-content">

			<?php include('top-box.php'); ?>
			
			<div class="row">

				<div class="col-xl-12 col-md-12 col-sm-12 mb-4">
					<div class="box-avaliacao border-div">
						<table id="rate-table" class="table ddt-table" style="width: 100%;">
							<thead>
								<tr>
									<th>Nº Pedido</th>
									<th>Avaliação média (0 a 5)</th>
									<th>Colaborador</th>
									<th>Sede / filial</th>
									<th>Comentário</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php      
									$cache = array();
									$q = Query('SELECT * from avaliacao WHERE Parceiro = '.$_SESSION['Parceiro'].' ORDER BY Avaliacao DESC');

									if(mysqli_num_rows($q) > 0){
										while($r = mysqli_fetch_assoc($q)){
											$q_c = Query('SELECT * FROM colaborador WHERE Colaborador = '.$r['Colaborador'].'');
											if(mysqli_num_rows($q_c) > 0){
												while($r_c = mysqli_fetch_assoc($q_c)){
													$q_f = Query('SELECT * FROM filial WHERE Filial = '.$r_c['Filial'].' LIMIT 1');
													if(mysqli_num_rows($q_f) > 0){
														while($r_f = mysqli_fetch_assoc($q_f)){
								?>
								<tr>
									<td><?php echo $r['Pedido'];   ?></td>
									<td><div class="Stars" style="--rating: <?php echo $r['Nota'];   ?>;" aria-label="Rating of this product is 2.3 out of 5.">
									<p style="visibility: hidden; position: absolute;"><?php echo $r['Nota'];   ?></p>
									</div></td>
									<td> <?php echo $r_c['Titulo']; ?>
									</td>
									<td><?php echo $r_f['Titulo']; ?>
									</td>
									<td class="limit-text" data-length="25"><?php echo $r['Comentario'];   ?></td>
									<td><button type="button" class="btn btn-avaliacao btn-hd-page" data-bs-toggle="modal" data-bs-target="#modalAvaliacao<?php echo $r['Avaliacao'];   ?>">Ver avaliações</button></td>
								</tr>
								<?php $cache[] = $r; } } } } } } ?>
							</tbody>
						</table>   
					</div>	
				</div>

				<div class="col-xl-12 col-md-12 col-sm-12">
					<div class="chart-box m-heigth border-div my-0">
						<h6>Avaliação média</h6>
						<canvas id="chartAvaliacao"></canvas>
					</div>
				</div>

			</div>	

		</div>
	</div>	
</section>
<?php include('footer.php'); 	 ?>



<?php    
	      
	foreach ($cache as $key => $v){    

		$r_c = '';
		$q_c = Query('SELECT * FROM colaborador WHERE Colaborador = '.$v['Colaborador'].'',0);
		if(mysqli_num_rows($q_c) > 0){
			$r_c = mysqli_fetch_assoc($q_c);
		}


		$r_cli = '';
		$q_cli = Query('SELECT * FROM cliente WHERE Cliente = '.$v['Cliente'].' AND Ativo = 1',0);
		if(mysqli_num_rows($q_cli) > 0){
			$r_cli = mysqli_fetch_assoc($q_cli);
		}


?>
<div id="modalAvaliacao<?php echo $v['Avaliacao'];   ?>" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Avaliação completa</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
			</div>

			<div class="modal-body">
				<div class="row underline-class">
					<div class="col-md-6 col-sm-12">
						<strong>Nome:</strong>
					</div>
					<div class="col-md-6 col-sm-12">
						<?php echo $r_c['Titulo'];   ?>
					</div>
				</div>
				<div class="row underline-class">
					<div class="col-md-6 col-sm-12">
						<strong>Nº Pedido</strong>
					</div>
					<div class="col-md-6 col-sm-12">
						<?php  echo $v['Pedido'];   ?>
					</div>
				</div>
				<div class="row underline-class">
					<div class="col-md-6 col-sm-12">
						<strong>Contato:</strong>
					</div>
					<div class="col-md-6 col-sm-12">
						<a href="callto:55<?php echo $r_c['Telefone'];   ?>">+55<?php echo $r_c['Telefone'];   ?></a>
					</div>
				</div>
				<div class="row underline-class">
					<div class="col-md-6 col-sm-12">
						<strong>Email:</strong>
					</div>
					<div class="col-md-6 col-sm-12">
						<a href="mailto:<?php echo $r_c['Email'];   ?>"><?php echo $r_c['Email'];   ?></a>
					</div>
				</div>
				<div class="row underline-class">
					<div class="col-md-6 col-sm-12">
						<strong>Contrato de referência:</strong>
					</div>
					<div class="col-md-6 col-sm-12">
						Dedetização e sanitização nº <?php echo $v['Pedido'];   ?>
					</div>
				</div>				
				<div class="row underline-class">
					<div class="col-md-6 col-sm-12">
						<strong>Nota</strong>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="Stars" style="--rating: <?php echo $v['Nota'];   ?>;" aria-label="Rating of this product is 2.3 out of 5."></div>
					</div>
				</div>
				<div class="row underline-class">    
					<div class="col-md-6 col-sm-12">
						<strong>Endereço:</strong>
					</div>
					<div class="col-md-6 col-sm-12">
						<?php echo $r_cli['Endereco'];   ?>, <?php echo $r_cli['Sorocaba'];   ?>/<?php echo $r_cli['Uf'];   ?>, CEP: <?php echo $r_cli['Cep'];   ?>
					</div>
				</div>
				<div class="row underline-class">
					<div class="col-md-6 col-sm-12">
						<strong>Contato do cliente:</strong>
					</div>
					<div class="col-md-6 col-sm-12">
						<a href="callto:55<?php echo $r_cli['Telefone'];   ?>">+55<?php echo $r_cli['Telefone'];   ?></a>
					</div>
				</div>
				<div class="row underline-class">
					<div class="col-md-12 col-sm-12">
						<strong>Comentário do cliente:</strong>
						<div class="comentario">
							<span><?php echo $v['Comentario'];    ?></span>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
<?php    }  ?>





<?php    


	$first = 1;

	$total_a = Query('SELECT Avaliacao,Nota FROM avaliacao WHERE Parceiro = '.$_SESSION['Parceiro'].'',0);
	$count_total_a = mysqli_num_rows($total_a);

	if($count_total_a  > 0){
		$nota = 0;

		while($r_count_a = mysqli_fetch_assoc($total_a)){
			$nota = $nota + $r_count_a['Nota'];
		}

		//media
		$media_empresa = $nota/$count_total_a;

	}else{
		$media_empresa = 0;
	}




	$first = 1;
	$colaborador_text = '';
	$media_text = '';

	$q_colaboradores = Query('SELECT * FROM colaborador WHERE Parceiro = '.$_SESSION['Parceiro'].'',0);
	if(mysqli_num_rows($q_colaboradores) > 0){
		while($r_colaborador =  mysqli_fetch_assoc($q_colaboradores)){
				

			$total_a = Query('SELECT Avaliacao,Nota FROM avaliacao WHERE Colaborador = '.$r_colaborador['Colaborador'].'',0);
			$count_total_a = mysqli_num_rows($total_a);

			if($count_total_a  > 0){
				$nota = 0;

				while($r_count_a = mysqli_fetch_assoc($total_a)){
					$nota = $nota + $r_count_a['Nota'];
				}

				//media
				$media_a = $nota/$count_total_a;

			}else{
				$media_a = 0;
			}

			if($first){
				$media_text .= "'".$media_a."'";
				$colaborador_text .= "'".$r_colaborador['Titulo']."'";
				$empresa_text .= "'".$media_empresa."'";
				$first = 0;
			}else{
				$media_text .= ",'".$media_a."'";
				$colaborador_text .= ",'".$r_colaborador['Titulo']."'";
				$empresa_text .= ",'".$media_empresa."'";
			}

		}
	}





   
?>
<script>
	$(function() {
		var leads_table = $('#rate-table');

		var _dt_options = {
      "language":{
          "url": "./js/Portuguese-Brasil.json"
      },
      "ordering": true,
      "order" : [ 0, "asc" ],
      "paging": true,
      "searching": true,
      "info": false,
      responsive : true
    };

    leads_table.DataTable(_dt_options);

    var ctx = $('#chartAvaliacao');
    var funcionarios = [<?php echo  $colaborador_text; ?>];
    var medias = [<?php  echo $media_text;   ?>];

    var myChart = new Chart(ctx, {
      data: {
        datasets: [{
          type: 'bar',
          label: 'Nota',
          data: medias,
          borderColor: ['rgb(255, 224, 230)', 'rgb(254, 192, 212)', 'rgb(153, 255, 31)', 'rgb(191, 21, 21)', 'rgb(111, 192, 255)'],
          backgroundColor: ['rgba(255, 224, 230, 0.8)', 'rgba(254, 192, 212, 0.8)', 'rgba(153, 255, 31, 0.8)', 'rgba(191, 21, 21, 0.8)', 'rgba(111, 192, 255, 0.8)'],
          order: 2
        }, {
          type: 'line',
          label: 'Média da empresa',
          data: [<?php  echo $media_empresa;   ?>],
          borderColor: '#5988C3',
          order: 1
        }],
        labels: funcionarios
      },
      // plugins: [plugin],
      options: {
        scales: {
          y: {
            color: '#582583',
            beginAtZero: true,
            font: {
              weight: 'bold'
            },
          },
        },
      }
    });

	})
</script>

</body>
</html>