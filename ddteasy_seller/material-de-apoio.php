<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Material de Apoio</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<!-- DEDETIZAÇÃO -->
			<div class="material-flexbox">

				<div class="txt-header">
					<h3>Dedetização</h3>
				</div>
				<?php      
					$q = Query('SELECT * FROM material_de_apoio WHERE Servico = 2 AND Ativo = 1 ORDER BY Titulo  ASC',0);
					if(mysqli_num_rows($q) > 0){
						while($r = mysqli_fetch_assoc($q)){
				?>
					<!-- PRIMEIRO CARD -->
					<div class="card-download-box">
						<a href="../imagens/material_de_apoio/<?php echo $r['Arquivo'];  ?>" class="card-download-link" download>
							<div class="card-download-body">
								<img src="images/icons/download.png" alt="Img_download" class="card-download-img">
								<div class="card-download-txt">
									<span class="limit-text" data-length="75"><?php echo $r['Titulo'];  ?></span>
								</div>
							</div>
						</a>  
					</div>
					<!-- FIM DO CARD -->
				<?php   }  }  ?>
			</div>

			<!-- SANITIZAÇÃO -->
			<div class="material-flexbox">

				<div class="txt-header">
					<h3>Sanitização</h3>
				</div>

				<?php      
					$q = Query('SELECT * FROM material_de_apoio WHERE Servico = 1 AND Ativo = 1 ORDER BY Titulo  ASC',0);
					if(mysqli_num_rows($q) > 0){
						while($r = mysqli_fetch_assoc($q)){
				?>
					<!-- PRIMEIRO CARD -->
					<div class="card-download-box">
						<a href="../imagens/material_de_apoio/<?php echo $r['Arquivo'];  ?>" class="card-download-link" download>
							<div class="card-download-body">
								<img src="images/icons/download.png" alt="Img_download" class="card-download-img">
								<div class="card-download-txt">
									<span class="limit-text" data-length="75"><?php echo $r['Titulo'];  ?></span>
								</div>
							</div>
						</a>  
					</div>
					<!-- FIM DO CARD -->
				<?php   }  }  ?>

			</div>

			<!-- OUTROS -->
			<div class="material-flexbox">
				<div class="txt-header">
					<h3>Outros</h3>
				</div>

				<?php      
					$q = Query('SELECT * FROM material_de_apoio WHERE Servico = 5 AND Ativo = 1 ORDER BY Titulo  ASC',0);
					if(mysqli_num_rows($q) > 0){
						while($r = mysqli_fetch_assoc($q)){
				?>
					<!-- PRIMEIRO CARD -->
					<div class="card-download-box">
						<a href="../imagens/material_de_apoio/<?php echo $r['Arquivo'];  ?>" class="card-download-link" download>
							<div class="card-download-body">
								<img src="images/icons/download.png" alt="Img_download" class="card-download-img">
								<div class="card-download-txt">
									<span class="limit-text" data-length="75"><?php echo $r['Titulo'];  ?></span>
								</div>
							</div>
						</a>  
					</div>
					<!-- FIM DO CARD -->
				<?php   }  }  ?>
			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>
</body>
</html>