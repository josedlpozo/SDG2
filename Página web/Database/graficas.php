<?
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
      <!--   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Gráficas</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

        <!-- Custom Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

        <!-- Plugin CSS -->
        <link rel="stylesheet" href="css/animate.min.css" type="text/css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/creative.css" type="text/css">

        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                chart: {
                    renderTo: 'container',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Octopus Temperature'
                },
                yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#A9F5A9'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
                plotOptions: {
                    line:{
                        allowPointSelect: true,
                        cursor: 'pointer',
                        color : '#00FF00'
                    }
                },
                series: [
                        {
                            name: 'Temperatura',
                            data: []
                        }
                ]
            };

            var options2 = {
                chart: {
                    renderTo: 'container2',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Octopus Rocio'
                },
                yAxis: {
            title: {
                text: 'Rocio (%)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
                plotOptions: {
                    line:{
                        allowPointSelect: true,
                        cursor: 'pointer',
                        color : '#FF0040'
                    }
                },
                series: [
                        {
                            name: 'Rocio',
                            data: []
                        }
                    
                ]
            };

            var options3 = {
                chart: {
                    renderTo: 'container3',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Octopus Humedad de la tierra'
                },
                yAxis: {
            title: {
                text: 'Humedad de la tierra (%)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
                plotOptions: {
                    line:{
                        allowPointSelect: true,
                        cursor: 'pointer',
                        color : '#8904B1'
                    }
                },
                series: [
                        {
                            name: 'Humedad de la tierra',
                            data: []
                        }
                    
                ]
            };

            var options4 = {
                chart: {
                    renderTo: 'container4',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Octopus Humedad del aire'
                },
                yAxis: {
            title: {
                text: 'Humedad del aire (%)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
                plotOptions: {
                    line:{
                        allowPointSelect: true,
                        cursor: 'pointer',
                        color : '#0040FF'
                    }
                },
                series: [
                        {
                            name: 'Humedad del aire',
                            data: []
                        }
                    
                ]
            };

            var options5 = {
                chart: {
                    renderTo: 'container5',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Octopus Brujula'
                },
                yAxis: {
            title: {
                text: 'Brujula (º)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
                plotOptions: {
                    line:{
                        allowPointSelect: true,
                        cursor: 'pointer',
                        color : '#DF7401'
                    }
                },
                series: [
                        {
                            name: 'Grados brujula',
                            data: []
                        }
                    
                ]
            };

            var options6 = {
                chart: {
                    renderTo: 'container6',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Octopus Acelerometro'
                },
                yAxis: {
            title: {
                text: 'Acelerometro (m/s^2)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
                plotOptions: {
                    line:{
                        allowPointSelect: true,
                        cursor: 'pointer',
                        color : '#DF7401'
                    }
                },
                series: [
                        {
                            name: 'Eje X',
                            data: [],
                            color : '#0040FF'
                        },{
                            name: 'Eje Y',
                            data: []
                        },{
                            name: 'Eje Z',
                            data: [],
                            color : '#00FF00'

                        }
                    
                ]
            };
        
        
        $.getJSON("data.php", function(json) {
            options.series[0].data = json;
            chart = new Highcharts.Chart(options);
        });
        
        $.getJSON("data2.php", function(json) {
                options2.series[0].data = json;
                chart = new Highcharts.Chart(options2);
            }); 

        $.getJSON("data3.php", function(json) {
                options3.series[0].data = json;
                chart = new Highcharts.Chart(options3);
            });   

        $.getJSON("data4.php", function(json) {
                options4.series[0].data = json;
                chart = new Highcharts.Chart(options4);
            });  

        $.getJSON("data5.php", function(json) {
                options5.series[0].data = json;
                chart = new Highcharts.Chart(options5);
            });         

        $.getJSON("data6.php", function(json) {
                options6.series[0].data = json;
                //chart = new Highcharts.Chart(options6);
            });

        $.getJSON("data7.php", function(json) {
                options6.series[1].data = json;
                //chart = new Highcharts.Chart(options6);
            });

        $.getJSON("data8.php", function(json) {
                options6.series[2].data = json;
                chart = new Highcharts.Chart(options6);
            });
           
           
        });
  
        </script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
    </head>
    <body  id="page-top">
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                 <a style="color: black"  class="navbar-brand page-scroll" href="close.php">CERRAR SESIÓN</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div  style="color: black" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right" display ="block" align ="left">
                            <li >
                                <a style="color: black" class="page-scroll" href="#container">Temperatura</a>
                            </li>
                            <li>
                                <a style="color: black"class="page-scroll" href="#container2">Rocio</a>
                            </li>
                            <li>
                                <a style="color: black" class="page-scroll" href="#container3">Humedad de la tierra </a>
                            </li>
                            
                            <li>
                                <a style="color: black" class="page-scroll" href="#container4">Humedad del aire</a>
                            </li>
                            <li>
                                <a style="color: black" class="page-scroll" href="#container5">Brújula</a>
                            </li>
                            <li>
                                <a style="color: black" class="page-scroll" href="#container6">Acelerómetro</a>
                            </li>
                        </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!--
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a style="color: black"  class="navbar-brand page-scroll" href="close.php">CERRAR SESIÓN</a>
                </div>
           
                 <div  style="color: black" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right" display ="block" align ="left">
                            <li >
                                <a style="color: black" class="page-scroll" href="#container">Temperatura</a>
                            </li>
                            <li>
                                <a style="color: black"class="page-scroll" href="#container2">Rocio</a>
                            </li>
                            <li>
                                <a style="color: black" class="page-scroll" href="#container3">Humedad de la tierra </a>
                            </li>
                            
                            <li>
                                <a style="color: black" class="page-scroll" href="#container4">Humedad del aire</a>
                            </li>
                            <li>
                                <a style="color: black" class="page-scroll" href="#container5">Brújula</a>
                            </li>
                            <li>
                                <a style="color: black" class="page-scroll" href="#container6">Acelerómetro</a>
                            </li>
                        </ul>
                </div>
        </div>
    </nav>
 -->
    <p align="center" >
    <br>
    <br>
    <p align="center" >
        <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                               <?php echo '<h2 class="section-heading">Bienvenido : ' . $_SESSION["usuario_online"] . '</h2>'; ?>
                    <hr class="light">
                    
                   
                </div>
            </div>
        </div>
        </section>
        <?php if(isset($_SESSION["usuario_online"])){?>
        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
        <div id="container2" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
        <div id="container3" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
        <div id="container4" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
        <div id="container5" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
        <div id="container6" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
        <?php }else{?>
            <h2>No hay usuario registrado para mostrar datos</h2>
        <?php }?>
        
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>
    </body>
</html>