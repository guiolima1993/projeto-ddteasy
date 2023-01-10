<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Gestão de Funcionários</h1>

		<div class="page-content">
			<?php include('top-box.php'); 
					$q = Query('SELECT * FROM colaborador WHERE Parceiro = '.$_SESSION['Parceiro'].' ORDER BY Titulo ASC',0);
					$total = mysqli_num_rows($q);

					$q_a = Query('SELECT * FROM colaborador WHERE Parceiro = '.$_SESSION['Parceiro'].' AND Ativo = 1 ORDER BY Titulo ASC',0);
					$total_ativo = mysqli_num_rows($q_a);
					
					$diff = $total - $total_ativo;
			?>
			
			<div class="row">
				<div class="col-xl-4 col-md-4 col-sm-12">
					<div class="div-ddt-container text-center">
						<span class="b-text"><?php  echo $total;   ?></span>
						<h6 class="text-center">Quantidade de funcionários</h6>						
					</div>
				</div>
				<div class="col-xl-4 col-md-4 col-sm-12">
					<div class="div-ddt-container text-center">
						<span class="b-text"><?php  echo $total_ativo;   ?></span>
						<h6 class="text-center">Funcionários ativos</h6>
					</div>
				</div>
				<div class="col-xl-4 col-md-4 col-sm-12">
					<div class="div-ddt-container">
						<canvas id="chartColab" height="150" width="150"></canvas>
					</div>
				</div>
				<div class="col-xl-12 col-md-12 col-sm-12">
					<div class="div-ddt-container border-div mt-4">
						<a href="novo-funcionario.php" class="btn btn-hd-page mb-4"><i class="fa fa-pencil-square"> 
							<span>Adicionar Novo</span> </i></a>
						<table id="table-gestao" class="table ddt-table" style="width: 100%;">
							<thead>
								<tr>
									<th>Filial</th>
									<th>Nome</th>
									<th>RG</th>
									<th>CPF</th>
									<th>Serviços</th>
									<th>Situação</th>
									<th class="text-center">Consultar mais</th>
								</tr>
							</thead>
							<tbody>
								<?php           
									$cache = array();    
									if($total > 0){
										while($r = mysqli_fetch_assoc($q)){
								?>
									<tr>
										<td><?php  echo get('filial',$r['Filial']);   ?></td>
										<td><?php  echo $r['Titulo'];   ?></td>
										<td><?php  echo $r['Rg'];   ?></td>
										<td><?php  echo $r['Cpf'];   ?></td>
										<td><?php  echo get('servicos_prestados',$r['Servicos_prestados']);   ?></td>
										<td><?php  

														if($r['Ativo']==1){
															echo 'Ativo';
														}else{
															echo 'Inativo';
														}

											?></td>
										<td class="text-center"><button class="btn btn-table-edit" type="button" data-bs-toggle="modal" data-bs-target="#modalGestaoModal<?php echo $r['Colaborador'];  ?>"><img src="images/icons/pencil.png" alt="" class="img-fluid"></button></td>
									</tr>
								<?php $cache[] = $r; }   }  ?>
							</tbody>

						</table>

					</div>				
				</div>
			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>

<?php  foreach ($cache as $k => $v){  ?>
<div class="modal" id="modalGestaoModal<?php  echo $v['Colaborador'];  ?>" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Consulta Funcionário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      	<div class="row">
        	<div class="col-sm-3 h-txt">Foto:</div>
        	<div class="col-sm-9">
	        	<img src="../imagens/colaborador/100/<?php  echo $v['Imagem'];  ?>" width="100" height="100" alt="Foto_funcionario" class="img-funcionario">
        	</div>
        </div>
      	<div class="row">    
      		<div class="col-sm-3 h-txt">Nome:</div>
      		<div class="col-sm-9"><?php  echo $v['Titulo'];   ?></div>
      	</div>

      	      	<div class="row">    
      		<div class="col-sm-3 h-txt">Filial:</div>
      		<div class="col-sm-9"><?php  echo get('filial',$v['Filial']);   ?></div>
      	</div>


      	


      	<div class="row">
      		<div class="col-sm-3 h-txt">RG:</div>
      		<div class="col-sm-9"><?php  echo $v['Rg'];   ?></div>
      	</div>
       	<div class="row">
      		<div class="col-sm-3 h-txt">CPF:</div>
      		<div class="col-sm-9"><?php  echo $v['Cpf'];   ?></div>
      	</div>
      	<div class="row">
      		<div class="col-sm-3 h-txt">Situação:</div>
      		<div class="col-sm-9"><?php  echo $v['Rg'];   ?></div>
      	</div>
      	<div class="row">
      		<div class="col-sm-3 h-txt">Serviços:</div>
      		<div class="col-sm-9">
      				<?php  

														if($r['Ativo']==1){
															echo 'Ativo';
														}else{
															echo 'Inativo';
														}

											?>

      		</div>
      	</div>
      	<div class="row">
      		<div class="col-sm-3 h-txt">Local:</div>
      		<div class="col-sm-9"><?php  echo $v['Cidade'];   ?>/<?php  echo $v['Uf'];   ?></div>
      	</div>
      	<div class="row">
      		<div class="col-sm-3 h-txt">Descrição:</div>
      		<div class="col-sm-9">
      			<article>
      				<?php  echo $v['Descricao'];   ?>
      			</article>
      		</div>
      	</div> 

      </div>

      <div class="modal-footer">
      	<a href="editar-funcionario.php?id=<?php  echo $v['Colaborador'];   ?>" class="btn btn-modal-redirect"><i class="fa fa-edit"></i> Editar</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php   }   ?>


<?php include('footer.php'); ?>

<script>
	$(function(){

		var data_leads = $('#table-gestao');
		var _dt_options = {
      "language":{
        "url": "./js/Portuguese-Brasil.json"
      },
      "ordering": true,
      "order" : [ 0, "asc" ],
      "paging": true,
	    "searching": true,
      "info": false,
      "responsive" : true
    };

    data_leads.DataTable(_dt_options);

    var colabCtx = $('#chartColab')

    var colabChart = new Chart(colabCtx, {
      type: "doughnut",
      data: {
        labels: ["Ativos", "Inativos"],
        datasets: [{
          backgroundColor: [
            "#BCC7DC",
            "#FAE5D5",
          ],
          data: [<?php echo $total_ativo;    ?>,<?php echo $diff;    ?>]
        }]
      },
      plugins: [ChartDataLabels],
      options: {
        plugins: {
          legend: {
            position: 'right',

            labels: {
              color: '#582583',
              font: {
                weight: 'bold'
              }
            },
          },
          datalabels: {
          	color: 'purple'
          }
        }
      },
    });
	})
</script>
</body>
</html>