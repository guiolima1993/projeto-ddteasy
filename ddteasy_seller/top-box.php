<div class="flexbox mb-4">
  <div class="form-wrapper">
    <form action="busca.php" class="form-busca" method="get">
      <div class="form-row">
        <div class="input-line">
          <input type="text" name="Busca" class="form-control" placeholder="Faça sua pesquisa" value="" required>
          <button class="btn-submit"><img src="images/icons/busca.png" alt="Icon_busca" /></button>
        </div>
      </div>
    </form>
  </div>


  <?php     
    $q = Query('SELECT * FROM notificacao WHERE Ativo = 1 AND Parceiro = '.$_SESSION['Parceiro'].' AND Notificacao NOT IN (SELECT Notificacao from notificacao_arquivada WHERE Parceiro = '.$_SESSION['Parceiro'].') AND Notificacao NOT IN (SELECT Notificacao from notificacao_excluida WHERE Parceiro = '.$_SESSION['Parceiro'].')');
        $count   = mysqli_num_rows($q);
              
            ?>
  <div class="btn-wrapper">
    <div class="btn-capsule">
      <button class="btn-top" onclick="document.location.href = 'notificacao.php'"><img src="images/icons/sino.png" alt="Btn_notificacao" />
        <div class="notificacao">
          <?php echo $count;    ?>
        </div>
      </button>
      
    </div>
    <div class="btn-capsule">
      <a href="https://api.whatsapp.com/send?phone=5511912345678" target="_blank" class="btn-top"><img src="images/icons/chat.png" alt="Btn_notificacao" />
        
      </a>
    </div>
    <div class="dropdown btn-group btn-capsule">
      <button id="dropdownMenu" class="btn-top dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="images/icons/perfil.png" alt="Btn_usuario" />
        <span class="customer-name"><?php echo get('parceiro',$_SESSION['Parceiro']);     ?></span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
        <li><a href="cadastro.php" class="dropdown-item">Cadastro</a></li>
        <li><a href="gestao-de-funcionarios.php" class="dropdown-item">Funcionários</a></li>
        <li><a href="documentacao.php" class="dropdown-item">Documentação</a></li>
        <li><a href="adicionar-filial.php" class="dropdown-item">Adicionar filial</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a href="sair.php" class="dropdown-item">Sair</a></li>
      </ul>
      
    </div>
  </div>
</div>