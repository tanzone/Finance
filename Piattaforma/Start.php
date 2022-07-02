<?php
/** SCRIPT DI INCLUSIONE DEI DOCUMENTI **/
    require_once("./Includes/utility.php");
    require_once("./Includes/constants.php");
    require_once("./Includes/functions.php");
?>

<?php
	if(!isset($_SESSION))
	{
		session_start();
		if(!isset($_SESSION['ApriPaginaPost']))
			$_SESSION['ApriPaginaPost'] = "./Templates/ContentWrapper/MainContent/DashBoard/DashBoard.php";
	}
	isStillValid();
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		
		<?php
			require("./Templates/MainHead/MainHead.php");
		?>
		
	</head>



	<!-- JQuery Principali-->
	<script src="./JQuery/jquery.min.js"></script>
	<script src="./JQuery/jquery.easing.min.js"></script>

	<!-- Javascript Bootstrap-->
	<script src="./JavaScript/BootStrap/bootstrap.bundle.min.js"></script>
	
	<!-- Javascript Utile-->
	<script src="./JavaScript/Utile/sb-admin-2.min.js"></script>
	<script src="./JavaScript/Utile/responsiveInput.js"></script>

	<!-- Javascript Per la piattaforma -->
	<script src="./JavaScript/Platform/Platform.js"></script>

	<!-- Javascript Per il grafico -->
	<script src="./JavaScript/Charts/chart.js"></script>


	<body id="page-top">
		
		<?php
			require("./Templates/_PageWrapper.php");
		?>

	</body>
</html>