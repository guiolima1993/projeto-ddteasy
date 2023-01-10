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

<section class="cookies-background">
  <div class="cookies">
    <h4>Este site usa cookies.</h4>
    <p>
      Usamos cookies para analisar o tráfego do site e otimizar sua experiência nele. Ao aceitar nosso uso de cookies, seus dados serão agregados com os dados de todos os demais usuários. 
    </p>
    <button type="button" class="btn btn-secondary dismiss-cookies">Aceitar</button>
  </div>
</section>


<?php     
  if(isset($cache_avisos)){
    foreach ($cache_avisos as $k_n => $aviso) {
?>
<div class="modal fade" id="avisoModal<?php echo $aviso['Notificacao'];    ?>" tabindex="-1" aria-labelledby="avisoModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="avisoModalTitle">Aviso:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>   
      <div class="modal-body">
        <span><?php echo $aviso['Texto'];    ?></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Entendi!</button>
      </div>
    </div>
  </div>
</div>
<?php   }  }  ?>

<div class="loader">
  <div class="lds-ellipsis">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>





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
<!-- <script src="js/evo-calendar.min.js"></script> -->
<script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
<script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>
<script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>
<script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>

<!-- <script src="chat/chat-robot.js"></script> -->

<!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
<script src="https://cdn.amcharts.com/lib/4/geodata/data/countries2.js"></script>
<script src="js/animated.js"></script> -->


