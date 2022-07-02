<?php 

function LoadPage()
{
    if(isValidPostBuyRequest())
        $_SESSION["MARKET-SUCCESSO"] = acquistoAzione();
    else
        unset($_SESSION["MARKET-SUCCESSO"]);

    RiempiPagina();    
}


function isValidPostBuyRequest()
{

    if(!(isset($_SESSION["MARKET-AZIONE_RICHIESTA"]) && isset($_POST["nazioni"]) ) 
    )
        return False;
    else {
            $stringaNazioni = "".$_POST["nazioni"];
        if (!(strlen($stringaNazioni) < 5 && strlen($stringaNazioni) > 0 && isNumber($stringaNazioni)))
            
        return False;
    }
    return True;
}
    
function acquistoAzione()
{
    if(!isValidPostBuyRequest())
        return ;
    
    $utente_attivo = cercaUser($_SESSION["username"]);
    
    if($utente_attivo[0]["Saldo"] - ($_SESSION["MARKET-AZIONE_RICHIESTA"]["prezzo"]*$_POST["nazioni"]) >= 0)
    {
        compraAzione($_SESSION["MARKET-AZIONE_RICHIESTA"] , $utente_attivo , $_POST["nazioni"]);
        return True;
    }
    else
        return False;
    
}
   
function creaGrafico($azione)
{
    
    if(isset($_SESSION["MARKET-SUCCESSO"]) && $_SESSION["MARKET-SUCCESSO"])
        $par = "<p STYLE='color :green;'>Hai comprato con successo le tue azioni </p>";
    else if (isset($_SESSION["MARKET-SUCCESSO"]) && !$_SESSION["MARKET-SUCCESSO"])
        $par = "<p STYLE='color :red;'>Calma non puoi comprarle tutte in un colpo non hai abbastanza cash </p>";
    else
        $par ="";
    

    
    echo "
    <div style=\"position: relative; height:300px; width:80%;margin: auto;\" id=\"canvas-container\" >
        <h1 id=\"titolo\" style=\"text-align: center;\" >".$azione["nome"] ."</h1>
        <canvas class=\"grafico\" id=\"myChart\" ></canvas><div>
        <div>
        <form autocomplete=\"off\" action=\"\" method=\"post\">
            <div class=\"cercaAzioni-autocomplete\" >
            <p class=\"cercaAzioni\">Massimo numero 999 </p>
                <input class=\"cercaAzioni campoTesto\" id=\"Nazioni\" type=\"number\" max=\"999\" maxlength=\"3\" min=\"1\" name=\"nazioni\" placeholder=\"NumeroAzioni\" id=\"myInput\" style=\"width:40%;margin-right : 0px;margin-left : 20%;\" autofocus  required>
                        <input class=\"cercaAzioni bottone\" type=\"submit\" style=\"width:10%;margin : 0px;\" id=\"invia\" >
            </div>

        </form>
        </div>
    </div>$par
    <div>";
    echo" <script>var ctx = document.getElementById(\"myChart\").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [\"Apertura\", \"Minimo\", \"Massimo\", \"Attuale\"],
        datasets: [{
            label: '$ dollari',
            data: [".$azione["prezzoApertura"].", ".$azione["minimo"].", ".$azione["massimo"]."," .$azione["prezzo"]."],
            backgroundColor: [
                'rgb(51, 51, 51)',
                'rgb(255, 71, 26)',
                'rgb(102, 255, 51)',
                'rgb(255, 204, 0)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
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

function RiempiPagina()
{
    $_SESSION['ApriPaginaPost'] = "./Templates/ContentWrapper/MainContent/PagesSlideBar/BuyAzione/Mercato.php";

    if(isset($_POST["azione"]))
        $azioni = cercaAzione($_POST["azione"]);
    else
    {
        if(isset($_SESSION["MARKET-AZIONE_RICHIESTA"]))
            creaGrafico($_SESSION["MARKET-AZIONE_RICHIESTA"]);
        return ;
    }
        
    
    if(!isset($azioni))
        $azioni = 0;
    

    if($azioni != 0) 
    {
        
        $azione = findSymbol($_POST["azione"]);

        // SE L'AZIONE E' PRESENTE
        if($azione != 0)
        {
            creaGrafico($azione);
            $_SESSION["MARKET-AZIONE_RICHIESTA"] = $azione;
        }

        exit;
        return;
    }
    else
    {
            aggiungiAzione($_POST["azione"]);
            $ultimaAzioneAggiunta = cercaAzione($_POST["azione"]);
            
            if($ultimaAzioneAggiunta!=0)
            {
               //SE HO AGGIUNTO L'AZIONE AL DATABASE 
                
                $azione = findSymbol($_POST["azione"]);
                creaGrafico($azione);
                $_SESSION["MARKET-AZIONE_RICHIESTA"] = $azione;
                echo "Global scrittaH<br>";
            }
            exit;
    }
}

?>    