<?php
/** SCRIPT DI INCLUSIONE DEI DOCUMENTI **/

if(!isset($_SESSION))
{
require_once("../../../../../Includes/utility.php");
require_once("../../../../../Includes/constants.php");
require_once("../../../../../Includes/functions.php");
}
else
{
require_once("./Includes/utility.php");
require_once("./Includes/constants.php");
require_once("./Includes/functions.php");
}
?>
<?php
if(!isset($_SESSION))
session_start();
isStillValid();
$link = mysqli_connect(SERVER, USERNAME,PASSWORD, DATABASE);
?>
<!-- Begin Page Content -->
<div class="container-fluid colorSfondoDashBoard">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 colorTitle">Informazioni Sulle Azioni Aperte</h1>
	</div>
	<!-- Card del numero di elementi -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-lg font-weight-bold text-primary text-uppercase mb-1">num. Azioni Up</div>
						<div class="h4 mb-0 font-weight-bold text-gray-800">
							<?php
										$sql  = "SELECT COUNT(Username) FROM azione_up WHERE Username='". $_SESSION['username'] ."';";
										$result = query($sql);
										foreach ($result[0] as $key=>$value)
										echo $value;
							?>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-check-square fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<!-- Content Row -->
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="wrap-table100" id="table-wrapper">
				<div class="table100 ver3 m-b-110" style="overflow-x:auto;">
					<?php
					
					
					function build_html($result)
					{
					$id = 0;
					$nome = "text" . $id;
					
					$html = '<form action="./Templates/ContentWrapper/MainContent/PagesSlideBar/Transaction/TransactionUp.php" method="post"><div><h1 class="h3 mb-0 colorTitle">Vendi Azioni</h1>';
						// start table
						$html.= '<table class="ridim" data-vertable="ver3">';
							// header row
							$html .= '<tr class="row100 head">';
								foreach($result[0] as $key=>$value)
								{
								$html .= '<th class="column100 column1" data-column="column1" style="font-size: 1.1em">'.htmlspecialchars($key) . '</th>';
								}
								
								$html .= '<th class="column100 column1" data-column="column1" style="font-size: 1.1em">'.htmlspecialchars("quantita da vendere") . '</th>';
							$html .= '</tr>';
							// data rows
							foreach($result as $key=>$value)
							{
							$html .= '<tr class="row100">';
								foreach($value as $key2=>$value2)
								{
								$html .= '<td class="column100 column1" data-column="column1" style="font-size: 1.3em">' . htmlspecialchars($value2) . '</td>';
								}
								$html .= '<td class="column100 column1" data-column="column1" style="font-size: 1.3em"><input type = "text" name = "'.$nome.'" value = "0" required pattern="[0-9]{1,20}"></td>';
								
							$html.= '</tr>';
							
							
							$id++;
							$nome = "text" . $id;
							}
						$html .= '</table>';
						$html .= '<input type="submit" name = "bottoneConferma"></input></form></div>';
						return $html;
						}
						
						$sql  = "SELECT simbolo,data,valore,quantita FROM azione_up WHERE Username = '" . $_SESSION['username'] . "' ORDER BY data DESC;";
						$result = query($sql);
						if(count($result) > 0)
						echo build_html($result);
						$link->close();
						
						
						if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['bottoneConferma']) and !empty($_POST))
						{
						$sql  = "SELECT simbolo,data,valore,quantita FROM azione_up WHERE Username = '" . $_SESSION['username'] . "' ORDER BY data DESC;";
						$result = query($sql);
						
						$isTooBig = false;
						
						for($i = 0; $i < count($result); $i++)
						{
						if(($result[$i]['quantita']) < $_POST["text" .$i])
						{
						$isTooBig = true;
						}
						}
						
						if($isTooBig)
						{
						echo "<script type='text/javascript'>alert('Quantita inserita maggiore di quella posseduta');</script>";
						}
						
						else
						{
						for($i = 0; $i < count($result); $i++)
						{
						if($_POST["text". $i] != 0)
						{
						$username = $_SESSION['username'];
						$simbolo = $result[$i]['simbolo'];
						$dataapertura = $result[$i]['data'];
						$valoreapertura = $result[$i]['valore'];
						$quantitaapertura = $result[$i]['quantita'];
						$datachiusura = date("Y-m-d");
						$arrayvalori = ritornaStockArrayValori($simbolo);
						$valorechiusura = $arrayvalori['prezzo'];
						$quantitachiusura = $_POST["text". $i];
						$ricavo = ($valorechiusura * $quantitachiusura) - ($quantitachiusura * $valoreapertura);
						$quantitanuova = $quantitaapertura - $quantitachiusura;
						$soldi = ($quantitachiusura * $valorechiusura);
						
						query("INSERT INTO azione_down VALUES('$username', '$simbolo', '$dataapertura', '$valoreapertura', '$quantitaapertura', '$datachiusura', '$valorechiusura','$quantitachiusura', '$ricavo');");
						query("UPDATE azione_up SET Quantita = '$quantitanuova' WHERE Username = '$username' AND Simbolo = '$simbolo' AND Quantita = '$quantitaapertura' LIMIT 1;");
						$soldiquery = query("SELECT Saldo from Utente WHERE Username = '$username'");
						$soldinuovi = $soldiquery[0]['Saldo'] + $soldi;
						query("UPDATE Utente SET Saldo = '$soldinuovi' WHERE Username = '$username'");
						
						
						}
						}
						
						query("DELETE FROM azione_up WHERE Quantita = 0;");
						}
						
						$_SESSION['ApriPaginaPost'] = "./Templates/ContentWrapper/MainContent/PagesSlideBar/Transaction/TransactionUp.php";
						header("location: ..\..\..\..\..\start.php");
						$_POST = array();
						exit;
						}
						
						
						
						?>
					</div>
				</div>
			</div>
		</div>
		
	</div>