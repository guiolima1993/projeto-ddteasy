<?php $_home = true ?>
<?php include('header.php'); ?>
  <div class="page-container">
    <h1 class="page-title">Dashboard</h1>

    <div class="page-content">

      <?php include('top-box.php'); ?>

      <div class="kpi-flexbox">
        <div class="kpi-box">
          <div class="kpi-top">
            <div class="kpi-value">
              <h6>Receita</h6>
              <?php   

                //a receber 
                $total_receber = 0;
                $total_a_receber = Query('SELECT Valor_total,Valor FROM servico_prestado WHERE Ativo = 0 AND Parceiro = '.$_SESSION['Parceiro'].' AND MONTH(Data) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(Data) = YEAR(CURRENT_DATE())',0);
                $count_total_a_receber = mysqli_num_rows($total_a);    

                if($count_total_a_receber  > 0){
                  

                  while($r_count_a_receber = mysqli_fetch_assoc($total_a_receber)){
                    $total_receber = $total_receber + $r_count_a_receber['Valor'];
                  }

                  //media
                  $ticket_medio_receber = $total_receber/$count_total_a_receber;

                }else{
                  $ticket_medio_receber = 0;
                }



     

                  $total_passado = 0;
                  $total_a_passado = Query('SELECT Valor_total,Valor FROM servico_prestado WHERE Ativo = 1 AND Parceiro = '.$_SESSION['Parceiro'].' AND MONTH(Data) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(Data) = YEAR(CURRENT_DATE())',0);
                  $count_total_a_passado = mysqli_num_rows($total_a_passado);    

                  if($count_total_a_passado  > 0){
                    

                    while($r_count_a_passado = mysqli_fetch_assoc($total_a_passado)){
                      $total_passado = $total_passado + $r_count_a_passado['Valor'];
                    }

                    //media
                    $ticket_medio_passado = $total_passado/$count_total_a_passado;

                  }else{
                    $ticket_medio_passado = 0;
                  }



                  $total = 0;
                  $total_a = Query('SELECT Valor_total,Valor FROM servico_prestado WHERE Ativo = 1 AND Parceiro = '.$_SESSION['Parceiro'].' AND MONTH(Data) = MONTH(CURRENT_DATE()) AND YEAR(Data) = YEAR(CURRENT_DATE())',0);
                  $count_total_a = mysqli_num_rows($total_a);    

                  if($count_total_a  > 0){
                    

                    while($r_count_a = mysqli_fetch_assoc($total_a)){
                      $total = $total + $r_count_a['Valor'];
                    }

                    //media
                    $ticket_medio = $total/$count_total_a;

                  }else{
                    $ticket_medio = 0;
                  }




                  $r_ticket_medio_dia = Query('SELECT avg(Valor) as Media,DAY(Data) as dia from servico_prestado WHERE Parceiro = '.$_SESSION['Parceiro'].'',1);
                  $ticket_medio_dia = round($r_ticket_medio_dia['Media'],2);




                  $total_diff = $total - $total_passado;
                  $porcentagem_mais_mes =  round($total_diff/$total_passado*100,2);


                  $total_diff_2 = $count_total_a - $count_total_a_passado;
                  $porcentagem_mais_mes_2 =  round($total_diff_2/$count_total_a_passado*100,2);



              ?>
              <span>R$ <?php echo $total;    ?></span>
            </div>
            <div class="kpi-img-wrapper">
              <img src="images/icons/receita.png" alt="Kpi_img" class="kpi-img">
            </div>
          </div>
          <div class="kpi-bottom">
            + <?php echo $porcentagem_mais_mes;     ?>% em relação ao último mês.
          </div>
        </div>
        <div class="kpi-box">
          <div class="kpi-top">
            <div class="kpi-value">
              <h6>Qtde. Serviços</h6>
              <span><?php echo $count_total_a;    ?></span>
            </div>
            <div class="kpi-img-wrapper">
              <img src="images/icons/qtd-servicos.png" alt="Kpi_img" class="kpi-img">
            </div>
          </div>
          <div class="kpi-bottom">
            + <?php echo $porcentagem_mais_mes_2;    ?>% em relação ao último mês.
          </div>
        </div>


        <?php     
            $total_a = Query('SELECT Avaliacao,Nota FROM avaliacao WHERE Parceiro = '.$_SESSION['Parceiro'].'',0);
            $count_total_a = mysqli_num_rows($total_a);

            if($count_total_a  > 0){
              $nota = 0;

              while($r_count_a = mysqli_fetch_assoc($total_a)){
                $nota = $nota + $r_count_a['Nota'];
              }

              //media
              $media_empresa = $nota/$count_total_a;

            }else{
              $media_empresa = 0;
            }
      ?>
        <div class="kpi-box">
          <div class="kpi-top">
            <div class="kpi-value">
              <h6>Avaliações</h6>
              <div class="rate-box">
                <div>
                  <?php echo round($media_empresa,2);    ?>
                </div>
                <?php echo $count_total_a;    ?> Avaliações
              </div>
            </div>
            <div class="kpi-img-wrapper">
              <img src="images/icons/avaliacao.png" alt="Kpi_img" class="kpi-img">
            </div>
          </div>
          <div class="kpi-bottom">
            Benchmark:  <?php echo round($media_empresa,2);   ?>   
          </div>
        </div>
      </div>

      <div class="chart-box">
        <h6>Indicadores</h6>

        <div class="row">
          <div class="col-md-8 col-sm-12">
            <canvas id="chartThis"></canvas>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="info-chart">
              <div class="info-box">
                <span>Ticket Médio</span>
                R$ <?php echo $ticket_medio;     ?>
              </div>
              <div class="info-box">
                <span>Média de Serviços por dia</span>
                R$ <?php  echo $ticket_medio_dia;   ?>
              </div>
              <div class="info-box">
                <span>Valor a receber</span>
                R$ <?php  echo $total_receber;   ?>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php    


  $first = 1;

  $total_a = Query('SELECT Avaliacao,Nota FROM avaliacao WHERE Parceiro = '.$_SESSION['Parceiro'].'',0);
  $count_total_a = mysqli_num_rows($total_a);

  if($count_total_a  > 0){
    $nota = 0;

    while($r_count_a = mysqli_fetch_assoc($total_a)){
      $nota = $nota + $r_count_a['Nota'];
    }

    //media
    $media_empresa = $nota/$count_total_a;

  }else{
    $media_empresa = 0;
  }


  $first = 1;
  $colaborador_text = '';
  $media_text = '';

  $colaboradores = array(); 

  $q_colaboradores = Query('SELECT * FROM colaborador WHERE Parceiro = '.$_SESSION['Parceiro'].'',0);
  if(mysqli_num_rows($q_colaboradores) > 0){
    while($r_colaborador =  mysqli_fetch_assoc($q_colaboradores)){
        $colaboradores[] = $r_colaborador;

      $total_a = Query('SELECT Avaliacao,Nota FROM avaliacao WHERE Colaborador = '.$r_colaborador['Colaborador'].'',0);
      $count_total_a = mysqli_num_rows($total_a);

      if($count_total_a  > 0){
        $nota = 0;

        while($r_count_a = mysqli_fetch_assoc($total_a)){
          $nota = $nota + $r_count_a['Nota'];

        }
        //media
        $media_a = $nota/$count_total_a;

      }else{
        $media_a = 0;
      }

      if($first){

        $media_text = $media_a;
        $colaborador_text .= "'".$r_colaborador['Titulo']."'";
        $colaborador_media_text .= "'".$media_text."'";
        $first = 0;
      }else{
        $media_text = $media_a;
        $colaborador_text .= ",'".$r_colaborador['Titulo']."'";
        $colaborador_media_text .= ",'".$media_text."'";
      }

    }
  }
?>
      <div class="flex-colab-service">
        <div class="chartBox">
          <h6 class="text-center">Colaboradores</h6>
          <div class="row">
            <div class="col-md-8 col-sm-12">
              <canvas id="colabChart"></canvas>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="select-wrapper">
                <select name="Select_coolab">
                  <option selected>Avaliação</option>
                  <?php   foreach ($colaboradores as $k => $v_c) {  ?>
                    <option value="<?php echo $v_c['Colaborador'];    ?>"><?php echo $v_c['Titulo'];    ?></option>
                  <?php   }  ?>
                </select>
                <ul class="colab-list">
                   <?php   foreach ($colaboradores as $k => $v_c) {  ?>
                  <li class="colab-item">
                    <?php echo $v_c['Titulo'];    ?>
                  </li>
                 <?php   }  ?>
                </ul>
              </div>
            </div>
          </div>
        </div> 
        <div class="serviceBox">

          <?php    
            $total_servicos = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Parceiro = '.$_SESSION['Parceiro'].'',0));

            $total_servico_1 = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Parceiro = '.$_SESSION['Parceiro'].' AND Servico = 1',0));
            $perc_servico_1 = ($total_servico_1 / $total_servicos) * 100;

            $total_servico_2 = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Parceiro = '.$_SESSION['Parceiro'].' AND Servico = 2',0));
            $perc_servico_2 = ($total_servico_2 / $total_servicos) * 100;

            $total_servico_3 = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Parceiro = '.$_SESSION['Parceiro'].' AND Servico = 3',0));
            $perc_servico_3 = ($total_servico_3 / $total_servicos) * 100;


            $total_servico_4 = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Parceiro = '.$_SESSION['Parceiro'].' AND Servico = 4',0));
            $perc_servico_4 = ($total_servico_4 / $total_servicos) * 100;

        ?>



          <h6>Serviços</h6>
          <div class="progress-line">
            <div class="progress">
              <div class="progress-bar bg-ddt" role="progressbar" style="width: <?php  echo $perc_servico_2; ?>%;" aria-valuenow="<?php  echo $perc_servico_2; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text-box">
              <span>Dedetização  <?php  echo round($perc_servico_2,2); ?>%</span>
              <span>Sanitização  <?php  echo round($perc_servico_1,2); ?>%</span>
            </div>
          </div>
          <div class="progress-line">
            <div class="progress">
              <div class="progress-bar bg-prm" role="progressbar" style="width: <?php  echo $perc_servico_3; ?>%;" aria-valuenow="<?php  echo $perc_servico_3; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text-box">
              <span>Dedetização Premium<?php  echo round($perc_servico_3,2); ?>%</span>
              <span>Sanitização Premium<?php  echo round($perc_servico_4,2); ?>%</span>
            </div>
          </div>
          <hr class="mt-4">
          <h6>TOP Pragas</h6>
          <ul class="list-pragas">
                <?php    
     
                    $q_praga = Query('SELECT DISTINCT(Praga),COUNT(Praga) as Contador FROM praga_cotacao WHERE Servico_prestado IN (SELECT Servico_prestado FROM servico_prestado WHERE Parceiro =  '.$_SESSION['Parceiro'].' WHERE Ativo = 1) GROUP BY Praga ORDER BY Contador DESC',0);

                    if(mysqli_num_rows($q_praga) > 0){
                      while($r_praga = mysqli_fetch_assoc($q_praga)){

                        $r_praga = Query('SELECT Titulo FROM praga WHERE Praga = '.$r_praga['Praga'].'',1);
                ?>
                  <li class="rank-item">
                    <?php echo $r_praga['Titulo'];   ?>
                  </li>
                <?php 

                   }   }   ?>
          </ul>
        </div>
      </div>

      <div class="table-wrapper">
        <h2 class="text-center">Próximos Agendamentos</h2>
        <table class="table-dashboard-page">
          <thead>
            <tr>
              <th rowspan="3">Nome</th>
              <th rowspan="3">Data do pedido</th>
              <th rowspan="3">Valor total</th>
              <th rowspan="3">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php      
            $q = Query('SELECT * FROM servico_prestado WHERE Parceiro = '.$_SESSION['Parceiro'].' ORDER BY Servico_prestado DESC',0);
            if(mysqli_num_rows($q) > 0){
              while($r = mysqli_fetch_assoc($q)){
          ?>
            <tr>
              <td><?php  echo $r['Servico_prestado'];   ?></td>
              <td><?php  echo formata_data($r['Data']);   ?></td>
              <td>R$ <?php  echo $r['Valor'];   ?></td>
              <td><img  
                <?php if($r['Status_cotacao']==1){    ?>
                  src="images/icons/yellow.png"
                <?php }else if($r['Status_cotacao']==2){    ?>
                  src="images/icons/green.png"
                <?php }else if($r['Status_cotacao']==3){    ?>
                  src="images/icons/yellow.png" 
                <?php }else if($r['Status_cotacao']==4){    ?>
                  src="images/icons/red.png" 
                <?php }    ?>
                  alt="Status"></td>
            </tr>
          <?php   }   }   ?>
          </tbody>
        </table>
        <div class="btn-wrapper">
          <button class="btn btn-customer" onclick="document.location.href='agenda.php'">Veja Mais</button>
        </div>
      </div>

    </div>

  </div>
</section>
<?php include('footer.php'); ?>
<script>
  $(function() {
    
    var ctx = document.getElementById("chartThis");
    var colabCtx = document.getElementById("colabChart");
    <?php    

        $meses_qtd = array();
        $meses_total = array();

        $mes = 1;   
        while($mes <= 12){
          $r_servicos_m = Query('SELECT COUNT(*) as Total,SUM(Valor_total) as Valor FROM servico_prestado WHERE Parceiro  = '.$_SESSION['Parceiro'].' AND MONTH(Data) = '.$mes.' AND YEAR(Data) = YEAR(CURRENT_DATE())',1);

          $meses_qtd[] = $r_servicos_m['Total'];
          $meses_total[] = $r_servicos_m['Valor'];


          $mes++;
        }

    ?>


    var myChart = new Chart(ctx, {
      data: {
        datasets: [{
          type: 'bar',
          label: 'Faturamento',
          data: [<?php    foreach ($meses_total as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"';  }   } ?>],
          datalabels: {
            color: 'purple',
            anchor: 'start',
            align: 'end'
          },
          borderColor: 'rgb(255, 224, 230)',
          backgroundColor: 'rgba(255, 224, 230, 1)',
          order: 2
        }, {
          type: 'line',
          label: 'Qtde Serviços',
          data: [<?php    foreach ($meses_qtd as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"';  }   } ?>],
          datalabels: {
            color: 'purple',
            anchor: 'end',
            align: 'end',
            offset: 5
          },
          borderColor: '#5988C3',
          order: 1
        }],
        labels: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
      },
      plugins: [ChartDataLabels],
      options: {
        scales: {
          y: {
            color: '#582583',
            beginAtZero: true,
            font: {
              weight: 'bold'
            },
          },
        },        
      }
    });

    var colabChart = new Chart(colabCtx, {
      type: "pie",
      data: {
        labels: [<?php echo $colaborador_text;   ?>],
        datasets: [{
          backgroundColor: [
            "#BCC7DC",
            "#FAE5D5",
            "#FAD4D2",
            "#8F8A8E",
            "#CAC2D1"
          ],
          data: [<?php echo $colaborador_media_text;   ?>]
        }]
      },
      plugins: [ChartDataLabels],
      options: {
        plugins: {
          legend: {
            position: 'left',

            labels: {
              color: '#582583',
              font: {
                weight: 'bold'
              },

            },
          },
          datalabels: {
            color: 'purple',
          }
        }
      },
    });
  })
</script> 
</body>

</html>
<!-- <style>
  #chartdiv {
    width: 100%;
    height: 500px
  }
</style> -->

<!-- <script>
  am4core.ready(function () {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    $(function () {

      /**
       * This demo uses our own method of determining user's location
       * It is not public web service that you can use
       * You'll need to find your own. We recommend http://www.maxmind.com
       */

      var geo = { "country_code": "BR", "country_name": "Brazil" };

      // Default map
      var defaultMap = "usaAlbersLow";

      // calculate which map to be used
      var currentMap = defaultMap;
      var title = "";
      if (am4geodata_data_countries2[geo.country_code] !== undefined) {
        currentMap = am4geodata_data_countries2[geo.country_code]["maps"][0];

        // add country title
        if (am4geodata_data_countries2[geo.country_code]["country"]) {
          title = am4geodata_data_countries2[geo.country_code]["country"];
          title = "Brasil S2";
        }

      }

      // Create map instance
      var chart = am4core.create("chartdiv", am4maps.MapChart);

      chart.titles.create().text = title;

      // Set map definition
      chart.geodataSource.url = "https://www.amcharts.com/lib/4/geodata/json/" + currentMap + ".json";
      chart.geodataSource.events.on("parseended", function (ev) {
        var data = [];
        for (var i = 0; i < ev.target.data.features.length; i++) {
          data.push({
            id: ev.target.data.features[i].id,
            value: 100
          })
        }
        polygonSeries.data = data;
      })

      // Set projection
      chart.projection = new am4maps.projections.Mercator();

      // Create map polygon series
      var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

      //Set min/max fill color for each area
      polygonSeries.heatRules.push({
        property: "fill",
        target: polygonSeries.mapPolygons.template,
        min: chart.colors.getIndex(1).brighten(1),
        max: chart.colors.getIndex(1).brighten(-0.3)
      });

      // Make map load polygon data (state shapes and names) from GeoJSON
      polygonSeries.useGeodata = true;

      // Set up heat legend
      let heatLegend = chart.createChild(am4maps.HeatLegend);
      heatLegend.series = polygonSeries;
      heatLegend.align = "right";
      heatLegend.width = am4core.percent(25);
      heatLegend.marginRight = am4core.percent(4);
      heatLegend.minValue = 0;
      heatLegend.maxValue = 40000000;
      heatLegend.valign = "bottom";

      // Set up custom heat map legend labels using axis ranges
      var minRange = heatLegend.valueAxis.axisRanges.create();
      minRange.value = heatLegend.minValue;
      minRange.label.text = "100";
      var maxRange = heatLegend.valueAxis.axisRanges.create();
      maxRange.value = heatLegend.maxValue;
      maxRange.label.text = "100000";

      // Blank out internal heat legend value axis labels
      heatLegend.valueAxis.renderer.labels.template.adapter.add("text", function (labelText) {
        return "";
      });

      // Configure series tooltip
      var polygonTemplate = polygonSeries.mapPolygons.template;
      polygonTemplate.tooltipText = "{name}: {value}";
      polygonTemplate.nonScalingStroke = true;
      polygonTemplate.strokeWidth = 0.5;

      // Create hover state and set alternative fill color
      var hs = polygonTemplate.states.create("hover");
      hs.properties.fill = chart.colors.getIndex(1).brighten(-0.5);



    });

  }); // end am4core.ready()
</script> -->