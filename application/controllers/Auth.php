<?php 
 
class Auth extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	}
 
	function index(){
		if ($this->session->userdata("role") == 'admin') {
			redirect('admin');
		}
		if ($this->session->userdata("role") == 'ketua') {
			redirect('ketua');
		}
		if ($this->session->userdata("role") == 'anggota') {
			redirect('anggota');
		}
		else{
			echo '<script language="javascript">alert("Anda Harus Login"); window.location.href="'. base_url('login') .'";</script>';
		}
	}
}