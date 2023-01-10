<?php include('header.php');      ?>
	<div class="page-container">
		<h1 class="page-title">Disponibilizar conteúdos</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="div-ddt-container border-div">
				<div class=>
					<a href="novo-conteudo.php" class="btn btn-ddt">Adicionar</a>
				</div>
				<div class="text-container mb-5">
					<span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt eligendi perferendis, neque ducimus tempore sint, magni enim amet veniam eius dignissimos nam animi repellat aliquam corrupti tenetur beatae molestiae a.</span>
				</div>
				<table class="table" id="table-conteudo">
					<thead>
						<tr>
							<th>ID</th>
							<th>Título</th>
							<th>Serviço</th>
							<th>Status</th>
							<th>Última atualização</th>
							<th>Ver Mais</th>
						</tr>
					</thead>
					<tbody>
						<?php    
							$q = Query('SELECT * FROM material_de_apoio ORDER BY Material_de_apoio ASC',0);
							if(mysqli_num_rows($q) > 0){
								while($r = mysqli_fetch_assoc($q)){ 
						?>
						<tr>
							<td><?php echo $r['Material_de_apoio'];   ?></td>
							<td><?php echo $r['Titulo'];   ?></td>
							<td><?php echo get('servico',$r['Servico']);   ?></td>
							<td><?php if($r['Ativo']==1){echo 'Ativo'; }else{ echo 'Inativo'; }   ?></td>
							<td>
								<?php $oldDate = strtotime($r['Data']);
										$newDate = date('d/m/Y', $oldDate);
										echo $newDate;
								?>
							</td>
							<td><a download href="<?php echo $Config['UrlSite'];   ?>imagens/material_de_apoio/<?php echo $r['Arquivo'];   ?>">Baixar</a></td>
						</tr>
						<?php  }  }   ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	
</section>

<?php include('footer.php'); ?>
<script>
	$(function(){

		$('#table-conteudo').dataTable(_dt_options);
	})
</script>
</body>
</html>