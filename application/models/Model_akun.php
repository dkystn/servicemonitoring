<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_akun extends CI_Model {

	var $table = 'user';
	var $column_order = array(null,'nama_user','prodi','fakultas','status_user',null); 
	var $column_search = array('nama_user','prodi','fakultas','status_user'); 
	var $order = array('id_user' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) 
		{
			if($_POST['search']['value']) 
			{
				if($i===0) 
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i)
					$this->db->group_end(); 
			}
			$i++;
		}
		
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_data()
    {

		// $this->db->join('regional', 'regional.id_regional = user.id_regional');
		// $this->db->join('cabang', 'cabang.id_cabang = user.id_cabang');
        $query = $this->db->get('user');
       return $query->result();
    }
	
    public function add_data($data)
    {
        $this->db->insert('user', $data);
    }
 
	function count_data_user(){
		return $this->db->count_all('user');
	}
	function count_data_tacit(){ 
		return $this->db->count_all('tacit');
	}
	function count_data_explicit(){
		return $this->db->count_all('explicit');
	}

	public function update_password_a($input1)
	{
		// query update
		$this->db->set('password', $input1);
		$this->db->where('id', 3);
		return $this->db->update('user');
	}
	public function delete($id)
	{
		$this->db->delete('user', array('id_user' => $id));
        return true;

	}

	public function update_data($nik , $nama_user , $gender, $username, $password, $level_pengguna , $status_user) {
        $this->db->update('user', array(
            'nik' => $nik,
            'nama_user' => $nama_user,
            'gender' => $gender,
            'username' => $username,
            'password' => $password,
            'level_pengguna' => $level_pengguna,
            'status_user' => $status_user
        ), array('id_user' => $id));
        return true;
	}


	public function getUsernameById($id_user)
    {
        // Query untuk mendapatkan username berdasarkan ID
        $this->db->select('nama_user');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            // Jika data ditemukan, kembalikan nama_user
            $row = $query->row();
            return $row->nama_user;
        } else {
            // Jika data tidak ditemukan, kembalikan null atau tindakan lainnya
            return null;
        }
    }
	public function getLVById($id_user)
    {
        // Query untuk mendapatkan username berdasarkan ID
        $this->db->select('level_pengguna');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            // Jika data ditemukan, kembalikan level_pengguna
            $row = $query->row();
            return $row->level_pengguna;
        } else {
            // Jika data tidak ditemukan, kembalikan null atau tindakan lainnya
            return null;
        }
    }

	public function getCabangByID($id_user)
	{
		// Ambil nilai 'cabang' berdasarkan user ID dari tabel 'user'
		$this->db->select('cabang');
		$this->db->from('user');
		$this->db->join('cabang', 'cabang.id_cabang = user.id_cabang');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->cabang;
		} else {
			return null;
		}
	}
	public function getCabangByID_admin($id)
	{
		// Ambil nilai 'cabang' berdasarkan user ID dari tabel 'user'
		$this->db->select('id_cabang');
		$this->db->from('cabang');
		$this->db->where('id_cabang', $id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->id_cabang;
		} else {
			return null;
		}
	}
	public function getCabangByID_admin_cabang($id)
	{
		// Ambil nilai 'cabang' berdasarkan user ID dari tabel 'user'
		$this->db->select('cabang');
		$this->db->from('cabang');
		$this->db->where('id_cabang', $id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->cabang;
		} else {
			return null;
		}
	}
	public function getID($id_user)
	{
		// Ambil nilai 'id_cabang' berdasarkan user ID dari tabel 'user'
		$this->db->select('user.id_cabang'); // Memberikan alias 'user' pada kolom
		$this->db->from('user');
		$this->db->join('cabang', 'cabang.id_cabang = user.id_cabang');
		$this->db->where('user.id_user', $id_user); // Menyebutkan nama tabel sebelum kolom pada kondisi where
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->id_cabang;
		} else {
			return null;
		}
	}
	public function getIDtypeoption($id_user)
	{
		// Ambil nilai 'id_cabang' berdasarkan user ID dari tabel 'user'
		$this->db->select('type_option.id_cabang'); // Memberikan alias 'type_option' pada kolom
		$this->db->from('type_option');
		$this->db->join('cabang', 'cabang.id_cabang = type_option.id_cabang');
		$this->db->where('user.id_user', $id_user); // Menyebutkan nama tabel sebelum kolom pada kondisi where
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->id_cabang;
		} else {
			return null;
		}
	}


	public function getJourneyByID($id_user)
	{
		$this->db->select('journey');
		$this->db->from('journey');
		$this->db->join('journey', 'journey.id_cabang = user.id_cabang');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->journey;
		} else {
			return null;
		}
		
	}
	public function ket($id_user)
	{
		
		$this->db->select('ket');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user');
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->ket;
		} else {
			return null;
		}
	}

	public function getRegional($id_user)
	{
		// Ambil nilai 'cabang' berdasarkan user ID dari tabel 'user'
		$this->db->select('regional');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user');
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->regional;
		} else {
			return null;
		}
	}
	public function getCabang()
	{
		// Ambil nilai 'cabang' dari tabel 'cabang'
		$query = $this->db->get('cabang');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data cabang.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}

	
	
	public function getJourney_option()
	{
		// Ambil nilai 'journey' dari tabel 'journey'
		$query = $this->db->get('journey');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data journey.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}
	public function getJourney($cabang)
	{
		// Ambil nilai 'journey' dari tabel 'journey'
		$this->db->where('id_cabang', $cabang);
		$query = $this->db->get('journey');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data journey.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}
	public function getPelabuhan_item()
	{
		// Ambil nilai 'pelabuhan' dari tabel 'pelabuhan'
		// $this->db->where('id_cabang', $cabang);
		$query = $this->db->get('pelabuhan');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data pelabuhan.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}
	public function getPelabuhan($cabang)
	{
		// Ambil nilai 'pelabuhan' dari tabel 'pelabuhan'
		$this->db->where('id_cabang', $cabang);
		$query = $this->db->get('pelabuhan');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data pelabuhan.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}
	public function getKapal_item()
	{
		// Ambil nilai 'kapal' dari tabel 'kapal'
		// $this->db->where('id_cabang', $cabang);
		$query = $this->db->get('kapal');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data kapal.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}
	public function getKapal($cabang)
	{
		// Ambil nilai 'kapal' dari tabel 'kapal'
		$this->db->where('id_cabang', $cabang);
		$query = $this->db->get('kapal');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data kapal.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}
	
	public function getTypeoptionByidjourney($journey)
	{
		// Ambil nilai 'kapal' dari tabel 'kapal'
		$this->db->where('id_journey', $journey);
		$query = $this->db->get('type_option');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data kapal.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}
	
	public function getTypeoptionByidpelabuhan($pelabuhan)
	{
		// Ambil nilai 'kapal' dari tabel 'kapal'
		$this->db->where('id_pelabuhan', $pelabuhan);
		$query = $this->db->get('type_option');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data kapal.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}
	
	public function getTypeoptionByidkapal($kapal)
	{
		// Ambil nilai 'kapal' dari tabel 'kapal'
		$this->db->where('id_kapal', $kapal);
		$query = $this->db->get('type_option');
		if ($query->num_rows() > 0) {
			// Jika data ada, kembalikan hasilnya
			return $query->result();
		} else {
			// Jika tidak ada data, tampilkan pesan error atau lakukan sesuatu yang sesuai
			// echo "Tidak ada data kapal.";
			return array(); // Kembalikan array kosong jika tidak ada data
		}
	}

}