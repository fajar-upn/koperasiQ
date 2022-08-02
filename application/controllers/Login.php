<?php

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('UserModel');
	}


	public function index(){
		$this->load->view('koperasi/v_login');
	}

	public function aksi_login(){
		$username = $this->input->post('username'); // Ambil isi dari inputan username pada form login
		$password = md5($this->input->post('password')); // Ambil isi dari inputan password pada form login dan encrypt dengan md5
		$user = $this->UserModel->get($username); // Panggil fungsi get yang ada di UserModel.php
		$user1 = $this->UserModel->getAnggota($username); //check from database 'anggota'
		if(empty($user)){ // Jika hasilnya kosong / user tidak ditemukan
			// $this->session->set_flashdata('message', 'Username tidak ditemukan'); // Buat session flashdata
			// redirect('login'); // Redirect ke halaman login
			if(empty($user1)){
				echo '<script language="javascript">alert("User Tidak Ditemukan, Silakan Coba Lagi"); window.location.href="'. base_url('Login') .'";</script>';
			}else {
				if($password == $user1->password){ // Jika password yang diinput sama dengan password yang didatabase
					$session = array(
					// 'authenticated'=>true, // Buat session authenticated dengan value true
					'id_anggota'=>$user1->id_anggota,
					'nama'=>$user1->nama, // Buat session nama
					'alamat'=>$user1->alamat,
					'foto'=>$user1->foto,
					'email'=>$user1->email,
					'role'=>$user1->role, //buat session role
					'status'=>$user1->status
					);
					$this->session->set_userdata($session); // Buat session sesuai $session
					echo '<script language="javascript">alert("Anda Berhasil Login"); window.location.href="'. base_url('auth') .'";</script>';
				}
				else{
					// $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
					// redirect('login'); // Redirect ke halaman login
					echo '<script language="javascript">alert("Password Salah, Silakan Coba Lagi"); window.location.href="'. base_url('Login') .'";</script>';
				}
			}
		}
		else{
			if($password == $user->password){ // Jika password yang diinput sama dengan password yang didatabase
				$session = array(
				// 'authenticated'=>true, // Buat session authenticated dengan value true
				'id_user'=>$user->id_user,
				'username'=>$user->username,  // Buat session username
				'nama'=>$user->nama, // Buat session nama
				'role'=>$user->role //buat session role
				);
				$this->session->set_userdata($session); // Buat session sesuai $session
				echo '<script language="javascript">alert("Anda Berhasil Login"); window.location.href="'. base_url('auth') .'";</script>';
			}
			else{
				// $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
				// redirect('login'); // Redirect ke halaman login
				echo '<script language="javascript">alert("Password Salah, Silakan Coba Lagi"); window.location.href="'. base_url('Login') .'";</script>';
			}
			
		}
	}

	// this code for change password
	
 
	public function logout(){
		$this->session->sess_destroy();
		echo '<script language="javascript">alert("Anda Berhasil Log Out"); window.location.href="'. base_url('login') .'";</script>';
	}

}



?>