<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Notificações</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>


			<div class="notificacao-wrapper">
				<span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa accusamus, quae ut quasi nisi accusantium error aliquid corporis nobis! Iure sint est consectetur sit nulla voluptates pariatur, provident earum minima.</span>

				<div class="table-controller">
					<button type="button" class="btn btn-table-controller btn-check-all">Selecionar todos</button>
					<button type="button" class="btn btn-table-controller btn-excluir">Apagar</button>
					<a href="notificacao.php" class="btn btn-table-controller btn-arquivados">Voltar</a>
				</div>
				
				<table id="arquivados-table" class="table-style">
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
							$q = Query('SELECT * FROM notificacao  WHERE Notificacao IN (SELECT Notificacao from notificacao_arquivada WHERE Parceiro = 0) ORDER BY Notificacao DESC');
							if(mysqli_num_rows($q) > 0){   
								while($r = mysqli_fetch_assoc($q)){
						?>   
							<tr>
								<td>
									<input type="checkbox" class="checkNotify" name="Notificacao[]" value="<?php  echo $r['Notificacao'];   ?>">
								</td>
								<td>
									<span><?php  echo $r['Titulo'];   ?></span>
								</td>
								<td>
									<button type="button" class="btn-ver-mais"  data-bs-toggle="modal" data-bs-target="#avisoModal<?php  echo $r['Notificacao'];   ?>">Ver íntegra</button>
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

		var leads_table = $('#arquivados-table');
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

    $(document).on('click', '.btn-excluir', function(){
    	let arr_ckb = [];
    	let i;
    	let table_notify = document.getElementById("arquivados-table").rows;

    	swal("Atenção!", "As notificações selecionadas serão apagadas!", "info", {

    		buttons: {
    			cancel: "Cancelar",
    			continuar: {
    				text: "Apagar notificações",
    				value: "continuar"
    			}
    		}
    	}).then((continuar) => {
    		if(continuar){
    			$(this).closest('.notificacao-wrapper').find('input:checkbox').each(function(i, el){
		    		if(el.checked == true){
		    			let t_name = el.value;
		    			arr_ckb.push(t_name);

		    				$.ajax({
				    			url: 'requisicoes/apagar-notificacao.php',
				    			data: {
				    				id: arr_ckb
				    			},
				    			type: "post",
				    			cache: false,
				    			success: function(res){
				    				if(res == 1) {
				    					swal("Sucesso!", "Você acabou de excluir as notificações selecionadas.", "success");
				    					location.reload();
				    				}else {
		    					swal("Ops!", "Houve um erro ao tentar excluir as notificações. Tente novamente mais tarde.", "error");

				    				}
				    			},
				    			else: function(){
				    				swal("Erro", "Houve um erro ao tentar executar esta função.", "error");
				    			}
				    		})
		    		}
		    	})
    		}
    	})    	
    })

	});	
</script>

</body>
</html>