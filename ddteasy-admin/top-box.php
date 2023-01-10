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
          <?= $count ?>
        </div>
      </button>
      
    </div>
    <?php /* <div class="btn-capsule">
      <button class="btn-top"><img src="images/icons/chat.png" alt="Btn_notificacao" />
        <div class="notificacao">
          7
        </div>
      </button>
    </div> */ ?>
    <div class="btn-group btn-capsule">
      <button class="btn-top dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="images/icons/perfil.png" alt="Btn_usuario" />
        <span class="customer-name"><?= get('usuario',$_SESSION['id']); ?></span>
      </button>
      <ul class="dropdown-menu">
        <li><a href="novo-servico.php" class="dropdown-item">Novo serviço</a></li>
        <li><a href="novo-conteudo.php" class="dropdown-item">Adicionar conteúdo</a></li>
        <li><a href="solicitacao-parceria.php" class="dropdown-item">Solicitação de parceria</a></li>
        <li><a href="ajuda.php" class="dropdown-item">Ajuda</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a href="requisicoes/sair.php" class="dropdown-item">Sair</a></li>
      </ul>
      
    </div>
  </div>
</div>