<html>
    <?php
        
            require_once("../includes/utility.php");
    require_once("function-Storico.php");
    ?>
    
    <?php
        session_start();
        isStillValid();

?>
    
<head>
    <title>Storico</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="richiesta-azioni.css">
<link rel="stylesheet" type="text/css" href="grafici-azioni.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="charts/chart.js"></script>
</head> 
    
    <body>
    
        <div>
    <div class="GraficoBellino" style="" id="canvas-container" >
        <h1 id="titolo" style="text-align: center;" >Versamenti</h1>
        <canvas  id="myChart" ></canvas>
    </div>
        
    <div class="GraficoBellino" style="position: relative; height:500px; width:100%;margin: auto;" id="canvas-container" >
        <h1 id="titolo" style="text-align: center;" >Ac</h1>
        <canvas class="grafico" id="myChart2" ></canvas>
    </div>
        
    <div style="position: relative; height:500px; width:80%;margin: auto;" id="canvas-container" >
        <h1 id="titolo" style="text-align: center;" >".$azione["nome"] ."</h1>
        <canvas class="grafico" id="myChart3" ></canvas>
    </div>
        
    <?php
                
        creaGraficoCanvas(cercaVersamenti($_SESSION["username"]) , "ctx" , "myChart","Data","Valore");
        creaGraficoCanvas(cercaAcquisti($_SESSION["username"]) , "ctx1" , "myChart2","Data","Valore");
        creaGraficoCanvas(cercaVendite($_SESSION["username"]) , "ctx2" , "myChart3","DataChiusra","ValoreChiusura");
       
         
    ?>
        
        <script>
            
        var resizeGraph = function (){

        if($(window).width() < 500){
                $("h1").css("font-size" , "25px");

            }
            else {
                $("h1").css("font-size" , "35px");

            }

        };

        $(window).resize(resizeGraph);
        resizeGraph();
        </script>
        </div>
    </body>
    




</html>