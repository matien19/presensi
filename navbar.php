  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-dark" style="background-color:#86090f">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i> [
          <?php echo $_SESSION['peran']." ] - Assalamu'alaikum, ".$_SESSION['nama'];?> 
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-book"></i> Manual Book
          </a>
          <div class="dropdown-divider"></div>
          <a href="../ganti_pw" class="dropdown-item">
            <i class="fas fa-lock"></i> Ganti Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="../auth/logout.php" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i>Keluar
          </a>

   
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-red elevation-4" style="background-color:#ffffff">
    <!-- Brand Logo -->
    <font color:"white">
    <a href="index3.html" class="brand-link">
      <img src="../img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PRESENSI MHS</span>
    </a>
    </font>
