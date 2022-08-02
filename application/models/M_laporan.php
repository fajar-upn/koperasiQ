<?php

class M_laporan extends CI_Model {

	public function tampil_simpanan()
	{
		$this->db->select('*');
	    $this->db->from('simpanan');
	    $this->db->join('anggota', 'simpanan.id_anggota = anggota.id_anggota');
	    return $this->db->get()->result_array();
	}

	public function tampil_posakun()
	{
		return $this->db->get_where('daftar_akun',['pos_laporan' => 'Laporan Perhitungan Hasil Usaha'])->result_array();
	}

	public function tampil_poskeu()
	{
		return $this->db->get_where('daftar_akun',['pos_laporan' => 'Laporan Posisi Keuangan'])->result_array();
	}

	public function tampil_bukubesar()
	{
		$date = date('Y');
		$this->db->where('year(tanggal_transaksi)',$date);
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get_where('transaksi',['akun'])->result_array();

	}

	public function tampil_simpanan_a()
	{
		$id_anggota = $this->input->post('id_anggota');
		$tahun = $this->input->post('tahun');
		return $this->db->query("SELECT DISTINCT anggota.id_anggota, anggota.nama, (SELECT SUM(saldo) FROM simpanan WHERE jenis_simpanan='Simpanan Pokok' AND id_anggota='$id_anggota' AND YEAR(tanggal)='$tahun') AS simpanan_pokok, (SELECT SUM(saldo) FROM simpanan WHERE jenis_simpanan='Simpanan Wajib' AND id_anggota='$id_anggota' AND YEAR(tanggal)='$tahun') AS simpanan_wajib, (SELECT SUM(saldo) FROM simpanan WHERE jenis_simpanan='Simpanan Sukarela' AND id_anggota='$id_anggota' AND YEAR(tanggal)='$tahun') AS simpanan_sukarela, (SELECT SUM(saldo) FROM simpanan WHERE jenis_simpanan='Tabungan Lebaran' AND id_anggota='$id_anggota' AND YEAR(tanggal)='$tahun') AS simpanan_lebaran, YEAR(simpanan.tanggal) AS tahun FROM `simpanan` JOIN anggota ON anggota.id_anggota=simpanan.id_anggota AND simpanan.id_anggota='$id_anggota' AND YEAR(tanggal)='$tahun'")->result_array();
	}

	public function tampil_simpanan_a1()
	{
		$id_anggota = $this->input->post('id_anggota');
		$tahun = $this->input->post('tahun');
		return $this->db->query("SELECT * FROM simpanan WHERE id_anggota='$id_anggota' AND YEAR(tanggal)='$tahun' ORDER BY tanggal ASC")->result_array();
	}

	public function tampil_pinjaman_a()
	{
		$id_anggota = $this->input->post('id_anggota');
		$tahun = $this->input->post('tahun');
		return $this->db->query("SELECT pinjaman.bukti_transaksi_p,anggota.nama,anggota.alamat,pinjaman.nominal,pinjaman.tanggal_pinjam,pinjaman.lama_angsur,pinjaman.status_pinjam FROM pinjaman JOIN anggota ON pinjaman.id_anggota=anggota.id_anggota AND pinjaman.id_anggota='$id_anggota' AND YEAR(pinjaman.tanggal_pinjam)='$tahun'")->result_array();
	}

	public function getpinjamanbyID($id_anggota)
	{
		$this->db->select('id_anggota');
	    $this->db->from('pinjaman');
	    $this->db->where('status_pinjam', 'Belum Lunas');
	    $this->db->where("DATE_FORMAT(tanggal_pinjam,'%Y')", $this->input->post('tahun'));
	    $this->db->where('id_anggota', $id_anggota);
	    $this->db->limit(1);
	    return $this->db->get()->row_array();
	}

	public function sum_simpanan()
	{
		$this->db->select('SUM(saldo) AS sum_simpanan');
	    $this->db->from('simpanan');
	    $this->db->where("DATE_FORMAT(tanggal,'%Y')", $this->input->post('tahun_post'));
	    return $this->db->get()->row_array();
	}

	public function lihat_anggota()
	{
		$this->db->select('*');
	    $this->db->from('anggota');
	    $this->db->order_by('id_anggota', 'ASC');
	    return $this->db->get()->result_array();
	}

	public function lihat_simpanan()
	{
		$this->db->select('*');
	    $this->db->from('simpanan');
	    $this->db->where("DATE_FORMAT(tanggal,'%Y')", $this->input->post('tahun'));
	    $this->db->order_by('id_anggota', 'ASC');
	    return $this->db->get()->result_array();
	}

	public function lihat_simpanan_shu()
	{
		$this->db->select('*');
	    $this->db->from('simpanan');
	    $this->db->where("DATE_FORMAT(tanggal,'%Y')", $this->input->post('tahun_post'));
	    $this->db->order_by('id_anggota', 'ASC');
	    return $this->db->get()->result_array();
	}

	public function lihat_pinjaman_shu()
	{
		$this->db->select('*');
	    $this->db->from('pinjaman');
	    $this->db->where("DATE_FORMAT(tanggal_pinjam,'%Y')", $this->input->post('tahun_post'));
	    $this->db->order_by('id_anggota', 'ASC');
	    return $this->db->get()->result_array();
	}

	public function lihat_angsuran_shu()
	{
		$this->db->select('*');
	    $this->db->from('angsuran');
	    $this->db->where("DATE_FORMAT(tanggal,'%Y')", $this->input->post('tahun_post'));
	    $this->db->order_by('id_anggota', 'ASC');
	    return $this->db->get()->result_array();
	}

	public function lihat_pinjaman()
	{
		$tahun = $this->input->post('tahun');
		return $this->db->query("SELECT pinjaman.id_pinjaman,pinjaman.id_anggota,pinjaman.nominal FROM pinjaman JOIN anggota ON pinjaman.id_anggota=anggota.id_anggota AND anggota.status='Aktif' AND pinjaman.status_pinjam='Belum Lunas' AND YEAR(pinjaman.tanggal_pinjam)='$tahun' ORDER BY pinjaman.id_anggota")->result_array();

		// $this->db->select('*');
	 //    $this->db->from('pinjaman');
	 //    $this->db->where('status_pinjam', 'Belum Lunas');
	 //    $this->db->where("DATE_FORMAT(tanggal_pinjam,'%Y')", $this->input->post('tahun'));
	 //    $this->db->order_by('id_anggota', 'ASC');
	 //    return $this->db->get()->result_array();
	}

	public function lihat_angsuran()
	{
		$this->db->select('*');
	    $this->db->from('angsuran');
	    $this->db->where("DATE_FORMAT(tanggal,'%Y')", $this->input->post('tahun'));
	    $this->db->order_by('id_anggota', 'ASC');
	    return $this->db->get()->result_array();
	}

	public function pos_ekuitas()
	{
		return $this->db->get_where('daftar_akun',['pos_akun' => 'Ekuitas'])->result_array();
	}

	public function total_labarugi($data)
	{	

		$pos_labarugi = [ [ 'pos_akun' => 'Pendapatan', 'saldo_normal' => 'Kredit'],[ 'pos_akun' => 'Beban', 'saldo_normal' => 'Debit'],[ 'pos_akun' => 'Pajak', 'saldo_normal' => 'Debit']];
 		
		foreach ($pos_labarugi as $pl) {

			if ($this->input->post('bulan_post') && $this->input->post('tahun_post')) 
			{	

				$date_akhir = date($data['tahun']."-".$data['bulan']."-d");

				$bulan = $data['bulan'];

				$dt_akhir = date("Y-m-d", strtotime("last day of $date_akhir"));

				$date_sa = $data['tahun'];
				$this->db->where('year(tanggal_transaksi)',$date_sa);
				$this->db->select('SUM(debit) as total');
				$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;
		
				$this->db->where('year(tanggal_transaksi)',$date_sa);
				$this->db->select('SUM(kredit) as total');
				$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$data['dk_awal_k']);
				$this->db->where('tanggal_transaksi <=',$dt_akhir);
				$this->db->select('SUM(debit) as total');
				$deb = $this->db->get_where('transaksi',['pos_akun' =>$pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$data['dk_awal_k']);
				$this->db->where('tanggal_transaksi <=',$dt_akhir);

				$this->db->select('SUM(kredit) as total');
				$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$debit = $sa_d + $deb;
				$kredit = $sa_k + $kre;
				
			
			} elseif ($this->input->post('tanggal_awal')) {

				$tgl_awal = $this->input->post('tanggal_awal');
				$tgl_akhir = $this->input->post('tanggal_akhir');

				$tahun_jika = date("Y",strtotime($tgl_awal));
				$bulan = date("m",strtotime($tgl_awal));

				if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

				$bulan = $data['bulan']=date('m',strtotime($tgl_awal));
				$tahun = $data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$dk_awal_k = $data['dk_awal_k'] = $this->input->post('tanggal_awal');
				// debit kredit awal kumulatif
				$dk_akhir_k = $data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

				$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(debit) as total');
				$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(kredit) as total');
				$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
				$this->db->select('SUM(debit) as total');
				$deb = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
				$this->db->select('SUM(kredit) as total');
				$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$debit = $sa_d + $deb;
				$kredit = $sa_k + $kre;

				}  elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
				
				$bulan = $data['bulan']=date('m',strtotime($tgl_awal));
				$data_bulan = $tgl_awal;
				$tahun = $data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$dk_awal_k = $data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
				// debit kredit awal kumulatif
				$dk_akhir_k = $data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
				
				$dk_awal_k1 = $data['dk_awal_k1'] = $this->input->post('tanggal_awal');
				
				$dk_akhir_k1 = $data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

					// total saldo awal
	  			$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(debit) as total');
				$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(kredit) as total');
				$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

	  				// data sebelum bulan post
	  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
		  		$this->db->select('SUM(debit) as total');
				$deb = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
				$this->db->select('SUM(kredit) as total');
				$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					// data bulan post
				$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
		  		$this->db->select('SUM(debit) as total');
				$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
				$this->db->select('SUM(kredit) as total');
				$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$debit = $deb + $deb_b + $sa_d;
				$kredit = $kre + $kre_b + $sa_k;
			
				} else {

				$bulan = $data['bulan']=date('m',strtotime($tgl_awal));
				$data_bulan = $data['bulan'];
				$data_kurang = $data['bulan'] - 1;
				$tahun = $data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$dk_awal_k = $data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
				
				// debit kredit awal kumulatif
				$dk_akhir_k = $data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
				
				$dk_awal_k1 = $data['dk_awal_k1'] = $this->input->post('tanggal_awal');
				
				$dk_akhir_k1 = $data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

					// total saldo awal
	  			$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(debit) as total');
				$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(kredit) as total');
				$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

	  				// data sebelum bulan post
	  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
		  		$this->db->select('SUM(debit) as total');
				$deb = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
				$this->db->select('SUM(kredit) as total');
				$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					// data bulan post
			if ($this->input->post('tanggal_awal')) {
					// data bulan post
				$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
		  		$this->db->select('SUM(debit) as total');
				$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
				$this->db->select('SUM(kredit) as total');
				$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;	
			} else {
				$this->db->where('year(tanggal_transaksi)',$tahun);
				$this->db->where('month(tanggal_transaksi)',$bulan);
		  		$this->db->select('SUM(debit) as total');
				$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('year(tanggal_transaksi)',$tahun);
				$this->db->where('month(tanggal_transaksi)',$bulan);
				$this->db->select('SUM(kredit) as total');
				$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;
			}
				
				$debit = $deb + $deb_b + $sa_d;
				$kredit = $kre + $kre_b + $sa_k;

				}
				
			} else {

				if ($this->input->post('tahun_post')) {
					$date_sa = $this->input->post('tahun_post');
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(debit) as total');
					$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;
			
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(kredit) as total');
					$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

					$date = $this->input->post('tahun_post');
					$bulan = $data['bulan'];
					$this->db->where('year(tanggal_transaksi)',$date);
					
					$this->db->select('SUM(debit) as total');
					$deb = $this->db->get_where('transaksi',['pos_akun' =>$pl['pos_akun']])->row()->total;

					$this->db->where('year(tanggal_transaksi)',$date);
					
						$this->db->select('SUM(kredit) as total');
					$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					$debit = $sa_d + $deb;
					$kredit = $sa_k + $kre;
					
				} else {

					if ($data['bulan'] != 1) {

					$date_sa = date('Y');
				
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(debit) as total');
					$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;
			
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(kredit) as total');
					$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

					$date = date('Y');
					$bulan = $data['bulan'];
					$date_akhir = date($data['tahun']."-".$data['bulan']."-d");
					$dt_akhir = date("Y-m-d", strtotime("last day of $date_akhir"));

					$this->db->where('tanggal_transaksi >=',$data['dk_awal_k']);
					$this->db->where('tanggal_transaksi <=',$dt_akhir);
					$this->db->select('SUM(debit) as total');
					$deb = $this->db->get_where('transaksi',['pos_akun' =>$pl['pos_akun']])->row()->total;

					$this->db->where('tanggal_transaksi >=',$data['dk_awal_k']);
					$this->db->where('tanggal_transaksi <=',$dt_akhir);
					$this->db->select('SUM(kredit) as total');
					$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					$debit = $sa_d + $deb;
					$kredit = $sa_k + $kre;

					} else {

					$date_sa = date('Y');
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(debit) as total');
					$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;
			
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(kredit) as total');
					$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

					$date = date('Y');
					$bulan = $data['bulan'];
					$this->db->where('year(tanggal_transaksi)',$date);
					$this->db->where('month(tanggal_transaksi)',$bulan);
					$this->db->select('SUM(debit) as total');
					$deb = $this->db->get_where('transaksi',['pos_akun' =>$pl['pos_akun']])->row()->total;

					$this->db->where('year(tanggal_transaksi)',$date);
					$this->db->where('month(tanggal_transaksi)',$bulan);
						$this->db->select('SUM(kredit) as total');
					$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					$debit = $sa_d + $deb;
					$kredit = $sa_k + $kre;
					}
				}	

			}
			
				if ($pl['saldo_normal'] == 'Kredit') {
					$jumlah[$pl['pos_akun']] =  $kredit - $debit;
				}
				else {
					$jumlah[$pl['pos_akun']] =  $debit - $kredit;
				}

			
		}
			
		$total_labarugi = $jumlah['Pendapatan'] - $jumlah['Beban'] - $jumlah['Pajak'];
		
		return $total_labarugi;
	}

	public function saldo_awal($tahun_post)
	{
		$query = $this->db->query("SELECT kredit AS saldo_awal FROM saldo_awal WHERE pos_akun='Ekuitas' AND YEAR(tanggal_transaksi)='$tahun_post'")->result_array();
		if ($query==NULL) {
			$query = array (
			  array("saldo_awal" => 0),
			  array("saldo_awal" => 0),
			  array("saldo_awal" => 0),
			  array("saldo_awal" => 0),
			  array("saldo_awal" => 0),
			  array("saldo_awal" => 0)
			);
		    return $query;
		}
		else{
			return $query;
		}
	}

	public function saldo_kb($tahun_post)
	{
		$query = $this->db->query("SELECT SUM(debit) AS saldo_awal FROM saldo_awal WHERE akun IN ('Kas','Bank') AND YEAR(tanggal_transaksi)='$tahun_post'")->row_array();
		if ($query==NULL) {
			$query = array ("saldo_awal" => 0);
		    return $query;
		}
		else{
			return $query;
		}
	}

}
