<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Serviços</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>
			
			<div class="servicos-wrapper border-div">
				<h3>Todos os serviços</h3>
				<form action="requisicoes/envia-nota.php" id="form-upload-doc" class="form-upload" style="display: none;" enctype='multipart/form-data'></form>
				<table id="table-servicos" class="ddt-table table">
					<thead>
						<tr>
							<th>Nota Fiscal</th>
							<th>Nº Serviço</th>
							<th>Profissional</th>
							<th>Serviço</th>
							<th>Valor</th>
							<th>Status</th>
							<th>Local</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php      
						$q = Query('SELECT * FROM servico_prestado WHERE Ativo = 1 ORDER BY Servico_prestado DESC',0);
						if(mysqli_num_rows($q) > 0){
							while($r = mysqli_fetch_assoc($q)){
					?>
						<tr>
							<td><a href="documentos/Doc_teste.pdf" target="_blank">Ver NF</a></td>
							<td><?php echo get('servico_prestado',$r['Servico_prestado']);     ?></td>
							<td><?php echo get('colaborador',$r['Colaborador']);     ?></td>
							<td><?php echo get('servico',$r['Servico']);     ?></td>
							<td>R$ <?php echo $r['Valor'];     ?></td>
							<td><?php echo get('status_cotacao',$r['Status_cotacao']);     ?></td>
							<td><?php echo $r['Uf'];     ?>/<?php echo $r['Cidade'];     ?></td>
							<td> 
								<input type="file" name="Upload" form="form-upload-doc" data-id="<?php echo $r['Servico_prestado'];   ?>" class="trigger-class">
								<input type="hidden" form="form-upload-doc" value="<?php echo $r['Servico_prestado'];   ?>" name="Servico_prestado">
								<button type="submit" form="form-upload-doc" style="display: none;">salvar</button>
								<div class="upload-button"><span><i class="fa fa-upload"></i></span></div>
							</td>
						</tr>   
					<?php } }   ?>
       
					</tbody>
				</table>
			</div>	
		</div>
	</div>
</section>
<?php include('footer.php'); ?>

<script>
	$(function(){

		var data_leads = $('#table-servicos');
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

    data_leads.DataTable(_dt_options);

    $(document).on('click', '.upload-button', function(){
    	$(this).parents('td').find('.trigger-class').trigger('click');

  		$(this).parents('td').find('.trigger-class').change(function(){
  			$(this).parents('td').find('button').trigger('click');
  		})
    });

    $('#form-upload-doc').submit(function(e){
    	e.preventDefault();
      $(this).validate();
      var form = $(this)[0];
      var dados = new FormData(form);
      var formAction = $(this).attr('action');  

      $.ajax({
      	url: formAction,
      	data: dados,
        mimeType:"multipart/form-data",
	      type: "POST",
      	cache: false,
      	success: function(res){
      		// success callback
      	}
      })
    })    
	})	
</script>
</body>
</html>