<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_explicit extends CI_Model
{
    public function get_data()
    {

        $query = $this->db->get('explicit');
        return $query->result();
    }

    public function get_data_by_status($status)
    {
        $this->db->where('status', $status);
        $query = $this->db->get('explicit');

        return $query->result();
    }
    public function update_status($id_explicit)
    {
        $data = array(
            'status' => 'Aktif'
        );

        $this->db->where('id_explicit', $id_explicit);
        $this->db->update('explicit', $data);
    }
    public function search($search)
    {
        $this->db->like('judul_explicit', $search);
        $this->db->or_like('keterangan_explicit', $search);
        $query = $this->db->get('explicit');
        return $query->result();
    }
    public function tambah_data($data)
    {
        $this->db->insert('explicit', $data);
    }
    public function get_explicit_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('explicit');
        $this->db->where('id_explicit', $id);
        $query = $this->db->get();
        return $query->row();
    }
}
