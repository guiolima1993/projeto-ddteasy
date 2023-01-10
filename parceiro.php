<?php include('header.php'); ?>
   
<div class="background-all">
  <div class="be-partern">
    <!-- <div class="container-partern">
        <div class="first-content">
            <div class="image">
                <img src="images/ddteasy-images/cxelular.png" alt="celular_image">
            </div>
            <div class="title">
                <h4>NAVEGUE DE FORMA SIMPLES</h4>
            </div>
            <div class="info">
                <p>Acompanhe seus pedidos e faça a gestão de informações em um só lugar.</p>
            </div>
        </div>
        <div class="second-content">
            <div class="image">
                <img src="images/ddteasy-images/graficos.png" alt="graficos_image">
            </div>
            <div class="title">
                <h4>MULTIPLIQUE SUAS VENDAS</h4>
            </div>
            <div class="info">
                <p>Amplie suas possibilidades utilizado um novo canal de vendas.</p>
            </div>
        </div>

        <div class="third-content">
            <div class="image">
                <img src="images/ddteasy-images/Custos.png" alt="Reduzir-custos_image">
            </div>
            <div class="title">
                <h4>REDUZA CUSTOS</h4>
            </div>
            <div class="info">
                <p>Ganhe eficiencia e reduza investimentos com Marketing e captação de clientes.</p>
            </div>
        </div>

        <div class="fourth-content">
            <div class="image">
                <img src="images/ddteasy-images/Projetos_Pc.png" alt="Projetos_image">
            </div>
            <div class="title">
                <h4>AUMENTE A VISIBILIDADE DA SUA MARCA</h4>
            </div>
            <div class="info">
                <p>Dê maior exposição da sua empresa no mercado digital.</p>
            </div>
        </div>
    </div> -->
    <div class="row">
      <div class="col-xl-12 col-md-12 col-sm-12 text-center phrase-center">
        <h2 class="tittle">Participe da primeira plataforma de dedetização do Brasil.</h2>
        <h3 class="subtittle mt-2">Impulsione sua empresa com a gente!</h3>
      </div>
    </div>
  </div>
  <div class="container flex-form">
    <div class="col-md-5 formulario" #topTitle>
      <form action="requisicoes/envia-contato.php" id="form-parceiro" class="needs-validation form-submit" novalidate>
        <input type="hidden" name="Tipo" value="Parceiro">
        <div class="form-row">
          <div class="col-md-12 mb-3">
            <h3>Seja um parceiro DDTeasy</h3>
            <label for="validationTooltip01">Nome</label>
            <input type="text" name="Nome" class="form-control" placeholder="Nome completo" id="validationTooltip01" required>
          </div>

          <div class="col-md-12 mb-3">
            <label for="validationTooltip02">CNPJ</label>
            <input type="text" name="Cnpj" class="form-control cnpj-field" placeholder="CNPJ da empresa" id="validationTooltip02" required>
          </div>
    
          <div class="col-md-12 mb-3">
            <label for="validationTooltip02">Nome da empresa</label>
            <input type="text" name="Nome_empresa" class="form-control" placeholder="Nome da empresa" id="validationTooltip02" required>
          </div>

          <div class="col-md-12 mb-3">
            <label for="validationTooltip02">Email corporativo</label>
            <input type="text" name="Email" class="form-control" placeholder="Email corporativo" id="validationTooltip02" required>
          </div>



          <div class="col-md-12 mb-3">
            <label for="validationTooltip01">Telefone</label>
            <input type="text" name="Telefone" placeholder="Telefone" class="form-control cel-field" id="validationTooltip01" required>
          </div>
        </div>
    
        <div class="form-checkbox">
          <div class="col-md-12 mb-3">
            <label for="validationTooltip04">Como podemos falar com você?</label><br>
            <div class="input-checkbox d-flex align-items-center">
              <input type="checkbox" name="Forma_contato_Telefone" value="1">
              <label for="opcao1" class="options"><i class="fa fa-phone"></i> Telefone</label><br>
            </div>
            <div class="input-checkbox d-flex align-items-center">
              <input type="checkbox" name="Forma_contato_Whatsapp" value="1">
              <label for="opcao2" class="options"><i class="fa fa-whatsapp"></i> Whatsapp</label><br>
            </div>
            <div class="input-checkbox d-flex align-items-center">
              <input type="checkbox" name="Forma_contato_Email" value="1">
              <label for="opcao3" class="options"><i class="fa fa-envelope-o"></i> E-mail</label><br>
            </div>
            <!-- <div class="input-checkbox d-flex align-items-center">
              <input type="checkbox">
              <label for="opcao4" class="options"> Opção 5</label>
            </div> -->
            <div class="invalid-tooltip">
              Please select a valid state.
            </div>
          </div>
        </div>
        <div class="button-align">
          <button class="btn btn-primary w-50" type="submit">Enviar</button>
        </div>
      </form>
    </div>

    <div class="active col-md-7 col-lg-6 col-xl-6">
      <h3 class="title-page text-center">Benefícios</h3>
      <div class="container-partern">        
        <?php   
            $i = 0;
            $class = array('first','second','third','fourth'); 
            $q = Query('SELECT * FROM seja_parceiro_item WHERE Ativo = 1 ORDER BY Seja_parceiro_item ASC LIMIT 4',0);
            if(mysqli_num_rows($q) > 0){
                while($r = mysqli_fetch_assoc($q)){
        ?> 
            <div class="<?php echo $class[$i];    ?>-content">
                <div class="image">
                    <img src="<?php  echo $Config['UrlSite'];  ?>imagens/seja_parceiro_item/306/<?php  echo $r['Imagem'];  ?>" alt="<?php  echo $r['Titulo'];  ?>">
                </div>
                <div class="title">
                    <h4><?php  echo $r['Titulo'];  ?></h4>
                </div>
                <div class="info">
                    <p><?php  echo $r['Resumo'];  ?></p>
                </div>
            </div>
        <?php   $i++; } }    ?>


    </div>
      <!-- <div class="phrase-align">
        <div>
          <h2 class="tittle">Participe da primeira plataforma de dedetização do Brasil.</h2>
          <h3 class="subtittle">Impulsione sua empresa com a gente!</h3>
          <img src="images/bepartner.svg" alt="Parceiro DDTeasy" class="partner-img">
        </div>
      </div> -->
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

</body>

</html>