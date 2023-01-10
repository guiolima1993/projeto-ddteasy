<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Gestão de Sellers</h1>
		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="row row-ddt">
				<div class="col-info-gestao content-placer border-div">
					<h6>Benchmark</h6>
					<div class="row info-row">
						<?php   $r_media = Query('SELECT AVG(Nota) as Media_nota FROM avaliacao',1);    ?>
						<div class="rate-box"><?php echo $r_media['Media_nota'];    ?></div>
					</div>
					<hr>
					<i>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis repudiandae expedita nam, explicabo pariatur.</i>
				</div>
				<div class="col-info-gestao content-placer border-div">
					<h6>TOP 5 Avaliadas</h6>
					
					<canvas id="topAvaliada"></canvas>
				</div>
				<div class="col-info-gestao content-placer border-div">
					<h6>TOP 5 Solicitadas</h6>
					<canvas id="topSolicitada"></canvas>
				</div>

				<div class="col-xl-12 col-md-12 col-sm-12 content-placer border-div mt-4">
					
					<div class="row">
						<div class="col-xl-6 col-md-6 col-sm-12">
							<h6>Novas solicitações de Sellers</h6>
							<ul id="listaParceiro" class="parceiro-list">
							<?php  
								$q_seller = Query('SELECT * FROM parceiro WHERE Ativo = 0 ORDER BY Parceiro LIMIT 10',0);
								if(mysqli_num_rows($q_seller) > 0){
									while($r_seller = mysqli_fetch_assoc($q_seller)){
							?>
								<li class="parceiro-item">
									<span class="parceiro-title limit-text" data-length="40"><?php echo $r_seller['Titulo'];   ?></span>
									<a href="novo-seller.php?1=<?php echo $r_seller['Parceiro'];   ?>" class="parceiro-link">Ver solicitação</a>
								</li>
							<?php  }   }    ?>
							</ul>

							<a href="solicitacao-parceria.php" class="list-parceiro-link-all">Ver todos</a>
						</div>
						<div class="col-xl-6 col-md-6 col-sm-12">
							<h6>Adesão a plataforma nos últimos meses</h6>
							<canvas id="adesaoChart"></canvas>
						</div>
					</div>

				</div>

				<div class="col-xl-12 col-md-12 col-sm-12 content-placer border-div mt-4">
					<h6 class="mb-4">Sellers cadastrados</h6>
					<table class="table" id="sellersTable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nome Fantasia</th>
								<th>Status</th>
								<th>Local</th>
								<th>Chamados</th>
								<th>Média (avaliação)</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php  
							
								$cont_servico = 0;
								$media_avaliacao = 0;


								$q_c = Query('SELECT * FROM parceiro ORDER BY Parceiro ASC',0);
								if(mysqli_num_rows($q_c) > 0){
									while($r_c = mysqli_fetch_assoc($q_c)){

										$cont_servico = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Parceiro = '.$r_c['Parceiro'].'',0));
									  $media_avaliacao_r = Query('SELECT AVG(Nota) as media FROM avaliacao WHERE Parceiro = '.$r_c['Parceiro'].'',1);
										$media_avaliacao  = $media_avaliacao_r['media'];
						?>          
							<tr>
									<td><?php echo $r_c['Parceiro'];    ?></td>
								<td><?php echo $r_c['Titulo'];    ?></td>
								<td>
									<?php if($r_c['Ativo']==1){    ?>
										Ativo</td>
									<?php }else{    ?>
										Desativado</td>
									<?php }    ?>
								<td><?php echo $r_c['Endereco'];    ?></td>
								<td><?php echo $cont_servico;   ?></td>
								<td><?php echo $media_avaliacao;     ?></td>
								<td><a href="editar-seller.php?1=<?php echo $r_c['Parceiro'];   ?>">Ver mais</a></td>
							</tr>
						<?php  }   }   ?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</section>
<?php include('footer.php'); ?>

<script>
	$(function() {

		var dataChartAvaliacao = [];		
		var avaliacaoCtx = document.getElementById("topAvaliada");
		var solicitacaoCtx = document.getElementById("topSolicitada");
		var adesaoCtx = document.getElementById("adesaoChart");
		
  	var listParceiroIdentifier = document.getElementById("listaParceiro");
  	var i;

  	for (i = 0; i < listParceiroIdentifier.children.length; i++) {

  		if (i > 4) {
  			listParceiroIdentifier.children[i].style.display = "none";

				if (!$('.list-parceiro-link-all').hasClass("active")){
					$('.list-parceiro-link-all').addClass("active");
				}	
  		}


  	}

  	    <?php   


  $cliente_nome =  array();
  $cliente_acesso =  array(); 

          
  $q_c = Query('SELECT DISTINCT(Parceiro),AVG(Nota) as Media_nota FROM avaliacao GROUP BY Parceiro ORDER BY Media_nota DESC LIMIT 5',0);
  if(mysqli_num_rows($q_c) > 0){
    while($r_c = mysqli_fetch_assoc($q_c)){

    	$titulo =  get('parceiro',$r_c['Parceiro']);


      $cliente_nome[] = $titulo;
      $cliente_acesso[] = $r_c['Media_nota'];
    }
  }

?>


		var topAvaliacao = new Chart(avaliacaoCtx, {
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

        $faixa_1_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 1) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_2_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 2) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_3_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 3) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_4_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 4) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_5_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 5) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_6_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 6) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_7_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 7) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_8_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 8) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_9_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 9) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_10_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 10) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_11_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 11) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));
        $faixa_12_count = mysqli_num_rows(Query('SELECT * FROM parceiro WHERE (MONTH(Data_cadastro) = 12) AND YEAR(Data_cadastro) = YEAR(CURDATE())'));

    ?>

    var adesaoChart = new Chart(adesaoCtx, {
		  type: "line",
		  data: {
		    labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
		    datasets: [{
		      fill: false,
		      lineTension: 0,
		      label: "Novos parceiros",
		      backgroundColor: "rgba(0,0,255,1.0)",
		      borderColor: "rgba(0,0,255,0.5)",
		      data: [<?php echo $faixa_1_count;   ?>,<?php echo $faixa_2_count;   ?>,<?php echo $faixa_3_count;   ?>,<?php echo $faixa_4_count;   ?>,<?php echo $faixa_5_count;   ?>,<?php echo $faixa_6_count;   ?>,<?php echo $faixa_7_count;   ?>,<?php echo $faixa_8_count;   ?>,<?php echo $faixa_9_count;   ?>,<?php echo $faixa_10_count;   ?>,<?php echo $faixa_11_count;   ?>,<?php echo $faixa_12_count;   ?>]
		    }]
		  },
		  plugins: [ChartDataLabels],
		  options: {
		  	plugins: {
		  		datalabels: {
		  			color: 'purple',
		  			anchor: 'end',
		  			align: 'end'
		  		}
		  	},
		    legend: {display: false}		    
		  }
		});


<?php   


  $cliente_nome =  array();
  $cliente_acesso =  array(); 

          
  $q_c = Query('SELECT DISTINCT(Parceiro),COUNT(Servico_prestado) as Media_nota FROM servico_prestado GROUP BY Parceiro ORDER BY Media_nota DESC LIMIT 5',0);
  if(mysqli_num_rows($q_c) > 0){
    while($r_c = mysqli_fetch_assoc($q_c)){

    	$titulo =  get('parceiro',$r_c['Parceiro']);


      $cliente_nome[] = $titulo;
      $cliente_acesso[] = $r_c['Media_nota'];
    }
  }

?>


    var topSolicitadas = new Chart(solicitacaoCtx, {
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
	      		color: 'purple',
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

    $('#sellersTable').dataTable(_dt_options);
	})
</script>
</body>
</html>