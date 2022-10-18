<?php

class M_backend extends CI_Model {

	public function tampil_daftarakun()
	{
		return $this->db->get('daftar_akun')->result_array();
	}

	public function ambil_dropdown()
	{
		return $this->db->get('daftar_akun')->result();
	}

	public function isi_field_byKode($kode_akun)
	{
		$hsl=$this->db->query("SELECT * FROM daftar_akun WHERE kode_akun='$kode_akun'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kode_akun' => $data->kode_akun,
					'akun' => $data->akun,
					'pos_laporan' => $data->pos_laporan,
					'pos_akun' => $data->pos_akun
					);
			}
		} 
		return $hasil;
	}

	public function count_anggota_a()
	{
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->like('status', 'Aktif');
		return $this->db->count_all_results();
	}

	public function count_anggota_t()
	{
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->like('status', 'Tidak Aktif');
		return $this->db->count_all_results();
	}

	public function count_simpanan()
	{
		return $this->db->query("SELECT SUM(saldo) AS simpanan FROM simpanan")->row_array();
	}

	public function count_pinjaman()
	{
		return $this->db->query("SELECT SUM(nominal) AS pinjaman FROM pinjaman")->row_array();
	}

	public function tampil_anggota()
	{
		return $this->db->get('anggota')->result_array();
	}

	public function cari_anggota()
	{
		$katakunci = $this->input->post('katakunci',true);
		$this->db->like('id_anggota',$katakunci);
		$this->db->or_like('nama',$katakunci);
		$this->db->or_like('alamat',$katakunci);
		
		return $this->db->get('anggota')->result_array();
	}

	public function cari_daftarakun()
	{
		$katakunci = $this->input->post('katakunci',true);
		$this->db->like('kode_akun',$katakunci);
		$this->db->or_like('akun',$katakunci);
		$this->db->or_like('pos_laporan',$katakunci);
		$this->db->or_like('pos_akun',$katakunci);
		
		return $this->db->get('daftar_akun')->result_array();
	}

	public function getDaftarAkunById($kode_akun)
	{	
		return $this->db->get_where('daftar_akun',['kode_akun' => $kode_akun])->row_array();
	}

	public function getSaldoAwalById($id)
	{
		return $this->db->get_where('saldo_awal',['id' => $id])->row_array();
	}

	public function get_id_anggota($id_anggota)
	{
		return $this->db->get_where('anggota',['id_anggota' => $id_anggota])->row_array();
	}

	public function tambahDaftarAkun()
	{
		$data = [
		"kode_akun" =>$this->input->post('kode_akun',true),
		"akun" =>$this->input->post('akun',true),
		"pos_laporan" =>$this->input->post('pos_laporan',true),
		"pos_akun" => $this->input->post('pos_akun',true),
		"saldo_normal" => $this->input->post('saldo_normal',true)		
		];	

		$this->db->insert('daftar_akun', $data);			
	}

	public function tambah_saldoawal()
	{		
		$date_now = date($this->input->post('tahun').'-01-d');

		$tgl_post = date("Y-m-d", strtotime("first day of $date_now "));

		$data = [
			"id" => '',
			"kode_akun" =>$this->input->post('kode_akun',true),
			"keterangan" =>$this->input->post('keterangan',true),
			"tanggal_transaksi" =>$tgl_post,
			"pos_akun" =>$this->input->post('pos_akun',true),
			"pos_laporan" =>$this->input->post('pos_laporan',true),
			"akun" =>$this->input->post('akun',true),
			"debit" =>$this->input->post('debit',true),
			"kredit" =>$this->input->post('kredit',true)
		];	

		$this->db->insert('saldo_awal', $data);
	}

	public function tambahanggota($image)
	{	
		$data = [
		"id_anggota" =>$this->input->post('id_anggota',true),
		"nama" =>$this->input->post('nama',true),
		"alamat" =>$this->input->post('alamat',true),
		"foto" => $image,
		"email"=>$this->input->post("email", true),
		"password"=>md5($this->input->post("password", true)),
		"role"=>$this->input->post("role", true),
		"status" =>$this->input->post('status',true)	
		];	

		$this->db->insert('anggota', $data);			
	}

	public function hapusDaftarAkun($kode_akun)
	{
		$this->db->delete('daftar_akun',['kode_akun' => $kode_akun]);
	}

	public function hapusSaldoAwal($id)
	{
		$this->db->delete('saldo_awal',['id' => $id]);
	}

	// public function hapusanggota($id_anggota)
	// {
	// 	$this->db->delete('anggota',['id_anggota' => $id_anggota]);
	// }

	public function ubahDaftarAkun()
	{	
		$data = [
		"kode_akun" =>$this->input->post('kode_akun',true),
		"akun" =>$this->input->post('akun',true),
		"pos_laporan" =>$this->input->post('pos_laporan',true),
		"pos_akun" => $this->input->post('pos_akun',true),
		"saldo_normal" => $this->input->post('saldo_normal',true)				
		];

		$this->db->where('kode_akun',$this->input->post('kode_akun'));
		$this->db->update('daftar_akun', $data);
	}

	public function ubahSaldoAwal()
	{
		$date_now = date($this->input->post('tahun').'-01-d');
		$tgl_post = date("Y-m-d", strtotime("first day of $date_now "));

		$data = [
			"id" => $this->input->post('id', true),
			"kode_akun" =>$this->input->post('kode_akun',true),
			"keterangan" =>$this->input->post('keterangan',true),
			"tanggal_transaksi" =>$tgl_post,
			"pos_akun" =>$this->input->post('pos_akun',true),
			"pos_laporan" =>$this->input->post('pos_laporan',true),
			"akun" =>$this->input->post('akun',true),
			"debit" =>$this->input->post('debit',true),
			"kredit" =>$this->input->post('kredit',true)	
		];

		$this->db->where('id',$this->input->post('id'));
		$this->db->update('saldo_awal', $data);
	}

	public function ubahanggota($image)
	{	

		$data = [
		"id_anggota" =>$this->input->post('id_anggota',true),
		"nama" =>$this->input->post('nama',true),
		"alamat" =>$this->input->post('alamat',true),
		'foto'=>$image,
		"email" =>$this->input->post('email',true),
		"role" =>$this->input->post('role',true),
		"status" =>$this->input->post('status',true)
		];

		$this->db->where('id_anggota',$this->input->post('id_anggota'));
		$this->db->update('anggota', $data);
	}

	public function kode_al() {
		$kunci = '1-1';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
		$ambil_data = $query->row_array();
		if ($ambil_data==NULL) {
			$angka = isset($ambil_data['kode']);
			// mengambil angka dari variabel
		
			preg_match_all('!\d+!', $angka, $matches);
			// implode adalah perintah untuk menggabungkan array
			$kode = implode('', $matches[0]);
			// cek apakah data sudah ada di dalam database
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
		
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 2,"0",STR_PAD_LEFT);// angka 4 menunjukan jumlah digit angka 0
			$kode_al = "1-1".$kodemax;
			return $kode_al;
		}
		else{
			$angka = $ambil_data['kode'];
			// mengambil angka dari variabel
		
			preg_match_all('!\d+!', $angka, $matches);
			// implode adalah perintah untuk menggabungkan array
			$kode = implode('', $matches[0]);
			// cek apakah data sudah ada di dalam database
			if ($query->num_rows() <> 0) {
				$data = $kode;
				$kode = intval($data)+1;
		
			} else
			{
				$kode=1;
			}

			$kodemax = str_pad($kode, 2,"0",STR_PAD_LEFT);// angka 4 menunjukan jumlah digit angka 0
			$kode_al = "1-1".$kodemax;
			return $kode_al;
		}
	}

	public function kode_at() {
		$kunci = '1-2';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_at = "1-2".$kodemax;
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_at = "1-2".$kodemax;
			return $kode_at;
		}
	}

	public function kode_k() {
		$kunci = '2-1';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_k = "2-1".$kodemax;
			return $kode_k;
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_k = "2-1".$kodemax;
			return $kode_k;
		}
	}

	public function kode_ek() {
		$kunci = '3-1';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_ek = "3-1".$kodemax;
			return $kode_ek;
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_ek = "3-1".$kodemax;
			return $kode_ek;
		}
	}

	public function kode_p() {
		$kunci = '4-1';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_p = "4-1".$kodemax;
			return $kode_p;
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_p = "4-1".$kodemax;
			return $kode_p;
		}
	}

	public function kode_b() {
		$kunci = '5-1';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_b = "5-1".$kodemax;
			return $kode_b;
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_b = "5-1".$kodemax;
			return $kode_b;
		}
	}

	public function kode_pjk() {
		$kunci = '6-1';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_pjk = "6-1".$kodemax;
			return $kode_pjk;
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

			$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
			$kode_pjk = "6-1".$kodemax;
			return $kode_pjk;
		}
	}

	public function id_anggota()
	{
		$kunci = 'A0';
		$this->db->like('id_anggota',$kunci);
		$this->db->select('RIGHT(anggota.id_anggota,5) as kode', FALSE);
		$this->db->order_by('id_anggota','DESC');
		$this->db->limit(1);
		$query = $this->db->get('anggota');
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

			$kodemax = str_pad($kode, 5,"0", STR_PAD_LEFT);
			$id_anggota = "A-".$kodemax;
			return $id_anggota;
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

			$kodemax = str_pad($kode, 5,"0", STR_PAD_LEFT);
			$id_anggota = "A-".$kodemax;
			return $id_anggota;
		}
	}
}
