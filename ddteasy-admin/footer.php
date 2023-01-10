<!-- <footer>

  <div class="container-fluid text-dark">
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-4 col-institucional-contato">
        
      </div>
      <div class="col-md-4 col-institucional-contato">
        
      </div>
    </div>
  </div>
</footer>
<div class="copyright text-center container">
  <div class="row">
    <div class="col-md-12">&copy; <span class="current-year text-dark"></span> XXXXX, todos os direitos reservados. <br class="mobile-only"> Desenvolvido por <a href="#" target="_blank"><img src="images/makeweb.png" class="inline-icon" alt=""></a></div>
  </div>
</div> -->

<button type="button" class="scroller"><i class="fa fa-angle-up"></i></button>

<!-- <div class="whatsapp-button">
  <a href="http://api.whatsapp.com/send?1=pt_BR&phone=15999999999&text=Olá!%20Eu%20gostaria%20de%20um%20orçamento." target="_blank"><i class="fa fa-whatsapp"></i></a>
  <span>Entre em contato</span>
</div> -->

<div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="avisoModalTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span id="avisoModalText"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Entendi!</button>
      </div>
    </div>
  </div>
</div>

<div class="loader">
  <div class="lds-ellipsis">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<!-- MODAL NOTIFICAÇÃO -->

<div class="modal fade" id="modal-notificacao" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notifique o seller</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Envie uma notificação ao seller <?php if(isset($_GET[1]) && $_GET[1]!=''){ echo get('parceiro',$_GET[1]); }    ?></p>

        <form action="requisicoes/envia-notificacao.php" id="form_notify" class="mt-4 form-notify">
          <div class="form-row">
            <div class="col-md-12 col-sm-12">
              <label>Seller</label>
              <?php if(isset($_GET[1]) && $_GET[1] != ''){ ?>
                <input type="text" name="Cliente" id="form-clientes" class="form-control" value="<?php echo get('parceiro',$_GET[1]);   ?>" required readonly>
              <?php }else{ ?>
                <!-- <input type="text" name="Cliente" id="form-clientes" class="form-control" value="<?php echo get('parceiro',$_GET[1]);   ?>" required> -->

                <div class="super-select">
                  <button type="button" class="select-seller">
                    <img src="images/ddteasy-images/chevron-down-outline.svg" alt="icone super-select">
                    Sellers selecionados: <b class="selected">0</b>
                  </button>

                  <div class="super-select-component">
                    <button type="button" id="select_all" class="super-select-component-button">Selecionar todos</button>

                  <?php    
                    $q_p = Query('SELECT Parceiro,Titulo FROM parceiro WHERE Ativo = 1 ORDER BY Titulo ASC',0);
                    if(mysqli_num_rows($q_p) > 0){
                      while($r_p = mysqli_fetch_assoc($q_p)){   
                  ?>
                    <div class="super-select-checkbox">
                      <input type="checkbox" name="Seller[]" class="input-identify" data-value="<?php echo $r_p['Parceiro'];   ?>" value="<?php echo $r_p['Titulo'];   ?>">
                      <i class="fa fa-square"></i> <?php echo $r_p['Titulo'];   ?>
                    </div>
                  <?php  }  }  ?>
                  </div>
                </div>                
              <?php } ?>
            </div>
            <div class="col-md-12 col-sm-12">
              <label>Assunto</label>
              <input type="text" name="Assunto" id="form-assunto" class="form-control" value="" autocomplete="off" required>
            </div>
            <div class="col-md-12 col-sm-12">
              <label>Mensagem</label>
              <textarea name="Mensagem" id="form-message" rows="3" class="form-control" required></textarea>
            </div>
            <div class="col-md-12 col-sm-12 mt-2">
              <button class="btn btn-ddt">Notificar</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(function(){
    $('.form-notify').submit(function(e){
      e.preventDefault();
      let _t = $(this);
      let selectObj = document.getElementById("form-clientes").value;
      let form_select_list = document.querySelector("option[value='"+ selectObj+"']").dataset.value;
      let form_seller_name = $('#form-clientes').val();
      let form_assunto = $('#form-assunto').val();
      let form_message = $('#form-message').val();
      let t_url = $(this).attr('action');

      $.ajax({
        url: t_url,
        data: {
          Id: form_select_list,
          Assunto: form_assunto,
          Mensagem: form_message
        },
        cache: false,
        type: 'post',
        success: function(res){
          if(res == 1) {
            document.getElementById("form_notify").reset();
            _t.closest('#modal-notificacao').removeClass("show");
            swal({
              title: "Seller notificado!",
              text: "Você notificou o seller "+form_seller_name+" com sucesso!",
              icon: "success"
            })
          } else {
            _t.closest('#modal-notificacao').removeClass("show");
            swal("Ops!", "Não foi possível notificar este seller. Tente novamente mais tarde!", "error")
          }
        },
        error: function(){
          _t.closest('#modal-notificacao').removeClass("show");
          swal("Erro!", "Houve um erro ao tentar executar esta operação.", "error");
        }
      })
    })

    $(document).on('click', '.super-select button', function () {

      $('.super-select').removeClass('active');

      $(this).closest('.super-select').toggleClass('active');

    });


    $(document).on('click', '.super-select-checkbox', function () {

      var _this = $(this);

      if(_this.hasClass("selecionado")){
        _this.removeClass("selecionado");
      }else {
        _this.addClass("selecionado");
      }

      var check = $(this).find('input:checkbox');

      $(this).find('i.fa').toggleClass('fa-check-square fa-square');

      check.prop("checked", !check.prop("checked"));

      var checkedItems = $(this).closest('.super-select').find('input:checked').length;

      $(this).closest('.super-select').find('.selected').text(checkedItems);

      var checkArr = [];

      if (checkedItems > 0) {

        var qSelector = document.querySelectorAll(".super-select-checkbox");

        for(var i = 0; i < qSelector.length; i++){
          var checkValue = qSelector[i].querySelector(".input-identify").dataset.value;

          if(qSelector[i].querySelector(".input-identify").checked){
            checkArr.push(checkValue+", ");

            $(this).closest('.super-select').find('.selected').html(checkArr);
          }
        }

        $(this).closest('.super-select').addClass('has-selected');
      } else {
        $(this).closest('.super-select').removeClass('has-selected');
      }

    });


    $(document).mouseup(function (e) {

      var container = $('.super-select');

      if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.super-select').removeClass('active');
      }

    });

    $(document).on('click', '#select_all', function(){
      let _t = $(this);

      $(this).parent().each(function(){

        let ckbVerify = $(this).find('input:checkbox');

        if(ckbVerify.hasClass("selecionado")){
          ckbVerify.prop("checked", false);

          _t.parent().find('i.fa').removeClass("fa-check-square");
          _t.parent().find('i.fa').addClass("fa-square");

          $(this).closest('.super-select').find('.selected').text("0");

          ckbVerify.removeClass("selecionado");
        }else {
          ckbVerify.prop("checked", true);

          _t.parent().find('i.fa').removeClass("fa-square");
          _t.parent().find('i.fa').addClass("fa-check-square");

          $(this).closest('.super-select').find('.selected').text("Todos");

          ckbVerify.addClass("selecionado");

        }

      })
    })
  })
</script>


<!-- Cookie API -->
<script src="js/js.cookie.min.js"></script>

<script src="js/popper.min.js"></script>
<script src="css/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/venobox.js"></script>
<script src="js/wow.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.mCustomScrollbar.min.js"></script>
<script src="js/jquery.mousewheel.min.js"></script>
<script src="js/main.js"></script>
<script src="js/datatables.min.js"></script>
<script src="js/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="js/evo-calendar.min.js"></script>

<!-- <script src="chat/chat-robot.js"></script> -->

<!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
<script src="https://cdn.amcharts.com/lib/4/geodata/data/countries2.js"></script>
<script src="js/animated.js"></script> -->


