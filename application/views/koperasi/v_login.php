<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Koperasi Wanita Kembang Lestari</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page" style="background-image: linear-gradient(to bottom right, #08b184, #2679c2);">

	<div class="login-box" style="padding-left:-40px">
		<!-- <div class="login-logo">
			<a href="<?php echo base_url().'admin/'; ?>"><b>KOPERASI WANITA KEMBANG LESTARI</b></a>
		</div> -->
		<!-- /.login-logo -->
			<div class="card" style="border-radius: 15px;">
				<div class="card-body login-card-body" style="border-radius: 15px">
					<p class="login-box-msg text-left" style="color: #2677c3; font-size: 16pt;"><strong>Masuk Admin </strong> Koperasi-<strong>Q</strong></p>

					<form action="<?php echo base_url().'login/aksi_login/'; ?>" method="post" enctype="multipart/form-data">
							<label for="username" style="color: #2677c3; font-size: 12pt;">Email </label>
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="" name="username" required>
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-user"></span>
								</div>
							</div>
						</div>
							<label for="pass" style="color: #2677c3; font-size: 12pt;">Password </label>
						<div class="input-group mb-3">
							<input type="password" class="form-control" placeholder="" name="password" required>
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
						</div>
						<div class="text-right">
              <input type="checkbox" id="remember">
              <label for="remember" style="color: #2679c2;  font-size: 12pt;"> Ingat Saya </label>
							</div>
						<div class="row">
							<!-- /.col -->
							<div class="col-2">

							</div>
							<div class="col-8" style="color: #2679c2;">
								<button type="submit" class="btn btn-primary btn-block">Masuk</button><br>
								<div class="text-center">
									<a href="#" style="color: #2679c2;">Lupa Kata Sandi?</a>
									<p style="color:grey">Belum Punya Akun?<a href="#" style="color: #2679c2;">Daftar</a></p>
								</div>
							</div>
							<div class="col-2"></div>
							<!-- /.col -->
						</div>
					</form>
				</div>
				<!-- /.login-card-body -->
			</div>

	</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
</body>
</html>
