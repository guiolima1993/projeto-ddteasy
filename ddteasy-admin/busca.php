<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Os resultados da sua busca são:</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="busca-display">
				<?php if(isset($_GET['Busca']) && (($_GET['Busca']=='cliente' || strpos($str, 'cliente') !== false) || ($_GET['Busca']=='clientes' || strpos($str, 'clientes') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="gestao-clientes.php" class="link-resultado">
							<h4 class="resultado-title">Cliente</h4>
							<div class="resultado-body limit-text" data-length="340">
								<!--<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores iusto, cupiditate, dignissimos consequuntur officia natus soluta ipsa eius pariatur eos, doloribus exercitationem porro consectetur debitis neque vero autem ipsam, voluptatum!</span>-->
							</div>
						</a>
					</div>
				<?php }else if(isset($_GET['Busca']) && (($_GET['Busca']=='seller' || strpos($str, 'seller') !== false) || ($_GET['Busca']=='parceiro' || strpos($str, 'parceiro') !== false) || ($_GET['Busca']=='sellers' || strpos($str, 'sellers') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="gestao-sellers.php" class="link-resultado">
							<h4 class="resultado-title">Seller</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>

					<div class="resultado-wrapper">
						<a href="enviar-conteudo.php" class="link-resultado">
							<h4 class="resultado-title">Conteúdo para Sellers</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>
				<?php }else if(isset($_GET['Busca']) && (($_GET['Busca']=='servicos' || strpos($str, 'servicos') !== false) || ($_GET['Busca']=='serviço' || strpos($str, 'serviço') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="servicos.php" class="link-resultado">
							<h4 class="resultado-title">Serviços</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>
				<?php }else if(isset($_GET['Busca']) && (($_GET['Busca']=='dashboard' || strpos($str, 'dashboard') !== false) || ($_GET['Busca']=='grafico' || strpos($str, 'grafico') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="" class="link-resultado">
							<h4 class="resultado-title">Dashboard</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>
				<?php }else if(isset($_GET['Busca']) && (($_GET['Busca']=='notificacao' || strpos($str, 'notificacao') !== false) || ($_GET['Busca']=='notificação' || strpos($str, 'notificação') !== false) || ($_GET['Busca']=='notificações' || strpos($str, 'notificações') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="notificacao.php" class="link-resultado">
							<h4 class="resultado-title">Notificação</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>
				<?php }    ?>
			</div>    
			<div class="mt-5">
				<button class="btn btn-primary" onclick="voltar()">Voltar</button>
			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>
<script>
	function voltar(){
		window.history.back();
	}
</script>
</body>
</html>