<?php
/** SCRIPT DI INCLUSIONE DEI DOCUMENTI **/
  
  error_reporting(E_ERROR | E_PARSE);
  session_start();

  require_once("./Includes/utility.php");
  require_once("./Includes/constants.php");
  require_once("./Includes/functions.php");

  $_SESSION['ApriPaginaPost'] = "./Templates/ContentWrapper/MainContent/DashBoard/DashBoard.php";
  
  $link = mysqli_connect(SERVER, USERNAME,PASSWORD, DATABASE);

if($_SESSION['ApriPaginaPost'] != "./Templates/ContentWrapper/MainContent/DashBoard/DashBoard.php")
{
  try{header("location: ..\..\..\..\start.php"); exit;}
  catch(exception $e){ header("location: .\start.php"); exit;}
}
?>
<!-- Begin Page Content -->
<div class="container-fluid colorSfondoDashBoard">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 colorTitle">Dashboard</h1>
  </div>
  <!-- Content Row -->
  <div class="row">
    <!-- Card del Saldo -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-success text-uppercase mb-1">saldo totale</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
                <?php 
                  $sql  = "SELECT saldo FROM utente WHERE Username='". $_SESSION['username'] ."';";
                  $result = query($sql);
                  foreach ($result[0] as $key=>$value) 
                    echo $value;
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
    <!-- Card del numero di transizioni -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">num. transazioni</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
                <?php 
                  $sql  = "SELECT COUNT(Username_Utente) FROM transizioni WHERE Username_Utente='". $_SESSION['username'] ."';";
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
    <!-- Card num Azioni chiuse -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-success text-uppercase mb-1">num. azioni chiuse</div>
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
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Card num Azioni in esec -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-info text-uppercase mb-1">num. azioni in esec.</div>
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
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content Row -->
  <div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-auto">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-dashboard">TABELLA DI PROVA</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Informazioni sul Progetto -->
  <?php
      require("./Templates/ContentWrapper/MainContent/DashBoard/InfoDashBoard.php");
  ?>
  