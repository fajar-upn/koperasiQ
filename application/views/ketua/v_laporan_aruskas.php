<div class="content-wrapper">
<div class="container-fluid">
	<div class="shadow-sm card mb-2 p-2">
			<div class="row">
				<div class="col  text-center">
					<h3 class="font-weight-bold">Laporan Arus Kas</h3>
				</div>
			</div>
			<div class="row">
				<div class="col text-center">
					<?php if ($this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
						<h5><?= $nama_bulan?> <?= $tahun?></h5>
					<?php elseif ($this->input->post('tahun_post')) : ?>
						<h5><?=  "Tahun ".$tahun; ?></h5>
					<?php elseif ($this->input->post('tanggal_awal')) : ?>
						<h5><?= $this->input->post('tanggal_awal')." s.d ".$this->input->post('tanggal_akhir') ?></h5>
					<?php else: ?>
						<h5>Tahun <?= $tahun ?></h5>
					<?php endif ?>
				</div>
				
			</div>
			<hr class="m-0 mb-2">
          	<div class="row">
          			<div class="col-1">
          			<form method="post" action="<?= base_url('ketua/cetak_aruskas');?>" target="_blank">
          					<!-- <input type="text" name="akun" id="akun" value="" hidden> -->
          					<?php if ($this->input->post('tanggal_awal') && $this->input->post('akun')) : ?>
          						<input type="text" name="tanggal_awal" value="<?= $t_aw; ?>" hidden>
								<input type="text" name="tanggal_akhir" value="<?=  $t_ak; ?>" hidden>
								<input type="text" name="akun" value="<?= $this->input->post('akun'); ?>" hidden>
								<input type="text" name="kode_akun" value="<?= $this->input->post('kode_akun'); ?>" hidden>
							<?php elseif ($this->input->post('tahun_post') && $this->input->post('akun')) : ?>
								<input type="text" name="tahun_post" value="<?=  $this->input->post('tahun_post'); ?>" hidden>
								<input type="text" name="akun" value="<?= $this->input->post('akun'); ?>" hidden>
								<input type="text" name="kode_akun" value="<?= $this->input->post('kode_akun'); ?>" hidden>
							<?php elseif ( $this->input->post('akun') && $this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
								<input type="text" name="akun" value="<?= $this->input->post('akun'); ?>" hidden>
								<input type="text" name="kode_akun" value="<?= $this->input->post('kode_akun'); ?>" hidden>
								<input type="text" name="tanggal_awal" value="<?= $t_aw; ?>" hidden>
								<input type="text" name="tanggal_akhir" value="<?=  $t_ak; ?>" hidden>

							<?php elseif ($this->input->post('tanggal_awal')): ?>
								<input type="text" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal'); ?>" hidden>
								<input type="text" name="tanggal_akhir" value="<?=  $this->input->post('tanggal_akhir'); ?>" hidden>
							<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) : ?>
								<input type="text" name="bulan_post" value="<?= $this->input->post('bulan_post'); ?>" hidden>
								<input type="text" name="tahun_post" value="<?=  $this->input->post('tahun_post'); ?>" hidden>
							<?php elseif ($this->input->post('tahun_post')) : ?>
							
								<input type="text" name="tahun_post" value="<?=  $this->input->post('tahun_post'); ?>" hidden>
							<?php else: ?>
								<input type="text" name="bulan_post" hidden disabled>
								<input type="text" name="tahun_post" hidden disabled>
								<input type="text" name="tanggal_awal" hidden disabled>
								<input type="text" name="tanggal_akhir" hidden disabled>
							<?php endif ?>
          			<button type="submit" class="btn btn-dark" style=""><i class="d-none d-sm-inline fa fa-file-pdf mr-1"></i>Cetak</button>

          			</form>
          		</div>
          		<div class="col-2">
				     <a class="btn btn-danger" href="<?= base_url('ketua/arus_kas');?>">Reset</a>
				</div>
          		
          
          	<div class="row">
          		<div class="col offset-3">
          			<?= form_error ('tahun_post','<small class="text-danger pl-3">','</small>'); ?> 
          		</div>
          	</div>

		</div>
		<div class="row mt-2">	
		<div class="col-12 col-xl-6">
			<form action="" method="post" class="form-row align-items-center">
						<div class="col-12 mb-2 mb-sm-0 col-sm-5">
							<div class="form ">
					
									<select class="custom-select" id="tahun_post" name="tahun_post">
										<option selected value="">Pilih Tahun</option>

									<?php 
										$i_tahun = 5;
										$tahun_ini = date("Y");
										for ($i=0; $i < $i_tahun ; $i++) : ?>
											<?php if ($tahun_ini-$i == $this->input->post('tahun_post')): ?>
												<option value="<?= $tahun_ini-$i; ?>" selected><?= $tahun_ini-$i; ?></option>
											<?php else: ?>
												<option value="<?= $tahun_ini-$i; ?>" ><?= $tahun_ini-$i; ?></option>
											<?php endif ?>
										
									<?php endfor; ?>
									    
							  		</select>   
						
						  		
							</div>
						</div>
								 
								<div class="col">
									<div class="form">
										<button type="submit" class="btn btn-dark "><i class="fa fa-search"></i></button>
									</div>
								</div>				  
						</form>
		</div>

	          
	          	<div class="row">
	          		<div class="col offset-3">
	          			<?= form_error ('tahun_post','<small class="text-danger pl-3">','</small>'); ?> 
	          		</div>
	          	</div>

	</div>   					  			 
	</div>
    

	<div class="row justify-content-center">
		<div class="col">
		<div class="card p-2 shadow-sm">
			<div class="row">
				<div class="col">
					<div class="table-responsive table-bordered">
						  <table class="table justify-content-center align-self-center">
						  	<thead class="table-primary">
							  	<tr class="font-weight-bold">
							  		<td>Kode Akun</td>
							  		<td>Nama Akun</td>
							  		<td>Nominal</td>
							  	
							  	</tr>
						  	</thead>
						  	<thead>
							  	<tr>
							  		<td style="border: 0px;"><strong>Aktivitas Operasi</strong></td>
							  	</tr>
						  	</thead>
		
					<?php foreach ($pos_nr1 as $a_pos) : ?>
					<?php 
						$klasifikasi_posakun = $this->db->get_where('daftar_akun',['pos_akun' => $a_pos])->result_array();		
					 ?>
						  	<tbody>

						  		

						  		<!-- SALDO AWAL -->

							<!-- PENJUMLAHAN PER POS AKUN -->
								<?php $total = array() ?>
							
									<?php foreach ($klasifikasi_posakun as $ap ): ?>
										<?php 

								if ($this->input->post('tanggal_awal')) {
						  		
									  		if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

									  		

								  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(debit) as total');
												$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$debit =  $deb;
												$kredit =  $kre;

									  		} else {

									  				// total saldo awal
									  			
									  				// data sebelum bulan post
									  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
										  		$this->db->select('SUM(debit) as total');
												$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													// data bulan post
												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
										  		$this->db->select('SUM(debit) as total');
												$deb_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
												$this->db->select('SUM(kredit) as total');
												$kre_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$debit = $deb + $deb_b ;
												$kredit = $kre + $kre_b ;

									  		}

						  	} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

												if ($this->input->post('bulan_post') != 1) {

													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;

												} else {

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);  
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												}
												
											} else {

												if ($bulan != 1 ) {
													 
													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;


												} else {

													if ($this->input->post('tahun_post')) {
														$this->db->where('year(tanggal_transaksi)',$tahun);
													
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													} else {
														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													}								

												}
												

											}

										// Bulan Ini

												if ($ap['saldo_normal'] == 'Kredit') {
													$total[$ap['akun']] = $kredit - $debit ;
												} else {
													$total[$ap['akun']] = $kredit - $debit ;
												}
				
										?>			
									<?php endforeach;?>									
							  		
								<?php if ($a_pos == 'Pendapatan'): ?>
									<?php foreach ($klasifikasi_posakun as $al): ?>
											<tr>	
								  				<td><?= $al['kode_akun'];?></td>
								  				<td><?= $al['akun'];?></td>
							  					<td><?= rupiah($total[$al['akun']]); ?></td>
							  					<?php $totalp[] = $total[$al['akun']];?>
											</tr>
							  	<?php endforeach ?>

								<?php endif ?>

								<?php if ($a_pos == 'Beban'): ?>
									<?php foreach ($klasifikasi_posakun as $al): ?>
											<tr>	
								  				<td><?= $al['kode_akun'];?></td>
								  				<td><?= $al['akun'];?></td>
							  					<td><?= rupiah($total[$al['akun']]); ?></td>
							  					<?php $totalb[] = $total[$al['akun']]; ?>
											</tr>
							  	<?php endforeach ?>

								<?php endif ?>

								<?php if ($a_pos == 'Aset Lancar'): ?>
									<?php foreach ($klasifikasi_posakun as $al): ?>
										<?php if ($al['akun'] != 'Kas' && $al['akun'] != 'Bank'): ?>
											<tr>	
								  				<td><?= $al['kode_akun'];?></td>
								  				<td><?= $al['akun'];?></td>
							  					<td><?= rupiah($total[$al['akun']]); ?></td>
							  					<?php $totala[] = $total[$al['akun']]; ?>
											</tr>
											<?php endif ?>
							  	<?php endforeach ?>

								<?php endif ?>

								<?php if ($a_pos == 'Kewajiban'): ?>
									<?php foreach ($klasifikasi_posakun as $al): ?>
											<tr>	
								  				<td><?= $al['kode_akun'];?></td>
								  				<td><?= $al['akun'];?></td>
							  					<td><?= rupiah($total[$al['akun']]); ?></td>
							  					<?php $totalk[] = $total[$al['akun']]; ?>
											</tr>
							  	<?php endforeach ?>
							  	<?php $tp = array_sum($totalp); $tb = array_sum($totalb); $tal = array_sum($totala); $tk = array_sum($totalk); ?>
							  	<tr style="background-color: #D7ECD9";>
									<td></td>
									<td><b>Jumlah Arus Kas Dari Aktivitas Operasi</b></td>
									<td><?= rupiah($tp + $tb + $tal + $tk); ?></td>
						
								</tr>

								<?php endif ?>
								
					<?php endforeach; ?>

					<thead>
						<tr>
							<td style="border: 0px;"><strong>Aktivitas Investasi</strong></td>
						</tr>
					</thead>

					<?php foreach ($pos_nr2 as $a_pos) : ?>
					<?php 
						$klasifikasi_posakun = $this->db->get_where('daftar_akun',['pos_akun' => $a_pos])->result_array();		
					 ?>
						  	<tbody>

							<!-- PENJUMLAHAN PER POS AKUN -->
								<?php $total = array() ?>
							
									<?php foreach ($klasifikasi_posakun as $ap ): ?>
										<?php 

								if ($this->input->post('tanggal_awal')) {
						  		
									  		if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

									  		

								  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(debit) as total');
												$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$debit =  $deb;
												$kredit =  $kre;

									  		} else {

									  				// total saldo awal
									  			
									  				// data sebelum bulan post
									  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
										  		$this->db->select('SUM(debit) as total');
												$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													// data bulan post
												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
										  		$this->db->select('SUM(debit) as total');
												$deb_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
												$this->db->select('SUM(kredit) as total');
												$kre_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$debit = $deb + $deb_b ;
												$kredit = $kre + $kre_b ;

									  		}

						  	} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

												if ($this->input->post('bulan_post') != 1) {

													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;

												} else {

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);  
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												}
												
											} else {

												if ($bulan != 1 ) {
													 
													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;


												} else {

													if ($this->input->post('tahun_post')) {
														$this->db->where('year(tanggal_transaksi)',$tahun);
													
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													} else {
														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													}								

												}
												

											}

										// Bulan Ini

												if ($ap['saldo_normal'] == 'Kredit') {
													$total[$ap['akun']] = $kredit - $debit ;
												} else {
													$total[$ap['akun']] = $kredit - $debit ;
												}
				
										?>			
									<?php endforeach;?>									

								<?php if ($a_pos == 'Aset Tetap'): ?>
									<?php foreach ($klasifikasi_posakun as $al): ?>
										<?php if ($al['akun'] == 'Inventaris'): ?>
											<tr>	
								  				<td><?= $al['kode_akun'];?></td>
								  				<td><?= $al['akun'];?></td>
							  					<td><?= rupiah($total[$al['akun']]); ?></td>
							  					<?php $totalat[] = $total[$al['akun']]; ?>
											</tr>
											<?php endif ?>
							  	<?php endforeach ?>
							  	<?php $tat = array_sum($totalat); ?>
							  	<tr style="background-color: #D7ECD9";>
									<td></td>
									<td><b>Jumlah Arus Kas Dari Aktivitas Investasi</b></td>
									<td><?= rupiah($tat); ?></td>
						
								</tr>

								<?php endif ?>
								
					<?php endforeach; ?>

					<thead>
						<tr>
							<td style="border: 0px;"><strong>Aktivitas Pendanaan</strong></td>
						</tr>
					</thead>

					<?php foreach ($pos_lr as $a_pos) : ?>
					<?php 
						$klasifikasi_posakun = $this->db->get_where('daftar_akun',['pos_akun' => $a_pos])->result_array();		
					 ?>
						  	<tbody>

							<!-- PENJUMLAHAN PER POS AKUN -->
								<?php $total = array() ?>
							
									<?php foreach ($klasifikasi_posakun as $ap ): ?>
										<?php 

								if ($this->input->post('tanggal_awal')) {
						  		
									  		if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

									  		

								  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(debit) as total');
												$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$debit =  $deb;
												$kredit =  $kre;

									  		} else {

									  				// total saldo awal
									  			
									  				// data sebelum bulan post
									  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
										  		$this->db->select('SUM(debit) as total');
												$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													// data bulan post
												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
										  		$this->db->select('SUM(debit) as total');
												$deb_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
												$this->db->select('SUM(kredit) as total');
												$kre_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$debit = $deb + $deb_b ;
												$kredit = $kre + $kre_b ;

									  		}

						  	} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

												if ($this->input->post('bulan_post') != 1) {

													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;

												} else {

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);  
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												}
												
											} else {

												if ($bulan != 1 ) {
													 
													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;


												} else {

													if ($this->input->post('tahun_post')) {
														$this->db->where('year(tanggal_transaksi)',$tahun);
													
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													} else {
														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													}								

												}
												

											}

										// Bulan Ini

												if ($ap['saldo_normal'] == 'Kredit') {
													$total[$ap['akun']] = $kredit - $debit ;
												} else {
													$total[$ap['akun']] = $kredit - $debit ;
												}
				
										?>			
									<?php endforeach;?>									

								<?php if ($a_pos == 'Ekuitas'): ?>
									<?php foreach ($klasifikasi_posakun as $al): ?>
											<tr>	
								  				<td><?= $al['kode_akun'];?></td>
								  				<td><?= $al['akun'];?></td>
							  					<td><?= rupiah($total[$al['akun']]); ?></td>
							  					<?php $totalek[] = $total[$al['akun']]; ?>
											</tr>
							  	<?php endforeach ?>
							  	<?php $tek = array_sum($totalek); ?>
							  	<tr style="background-color: #D7ECD9";>
									<td></td>
									<td><b>Jumlah Arus Kas Dari Aktivitas Pendanaan</b></td>
									<td><?= rupiah($tek); ?></td>
						
								</tr>

								<?php endif ?>
								<tr style="background-color: #D7ECD9";>
									<td></td>
									<td><b>Total Seluruh Aktivitas</b></td>
									<td><?= rupiah($tp + $tb + $tal + $tk + $tat + $tek); ?></td>
						
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr style="background-color: #D7ECD9";>
									<td></td>
									<td><b>Kas & Bank 1 Januari <?= $tahun ?></b></td>
									<td><?= rupiah($saldo_awal['saldo_awal']); ?></td>
								</tr>

								<tr style="background-color: #D7ECD9";>
									<td></td>
									<td><b>Kas & Bank 31 Desember <?= $tahun ?></b></td>
									<td><?= rupiah(($tp + $tb + $tal + $tk + $tat + $tek) + $saldo_awal['saldo_awal']); ?></td>
								</tr>
								
					<?php endforeach; ?>

						  	</tbody>
						  </table>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>

</div>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){

		$("#enable_bulan").click(function(){
					if ($('#bulan_post').attr('disabled')) {
					
						$('#bulan_post').removeAttr('disabled');
					
					} else {
					
						$('#bulan_post').attr('disabled', 'disabled');

					}
			
			});

	

	});

</script>

