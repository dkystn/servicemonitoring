<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tacit extends CI_Model {

	public function get_data()
    {

        $query = $this->db->get('tacit');
       return $query->result();
    }
    public function get_data_by_status($status)
    {
        $this->db->where('status', $status);
        $query = $this->db->get('tacit');

        return $query->result();

    }
    public function update_status($id_tacit)
    {
        $data = array(
            'status' => 'Aktif'
        );

        $this->db->where('id_tacit', $id_tacit);
        $this->db->update('tacit', $data);
    }
    public function search($search) {
        $this->db->like('judul_tacit', $search);
        $this->db->or_like('keterangan_tacit', $search);
        $query = $this->db->get('tacit');
        return $query->result();
    }
}