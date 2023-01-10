<?php $_password = true ?>
<?php include('header.php'); 


  $r = "";

  if(isset($_SESSION['Cliente']) && $_SESSION['Cliente']!=''){
    $cli_id =  $_SESSION['Cliente'];


    $q = Query('SELECT Cliente,Titulo,Email,Telefone FROM cliente WHERE Cliente = '.$cli_id.'');
      if(mysqli_num_rows($q) > 0){
        $r = mysqli_fetch_assoc($q);
        $_SESSION['Cliente'] = $r['Cliente'];
      }else{
       echo '<script>document.location = "'.$Config['UrlSite'].'login";</script>';
    exit;
      }




  }else{

      $Email = "";

      if(isset($_POST['Email']) && $_POST['Email']!=''){
        $Email = clean($_POST['Email']);
      }else{
        echo '<script>document.location = "'.$Config['UrlSite'].'login";</script>';
    exit;
      }

      $Senha = "";

      if(isset($_POST['Senha']) && $_POST['Senha']!=''){
        $Senha = clean($_POST['Senha']);
      }else{
        echo '<script>document.location = "'.$Config['UrlSite'].'login";</script>';
    exit;
      }

      $q = Query('SELECT Cliente,Titulo,Email FROM cliente WHERE Email = "'.$Email.'" AND Senha = "'.md5($Senha).'"');
      if(mysqli_num_rows($q) > 0){
        $r = mysqli_fetch_assoc($q);
        $_SESSION['Cliente'] = $r['Cliente'];
      }else{
       echo '<script>document.location = "'.$Config['UrlSite'].'login";</script>';
    exit;
      }


      

      setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "portuguese");
    }
    $q_seller  = Query('SELECT * FROM parceiro WHERE Parceiro =  '.$_SESSION['Parceiro_orcamento'].'',0);
    $r_seller  = mysqli_fetch_assoc($q_seller);
?>

<div class="background-checkout">
  <div class="background-image-left">
    <img src="images/ddteasy-images/canto-1.png" alt="side-image">
  </div>

  <div class="content-checkout">
    <div class="container">
      <div class="card-checkout">
        <div class="header-title-checkout">
          <h3>AGENDE SEU SERVIÇO</h3>
        </div>
        <form action="requisicoes/realiza-agendamento.php" id="form-agendamento" class="form-submit" novalidate autocomplete="off">
          <input type="hidden" id="customer_id" name="Cliente" value="<?php echo $r['Cliente']; ?>">
          <?php 
            if($_SESSION['servico_id']==2){
              $valor =  $r_seller['Dedetizacao_valor']; 
            }else if($_SESSION['servico_id']==1){  
              $valor = $r_seller['Sanitizacao_valor']; 
            } else {
              echo "<script> window.location.href='". $Config["UrlSite"] ."' </script>";
            }
          ?>
          <input type="hidden" id="amount" name="Valor" value="<?php echo $valor; ?>">
          <input type="hidden" id="service_id" name="Parceiro" value="<?php echo $_SESSION['Parceiro_orcamento']; ?>">

          <div class="form-checkout">
            <div class="calendar-checkout">
              <div class="calendar-box">
                <div class="calendar-prestador clndr">
                  <div class="clndr-controls">
                    <div class="clndr-previous-button">&lsaquo;</div>
                    <div class="month">
                        <%= month %>
                    </div>
                    <div class="clndr-next-button">&rsaquo;</div>
                  </div>
                  <div class="clndr-grid">
                    <div class="days-of-the-week">
                      <% _.each(daysOfTheWeek, function (day) { %>
                        <div class="header-day">
                          <%= day %>
                        </div>
                        <% }) %>
                          <div class="days">
                            <% _.each(days, function (day) { %>
                              <div class="<%= day.classes %>">
                                <%= day.day %>
                              </div>
                              <% }) %>
                          </div>
                    </div>
                  </div>
                </div>
                <ul class="legendas">
                  <li class="vagos">Dias Vagos</li>
                  <li class="ocupados">Dias Ocupados</li>
                </ul>
              </div>
            </div>
            <div class="input-time mb-3">
              <div class="area-forms-time">
                <label>Periodo</label>
                <div class="input-default">
                  <select name="Periodo" required>
                    <option value="" selected disabled>Selecione</option>
                    <option value="Manha">Manhã</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Noite">Noite</option>
                  </select>
                </div>
              </div>
              <div class="area-forms-time-especifico col-md-6 disabled-time">
                <div class="d-flex flex-wrap">
                  <div class="input-default">
                    <select name="Horario" id="time-agenda" value="">
                      <option selected disabled>Horário</option>
                      <option value="7:00">7:00</option>
                      <option value="7:30">7:30</option>
                      <option value="8:00">8:00</option>
                      <option value="8:30">8:30</option>
                      <option value="9:00">9:00</option>
                      <option value="9:30">9:30</option>
                      <option value="10:00">10:00</option>
                      <option value="10:30">10:30</option>
                      <option value="11:00">11:00</option>
                      <option value="11:30">11:30</option>
                      <option value="12:00">12:00</option>
                      <option value="12:30">12:30</option>
                      <option value="13:00">13:00</option>
                      <option value="13:30">13:30</option>
                      <option value="14:00">14:00</option>
                      <option value="14:30">14:30</option>
                      <option value="15:30">15:30</option>
                      <option value="16:00">16:00</option>
                      <option value="16:30">16:30</option>
                      <option value="17:00">17:00</option>
                      <option value="17:30">17:30</option>
                      <option value="18:00">18:00</option>
                      <option value="18:30">18:30</option>
                      <option value="19:00">19:00</option>
                      <option value="19:30">19:30</option>
                      <option value="20:00">20:00</option>
                      <option value="20:30">20:30</option>
                      <option value="21:00">21:00</option>
                      <option value="21:30">21:30</option>
                      <option value="22:00">22:00</option>
                      <option value="22:30">22:30</option>
                      <option value="23:00">23:00</option>
                      <option value="23:30">23:30</option>
                    </select>
                  </div>
                  <div>
                    <span>*Se escolhido um horário especifico, o serviço terá um acréscimo de X%</span>
                  </div>
                </div>
              </div>
              <div class="checkbox-area m-2">
                <label>Horário específico</label>
                <input id="checkbox-time" name="Horario_especifico" type="checkbox" value="">
              </div>
            </div>
            <!-- <div class="area-forms mb-3">
              <label>Empresa escolhida</label>
              <div class="input-default input-size">
                <?php if(isset($_SESSION['Parceiro_orcamento']) && $_SESSION['Parceiro_orcamento']!=""){     

                      $q_p = Query('SELECT * FROM parceiro WHERE Ativo = 1 AND Parceiro = '.$_SESSION['Parceiro_orcamento'].' ORDER BY Parceiro DESC  LIMIT 1',0);

                      if(mysqli_num_rows($q_p) > 0){
                        $r_p = mysqli_fetch_assoc($q_p);
                      }

                ?>
                <input type="text" name="Seller" value="<?php  echo $r_p['Titulo'];   ?>" disabled>
                <?php  
                    //aqui recomendo um botao na verdade pro cliente voltar a tela que inicia a cotacao e escolhe o seller 
                    }else{   
                ?>
                <input type="text" name="Seller" value="" disabled>
                <?php  }        ?>
              </div>
            </div> -->
            <div class="area-forms mb-3">
              <label>Data selecionada</label>
              <div class="input-default input-size">
                <input type="text" name="Data_escolhida" value="" readonly>
              </div>
            </div>
            <div class="area-forms mb-3">
              <label>Nome do responsável</label>
              <div class="input-default input-size">
                <input type="text" value="<?php echo $r['Titulo'];    ?>" name="Nome_responsavel" autocomplete="off"
                  placeholder="Nome do responsável" required>
              </div>
              <span>*Quem vai receber e acompanhar o especialista?</span>
            </div>
            <div class="area-forms mb-3">
              <label>Telefone do responsável</label>
              <div class="input-default input-size">
                <input class="cel-field" type="text" value="<?php echo $r['Telefone'];    ?>" name="Telefone_contato"
                  autocomplete="off" placeholder="Telefone do responsável" required>
              </div>
            </div>
            <div class="area-forms mb-3">
              <label>Endereço</label>
              <div class="button-select-address">
                <button type="button" class="btn" data-toggle="modal" data-target="#modaladdress">Selecione o
                  endereço</button>
              </div>
            </div>

            <!-- <div class="area-forms mb-3">
              <label>Número do Cartão de Crédito</label>
              <div class="input-default input-size">
                <input type="text" id="card_number" autocomplete="off" placeholder="Número do Cartão de Credito" required>
              </div>
            </div>

            <div class="area-forms mb-3">
              <label>Nome do dono do Cartão</label>
              <div class="input-default input-size">
                <input type="text" id="card_holder_name" autocomplete="off" placeholder="Nome do dono do Cartão" required>
              </div>
            </div>

            <div class="area-forms mb-3">
              <label>Validade do Cartão</label>
              <div class="input-default input-size">
                <input type="text" id="card_expiration_date" autocomplete="off" placeholder="Validade do Cartão" required>
              </div>
            </div>

            <div class="area-forms mb-3">
              <label>CVV do Cartão</label>
              <div class="input-default input-size">
                <input type="text" id="card_cvv" autocomplete="off" placeholder="CVV do Cartão" required>
              </div>
            </div> -->

            <div class="area-forms">
              <label>Observação</label>
              <div class="input-default input-size mb-3">
                <textarea rows="5" name="Mensagem"
                  placeholder="Utilize este campo para deixar recomendações para o prestador do serviço"></textarea>
              </div>
            </div>

            <div class="area-forms mb-3">
              <label>Pagamento*</label>
              <div class="button-select-address">
                <button type="button" class="btn" data-toggle="modal" data-target="#modalpay">Inserir pagamento</button>
              </div>
            </div>

            <div class="term-use mb-3">
              <input class="col-1" id="termos-empresa" type="checkbox" value=""
                onchange="document.getElementById('confirm-checkout').disabled = !this.checked;">
              <div class="info">
                <span>Concordo com os <a>termos de uso</a></span>
              </div>
            </div>
            <div class="button-checkout mb-3">
              <button id="confirm-checkout" disabled class="btn">Confirmar</button>
            </div>
          </div>
          <?php 
            if (!isset($_POST['Endereco_cliente'])) {
              $q_enderecoSel = Query('SELECT * FROM endereco_cliente WHERE Ativo = 1 AND Cliente = '.$_SESSION['Cliente'],0);
            } else {
              $q_enderecoSel = Query('SELECT * FROM endereco_cliente WHERE Endereco_cliente = '.$_POST['Endereco_cliente'].' AND Cliente = '.$_SESSION['Cliente'].'');
            }
            if(mysqli_num_rows($q_enderecoSel) > 0) {
                $r_endereco = mysqli_fetch_assoc($q_endereco);
          ?> 
            <input type="hidden" name="Cep" value="<?= $r_endereco['Cep']; ?>">
            <input type="hidden" name="Endereco" value="<?= $r_endereco['Endereco']; ?>">
            <input type="hidden" name="Bairro" value="<?= $r_endereco['Bairro']; ?>">
            <input type="hidden" name="Cidade" value="<?= $r_endereco['Cidade']; ?>">
            <input type="hidden" name="Estado" value="<?= $r_endereco['Estado']; ?>">
            <input type="hidden" name="Numero" value="<?= $r_endereco['Numero']; ?>">
            <input type="hidden" name="Complemento" value="<?= $r_endereco['Complemento']; ?>">
          <?php } ?>
        </form>
      </div>
    </div>
  </div>

  <div class="background-image-right">
    <img src="images/ddteasy-images/meio.png" alt="side-image-right">
  </div>
</div>

<?php include('footer.php'); ?>

<!-- Modal -->
<div class="modal fade modal-address" id="modaladdress" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Selecione o endereço</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="address-registers">
          <?php
            /* $i = 0; */   
            $q_endereco = Query('SELECT * FROM endereco_cliente WHERE Cliente = '.$_SESSION['Cliente'].'',0);
            if(mysqli_num_rows($q_endereco) > 0){
              while($r_endereco = mysqli_fetch_assoc($q_endereco)){
          ?>
          <div class="card-content-address">
            <div class="card-input">
              <input class="checkbox-radio_rg" type="radio" name="Endereco_cliente"
                value="<?php echo $r_endereco['Endereco_cliente'];   ?>" >
            </div>
            <div class="card-address col-md-10">
              <div class="title-address">
                <h3>
                  <?php echo $r_endereco['Endereco'];  ?>,
                  <?php echo $r_endereco['Numero'];  ?>
                </h3>
              </div>
              <div class="info-address">
                <label>CEP:</label>
                <p>
                  <?php echo $r_endereco['Cep'];  ?>
                </p>
                <p class="pl-1">
                  <?php echo $r_endereco['Cidade'];  ?>,
                  <?php echo $r_endereco['Estado'];  ?> 
                </p>
                <p class="pl-1">
                  <?php echo $r_endereco['Titulo'];  ?>
                </p>
              </div>
            </div>
          </div>
          <?php /* $i = 1;*/ } } ?>

          <div class="card-content-address" style="display: none;">
            <div class="card-input">
              <input class="checkbox-radio_rg" type="radio" name="Endereco_cliente"
                value="">
            </div>
          </div>

          <input type="hidden" name="Endereco_cliente" value="">
          
          <div class="link-add-address">
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
              aria-controls="collapseExample">Adicionar endereço</a>
          </div>

        </div>

        <div class="collapse" id="collapseExample">
          <div class="other-address">
            <div class="cep">
              <div class="area-forms d-flex flex-column">
                <label>CEP</label>
                <div class="input-default input-number input-size mb-3">
                  <input id="endereco-campo" name="Cep" class="campo-cep cep-field" type="text"
                    placeholder="CEP" value="">
                </div>
                <label id="endereco" class="d-none fill-endereco"></label>
              </div>
              <div class="area-forms d-flex flex-column">
                <label>Endereço</label>
                <div class="input-default input-size mb-3">
                  <input class="endereco-input" name="Endereco" type="text" placeholder="Endereço">
                </div>
              </div>
              <div class="area-forms d-flex flex-column">
                <label>Bairro</label>
                <div class="input-default input-size mb-3">
                  <input class="endereco-input-bairro" name="Bairro" type="text" placeholder="Endereço">
                </div>
              </div>
              <div class="area-forms d-flex flex-column">
                <label>Cidade</label>
                <div class="input-default input-size mb-3">
                  <input class="endereco-input-cidade" name="Cidade" type="text" placeholder="Endereço">
                </div>
              </div>
              <div class="area-forms d-flex flex-column">
                <label>Estado</label>
                <div class="input-default input-size mb-3">
                  <input class="endereco-input-estado" name="Estado" type="text" placeholder="Endereço">
                </div>
              </div>

            </div>
            <div class="area-forms-address mb-3">
              <div class="area-forms d-flex flex-column col-md-5 mb-2">
                <label>Número</label>
                <div class="input-default m-0">
                  <input class="w-100" type="text" name="Numero" placeholder="Nº">
                </div>
              </div>
              <div class="area-forms d-flex flex-column col-md-7 mb-2">
                <label>Complemento</label>
                <div class="input-default m-0">
                  <input class="w-100" type="text" name="Complemento" placeholder="Complemento">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-button-footer">
          <button type="button" class="btn" data-dismiss="modal">Confirmar
            Endereço</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal - PAGAMENTO -->
<div class="modal fade modal-pay" id="modalpay" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Insira os dados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="area-forms mb-3">
          <label class="label-pay">Número do Cartão de Crédito</label>
          <div class="input-default input-size">
            <input class="input-pay" type="text" id="card_number" autocomplete="off" placeholder="Número do Cartão de Credito" required>
          </div>
        </div>

        <div class="area-forms mb-3">
          <label class="label-pay">Nome do dono do Cartão</label>
          <div class="input-default input-size">
            <input class="input-pay" type="text" id="card_holder_name" autocomplete="off" placeholder="Nome do dono do Cartão" required>
          </div>
        </div>

        <div class="area-forms mb-3">
          <label class="label-pay">Validade do Cartão</label>
          <div class="input-default input-size">
            <input class="input-pay" type="text" id="card_expiration_date" autocomplete="off" placeholder="Validade do Cartão" required>
          </div>
        </div>

        <div class="area-forms mb-3">
          <label class="label-pay">CVV do Cartão</label>
          <div class="input-default input-size">
            <input class="input-pay" type="text" id="card_cvv" autocomplete="off" placeholder="CVV do Cartão" required>
          </div>
        </div>

        <div class="modal-button-footer">
          <div class="button-select-address">
            <button type="button" class="btn" data-dismiss="modal">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>

</html>

<script>
  $('#card_number').mask('0000 0000 0000 0000');
  $('#card_cvv').mask('000');
  $('#card_expiration_date').mask('00/00');

  // $('#confirm-checkout').click((event) => {
  //   $("#confirm-checkout").attr("disabled", true);
  //   let cardNumber = $('#card_number').val();
  //   let cardCvv = $('#card_cvv').val();
  //   let cardExpiration = $('#card_expiration_date').val();
  //   let cardName = $('#card_holder_name').val();
  //   let amount = $('#amount').val();
  //   let customerId = $('#customer_id').val();
  //   let serviceId = $('#service_id').val();

  //   $.ajax({
  //     url: 'pagarme.php',
  //     type: 'POST',
  //     dataType: "json",
  //     data: {
  //       amount: amount,
  //       customer_id: customerId,
  //       service_id: serviceId,
  //       card_number: cardNumber,
  //       card_cvv: cardCvv,
  //       card_expiration_date: cardExpiration,
  //       card_holder_name: cardName
  //     },
  //     success: function (data) {
  //       try {
  //         let json = $.parseJSON(data);
  //         if (json.status == 'error') {
  //           swal({
  //             title: json.message,
  //             text: json.pagarme_response ? json.pagarme_response : json,
  //             icon: "error",
  //             confirmButtonText: "Ok!"
  //           })
  //         } else {
  //           swal({
  //             title: "Sucesso!",
  //             text: "Serviço pago com sucesso!",
  //             icon: "success",
  //             confirmButtonText: "Ok!"
  //           })
  //           $('#form-agendamento').submit();
  //         }
  //       } catch (error) {
  //         console.log(error);
  //         swal({
  //           title: "Erro ao realizar o pagamento",
  //           text: data.pagarme_response ? data.pagarme_response : data,
  //           icon: "error",
  //           confirmButtonText: "Ok!"
  //         })
  //       }
  //     },
  //     error: function (data) {
  //       let json = $.parseJSON(data);
  //       swal({
  //         title: json.message,
  //         text: data.pagarme_response,
  //         icon: "error",
  //         confirmButtonText: "Ok!"
  //       })
  //     }
  //   });
  //   $("#confirm-checkout").attr("disabled", false);
  // });

  $('.campo-cep').on('focusout', function () {
    var _this = $(this);
    var _localBairro;
    var _localLogradouro;
    var _localLocalidade;
    var _localUf;

    $.ajax({
      url: 'https://viacep.com.br/ws/' + $(this).val() + '/json/',
      dataType: 'json',
      success: function (data) {
        $(_this).parents('.cep').find('.fill-endereco').html(data.logradouro + ', ' + data.bairro + ', '
          + data.localidade + '/' + data.uf);

        _localBairro = data.bairro;
        _localLogradouro = data.logradouro;
        _localLocalidade = data.localidade;
        _localUf = data.uf;

        if (!$("#endereco-campo").val()) {
          $("#endereco").html("");
        } else {
          $('.endereco-input').val(_localLogradouro);
          $('.endereco-input-bairro').val(_localBairro);
          $('.endereco-input-cidade').val(_localLocalidade);
          $('.endereco-input-estado').val(_localUf);
        }

      }
    });


  });


  $(function () {

    moment.locale('pt-br');

    var diasOcupados = [];
    var _id_seller = null;
    var _valor = null;

    $.ajax({
      url: "<?php echo $Config['UrlSite'];   ?>requisicoes/get-dias-ocupado-seller.php",
      type: "GET",
      data: {
        id: 1,
      },
      dataType: "json",
      contentType: false,
      success: function (data) {
        if (data.Data_ocupado.length > 0) {
          for (const item of data.Data_ocupado) {
            diasOcupados.push({
              title: 'Ocupado',
              date: item
            });
          }

          $('.calendar-prestador').clndr({
            moment: moment,
            daysOfTheWeek: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            events: diasOcupados,
            clickEvents: {
              click: function (target) {
                if ($(target.element).hasClass('event')) {
                  // $('.calendar-prestador .event').removeClass("selected");
                  // $(target.element).addClass("selected");
                  // $('input[name=\"Data_escolhida\"]').val(target.date._i);
                  return false;
                } else {
                  $('.calendar-prestador .selected').removeClass("selected");
                  $(target.element).addClass("selected");
                  $('input[name=\"Data_escolhida\"]').val(target.date._i);
                }
              }
            }
          });
        }

      }

    });

    // var diasVagos = [
    //   {
    //     title: "Vago",
    //     date: "2022-02-01"
    //   },
    //   {
    //     title: "Vago",
    //     date: "2022-02-05"
    //   },
    //   {
    //     title: "Vago",
    //     date: "2022-02-07"
    //   },
    //   {
    //     title: "Vago",
    //     date: "2022-02-15"
    //   },
    //   {
    //     title: "Vago",
    //     date: "2022-02-17"
    //   },
    //   {
    //     title: "Vago",
    //     date: "2022-02-22"
    //   }

    // ];

    let collapseIdentify = $('#collapseExample');

    $("#checkbox-time").click(function(){
      if ($(this).is(":checked")){
        $(this).closest(".input-time").find("select[name$='Periodo']").removeAttr("required");
        $(this).closest(".input-time").find("select[name$='Periodo']").attr("aria-required", "false");
      }else {
        $(this).closest(".input-time").find("select[name$='Periodo']").attr("required", "true");
        $(this).closest(".input-time").find("select[name$='Periodo']").attr("aria-required", "true");
      }
    })

    $(document).on('click', '.modal-body .address-registers .card-content-address .card-input input', function(){
      let ckBox = $(this);

      if(collapseIdentify.hasClass("show") && collapseIdentify.hasClass("t_check")){
        collapseIdentify.removeClass("show");
        collapseIdentify.removeClass("t_check");

        $("#collapseExample .other-address .cep .area-forms .input-default input").each(function(i){
          $(this).removeAttr('form', 'form-agendamento');
        })

        $("#collapseExample .other-address .area-forms-address .area-forms .input-default input").each(function(i){
          $(this).removeAttr('form', 'form-agendamento');
        })
      }

      $(this).closest(".address-registers").find("input:hidden").val("");
      $(this).closest(".address-registers").find("input:hidden").removeAttr('form');

      if(ckBox.is(":checked")) {
        let get_value = ckBox.val();

        ckBox.closest(".address-registers").find("input:hidden").val(get_value);
        ckBox.closest(".address-registers").find("input:hidden").attr('form', 'form-agendamento');

      }



    })

    $(document).on('click', '.link-add-address a',function(){
      $(this).closest(".address-registers").find(".card-content-address .card-input input").each(function(i){
        $(this).prop("checked", "false");
      })

      $(this).closest(".address-registers").find("input:hidden").val("");
      $(this).closest(".address-registers").find("input:hidden").removeAttr('form');

      if (!collapseIdentify.hasClass("t_check")) {
        collapseIdentify.addClass("t_check");

        $("#collapseExample .other-address .cep .area-forms .input-default input").each(function(i){
          $(this).attr('form', 'form-agendamento');
        })

        $("#collapseExample .other-address .area-forms-address .area-forms .input-default input").each(function(i){
          $(this).attr('form', 'form-agendamento');
        })
      } else {

        collapseIdentify.removeClass("t_check");
        $("#collapseExample .other-address .cep .area-forms .input-default input").each(function(i){
          $(this).removeAttr('form', 'form-agendamento');
        })

        $("#collapseExample .other-address .area-forms-address .area-forms .input-default input").each(function(i){
          $(this).removeAttr('form', 'form-agendamento');
        })
      }

    })

    $(document).on('submit', '#form-contatar', function (e) {
      e.preventDefault();
      if (!$('input[name=\"Data_escolhida\"]').val()) {
        swal({
          title: "Atenção",
          icon: "warning",
          text: "Você precisa escolher a data desejada."
        });
      } else {
        $('#modal-login').modal('show');
      }
    });



  });
</script>

<script>

  var checkbox = $('#checkbox-time');

  $('#checkbox-time').click(() => {

    if (checkbox.is(':checked')) {
      $('.area-forms-time').addClass('disabled-time');
      $('.area-forms-time-especifico').removeClass('disabled-time');
      $('.area-forms-time-especifico').addClass('actived-time');
    } else {
      $('.area-forms-time').removeClass('disabled-time');
      $('.area-forms-time-especifico').addClass('disabled-time');
      $('.area-forms-time-especifico').removeClass('actived-time');
    }

  });

  $('.checkbox-radio_rg').click(() => {
    $('.other-address').addClass('disabled-option');
    $('.address-register').removeClass('disabled-option');
  });


  $('.checkbox-radio_ot').click(() => {
    $('.address-register').addClass('disabled-option');
    $('.other-address').removeClass('disabled-option');
  });

</script>