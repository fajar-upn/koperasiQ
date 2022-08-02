<?php

class Ketua extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('M_backend');
		$this->load->model('M_transaksi');
		$this->load->model('M_akuntansi');
		$this->load->model('M_laporan');
		$this->load->model('M_akuntansi');
		$this->load->helper('authlogin');
		$this->load->library('form_validation');
		ketua();
	}

	public function index(){

		$data['user'] = $_SESSION['nama'];
		$data['anggota_a'] = $this->M_backend->count_anggota_a();
		$data['anggota_t'] = $this->M_backend->count_anggota_t();
		$data['simpanan'] = $this->M_backend->count_simpanan();
		$data['pinjaman'] = $this->M_backend->count_pinjaman();
		
		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('koperasi/v_koperasi', $data);
		$this->load->view('tempketua/footer');

	}

	//==========================================SIMPANAN===========================================================================
	public function tampil_simpanan(){
		$data['user'] = $_SESSION['nama'];
		$data['anggota'] = $this->M_transaksi->tampil_anggota();
		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_laporan_simpanan', $data);
		$this->load->view('tempketua/footer');
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
		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_lihat_simpanan_a', $data);
		$this->load->view('tempketua/footer');
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
		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_lihat_simpanan_s', $data);
		$this->load->view('tempketua/footer');
	}

	//==========================================AKHIR SIMPANAN=======================================================================

	//==========================================PINJAMAN============================================================================
	public function tampil_pinjaman(){
		$data['user'] = $_SESSION['nama'];
		$data['anggota'] = $this->M_transaksi->tampil_anggota();
		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_laporan_pinjaman', $data);
		$this->load->view('tempketua/footer');
	}

	public function lihat_pinjaman_a(){

		$data['user'] = $_SESSION['nama'];
		$id_anggota = $this->input->post('id_anggota');
		$data['anggota'] = $this->M_laporan->tampil_pinjaman_a();
		$data['tahun'] = $this->input->post('tahun');
		$data['nama'] = $this->M_backend->get_id_anggota($id_anggota);

		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_lihat_pinjaman_a', $data);
		$this->load->view('tempketua/footer');

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
		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_lihat_pinjaman_s', $data);
		$this->load->view('tempketua/footer');
	}

	//==========================================AKHIR PINJAMAN=======================================================================

	//==========================================ANGSURAN===========================================================================
	public function tampil_angsuran(){

		$data['user'] = $_SESSION['nama'];
		$data['anggota'] = $this->M_transaksi->tampil_anggota();
		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_laporan_angsuran', $data);
		$this->load->view('tempketua/footer');

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
		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_lihat_angsuran_s', $data);
		$this->load->view('tempketua/footer');

	}

	//==========================================AKHIR ANGSURAN=======================================================================

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

		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_jurnal_umum', $data);		
		$this->load->view('tempketua/footer');
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

		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_jurnal_penyesuaian', $data);
		$this->load->view('tempketua/footer');

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

		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_laporan_shu', $data);
		$this->load->view('tempketua/footer');

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

			$this->load->view('tempketua/header');
			$this->load->view('tempketua/sidebar', $data);
			$this->load->view('ketua/v_lihat_shu_anggota', $data);
			$this->load->view('tempketua/footer');

		}
		else {

			$this->load->view('tempketua/header');
			$this->load->view('tempketua/sidebar', $data);
			$this->load->view('ketua/v_shu_anggota', $data);
			$this->load->view('tempketua/footer');

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

		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_laporan_bukubesar', $data);
		$this->load->view('tempketua/footer');

	}

	public function get_kodeakun(){

		$kode_akun=$this->input->post('kode_akun');
		$data=$this->M_backend->isi_field_byKode($kode_akun);
		echo json_encode($data);
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

		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_laporan_permodal', $data);
		$this->load->view('tempketua/footer');

	}

	//==========================================AKHIR LAPORAN PERUBAHAN MODAL=========================================================

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

		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_laporan_poskeu', $data);
		$this->load->view('tempketua/footer');

	}

	//=====================================================AKHIR LAPORAN POSISI KEUANGAN==============================================

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

		$this->load->view('tempketua/header');
		$this->load->view('tempketua/sidebar', $data);
		$this->load->view('ketua/v_laporan_aruskas', $data);
		$this->load->view('tempketua/footer');

	}

	//=====================================================AKHIR LAPORAN ARUS KAS======================================================

	//=======================================================CETAK FILE===============================================================
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