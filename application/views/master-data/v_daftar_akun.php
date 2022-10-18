<div class="content-wrapper">
	<!-- <div class="container">
		<div class="row" style="padding-top: 20px"> -->
			<!-- <div class="col-12 col-sm-12">
				<div class="card card-primary card-outline card-tabs">
					<div class="card-header p-0 pt-1 border-bottom-0">
						<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Home</a>
							</li>
							<li class="nav-item">
							</li>
							<li class="nav-item">
								<a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Messages</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Settings</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content" id="custom-tabs-three-tabContent">
							<div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur. 
							</div>
							<div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
									Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. 
							</div>
							<div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
									Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
							</div>
							<div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
									Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. 
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="h3 mb-0 text-gray-800">Daftar Akun</h1>
						</div>
					</div>
					<div class="row">
			
							<?php if ($this->session->flashdata('pesan_sukses')) : ?>
								
									<div class="col-6">
										<div class="alert alert-success alert-dismissible fade show" role="alert">
												Data Akun<strong> Berhasil </strong> <?= $this->session->flashdata('pesan_sukses'); ?>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
										</div>
									</div>
							
					<?php endif; ?>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="row mt-2">
										<div class="col">
											<div class="row mt-2">
												<div class="col-2" style="color: #2679c2;">
													<a role="button" href="<?= base_url();?>admin/tambah_daftarakun" class="btn btn-primary" style="width: 100%;">Tambah Data</a>
												</div>
												<div class="col-2">
													<a role="button" href="<?= base_url();?>admin/cetak_daftarakun" class="btn btn-secondary" target="_blank"><i class="fa fa-file-pdf"></i> Cetak</a>
											</div>
										</div>
									</div>
								</div>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr class="table-primary">
												<th width="">Kode Akun</th>
												<th width="">Akun Perkiraan</th>
												<th width="">Pos Akun</th>
												<th width="">Pos Laporan</th>
												<th width="">Saldo Normal</th>
												<th width="10%">Aksi</th>
											</tr>
										</thead>
										<tbody>
													<?php foreach ($daftar_akun as $da ) : ?>
													<tr>
														<td><?= $da['kode_akun']?></td>
														<td><?= $da['akun'] ?></td>
														<td><?= $da['pos_akun'] ?></td>
														<td><?= $da['pos_laporan'] ?></td>
														<td><?= $da['saldo_normal'] ?></td>
														<td class="d-flex align-items-center">
															<a href="<?= base_url(); ?>admin/ubahDaftarakun/<?= $da['kode_akun']; ?>" class="btn-sm btn-success"><i class="fa fa-pen"></i></a>
															<a href="<?= base_url(); ?>admin/hapusDaftarakun/<?= $da['kode_akun'];?>" class="btn-sm btn-danger ml-1"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
													<?php endforeach; ?>
												</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		<!-- </div>
	</div> -->
</div>

