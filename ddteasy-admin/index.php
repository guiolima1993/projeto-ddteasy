<?php $_home = true ?>
<?php include('header.php'); ?>
  <div class="page-container">
    <h1 class="page-title">Dashboard</h1>

    <div class="page-content">

      <?php include('top-box.php');  


      $qtd_seller =  mysqli_num_rows(Query('SELECT * FROM parceiro WHERE MONTH(Data_cadastro) = MONTH(CURRENT_DATE) AND YEAR(Data_cadastro) = YEAR(CURRENT_DATE())',0));
      $qtd_seller_passado =  mysqli_num_rows(Query('SELECT * FROM parceiro WHERE MONTH(Data_cadastro) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(Data_cadastro) = YEAR(CURRENT_DATE())',0));


      $total_diff_seller = $qtd_seller - $qtd_seller_passado;
      $porcentagem_mais_mes_seller =  round($total_diff_seller/$qtd_seller_passado*100,2);



      $qtd_client =  mysqli_num_rows(Query('SELECT * FROM cliente WHERE Ativo = 1 AND MONTH(Data_cadastro) = MONTH(CURRENT_DATE) AND YEAR(Data_cadastro) = YEAR(CURRENT_DATE())',0));
      $qtd_client_passado =  mysqli_num_rows(Query('SELECT * FROM cliente WHERE Ativo = 1 AND MONTH(Data_cadastro) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(Data_cadastro) = YEAR(CURRENT_DATE())',0));

      $total_diff_client = $qtd_client - $qtd_client_passado;
      $porcentagem_mais_mes_client =  round($total_diff_client/$qtd_client_passado*100,2);

    
      

      ?>

      <div class="kpi-flexbox">
        <div class="kpi-box border-div">
          <div class="kpi-top">
            <div class="kpi-value">
              <h6>Receita</h6>

                            <?php   

                //a receber 
                $total_receber = 0;
                $total_a_receber = Query('SELECT Valor_total,Valor FROM servico_prestado WHERE Ativo = 0  AND MONTH(Data) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(Data) = YEAR(CURRENT_DATE())',0);
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
                  $total_a_passado = Query('SELECT Valor_total,Valor FROM servico_prestado WHERE Ativo = 1  AND MONTH(Data) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(Data) = YEAR(CURRENT_DATE())',0);
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
                  $total_a = Query('SELECT Valor_total,Valor FROM servico_prestado WHERE Ativo = 1  AND MONTH(Data) = MONTH(CURRENT_DATE()) AND YEAR(Data) = YEAR(CURRENT_DATE())',0);
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




                  $r_ticket_medio_dia = Query('SELECT avg(Valor) as Media,DAY(Data) as dia from servico_prestado',1);
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
            <?php echo $porcentagem_mais_mes;     ?>% em relação ao último mês.
          </div>
        </div>
        <div class="kpi-box border-div">
          <div class="kpi-top">
            <div class="kpi-value">
              <h6>Qtde. Sellers</h6>
              <span><?php echo $qtd_seller;   ?></span>
            </div>
            <div class="kpi-img-wrapper">
              <img src="images/icons/qtd-servicos.png" alt="Kpi_img" class="kpi-img">
            </div>
          </div>
          <div class="kpi-bottom">
            <?php echo $porcentagem_mais_mes_seller;     ?>% em relação ao último mês.
          </div>
        </div>
        <div class="kpi-box border-div">
          <div class="kpi-top">
            <div class="kpi-value">
              <h6>Clientes</h6>
              <div class="rate-box">
                <div>
                  #<?php echo $qtd_client;   ?>
                </div>
                Ativos
              </div> 
            </div>
            <div class="kpi-img-wrapper">
              <img src="images/icons/avaliacao.png" alt="Kpi_img" class="kpi-img">
            </div>
          </div>
          <div class="kpi-bottom">
             <?php echo $porcentagem_mais_mes_client;     ?>% em relação ao último mês.
          </div>
        </div>
      </div>

      <div class="chart-box border-div">
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

      <div class="flex-colab-service ">
        <div class="row">
          <div class="col-xl-8 col-md-8 col-sm-12">
            <div class="box-content canvas-box border-div">
              <h6>TOP Estados (Faturamento)</h6>
              <canvas id="colabChart"></canvas>
            </div>
      

          <?php    
            $total_servicos = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE ',0));

            $total_servico_1 = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Servico = 1',0));
            $perc_servico_1 = ($total_servico_1 / $total_servicos) * 100;

            $total_servico_2 = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Servico = 2',0));
            $perc_servico_2 = ($total_servico_2 / $total_servicos) * 100;

            $total_servico_3 = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Servico = 3',0));
            $perc_servico_3 = ($total_servico_3 / $total_servicos) * 100;


            $total_servico_4 = mysqli_num_rows(Query('SELECT * FROM servico_prestado WHERE Servico = 4',0));
            $perc_servico_4 = ($total_servico_4 / $total_servicos) * 100;

        ?>
            <div class="box-content serviceBox border-div mt-3">
              <div class="row position-relative">
                <div class="col-xl-7 col-md-6 col-sm-12">
                  <h6>Serviços</h6>
                  <div class="progress-line">                
                    <div class="progress">
                      <div class="progress-bar bg-ddt" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="text-box">
                      <span>Dedetização  <?php  echo $perc_servico_2; ?>%</span>
              <span>Sanitização  <?php  echo $perc_servico_1; ?>%</span>
                    </div>
                  </div>
                  <div class="progress-line">
                    <div class="progress">
                      <div class="progress-bar bg-prm" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="text-box">
                     <span>Dedetização Premium<?php  echo $perc_servico_3; ?>%</span>
              <span>Sanitização Premium<?php  echo $perc_servico_4; ?>%</span>
                    </div>
                  </div>
                </div>
                <div class="col-xl-5 col-md-6 col-sm-12 back-line">
                  <h6>TOP Pragas</h6>
                  <ul class="list-pragas">
                <?php    
     
                    $q_praga = Query('SELECT DISTINCT(Praga),COUNT(Praga) as Contador FROM praga_cotacao WHERE Servico_prestado IN (SELECT Servico_prestado FROM servico_prestado WHERE Ativo = 1) GROUP BY Praga ORDER BY Contador DESC',0);

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
            </div>
          </div>
          <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="box-content h-full border-div">
              <div>
                <h6>Sellers</h6>
                <canvas id="sellersChart"></canvas>
              </div>
              <hr class="mt-4">
              <div class="sellers-rank">
                <h6>TOP Sellers</h6>
                <ul class="rank-list">
                <?php    
                    $cache_top_sellers = array();
                    $media_top_sellers = array();

                    $q_parceiro = Query('SELECT DISTINCT(Parceiro),AVG(Nota) as Media FROM avaliacao WHERE Ativo = 1 AND Parceiro IN (SELECT Parceiro FROM parceiro) GROUP BY Parceiro ORDER BY Media DESC',0);
                    if(mysqli_num_rows($q_parceiro) > 0){
                      while($r_p = mysqli_fetch_assoc($q_parceiro)){
                        $r_partner = Query('SELECT Parceiro,Titulo FROM parceiro WHERE Parceiro = '.$r_p['Parceiro'].'',1);
                ?>
                  <li class="rank-item">
                    <?php echo $r_partner['Titulo'];   ?>
                  </li>
                <?php 
                  $cache_top_sellers[] = $r_partner['Titulo']; 
                  $media_top_sellers[] = $r_p['Media'];

                   }   }   ?>
                </ul>
              </div>
            </div>
          </div>
        </div>  
      </div>
      <div class="chart-box border-div">
        <h6>Tráfego do Site</h6>

        <div class="row">
          <div class="col-md-8 col-sm-12">            
            <canvas id="chartTrafego"></canvas>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="info-chart">
              <div class="info-box">
                <span>45,8M</span>
                Total de visitantes +12%
              </div>
              <div class="info-box">
                <span>20:00</span>
                Duração da visita +12%
              </div>
              <div class="info-box">
                <span>245.65</span>
                página/visita +62%
              </div>
            </div>
          </div>
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
    var sellersCtx = document.getElementById("sellersChart");
    var chartTrafego = document.getElementById("chartTrafego");




    <?php    

        $meses_qtd = array();
        $meses_total = array();

        $mes = 1;   
        while($mes <= 12){
          $r_servicos_m = Query('SELECT COUNT(*) as Total,SUM(Valor_total) as Valor FROM servico_prestado WHERE MONTH(Data) = '.$mes.' AND YEAR(Data) = YEAR(CURRENT_DATE())',1);

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


        <?php   


  $parceiro_cidade =  array();
  $parceiro_acesso =  array(); 

          
  $q_c = Query('SELECT DISTINCT(Cidade),SUM(Valor_total) as Total FROM servico_prestado GROUP BY Cidade ORDER BY Total DESC LIMIT 3',0);
  if(mysqli_num_rows($q_c) > 0){
    while($r_c = mysqli_fetch_assoc($q_c)){
      $parceiro_cidade[] = $r_c['Cidade'];
      $parceiro_acesso[] = $r_c['Total'];
    }
  }
   
?>

    var colabChart = new Chart(colabCtx, {
      type: "doughnut",
      data: {
        labels: [<?php    foreach ($parceiro_cidade as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"';  }   } ?>],
        datasets: [{
          backgroundColor: [
            "#BCC7DC",
            "#FAE5D5",
            "#FAD4D2",
          ],
          data: [<?php    foreach ($parceiro_acesso as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"'; }  } ?>]
        }]
      },
      plugins: [ChartDataLabels],
      options: {
        plugins: {
          datalabels: {
            color: 'purple',
          },
          legend: {
            position: 'right',

            labels: {
              color: '#582583',
              font: {
                weight: 'bold'
              }
            },
          },
        }
      },
    });

    var sellersChart = new Chart(sellersCtx, {
      type: "pie",
      data: {
        labels: [<?php    foreach ($cache_top_sellers as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"';  }   } ?>],
        datasets: [{
          backgroundColor: [
            "#BCC7DC",
            "#FAE5D5",
            "#FAD4D2",
            "#8F8A8E",
            "#CAC2D1"
          ],
          data: [<?php    foreach ($media_top_sellers as $k => $v) {   if($k==0){  echo '"'.$v.'"';    }else{ echo ',"'.$v.'"';  }   } ?>]
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
              }
            },
          },
          datalabels: {
            color: 'purple',
          }
        }
      },
    });

    var ctxTrafego = new Chart(chartTrafego, {
      data: {
        datasets: [{
          type: 'bar',
          label: 'Novo Visitante',
          data: [2,10,12,15,10,11,15,18,10,15,10,5],
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
          label: 'Visitante Antigo',
          data: [4,10,10,17,5,10,12,18,9,15,2,1],
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