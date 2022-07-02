<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="start.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3" style="color:orange;">CavaFerraTanzi</div>
  </a>
  <!-- Divisione -->
  <hr class="sidebar-divider my-0">
  <!-- Primo elemento della dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="#" id="Reload">
      <i class="fas fa-fw fa-home"></i>
      <span style="color:#ffcc00;">Home Page</span>
    </a>
  </li>
  <!-- Divisione -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading" style="color:#ffcc00;"> Utilities </div>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-user"></i>
        <span>Profile</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="py-2 collapse-inner rounded" style="background-color: #ffe835 !important;">
        <h6 class="collapse-header" style="color:#ff5500;">Custom Components:</h6>
        <a class="collapse-item" href="#" id="UsernameSlideBar">Username</a>
        <a class="collapse-item" href="#" id="PasswordSlideBar">Password</a>
        <a class="collapse-item" href="#" id="CreditSlideBar">Credit Card</a>
      </div>
    </div>
  </li>
  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-credit-card"></i>
        <span>PortFolio</span>
      </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="py-2 collapse-inner rounded" style="background-color: #ffe835 !important;">
        <h6 class="collapse-header" style="color:#ff5500;">Azioni Disponibili:</h6>
        <a class="collapse-item" href="#" id="DepositSlideBar" >Deposit Cash</a>
        <a class="collapse-item" href="#" id="WithdrawsSlideBar">Withdraws Cash</a>
      </div>
    </div>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading" style="color:#ffcc00;">Addons</div>
  <!-- Nav Item - Compra Azioni  -->
  <li class="nav-item">
    <a class="nav-link" href="#" id="CompraAzione">
      <i class="fas fa-fw fa-search"></i>
      <span>Compra Azione</span>
    </a>
  </li>
  <!-- Nav Item - Tabella Trasizioni  -->
  <li class="nav-item">
    <a class="nav-link" href="#" id="TransizioniSlideBar">
      <i class="fas fa-fw fa-university"></i>
      <span>Transizioni</span>
    </a>
  </li>
  <!-- Nav Item - Tabella azioni chiuse -->
  <li class="nav-item">
    <a class="nav-link" href="#" id="AzioniDownSlideBar">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Azioni Chiuse</span>
    </a>
  </li>
  <!-- Nav Item - Tabella azioni in esec -->
  <li class="nav-item">
    <a class="nav-link" href="#" id="AzioniUpSlideBar">
      <i class="fas fa-fw fa-line-chart"></i>
      <span>Azioni Esec.</span>
    </a>
  </li>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="py-2 collapse-inner rounded" style="background-color: #ffe835 !important;">
        <h6 class="collapse-header" style="color:#ff5500;" >Login Screens:</h6>
        <a class="collapse-item" href="#" id="LoginSlideBar" data-toggle="modal" data-target="#logoutModal">Login</a>
        <a class="collapse-item" href="#" id="RegisterSlideBar" data-toggle="modal" data-target="#logoutModal">Register</a>
        <a class="collapse-item" href="#" id="ForgotSlideBar" data-toggle="modal" data-target="#logoutModal">Forgot Password</a>
        <div class="collapse-divider"></div>
        <h6 class="collapse-header" style="color:#ff5500;">Other Pages:</h6>
        <a class="collapse-item" href="#" id="404SlideBar">404 Page</a>
        <a class="collapse-item" href="#" id="BlankSlideBar">Blank Page</a>
      </div>
    </div>
  </li>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href=".\\Templates\\Utilities\\Finance.pdf" target="_blank">
      <i class="fas fa-fw fa-question"></i>
      <span>Helps</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->