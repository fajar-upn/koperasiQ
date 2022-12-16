<?php

class M_berita extends CI_Model {

    public function insertBerita()
	{
		$data = [
		"tgl_terbit" =>date("Y-m-d"),
		"headlines" =>$this->input->post('judul',true),
		"isi_berita" =>$this->input->post('isi',true),	
		];	

		$this->db->insert('berita', $data);
	}

}
?>