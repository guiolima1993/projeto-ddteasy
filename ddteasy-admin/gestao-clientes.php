<?php include('header.php');	 ?>
	<div class="page-container">
		<h1 class="page-title">Gestão de Clientes</h1>

		<div class="page-content">

			<?php include('top-box.php'); 

			$q_c = Query('SELECT * FROM cliente ORDER BY Cliente ASC',0);
			$total_c = mysqli_num_rows($q_c);  

			$q_c = Query('SELECT * FROM cliente WHERE Ativo = 1 ORDER BY Cliente ASC',0);
			$total_ativo = mysqli_num_rows($q_c);   

			$q_c = Query('SELECT * FROM cliente WHERE Ativo = 0 ORDER BY Cliente ASC',0);
			$total_inativo = mysqli_num_rows($q_c);     

		?>
			
			<div class="row row-ddt">
				<div class="col-xl-6 col-md-6 col-sm-12 half-col-adjust content-placer border-div">
					<h6>Clientes Cadastrados</h6>
					<span><?php  echo $total_c;   ?> clientes estão cadastrados na plataforma</span>
					<canvas id="cadastroChart"></canvas>
				</div>
				<div class="col-xl-6 col-md-6 col-sm-12 half-col-adjust content-placer border-div">
					<h6>Clientes Mais Frequentes</h6>
					<canvas id="clientesChart"></canvas>   
				</div>
				<div class="col-xl-6 col-md-6 col-sm-12 half-col-adjust content-placer border-div">
					<h6>Locais Mais Frequentes</h6>
					<canvas id="localChart"></canvas>
				</div>
				<div class="col-xl-6 col-md-6 col-sm-12 half-col-adjust content-placer border-div">
					<h6>Faixa Etária</h6>
					<canvas id="fxEtariaChart"></canvas>
				</div>
				<div class="col-xl-12 col-md-12 col-sm-12 content-placer border-div mt-4">
					<h6 class="text-center">Todos os Clientes</h6>
					<table id="clienteTable" class="table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Nome completo</th>
								<th>Local</th>
								<th>Qtde de chamados</th>
								<th>Avaliação Média</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php  
								$cont_servico = 0;
								$media_avaliacao = 0;


								$q_c = Query('SELECT * FROM cliente ORDER BY Cliente ASC',0);
								if(mysqli_num_rows($q_c) > 0){
									while($r_c = mysqli_fetch_assoc($q_c)){

										$cont_servico = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Cliente = '.$r_c['Cliente'].'',0));
									  $media_avaliacao_r = Query('SELECT AVG(Nota) as media FROM avaliacao WHERE Cliente = '.$r_c['Cliente'].'',1);
										$media_avaliacao  = $media_avaliacao_r['media'];
						?>
							<tr>
								<td><?php echo $r_c['Cliente'];    ?></td>
								<td><?php echo $r_c['Titulo'];    ?></td>
								<td><?php echo $r_c['Endereco'];    ?></td>
								<td><?php echo $cont_servico;     ?></td>
								<td><?php echo $media_avaliacao;     ?></td>  
								<td>
									<?php if($r_c['Ativo']==1){    ?>
										<img src="images/icons/green.png" alt="Ativo" class="img-situacao"></td>
									<?php }else{    ?>
										<img src="images/icons/red.png" alt="Ativo" class="img-situacao"></td>
									<?php }    ?>
								<td><a href="editar-cliente.php?1=<?php echo $r_c['Cliente'];    ?>">Ver tudo</a></td>
							</tr>
						<?php  }  }   ?>
						</tbody>
					</table>
				</div>
			</div>



		</div>
	</div>	
</section>
<?php include('footer.php'); 	 ?>
<script>
<?php   


  $cliente_nome =  array();
  $cliente_acesso =  array(); 

          
  $q_c = Query('SELECT Titulo,Cliente,Contador FROM cliente ORDER BY Contador DESC',0);
  if(mysqli_num_rows($q_c) > 0){
    while($r_c = mysqli_fetch_assoc($q_c)){
      $cliente_nome[] = $r_c['Titulo'];
      $cliente_acesso[] = $r_c['Contador'];
    }
  }

?>




	$(function() {
		var customerCtx = document.getElementById("clientesChart");
		var servicosCtx = document.getElementById("localChart");
		var cadastroCtx = document.getElementById("cadastroChart");
		var fxEtariaCtx = document.getElementById("fxEtariaChart");

		var topCustomer = new Chart(customerCtx, {
      type: "pie",
      data: {
        labels: [<?php    foreach ($cliente_nome as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"';  }   } ?>],
        datasets: [{
          backgroundColor: [
            "#BCC7DC",
            "#FAE5D5",
            "#FAD4D2",
            "#8F8A8E",
            "#CAC2D1"
          ],
          data: [<?php    foreach ($cliente_acesso as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"'; }  } ?>]
        }]
      },
      plugins: [ChartDataLabels],
      options: {
        plugins: {
        	datalabels: {
        		color: 'purple'
        	},
          legend: {
            position: 'right',

            labels: {
              color: '#582583',
              font: {
                weight: 'bold'
              }
            },
          },
        }
      },
    });



    <?php   


  $cliente_nome =  array();
  $cliente_acesso =  array(); 

          
  $q_c = Query('SELECT DISTINCT(Cidade),COUNT(*) as Total FROM cliente GROUP BY Cidade ORDER BY Total DESC',0);
  if(mysqli_num_rows($q_c) > 0){
    while($r_c = mysqli_fetch_assoc($q_c)){
      $cliente_nome[] = $r_c['Cidade'];
      $cliente_acesso[] = $r_c['Total'];
    }
  }

?>

    var locaisCtx = new Chart(servicosCtx, {
    	type: "pie",
      data: {
        labels: [<?php    foreach ($cliente_nome as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"';  }   } ?>],
        datasets: [{
          backgroundColor: [
            "#BCC7DC",
            "#FAE5D5",
            "#FAD4D2",
            "#8F8A8E",
            "#CAC2D1"
          ],
          data: [<?php    foreach ($cliente_acesso as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"'; }  } ?>]
        }]
      },
      plugins: [ChartDataLabels],
      options: {      	
        plugins: {
        	datalabels: {
	      		color: 'purple'
	      	},
          legend: {
            position: 'right',

            labels: {
              color: '#582583',
              font: {
                weight: 'bold'
              }
            },
          },
        }
      },
    });
   
    <?php    
        $faixa_1_count = mysqli_num_rows(Query('SELECT * FROM cliente WHERE Idade >= 18 AND Idade <= 30'));
        $faixa_2_count = mysqli_num_rows(Query('SELECT * FROM cliente WHERE Idade >= 31 AND Idade <= 40'));
        $faixa_3_count = mysqli_num_rows(Query('SELECT * FROM cliente WHERE Idade >= 41 AND Idade <= 50'));
        $faixa_4_count = mysqli_num_rows(Query('SELECT * FROM cliente WHERE Idade >= 51 AND Idade <= 60'));
        $faixa_5_count = mysqli_num_rows(Query('SELECT * FROM cliente WHERE Idade >= 61'));
    ?>
    var cadastroChart = new Chart(fxEtariaCtx,{
    	type: "pie",
      data: {
        labels: ["18 - 30 anos", "31 - 40 anos", "41 - 50 anos", "51 - 60 anos", "Mais de 60 anos"],
        datasets: [{
          backgroundColor: [
            "#52b69a",
            "#34a0a4",
            "#168aad",
            "#1a759f",
            "#1e6091"
          ],
          data: [<?php echo $faixa_1_count;   ?>,<?php echo $faixa_2_count;   ?>,<?php echo $faixa_3_count;   ?>,<?php echo $faixa_4_count;   ?>,<?php echo $faixa_5_count;   ?>]
        }]
      },
      plugins: [ChartDataLabels],
      options: {
        plugins: {
        	datalabels: {
        		color: 'white'
        	},
          legend: {
            position: 'right',
   
            labels: {
              color: '#582583',
              font: {
                weight: 'bold'
              }
            },
          },
        }
      },
    });

    var fxEtariaChart = new Chart(cadastroCtx,{
    	type: "pie",
      data: {
        labels: ["Clientes ativos", "Clientes inativos"],
        datasets: [{
          backgroundColor: [
            "#dab6fc",
            "#bee1e6",
            "#ffb3c1"
          ],
          data: [<?php echo $total_ativo;   ?>,<?php echo $total_inativo;   ?>]
        }]
      },
      plugins: [ChartDataLabels],
      options: {
        plugins: {
        	datalabels: {
        		color: 'purple'
        	},
          legend: {
            position: 'right',

            labels: {
              color: '#582583',
              font: {
                weight: 'bold'
              }
            },
          },
        }
      },
    })

    $('#clienteTable').dataTable(_dt_options);
	})
</script>

</body>
</html>