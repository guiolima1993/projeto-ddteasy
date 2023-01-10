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
						$q = Query('SELECT * FROM servico_prestado WHERE Ativo = 1 AND Parceiro = '. $_SESSION['Parceiro'] .' ORDER BY Servico_prestado DESC',0);
						if(mysqli_num_rows($q) > 0){
							while($r = mysqli_fetch_assoc($q)){
					?>
						<tr>
							<?php   
								if(isset($r['Arquivo_nota_fiscal']) && $r['Arquivo_nota_fiscal'] !=''){
							?>
								<td><a href="<?php echo $Config['UrlSite'];   ?>imagens/servico_prestado/<?php echo $r['Arquivo_nota_fiscal'];   ?>" target="_blank">Ver NF</a></td>
							<?php  }else{     ?>
								<td>não enviada</td>
							<?php  }  ?>
							
							<!-- <td><?php echo get('servico_prestado',$r['Servico_prestado']);     ?></td> -->
							<td><?php echo $r['Servico_prestado']; ?></td>
							<td><?php echo get('colaborador',$r['Parceiro']);     ?></td>
							<td><?php echo get('servico',$r['Servico']);     ?></td>
							<td>R$ <?php echo $r['Valor'];     ?></td>
							<td><?php echo get('status_cotacao',$r['Status_cotacao']);     ?></td>
							<td><?php echo $r['Uf'];     ?>/<?php echo $r['Cidade'];     ?></td>
							<td> 
								<input type="file" name="Upload" data-id="<?php echo $r['Servico_prestado'];   ?>" class="trigger-class" style="display: none;">
								<input type="hidden" value="<?php echo $r['Servico_prestado'];   ?>" name="Servico_prestado"> 
								<?php /*<button type="submit" form="form-upload-doc" style="display: none;">salvar</button> */?>
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
  			$(this).closest('tbody').find('input:file').removeAttr('form');
  			$(this).closest('tbody').find('input:hidden').removeAttr('form');
  			
  			$(this).attr('form', 'form-upload-doc');
  			$(this).parent().find('input:hidden').attr('form', 'form-upload-doc');

  			$(this).closest('.servicos-wrapper').find('#form-upload-doc').submit();
  		})
    });

    $('#form-upload-doc').submit(function(e){
    	e.preventDefault();
      $(this).validate();
      var form = $(this)[0];
      var dados = new FormData(form);
      var formAction = $(this).attr('action');
      var valid = $(this).valid();
      if (!valid){
      	return false;
      }else {
	      $.ajax({
	      	url : formAction,
	        type: "POST",
	        data:  dados,
	        mimeType:"multipart/form-data",
	        contentType: false,
	        cache: false,
	        processData:false,
	      	success: function(res){
	      		if (res == 1) {
	      			swal({
	      				title: "Sucesso",
	      				text: "A nota foi enviada com sucesso!",
	      				icon: "success",
	      				confirmButtonText: "Ok!"
	      			})
	      		}else {
	      			swal({
	      				title: "Erro",
	      				text: "Houve um problema no envio da nota. Por favor, tente novamente mais tarde!",
	      				icon: "error",
	      				confirmButtonText: "Ok!"
	      			})
	      		}
	      	},
	      	error: function(){
	      		swal({
      				title: "Erro",
      				text: "Houve um problema no envio da nota. Por favor, tente novamente mais tarde!",
      				icon: "error",
      				confirmButtonText: "Ok!"
      			})
	      	}
	      })
	    }
    })      
	})	
</script>
</body>
</html>