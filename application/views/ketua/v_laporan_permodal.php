<div class="content-wrapper">
<div class="container-fluid">
	<div class="shadow-sm card mb-2 p-2">
			<div class="row">
				<div class="col  text-center">
					<h3 class="font-weight-bold">Laporan Perubahan Modal</h3>
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
						<h5><?= $nama_bulan?> <?= $tahun ?></h5>
					<?php endif ?>
				</div>
				
			</div>
			<hr class="m-0 mb-2">
          	<div class="row">
          			<div class="col-1">
          			<form method="post" action="<?= base_url('ketua/cetak_permodal');?>" target="_blank">
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
          			<button type="submit" class="btn btn-secondary" style=""><i class="d-none d-sm-inline fa fa-file-pdf mr-1"></i>Cetak</button>

          			</form>
          		</div>
          		<div class="col-2">
				     <a class="btn btn-danger" href="<?= base_url('ketua/per_modal');?>">Reset</a>
				</div>
          		
          
          	<div class="row">
          		<div class="col offset-3">
          			<?= form_error ('tahun_post','<small class="text-danger pl-3">','</small>'); ?> 
          		</div>
          	</div>

		</div>
		<div class="row mt-2">	
		<!-- <div class="col-12 col-xl-6">
			<form method="post" class="form-row align-items-center">
				<div class="col-12 col-sm-5 mb-2 mb-xl-0">
						<div class="form">
						    <input type="date" class="form-control" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal') ?>">
						</div>
				</div>
				<div class="d-none d-sm-block" style="width: 27px;">
				s/d
				</div>
				<div class="col-12 col-sm-5 mb-2 mb-xl-0">
					  	<div class="form">
					    	<input type="date" class="form-control" name="tanggal_akhir" value="<?= $this->input->post('tanggal_akhir') ?>">
					  	</div>
				</div>
				<div class="col mb-2 mb-xl-0">
					 	<div class="form ">
					  		<button type="submit" class="btn btn-dark"><i class="fa fa-search"></i></button>
					  	</div>
				</div>
							  
			</form> 
		</div> -->
		<div class="col-12 col-xl-6">
			<form action="" method="post" class="form-row align-items-center">
						<div class="col-10 mb-2 mb-sm-0 col-sm-5">
							<div class="form">
								<select class="custom-select" id="bulan_post" name="bulan_post" disabled>
								    <option selected>Pilih Bulan</option>
								<?php foreach ($dd_bulan as $dd_bulan): ?>
									<?php if ($dd_bulan['angka'] == $this->input->post('bulan_post')): ?>
										<option value="<?= $dd_bulan['angka'] ?>" selected><?= $dd_bulan['bulan'] ?></option>
									<?php else: ?>
										<option value="<?= $dd_bulan['angka'] ?>"><?= $dd_bulan['bulan'] ?></option>
									<?php endif ?>
								<?php endforeach ?>
								   
						  		</select>
							</div>									    			
						</div>
				
		          		<div class=""  style="width: 27px;">
	          				<div class="form-check mb-4">
							  <input class="form-check-input" type="checkbox" value="" id="enable_bulan">
							</div>
						</div>	
										  	
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
							  		<td>Saldo Awal</td>
							  		<td>Penambahan</td>
							  		<td>Saldo Akhir</td>
							  	
							  	</tr>
						  	</thead>

			<!-- START PERULANGAN UNTUK PER POS AKUN -->

					<!-- KEWAJIBAN DAN EKUITAS -->
									
					<!-- Batas Coba -->
					<?php $jumlah_ek1 = array(); ?>
		
					<?php foreach ($pos_nr2 as $a_pos) : ?>
					<?php 
						$klasifikasi_posakun = $this->db->get_where('daftar_akun',['pos_akun' => $a_pos])->result_array();		
					 ?>
						  	<tbody>

						  		

						  		<!-- SALDO AWAL -->
							
								<?php $total_saek = array() ?>
							
									<?php foreach ($klasifikasi_posakun as $ap ): ?>
										<?php 

										// Bulan INI
										// MENJUMLAH NOMINAL DARI SETIAP AKUN MENURUT POS AKUN

												$date = $tahun;
												$this->db->where('year(tanggal_transaksi)',$date);
												// $this->db->where('month(tanggal_transaksi)',$month);
												$this->db->select('SUM(debit) as total');
												$debit = $this->db->get_where('saldo_awal',['akun' => $ap['akun']])->row()->total;

												$this->db->where('year(tanggal_transaksi)',$date);
												// $this->db->where('month(tanggal_transaksi)',$month);
												$this->db->select('SUM(kredit) as total');
												$kredit = $this->db->get_where('saldo_awal',['akun' => $ap['akun']])->row()->total;

										
											
											
												if ($ap['saldo_normal'] == 'Kredit') {
													$total_saek[$ap['akun']] = $kredit - $debit ;
												} else {
													$total_saek[$ap['akun']] = $kredit - $debit ;
												}
											
								
										?>

									<?php endforeach; ?>

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
									<?php $i=0; foreach ($klasifikasi_posakun as $al): ?>
										<?php if ($al['akun'] != 'SHU Belum Dibagi/SHU Tahun Berjalan'): ?>
											<tr>	
								  				<td><?= $al['kode_akun'];?></td>
								  				<td><?= $al['akun'];?></td>
								  				<td><?= rupiah($saldo_awal[$i]['saldo_awal']); ?></td>
							  					<td><?= rupiah($total[$al['akun']] + $total_saek[$al['akun']]-$saldo_awal[$i]['saldo_awal']); ?></td>
							  					<td><?= rupiah($total[$al['akun']] + $total_saek[$al['akun']]); ?></td>
							  					<?php $totalpm[] = abs($total[$al['akun']] + $total_saek[$al['akun']]); ?>
											</tr>
										<?php else : ?>
											<tr>	
								  				<td><?= $al['kode_akun'];?></td>
								  				<td><?= $al['akun'];?></td>
								  				<td><?= rupiah(0) ?></td>
								  				<td><?= rupiah(0); ?></td>
							  					<td><?= rupiah($lr); ?></td>
											</tr>
											<?php endif ?>
											<?php $i++; ?>
							  	<?php endforeach ?>
							  	<tr style="background-color: #D7ECD9";>
									<td></td>
									<td>Total Perubahan Modal</td>
									<td></td>
									<td></td>
									<td><?= rupiah(array_sum($totalpm)+$lr); ?></td>
						
								</tr>

								<?php endif ?>
								
					<?php endforeach; ?>
								<!-- <?php print_r($jumlah_ek1); ?> -->
								<!-- <tr style="background-color: #D7ECD9";>
									<td></td>
									<td>Jumlah Total Kewajiban + Ekuitas</td>
									<td><?= rupiah(array_sum($jumlah_ek1)); ?></td>
						
								</tr> -->
			<!-- END PERULANGAN PER POS AKUN -->

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

