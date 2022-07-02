<?php
function creaGraficoCanvas($tabella ,$nomeVar ,$idCanvas,$campoLbl,$campoValore)
        {
            $elencoStr = "[0";
            $elencoStrLbl = "['0',";
            $elencoStrSfondo ="['rgb(51, 51, 51),'";
            
            if($tabella == 0)
                return;
            
            foreach($tabella as $riga){

            if($riga[$campoValore] >= 0)
                $elencoStrSfondo = $elencoStrSfondo .",'rgb(255, 204, 0)'"  ;
            else
                $elencoStrSfondo =  $elencoStrSfondo .",'rgb(51, 51, 51),'";

            $elencoStr = $elencoStr ."," . $riga[$campoValore] ;
            $elencoStrLbl = $elencoStrLbl. ",'".$riga[$campoLbl]."'";
            }
            $elencoStrSfondo =$elencoStrSfondo."]";
            $elencoStr = $elencoStr . "]" ;
            $elencoStrLbl = $elencoStrLbl . "]" ;

            echo" <script>var $nomeVar = document.getElementById(\"$idCanvas\").getContext('2d');
            var my$nomeVar = new Chart($nomeVar, {
            type: 'bar',
            data: {
            labels: $elencoStrLbl,
            datasets: [{
            label: '$ dollari',
            data: $elencoStr,
            backgroundColor: $elencoStrSfondo,
            borderColor:'rgba(255,99,132,1)' ,
            borderWidth: 1
            }]
            },
            options: {
            maintainAspectRatio:false,
            aspectRatio:2,
            scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
            }
            }

            });</script>";           
        }

?>