<?php 
    require("functions.php");
?>
<?php

/** La funzione verifica se l'utente può  visualizzare la pagina **/
function isStillValid(){

if(!isLogged())
die();

primoAccesso();


if(isInTimeout())
redirectToLogin();
else
aggiornaUltimaAzione();
}



function isLogged()
{
    if(!isset($_SESSION["username"]))
        return False;
    return True;
}

function primoAccesso()
{
if(!isset($_SESSION['LAST_ACTIVITY']))
    $_SESSION['LAST_ACTIVITY'] = $_SERVER["REQUEST_TIME"];
}

function aggiornaUltimaAzione()
{

    $_SESSION['LAST_ACTIVITY'] = $_SERVER["REQUEST_TIME"];
    return;
}

function isInTimeout(){

if($_SERVER["REQUEST_TIME"] - $_SESSION['LAST_ACTIVITY'] > MAX_TIME )
{
    return True;
}
return False;
}

function redirectToLogin()
{
session_destroy();
header("Location: ../Login/login.php");
}

function cercaUser($username)
{
    $nutenti = query("SELECT *,COUNT(*) AS NUTENTI FROM UTENTE WHERE USERNAME='$username';");
    if($nutenti[0]["NUTENTI"] == 0){
        return 0;
    }
    else 
        return $nutenti;
}


/** Funzioni di Ricerca SQL **/
function cercaAzione($symbol)
{
    $azioni = query("SELECT *,COUNT(*) AS NAZIONI FROM AZIONE WHERE SIMBOLO='$symbol';");
    if($azioni[0]["NAZIONI"] == 0){
        return 0;
    }
    else 
        return $azioni;
}

function cercaLikeAzione($symbol)
{
    
    $azioni = query("SELECT * FROM AZIONE WHERE SIMBOLO LIKE '%$symbol%';");
    if(!isset($azioni[0]["Simbolo"])){
        return 0;
    }
    else 
        return $azioni;
}

/** FUNZIONI DELLE 22 37 **/
function cercaVersamenti($username)
{
    $versamenti = query("SELECT *,COUNT(*) AS NVERSAMENTI FROM transizioni WHERE Username_Utente='$username';");
    if($versamenti[0]["NVERSAMENTI"] == 0){
        return 0;
    }
    else 
        return query("SELECT * FROM transizioni WHERE Username_Utente='$username';");;
}

function cercaAcquisti($username)
{
    $acquisti = query("SELECT *,COUNT(*) AS NACQUISTI FROM azione_up WHERE Username='$username';");
    if($acquisti[0]["NACQUISTI"] == 0){
        return 0;
    }
    else 
        return query("SELECT * FROM azione_up WHERE Username='$username';");;
}

function cercaVendite($username)
{
    $vendite = query("SELECT *,COUNT(*) AS NACQUISTI FROM azione_down WHERE Username='$username';");
    if($vendite[0]["NACQUISTI"] == 0){
        return 0;
    }
    else 
        return query("SELECT * FROM azione_down WHERE Username='$username';");;
}
/** FINE FUNZIONI DELLE 22 37 **/

function aggiungiAzione($symbol){
    
    if(findSymbol($symbol)==0)
        return ;
    $link = mysqli_connect(SERVER, USERNAME,PASSWORD, DATABASE);

    mysqli_query(
        $link,
        "INSERT INTO AZIONE(Simbolo)VALUES('$symbol');"
    );
    return;
}

/** **/
    function findSymbol($symbolName)
    {
            $array = ritornaStockArrayValori($symbolName);
            
            if($array == 0)
                return 0;
        
            return $array;
    }


function ritornaStockArrayValori($nome)
{
		ini_set("allow_url_open", 1);
		$handle = @file_get_contents("https://api.iextrading.com/1.0/stock/$nome/quote");

		if($handle == false)
		{
			// trigger_error("Impossibile connettersi a IEX", E_USER_ERROR);
			return 0;
		}

		$json = json_decode($handle, true);

		//if($json[$nome] !== $nome)
		//{
		//	return false;
		//}
		
		/*
		Esempio JSON Amazon
		{"symbol":"AMZN","companyName":"Amazon.com Inc.",
		"primaryExchange":"Nasdaq Global Select","sector":"Consumer Cyclical","calculationPrice":"tops",
		"open":1640,"openTime":1551105000636,"close":1631.56,"closeTime":1550869200457,"high":1654.6,
		"low":1630.387,"latestPrice":1634.44,"latestSource":"IEX real time price",
		"latestTime":"3:29:53 PM","latestUpdate":1551126593834,"latestVolume":2630671,
		"iexRealtimePrice":1634.44,"iexRealtimeSize":100,"iexLastUpdated":1551126593834,
		"delayedPrice":1637.55,"delayedPriceTime":1551125690168,"extendedPrice":1634.44,
		"extendedChange":0,"extendedChangePercent":0,"extendedPriceTime":1551126593834,
		"previousClose":1631.56,"change":2.88,"changePercent":0.00177,"iexMarketPercent":0.01728,
		"iexVolume":45458,"avgTotalVolume":5185426,"iexBidPrice":1570,
		"iexBidSize":100,"iexAskPrice":1634.76,"iexAskSize":100,"marketCap":802841651532,
		"peRatio":81.19,"week52High":2050.5,"week52Low":1307,"ytdChange":0.06182340679474757}
		
		*/
		
		return
		[
			"nome" => $json["companyName"],
			"prezzo" => $json["latestPrice"],
            "massimo" => $json["week52High"],
            "minimo"  => $json["week52Low"],
            "prezzoApertura" => $json["open"],
            "simbolo" => $json["symbol"]
		];
	}


/** **/
function compraAzione($azione , $user , $quantity)
{
    // DIMINUISCO IL SALDO
     $user[0]["Saldo"] = $user[0]["Saldo"] - ($azione["prezzo"]*$quantity);
     
     $link = mysqli_connect(SERVER, USERNAME,PASSWORD, DATABASE);

        mysqli_query(
            $link,
            "
            UPDATE utente
            SET Saldo = ".$user[0]["Saldo"]."
            WHERE USERNAME ='".$user[0]["Username"]."';"
        );
    
    // SALVO L'AZIONE TRA GLI ACQUISTI
    $username  = $user[0]["Username"];
    $simbolo = $azione["simbolo"];
    $valore = $azione["prezzo"];
    $quantita = $quantity;
    $date = date("Y-m-d H:i:s");
    
    mysqli_query(
            $link,
            "
            INSERT INTO azione_up(Username ,Simbolo,Data,Valore,Quantita)VALUES('$username','$simbolo','$date','$valore','$quantita');
            "
    );

    
}

/** **/
function ricaricaSaldo($user, $saldo)
{
     // AUMENTO IL SALDO
     $user[0]["Saldo"] = $user[0]["Saldo"] + $saldo;
     
     $link = mysqli_connect(SERVER, USERNAME,PASSWORD, DATABASE);

        mysqli_query(
            $link,
            "
            UPDATE utente
            SET Saldo = ".$user[0]["Saldo"]."
            WHERE USERNAME ='".$user[0]["Username"]."';"
        );
    
        mysqli_query(
        $link,
        "
        INSERT INTO versamento(ID)VALUES('');
        "
        );
    
        $last_id = mysqli_insert_id($link);    
        $username = $user[0]["Username"];
        $date = date("Y-m-d H:i:s");
        mysqli_query(
        $link,
        "
        INSERT INTO transizioni(Username_Utente ,ID_Versamento ,Data,Valore)VALUES('$username',$last_id,'$date',$saldo);
        "
        );   
}

/**/
function effettuaPrelievo($user, $saldo)
{
    
     if(($user[0]["Saldo"] - $saldo)<0)
         return False;
    
    // DIMINUISCO IL SALDO
     $user[0]["Saldo"] = $user[0]["Saldo"] -$saldo;
     
     $link = mysqli_connect(SERVER, USERNAME,PASSWORD, DATABASE);
    
    mysqli_query(
            $link,
            "
            UPDATE utente
            SET Saldo = ".$user[0]["Saldo"]."
            WHERE USERNAME ='".$user[0]["Username"]."';"
        );
    
    mysqli_query(
        $link,
        "
        INSERT INTO versamento(Valore)VALUES(-$saldo);
        "
    );
    
     $last_id = mysqli_insert_id($link);    
    $username = $user[0]["Username"];
    $date = date("Y-m-d H:i:s");
    mysqli_query(
        $link,
        "
        INSERT INTO transizioni(Username_Utente ,ID_Versamento ,Data,Valore)VALUES('$username',$last_id,'$date',-$saldo);
        "
    );
    
    
    
    return True;
}

function isNumber($string)
{
            
            if(doubleval($string) != 0)
                return True;
            return False;
}


?>