<!-- Page Wrapper -->
<div id="wrapper" class="colorSfondoMainContent">

    <!-- Stampo la SIDEBAR -->
	<?php
		require("./Templates/SideBar/SideBar.php");
	?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="colorSfondoMainContent d-flex flex-column">	

      <!-- Main Content -->
      <div id="content" class="colorSfondoMainContent">
			<!-- Stampo la TOPBAR -->
			<?php
				require("./Templates/ContentWrapper/MainContent/TopBar/TopBar.php");
			?>
			<div id="contentModificabile">
				<!-- Stampo la DASHBOARD -->
				<?php
				require($_SESSION['ApriPaginaPost']);
				?>
			</div>
      </div>
	  
      	<!-- Stampo il FOOTER -->
		<?php
			require("./Templates/ContentWrapper/Footer/Footer.php");
		?>

    </div>
</div>

<!-- Stampo SCROLLTOPBUTTON -->
<?php
	require("./Templates/Utilities/ScrollTopButton.php");
?>

<!--Stampo il LOGOUTMODAL -->
<?php
	require("./Templates/Utilities/LogoutModal.php");
?>