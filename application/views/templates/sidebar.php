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
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('admin'); ?>" role="button">
          <i class="fas fa-user-circle"> Bendahara <?php echo $user; ?></i>
        </a>
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
    <a href="<?php echo base_url('admin'); ?>" class="brand-link">
      <img src="<?php echo base_url(); ?>assets/dist/img/logokoperasi.png" alt="logokoperasi" class="brand-image">
      <span class="brand-text font-weight-light">KEMBANG LESTARI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url('admin'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-cog"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/daftar_akun')?>"><i class="fa fa-angle-right nav-icon"></i><p>Daftar Akun</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/data_anggota')?>"><i class="fa fa-angle-right nav-icon"></i><p>Daftar Anggota</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/saldo_awal')?>"><i class="fa fa-angle-right nav-icon"></i><p>Saldo Awal</p></a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-database"></i>
              <p>
                Input Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/simpanan')?>"><i class="fa fa-angle-right nav-icon"></i><p>Simpanan</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/pinjaman')?>"><i class="fa fa-angle-right nav-icon"></i><p>Pinjaman</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/angsuran')?>"><i class="fa fa-angle-right nav-icon"></i><p>Angsuran</p></a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-calculator"></i>
              <p>
                Akuntansi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/jurnal_umum')?>"><i class="fa fa-angle-right nav-icon"></i><p>Jurnal Umum</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/jurnal_penyesuaian')?>"><i class="fa fa-angle-right nav-icon"></i><p>Jurnal Penyesuaian</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/buku_besar')?>"><i class="fa fa-angle-right nav-icon"></i><p>Buku Besar</p></a>
              </li>
            </ul>
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
                <a class="nav-link" href="<?php echo base_url('admin/tampil_simpanan')?>"><i class="fa fa-angle-right nav-icon"></i><p>Daftar Simpanan</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/tampil_pinjaman')?>"><i class="fa fa-angle-right nav-icon"></i><p>Daftar Pinjaman</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/tampil_angsuran')?>"><i class="fa fa-angle-right nav-icon"></i><p>Daftar Angsuran</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/laporan_shu')?>"><i class="fa fa-angle-right nav-icon"></i><p>Laporan SHU</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/shu_anggota')?>"><i class="fa fa-angle-right nav-icon"></i><p>Laporan SHU Anggota</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/per_modal')?>"><i class="fa fa-angle-right nav-icon"></i><p>Laporan Per. Modal</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/poskeu')?>"><i class="fa fa-angle-right nav-icon"></i><p>Laporan Posisi Keuangan</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/arus_kas')?>"><i class="fa fa-angle-right nav-icon"></i><p>Laporan Arus Kas</p></a>
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



