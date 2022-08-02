
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

  padding: 10px 10px;
  background: #000066;
  color: #fff;
   border: 2px solid #e0e0e0;
}

table td {
  padding: 10px 10px;
  border: 2px solid #e0e0e0;
}

h4 {
	margin-top: 5px;
	margin-bottom: 5px;
}

#header{
			font-family: Arial, Helvetica, sans-serif;
			width:100%; /* Digunakan untuk mengatur lebar header */
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
				<h2>Daftar Simpanan</h2>
				<h3>"<?= $anggota[0]['nama'] ?>"</h3>
				<h4>Periode 31 Desember <?= $tahun ?></h4>
				<h2 style="margin-bottom: 30%;"></h2>
	</div>
	
			<div>
				<table cellspacing="0">
				  
					<tr>
						<th width="20%">Total Simpanan Pokok</th>
                        <th width="20%">Total Simpanan Wajib</th>
                        <th width="20%">Total Simpanan Sukarela</th>
                        <th width="20%">Total Tabungan Lebaran</th>
                        <th width="20%">Total Simpanan</th>
					</tr>
					<?php foreach ($anggota as $da ) : ?>
                        <tr>
                          <td><b><?= rupiah2($da['simpanan_pokok']) ?></b></td>
                          <td><b><?= rupiah2($da['simpanan_wajib']) ?></b></td>
                          <td><b><?= rupiah2($da['simpanan_sukarela']) ?></b></td>
                          <td><b><?= rupiah2($da['simpanan_lebaran']) ?></b></td>
                          <td><b><?= rupiah2($da['simpanan_pokok']+$da['simpanan_wajib']+$da['simpanan_sukarela']+$da['simpanan_lebaran']) ?></b></td>
                        </tr>
                        <?php endforeach; ?>
				</table>
			</div>

			<div>
				<table style="margin-top: 2%;" cellspacing="0">
				  
					<tr>
						<th>Bukti Transaksi</th>
                        <th>Saldo</th>
                        <th>Jenis Simpanan</th>
                        <th>Tanggal</th>
					</tr>
					<?php foreach ($anggota1 as $da ) : ?>
                        <tr>
                          <td><?= $da['bukti_transaksi_s'] ?></td>
                          <td><?= rupiah2($da['saldo']) ?></td>
                          <td><?= $da['jenis_simpanan'] ?></td>
                          <td><?= $da['tanggal'] ?></td>
                        </tr>
                        <?php endforeach; ?>
				</table>
			</div>

</body></html>
