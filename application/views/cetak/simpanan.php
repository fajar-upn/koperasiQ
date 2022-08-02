
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
				<h2>Daftar Simpanan Anggota</h2>
				<h4>Periode 31 Desember <?= $tahun ?></h4>
				<h2 style="margin-bottom: 17%;"></h2>
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
					<tr>
						<td><b><?= rupiah2($total[0]['tsimpanan_pokok']) ?></b></td>
                        <td><b><?= rupiah2($total[0]['tsimpanan_wajib']) ?></b></td>
                        <td><b><?= rupiah2($total[0]['tsimpanan_sukarela']) ?></b></td>
                        <td><b><?= rupiah2($total[0]['tsimpanan_lebaran']) ?></b></td>
                        <td><b><?= rupiah2($total[0]['tsimpanan_pokok']+$total[0]['tsimpanan_wajib']+$total[0]['tsimpanan_sukarela']+$total[0]['tsimpanan_lebaran']) ?></b></td>
                    </tr>
				</table>
			</div>

			<div>
				<table style="margin-top: 2%;" cellspacing="0">
				  
					<tr>
						<th>ID Anggota</th>
						<th>Nama Anggota</th>
                        <th>Simpanan Pokok</th>
                        <th>Simpanan Wajib</th>
                        <th>Simpanan Sukarela</th>
                        <th>Tabungan Lebaran</th>
                        <th>Total</th>
					</tr>
					<?php foreach ($anggota as $da ) : ?>
                        <tr>
                          <td><?= $da['id_anggota'] ?></td>
                          <td><?= $da['nama'] ?></td>
                          <td><?= rupiah2($da['simpanan_pokok']) ?></td>
                          <td><?= rupiah2($da['simpanan_wajib']) ?></td>
                          <td><?= rupiah2($da['simpanan_sukarela']) ?></td>
                          <td><?= rupiah2($da['simpanan_lebaran']) ?></td>
                          <td><?= rupiah2($da['simpanan_pokok']+$da['simpanan_wajib']+$da['simpanan_sukarela']+$da['simpanan_lebaran']) ?></td>
                        </tr>
                        <?php endforeach; ?>
				</table>
			</div>

</body></html>
