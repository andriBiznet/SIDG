<div class="row">
	<div class="col-md-8">
		<div class="card card-custom gutter-b">
			<div class="card-header">
				<h3 class="card-title">Emisi Total</h3>
			</div>
			<div class="card-body pt-5 pr-0 pb-5 pl-0">
				<div id="chart-total" class="mr-10" style="height:400px"></div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card card-custom gutter-b">
			<div class="card-header">
				<h3 class="card-title">Lini Masa</h3>
			</div>
			<div class="card-body p-2">
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><a href="#">Arga Dinata melakukan pembaruan data pada BPH MIGAS > PENJUALAN BBM SEKTOR TRANSPORTASI (SPBU).</a></li>
					<li class="list-group-item"><a href="#">Arga Dinata melakukan pembaruan data pada BPH MIGAS > PENJUALAN BBM SEKTOR TRANSPORTASI (SPBU).</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('/assets/highcharts/highcharts.js'); ?>"></script>

<script>
$(function () {
	$('#chart-total').highcharts({
        chart: {
			type: 'column',
			style: { fontFamily: 'Mukta', fontSize: '13px' }
        },
        title: {
			style: {
				fontSize: '0'
			},
            text: '',
		},
        xAxis: { categories: [2010,2011,2012,2013,2014,2015,2016,2017,2018] },
        yAxis: {
			title: {
                text: 'Emisi (Gg CO2)'
            },
            stackLabels: {
				allowDecimals: true,
                enabled: false,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray',
					fontSize: '13px'
                }
            }
        },
        legend: {
            align: 'center',
            verticalAlign: 'bottom',
			x: 0,
            y: 0,
            floating: false,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false,
			width: 350,
			itemStyle: { fontWeight: '500', fontSize: '10px' }
        },
        tooltip: {
			pointFormat:
				"{series.name}: {point.y:,.0f} Gg CO2<br />"
				+ "Total: {point.stackTotal:,.0f} Gg CO2",
			style: { fontSize: '13px' }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: { textShadow: '0 0 3px black, 0 0 3px black' }
                }
            }
        },
        series: [{"name":"ENERGI","color":"Yellow","data":[19096.220005599,19719.752687237,21110.895183613,23597.395521845,22274.415059825,25473.017257944,26637.969226697,28120.576669556,31610.135141485]},{"name":"PERTANIAN","color":"SkyBlue","data":[26.783167001423,25.793757383264,37.943834882703,29.973161060811,18.847353815144,10.331599341722,10.623748762967,9.5252652168661,9.2372933713218]},{"name":"KEHUTANAN","color":"MediumSeaGreen","data":[-2201.4770461201,-2153.5439888719,3470.2754793178,-1540.1456586793,32.692977518153,-5.5349648414133,-1.0203039998774,15.434294318068,0]},{"name":"LIMBAH","color":"Violet","data":[991.86821969239,953.39496601095,1019.5243774518,1029.3315832757,1040.699226378,1050.3810211785,1065.7545136507,140.42173375211,1070.1608825192]}]    
	
	});
});
</script>