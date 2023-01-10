<?php include('header.php'); ?>
	<div class="page-container">
		<h1 class="page-title">Carteira Digital</h1>

		<div class="page-content">
			<?php include('top-box.php'); ?>

			<div class="wallet-box">
				<div class="balanco-wrapper">
					<h3>Balanço (Crédito vs Débito)</h3>
					<canvas id="chartWallet"></canvas>
				</div>
				<div class="saldo-wrapper">
					<h3>Saldo atual</h3>
					<span class="class-counter">R$1.000,00</span>
					<div class="box-info">
						<h4>Último mês</h4>
						<span class="lst-month">R$13.142,77</span>
						<span class="info-txt">X% maior/menor em relação ao mês anterior.</span>
						<hr>
						<span class="info-p">Lorem ipsum, dolor sit amet consectetur adipisicing, elit. Accusantium explicabo atque quasi, vero saepe beatae cupiditate distinctio laudantium iure, ipsa libero sapiente quidem enim cumque quisquam dolor et laboriosam. Corporis.</span>
					</div>
				</div>
			</div>

			<div class="balancete-wrapper">
				<table id="table-balancete" class="table table-striped">
					<thead>
						<tr>
							<th>Movimentação</th>
							<th>Origem</th>
							<th>Destino</th>
							<th>Tipo de movimentação</th>
							<th>Categoria</th>
							<th>Valor</th>
							<th>Data</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Receber</td>
							<td>ITAÚ 1234 / 85985-2 (exemplo)</td>
							<td>BB 7524 / 000004589-a (exemplo)</td>
							<td>Crédito</td>
							<td> --- </td>
							<td>R$600,00</td>
							<td>10/10/2021</td>
						</tr>
						<tr>
							<td>Pagar</td>
							<td>Bradesco 00577 / 000185985-00 (exemplo)</td>
							<td>NEON 00001 / 98154 (exemplo)</td>
							<td>Débito</td>
							<td>Despesa </td>
							<td>R$57,25</td>
							<td>10/10/2021</td>
						</tr>
						<tr>
							<td>Pagar</td>
							<td>BB 7524 / 000004589-a (exemplo)</td>
							<td>Bradesco 5465 / 0000057789-0 (exemplo)</td>
							<td>Débito</td>
							<td> Custo </td>
							<td>R$725,00</td>
							<td>10/10/2021</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>

<script>
	$(function(){
		var chartThis = document.getElementById("chartWallet");

		// const dataCount = 7;
		const mensal = ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"];

		var myChart = new Chart(chartThis, {
		 type: "line",
		  data: {
		    labels: mensal,
		    datasets: [{
		    	label: 'Crédito R$',
		      data: [4000,3200,8500,7232,7550,3200,2000,4800,7830,6751,10502,8500],
		      borderColor: "#5988C3",
		      fill: false
		    },{
		    	label: 'Débito R$',
		      data: [1600,1700,1700,1900,2000,2700,2900,2000,6000,5900,5988,2700],
		      borderColor: "rgb(255, 224, 230)",
		      fill: false
		    }]
		  },
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

		var data_leads = $('#table-balancete');
		var _dt_options = {
      "language":{
        "url": "./js/Portuguese-Brasil.json"
      },
      "ordering": true,
      "order" : [ 0, "asc" ],
      "paging": true,
	    "searching": true,
      "info": false,
      responsive : true
    };

    data_leads.DataTable(_dt_options);
	});
</script>

</body>
</html>