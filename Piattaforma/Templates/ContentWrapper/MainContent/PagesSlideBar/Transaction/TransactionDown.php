<?php
/** SCRIPT DI INCLUSIONE DEI DOCUMENTI **/
    require_once("../../../../../Includes/utility.php");
    require_once("../../../../../Includes/constants.php");
    require_once("../../../../../Includes/functions.php");
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
		<h1 class="h3 mb-0 colorTitle">Informazioni Sulle Azioni Chiuse</h1>
	</div>
  	<div class="row">
	    <!-- Card del numero di elementi -->
	    <div class="col-xl-3 col-md-6 mb-4">
	      <div class="card border-left-primary shadow h-100 py-2">
	        <div class="card-body">
	          <div class="row no-gutters align-items-center">
	            <div class="col mr-2">
	              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">num. Transizini DOWN</div>
	              <div class="h4 mb-0 font-weight-bold text-gray-800">
	              <?php	
					$sql  = "SELECT COUNT(Username) FROM azione_down WHERE Username='". $_SESSION['username'] ."';";
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
	    <!-- Card del Ricavo-->
	    <div class="col-xl-3 col-md-6 mb-4">
	      <div class="card border-left-warning shadow h-100 py-2">
	        <div class="card-body">
	          <div class="row no-gutters align-items-center">
	            <div class="col mr-2">
	              <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">Guadagno Totale</div>
	              <div class="h4 mb-0 font-weight-bold text-gray-800">
	              <?php 
	                  $sql  = "SELECT SUM(ricavo) FROM azione_down WHERE Username='" . $_SESSION['username'] ."';";
	                  $result = query($sql);
	                  foreach ($result[0] as $key=>$value) 
	                      echo "€".$value;
	               ?>
	              </div>
	            </div>
	            <div class="col-auto">
	              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
	            </div>
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
					function build_table($result)
					{
						// start table
						$html = '<table data-vertable="ver3">';
						// header row
						$html .= '<tr class="row100 head">';
						foreach($result[0] as $key=>$value)
						{
							$html .= '<th class="column100 column1" data-column="column1" style="font-size: 1.1em">'.htmlspecialchars($key) . '</th>';
						}
						$html .= '</tr>';
						// data rows
						foreach( $result as $key=>$value)
						{
							$html .= '<tr class="row100">';
							foreach($value as $key2=>$value2)
							{
								$html .= '<td class="column100 column1" data-column="column1" style="font-size: 1.3em">' . htmlspecialchars($value2) . '</td>';
							}
							$html .= '</tr>';
						}
						$html .= '</table>';

						return $html;
					}

					$sql  = "SELECT simbolo, dataapertura, datachiusra, valoreapertura, quantitaapertura, valorechiusura, quantitachiusura, ricavo FROM azione_down WHERE Username = '" . $_SESSION['username'] . "' ORDER BY datachiusra DESC;";
					$result = query($sql);
					
					if(count($result) > 0)
						echo build_table($result);
					$link->close();
					?>
				</div>
			</div>
		</div>
	</div>
</div>