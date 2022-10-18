<div class="content-wrapper">
	<div class="container-fluid" style="padding: 20px 30px 30px 30px">
			
		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
		</div>
		<div class="info-box">
			<span class="info-box-icon bg-info" style="width: 300px"><i class="far fa-envelope"> </i> Kas Koperasi</span>

			<div class="info-box-content">
				<span class="info-box-number">1,410</span>
			</div>
			<!-- /.info-box-content -->
		</div>

		<!-- Content Row -->
		<div class="row">
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card card-primary" style="border-radius: 15px 15px 10px 10px">
					<div class="card-header" style="border-radius: 15px 15px 0px 0px; background-color: #032d53">
						<h3 class="card-title">Anggota Aktif</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"> </button>
						</div>
					</div>
					<div class="card-body" style="border-radius: 15px 15px 10px 10px">
								<i class="fas fa-user fa-2x text-gray-300"></i>
								<?= $anggota_a?> Anggota
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card card-primary" style="border-radius: 15px 15px 10px 10px">
					<div class="card-header" style="border-radius: 15px 15px 0px 0px; background-color: #032d53">
						<h3 class="card-title">Anggota Tidak Aktif</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"> </button>
						</div>
					</div>
					<div class="card-body" style="border-radius: 15px 15px 10px 10px">
							<i class="fas fa-times fa-2x text-gray-300"></i>
								<?= $anggota_t ?> Anggota
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card card-primary" style="border-radius: 15px 15px 10px 10px">
					<div class="card-header" style="border-radius: 15px 15px 0px 0px; background-color: #032d53">
						<h3 class="card-title">Total Simpanan</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"> </button>
						</div>
					</div>
					<div class="card-body" style="border-radius: 15px 15px 10px 10px">
						<i class="fas fa-upload fa-2x text-gray-300"></i>
								<?= rupiah2($simpanan['simpanan']) ?>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card card-primary" style="border-radius: 15px 15px 10px 10px">
					<div class="card-header" style="border-radius: 15px 15px 0px 0px; background-color: #032d53">
						<h3 class="card-title">Total Pinjaman</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"> </button>
						</div>
					</div>
					<div class="card-body" style="border-radius: 15px 15px 10px 10px">
					<i class="fas fa-download fa-2x text-gray-300"></i>
								<?= rupiah2($pinjaman['pinjaman']) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
