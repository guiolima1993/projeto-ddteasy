<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Notificações</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>
 

			<div class="notificacao-wrapper">
				<!--Colocar aqui um texto fixo isso e um DAshboard nao um site institucional para ficar mudando textos-->
				<span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa accusamus, quae ut quasi nisi accusantium error aliquid corporis nobis! Iure sint est consectetur sit nulla voluptates pariatur, provident earum minima.</span>

				<div class="table-controller">
					<button type="button" class="btn btn-table-controller btn-check-all">Selecionar todos</button>
					<button type="button" class="btn btn-table-controller btn-arquivar" onclick="arquivar_selecionados()">Arquivar</button>
					<button type="button" class="btn btn-table-controller btn-excluir" onclick="excluir_selecionados()">Apagar</button>
					<a href="notificacoes-arquivadas.php" class="btn btn-table-controller btn-arquivados">Arquivados</a>
				</div>
				
				<table id="notify-table" class="table-style">
					<thead>
						<tr>
							<th>Ação</th>   
							<th>Mensagem</th>
							<th>Expandir</th>
						</tr>
					</thead>
					<tbody>
						<?php           
							$cache_avisos = array();
							$q = Query('SELECT * FROM notificacao WHERE Ativo = 1 AND Notificacao NOT IN (SELECT Notificacao from notificacao_arquivada WHERE Parceiro = '.$_SESSION['Parceiro'].') AND Notificacao NOT IN (SELECT Notificacao from notificacao_excluida WHERE Parceiro = '.$_SESSION['Parceiro'].')');
							if(mysqli_num_rows($q) > 0){
								while($r = mysqli_fetch_assoc($q)){
						?>
							<tr>
								<td>
									<input type="checkbox" class="checkNotify" value="">
								</td>
								<td>
									<span><?php  echo $r['Titulo'];   ?></span>
								</td>
								<td>
									<button type="button" class="btn-ver-mais" data-bs-toggle="modal" data-bs-target="#avisoModal<?php  echo $r['Notificacao'];   ?>">Ver íntegra</button>
								</td>
							</tr>
					 <?php $cache_avisos[] = $r;   } }  ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>
 
<script>
	$(function(){

		var leads_table = $('#notify-table');
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

    $(document).on('click', '.btn-check-all', function(){

    	var _t = $(this);

    	if (_t.hasClass("active")) {
    		_t.closest('.notificacao-wrapper').find("input[type='checkbox']").prop('checked', false);

    		_t.removeClass("active");    		
    	}else {
    		_t.closest('.notificacao-wrapper').find("input[type='checkbox']").prop('checked', true);

    		_t.addClass("active");
    	}

    	
    });



	});	

	function excluir_selecionados(){

    swal({   
      title: "",
      text: "Você tem certeza que deseja <b>excluir</b> os registros selecionados ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#ff0000",
      showLoaderOnConfirm: true,
      html: true,
      closeOnConfirm: true   
      }, function(isConfirm){   
        if(isConfirm){      
          $('.checkNotify').each(function(){
			      if($(this).prop("checked")){   

		          elemento = $(this);

		          $.ajax({  
		            type: "POST",
		            async: false, 
		            url: "requisicoes/apagar-notificacao.php",
		            data: "Tabela=xx&Registro=xx",
		            success: function (retorno) {
		              if(retorno==1){
		                $(elemento).parents('tr').remove(); 
		              }else{
		                swal({   
		                  title: "",
		                  text: "Problemas ao excluir o usuário.",
			                type: "error",
		                  confirmButtonColor: "#ff0000",
		                  showLoaderOnConfirm: true,
		                  closeOnConfirm: true
		                }, function(isConfirm){   
			                  if(isConfirm){   
		    
		                    }   
		                  }); 
			              }
		              }
		          });
			      }
				  });   
	      }
		  });  
	}

	function arquivar_selecionados() {
		swal({   
      title: "",
      text: "Você tem certeza que deseja <b>excluir</b> os registros selecionados ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#ff0000",
      showLoaderOnConfirm: true,
      html: true,
      closeOnConfirm: true   
      }, function(isConfirm){   
        if(isConfirm){      
          $('.checkNotify').each(function(){
			      if($(this).prop("checked")){   

		          elemento = $(this);

		          $.ajax({  
		            type: "POST",
		            async: false, 
		            url: "requisicoes/arquivar-notificacao.php",
		            data: "Tabela=xx&Registro=xx",
		            success: function (retorno) {
		              if(retorno==1){
		                $(elemento).parents('tr').remove(); 
		              }else{
		                swal({   
		                  title: "",
		                  text: "Problemas ao excluir o usuário.",
			                type: "error",
		                  confirmButtonColor: "#ff0000",
		                  showLoaderOnConfirm: true,
		                  closeOnConfirm: true
		                }, function(isConfirm){   
			                  if(isConfirm){   
		    
		                    }   
		                  }); 
			              }
		              }
		          });
			      }
				  });   
	      }
		  });  
	}
</script>

</body>
</html>