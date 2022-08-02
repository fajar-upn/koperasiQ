
<!DOCTYPE html>
<html><head>
	<title></title>
</head><style>
	h1{
		text-align: center;
 	 	font-family: sans-serif;
  		margin-bottom: 0px;
}
div { 
 text-align: center;
}

.rata-kanan {
	text-align: right;
}
table {
 

  width: 100%;
  border-collapse: collapse;
  margin-left:auto; /* Digunakan untuk mengatur jarak header dengan tepian layar secara otomatis */
  margin-right:auto; /* Sehingga tampilan header website akan berada tepat di tengah-tengah layar monitor */
}

table th {

  padding: 7px 5px;
  background: #000066;
  color: #fff;
  border: 2px solid #e0e0e0;
}

table td {
  padding: 7px 5px;
  border: 2px solid #e0e0e0;
}

 
table tr {

}

h4 {
	margin-top: 5px;
	margin-bottom: 5px;
}

h3 {
	text-align: center;
}
#header{
			font-family: Arial, Helvetica, sans-serif;
			width: 100%; /* Digunakan untuk mengatur lebar header */
			height: 105px;
			margin-left:auto; /* Digunakan untuk mengatur jarak header dengan tepian layar secara otomatis */
			margin-right:auto; /* Sehingga tampilan header website akan berada tepat di tengah-tengah layar monitor */
		}
	
</style><body>
	<div id="header">
				<h2 style="margin-top: 0px;">Koperasi Wanita "Kembang Lestari"</h2>
				<h5 style="margin-top: 0px;">Badan Hukum No.514/BH/XVI.13/III/2010,Tanggal 24/03/2010</h5>
				<h5 style="margin-top: 0px;">Alamat: Desa Kembangan Kecamatan Sukomoro Kabupaten Magetan</h5>
				<h5 style="margin-top: 0px;">Kabupaten Magetan</h5>
				<hr style="background-color: #000;">
				<h2 style="margin-top: 2px; margin-bottom: 0px;">Laporan Perubahan Modal</h2>
					<?php if ($this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?= $nama_bulan?> <?= $tahun?></h3>
					<?php elseif ($this->input->post('tahun_post')) : ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?=  "Tahun ".$tahun; ?></h3>
					<?php elseif($this->input->post('tanggal_awal')) : ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?=  $this->input->post('tanggal_awal')." s.d ".$this->input->post('tanggal_akhir'); ?></h3>
					<?php else: ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;">Tahun <?= $tahun ?></h3>
					<?php endif ?>
				<h2 style="margin-bottom: 20%;"></h2>
	</div>
	
			<div>
				<table cellspacing="0">

						  	<tr class="font-weight-bold">
							  		<th width="8%">Kode Akun</th>
							  		<th width="20%">Nama Akun</th>
							  		<th>Saldo Awal</th>
							  		<th>Penambahan</th>
							  		<th>Saldo Akhir</th>
							  	</tr>
					 

		<!-- START PERULANGAN UNTUK PER POS AKUN -->
		<?php $jumlah_ek1 = array(); ?>
		
					<?php foreach ($pos_nr2 as $a_pos) : ?>
					<?php 
						$klasifikasi_posakun = $this->db->get_where('daftar_akun',['pos_akun' => $a_pos])->result_array();		
					 ?>
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
								  				<td><?= rupiah_cetak($saldo_awal[$i]['saldo_awal']); ?></td>
							  					<td><?= rupiah_cetak($total[$al['akun']] + $total_saek[$al['akun']]-$saldo_awal[$i]['saldo_awal']); ?></td>
							  					<td><?= rupiah_cetak($total[$al['akun']] + $total_saek[$al['akun']]); ?></td>
							  					<?php $totalpm[] = abs($total[$al['akun']] + $total_saek[$al['akun']]); ?>
											</tr>
										<?php else : ?>
											<tr>	
								  				<td><?= $al['kode_akun'];?></td>
								  				<td><?= $al['akun'];?></td>
								  				<td><?= rupiah_cetak(0) ?></td>
								  				<td><?= rupiah_cetak(0); ?></td>
							  					<td><?= rupiah_cetak($lr); ?></td>
											</tr>
											<?php endif ?>
											<?php $i++; ?>
							  	<?php endforeach ?>
							  	<tr style="background-color: #D7ECD9";>
									<td></td>
									<td>Total Perubahan Modal</td>
									<td></td>
									<td></td>
									<td><?= rupiah_cetak(array_sum($totalpm)+$lr); ?></td>
						
								</tr>

								<?php endif ?>
								
					<?php endforeach; ?>
				</table>
			</div>

</body></html>


 