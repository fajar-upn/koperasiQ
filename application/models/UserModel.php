<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model {
    
    public function get($username){
        $this->db->where('username', $username); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('user')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    // check from table 'anggota'
    public function getAnggota($username){
        $this->db->where('id_anggota', $username);
        $result = $this->db->get('anggota')->row();
        return $result;
    }

    // for get
    public function getAnggotaArray($username){
        $this->db->where('id_anggota', $username);
        $result = $this->db->get('anggota')->row_array();
        return $result;
    }

    // update new password
    public function ubahPassword($id_anggota,$password_baru){
        $this->db->set('password', $password_baru);
        $this->db->where('id_anggota', $id_anggota);
        $this->db->update('anggota');
    }
}