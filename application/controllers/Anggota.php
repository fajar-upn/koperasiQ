<?php

class Anggota extends CI_Controller{
    function __construct(){
		parent::__construct();		
		$this->load->model('M_backend');
		$this->load->model('M_transaksi');
		$this->load->model('M_akuntansi');
		$this->load->model('M_laporan');
		$this->load->model('M_akuntansi');
		$this->load->model('UserModel');
		$this->load->helper('authlogin');
		$this->load->library('form_validation');
		anggota();
	}

	public function index(){
		$data['user'] = $_SESSION['nama'];
		$data['id_anggota'] = $_SESSION['id_anggota'];
		$data['anggota_a'] = $this->M_backend->count_anggota_a();
		$data['anggota_t'] = $this->M_backend->count_anggota_t();
		$data['simpanan'] = $this->M_backend->count_simpanan();
		$data['pinjaman'] = $this->M_backend->count_pinjaman();
		
		$this->load->view('tempanggota/header');
		$this->load->view('tempanggota/sidebar', $data);
		$this->load->view('koperasi/v_koperasi', $data);
		$this->load->view('tempanggota/footer');
	}

	// this function for change password user
	public function ubah_password(){
		$data['user'] = $_SESSION['nama'];
		$data['judul'] = "Ubah Password";
		$id_anggota = $_SESSION['id_anggota'];
		$data['dataAnggota'] =  $this->UserModel->getAnggotaArray($id_anggota);
		
		$this->load->view('tempanggota/header');
		$this->load->view('tempanggota/sidebar', $data);
		$this->load->view('master-data/v_ubah_password_anggota', $data);
		$this->load->view('tempanggota/footer');
	}

	// this function for process 'ubah_password'
	public function proses_ubah_password(){
		$data['user'] = $_SESSION['nama'];
		$data['judul'] = "Ubah Password";
		$id_anggota = $_SESSION['id_anggota'];
		$data['dataAnggota'] =  $this->UserModel->getAnggotaArray($id_anggota);

		$this->form_validation->set_rules('passwordLama', 'Password Lama', 'required');
		$this->form_validation->set_rules('passwordBaru', 'Password Baru', 'required|min_length[3]|matches[ulangPasswordBaru]');
		$this->form_validation->set_rules('ulangPasswordBaru', 'Ulang Password Baru', 'required|min_length[3]|matches[passwordBaru]');

		if($this->form_validation->run() == false){
			$this->load->view('tempanggota/header');
			$this->load->view('tempanggota/sidebar', $data);
			$this->load->view('master-data/v_ubah_password_anggota', $data);
			$this->load->view('tempanggota/footer');
		}else{
			$passwordLama = $this->input->post('passwordLama');
			$passwordBaru = $this->input->post('passwordBaru');
			// validate old password, user must know old password
			if(md5($passwordLama)!=$data['dataAnggota']['password']){
				$this->session->set_flashdata('pesan_sukses','Isikan password lama dengan benar!');
				redirect('anggota/ubah_password');
			}else{
			// 	// new password must not equal with old password
				if($passwordLama==$passwordBaru){
					$this->session->set_flashdata('pesan_sukses','Password baru sama dengan password lama!');
					redirect('anggota/ubah_password');
				}else{
					// insert password to database
					$md5_Password = md5($passwordBaru);
					$this->session->set_flashdata('pesan_sukses','Berhasil merubah password');
					$this->UserModel->ubahPassword($data['dataAnggota']['id_anggota'],$md5_Password);
					redirect('anggota');
				}
			}
		}
		

	}
}
