<?php

class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('M_backend');
		$this->load->model('M_transaksi');
		$this->load->model('M_akuntansi');
		$this->load->model('M_laporan');
		$this->load->model('M_akuntansi');
		$this->load->helper('authlogin');
		$this->load->library('form_validation');
		admin();
	}
	
	public function index(){

		$data['user'] = $_SESSION['nama'];
		$data['anggota_a'] = $this->M_backend->count_anggota_a();
		$data['anggota_t'] = $this->M_backend->count_anggota_t();
		$data['simpanan'] = $this->M_backend->count_simpanan();
		$data['pinjaman'] = $this->M_backend->count_pinjaman();
		
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('koperasi/v_koperasi', $data);
		$this->load->view('templates/footer');

	}
	
	//==============================DAFTAR AKUN=======================================================
	public function daftar_akun(){
		$data['user'] = $_SESSION['nama'];
		$data['judul']='Daftar Akun';

		$data['daftar_akun']=$this->M_backend->tampil_daftarakun();


		if ($this->input->post('katakunci')) {
			$data['daftar_akun']=$this->M_backend->cari_daftarakun();
		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('master-data/v_daftar_akun', $data);
		$this->load->view('templates/footer');

	}

	public function tambah_daftarakun(){

		$data['user'] = $_SESSION['nama'];
		$data['judul']='Tambah Akun';
		$data['active']='active';
		$data['kode_al']=$this->M_backend->kode_al();
		$data['kode_at']=$this->M_backend->kode_at();
		$data['kode_k']=$this->M_backend->kode_k();
		$data['kode_p']=$this->M_backend->kode_p();
		$data['kode_ek']=$this->M_backend->kode_ek();
		$data['kode_b']=$this->M_backend->kode_b();
		$data['kode_pjk']=$this->M_backend->kode_pjk();
		
		$this->form_validation->set_rules('kode_akun','Kode Akun','required');
		$this->form_validation->set_rules('akun','Akun Perkiraan','required');
		
		if ($this->form_validation->run() ==  FALSE) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('master-data/v_tambah_daftarakun', $data);
			$this->load->view('templates/footer');
		}
		else {
			$this->session->set_flashdata('pesan_sukses','Ditambahkan');
			$this->M_backend->tambahDaftarAkun();
			redirect('admin/daftar_akun');
		}
	}

	public function ubahDaftarAkun($kode_akun)
	{	

		$data['user'] = $_SESSION['nama'];
		$data['judul']='Tambah Akun';
		$data['active']='active';
		$data['daftar_akun']=$this->M_backend->getDaftarAkunById($kode_akun);
		$data['pos_nr']=['Aset Lancar','Aset Tetap','Kewajiban','Ekuitas'];
		$data['pos_lr']=['Pendapatan','Beban','Pajak'];
		$data['kode_al']=$this->M_backend->kode_al();
		$data['kode_at']=$this->M_backend->kode_at();
		$data['kode_k']=$this->M_backend->kode_k();
		$data['kode_p']=$this->M_backend->kode_p();
		$data['kode_ek']=$this->M_backend->kode_ek();
		$data['kode_b']=$this->M_backend->kode_b();
		$data['kode_pjk']=$this->M_backend->kode_pjk();

		$data['pos_laporan']=['Laporan Posisi Keuangan','Laporan Perhitungan Hasil Usaha'];
		
		$this->form_validation->set_rules('kode_akun','Kode Akun','required');
		$this->form_validation->set_rules('akun','Akun Perkiraan','required');

	
		if ($this->form_validation->run() ==  FALSE) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('master-data/v_ubah_daftarakun', $data);
			$this->load->view('templates/footer');
		} 
		else {
			$this->session->set_flashdata('pesan_sukses','Diubah');
			$this->M_backend->ubahDaftarAkun();
			redirect('admin/daftar_akun');

		}
	}

	public function hapusDaftarAkun($kode_akun)
	{
		$this->M_backend->hapusDaftarAkun($kode_akun);
		$this->session->set_flashdata('pesan_sukses','Dihapus');
		redirect('admin/daftar_akun');
	}
	//==========================================AKHIR DAFTAR AKUN=============================================

	//==========================================DATA ANGGOTA==================================================
	public function data_anggota(){

		$data['user'] = $_SESSION['nama'];
		$data['judul']='Data Anggota';

		$data['anggota']=$this->M_backend->tampil_anggota();


		if ($this->input->post('katakunci')) {
			$data['anggota']=$this->M_backend->cari_anggota();
		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('master-data/v_data_anggota', $data);
		$this->load->view('templates/footer');

	}

	public function tambah_anggota(){

		$data['user'] = $_SESSION['nama'];
		$data['judul']='Tambah Anggota';
		$data['active']='active';
		$data['id_anggota']=$this->M_backend->id_anggota();

		// form validation
		$this->form_validation->set_rules('id_anggota','ID Anggota','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('status','Status','required');

		// image validation
		$config['upload_path']          = './foto/';
		$config['file_name']			= 'foto-'.$data['id_anggota'];
		$config['allowed_types']        = 'jpg|JPG|png|PNG|jpeg|JPEG';
		$config['max_size']             = 8000;
		$config['max_width']            = 1080;
		$config['max_height']           = 1080;
		$this->load->library('upload', $config);

		if ($this->form_validation->run() ==  FALSE) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('master-data/v_tambah_anggota', $data);
			$this->load->view('templates/footer');
		} else {
			$uploaded_data = $this->upload->data();
			$image = $uploaded_data['file_name'];
			
			/**
			 * Note terdapat bug apabila 'required' pada input image dihilangkan melalui inspect emlement
			 */
			if ($this->upload->do_upload('foto') == False){
				$this->session->set_flashdata('pesan_gagal','foto gagal ditambahkan');
				redirect('admin/data_anggota');
			}
			else{
				$this->session->set_flashdata('pesan_sukses','Ditambahkan');
				$this->M_backend->tambahanggota($image);
				redirect('admin/data_anggota');
			}
		}
	}

	// get data from database for filled form
	public function ubahanggota($id_anggota){

		$data['user'] = $_SESSION['nama'];
		$data['judul']='Ubah Data Anggota';
		$data['active']='active';
		$data['anggota']=$this->M_backend->get_id_anggota($id_anggota);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('master-data/v_ubah_anggota', $data);
		$this->load->view('templates/footer');
	}

	public function ubahAnggotaProses($id_anggota){
		$data['user'] = $_SESSION['nama'];
		$data['judul']='Ubah Data Anggota';
		$data['active']='active';
		$data['anggota']=$this->M_backend->get_id_anggota($id_anggota);

		$this->form_validation->set_rules('id_anggota','ID Anggota','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('role','Role','required');
		$this->form_validation->set_rules('status','Status','required');

		// image validation
		$config['upload_path']          = './foto/';
		$config['file_name']			= 'foto-'.$data['anggota']['foto'];
		$config['allowed_types']        = 'jpg|JPG|png|PNG|jpeg|JPEG';
		$config['overwrite']			= true;
		$config['max_size']             = 8000;
		$config['max_width']            = 1080;
		$config['max_height']           = 1080;
		$this->load->library('upload', $config);
		
		if ($this->form_validation->run() ==  FALSE) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('master-data/v_ubah_anggota', $data);
			$this->load->view('templates/footer');
		}
		else {

			$uploaded_data = $this->upload->data();
			$image = $uploaded_data['file_name'];
			
			/**
			 * Note terdapat bug apabila 'required' pada input image dihilangkan melalui inspect emlement
			 */
			if ($this->upload->do_upload('foto') == False){
				$this->session->set_flashdata('pesan_gagal','foto gagal ditambahkan');
				redirect('admin/data_anggota');
			}
			else{
				$this->session->set_flashdata('pesan_sukses','Diubah');
				$this->M_backend->ubahanggota($image);
				redirect('admin/data_anggota');
			}
		}
	}

	// public function hapusanggota($id_anggota){
	// 	$this->M_backend->hapusanggota($id_anggota);
	// 	$this->session->set_flashdata('pesan_sukses','Dihapus');
	// 	redirect('admin/data_anggota');
	// }

	//==========================================AKHIR DATA ANGGOTA==================================================

	//==========================================SALDO AWAL============================================================
	public function saldo_awal(){

		$data['user'] = $_SESSION['nama'];
		$data['judul']='Saldo Awal';
		$data['active']='active';

		if ($this->input->post('katakunci')) {
			$katakunci = $this->input->post('katakunci',true);
			$this->db->like('kode_akun',$katakunci);
			$this->db->or_like('tanggal_transaksi',$katakunci);
			$this->db->or_like('pos_laporan',$katakunci);
			$this->db->or_like('debit',$katakunci);
			$this->db->or_like('kredit',$katakunci);
			$this->db->or_like('akun',$katakunci);
			$this->db->or_like('pos_akun',$katakunci);
			$this->db->or_like('keterangan',$katakunci);
			$this->db->order_by('tanggal_transaksi', 'ASC');
			$data['bukber'] = $this->db->get('saldo_awal')->result_array();
		} 
		else {
			$data['bukber'] = $this->db->get_where('daftar_akun',['akun'])->result_array();
		}
		
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('master-data/v_saldo_awal', $data);
		$this->load->view('templates/footer');

	}

	public function tambah_saldoawal(){

		$data['user'] = $_SESSION['nama'];
		$data['judul']='Saldo Awal';
		$data['active']='active';
		$data['dd_kodeakun']=$this->db->get('daftar_akun')->result();
		$data['bukber'] = $this->db->get_where('daftar_akun',['akun'])->result_array();

		//form validation, validasi data sebelum masuk ke database

		$this->form_validation->set_rules('kode_akun','Kode Akun','required');
		$this->form_validation->set_rules('akun','Akun','required');
		$this->form_validation->set_rules('keterangan','keterangan','required');
		$this->form_validation->set_rules('pos_laporan','Pos Laporan','required');
		
		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('master-data/v_tambah_saldo_awal', $data);
			$this->load->view('templates/footer');
		} 
		else {

			$this->session->set_flashdata('pesan_sukses','Ditambahkan');
			$data['saldo_awal'] = $this->M_backend->tambah_saldoawal();		
			redirect('admin/saldo_awal');
		}
	}

	public function ubahSaldoAwal($id){

		$data['user'] = $_SESSION['nama'];
		$data['judul']='Ubah Saldo Awal';
		$data['active']='active';
		$data['saldo_awal']=$this->M_backend->getSaldoAwalById($id);
		$data['dd_kodeakun']=$this->db->get('daftar_akun')->result();
		$data['pos_laporan']=['Laporan Posisi Keuangan','Laporan Perhitungan Hasil Usaha'];
		
		$this->form_validation->set_rules('kode_akun','Kode Akun','required');
		$this->form_validation->set_rules('akun','Akun Perkiraan','required');

	
		if ($this->form_validation->run() ==  FALSE) {

			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('master-data/v_ubah_saldo_awal', $data);
			$this->load->view('templates/footer');
		} 
		else {
			$this->session->set_flashdata('pesan_sukses','Diubah');
			$this->M_backend->ubahSaldoAwal();
			redirect('admin/saldo_awal');
		}

	}

	public function hapusSaldoAwal($id){

		$this->M_backend->hapusSaldoAwal($id);
		$this->session->set_flashdata('pesan_sukses','Dihapus');
		redirect('admin/saldo_awal');
	}

	public function get_kodeakun(){

		$kode_akun=$this->input->post('kode_akun');
		$data=$this->M_backend->isi_field_byKode($kode_akun);
		echo json_encode($data);
	}

	//==========================================AKHIR SALDO AWAL======================================================

	//==========================================SIMPANAN============================================================

	public function simpanan(){
		$data['user'] = $_SESSION['nama'];
		$data['anggota'] = $this->M_transaksi->tampil_anggota();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('transaksi/v_tambah_simpanan',$data);
		$this->load->view('templates/footer');

	}

	public function tambah_simpanan(){

		$data['user'] = $_SESSION['nama'];
		$bukti_transaksi_s = $this->M_transaksi->bukti_transaksi_s();
		$bukti_transaksi = $this->M_transaksi->bukti_transaksi();
		$id_anggota = $this->input->post('id_anggota');
		
		$this->form_validation->set_rules('id_anggota','ID Anggota','required');
		$this->form_validation->set_rules('saldo','Saldo','required');
		$this->form_validation->set_rules('jenis','Jenis','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');

		$nama = $this->db->query("SELECT nama FROM anggota WHERE id_anggota='$id_anggota'")->row_array();
		$transaksi = array();
		if ($this->input->post('jenis')=='Simpanan Pokok') {
			$daftar_akun = $this->db->query("SELECT * FROM daftar_akun WHERE akun='Simpanan Pokok' OR akun='Kas' ORDER BY kode_akun ASC")->result_array();
			$pos_saldo = 'Debit';
			$saldod = $this->input->post('saldo');
			$saldok = 0;
			foreach ($daftar_akun as $k) {
				array_push($transaksi, array(
					'kode_akun' => $k['kode_akun'],
					'keterangan' => 'Setor Simpanan Pokok '.$nama['nama'],
					'tanggal_transaksi' => $this->input->post('tanggal'),
					'pos_saldo' => $pos_saldo,
					'pos_laporan' => $k['pos_laporan'],
					'bukti_transaksi' => $bukti_transaksi,
					'bukti_transaksi_kop' => $bukti_transaksi_s,
					'akun' => $k['akun'],
					'debit' => $saldod,
					'kredit' => $saldok,
					'pos_akun' => $k['pos_akun'],
					'ref' => 'JU'
				));
				$pos_saldo = 'Kredit';$saldok=$saldod;$saldod=0;
			}
		}
		elseif ($this->input->post('jenis')=='Simpanan Wajib') {
			$daftar_akun = $this->db->query("SELECT * FROM daftar_akun WHERE akun='Simpanan Wajib' OR akun='Kas' ORDER BY kode_akun ASC")->result_array();
			$pos_saldo = 'Debit';
			$saldod = $this->input->post('saldo');
			$saldok = 0;
			foreach ($daftar_akun as $k) {
				array_push($transaksi, array(
					'kode_akun' => $k['kode_akun'],
					'keterangan' => 'Setor Simpanan Wajib '.$nama['nama'],
					'tanggal_transaksi' => $this->input->post('tanggal'),
					'pos_saldo' => $pos_saldo,
					'pos_laporan' => $k['pos_laporan'],
					'bukti_transaksi' => $bukti_transaksi,
					'bukti_transaksi_kop' => $bukti_transaksi_s,
					'akun' => $k['akun'],
					'debit' => $saldod,
					'kredit' => $saldok,
					'pos_akun' => $k['pos_akun'],
					'ref' => 'JU'
				));
				$pos_saldo = 'Kredit';$saldok=$saldod;$saldod=0;
			}
		}
		elseif ($this->input->post('jenis')=='Simpanan Sukarela') {
			$daftar_akun = $this->db->query("SELECT * FROM daftar_akun WHERE akun='Simpanan Sukarela' OR akun='Kas' ORDER BY kode_akun ASC")->result_array();
			$pos_saldo = 'Debit';
			$saldod = $this->input->post('saldo');
			$saldok = 0;
			foreach ($daftar_akun as $k) {
				array_push($transaksi, array(
					'kode_akun' => $k['kode_akun'],
					'keterangan' => 'Setor Simpanan Sukarela '.$nama['nama'],
					'tanggal_transaksi' => $this->input->post('tanggal'),
					'pos_saldo' => $pos_saldo,
					'pos_laporan' => $k['pos_laporan'],
					'bukti_transaksi' => $bukti_transaksi,
					'bukti_transaksi_kop' => $bukti_transaksi_s,
					'akun' => $k['akun'],
					'debit' => $saldod,
					'kredit' => $saldok,
					'pos_akun' => $k['pos_akun'],
					'ref' => 'JU'
				));
				$pos_saldo = 'Kredit';$saldok=$saldod;$saldod=0;
			}
		}
		elseif ($this->input->post('jenis')=='Tabungan Lebaran') {
			$daftar_akun = $this->db->query("SELECT * FROM daftar_akun WHERE akun='Tabungan Lebaran' OR akun='Kas' ORDER BY kode_akun ASC")->result_array();
			$pos_saldo = 'Debit';
			$saldod = $this->input->post('saldo');
			$saldok = 0;
			foreach ($daftar_akun as $k) {
				array_push($transaksi, array(
					'kode_akun' => $k['kode_akun'],
					'keterangan' => 'Setor Tabungan Lebaran '.$nama['nama'],
					'tanggal_transaksi' => $this->input->post('tanggal'),
					'pos_saldo' => $pos_saldo,
					'pos_laporan' => $k['pos_laporan'],
					'bukti_transaksi' => $bukti_transaksi,
					'bukti_transaksi_kop' => $bukti_transaksi_s,
					'akun' => $k['akun'],
					'debit' => $saldod,
					'kredit' => $saldok,
					'pos_akun' => $k['pos_akun'],
					'ref' => 'JU'
				));
				$pos_saldo = 'Kredit';$saldok=$saldod;$saldod=0;
			}
		}
	
		if ($this->form_validation->run() ==  FALSE) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('transaksi/v_tambah_simpanan', $data);
			$this->load->view('templates/footer');
		}
		else {
			$this->session->set_flashdata('pesan_sukses','Ditambahkan');
			$this->M_transaksi->tambahsimpanan($bukti_transaksi_s);
			$this->db->insert_batch('transaksi', $transaksi);
			redirect('admin/simpanan');
		}
	}

	public function editsimpanan($id_simpanan){

		$data['user'] = $_SESSION['nama'];
		$data['anggota'] = $this->M_transaksi->ambildatasimpanan($id_simpanan);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_ubah_simpanan', $data);
		$this->load->view('templates/footer');

	}

	public function ubah_simpanan(){

		$data['user'] = $_SESSION['nama'];
		$data['judul']='Ubah Data Simpanan';
		$data['active']='active';
		
		$this->session->set_flashdata('pesan_sukses','Diubah');
		$this->M_transaksi->ubah_simpanan();
		redirect('admin/tampil_simpanan');
	}

	public function hapussimpanan($id_simpanan){

		$this->M_transaksi->hapussimpanan($id_simpanan);
		$this->session->set_flashdata('pesan_sukses','Dihapus');
		redirect('admin/tampil_simpanan');
	}

	public function tampil_simpanan(){
		$data['user'] = $_SESSION['nama'];
		$data['anggota'] = $this->M_transaksi->tampil_anggota();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_laporan_simpanan', $data);
		$this->load->view('templates/footer');
	}

	public function lihat_simpanan_a(){
		$data['user'] = $_SESSION['nama'];
		$id_anggota = $this->input->post('id_anggota');
		$data['anggota'] = $this->M_laporan->tampil_simpanan_a();
		$data['anggota1'] = $this->M_laporan->tampil_simpanan_a1();
		$data['tahun'] = $this->input->post('tahun');
		if ($data['anggota']==NULL) {
			$anggota = $this->M_backend->get_id_anggota($id_anggota);
			$flag = array();
			array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota['id_anggota'], "nama" => $anggota['nama'], "simpanan_pokok" => 0, "simpanan_wajib" => 0, "simpanan_sukarela" => 0, "simpanan_lebaran" => 0));
			$data['anggota'] = $flag;
		}
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_lihat_simpanan_a', $data);
		$this->load->view('templates/footer');
	}

	public function lihat_simpanan_all(){
		$data['user'] = $_SESSION['nama'];
		$anggota = $this->M_laporan->lihat_anggota();
		$simpanan = $this->M_laporan->lihat_simpanan();
		$data['tahun'] = $this->input->post('tahun');
		$flag = array();
		$total = array();
		$tsimpanan_pokok=0;$tsimpanan_wajib=0;$tsimpanan_sukarela=0;$tsimpanan_lebaran=0;

		if ($simpanan==NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "simpanan_pokok" => 0, "simpanan_wajib" => 0, "simpanan_sukarela" => 0, "simpanan_lebaran" => 0));
			}
			array_push($total, array("tsimpanan_pokok" => $tsimpanan_pokok, "tsimpanan_wajib" => $tsimpanan_wajib, "tsimpanan_sukarela" => $tsimpanan_sukarela, "tsimpanan_lebaran" => $tsimpanan_lebaran));
			$data['total'] = $total;
			$data['anggota'] = $flag;
		}

		elseif ($simpanan!=NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				$simpanan_pokok=0;$simpanan_wajib=0;$simpanan_sukarela=0;$simpanan_lebaran=0;
				if ($anggota[$i]['status']=='Aktif') {
					for ($j=0; $j<count($simpanan); $j++) { 
						if ($anggota[$i]['id_anggota']==$simpanan[$j]['id_anggota']) {
							if ($simpanan[$j]['jenis_simpanan']=='Simpanan Pokok') {
								$simpanan_pokok = $simpanan_pokok + $simpanan[$j]['saldo'];
							}
							elseif ($simpanan[$j]['jenis_simpanan']=='Simpanan Wajib') {
								$simpanan_wajib = $simpanan_wajib + $simpanan[$j]['saldo'];
							}
							elseif ($simpanan[$j]['jenis_simpanan']=='Simpanan Sukarela') {
								$simpanan_sukarela = $simpanan_sukarela + $simpanan[$j]['saldo'];
							}
							elseif ($simpanan[$j]['jenis_simpanan']=='Tabungan Lebaran') {
								$simpanan_lebaran = $simpanan_lebaran + $simpanan[$j]['saldo'];
							}
						}
					}
					$tsimpanan_pokok+=$simpanan_pokok;
					$tsimpanan_wajib+=$simpanan_wajib;
					$tsimpanan_sukarela+=$simpanan_sukarela;
					$tsimpanan_lebaran+=$simpanan_lebaran;
					array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "simpanan_pokok" => $simpanan_pokok, "simpanan_wajib" => $simpanan_wajib, "simpanan_sukarela" => $simpanan_sukarela, "simpanan_lebaran" => $simpanan_lebaran));
				}
				elseif ($anggota[$i]['status']=='Tidak Aktif') {
					array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "simpanan_pokok" => 0, "simpanan_wajib" => 0, "simpanan_sukarela" => 0, "simpanan_lebaran" => 0));
				}
			}
			array_push($total, array("tsimpanan_pokok" => $tsimpanan_pokok, "tsimpanan_wajib" => $tsimpanan_wajib, "tsimpanan_sukarela" => $tsimpanan_sukarela, "tsimpanan_lebaran" => $tsimpanan_lebaran));
			$data['total'] = $total;
			$data['anggota'] = $flag;
		}
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_lihat_simpanan_s', $data);
		$this->load->view('templates/footer');
	}

	//================================================AKHIR SIMPANAN================================================================

	//================================================PINJAMAN======================================================================
	publiC function pinjaman(){

		$data['user'] = $_SESSION['nama'];
		$anggotap = $this->M_transaksi->tampil_anggota_pinjam();
		$anggota = $this->M_transaksi->tampil_anggota();
		$flag1 = $anggota;
		$flag = array();

		if ($anggotap==NULL) {
			$data['anggota'] = $anggota;
		}
		elseif ($anggotap!=NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				for ($j=0; $j<count($anggotap); $j++) { 
					if ($anggota[$i]['id_anggota']==$anggotap[$j]['id_anggota']) {
						unset($flag1[$i]);
						$flag = array_values($flag1);
					}
				}
			}
			$data['anggota'] = $flag;
		}
		
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('transaksi/v_tambah_pinjaman',$data);		
		$this->load->view('templates/footer');
	}

	public function tambah_pinjaman(){

		$data['user'] = $_SESSION['nama'];
		$bukti_transaksi_p = $this->M_transaksi->bukti_transaksi_p();
		$bukti_transaksi = $this->M_transaksi->bukti_transaksi();
		
		$this->form_validation->set_rules('id_anggota','ID Anggota','required');
		$this->form_validation->set_rules('nominal','Nominal','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');
		$this->form_validation->set_rules('provisi','Provisi','required');
		$this->form_validation->set_rules('lama_angsur','Lama Angsur','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');

		$nominal = $this->input->post('nominal');
		$provisi = (float) $this->input->post('provisi')/100;
		$bunga = $nominal*$provisi;

		$transaksi = array();
		$pos_saldo = 'Kredit';
		$saldod = 0;
		$saldok = $nominal-$bunga;
		$daftar_akun = $this->db->query("SELECT * FROM daftar_akun WHERE akun='Piutang Uang' OR akun='Kas' OR akun='Provisi' ORDER BY kode_akun ASC")->result_array();
		foreach ($daftar_akun as $k) {
			if ($k['akun']=='Kas' || $k['akun']=='Provisi') {
				array_push($transaksi, array(
					'kode_akun' => $k['kode_akun'],
					'keterangan' => $this->input->post('keterangan'),
					'tanggal_transaksi' => $this->input->post('tanggal'),
					'pos_saldo' => $pos_saldo,
					'pos_laporan' => $k['pos_laporan'],
					'bukti_transaksi' => $bukti_transaksi,
					'bukti_transaksi_kop' => $bukti_transaksi_p,
					'akun' => $k['akun'],
					'debit' => $saldod,
					'kredit' => $saldok,
					'pos_akun' => $k['pos_akun'],
					'ref' => 'JU'
				));
			}
			else{
				$pos_saldo = 'Debit';
				$saldod = $nominal;
				$saldok = 0;
				array_push($transaksi, array(
					'kode_akun' => $k['kode_akun'],
					'keterangan' => $this->input->post('keterangan'),
					'tanggal_transaksi' => $this->input->post('tanggal'),
					'pos_saldo' => $pos_saldo,
					'pos_laporan' => $k['pos_laporan'],
					'bukti_transaksi' => $bukti_transaksi,
					'bukti_transaksi_kop' => $bukti_transaksi_p,
					'akun' => $k['akun'],
					'debit' => $saldod,
					'kredit' => $saldok,
					'pos_akun' => $k['pos_akun'],
					'ref' => 'JU'
				));
				$pos_saldo = 'Kredit';$saldod=0;$saldok=$bunga;
			}
		}
		$temp = $transaksi[0];
		$transaksi[0] = $transaksi[1];
		$transaksi[1] = $temp;

		if ($this->form_validation->run() ==  FALSE) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('transaksi/v_tambah_pinjaman', $data);
			$this->load->view('templates/footer');
		}
		else {
			$this->session->set_flashdata('pesan_sukses','Ditambahkan');
			$this->M_transaksi->tambahpinjaman($bukti_transaksi_p);
			$this->db->insert_batch('transaksi', $transaksi);
			redirect('admin/pinjaman');
		}
	}

	public function tampil_pinjaman(){
		$data['user'] = $_SESSION['nama'];
		$data['anggota'] = $this->M_transaksi->tampil_anggota();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_laporan_pinjaman', $data);
		$this->load->view('templates/footer');
	}

	public function lihat_pinjaman_a(){

		$data['user'] = $_SESSION['nama'];
		$id_anggota = $this->input->post('id_anggota');
		$data['anggota'] = $this->M_laporan->tampil_pinjaman_a();
		$data['tahun'] = $this->input->post('tahun');
		$data['nama'] = $this->M_backend->get_id_anggota($id_anggota);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_lihat_pinjaman_a', $data);
		$this->load->view('templates/footer');

	}

	public function lihat_pinjaman_all(){

		$data['user'] = $_SESSION['nama'];
		$anggota = $this->M_laporan->lihat_anggota();
		$pinjaman = $this->M_laporan->lihat_pinjaman();
		$angsuran = $this->M_laporan->lihat_angsuran();
		$data['tahun'] = $this->input->post('tahun');
		$flag = array();
		$total = array();
		$sumtotal=0;$sumsisa=0;

		if ($pinjaman==NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "alamat" => $anggota[$i]['alamat'], "total_pinjaman" => 0, "sisa_pinjaman" => 0));
			}
			array_push($total, array("sumtotal" => $sumtotal, "sumsisa" => $sumsisa));
			$data['anggota'] = $flag;
			$data['total'] = $total;
		}

		elseif ($pinjaman!=NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				if ($anggota[$i]['status']=='Aktif') {
					$query = $this->M_laporan->getpinjamanbyID($anggota[$i]['id_anggota']);
					if ($query==NULL) {
						array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "alamat" => $anggota[$i]['alamat'], "total_pinjaman" => 0, "sisa_pinjaman" => 0));
					}
					else{
						for ($j=0; $j<count($pinjaman); $j++) { 
							if ($anggota[$i]['id_anggota']==$pinjaman[$j]['id_anggota']) {
								$tangsur=0;$nangsur=0;$jasa=0;
								for ($k=0; $k<count($angsuran); $k++) { 
									if ($pinjaman[$j]['id_pinjaman']==$angsuran[$k]['id_pinjaman']) {
										$tangsur++;
										$nangsur = $angsuran[$k]['nominal'];
										$jasa = (float) $angsuran[$k]['jasa']/100;
									}
								}
								$sisa_pinjaman = $pinjaman[$j]['nominal'] - ($tangsur*($nangsur-($pinjaman[$j]['nominal']*$jasa)));
								array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "alamat" => $anggota[$i]['alamat'], "total_pinjaman" => $pinjaman[$j]['nominal'], "sisa_pinjaman" => $sisa_pinjaman));
								$sumtotal+=$pinjaman[$j]['nominal'];
								$sumsisa+=$sisa_pinjaman;
							}
						}
					}
				}
				elseif ($anggota[$i]['status']=='Tidak Aktif') {
					array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "alamat" => $anggota[$i]['alamat'], "total_pinjaman" => 0, "sisa_pinjaman" => 0));
				}
			}
			array_push($total, array("sumtotal" => $sumtotal, "sumsisa" => $sumsisa));
			$data['anggota'] = $flag;
			$data['total'] = $total;
		}
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_lihat_pinjaman_s', $data);
		$this->load->view('templates/footer');
	}

	public function hapuspinjaman($id_pinjaman){

		$this->M_transaksi->hapuspinjaman($id_pinjaman);
		$this->session->set_flashdata('pesan_sukses','Dihapus');
		redirect('admin/tampil_pinjaman');

	}

	//================================================AKHIR PINJAMAN================================================================

	//================================================ANGSURAN======================================================================
	public function angsuran(){

		$data['user'] = $_SESSION['nama'];
		$data['anggota'] = $this->M_transaksi->tampil_anggota_pinjam1();
		
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('transaksi/v_angsuran',$data);
		$this->load->view('templates/footer');

	}

	public function tampil_angsuran(){

		$data['user'] = $_SESSION['nama'];
		$data['anggota'] = $this->M_transaksi->tampil_anggota();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_laporan_angsuran', $data);
		$this->load->view('templates/footer');

	}

	public function lihat_angsuran_all(){

		$data['user'] = $_SESSION['nama'];
		$anggota = $this->M_laporan->lihat_anggota();
		$pinjaman = $this->M_laporan->lihat_pinjaman();
		$angsuran = $this->M_laporan->lihat_angsuran();
		$data['tahun'] = $this->input->post('tahun');
		$flag = array();
		$total = array();
		$sumtotal=0;$sumangsur=0;$sumjasa=0;

		if ($pinjaman==NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_pinjaman" => 0, "angsuran_pokok" => 0, "jasa" => 0, "angsuran_ke" => 0));
			}
			array_push($total, array("sumtotal" => $sumtotal, "sumangsur" => $sumangsur, "sumjasa" => $sumjasa));
			$data['anggota'] = $flag;
			$data['total'] = $total;
		}

		elseif ($pinjaman!=NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				if ($anggota[$i]['status']=='Aktif') {
					$query = $this->M_laporan->getpinjamanbyID($anggota[$i]['id_anggota']);
					if ($query==NULL) {
						array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_pinjaman" => 0, "angsuran_pokok" => 0, "jasa" => 0, "angsuran_ke" => 0));
					}
					else{
						for ($j=0; $j<count($pinjaman); $j++) { 
							if ($anggota[$i]['id_anggota']==$pinjaman[$j]['id_anggota']) {
								$tangsur=0;$nangsur=0;$jasa=0;
								for ($k=0; $k<count($angsuran); $k++) { 
									if ($pinjaman[$j]['id_pinjaman']==$angsuran[$k]['id_pinjaman']) {
										$tangsur++;
										$nangsur = $angsuran[$k]['nominal'];
										$jasa = (float) $angsuran[$k]['jasa']/100;
									}
								}
								$sisajasa = $pinjaman[$j]['nominal']*$jasa*$tangsur;
								$angsuran_pokok = ($tangsur*($nangsur-($pinjaman[$j]['nominal']*$jasa)));
								array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_pinjaman" => $pinjaman[$j]['nominal'], "angsuran_pokok" => $angsuran_pokok, "jasa" => $sisajasa, "angsuran_ke" => $tangsur));
								$sumtotal+=$pinjaman[$j]['nominal'];
								$sumangsur+=$angsuran_pokok;
								$sumjasa+=$sisajasa;
							}
						}
					}
				}
				elseif ($anggota[$i]['status']=='Tidak Aktif') {
					array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_pinjaman" => 0, "angsuran_pokok" => 0, "jasa" => 0, "angsuran_ke" => 0));
				}
			}
			array_push($total, array("sumtotal" => $sumtotal, "sumangsur" => $sumangsur, "sumjasa" => $sumjasa));
			$data['anggota'] = $flag;
			$data['total'] = $total;
		}
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_lihat_angsuran_s', $data);
		$this->load->view('templates/footer');

	}

	public function tambah_angsuran(){

		$data['user'] = $_SESSION['nama'];
		$flag = array();
		$jasa = '1%';
		$bunga = (float) $jasa/100;

		$id_pinjaman = $this->input->post('id_pinjaman');
		$bukti_transaksi = $this->M_transaksi->bukti_transaksi_an();
		$anggota = $this->M_transaksi->ambilpinjamanbyid($id_pinjaman);
		$angsuran = $this->M_transaksi->getangsuranbyid_pinjaman($id_pinjaman);
		$jmlangsur =  (int) $anggota['lama_angsur'];

		$bunga = $bunga*$anggota['nominal'];	
		$nominal = round($anggota['nominal']/$jmlangsur,0)+$bunga;
		if ($angsuran==NULL) {
			array_push($flag, array("bukti_transaksi_an" => $bukti_transaksi, "id_pinjaman" => $id_pinjaman, "id_anggota" => $anggota['id_anggota'], "periode_angsuran" => 1, "nominal" => $nominal, "jasa" => $jasa, "nama" => $anggota['nama'], "tanggal_pinjam" => $anggota['tanggal_pinjam'], "lama_angsur" => $anggota['lama_angsur'], "nominalp" => $anggota['nominal'], "bunga" => $bunga));
		}
		elseif ($anggota!=NULL) {
			array_push($flag, array("bukti_transaksi_an" => $bukti_transaksi, "id_pinjaman" => $id_pinjaman, "id_anggota" => $anggota['id_anggota'], "periode_angsuran" => $angsuran['periode_angsuran']+1, "nominal" => $nominal, "jasa" => $jasa, "nama" => $anggota['nama'], "tanggal_pinjam" => $anggota['tanggal_pinjam'], "lama_angsur" => $anggota['lama_angsur'], "nominalp" => $anggota['nominal'], "bunga" => $bunga));
		}
		$data['angsuran'] = $flag;

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('transaksi/v_tambah_angsuran',$data);
		$this->load->view('templates/footer');
	}

	public function insert_angsuran(){

		$data['user'] = $_SESSION['nama'];
		$bukti_transaksi = $this->M_transaksi->bukti_transaksi();
		
		$this->form_validation->set_rules('id_pinjaman','ID Pinjaman','required');
		$this->form_validation->set_rules('id_anggota','ID Anggota','required');
		$this->form_validation->set_rules('bunga','Bunga','required');
		$this->form_validation->set_rules('bukti_transaksi_an','Bukti Transaksi An','required');
		$this->form_validation->set_rules('periode_angsuran','Periode Angsuran','required');
		$this->form_validation->set_rules('jasa','Jasa','required');
		$this->form_validation->set_rules('lama_angsur','Lama Angsur','required');
		$this->form_validation->set_rules('nominal','Nominal','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');

		$nominal = $this->input->post('nominal');
		$jasa_piutang = $this->input->post('bunga');
		$piutang = $nominal-$jasa_piutang;

		$transaksi = array();
		$pos_saldo = 'Debit';
		$saldod = $nominal;
		$saldok = 0;
		$daftar_akun = $this->db->query("SELECT * FROM daftar_akun WHERE akun='Piutang Uang' OR akun='Kas' OR akun='Jasa Piutang' ORDER BY kode_akun ASC")->result_array();
		foreach ($daftar_akun as $k) {
			if ($k['akun']=='Kas') {
				array_push($transaksi, array(
					'kode_akun' => $k['kode_akun'],
					'keterangan' => $this->input->post('keterangan'),
					'tanggal_transaksi' => $this->input->post('tanggal'),
					'pos_saldo' => $pos_saldo,
					'pos_laporan' => $k['pos_laporan'],
					'bukti_transaksi' => $bukti_transaksi,
					'bukti_transaksi_kop' => $this->input->post('bukti_transaksi_an'),
					'akun' => $k['akun'],
					'debit' => $saldod,
					'kredit' => $saldok,
					'pos_akun' => $k['pos_akun'],
					'ref' => 'JU'
				));
				$pos_saldo='Kredit';$saldod=0;$saldok=$piutang;
			}
			elseif ($k['akun']=='Piutang Uang' || $k['akun']=='Jasa Piutang') {
				array_push($transaksi, array(
					'kode_akun' => $k['kode_akun'],
					'keterangan' => $this->input->post('keterangan'),
					'tanggal_transaksi' => $this->input->post('tanggal'),
					'pos_saldo' => $pos_saldo,
					'pos_laporan' => $k['pos_laporan'],
					'bukti_transaksi' => $bukti_transaksi,
					'bukti_transaksi_kop' => $this->input->post('bukti_transaksi_an'),
					'akun' => $k['akun'],
					'debit' => $saldod,
					'kredit' => $saldok,
					'pos_akun' => $k['pos_akun'],
					'ref' => 'JU'
				));
				$saldok=$jasa_piutang;
			}
		}

		$this->M_transaksi->tambahangsuran();
		$this->db->insert_batch('transaksi', $transaksi);
		$this->session->set_flashdata('pesan_sukses','Ditambahkan');
		redirect('admin/angsuran');
	}

	public function hapusangsuran($id_angsuran){

		$this->M_transaksi->hapusangsuran($id_angsuran);
		$this->session->set_flashdata('pesan_sukses','Dihapus');
		redirect('admin/tampil_angsuran');

	}

	//================================================AKHIR ANGSURAN================================================================

	//===================================================JURNAL UMUM================================================================
	public function jurnal_umum(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Jurnal Umum';
		$data['active']='active';
 
		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
	
		// cari jurnal umum tanggal dan tipe data

		if ($this->input->post('katakunci')) {

			$data['jurnal_umum'] =$this->M_akuntansi->cari_jurnalumum();
			$data['katakunci'] = $this->input->post('katakunci');
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();

		} elseif ($this->input->post('tanggal_awal')) {

			$data['jurnal_umum'] =$this->M_akuntansi->cari_tanggal_jurnalumum();
			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

			$data['jurnal_umum'] = $this->M_akuntansi->cari_bulantahunjurnalumum();
			$bi = $this->M_akuntansi->bulan_indo();
			$data['bulan_nama'] = $bi[$this->input->post('bulan_post')];
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();

		} elseif ($this->input->post('tahun_post')) {

			$data['jurnal_umum'] = $this->M_akuntansi->cari_tahunjurnalumum();
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();

		} else {
			$bi = $this->M_akuntansi->bulan_indo();
			$data['bulan_nama']= $bi[date('m')];
			$data['jurnal_umum'] = $this->M_akuntansi->tampil_jurnalumum();
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();
			
		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('akuntansi/v_jurnal_umum', $data);		
		$this->load->view('templates/footer');
	}

	public function transaksi_m(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Transaksi';
		$data['active']='active';

		$data['dd_kodeakun'] = $this->M_backend->ambil_dropdown();
		$data['bukti_transaksi'] = $this->M_transaksi->bukti_transaksi();
		
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('akuntansi/v_tambah_ju', $data);
		$this->load->view('templates/footer');

	}

	public function insert_transaksi_m(){

		$this->form_validation->set_rules('kode_akun[]','Kode Akun','required');
		$this->form_validation->set_rules('debit[]','Debit','required');
		$this->form_validation->set_rules('kredit[]','Kredit','required');
		$this->form_validation->set_rules('keterangan[]','Keterangan','required');		
		$this->form_validation->set_rules('tanggal_transaksi[]','Tanggal Transaksi','required');
		$this->form_validation->set_rules('bukti_transaksi[]','Bukti Transaksi','required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan_error', validation_errors());

			redirect('admin/transaksi_m');
		} 
		else {

			$kode_akun = $_POST['kode_akun'];
			$keterangan = $_POST['keterangan'];
			$tanggal_transaksi = $_POST['tanggal_transaksi'];
			$pos_saldo = $_POST['pos_saldo'];
			$pos_laporan = $_POST['pos_laporan'];
			$bukti_transaksi = $_POST['bukti_transaksi'];
			$akun = $_POST['akun'];
			$debit = $_POST['debit'];
			$kredit = $_POST['kredit'];
			$pos_akun = $_POST['pos_akun'];

			$data = array();

			$index = 0;
			foreach ($kode_akun as $datakd) { 
				array_push($data, array(
					'kode_akun' => $datakd,
					'keterangan' => $keterangan[$index],
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $akun[$index],
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'ref' => 'JU'
				));
			$index++;
			}
			foreach ($data as $d ) {
				$jumlah[]=$d['debit'];
				$jumlahk[]=$d['kredit'];
			}

			$jumlahnya = array_sum($jumlah);
			$jumlahknya= array_sum($jumlahk);

			if ($jumlahnya == $jumlahknya) {

				$this->db->insert_batch('transaksi', $data); 
				$this->session->set_flashdata('pesan_sukses','Ditambahkan');
				$this->session->set_flashdata('pesan_balance','Sudah Balance');
				redirect('admin/transaksi_m');
			} 
			else {	

				$this->session->set_flashdata('pesan_error','Ditambahkan');
				$this->session->set_flashdata('pesan_tidakbalance','Tidak Balance');
				redirect('admin/transaksi_m');
			}
		}
	}

	public function hapustransaksi_ju($bukti_transaksi){

		$cek_kop = $this->M_transaksi->getTransaksiById($bukti_transaksi);

		if ($cek_kop[0]['bukti_transaksi_kop']!=NULL) {
			if (strpos($cek_kop[0]['bukti_transaksi_kop'], 'S-') !== FALSE) {
				$id_simpanan = $this->M_transaksi->ambildatasimpanan2($cek_kop[0]['bukti_transaksi_kop']);
				$this->hapussimpanan($id_simpanan['id_simpanan']);
			}
			elseif (strpos($cek_kop[0]['bukti_transaksi_kop'], 'P-') !== FALSE) {
				$id_pinjaman = $this->M_transaksi->ambildatapinjaman2($cek_kop[0]['bukti_transaksi_kop']);
				$this->hapuspinjaman($id_pinjaman['id_pinjaman']);
			}
			elseif (strpos($cek_kop[0]['bukti_transaksi_kop'], 'R-') !== FALSE) {
				$id_angsuran = $this->M_transaksi->ambildataangsuran2($cek_kop[0]['bukti_transaksi_kop']);
				$this->hapusangsuran($id_angsuran['id_angsuran']);
			}
		}
		else{

			$this->M_transaksi->hapusJurnalUmum($bukti_transaksi);
			$this->session->set_flashdata('pesan_sukses','Dihapus');
			$this->session->set_flashdata('pesan_balance','Sudah Balance');
			redirect('admin/jurnal_umum');

		}
	}

	public function ubahtransaksi_ju($bukti_transaksi){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Jurnal Umum';
		$data['active']='active';
		$cek_kop = $this->M_transaksi->getTransaksiById($bukti_transaksi);

		if ($cek_kop[0]['bukti_transaksi_kop']!=NULL) {
			if (strpos($cek_kop[0]['bukti_transaksi_kop'], 'S-') !== FALSE) {
				$id_simpanan = $this->M_transaksi->ambildatasimpanan2($cek_kop[0]['bukti_transaksi_kop']);
				$this->editsimpanan($id_simpanan['id_simpanan']);
			}
			elseif (strpos($cek_kop[0]['bukti_transaksi_kop'], 'P-') !== FALSE) {
				redirect('admin/tampil_pinjaman');
			}
			elseif (strpos($cek_kop[0]['bukti_transaksi_kop'], 'R-') !== FALSE) {
				redirect('admin/tampil_angsuran');
			}
		}

		else{

			$data['dd_kodeakun'] = $this->M_backend->ambil_dropdown();
			$data['judul']='Ubah Transaksi';
			$data['active']='active';

			$data['pos_saldo']=['Debit','Kredit'];
			$data['pos_laporan']=['Laporan Posisi Keuangan','Laporan Perhitungan Hasil Usaha'];

			$this->form_validation->set_rules('kode_akun[]','Kode Akun','required');
			$this->form_validation->set_rules('akun[]','Akun','required');
			$this->form_validation->set_rules('keterangan[]','keterangan','required');
			$this->form_validation->set_rules('pos_saldo[]','Pos Saldo','required');
			$this->form_validation->set_rules('pos_laporan[]','Pos Laporan','required');
			$this->form_validation->set_rules('tanggal_transaksi[]','Tanggal Transaksi','required');
			$this->form_validation->set_rules('bukti_transaksi[]','Bukti Transaksi','required');

			if ($this->form_validation->run() == FALSE) {

				$data_form = array();
				foreach ($cek_kop as $key) {
					array_push($data_form, array(
						'id' => $key['id'],
						'kode_akun' => $key['kode_akun'],
						'akun' => $key['akun'],
						'tanggal_transaksi' => $key['tanggal_transaksi'],
						'bukti_transaksi' => $key['bukti_transaksi'],
						'pos_saldo' => $key['pos_saldo'],
						'pos_laporan' => $key['pos_laporan'],
						'debit' => $key['debit'],
						'kredit' => $key['kredit'],
						'keterangan' => $key['keterangan'],
						'pos_akun' => $key['pos_akun']
						));
				}
				$new = count($data_form);
				$data['data_count'] = $new;

				if ($new == 2) {
					$dataform = [
						'id' => [$data_form[0]['id'], $data_form[1]['id'],null,null],
						'kode_akun' => [$data_form[0]['kode_akun'], $data_form[1]['kode_akun'],null,null],
						'akun' => [$data_form[0]['akun'],$data_form[1]['akun'],null,null],
						'tanggal_transaksi' => [$data_form[0]['tanggal_transaksi'],$data_form[1]['tanggal_transaksi'],null,null],
						'bukti_transaksi' => [$data_form[0]['bukti_transaksi'],$data_form[1]['bukti_transaksi'],null,null],
						'pos_saldo' => [$data_form[0]['pos_saldo'],$data_form[1]['pos_saldo'],null,null],
						'pos_laporan' => [$data_form[0]['pos_laporan'],$data_form[1]['pos_laporan'],null,null],
						'debit' => [$data_form[0]['debit'],$data_form[1]['debit'],null,null],
						'keterangan' => [$data_form[0]['keterangan'],$data_form[1]['keterangan'],null,null],
						'kredit' => [$data_form[0]['kredit'],$data_form[1]['kredit'],null,null],
						'pos_akun' => [$data_form[0]['pos_akun'],$data_form[1]['pos_akun'],null,null]
					];
				}

				else if ($new == 3) {
					$dataform = [
						'id' => [$data_form[0]['id'], $data_form[1]['id'],$data_form[2]['id'],null],

						'kode_akun' => [$data_form[0]['kode_akun'], $data_form[1]['kode_akun'],$data_form[2]['kode_akun'],null],

						'akun' => [$data_form[0]['akun'],$data_form[1]['akun'],$data_form[2]['akun'],null],

						'tanggal_transaksi' => [$data_form[0]['tanggal_transaksi'],$data_form[1]['tanggal_transaksi'],$data_form[2]['tanggal_transaksi'],null],

						'bukti_transaksi' => [$data_form[0]['bukti_transaksi'],$data_form[1]['bukti_transaksi'],$data_form[2]['bukti_transaksi'],null],
						'pos_saldo' => [$data_form[0]['pos_saldo'],$data_form[1]['pos_saldo'],$data_form[2]['pos_saldo'],null],
						'pos_laporan' => [$data_form[0]['pos_laporan'],$data_form[1]['pos_laporan'],$data_form[2]['pos_laporan'],null],
						'debit' => [$data_form[0]['debit'],$data_form[1]['debit'],$data_form[2]['debit'],null],
						'keterangan' => [$data_form[0]['keterangan'],$data_form[1]['keterangan'],$data_form[2]['keterangan'],null],
						'kredit' => [$data_form[0]['kredit'],$data_form[1]['kredit'],$data_form[2]['kredit'],null],
						'pos_akun' => [$data_form[0]['pos_akun'],$data_form[1]['pos_akun'],$data_form[2]['pos_akun'],null]
					];
				}
				else if ($new == 4) {
					$dataform = [
						'id' => [$data_form[0]['id'], $data_form[1]['id'],$data_form[2]['id'],$data_form[3]['id']],

						'kode_akun' => [$data_form[0]['kode_akun'], $data_form[1]['kode_akun'],$data_form[2]['kode_akun'],$data_form[3]['kode_akun']],
						'akun' => [$data_form[0]['akun'],$data_form[1]['akun'],$data_form[2]['akun'],$data_form[3]['akun']],
						'tanggal_transaksi' => [$data_form[0]['tanggal_transaksi'],$data_form[1]['tanggal_transaksi'],$data_form[2]['tanggal_transaksi'],$data_form[3]['tanggal_transaksi']],
						'bukti_transaksi' => [$data_form[0]['bukti_transaksi'],$data_form[1]['bukti_transaksi'],$data_form[2]['bukti_transaksi'],$data_form[3]['bukti_transaksi']],
						'pos_saldo' => [$data_form[0]['pos_saldo'],$data_form[1]['pos_saldo'],$data_form[2]['pos_saldo'],$data_form[3]['pos_saldo']],
						'pos_laporan' => [$data_form[0]['pos_laporan'],$data_form[1]['pos_laporan'],$data_form[2]['pos_laporan'],$data_form[3]['pos_laporan']],
						'debit' => [$data_form[0]['debit'],$data_form[1]['debit'],$data_form[2]['debit'],$data_form[3]['debit']],
						'keterangan' => [$data_form[0]['keterangan'],$data_form[1]['keterangan'],$data_form[2]['keterangan'],$data_form[3]['keterangan']],
						'kredit' => [$data_form[0]['kredit'],$data_form[1]['kredit'],$data_form[2]['kredit'],$data_form[3]['kredit']],
						'pos_akun' => [$data_form[0]['pos_akun'],$data_form[1]['pos_akun'],$data_form[2]['pos_akun'],$data_form[3]['pos_akun']]
					];
				}

				$data['transaksi']= $dataform;

				$this->load->view('templates/header');
				$this->load->view('templates/sidebar', $data);
				$this->load->view('akuntansi/v_ubah_ju', $data);
				$this->load->view('templates/footer');
			}
			else {

				$id = $_POST['id'];
				$kode_akun = $_POST['kode_akun'];
				$keterangan = $_POST['keterangan'];
				$tanggal_transaksi = $_POST['tanggal_transaksi'];
				$pos_saldo = $_POST['pos_saldo'];
				$pos_laporan = $_POST['pos_laporan'];
				$bukti_transaksi = $_POST['bukti_transaksi'];
				$akun = $_POST['akun'];
				$debit = $_POST['debit'];
				$kredit = $_POST['kredit'];
				$pos_akun = $_POST['pos_akun'];
				
				$data1 = array();
				$index = 0;
				foreach ($kode_akun as $datakd) { 
					array_push($data1, array(
						'id' => $id[$index],
						'kode_akun' => $datakd,
						'keterangan' => $keterangan[$index],
						'tanggal_transaksi' => $tanggal_transaksi[$index],
						'pos_saldo' => $pos_saldo[$index],
						'pos_laporan' => $pos_laporan[$index],
						'bukti_transaksi' => $bukti_transaksi[$index],
						'akun' => $akun[$index],
						'debit' => $debit[$index],
						'kredit' => $kredit[$index],
						'pos_akun' => $pos_akun[$index]
					));
					$index++;
				}
				foreach ($data1 as $d ) {
					$jumlah[]=$d['debit'];
					$jumlahk[]=$d['kredit'];
				}
				$jumlahnya = array_sum($jumlah);
				$jumlahknya= array_sum($jumlahk);

				if ($jumlahnya == $jumlahknya) {
					$this->db->update_batch('transaksi', $data1,'id');
					$this->session->set_flashdata('pesan_sukses','Diperbaharui');
					$this->session->set_flashdata('pesan_balance','Sudah Balance');
					redirect('admin/jurnal_umum');
				} 
				else {	
					$this->session->set_flashdata('pesan_error','Ditambahkan');
					$this->session->set_flashdata('pesan_tidakbalance','Tidak Balance');
					redirect('admin/jurnal_umum');
				}
			}
		}
	}

	//===================================================AKHIR JURNAL UMUM============================================================

	//======================================================JURNAL PENYESUAIAN========================================================
	public function jurnal_penyesuaian(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Jurnal Penyesuaian';
		$data['active']='active';
 
		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
		

		if ($this->input->post('katakunci')) {

			$data['tampil_jp'] =$this->M_akuntansi->cari_jp();
			$data['katakunci'] = $this->input->post('katakunci');
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();

		} elseif ($this->input->post('tanggal_awal')) {

			$data['tampil_jp'] =$this->M_akuntansi->cari_tanggal_jp();
			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

			$data['tampil_jp'] = $this->M_akuntansi->cari_bulantahunjp();
			$bi = $this->M_akuntansi->bulan_indo();
			$data['bulan_nama'] = $bi[$this->input->post('bulan_post')];
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();

		} elseif ($this->input->post('tahun_post')) {

			$data['tampil_jp'] = $this->M_akuntansi->cari_tahunjp();
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();

		} else {

			$bi = $this->M_akuntansi->bulan_indo();
			$data['bulan_nama']= $bi[date('m')];
			$data['tampil_jp'] = $this->M_akuntansi->tampil_jp();
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();		

		}	

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('akuntansi/v_jurnal_penyesuaian', $data);
		$this->load->view('templates/footer');

	}

	public function tambah_jp(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Posisi Keuangan';
		$data['active']='active';
	
		$data['bukti_transaksi'] = $this->M_transaksi->bukti_transaksi_jp();
		$data['dd_kodeakun'] = $this->M_backend->ambil_dropdown();
		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();


		$this->form_validation->set_rules('kode_akun[]','Kode Akun','required');
		$this->form_validation->set_rules('akun[]','Akun','required');
		$this->form_validation->set_rules('pos_saldo[]','Pos Saldo','required');
		$this->form_validation->set_rules('pos_laporan[]','Pos Laporan','required');
	

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('akuntansi/v_tambah_jp', $data);
			$this->load->view('templates/footer');

		} 
		else {
			$this->M_akuntansi->tambah_jp();
			redirect('admin/jurnal_penyesuaian');
		}
	}

	public function update_jp($bukti_transaksi){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Posisi Keuangan';
		$data['active']='active';
	
		$data['bukti_transaksi'] = $this->M_transaksi->bukti_transaksi_jp();
		$data['dd_kodeakun'] = $this->M_backend->ambil_dropdown();
		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
		$data['data_jp'] = $this->M_akuntansi->getdatajp($bukti_transaksi);

		$data['pos_saldo']=['Debit','Kredit'];
		$data['pos_laporan']=['Laporan Posisi Keuangan','Laporan Perhitungan Hasil Usaha'];

		$this->form_validation->set_rules('kode_akun[]','Kode Akun','required');
		$this->form_validation->set_rules('akun[]','Akun','required');
		$this->form_validation->set_rules('pos_saldo[]','Pos Saldo','required');
		$this->form_validation->set_rules('pos_laporan[]','Pos Laporan','required');
		
		$data['data_count'] = count($this->db->get_where('transaksi',['bukti_transaksi' => $bukti_transaksi])->result_array());

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('akuntansi/v_ubah_jp', $data);
			$this->load->view('templates/footer');

		} else {
			$this->M_akuntansi->update_jp();
			redirect('admin/jurnal_penyesuaian');
		}
	}

	public function hapus_jp($bukti_transaksi){

		$this->M_akuntansi->hapus_jp($bukti_transaksi);
		$this->session->set_flashdata('pesan_sukses','Dihapus');
		$this->session->set_flashdata('pesan_balance','Sudah Balance');
		redirect('admin/jurnal_penyesuaian');

	}

	//====================================================AKHIR JURNAL PENYESUAIAN====================================================

	//======================================================LAPORAN SHU===============================================================
	public function laporan_shu(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Laporan SHU';
		$data['active']='active';

		$data['p_akun']=$this->M_laporan->tampil_posakun();
		$data['pos_akun']=['Pendapatan', 'Beban', 'Pajak'];

		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
		
		if ($this->input->post('tanggal_awal')) {

			$tgl_awal = $this->input->post('tanggal_awal');
			$tgl_akhir = $this->input->post('tanggal_akhir');
			
			$tahun_jika = date("Y",strtotime($tgl_awal));
			$bulan = date("m",strtotime($tgl_awal));
	
			$data['tahun_jika'] = $tahun_jika;

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = $this->input->post('tanggal_awal');
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

			} elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			}
			
		} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {		
			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");
			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan'] = $bi[$this->input->post('bulan_post')];

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');

		} else {

			$data['bulan'] = date('m');
			$data['tahun'] = date('Y');

			$bulan = date('m');
			$tahun = date('Y');

			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan']= $bi[date('m')];

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));
			}
			

		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_laporan_shu', $data);
		$this->load->view('templates/footer');

	}

	public function shu_anggota(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Laporan SHU Anggota';
		$data['active']='active';

		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
	
		if ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');

			$data['posakun']=$this->M_laporan->tampil_posakun();
			$shu = $this->M_laporan->total_labarugi($data);

			$anggota = $this->M_laporan->lihat_anggota();
			$simpanan = $this->M_laporan->lihat_simpanan_shu();
			$pinjaman = $this->M_laporan->lihat_pinjaman_shu();
			$angsuran = $this->M_laporan->lihat_angsuran_shu();
			$totals = $this->M_laporan->sum_simpanan();
			$flag = array();

			//Mencari SHU Simpanan
			if ($simpanan==NULL) {
				for ($i=0; $i<count($anggota); $i++) { 
					array_push($flag, array("id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_simpanan" => 0, "shu_penyimpan" => 0));
				}
				$data['simpanan'] = $flag;
			}

			elseif ($simpanan!=NULL) {
				for ($i=0; $i<count($anggota); $i++) { 
					$tsimpan=array();
					if ($anggota[$i]['status']=='Aktif') {
						for ($j=0; $j<count($simpanan); $j++) { 
							if ($anggota[$i]['id_anggota']==$simpanan[$j]['id_anggota']) {
								$tsimpan[] = $simpanan[$j]['saldo'];
							}
						}
						$sum_simpanan = round(array_sum($tsimpan)/$totals['sum_simpanan']*$shu*0.16,0);
						array_push($flag, array("id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_simpanan" => array_sum($tsimpan), "shu_penyimpan" => $sum_simpanan));
					}
					elseif ($anggota[$i]['status']=='Tidak Aktif') {
						array_push($flag, array("id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_simpanan" => 0, "shu_penyimpan" => 0));
					}
				}
				$data['simpanan'] = $flag;
			}

			$flag = array();
			$sum_jasa = array();

			//Mencari SHU Jasa
			if ($pinjaman==NULL) {
				for ($i=0; $i<count($anggota); $i++) { 
					array_push($flag, array("total_jasa" => 0, "shu_jasa" => 0));
				}
				$data['jasa'] = $flag;
			}

			elseif ($pinjaman!=NULL) {
				for ($i=0; $i<count($anggota); $i++) { 
					$tjasa=array();
					if ($anggota[$i]['status']=='Aktif') {
						for ($j=0; $j<count($pinjaman); $j++) { 
							if ($anggota[$i]['id_anggota']==$pinjaman[$j]['id_anggota']) {
								$periode=0;
								for ($k=0; $k<count($angsuran); $k++) { 
									if ($pinjaman[$j]['id_pinjaman']==$angsuran[$k]['id_pinjaman']) {
										$periode+=1;
									}
								}
								$tjasa[] = $pinjaman[$j]['nominal']*0.01*$periode;
								$sum_jasa[] = $pinjaman[$j]['nominal']*0.01*$periode;
							}
						}
						$jasa_shu = round(array_sum($tjasa)*$shu*0.24,0);
						array_push($flag, array("total_jasa" => array_sum($tjasa), "shu_jasa" => $jasa_shu));
					}
					elseif ($anggota[$i]['status']=='Tidak Aktif') {
						array_push($flag, array("total_jasa" => 0, "shu_jasa" => 0));
					}
				}
			}
			for ($i=0; $i<count($flag); $i++) { 
				if ($flag[$i]['total_jasa']!=0) {
					$flag[$i]['shu_jasa'] = round($flag[$i]['shu_jasa']/array_sum($sum_jasa),0);
				}
			}
			$data['jasa'] = $flag;

			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('laporan/v_lihat_shu_anggota', $data);
			$this->load->view('templates/footer');

		}
		else {

			$this->load->view('templates/header');
			$this->load->view('templates/sidebar', $data);
			$this->load->view('laporan/v_shu_anggota', $data);
			$this->load->view('templates/footer');

		}

	}

	//======================================================AKHIR LAPORAN SHU=========================================================

	//======================================================BUKU BESAR===============================================================
	public function buku_besar(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Buku Besar';
		$data['active']='active';

		$data['dd_kodeakun'] = $this->M_backend->ambil_dropdown();

		$data['dd_bulan'] = $this->M_akuntansi->dd_bulan();
		$data['jurnal_umum'] = $this->M_laporan->tampil_bukubesar();

		$data['bukber'] = $this->db->get_where('daftar_akun', ['akun'])->result_array();

		// AWAL DARI SEMUA INI

		if ($this->input->post('tanggal_awal')) {

			$t_aw = $this->input->post('tanggal_awal');
			$t_ak = $this->input->post('tanggal_akhir');

			$data['t_aw'] = $this->input->post('tanggal_awal');
			$data['t_ak'] = $this->input->post('tanggal_akhir');

			$month_awal = date("n", strtotime($t_aw));
			$month_akhir = date("n", strtotime($t_ak));

			$tahun = date("Y", strtotime($t_aw));

			$bulan = $month_awal;

			$data['tahun'] = $tahun;
			$data['bulan'] = $bulan;

			// echo date($tahun."-"."1"."-"."1");

			// echo $month_akhir;
			$data['nama_bulan'] = date("F", strtotime(date("Y") . "-" . $bulan . "-01"));

			if ($t_aw != date($tahun . "-" . "01" . "-" . "01")) {
				// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
				// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
				$bulan2 = $bulan - 1;
				$data['tahun_sa1'] = $tahun;
				$data['tahun_sa'] = $tahun;
				$data['tahun_sa2'] = $tahun - 1;

				// $date_now = date($tahun."-".$bulan."-d");
				// echo "$tgl";
				$data['date_awal'] = date($tahun . "-" . "01" . "-" . "01");
				$data['date_akhir_data12'] = date("Y-m-d", strtotime("$t_ak"));
				$data['date_akhir'] = date("Y-m-d", strtotime("$t_aw -1 day"));

				$data['tgl_awal_data'] = $t_aw;
				$data['tgl_akhir_data'] = $t_ak;



				// echo $data['tgl_awal_data'];
				// echo $data['tgl_akhir_data'];
				// echo "cek";
			} else {
				$date_now = date($tahun . "-" . $bulan . "-d");

				$data['tahun_sa1'] = $tahun;
				$data['tahun_sa'] = $data['tahun'];

				$data['date_awal'] = date($tahun . "-" . $bulan . "-01");
				$data['date_akhir'] = date($tahun . "-01-31");

				$data['tgl_awal_data'] = $t_aw;

				$data['tgl_akhir_data'] = $t_ak;
			}
		} elseif ($this->input->post('bulan_post')) {

			$data['tahun'] = $this->input->post('tahun_post');
			$data['bulan'] = $this->input->post('bulan_post');

			$tahun = $data['tahun'];
			$bulan = $data['bulan'];

			$data['nama_bulan'] = date("F", strtotime(date("Y") . "-" . $bulan . "-01"));

			if ($bulan != 1) {
				// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
				// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
				$bulan2 = $bulan - 1;

				$data['tahun_sa'] = $tahun;

				$date_now = date($tahun . "-" . $bulan . "-d");
				// echo "$tgl";
				$data['date_awal'] = date("Y-m-d", strtotime("$date_now first day of -$bulan2 month"));
				$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of -1 month"));

				$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

				$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
			} else {
				$date_now = date($tahun . "-" . $bulan . "-d");
				$data['tahun_sa'] = $tahun;

				$data['date_awal'] = date($tahun . "-" . $bulan . "-01");
				$data['date_akhir'] = date($tahun . "-01-31");

				$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

				$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
			}
		} else {

			if ($this->input->post('tahun_post')) {
				$data['tahun'] = $this->input->post('tahun_post');
				$data['bulan'] = 1;

				$bulan = 1;
				$tahun = $this->input->post('tahun_post');

				$data['tahun_sa'] = $tahun;

				$date_now = date($tahun . "-" . $bulan . "-d");
				$data['nama_bulan'] = 'Tahun';
				// echo "$tgl";
				$data['date_awal'] = date("Y-m-d", strtotime("first day of $date_now"));
				$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of +11 month"));

				$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

				$data['tgl_akhir_data'] = date("Y-m-d", strtotime("$date_now last day of +11 month"));
			} else {
				$data['tahun'] = date('Y');
				$data['bulan'] = date('m');

				$bulan = date('m');
				$tahun = date('Y');

				$data['nama_bulan'] = date("F", strtotime(date("Y") . "-" . $bulan . "-01"));

				if ($bulan != 1) {
					// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
					// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
					$bulan2 = $bulan - 1;

					$data['tahun_sa'] = $tahun;

					$date_now = date("Y-" . $bulan . "-d");
					// echo "$tgl";
					$data['date_awal'] = date("Y-m-d", strtotime("$date_now first day of -$bulan2 month"));
					$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of -1 month"));

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
				} else {
					$date_now = date("Y-" . $bulan . "-d");
					$data['tahun_sa'] = $data['tahun'];

					$data['date_awal'] = date("Y-" . $bulan . "-01");
					$data['date_akhir'] = date("Y-01-31");

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
				}
			}
		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_laporan_bukubesar', $data);
		$this->load->view('templates/footer');

	}

	//===================================================AKHIR AKHIR BUKU BESAR=====================================================

	//================================================LAPORAN PERUBAHAN MODAL=========================================================
	public function per_modal(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Laporan Perubahan Modal';
		$data['active']='active';
		
		$data['pos_nr2']=['Ekuitas'];

		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
	
		if ($this->input->post('tahun_post') && $this->input->post('bulan_post')) 
		{			

			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");

			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan'] = $bi[$this->input->post('bulan_post')];

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

			$data['posakun']=$this->M_laporan->tampil_poskeu();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
			$data['saldo_awal'] = $this->M_laporan->saldo_awal($tahun_post);

		} elseif ($this->input->post('tanggal_awal')) {
			$tahun_jika = date('Y',strtotime($this->input->post('tanggal_awal')));
			$data['tahun_jika'] = $tahun_jika;
			$data['tahun'] = $tahun_jika;
			$tgl_awal = $this->input->post('tanggal_awal');

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {
				$data['bulan']=date('m',strtotime($tgl_awal));
				$data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$data['dk_awal_k'] = $this->input->post('tanggal_awal');
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

				$data['lr'] = $this->M_laporan->total_labarugi($data);


			}  elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);

			}

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');
			$tahun_post = $this->input->post('tahun_post');

			$data['posakun']=$this->M_laporan->tampil_posakun();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
			$data['saldo_awal'] = $this->M_laporan->saldo_awal($tahun_post);
		} else {

				$data['bulan'] = date('m');
				$data['tahun'] = date('Y');

				$bulan = $data['bulan'];
				$tahun = date('Y');

				$bi = $this->M_akuntansi->bulan_indo();
				$data['nama_bulan']= $bi[date('m')];

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
				$data['saldo_awal'] = $this->M_laporan->saldo_awal($tahun);
			} else {

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
				$data['saldo_awal'] = $this->M_laporan->saldo_awal($tahun);
			}
			

		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_laporan_permodal', $data);
		$this->load->view('templates/footer');

	}

	//==========================================AKHIR LAPORAN PERUBAHAN MODAL=========================================================

	//=========================================================LAPORAN ARUS KAS======================================================
	public function arus_kas(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Laporan Arus Kas';
		$data['active']='active';
		
		$data['pos_nr1']=['Pendapatan','Beban','Aset Lancar', 'Kewajiban'];
		$data['pos_nr2']=['Aset Tetap'];
		$data['pos_lr']=['Ekuitas'];

		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
	
		if ($this->input->post('tahun_post') && $this->input->post('bulan_post')) 
		{			

			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");

			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan'] = $bi[$this->input->post('bulan_post')];

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

			$data['posakun']=$this->M_laporan->tampil_poskeu();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
			$data['saldo_awal'] = $this->M_laporan->saldo_kb($tahun_post);

		} elseif ($this->input->post('tanggal_awal')) {
			$tahun_jika = date('Y',strtotime($this->input->post('tanggal_awal')));
			$data['tahun_jika'] = $tahun_jika;
			$data['tahun'] = $tahun_jika;
			$tgl_awal = $this->input->post('tanggal_awal');

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {
				$data['bulan']=date('m',strtotime($tgl_awal));
				$data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$data['dk_awal_k'] = $this->input->post('tanggal_awal');
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

				$data['lr'] = $this->M_laporan->total_labarugi($data);


			}  elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);

			}

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');
			$tahun_post = $this->input->post('tahun_post');

			$data['posakun']=$this->M_laporan->tampil_posakun();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
			$data['saldo_awal'] = $this->M_laporan->saldo_kb($tahun_post);
		} else {

				$data['bulan'] = date('m');
				$data['tahun'] = date('Y');

				$bulan = $data['bulan'];
				$tahun = date('Y');

				$bi = $this->M_akuntansi->bulan_indo();
				$data['nama_bulan']= $bi[date('m')];

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
				$data['saldo_awal'] = $this->M_laporan->saldo_kb($tahun);
			} else {

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
				$data['saldo_awal'] = $this->M_laporan->saldo_kb($tahun);
			}
			

		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_laporan_aruskas', $data);
		$this->load->view('templates/footer');

	}

	//=====================================================AKHIR LAPORAN ARUS KAS======================================================

	//=====================================================LAPORAN POSISI KEUANGAN====================================================
	public function poskeu(){

		$data['user'] = $_SESSION['nama'];
		$data['role'] = $_SESSION['role'];
		$data['judul']='Laporan Posisi Keuangan';
		$data['active']='active';
		
		$data['pos_nr1']=['Aset Lancar','Aset Tetap'];
		$data['pos_nr2']=['Kewajiban','Ekuitas'];
		$data['pos_lr']=['Pendapatan','Beban','Pajak'];

		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
	
		if ($this->input->post('tahun_post') && $this->input->post('bulan_post')) 
		{			

			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");

			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan'] = $bi[$this->input->post('bulan_post')];

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

			$data['posakun']=$this->M_laporan->tampil_poskeu();
			$data['lr'] = $this->M_laporan->total_labarugi($data);

		} elseif ($this->input->post('tanggal_awal')) {
			$tahun_jika = date('Y',strtotime($this->input->post('tanggal_awal')));
			$data['tahun_jika'] = $tahun_jika;
			$data['tahun'] = $tahun_jika;
			$tgl_awal = $this->input->post('tanggal_awal');

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {
				$data['bulan']=date('m',strtotime($tgl_awal));
				$data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$data['dk_awal_k'] = $this->input->post('tanggal_awal');
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

				$data['lr'] = $this->M_laporan->total_labarugi($data);


			}  elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);

			}

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');

			$data['posakun']=$this->M_laporan->tampil_posakun();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
		} else {

				$data['bulan'] = date('m');
				$data['tahun'] = date('Y');

				$bulan = $data['bulan'];
				$tahun = date('Y');

				$bi = $this->M_akuntansi->bulan_indo();
				$data['nama_bulan']= $bi[date('m')];

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
			} else {

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
			}
			

		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/v_laporan_poskeu', $data);
		$this->load->view('templates/footer');

	}

	//=====================================================AKHIR LAPORAN POSISI KEUANGAN==============================================

	//=======================================================CETAK FILE===============================================================
	public function cetak_daftarakun(){

		$data['daftar_akun']=$this->M_backend->tampil_daftarakun();

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-daftar-akun.pdf";
	    $this->pdf->load_view('cetak/data_akun', $data);

	}

	public function cetak_anggota(){

		$data['anggota']=$this->M_backend->tampil_anggota();

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-daftar-anggota.pdf";
	    $this->pdf->load_view('cetak/data_anggota', $data);

	}

	public function cetak_ju(){

		if ($this->input->post('katakunci')) {

			$data['jurnal_umum'] =$this->M_akuntansi->cari_jurnalumum();
			$data['katakunci'] = $this->input->post('katakunci');
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();

		} elseif ($this->input->post('tanggal_awal')) {

			$data['jurnal_umum'] =$this->M_akuntansi->cari_tanggal_jurnalumum();
			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

			$data['jurnal_umum'] = $this->M_akuntansi->cari_bulantahunjurnalumum();
			$bi = $this->M_akuntansi->bulan_indo();
			$data['bulan_nama'] = $bi[$this->input->post('bulan_post')];
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();

		} elseif ($this->input->post('tahun_post')) {

			$data['jurnal_umum'] = $this->M_akuntansi->cari_tahunjurnalumum();
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();

		} else {
			$bi = $this->M_akuntansi->bulan_indo();
			$data['bulan_nama']= $bi[date('m')];
			$data['jurnal_umum'] = $this->M_akuntansi->tampil_jurnalumum();
			$data['total_debit'] = $this->M_akuntansi->total_debit();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit();
			
		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'landscape');
	    $this->pdf->filename = "laporan-jurnal-umum.pdf";
	    $this->pdf->load_view('cetak/jurnal_umum', $data);
	}

	public function cetak_jp(){

		if ($this->input->post('katakunci')) {

			$data['tampil_jp'] =$this->M_akuntansi->cari_jp();
			$data['katakunci'] = $this->input->post('katakunci');
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();

		} elseif ($this->input->post('tanggal_awal')) {

			$data['tampil_jp'] =$this->M_akuntansi->cari_tanggal_jp();
			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

			$data['tampil_jp'] = $this->M_akuntansi->cari_bulantahunjp();
			$bi = $this->M_akuntansi->bulan_indo();
			$data['bulan_nama'] = $bi[$this->input->post('bulan_post')];
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();

		} elseif ($this->input->post('tahun_post')) {

			$data['tampil_jp'] = $this->M_akuntansi->cari_tahunjp();
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();

		} else {

			$bi = $this->M_akuntansi->bulan_indo();
			$data['bulan_nama']= $bi[date('m')];
			$data['tampil_jp'] = $this->M_akuntansi->tampil_jp();
			$data['total_debit'] = $this->M_akuntansi->total_debit_jp();
			$data['total_kredit'] = $this->M_akuntansi->total_kredit_jp();		

		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'landscape');
	    $this->pdf->filename = "laporan-jurnal-penyesuaian.pdf";
	    $this->pdf->load_view('cetak/jurnal_penyesuaian', $data);

	}

	public function cetak_simpanan(){

		$anggota = $this->M_laporan->lihat_anggota();
		$simpanan = $this->M_laporan->lihat_simpanan();
		$data['tahun'] = $this->input->post('tahun');
		$flag = array();
		$total = array();
		$tsimpanan_pokok=0;$tsimpanan_wajib=0;$tsimpanan_sukarela=0;$tsimpanan_lebaran=0;

		if ($simpanan==NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "simpanan_pokok" => 0, "simpanan_wajib" => 0, "simpanan_sukarela" => 0, "simpanan_lebaran" => 0));
			}
			array_push($total, array("tsimpanan_pokok" => $tsimpanan_pokok, "tsimpanan_wajib" => $tsimpanan_wajib, "tsimpanan_sukarela" => $tsimpanan_sukarela, "tsimpanan_lebaran" => $tsimpanan_lebaran));
			$data['total'] = $total;
			$data['anggota'] = $flag;
		}

		elseif ($simpanan!=NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				$simpanan_pokok=0;$simpanan_wajib=0;$simpanan_sukarela=0;$simpanan_lebaran=0;
				if ($anggota[$i]['status']=='Aktif') {
					for ($j=0; $j<count($simpanan); $j++) { 
						if ($anggota[$i]['id_anggota']==$simpanan[$j]['id_anggota']) {
							if ($simpanan[$j]['jenis_simpanan']=='Simpanan Pokok') {
								$simpanan_pokok = $simpanan_pokok + $simpanan[$j]['saldo'];
							}
							elseif ($simpanan[$j]['jenis_simpanan']=='Simpanan Wajib') {
								$simpanan_wajib = $simpanan_wajib + $simpanan[$j]['saldo'];
							}
							elseif ($simpanan[$j]['jenis_simpanan']=='Simpanan Sukarela') {
								$simpanan_sukarela = $simpanan_sukarela + $simpanan[$j]['saldo'];
							}
							elseif ($simpanan[$j]['jenis_simpanan']=='Tabungan Lebaran') {
								$simpanan_lebaran = $simpanan_lebaran + $simpanan[$j]['saldo'];
							}
						}
					}
					$tsimpanan_pokok+=$simpanan_pokok;
					$tsimpanan_wajib+=$simpanan_wajib;
					$tsimpanan_sukarela+=$simpanan_sukarela;
					$tsimpanan_lebaran+=$simpanan_lebaran;
					array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "simpanan_pokok" => $simpanan_pokok, "simpanan_wajib" => $simpanan_wajib, "simpanan_sukarela" => $simpanan_sukarela, "simpanan_lebaran" => $simpanan_lebaran));
				}
				elseif ($anggota[$i]['status']=='Tidak Aktif') {
					array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "simpanan_pokok" => 0, "simpanan_wajib" => 0, "simpanan_sukarela" => 0, "simpanan_lebaran" => 0));
				}
			}
			array_push($total, array("tsimpanan_pokok" => $tsimpanan_pokok, "tsimpanan_wajib" => $tsimpanan_wajib, "tsimpanan_sukarela" => $tsimpanan_sukarela, "tsimpanan_lebaran" => $tsimpanan_lebaran));
			$data['total'] = $total;
			$data['anggota'] = $flag;
		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'landscape');
	    $this->pdf->filename = "laporan-simpanan-anggota.pdf";
	    $this->pdf->load_view('cetak/simpanan', $data);

	}

	public function cetak_simpanan_a(){

		$id_anggota = $this->input->post('id_anggota');
		$data['anggota'] = $this->M_laporan->tampil_simpanan_a();
		$data['anggota1'] = $this->M_laporan->tampil_simpanan_a1();
		$data['tahun'] = $this->input->post('tahun');
		$nama = $data['anggota'][0]['nama'];
		if ($data['anggota']==NULL) {
			$anggota = $this->M_backend->get_id_anggota($id_anggota);
			$flag = array();
			array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota['id_anggota'], "nama" => $anggota['nama'], "simpanan_pokok" => 0, "simpanan_wajib" => 0, "simpanan_sukarela" => 0, "simpanan_lebaran" => 0));
			$data['anggota'] = $flag;
		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-simpanan-$nama.pdf";
	    $this->pdf->load_view('cetak/simpanan_a', $data);

	}

	public function cetak_pinjaman(){

		$anggota = $this->M_laporan->lihat_anggota();
		$pinjaman = $this->M_laporan->lihat_pinjaman();
		$angsuran = $this->M_laporan->lihat_angsuran();
		$data['tahun'] = $this->input->post('tahun');
		$flag = array();
		$total = array();
		$sumtotal=0;$sumsisa=0;

		if ($pinjaman==NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "alamat" => $anggota[$i]['alamat'], "total_pinjaman" => 0, "sisa_pinjaman" => 0));
			}
			array_push($total, array("sumtotal" => $sumtotal, "sumsisa" => $sumsisa));
			$data['anggota'] = $flag;
			$data['total'] = $total;
		}

		elseif ($pinjaman!=NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				if ($anggota[$i]['status']=='Aktif') {
					$query = $this->M_laporan->getpinjamanbyID($anggota[$i]['id_anggota']);
					if ($query==NULL) {
						array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "alamat" => $anggota[$i]['alamat'], "total_pinjaman" => 0, "sisa_pinjaman" => 0));
					}
					else{
						for ($j=0; $j<count($pinjaman); $j++) { 
							if ($anggota[$i]['id_anggota']==$pinjaman[$j]['id_anggota']) {
								$tangsur=0;$nangsur=0;$jasa=0;
								for ($k=0; $k<count($angsuran); $k++) { 
									if ($pinjaman[$j]['id_pinjaman']==$angsuran[$k]['id_pinjaman']) {
										$tangsur++;
										$nangsur = $angsuran[$k]['nominal'];
										$jasa = (float) $angsuran[$k]['jasa']/100;
									}
								}
								$sisa_pinjaman = $pinjaman[$j]['nominal'] - ($tangsur*($nangsur-($pinjaman[$j]['nominal']*$jasa)));
								array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "alamat" => $anggota[$i]['alamat'], "total_pinjaman" => $pinjaman[$j]['nominal'], "sisa_pinjaman" => $sisa_pinjaman));
								$sumtotal+=$pinjaman[$j]['nominal'];
								$sumsisa+=$sisa_pinjaman;
							}
						}
					}
				}
				elseif ($anggota[$i]['status']=='Tidak Aktif') {
					array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "alamat" => $anggota[$i]['alamat'], "total_pinjaman" => 0, "sisa_pinjaman" => 0));
				}
			}
			array_push($total, array("sumtotal" => $sumtotal, "sumsisa" => $sumsisa));
			$data['anggota'] = $flag;
			$data['total'] = $total;
		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-pinjaman-anggota.pdf";
	    $this->pdf->load_view('cetak/pinjaman', $data);

	}

	public function cetak_pinjaman_a(){

		$id_anggota = $this->input->post('id_anggota');
		$data['anggota'] = $this->M_laporan->tampil_pinjaman_a();
		$data['tahun'] = $this->input->post('tahun');
		$data['nama'] = $this->M_backend->get_id_anggota($id_anggota);
		$nama = $data['nama']['nama'];

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-pinjaman-$nama.pdf";
	    $this->pdf->load_view('cetak/pinjaman_a', $data);

	}

	public function cetak_angsuran(){

		$anggota = $this->M_laporan->lihat_anggota();
		$pinjaman = $this->M_laporan->lihat_pinjaman();
		$angsuran = $this->M_laporan->lihat_angsuran();
		$data['tahun'] = $this->input->post('tahun');
		$flag = array();
		$total = array();
		$sumtotal=0;$sumangsur=0;$sumjasa=0;

		if ($pinjaman==NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_pinjaman" => 0, "angsuran_pokok" => 0, "jasa" => 0, "angsuran_ke" => 0));
			}
			array_push($total, array("sumtotal" => $sumtotal, "sumangsur" => $sumangsur, "sumjasa" => $sumjasa));
			$data['anggota'] = $flag;
			$data['total'] = $total;
		}

		elseif ($pinjaman!=NULL) {
			for ($i=0; $i<count($anggota); $i++) { 
				if ($anggota[$i]['status']=='Aktif') {
					$query = $this->M_laporan->getpinjamanbyID($anggota[$i]['id_anggota']);
					if ($query==NULL) {
						array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_pinjaman" => 0, "angsuran_pokok" => 0, "jasa" => 0, "angsuran_ke" => 0));
					}
					else{
						for ($j=0; $j<count($pinjaman); $j++) { 
							if ($anggota[$i]['id_anggota']==$pinjaman[$j]['id_anggota']) {
								$tangsur=0;$nangsur=0;$jasa=0;
								for ($k=0; $k<count($angsuran); $k++) { 
									if ($pinjaman[$j]['id_pinjaman']==$angsuran[$k]['id_pinjaman']) {
										$tangsur++;
										$nangsur = $angsuran[$k]['nominal'];
										$jasa = (float) $angsuran[$k]['jasa']/100;
									}
								}
								$sisajasa = $pinjaman[$j]['nominal']*$jasa*$tangsur;
								$angsuran_pokok = ($tangsur*($nangsur-($pinjaman[$j]['nominal']*$jasa)));
								array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_pinjaman" => $pinjaman[$j]['nominal'], "angsuran_pokok" => $angsuran_pokok, "jasa" => $sisajasa, "angsuran_ke" => $tangsur));
								$sumtotal+=$pinjaman[$j]['nominal'];
								$sumangsur+=$angsuran_pokok;
								$sumjasa+=$sisajasa;
							}
						}
					}
				}
				elseif ($anggota[$i]['status']=='Tidak Aktif') {
					array_push($flag, array("tahun" => $this->input->post('tahun'),"id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_pinjaman" => 0, "angsuran_pokok" => 0, "jasa" => 0, "angsuran_ke" => 0));
				}
			}
			array_push($total, array("sumtotal" => $sumtotal, "sumangsur" => $sumangsur, "sumjasa" => $sumjasa));
			$data['anggota'] = $flag;
			$data['total'] = $total;
		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-angsuran-anggota.pdf";
	    $this->pdf->load_view('cetak/angsuran', $data);
	}

	public function cetak_shu(){

		$data['p_akun']=$this->M_laporan->tampil_posakun();
		$data['pos_akun']=['Pendapatan','Beban', 'Pajak'];

		if ($this->input->post('tanggal_awal')) {

			$tgl_awal = $this->input->post('tanggal_awal');
			$tgl_akhir = $this->input->post('tanggal_akhir');
			
			$tahun_jika = date("Y",strtotime($tgl_awal));
			$bulan = date("m",strtotime($tgl_awal));
	
			$data['tahun_jika'] = $tahun_jika;

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = $this->input->post('tanggal_awal');
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

			} elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			}
			
		} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {		
			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");
			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan'] = $bi[$this->input->post('bulan_post')];

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');

		} else {

			$data['bulan'] = date('m');
			$data['tahun'] = date('Y');

			$bulan = date('m');
			$tahun = date('Y');

			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan']= $bi[date('m')];

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));
			}
		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-shu.pdf";
	    $this->pdf->load_view('cetak/laporan_shu', $data);

	}

	public function cetak_shu_anggota(){

		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
	
		if ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');

			$data['posakun']=$this->M_laporan->tampil_posakun();
			$shu = $this->M_laporan->total_labarugi($data);

			$anggota = $this->M_laporan->lihat_anggota();
			$simpanan = $this->M_laporan->lihat_simpanan_shu();
			$pinjaman = $this->M_laporan->lihat_pinjaman_shu();
			$angsuran = $this->M_laporan->lihat_angsuran_shu();
			$totals = $this->M_laporan->sum_simpanan();
			$flag = array();

			//Mencari SHU Simpanan
			if ($simpanan==NULL) {
				for ($i=0; $i<count($anggota); $i++) { 
					array_push($flag, array("id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_simpanan" => 0, "shu_penyimpan" => 0));
				}
				$data['simpanan'] = $flag;
			}

			elseif ($simpanan!=NULL) {
				for ($i=0; $i<count($anggota); $i++) { 
					$tsimpan=array();
					if ($anggota[$i]['status']=='Aktif') {
						for ($j=0; $j<count($simpanan); $j++) { 
							if ($anggota[$i]['id_anggota']==$simpanan[$j]['id_anggota']) {
								$tsimpan[] = $simpanan[$j]['saldo'];
							}
						}
						$sum_simpanan = round(array_sum($tsimpan)/$totals['sum_simpanan']*$shu*0.16,0);
						array_push($flag, array("id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_simpanan" => array_sum($tsimpan), "shu_penyimpan" => $sum_simpanan));
					}
					elseif ($anggota[$i]['status']=='Tidak Aktif') {
						array_push($flag, array("id_anggota" => $anggota[$i]['id_anggota'], "nama" => $anggota[$i]['nama'], "total_simpanan" => 0, "shu_penyimpan" => 0));
					}
				}
				$data['simpanan'] = $flag;
			}

			$flag = array();
			$sum_jasa = array();

			//Mencari SHU Jasa
			if ($pinjaman==NULL) {
				for ($i=0; $i<count($anggota); $i++) { 
					array_push($flag, array("total_jasa" => 0, "shu_jasa" => 0));
				}
				$data['jasa'] = $flag;
			}

			elseif ($pinjaman!=NULL) {
				for ($i=0; $i<count($anggota); $i++) { 
					$tjasa=array();
					if ($anggota[$i]['status']=='Aktif') {
						for ($j=0; $j<count($pinjaman); $j++) { 
							if ($anggota[$i]['id_anggota']==$pinjaman[$j]['id_anggota']) {
								$periode=0;
								for ($k=0; $k<count($angsuran); $k++) { 
									if ($pinjaman[$j]['id_pinjaman']==$angsuran[$k]['id_pinjaman']) {
										$periode+=1;
									}
								}
								$tjasa[] = $pinjaman[$j]['nominal']*0.01*$periode;
								$sum_jasa[] = $pinjaman[$j]['nominal']*0.01*$periode;
							}
						}
						$jasa_shu = round(array_sum($tjasa)*$shu*0.24,0);
						array_push($flag, array("total_jasa" => array_sum($tjasa), "shu_jasa" => $jasa_shu));
					}
					elseif ($anggota[$i]['status']=='Tidak Aktif') {
						array_push($flag, array("total_jasa" => 0, "shu_jasa" => 0));
					}
				}
			}
			for ($i=0; $i<count($flag); $i++) { 
				if ($flag[$i]['total_jasa']!=0) {
					$flag[$i]['shu_jasa'] = round($flag[$i]['shu_jasa']/array_sum($sum_jasa),0);
				}
			}
			$data['jasa'] = $flag;

			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "laporan-shu-anggota.pdf";
			$this->pdf->load_view('cetak/laporan_shu_anggota', $data);

		}
	}

	public function cetak_bb(){

		$data['dd_kodeakun'] = $this->M_backend->ambil_dropdown();

		$data['dd_bulan'] = $this->M_akuntansi->dd_bulan();
		$data['jurnal_umum'] = $this->M_laporan->tampil_bukubesar();

		$data['bukber'] = $this->db->get_where('daftar_akun', ['akun'])->result_array();

		// AWAL DARI SEMUA INI

		if ($this->input->post('tanggal_awal')) {

			$t_aw = $this->input->post('tanggal_awal');
			$t_ak = $this->input->post('tanggal_akhir');

			$data['t_aw'] = $this->input->post('tanggal_awal');
			$data['t_ak'] = $this->input->post('tanggal_akhir');

			$month_awal = date("n", strtotime($t_aw));
			$month_akhir = date("n", strtotime($t_ak));

			$tahun = date("Y", strtotime($t_aw));

			$bulan = $month_awal;

			$data['tahun'] = $tahun;
			$data['bulan'] = $bulan;

			// echo date($tahun."-"."1"."-"."1");

			// echo $month_akhir;
			$data['nama_bulan'] = date("F", strtotime(date("Y") . "-" . $bulan . "-01"));

			if ($t_aw != date($tahun . "-" . "01" . "-" . "01")) {
				// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
				// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
				$bulan2 = $bulan - 1;
				$data['tahun_sa1'] = $tahun;
				$data['tahun_sa'] = $tahun;
				$data['tahun_sa2'] = $tahun - 1;

				// $date_now = date($tahun."-".$bulan."-d");
				// echo "$tgl";
				$data['date_awal'] = date($tahun . "-" . "01" . "-" . "01");
				$data['date_akhir_data12'] = date("Y-m-d", strtotime("$t_ak"));
				$data['date_akhir'] = date("Y-m-d", strtotime("$t_aw -1 day"));

				$data['tgl_awal_data'] = $t_aw;
				$data['tgl_akhir_data'] = $t_ak;



				// echo $data['tgl_awal_data'];
				// echo $data['tgl_akhir_data'];
				// echo "cek";
			} else {
				$date_now = date($tahun . "-" . $bulan . "-d");

				$data['tahun_sa1'] = $tahun;
				$data['tahun_sa'] = $data['tahun'];

				$data['date_awal'] = date($tahun . "-" . $bulan . "-01");
				$data['date_akhir'] = date($tahun . "-01-31");

				$data['tgl_awal_data'] = $t_aw;

				$data['tgl_akhir_data'] = $t_ak;
			}
		} elseif ($this->input->post('bulan_post')) {

			$data['tahun'] = $this->input->post('tahun_post');
			$data['bulan'] = $this->input->post('bulan_post');

			$tahun = $data['tahun'];
			$bulan = $data['bulan'];

			$data['nama_bulan'] = date("F", strtotime(date("Y") . "-" . $bulan . "-01"));

			if ($bulan != 1) {
				// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
				// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
				$bulan2 = $bulan - 1;

				$data['tahun_sa'] = $tahun;

				$date_now = date($tahun . "-" . $bulan . "-d");
				// echo "$tgl";
				$data['date_awal'] = date("Y-m-d", strtotime("$date_now first day of -$bulan2 month"));
				$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of -1 month"));

				$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

				$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
			} else {
				$date_now = date($tahun . "-" . $bulan . "-d");
				$data['tahun_sa'] = $tahun;

				$data['date_awal'] = date($tahun . "-" . $bulan . "-01");
				$data['date_akhir'] = date($tahun . "-01-31");

				$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

				$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
			}
		} else {

			if ($this->input->post('tahun_post')) {
				$data['tahun'] = $this->input->post('tahun_post');
				$data['bulan'] = 1;

				$bulan = 1;
				$tahun = $this->input->post('tahun_post');

				$data['tahun_sa'] = $tahun;

				$date_now = date($tahun . "-" . $bulan . "-d");
				$data['nama_bulan'] = 'Tahun';
				// echo "$tgl";
				$data['date_awal'] = date("Y-m-d", strtotime("first day of $date_now"));
				$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of +11 month"));

				$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

				$data['tgl_akhir_data'] = date("Y-m-d", strtotime("$date_now last day of +11 month"));
			} else {
				$data['tahun'] = date('Y');
				$data['bulan'] = date('m');

				$bulan = date('m');
				$tahun = date('Y');

				$data['nama_bulan'] = date("F", strtotime(date("Y") . "-" . $bulan . "-01"));

				if ($bulan != 1) {
					// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
					// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
					$bulan2 = $bulan - 1;

					$data['tahun_sa'] = $tahun;

					$date_now = date("Y-" . $bulan . "-d");
					// echo "$tgl";
					$data['date_awal'] = date("Y-m-d", strtotime("$date_now first day of -$bulan2 month"));
					$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of -1 month"));

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
				} else {
					$date_now = date("Y-" . $bulan . "-d");
					$data['tahun_sa'] = $data['tahun'];

					$data['date_awal'] = date("Y-" . $bulan . "-01");
					$data['date_akhir'] = date("Y-01-31");

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
				}
			}
		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-buku-besar.pdf";
	    $this->pdf->load_view('cetak/laporan_bukubesar', $data);

	}

	public function cetak_permodal(){

		$data['pos_nr2']=['Ekuitas'];

		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
	
		if ($this->input->post('tahun_post') && $this->input->post('bulan_post')) 
		{			

			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");

			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan'] = $bi[$this->input->post('bulan_post')];

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

			$data['posakun']=$this->M_laporan->tampil_poskeu();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
			$data['saldo_awal'] = $this->M_laporan->saldo_awal($tahun_post);

		} elseif ($this->input->post('tanggal_awal')) {
			$tahun_jika = date('Y',strtotime($this->input->post('tanggal_awal')));
			$data['tahun_jika'] = $tahun_jika;
			$data['tahun'] = $tahun_jika;
			$tgl_awal = $this->input->post('tanggal_awal');

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {
				$data['bulan']=date('m',strtotime($tgl_awal));
				$data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$data['dk_awal_k'] = $this->input->post('tanggal_awal');
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

				$data['lr'] = $this->M_laporan->total_labarugi($data);


			}  elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);

			}

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');
			$tahun_post = $this->input->post('tahun_post');

			$data['posakun']=$this->M_laporan->tampil_posakun();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
			$data['saldo_awal'] = $this->M_laporan->saldo_awal($tahun_post);
		} else {

				$data['bulan'] = date('m');
				$data['tahun'] = date('Y');

				$bulan = $data['bulan'];
				$tahun = date('Y');

				$bi = $this->M_akuntansi->bulan_indo();
				$data['nama_bulan']= $bi[date('m')];

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
				$data['saldo_awal'] = $this->M_laporan->saldo_awal($tahun);
			} else {

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
				$data['saldo_awal'] = $this->M_laporan->saldo_awal($tahun);
			}
			

		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-perubahan-modal.pdf";
	    $this->pdf->load_view('cetak/laporan_permodal', $data);

	}

	public function cetak_poskeu(){

		$data['judul']='Laporan Posisi Keuangan';
		$data['active']='active';
		
		$data['pos_nr1']=['Aset Lancar','Aset Tetap'];
		$data['pos_nr2']=['Kewajiban','Ekuitas'];
		$data['pos_lr']=['Pendapatan','Beban','Pajak'];

		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
	
		if ($this->input->post('tahun_post') && $this->input->post('bulan_post')) 
		{			

			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");

			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan'] = $bi[$this->input->post('bulan_post')];

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

			$data['posakun']=$this->M_laporan->tampil_poskeu();
			$data['lr'] = $this->M_laporan->total_labarugi($data);

		} elseif ($this->input->post('tanggal_awal')) {
			$tahun_jika = date('Y',strtotime($this->input->post('tanggal_awal')));
			$data['tahun_jika'] = $tahun_jika;
			$data['tahun'] = $tahun_jika;
			$tgl_awal = $this->input->post('tanggal_awal');

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {
				$data['bulan']=date('m',strtotime($tgl_awal));
				$data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$data['dk_awal_k'] = $this->input->post('tanggal_awal');
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

				$data['lr'] = $this->M_laporan->total_labarugi($data);


			}  elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);

			}

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');

			$data['posakun']=$this->M_laporan->tampil_posakun();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
		} else {

				$data['bulan'] = date('m');
				$data['tahun'] = date('Y');

				$bulan = $data['bulan'];
				$tahun = date('Y');

				$bi = $this->M_akuntansi->bulan_indo();
				$data['nama_bulan']= $bi[date('m')];

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
			} else {

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
			}
		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-posisi-keuangan.pdf";
	    $this->pdf->load_view('cetak/laporan_poskeu', $data);

	}

	public function cetak_aruskas(){

		$data['pos_nr1']=['Pendapatan','Beban','Aset Lancar', 'Kewajiban'];
		$data['pos_nr2']=['Aset Tetap'];
		$data['pos_lr']=['Ekuitas'];

		$data['dd_bulan']=$this->M_akuntansi->dd_bulan();
	
		if ($this->input->post('tahun_post') && $this->input->post('bulan_post')) 
		{			

			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");

			$bi = $this->M_akuntansi->bulan_indo();
			$data['nama_bulan'] = $bi[$this->input->post('bulan_post')];

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

			$data['posakun']=$this->M_laporan->tampil_poskeu();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
			$data['saldo_awal'] = $this->M_laporan->saldo_kb($tahun_post);

		} elseif ($this->input->post('tanggal_awal')) {
			$tahun_jika = date('Y',strtotime($this->input->post('tanggal_awal')));
			$data['tahun_jika'] = $tahun_jika;
			$data['tahun'] = $tahun_jika;
			$tgl_awal = $this->input->post('tanggal_awal');

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {
				$data['bulan']=date('m',strtotime($tgl_awal));
				$data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$data['dk_awal_k'] = $this->input->post('tanggal_awal');
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

				$data['lr'] = $this->M_laporan->total_labarugi($data);


			}  elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			$data['lr'] = $this->M_laporan->total_labarugi($data);

			}

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');
			$tahun_post = $this->input->post('tahun_post');

			$data['posakun']=$this->M_laporan->tampil_posakun();
			$data['lr'] = $this->M_laporan->total_labarugi($data);
			$data['saldo_awal'] = $this->M_laporan->saldo_kb($tahun_post);
		} else {

				$data['bulan'] = date('m');
				$data['tahun'] = date('Y');

				$bulan = $data['bulan'];
				$tahun = date('Y');

				$bi = $this->M_akuntansi->bulan_indo();
				$data['nama_bulan']= $bi[date('m')];

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
				$data['saldo_awal'] = $this->M_laporan->saldo_kb($tahun);
			} else {

				$data['posakun']=$this->M_laporan->tampil_posakun();
				$data['lr'] = $this->M_laporan->total_labarugi($data);
				$data['saldo_awal'] = $this->M_laporan->saldo_kb($tahun);
			}
			

		}

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-arus-kas.pdf";
	    $this->pdf->load_view('cetak/laporan_aruskas', $data);

	}

	//=======================================================AKHIR CETAK FILE=========================================================

}


?>