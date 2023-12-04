<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_laporan extends CI_Model
    {
        public function get_data()
        {

            $query = $this->db->get('laporan');
            return $query->result(); 
        }
        
        public function get_data_by_status($status)
        {
            $id_user = $this->session->userdata('id_user'); // Mengambil id_user dari session (asumsi menggunakan framework CodeIgniter)
            //  $id_user = '32';
            $getCabang = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
            foreach ($getCabang->result_array() as $c) {
                $cabang = $c['id_cabang'];
            }

            $this->db->where('status', $status);
            $this->db->where('id_cabang', $cabang);
            $query = $this->db->get('laporan');

            return $query->result();
        }
        public function get_data_by_status_admin($status)
        {
            $this->db->where('status', $status);
            $query = $this->db->get('laporan');

            return $query->result();
        }



        public function update_laporan($id_laporan)
        {
            $data = array(
                'status' => 'setuju'
            );

            $this->db->where('id_laporan', $id_laporan);
            $this->db->update('laporan', $data);
        }
        public function update_laporan_tolak($id_laporan)
        {
            $data = array(
                'status' => 'tolak',
                'catatan' => $this->input->post('catatan')
            );


            $this->db->where('id_laporan', $id_laporan);
            $this->db->update('laporan', $data);
        }
        public function update_laporan_edit($id_laporan)
        {
            $data = array(
                'status' => 'tolak'
            );

            $this->db->where('id_laporan', $id_laporan);
            $this->db->update('laporan', $data);
        }
        public function search($search)
        {
            $this->db->like('nama', $search);
            $this->db->or_like('type', $search);
            $query = $this->db->get('laporan');
            return $query->result();
        }
        public function tambah_data($data)
        {
            $this->db->insert('laporan', $data);
        }
        public function get_laporan_by_id( $id)
        {
            $this->db->select('laporan.*, soal.soal');
            $this->db->from('laporan');
            $this->db->join('soal', 'soal.id_type_option = laporan.id_type_option');
            $this->db->where('laporan.id_laporan', $id);
            $query = $this->db->get();
            return $query->result();
        }
        
        // File: Model_laporan.php (Model)

        public function getLaporanDetail($id_type_option, $tanggal)
        {
            $this->db->select('*');
            $this->db->from('laporan');
            $this->db->where('id_type_option', $id_type_option);
            $this->db->where('tanggal', $tanggal);
            $query = $this->db->get();
            $laporan = $query->result();

            // Mengambil informasi soal berdasarkan id_type_option
            foreach ($laporan as $item) {
                $this->db->select('*');
                $this->db->from('soal');
                $this->db->where('id_type_option', $item->id_type_option);
                $soalQuery = $this->db->get();
                $item->soal = $soalQuery->result();
            }

            return $laporan;
        }
        public function getLaporanByTypeOptionAndTanggal($id_type_option, $tanggal) {
            // Gunakan query sesuai dengan struktur tabel laporan Anda
            $query = $this->db->select('*')
                              ->from('laporan')
                              ->where('id_type_option', $id_type_option)
                              ->where('tanggal', $tanggal)
                              ->get();
            
            // Kembalikan hasil query sebagai array objek
            return $query->result();
        }
        public function getLaporanById($laporan_id) {
            // Use the where() method instead of where_in() for a single ID
            $this->db->select('*');
            $this->db->from('laporan'); // Replace with the actual table name
            $this->db->where('id_laporan', $laporan_id);
            return $this->db->get()->row(); // Use row() to get a single row
        }
        
        public function getIdSoalById($laporan_id) {
            // Gunakan query sesuai dengan struktur tabel laporan Anda
            $this->db->select('id_soal');
            $this->db->from('laporan'); // Ganti dengan nama tabel soal yang sesuai
            $this->db->where('id_laporan', $laporan_id);
            return $this->db->get()->result();
        }
       
                

        function count_pre_ambon(){
            $this->db->select_sum('poin'); // Menghitung jumlah total pada kolom 'poin'
            $this->db->where('type_journey', 'Pre Journey'); // Menambahkan kondisi 'type_journey' = 'Pre Journey'
            $this->db->where('cabang', 'AMBON'); // Menambahkan kondisi 'cabang' = 'AMBON'
            $query = $this->db->get('laporan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;

                $this->db->where('type_journey', 'Pre Journey'); // Menambahkan kondisi 'type_journey' = 'Pre Journey'
                $this->db->where('cabang', 'AMBON'); // Menambahkan kondisi 'cabang' = 'AMBON'
                $count = $this->db->count_all_results('laporan'); // Menghitung jumlah data dengan kondisi yang sama

                if ($count > 0) {
                    $average_points = $total_points / $count;
                    return $average_points;
                }
            }

            return 0;
        }
        function count_port_ambon(){
            $this->db->select_sum('poin'); // Menghitung jumlah total pada kolom 'poin'
            $this->db->where('type_journey', 'Port Journey'); // Menambahkan kondisi 'type_journey' = 'Port Journey'
            $this->db->where('cabang', 'AMBON'); // Menambahkan kondisi 'cabang' = 'AMBON'
            $query = $this->db->get('laporan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;

                $this->db->where('type_journey', 'Port Journey'); // Menambahkan kondisi 'type_journey' = 'Port Journey'
                $this->db->where('cabang', 'AMBON'); // Menambahkan kondisi 'cabang' = 'AMBON'
                $count = $this->db->count_all_results('laporan'); // Menghitung jumlah data dengan kondisi yang sama

                if ($count > 0) {
                    $average_points = $total_points / $count;
                    return $average_points;
                }
            }

            return 0;
        }
        function count_on_ambon(){
            $this->db->select_sum('poin'); // Menghitung jumlah total pada kolom 'poin'
            $this->db->where('type_journey', 'On Board Journey'); // Menambahkan kondisi 'type_journey' = 'On Board Journey'
            $this->db->where('cabang', 'AMBON'); // Menambahkan kondisi 'cabang' = 'AMBON'
            $query = $this->db->get('laporan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;

                $this->db->where('type_journey', 'On Board Journey'); // Menambahkan kondisi 'type_journey' = 'On Board Journey'
                $this->db->where('cabang', 'AMBON'); // Menambahkan kondisi 'cabang' = 'AMBON'
                $count = $this->db->count_all_results('laporan'); // Menghitung jumlah data dengan kondisi yang sama

                if ($count > 0) {
                    $average_points = $total_points / $count;
                    return $average_points;
                }
            }

            return 0;
        }
        function count_post_ambon(){
            $this->db->select_sum('poin'); // Menghitung jumlah total pada kolom 'poin'
            $this->db->where('type_journey', 'Post Journey'); // Menambahkan kondisi 'type_journey' = 'Post Journey'
            $this->db->where('cabang', 'AMBON'); // Menambahkan kondisi 'cabang' = 'AMBON'
            $query = $this->db->get('laporan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;

                $this->db->where('type_journey', 'Post Journey'); // Menambahkan kondisi 'type_journey' = 'Post Journey'
                $this->db->where('cabang', 'AMBON'); // Menambahkan kondisi 'cabang' = 'AMBON'
                $count = $this->db->count_all_results('laporan'); // Menghitung jumlah data dengan kondisi yang sama

                if ($count > 0) {
                    $average_points = $total_points / $count;
                    return $average_points;
                }
            }

            return 0;
        }
        public function get_all_regional() {
            $query = $this->db->get('regional'); // Inisialisasi variabel $query
            return $query->result();
        } 
        public function get_regional($id) {
            $this->db->where('id_cabang', $id);
            $query = $this->db->get('cabang'); // Inisialisasi variabel $query
            return $query->result();
        }

        public function get_all_cabang() {
            $query = $this->db->get('cabang'); // Inisialisasi variabel $query
            return $query->result();
        }
        public function jenis_journey($id) {
            $this->db->where('id_cabang', $id);
            $query = $this->db->get('journey'); // Inisialisasi variabel $query
            return $query->result();
        } 
        public function pelabuhan_cabang($id) {
            $this->db->where('id_cabang', $id);
            $query = $this->db->get('pelabuhan');
            return $query->result();
        }
        
        public function kapal_cabang($id) {
            $this->db->where('id_cabang', $id);
            $query = $this->db->get('kapal');
            return $query->result();
        }


        public function pre_option($id) {
            $this->db->join('journey', 'type_option.id_journey = journey.id_journey');
            $this->db->where('journey.journey', 'Pre Journey');
            $this->db->where('type_option.id_cabang', $id);
            $query = $this->db->get('type_option');
            return $query->result();
        }
        
        
        public function post_option($id) {
            $this->db->join('journey', 'type_option.id_journey = journey.id_journey');
            $this->db->where('journey.journey', 'Post Journey');
            $this->db->where('type_option.id_cabang', $id);
            $query = $this->db->get('type_option');
            return $query->result();
        }

        public function detail_cabang($cabang) {
            $this->db->where('cabang', $cabang);
            $query = $this->db->get('detail_cabang');
            return $query->result();
        }


    public function getOptions($selectedValue, $cabang)
    {
        $options = array();

        // Query untuk mendapatkan opsi berdasarkan nilai yang dipilih
        $this->db->where('jenis_journey', $selectedValue);
        $this->db->where('cabang', $cabang);
        $query = $this->db->get('type_option');

        if ($query->num_rows() > 0) {
            $options = $query->result();
        }

        return $options;
    }

    public function getSoalDataByCondition()
    {
        // Misalnya, Anda ingin mengambil data "soal" dengan kondisi "last_input" tidak sama dengan hari ini
        $today = date('Y-m-d');

        $this->db->where('last_input !=', $today);
        $query = $this->db->get('soal');

        return $query->result();
    }





    public function getJourneyOptionsByPelabuhan($selectedPelabuhan)
    {
        // Query untuk mengambil opsi jenis perjalanan berdasarkan pelabuhan
        $query = $this->db->where('id_pelabuhan', $selectedPelabuhan)
                        ->get('type_option');

        // Mengembalikan hasil query dalam bentuk array
        return $query->result();
    }
    public function getJourneyOptionsBykapal($selectedkapal)
    {
        // Query untuk mengambil opsi jenis perjalanan berdasarkan kapal
        $query = $this->db->where('id_kapal', $selectedkapal)
                        ->get('type_option');

        // Mengembalikan hasil query dalam bentuk array
        return $query->result();
    }
    public function getJourneyOptionsByCabang($selectedCabang)
    {
        // Query untuk mengambil opsi jenis perjalanan berdasarkan kapal
        $query = $this->db->where('id_cabang', $selectedCabang)
                        ->get('journey');

        // Mengembalikan hasil query dalam bentuk array
        return $query->result();
    }
    public function getJourneyOptionsBytype_journey($selectedtype_journey)
    {
        // Query untuk mengambil opsi jenis perjalanan berdasarkan kapal
        $query = $this->db->where('id_journey', $selectedtype_journey)
                        ->get('type_option');

        // Mengembalikan hasil query dalam bentuk array
        return $query->result();
    }
    public function get_soal($selectedjourney, $selectedOption1, $selectedOption2, $selectedOption3, $selectedOption4)
    {
        $query = $this->db->join('journey', 'soal.id_journey = journey.id_journey')
                        ->where('journey.journey', $selectedjourney)
                        ->where('soal.id_type_option', $selectedOption1) // Tambahkan filter untuk option1
                        ->or_where('soal.id_type_option', $selectedOption2) // Tambahkan filter untuk option2
                        ->or_where('soal.id_type_option', $selectedOption3) // Tambahkan filter untuk option3
                        ->or_where('soal.id_type_option', $selectedOption4) // Tambahkan filter untuk option4
                        ->get('soal');
        return $query->result();
    }

    public function check_laporan_exists($idSoal, $tanggal)
    {
        $query = $this->db->where('id_soal', $idSoal)
                        ->where('tanggal', $tanggal)
                        ->get('laporan');

        return $query->num_rows() > 0;
    }

    // public function getSoal_all($selectedRegional, 
    //                             $selectedValue1,
    //                             $selectedValue2,
    //                             $selectedValue3,
    //                             $selectedOption,
    //                             $selectedCabang)
    // {
    //     // Query untuk mengambil opsi jenis perjalanan berdasarkan kapal
    //     $query = $this->db->from('soal')
    //                     ->join('journey', 'soal.id_journey = journey.id_journey')
    //                     ->where('id_regional', $selectedRegional)
    //                     ->where('id_cabang', $selectedCabang)
    //                     ->where('journey.journey', $selectedValue1)
    //                     // ->where('id_pelabuhan', $selectedValue2)
    //                     // ->where('id_kapal', $selectedValue3)
    //                     ->where('type_option', $selectedOption)
    //                     ->get('soal');

    //     // Mengembalikan hasil query dalam bentuk array
    //     return $query->result();
    // }

    public function journey($id_journey) {
        $this->db->where('id_journey', $id_journey);
        $query = $this->db->get('journey');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return null;
    }
    public function option($id_type_option) {
        $this->db->where('id_type_option', $id_type_option);
        $query = $this->db->get('type_option');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return null;
    }

    public function kapal($id_kapal) {
        $this->db->where('id_kapal', $id_kapal);
        $query = $this->db->get('kapal');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return "";
    }
    public function pelabuhan($id_pelabuhan) {
        $this->db->where('id_pelabuhan', $id_pelabuhan);
        $query = $this->db->get('pelabuhan');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return "";
    }
    public function getLaporan_edit($id, $id_type_option)
{
    // Mendapatkan semua nilai kolom jawaban_pilihan dari tabel laporan
    $this->db->select('laporan.*, soal.soal');
    $this->db->from('laporan');
    $this->db->join('soal', 'laporan.id_type_option = soal.id_type_option'); // Correct the join condition here
    $this->db->where('laporan.id_laporan', $id);
    $query = $this->db->get();
    return $query->result();
}

    public function edit_laporan($id_type_option, $tanggal) {
        $this->db->where('id_type_option', $id_type_option);
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get('laporan');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return "";
    }


} 
