
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
				<h2>Daftar Pinjaman</h2>
				<h3>"<?= $nama['nama'] ?>"</h3>
				<h4>Periode 31 Desember <?= $tahun ?></h4>
				<h2 style="margin-bottom: 29%;"></h2>
	</div>
	
			<div>
				<table cellspacing="0">
				  
					<tr>
						<th>Bukti Transaksi</th>
                        <th>Tanggal Pinjam</th>
                        <th>Total Pinjaman</th>
                        <th>Lama Angsuran</th>
                        <th>Status Pinjaman</th>
					</tr>
					<?php foreach ($anggota as $da ) : ?>
                        <tr>
                          <td><?= $da['bukti_transaksi_p'] ?></td>
                          <td><?= $da['tanggal_pinjam'] ?></td>
                          <td><?= rupiah2($da['nominal']) ?></td>
                          <td><?= $da['lama_angsur'] ?></td>
                          <td><?= $da['status_pinjam'] ?></td>
                        </tr>
                        <?php endforeach; ?>
				</table>
			</div>
</body></html>
