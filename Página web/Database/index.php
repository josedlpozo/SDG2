<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 

<title>Using Highcharts with PHP and MySQL</title>

<script type="text/javascript" src="js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="js/highcharts.js" ></script>
<script type="text/javascript" src="js/themes/gray.js"></script>

<script type="text/javascript">
	var chart;
			$(document).ready(function() {
				console.log("HOLA");
				var options = {
					chart: {
						renderTo: 'container',
						defaultSeriesType: 'line',
						marginRight: 130,
						marginBottom: 25
					},
					title: {
						text: 'Hourly Visits',
						x: -20 //center
					},
					subtitle: {
						text: '',
						x: -20
					},
					xAxis: {
						type: 'datetime',
						tickInterval: 3600 * 1000, // one hour
						tickWidth: 0,
						gridLineWidth: 1,
						labels: {
							align: 'center',
							x: -3,
							y: 20,
							formatter: function() {
								return Highcharts.dateFormat('%l%p', this.value);
							}
						}
					},
					yAxis: {
						title: {
							text: 'Visits'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {
						formatter: function() {
				                return Highcharts.dateFormat('%l%p', this.x-(1000*3600)) +'-'+ Highcharts.dateFormat('%l%p', this.x) +': <b>'+ this.y + '</b>';
						}
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						borderWidth: 0
					},
					series: [{
						name: 'Count',
						data: (function () {
                // generate an array of random data
                var data = [], 
                	<?php 
							require_once 'funciones_bd.php';
							$db = new funciones_BD();
							$sql = "select temp, fecha from admin";
							$queue = mysql_query($sql);
                			while($fila = mysql_fetch_array($queue, MYSQL_ASSOC)){ ?>
                    data.push([
                        <?php echo $fila['fecha']?>,
                        <?php echo $fila['temp']?>
                    ]);
                }
                return data;
            }())
							
							
						

					}]
				
			});
}
</script>
</head>
<body>

<div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>
					
</body>
</html>