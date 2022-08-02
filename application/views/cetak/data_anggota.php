
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

 
table tr {

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
				<h2 style="margin-top: 2px;  margin-bottom: 17%;">Data Anggota</h2>
	</div>
	
			<div>
				<table cellspacing="0">
				  
					<tr>
						<th width="5%">No</th>
                        <th width="10%">ID Anggota</th>
                        <th width="20%">Nama</th>
                        <th width="50%">Alamat</th>
                        <th width="15%">Status</th>
					</tr>
					<?php $no=1; foreach ($anggota as $da ) : ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $da['id_anggota']?></td>
                          <td><?= $da['nama'] ?></td>
                          <td><?= $da['alamat'] ?></td>
                          <td><?= $da['status'] ?></td>
                        </tr>
                        <?php endforeach; ?>
				</table>
			</div>

</body></html>
