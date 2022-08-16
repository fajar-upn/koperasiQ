<body class="hold-transition sidebar-mini">
  <div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('anggota'); ?>" role="button">
          <i class="fas fa-user-circle"> Anggota <?php echo $user; ?></i>
        </a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user-circle"> Anggota <?php echo $user; ?></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= base_url('anggota/ubah_password'); ?>">Ubah Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('login/logout'); ?>" role="button">
          <i class="fas fa-sign-out-alt"> Logout</i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('anggota'); ?>" class="brand-link">
      <img src="<?php echo base_url(); ?>assets/dist/img/logokoperasi.png" alt="logokoperasi" class="brand-image">
      <span class="brand-text font-weight-light">KEMBANG LESTARI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url('anggota'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-folder"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="#tampil_simpanan_anggota"><i class="fa fa-angle-right nav-icon"></i><p>Daftar Simpanan</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tampil_pinjaman_anggota"><i class="fa fa-angle-right nav-icon"></i><p>Daftar Pinjaman</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tampil_angsuran_anggota"><i class="fa fa-angle-right nav-icon"></i><p>Daftar Angsuran</p></a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-calculator"></i>
              <p>
                Kalkulator
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('anggota/sim_simpanan')?>"><i class="fa fa-angle-right nav-icon"></i><p>Simulasi Simpanan</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('anggota/sim_pinjaman')?>"><i class="fa fa-angle-right nav-icon"></i><p>Simulasi Pinjaman</p></a>
              </li>
            </ul>
          </li>
        </ul>
        
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  
  <!-- /.content-wrapper -->



