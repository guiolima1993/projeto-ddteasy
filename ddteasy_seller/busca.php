<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Os resultados da sua busca são:</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="busca-display">
				<?php if(isset($_GET['Busca']) && (($_GET['Busca']=='agenda' || strpos($str, 'agenda') !== false) || ($_GET['Busca']=='agendas' || strpos($str, 'agendas') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="agenda.php" class="link-resultado">
							<h4 class="resultado-title">Agenda</h4>
							<div class="resultado-body limit-text" data-length="340">
								<!--<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores iusto, cupiditate, dignissimos consequuntur officia natus soluta ipsa eius pariatur eos, doloribus exercitationem porro consectetur debitis neque vero autem ipsam, voluptatum!</span>-->
							</div>
						</a>
					</div>
				<?php }else if(isset($_GET['Busca']) && (($_GET['Busca']=='avaliação' || strpos($str, 'avaliação') !== false) || ($_GET['Busca']=='avaliações' || strpos($str, 'avaliações') !== false) || ($_GET['Busca']=='nota' || strpos($str, 'nota') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="avaliação.php" class="link-resultado">
							<h4 class="resultado-title">Avaliação</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>
				<?php }else if(isset($_GET['Busca']) && (($_GET['Busca']=='cadastro' || strpos($str, 'cadastro') !== false) || ($_GET['Busca']=='conta' || strpos($str, 'conta') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="cadastro.php" class="link-resultado">
							<h4 class="resultado-title">Cadastro</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>
				<?php }else if(isset($_GET['Busca']) && (($_GET['Busca']=='serviço' || strpos($str, 'serviço') !== false) || ($_GET['Busca']=='serviços' || strpos($str, 'serviços') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="servicos.php" class="link-resultado">  
							<h4 class="resultado-title">Serviços</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>
				<?php }else if(isset($_GET['Busca']) && (($_GET['Busca']=='material' || strpos($str, 'material') !== false) || ($_GET['Busca']=='material de apoio' || strpos($str, 'material de apoio') !== false) || ($_GET['Busca']=='conteudo' || strpos($str, 'conteudo') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="material-de-apoio.php" class="link-resultado">
							<h4 class="resultado-title">Material de Apoio</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>
				<?php  }else if(isset($_GET['Busca']) && (($_GET['Busca']=='colaborador' || strpos($str, 'colaborador') !== false) || ($_GET['Busca']=='rh' || strpos($str, 'rh') !== false) || ($_GET['Busca']=='funcionario' || strpos($str, 'funcionario') !== false))){   ?>
					<div class="resultado-wrapper">
						<a href="gestao-de-funcionarios.php" class="link-resultado">
							<h4 class="resultado-title">Gestão de Colaboradores</h4>
							<!--<div class="resultado-body limit-text" data-length="340">
								<span>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Tempora nisi, magni quod quam quisquam amet facere tempore consequuntur impedit, architecto repudiandae? Nostrum quia, earum commodi perspiciatis. Aut est, eius debitis?</span>
							</div>-->
						</a>
					</div>
				<?php  }  ?>
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