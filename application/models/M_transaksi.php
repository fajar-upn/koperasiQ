<?php

class M_transaksi extends CI_Model {

	public function getTransaksiById($bukti_transaksi)
	{
		return $this->db->get_where('transaksi',['bukti_transaksi' => $bukti_transaksi])->result_array();
	}

	public function tampil_anggota()
	{
		return $this->db->get_where('anggota',['status' => 'Aktif'])->result_array();
	}

	public function tampil_anggota_pinjam()
	{
		return $this->db->query("SELECT id_anggota FROM pinjaman WHERE status_pinjam='Belum Lunas'")->result_array();
	}

	public function tampil_anggota_pinjam1()
	{
		return $this->db->query("SELECT pinjaman.id_pinjaman,pinjaman.id_anggota,anggota.nama FROM pinjaman JOIN anggota ON pinjaman.id_anggota=anggota.id_anggota AND status_pinjam='Belum Lunas'")->result_array();
	}

	public function ambildatasimpanan($id_simpanan)
	{
		return $this->db->get_where('simpanan',['id_simpanan' => $id_simpanan])->row_array();
	}

	public function ambildatasimpanan2($bukti_transaksi_s)
	{
		return $this->db->get_where('simpanan',['bukti_transaksi_s' => $bukti_transaksi_s])->row_array();
	}

	public function ambildatapinjaman2($bukti_transaksi_p)
	{
		return $this->db->get_where('pinjaman',['bukti_transaksi_p' => $bukti_transaksi_p])->row_array();
	}

	public function ambildataangsuran2($bukti_transaksi_an)
	{
		return $this->db->get_where('angsuran',['bukti_transaksi_an' => $bukti_transaksi_an])->row_array();
	}

	public function ambilpinjamanbyid($id_pinjaman)
	{
		return $this->db->query("SELECT pinjaman.id_pinjaman,pinjaman.id_anggota,pinjaman.nominal,pinjaman.tanggal_pinjam,pinjaman.lama_angsur,anggota.nama FROM pinjaman JOIN anggota ON pinjaman.id_anggota=anggota.id_anggota AND pinjaman.id_pinjaman=$id_pinjaman")->row_array();
	}

	public function getangsuranbyid_pinjaman($id_pinjaman)
	{
		return $this->db->query("SELECT * FROM angsuran WHERE id_pinjaman=$id_pinjaman ORDER BY id_angsuran DESC")->row_array();
	}

	public function ubah_simpanan()
	{
		$bukti_transaksi_s = $this->input->post('bukti_transaksi_s');
		$jenis_simpanan = $this->input->post('jenis');
		$id_anggota = $this->input->post('id_anggota');
		$nama = $this->db->query("SELECT nama FROM anggota WHERE id_anggota='$id_anggota'")->row_array();
		$data_t = array();
		$data_s = [
			"id_simpanan" =>$this->input->post('id_simpanan',true),
			"bukti_transaksi_s" =>$this->input->post('bukti_transaksi_s',true),
			"id_anggota" =>$this->input->post('id_anggota',true),
			"saldo" =>$this->input->post('saldo',true),
			"jenis_simpanan" =>$this->input->post('jenis',true),
			"tanggal" =>$this->input->post('tanggal',true)
		];

		$this->db->where('id_simpanan', $this->input->post('id_simpanan'));
		$this->db->update('simpanan', $data_s);

		$daftar_akun = $this->db->query("SELECT * FROM daftar_akun WHERE akun='$jenis_simpanan' OR akun='Kas' ORDER BY kode_akun ASC")->result_array();
		$query = $this->db->query("SELECT * FROM transaksi WHERE bukti_transaksi_kop='$bukti_transaksi_s' ORDER BY id ASC")->result_array();
		$saldod = $this->input->post('saldo',true);
		$saldok = 0;$i=0;
		foreach ($daftar_akun as $d) {
			array_push($data_t, array(
				'id' => $query[$i]['id'],
				'kode_akun' => $d['kode_akun'],
				'keterangan' => 'Setor '.$jenis_simpanan ." ". $nama['nama'],
				'tanggal_transaksi' => $this->input->post('tanggal'),
				'pos_laporan' => $d['pos_laporan'],
				'akun' => $d['akun'],
				'debit' => $saldod,
				'kredit' => $saldok,
				'pos_akun' => $d['pos_akun']
			));
			$saldok=$saldod;$saldod=0;
			$i++;
		}
		$this->db->update_batch('transaksi', $data_t, 'id');
	}

	public function hapussimpanan($id_simpanan)
	{

		$query = $this->db->query("SELECT bukti_transaksi_s FROM simpanan WHERE id_simpanan=$id_simpanan")->row_array();
		$this->db->delete('simpanan',['id_simpanan' => $id_simpanan]);
		$this->db->delete('transaksi',['bukti_transaksi_kop' => $query['bukti_transaksi_s']]);
	}

	public function hapuspinjaman($id_pinjaman)
	{

		$query = $this->db->query("SELECT bukti_transaksi_p FROM pinjaman WHERE id_pinjaman=$id_pinjaman")->row_array();
		$this->db->delete('pinjaman',['id_pinjaman' => $id_pinjaman]);
		$this->db->delete('transaksi',['bukti_transaksi_kop' => $query['bukti_transaksi_p']]);
	}

	public function hapusangsuran($id_angsuran)
	{

		$query = $this->db->query("SELECT bukti_transaksi_an FROM angsuran WHERE id_angsuran=$id_angsuran")->row_array();
		$this->db->delete('angsuran',['id_angsuran' => $id_angsuran]);
		$this->db->delete('transaksi',['bukti_transaksi_kop' => $query['bukti_transaksi_an']]);
	}

	public function hapusJurnalUmum($bukti_transaksi)
	{
		$this->db->delete('transaksi',['bukti_transaksi' => $bukti_transaksi]);
	}

	public function tambahsimpanan($bukti_transaksi_s)
	{	

		$data = [
		"id_simpanan" =>'',
		"bukti_transaksi_s" =>$bukti_transaksi_s,
		"id_anggota" =>$this->input->post('id_anggota',true),
		"saldo" =>$this->input->post('saldo',true),
		"jenis_simpanan" =>$this->input->post('jenis',true),
		"tanggal" =>$this->input->post('tanggal',true)
		];	

		// if ($this->input->post('jenis')=='simpanan_pokok') {

		// 	$data = [
		// 		"id_simpanan" =>'',
		// 		"bukti_transaksi_s" =>$bukti_transaksi,
		// 		"id_anggota" =>$this->input->post('id_anggota',true),
		// 		"simpanan_pokok" =>$this->input->post('simpanan',true),
		// 		"simpanan_wajib" =>0,
		// 		"simpanan_sukarela" =>0,
		// 		"simpanan_lebaran" =>0,
		// 		"tanggal" =>$tanggal	
		// 	];
		// }
		// elseif ($this->input->post('jenis')=='simpanan_wajib') {
		// 	$data = [
		// 		"id_simpanan" =>'',
		// 		"bukti_transaksi_s" =>$bukti_transaksi,
		// 		"id_anggota" =>$this->input->post('id_anggota',true),
		// 		"simpanan_pokok" =>0,
		// 		"simpanan_wajib" =>$this->input->post('simpanan',true),
		// 		"simpanan_sukarela" =>0,
		// 		"simpanan_lebaran" =>0,
		// 		"tanggal" =>$tanggal	
		// 	];
		// }
		// elseif ($this->input->post('jenis')=='simpanan_sukarela') {
		// 	$data = [
		// 		"id_simpanan" =>'',
		// 		"bukti_transaksi_s" =>$bukti_transaksi,
		// 		"id_anggota" =>$this->input->post('id_anggota',true),
		// 		"simpanan_pokok" =>0,
		// 		"simpanan_wajib" =>0,
		// 		"simpanan_sukarela" =>$this->input->post('simpanan',true),
		// 		"simpanan_lebaran" =>0,
		// 		"tanggal" =>$tanggal	
		// 	];
		// }
		// elseif ($this->input->post('jenis')=='simpanan_lebaran') {
		// 	$data = [
		// 		"id_simpanan" =>'',
		// 		"bukti_transaksi_s" =>$bukti_transaksi,
		// 		"id_anggota" =>$this->input->post('id_anggota',true),
		// 		"simpanan_pokok" =>0,
		// 		"simpanan_wajib" =>0,
		// 		"simpanan_sukarela" =>0,
		// 		"simpanan_lebaran" =>$this->input->post('simpanan',true),
		// 		"tanggal" =>$tanggal	
		// 	];
		// }

		$this->db->insert('simpanan', $data);
	}

	public function tambahpinjaman($bukti_transaksi_p)
	{

		$data = [
		"id_pinjaman" =>'',
		"bukti_transaksi_p" =>$bukti_transaksi_p,
		"id_anggota" =>$this->input->post('id_anggota',true),
		"nominal" =>$this->input->post('nominal',true),
		"tanggal_pinjam" =>$this->input->post('tanggal',true),
		"provisi" =>$this->input->post('provisi',true),
		"lama_angsur" =>$this->input->post('lama_angsur',true),
		"keterangan" =>$this->input->post('keterangan',true),
		"status_pinjam" =>'Belum Lunas'
		];	

		$this->db->insert('pinjaman', $data);

	}

	public function tambahangsuran()
	{
		$jml_angsur = (int) $this->input->post('lama_angsur');

		if ($this->input->post('periode_angsuran')<$jml_angsur) {
			$data = [
				"id_angsuran" =>'',
				"bukti_transaksi_an" =>$this->input->post('bukti_transaksi_an',true),
				"id_pinjaman" =>$this->input->post('id_pinjaman',true),
				"id_anggota" =>$this->input->post('id_anggota',true),
				"tanggal" =>$this->input->post('tanggal',true),
				"periode_angsuran" =>$this->input->post('periode_angsuran',true),
				"nominal" =>$this->input->post('nominal',true),
				"jasa" =>$this->input->post('jasa',true),
				"keterangan" =>$this->input->post('keterangan',true)
			];
			$this->db->insert('angsuran', $data);
		}
		elseif ($this->input->post('periode_angsuran')==$jml_angsur) {
			$id_pinjaman = $this->input->post('id_pinjaman');
			$data = [
				"id_angsuran" =>'',
				"bukti_transaksi_an" =>$this->input->post('bukti_transaksi_an',true),
				"id_pinjaman" =>$this->input->post('id_pinjaman',true),
				"id_anggota" =>$this->input->post('id_anggota',true),
				"tanggal" =>$this->input->post('tanggal',true),
				"periode_angsuran" =>$this->input->post('periode_angsuran',true),
				"nominal" =>$this->input->post('nominal',true),
				"jasa" =>$this->input->post('jasa',true),
				"keterangan" =>$this->input->post('keterangan',true)
			];
			
			$this->db->insert('angsuran', $data);
			$this->db->query("UPDATE pinjaman SET status_pinjam='Lunas' WHERE id_pinjaman=$id_pinjaman");
		}
	}

	public function bukti_transaksi_s() {
		$kunci = 'S-';
		$this->db->like('bukti_transaksi_s',$kunci);
		$this->db->select('RIGHT(simpanan.bukti_transaksi_s,8) as kode', FALSE);
		$this->db->order_by('bukti_transaksi_s','DESC');
		$this->db->limit(1);
		$query = $this->db->get('simpanan');
		$ambil_data = $query->row_array();
		if ($ambil_data==NULL) {
			$angka = isset($ambil_data['kode']);
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 8,"0", STR_PAD_LEFT);
			$kode_at = "S-".$kodemax;
			return $kode_at;
		}
		else{
			$angka = $ambil_data['kode'];
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 8,"0", STR_PAD_LEFT);
			$kode_at = "S-".$kodemax;
			return $kode_at;
		}
	}

	public function bukti_transaksi_p()
	{
		$kunci = 'P-';
		$this->db->like('bukti_transaksi_p',$kunci);
		$this->db->select('RIGHT(pinjaman.bukti_transaksi_p,8) as kode', FALSE);
		$this->db->order_by('bukti_transaksi_p','DESC');
		$this->db->limit(1);
		$query = $this->db->get('pinjaman');
		$ambil_data = $query->row_array();
		if ($ambil_data==NULL) {
			$angka = isset($ambil_data['kode']);
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 8,"0", STR_PAD_LEFT);
			$kode_at = "P-".$kodemax;
			return $kode_at;
		}
		else{
			$angka = $ambil_data['kode'];
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 8,"0", STR_PAD_LEFT);
			$kode_at = "P-".$kodemax;
			return $kode_at;
		}
	}

	public function bukti_transaksi_an()
	{
		$kunci = 'R-';
		$this->db->like('bukti_transaksi_an',$kunci);
		$this->db->select('RIGHT(angsuran.bukti_transaksi_an,8) as kode', FALSE);
		$this->db->order_by('bukti_transaksi_an','DESC');
		$this->db->limit(1);
		$query = $this->db->get('angsuran');
		$ambil_data = $query->row_array();
		if ($ambil_data==NULL) {
			$angka = isset($ambil_data['kode']);
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 8,"0", STR_PAD_LEFT);
			$kode_at = "R-".$kodemax;
			return $kode_at;
		}
		else{
			$angka = $ambil_data['kode'];
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 8,"0", STR_PAD_LEFT);
			$kode_at = "R-".$kodemax;
			return $kode_at;
		}
	}

	public function bukti_transaksi() {
		$kunci = 'JU-';
		$this->db->like('bukti_transaksi',$kunci);
		$this->db->select('RIGHT(transaksi.bukti_transaksi,7) as kode', FALSE);
		$this->db->order_by('bukti_transaksi','DESC');
		$this->db->limit(1);
		$query = $this->db->get('transaksi');
		$ambil_data = $query->row_array();
		if ($ambil_data==NULL) {
			$angka = isset($ambil_data['kode']);
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 7,"0", STR_PAD_LEFT);
			$kode_at = "JU-".$kodemax;
			return $kode_at;
		}
		else{
			$angka = $ambil_data['kode'];
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 7,"0", STR_PAD_LEFT);
			$kode_at = "JU-".$kodemax;
			return $kode_at;
		}
	}

	public function bukti_transaksi_jp() {
		$kunci = 'JP-';
		$this->db->like('bukti_transaksi',$kunci);
		$this->db->select('RIGHT(transaksi.bukti_transaksi,7) as kode', FALSE);
		$this->db->order_by('bukti_transaksi','DESC');
		$this->db->limit(1);
		$query = $this->db->get('transaksi');
		$ambil_data = $query->row_array();
		if ($ambil_data==NULL) {
			$angka = isset($ambil_data['kode']);
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 7,"0", STR_PAD_LEFT);
			$kode_at = "JP-".$kodemax;
			return $kode_at;
		}
		else{
			$angka = $ambil_data['kode'];
			preg_match_all('!\d+!', $angka, $matches);
			$kode = implode('', $matches[0]);
			
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 7,"0", STR_PAD_LEFT);
			$kode_at = "JP-".$kodemax;
			return $kode_at;
		}
	}

}
