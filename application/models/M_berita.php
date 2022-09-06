<?php

class M_backend extends CI_Model {

    public function insertBerita()
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

}
?>