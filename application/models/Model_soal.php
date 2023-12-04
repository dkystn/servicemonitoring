<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_soal extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_data()
	{
		$this->db->join('regional', 'regional.id_regional = soal.id_regional');
		$this->db->join('journey', 'journey.id_journey = soal.id_journey');
		$this->db->join('cabang', 'cabang.id_cabang = soal.id_cabang');
		$this->db->join('type_option', 'type_option.id_type_option = soal.id_type_option');
		// $this->db->join('pelabuhan', 'pelabuhan.id_pelabuhan = soal.id_pelabuhan');
		// $this->db->join('kapal', 'kapal.id_kapal = soal.id_kapal');
		$query = $this->db->get('soal');
		return $query->result();
	}
	public function get_dataall_soal()
	{
		$this->db->join('regional', 'regional.id_regional = soal.id_regional');
		$this->db->join('journey', 'journey.id_journey = soal.id_journey');
		$this->db->join('cabang', 'cabang.id_cabang = soal.id_cabang');
		$this->db->join('type_option', 'type_option.id_type_option = soal.id_type_option');
		$this->db->join('pelabuhan', 'pelabuhan.id_pelabuhan = soal.id_pelabuhan', 'left');
        $this->db->join('kapal', 'kapal.id_kapal = soal.id_kapal', 'left');
		$query = $this->db->get('soal');
		return $query->result();
	}
	public function getDataByFilters($regional, $cabang, $type, $type_journey, $type_option)
	{
		$this->db->select('*');
		$this->db->from('soal');
		$this->db->where('regional', $regional);
		$this->db->where('cabang', $cabang);
		$this->db->where('type', $type);
		$this->db->where('type_journey', $type_journey);
		$this->db->where('type_option', $type_option);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_soal_by_type($type)
	{
		$query = $this->db->get_where('soal', array('type' => $type));
		return $query->result_array();
	}
	public function get_filtered_data_option($pelabuhan)
	{
		// // Query untuk mengambil data berdasarkan filter
		// $this->db->from('type_option');

		// if ($pelabuhan !== '0') {
		// 	$this->db->where('pelabuhan', $pelabuhan);
		// }

		// else if ($kapal !== '0') {
		// 	$this->db->where('kapal', $kapal);
		// }


		// else if ($type_journey !== '0') {
		// 	$this->db->where('type_journey', $type_journey);
		// }

		// $query = $this->db->get();

		// Mengembalikan hasil query
		// return $query->result();
		// Query untuk mengambil data berdasarkan filter
		$this->db->where('pelabuhan', $pelabuhan);


		$query = $this->db->get('type_option'); // Ganti 'table_name' dengan nama tabel yang sesuai

		// Mengembalikan hasil query
		return $query->result();
	}
	public function get_filtered_data($regional, $cabang, $type, $typeJourney, $type_option_value)
	{
		// Query untuk mengambil data berdasarkan filter
		$this->db->where('regional', $regional);
		$this->db->where('cabang', $cabang);
		$this->db->where('type', $type);
		$this->db->where('type_journey', $typeJourney);
		$this->db->where('type_option', $type_option_value);


		$query = $this->db->get('soal'); // Ganti 'table_name' dengan nama tabel yang sesuai

		// Mengembalikan hasil query
		return $query->result();
	}
	public function get_soal_by_laporan($cabang, $type_journey, $type_option,  $tanggal)
	{
		$this->db->select('*');
		$this->db->from('soal');
		$this->db->where('id_cabang', $cabang);
		$this->db->where('id_journey', $type_journey);
		$this->db->where('id_type_option', $type_option);
		$this->db->where('last_input', $tanggal);
		$query = $this->db->get();
		return $query->result();
	}
	public function getSoalByTypeOption($id_type_option,  $tanggal) {
		// Gunakan query sesuai dengan struktur tabel soal Anda
		$query = $this->db->select('*') 
						  ->from('soal')
						  ->where('id_type_option', $id_type_option)
						  ->where('last_input', $tanggal)
						  ->get();
		
		// Kembalikan hasil query sebagai array objek
		return $query->result();
	}
	public function getSoalall($id_soal) {
        $this->db->where('id_soal', $id_soal);
        $query = $this->db->get('soal');
        return $query->row(); // Return a single row as an object
    }
	public function getSoalByLaporanId($id_soal) {
		$this->db->select('*');
		$this->db->from('soal'); // Change to the actual table name
		$this->db->where('id_soal', $id_soal);
		return $this->db->get()->row(); // Use row() to get a single row (object)
	}
	

	
	public function get_data_journey_null()
    {
		
            $this->db->join('cabang', 'cabang.id_cabang = journey.id_cabang');
			$query = $this->db->get('journey');
			return $query->result();
    }
	public function get_regional()
    {
		
			$query = $this->db->get('regional');
			return $query->result();
    }

	public function get_data_journey($cabang = null)
    {
		
			$this->db->where('id_cabang', $cabang);
        	$query = $this->db->get('journey');
       		return $query->result();
        
    }
	public function get_data_journey_cabang($journey, $cabang)
    {
		$this->db->where('id_journey', $journey);
		$this->db->where('id_cabang', $cabang);
        $query = $this->db->get('type_option');
        return $query->result();
        
    }
	
	public function get_data_soal_journey_cabang($journey, $cabang)
    {
		$this->db->join('regional', 'regional.id_regional = soal.id_regional');
		$this->db->join('journey', 'journey.id_journey = soal.id_journey');
		$this->db->join('cabang', 'cabang.id_cabang = soal.id_cabang');
		$this->db->join('type_option', 'type_option.id_type_option = soal.id_type_option');

		$this->db->where('journey.id_journey', $journey);
		$this->db->where('soal.id_cabang', $cabang);
        $query = $this->db->get('soal');
        return $query->result();
        
    }
	public function get_data_pelabuhan_null()
    {

		// $this->db->join('regional', 'regional.id_regional = pelabuhan.id_regional');
		$this->db->join('cabang', 'cabang.id_cabang = pelabuhan.id_cabang');
        $query = $this->db->get('pelabuhan');
       return $query->result();
    }
	public function get_data_pelabuhan($cabang = null)
    {

		// $this->db->join('regional', 'regional.id_regional = pelabuhan.id_regional');
		$this->db->where('id_cabang', $cabang);
        $query = $this->db->get('pelabuhan');
       return $query->result();
    }
	public function get_data_pelabuhan_newpelabuhan($cabang = null , $journey = null, $pelabuhan = null)
    {

		// $this->db->join('regional', 'regional.id_regional = pelabuhan.id_regional');
		$this->db->where('id_cabang', $cabang);
		$this->db->where('id_journey', $journey);
		$this->db->where('id_pelabuhan', $pelabuhan);
        $query = $this->db->get('type_option');
       return $query->result();
    }
	public function get_data_kapal_null()
    {

		// $this->db->join('regional', 'regional.id_regional = kapal.id_regional');
		$this->db->join('cabang', 'cabang.id_cabang = kapal.id_cabang');
        $query = $this->db->get('kapal');
       return $query->result();
    }
	public function get_data_kapal($cabang)
    {

		$this->db->where('id_cabang', $cabang);
        $query = $this->db->get('kapal');
       return $query->result();
    }
	
	public function get_data_type_option_null()
    {

		$this->db->join('journey', 'journey.id_journey = type_option.id_journey');
		$this->db->join('cabang', 'cabang.id_cabang = type_option.id_cabang');
        $query = $this->db->get('type_option');
       return $query->result();
    }
	public function get_data_type_option($cabang)
    {

		$this->db->where('id_cabang', $cabang);
        $query = $this->db->get('type_option');
       	return $query->result();
    }
	
	public function get_data_type_option_soal($dataJourney , $id_pelabuhan = null , $id_kapal= null)
    {
		if($id_pelabuhan != null){
			
		$this->db->where('id_pelabuhan', $pelabuhan);
		}
		if($id_kapal != null){
			
			$this->db->where('id_kapal', $kapal);
		}

		$this->db->where('id_journey', $dataJourney);
        $query = $this->db->get('type_option');
       	return $query->result();
    }
	
	public function get_data_soal($cabang)
    {
		$this->db->join('regional', 'regional.id_regional = soal.id_regional');
		$this->db->join('journey', 'journey.id_journey = soal.id_journey');
		$this->db->join('cabang', 'cabang.id_cabang = soal.id_cabang');
		$this->db->join('type_option', 'type_option.id_type_option = soal.id_type_option');

		$this->db->where('soal.id_cabang', $cabang);
        $query = $this->db->get('soal');
       return $query->result();
    }
	public function get_pelabuhan_by_id($id_pelabuhan) {
        return $this->db->get_where('pelabuhan', array('id_pelabuhan' => $id_pelabuhan))->row();
    }

    public function get_kapal_by_id($id_kapal) {
        return $this->db->get_where('kapal', array('id_kapal' => $id_kapal))->row();
    }
	public function get_regional_by_id($id_regional) {
        return $this->db->get_where('regional', array('id_regional' => $id_regional))->row();
    }

    public function get_cabang_by_id($id_cabang) {
        return $this->db->get_where('cabang', array('id_cabang' => $id_cabang))->row();
    }
	public function get_journey_by_id($id_journey) {
        return $this->db->get_where('journey', array('id_journey' => $id_journey))->row();
    }
	public function get_type_option_by_id($id_type_option) {
        return $this->db->get_where('type_option', array('id_type_option' => $id_type_option))->row();
    }
	public function get_cabang_by_regional($selected_regional)
	{
		// Ambil nilai 'cabang' dari tabel 'cabang'
   		$this->db->where('id_regional', $selected_regional);
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

	public function getIdRegionalFromName($nama_regional) {
			$this->db->select('id_regional');
			$this->db->where('regional', $nama_regional);
			$query = $this->db->get('regional');
			
			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->id_regional;
			} else {
				$data = array(
					
					'id_regional' => $idRegional
				);
				$this->db->insert('regional', $data);
		
				// Ambil ID yang baru saja dibuat
				$newId = $this->db->insert_id();
				
				return $newId;
				// return false;
			}
	}
		public function getIdCabangFromName($nama_cabang, $idRegional) {
			$this->db->select('id_cabang');
			$this->db->where('cabang', $nama_cabang);
			$query = $this->db->get('cabang');
			
			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->id_cabang;
			} else {
				$data = array(
					'cabang' => $nama_cabang,
					'id_regional' => $idRegional
				);
				$this->db->insert('cabang', $data);
		
				// Ambil ID yang baru saja dibuat
				$newId = $this->db->insert_id();
				
				return $newId;
				// return false;
			}
		}
		public function getIdJourneyFromName($nama_journey, $idCabang) {
			$this->db->select('id_journey');
			$this->db->where('journey', $nama_journey);
			$this->db->where('id_cabang', $idCabang);
			$query = $this->db->get('journey');
			
			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->id_journey;
			} else {
				$data = array(
					'journey' => $nama_journey,
					'id_cabang' => $idCabang
				);
				$this->db->insert('journey', $data);
		
				// Ambil ID yang baru saja dibuat
				$newId = $this->db->insert_id();
				
				return $newId;
				// return false;
			}
		}
		public function getIdTypeOptionFromName($nama_type_option, $idCabang, $idJourney, $id_pelabuhan = null, $id_kapal = null) {
			$this->db->select('id_type_option');
			$this->db->where('type_option', $nama_type_option);
			$this->db->where('id_cabang', $idCabang);
			$this->db->where('id_journey', $idJourney);
		
			if ($id_pelabuhan != null) {
				$this->db->where('id_pelabuhan', $id_pelabuhan);
			} else {
				$this->db->where('id_pelabuhan IS NULL');
			}
		
			if ($id_kapal != null) {
				$this->db->where('id_kapal', $id_kapal);
			} else {
				$this->db->where('id_kapal IS NULL');
			}
		
			$query = $this->db->get('type_option');
			
			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->id_type_option;
			} else {
				// Jika tidak ada data yang cocok, buat type_option baru
				$data = array(
					'type_option' => $nama_type_option,
					'id_cabang' => $idCabang,
					'id_journey' => $idJourney
				);
				if ($id_pelabuhan != null) {
					$data['id_pelabuhan'] = $id_pelabuhan;
				}
				if ($id_kapal != null) {
					$data['id_kapal'] = $id_kapal;
				}
				$this->db->insert('type_option', $data);
		
				// Ambil ID yang baru saja dibuat
				$newId = $this->db->insert_id();
				
				return $newId;
			}
		}
		
		
		
		public function getDataByIds($idRegional, $idCabang, $idJourney, $idTypeOption, $idKapal, $idPelabuhan, $type, $soal, $jawaban1, $jawaban2, $jawabanBenar)
{
    // Membangun kueri SQL untuk mencari data berdasarkan ID dan kolom yang diberikan
    $this->db->select('*');
    $this->db->from('soal');
    $this->db->where('id_regional', $idRegional);
    $this->db->where('id_cabang', $idCabang);
    $this->db->where('id_journey', $idJourney);
    $this->db->where('id_type_option', $idTypeOption);
    
    if ($idKapal !== null) {
        $this->db->where('id_kapal', $idKapal);
    } else {
        $this->db->where('id_kapal IS NULL');
    }
    
    if ($idPelabuhan !== null) {
        $this->db->where('id_pelabuhan', $idPelabuhan);
    } else {
        $this->db->where('id_pelabuhan IS NULL');
    }

    // Menambahkan kondisi untuk kolom yang ingin Anda periksa jika sama
    $this->db->where('type', $type);
    $this->db->where('soal', $soal);
    $this->db->where('jawaban_1', $jawaban1);
    $this->db->where('jawaban_2', $jawaban2);
    $this->db->where('jawaban_benar', $jawabanBenar);

    // Mengambil data dari database
    $query = $this->db->get();

    // Mengembalikan hasil query dalam bentuk array
    return $query->result_array(); // Mengembalikan semua data yang cocok atau array kosong jika tidak ada data yang cocok
	}

	public function getIdKapalFromName($nama_kapal, $idCabang) {
		$this->db->select('id_kapal');
		$this->db->where('kapal', $nama_kapal);
		$this->db->where('id_cabang', $idCabang);
		$query = $this->db->get('kapal');
			
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->id_kapal;
		} else {
			$data = array(
				'kapal' => $nama_kapal,
				'id_cabang' => $idCabang
			);
			$this->db->insert('kapal', $data);
		
			// Ambil ID yang baru saja dibuat
			$newId = $this->db->insert_id();
				
			return $newId;
			// return false;
		}
	}
		public function getIdPelabuhanFromName($nama_pelabuhan, $idCabang) {
			$this->db->select('id_pelabuhan');
			$this->db->where('pelabuhan', $nama_pelabuhan);
			$this->db->where('id_cabang', $idCabang);
			$query = $this->db->get('pelabuhan');
			
			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->id_pelabuhan;
			} else {
				$data = array(
					'pelabuhan' => $nama_pelabuhan,
					'id_cabang' => $idCabang
				);
				$this->db->insert('pelabuhan', $data);
		
				// Ambil ID yang baru saja dibuat
				$newId = $this->db->insert_id();
				
				return $newId;
				// return false;
			}
		}

	public function delete_all($table){
		// Mengosongkan (truncate) tabel, bukan menghapus data satu per satu
		$this->db->truncate($table);
	}
	public function get_total($table) {
        // Menghitung jumlah total data soal
        $this->db->from($table); // Ganti 'nama_tabel_soal' dengan nama tabel Anda
        return $this->db->count_all_results();
    }
}
