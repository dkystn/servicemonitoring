<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sesi_login=$this->session->userdata('loginMasuk');
		if($sesi_login == false )
		{
			redirect('admin');
		}
	}
	private function getData($id) {
        $this->load->database(); // Menghubungkan ke database
        $this->db->select('poin_kendaraan');
        $this->db->from('laporan');
        $this->db->where('id_cabang', $id);
        $this->db->where('status', 'setuju');
        $this->db->where('tanggal', date('Y-m-d')); // Laporan di hari ini saja

        $query = $this->db->get();
        $result = $query->row();

        return ($result !== null) ? $result->poin_kendaraan : 0;
    }
    private function getData_admin() {
        $this->load->database(); // Menghubungkan ke database
        $this->db->select('poin_kendaraan');
        $this->db->from('laporan');
        $this->db->where('status', 'setuju');
        $this->db->where('tanggal', date('Y-m-d')); // Laporan di hari ini saja

        $query = $this->db->get();
        $result = $query->row();

        return ($result !== null) ? $result->poin_kendaraan : 0;
    }
    private function getData_pej($id) {
        $this->load->database(); // Menghubungkan ke database
        $this->db->select('poin_pejalan_kaki');
        $this->db->from('laporan');
        $this->db->where('id_cabang', $id);
        $this->db->where('status', 'setuju');
        $this->db->where('tanggal', date('Y-m-d')); // Laporan di hari ini saja

        $query = $this->db->get();
        $result = $query->row();

        return ($result !== null) ? $result->poin_pejalan_kaki : 0;
    }
    private function getData_pej_admin() {
        $this->load->database(); // Menghubungkan ke database
        $this->db->select('poin_pejalan_kaki');
        $this->db->from('laporan');
        $this->db->where('status', 'setuju');
        $this->db->where('tanggal', date('Y-m-d')); // Laporan di hari ini saja

        $query = $this->db->get();
        $result = $query->row();

        return ($result !== null) ? $result->poin_pejalan_kaki : 0;
    }
    private function getDataall($type) {
        $this->load->database(); // Menghubungkan ke database
        $this->db->select('poin');
        $this->db->from('laporan');
        $this->db->where('type', $type);
        $this->db->where('status', 'setuju');
        $this->db->where('tanggal', date('Y-m-d')); // Laporan di hari ini saja

        $query = $this->db->get();
        $result = $query->row();
 
        return ($result !== null) ? $result->poin : 0;
    }
    public function index($cabang_id = null, $today = null)
	{
		// Dapatkan nilai cabang dari pengguna yang sedang login
        
        $id_user = $this->session->userdata('id_user');
        // $user = $this->Model_akun->getCabangByID($id_user);

        // Mendapatkan tanggal hari ini
        if ($today === null) {
            // Mendapatkan tanggal hari ini jika parameter $today tidak ada
            $today = date('Y-m-d');
        }

        $start_value = $this->input->get('start');
        if ($start_value !== null) {
            // Mendapatkan tanggal hari ini jika parameter $today tidak ada
            $today = $start_value ;
        }
    
        $data['today'] = $today;
        
 
		$data['title'] = 'Dasboard'; 
        $data['cabang'] = $this->Model_akun->getCabangByID($id_user);
        $data['ket'] = $this->Model_akun->getCabangByID($id_user);
        $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        $data['level'] = $this->Model_akun->getLVById($id_user);


        $cabang_id = $this->input->get('c');
        //cabang id
        $id = $cabang_id;
        if ($id === "") {
            $id = null;
        }
        $data['id'] = $id;

        // journey id
        $id_journey = $this->input->get('j');
        if ($id_journey === "") {
            $id_journey = null;
        }

        // kapal id
        $id_kapal = $this->input->get('k');
        if ($id_kapal === "") {
            $id_kapal = null;
        }
        $data['id_kapal'] = $id_kapal;
        $querykapal = $this->db->get_where('kapal', array('id_kapal' => $id_kapal, 'id_cabang' => $id));
        $rowkapal = $querykapal->row_array();

        if ($rowkapal) {
            // Print the ship name
            $data['nama_kapal'] = $rowkapal['kapal'];
        } else {
            $data['nama_kapal'] = null;
        }
        // pelabuahan id
        $id_pelabuhan = $this->input->get('p');
        if ($id_pelabuhan === "") {
            $id_pelabuhan =null;
        }
        $data['id_pelabuhan'] = $id_pelabuhan;
        $querypelabuhan = $this->db->get_where('pelabuhan', array('id_pelabuhan' => $id_pelabuhan, 'id_cabang' => $id));
        $rowpelabuhan = $querypelabuhan->row_array();

        if ($rowpelabuhan) {
            // Print the ship name
            $data['nama_pelabuhan'] = $rowpelabuhan['pelabuhan'];
        } else {
            $data['nama_pelabuhan'] = null;
        }
        //  Journey
        $journey = $this->input->get('j');
        if ($journey === "") {
            $journey =null;
        }
        // $data['journey'] = $journey;
        $queryjourney = $this->db->get_where('journey', array('id_journey' => $journey));
        $rowjourney = $queryjourney->row_array();

        if ($rowjourney) {
            // Print the ship name
            $data['nama_journey'] = $rowjourney['journey'];
            $namaJourney = $rowjourney['journey'];
            
        } else {
            $data['nama_journey'] = null;
            $namaJourney = null;
        }
        // var_dump("id" . $journey ."nama:". $namaJourney . "Id Cabang" . $id);
        //     die();
    
        // end date
        $end_value = $this->input->get('end');
        if ($end_value === "") {
            $end_value = null;
        }
        //nilai cabang
        if ($id === null) {
            $pre_poin = $this->Model_beranda->count('Pre Journey', $id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            $port_poin = $this->Model_beranda->count('Port Journey', $id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            $on_poin = $this->Model_beranda->count('On Board Journey', $id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            $post_poin = $this->Model_beranda->count('Post Journey', $id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            $all_poin = $this->Model_beranda->count_all($id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            
            // $pre_poin = $this->Model_beranda->count_pre_all($today);
            // $port_poin = $this->Model_beranda->count_port_all($today);
            // $on_poin = $this->Model_beranda->count_on_all($today);
            // $post_poin = $this->Model_beranda->count_post_all($today);
            // $all_poin = $this->Model_beranda->count_all_admin($today);

            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            // hitung jumlah item peilaian 
            $pre_item = $this->Model_beranda->count_item_admin( 'Pre Journey');
            $port_item = $this->Model_beranda->count_item_admin( 'Port Journey');
            $on_item = $this->Model_beranda->count_item_admin( 'On Board Journey');
            $post_item = $this->Model_beranda->count_item_admin( 'Post Journey');
            $all_item = $this->Model_beranda->count_item_all_admin();

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done_admin('Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done_admin('Port Journey', $today);
            $on_done = $this->Model_beranda->count_done_admin('On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done_admin('Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all_admin($today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows_admin();
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences_admin($today);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows_admin();
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences_admin($today);

            // Mengambil data dari database
            $kendaraanData = $this->getData_admin();
            $pejalanKakiData = $this->getData_admin();

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData_admin('Pre Journey', $today);
            $data['port_journey'] = $this->Model_beranda->getJourneyData_admin('Port Journey', $today);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData_admin('On Board Journey', $today);
            $data['post_journey'] = $this->Model_beranda->getJourneyData_admin('Post Journey', $today);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Pre Journey', $today);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Port Journey', $today);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('On Board Journey', $today);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Post Journey', $today);

            
            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);
            if($namaJourney != null)
            {
                $data['journey'] = $this->Model_beranda->item_journey_nama_no_cabang($namaJourney); 
            } else{
                $data['journey'] = $this->Model_beranda->item_admin(); 
            }
            
            $data['pre_next'] = $this->Model_beranda->item_admin_next('Pre Journey'); 
            $data['port_next'] = $this->Model_beranda->item_admin_next('Port Journey'); 
            $data['on_next'] = $this->Model_beranda->item_admin_next('On Board Journey'); 
            $data['post_next'] = $this->Model_beranda->item_admin_next('Post Journey'); 


            // Pastikan indeks ada dalam array dan memiliki nilai yang valid sebelum melakukan operasi matematika
            $data['pre_journey'] = $data['pre_journey'] ?? 0;
            $data['port_journey'] = $data['port_journey'] ?? 0;
            $data['on_board_journey'] = $data['on_board_journey'] ?? 0;
            $data['post_journey'] = $data['post_journey'] ?? 0;

            $total_poin = $data['pre_journey'] + $data['port_journey'] + $data['on_board_journey'] + $data['post_journey'];

            if ($total_poin !== 0) {
                $percentage = 100 / $total_poin;
                $data['pre_journey'] *= $percentage;
                $data['port_journey'] *= $percentage;
                $data['on_board_journey'] *= $percentage;
                $data['post_journey'] *= $percentage;
            } else {
                // Handle the error case when the divisor is zero
                $data['pre_journey'] = 0;
                $data['port_journey'] = 0;
                $data['on_board_journey'] = 0;
                $data['post_journey'] = 0;
            }

            $data['pre_journey_pejalan'] = $data['pre_journey_pejalan'] ?? 0;
            $data['port_journey_pejalan'] = $data['port_journey_pejalan'] ?? 0;
            $data['on_board_journey_pejalan'] = $data['on_board_journey_pejalan'] ?? 0;
            $data['post_journey_pejalan'] = $data['post_journey_pejalan'] ?? 0;
            // pejalan kaki
                $total_poin_pejalan = $data['pre_journey_pejalan'] + $data['port_journey_pejalan'] + $data['on_board_journey_pejalan'] + $data['post_journey_pejalan'];

                if ($total_poin_pejalan !== 0) {
                    $percentage_pejalan = 100 / $total_poin_pejalan;
                    $data['pre_journey_pejalan'] *= $percentage_pejalan;
                    $data['port_journey_pejalan'] *= $percentage_pejalan;
                    $data['on_board_journey_pejalan'] *= $percentage_pejalan;
                    $data['post_journey_pejalan'] *= $percentage_pejalan;
                } else {
                    // Handle the error case when the divisor is zero
                    $data['pre_journey_pejalan'] = 0;
                    $data['port_journey_pejalan'] = 0;
                    $data['on_board_journey_pejalan'] = 0;
                    $data['post_journey_pejalan'] = 0;
                }
            

            // Menyusun data untuk grafik kendaraan Bar chart
            $chart_data = [
                'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
                'datasets' => [
                    [
                        'label' => 'Kendaraan',
                        'data' => [
                            $data['pre_journey'],
                            $data['port_journey'],
                            $data['on_board_journey'],
                            $data['post_journey']
                        ],
                        'backgroundColor' => [
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384'
                        ],
                        'borderColor' => [
                            'red',
                            'red','red','red'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];
            // Menyusun data untuk grafik Pejalan Kaki Bar Chart
            $chart_data_pejalan = [
                'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
                'datasets' => [
                    [
                        'label' => 'Pejalan Kaki',
                        'data' => [
                            $data['pre_journey_pejalan'],
                            $data['port_journey_pejalan'],
                            $data['on_board_journey_pejalan'],
                            $data['post_journey_pejalan']
                        ],
                        'backgroundColor' => [
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB'
                        ],
                        'borderColor' => [
                            'blue','blue','blue','blue'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];

        } else {
            //$id === ada nilainya
            $data['id_cabang'] = $this->Model_akun->getCabangByID_admin($id);
             // hitung point
            $pre_poin = $this->Model_beranda->count('Pre Journey', $id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            $port_poin = $this->Model_beranda->count('Port Journey', $id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            $on_poin = $this->Model_beranda->count('On Board Journey', $id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            $post_poin = $this->Model_beranda->count('Post Journey', $id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            $all_poin = $this->Model_beranda->count_all($id, $today, $end_value, $id_pelabuhan, $id_kapal, $id_journey);
            
            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            // hitung jumlah item peilaian
            $pre_item = $this->Model_beranda->count_item($id,  'Pre Journey');
            $port_item = $this->Model_beranda->count_item($id,  'Port Journey');
            $on_item = $this->Model_beranda->count_item($id,  'On Board Journey');
            $post_item = $this->Model_beranda->count_item($id,  'Post Journey');
            $all_item = $this->Model_beranda->count_item_all($id);

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done($id,  'Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done($id,  'Port Journey', $today);
            $on_done = $this->Model_beranda->count_done($id,  'On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done($id,  'Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all($id, $today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // pilihan kapal
            $data['kapal'] = $this->Model_laporan->kapal_cabang($id);
            // pilihan pelabuhan
            $data['pelabuhan'] = $this->Model_laporan->pelabuhan_cabang($id);

            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows($id);
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences($id, $today);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows($id);
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences($id, $today);

            // Mengambil data dari database
            $kendaraanData = $this->getData($id);
            $pejalanKakiData = $this->getData_pej($id);

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData($id,  'Pre Journey', $today, $end_value);
            $data['port_journey'] = $this->Model_beranda->getJourneyData($id,  'Port Journey', $today, $end_value);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData($id,  'On Board Journey', $today, $end_value);
            $data['post_journey'] = $this->Model_beranda->getJourneyData($id,  'Post Journey', $today, $end_value);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Pre Journey', $today, $end_value);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Port Journey', $today, $end_value);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'On Board Journey', $today, $end_value);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Post Journey', $today, $end_value);


            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);
            if($namaJourney != null)
            {
                $data['journey'] = $this->Model_beranda->item_journey_nama($id, $namaJourney); 
            } elseif($id_pelabuhan != null) {
                $data['journey'] = $this->Model_beranda->item_journey_pelabuhan($id, $id_pelabuhan); 
            }elseif($id_kapal != null) {
                $data['journey'] = $this->Model_beranda->item_journey_kapal($id, $id_kapal); 
            } else {
                $data['journey'] = $this->Model_beranda->item($id); 
            }


            // label bar chart
            $journey_bar = $this->Model_beranda->item_barchart($id);
            $data['journey_bar'] = $journey_bar;
            $labels = array();

            // Loop melalui data 'journey' untuk mengisi array labels
            foreach ($journey_bar as $journeybar) {
                $labels[] = $journeybar['journey']; // Ganti 'nama_journey' dengan kolom yang sesuai di tabel 'journey'
            }
            $kendaraan_data = array();

            // Cek apakah label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $kendaraan_data[] = $data['pre_journey'];
            }

            // Cek apakah label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $kendaraan_data[] = $data['port_journey'];
            }

            // Cek apakah label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $kendaraan_data[] = $data['on_board_journey'];
            }

            // Cek apakah label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $kendaraan_data[] = $data['post_journey'];
            }

            $pejalan_data = array();

            // Cek apakah label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $pejalan_data[] = $data['pre_journey_pejalan'];
            }

            // Cek apakah label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $pejalan_data[] = $data['port_journey_pejalan'];
            }

            // Cek apakah label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $pejalan_data[] = $data['on_board_journey_pejalan'];
            }

            // Cek apakah label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $pejalan_data[] = $data['post_journey_pejalan'];
            }

            // bar pejalan kaki
            // Inisialisasi variabel total_poin dengan nol
            $total_poin_pejalan = 0;

            // Jika label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $total_poin_pejalan += $data['pre_journey_pejalan'];
            }

            // Jika label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $total_poin_pejalan += $data['port_journey_pejalan'];
            }

            // Jika label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $total_poin_pejalan += $data['on_board_journey_pejalan'];
            }

            // Jika label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $total_poin_pejalan += $data['post_journey_pejalan'];
            }

            // Jika total_poin_pejalan tidak sama dengan nol, lakukan perhitungan persentase
            if ($total_poin_pejalan !== 0) {
                $percentage = 100 / $total_poin_pejalan;

                // Jika label 'Pre Journey' ada dalam data journey, hitung persentase dan simpan kembali
                if (in_array('Pre Journey', $labels)) {
                    $data['pre_journey_pejalan'] *= $percentage;
                } else {
                    $data['pre_journey_pejalan'] = 0;
                }

                // Jika label 'Port Journey' ada dalam data journey, hitung persentase dan simpan kembali
                if (in_array('Port Journey', $labels)) {
                    $data['port_journey_pejalan'] *= $percentage;
                } else {
                    $data['port_journey_pejalan'] = 0;
                }

                // Jika label 'On Board Journey' ada dalam data journey, hitung persentase dan simpan kembali
                if (in_array('On Board Journey', $labels)) {
                    $data['on_board_journey_pejalan'] *= $percentage;
                } else {
                    $data['on_board_journey_pejalan'] = 0;
                }

                // Jika label 'Post Journey' ada dalam data journey, hitung persentase dan simpan kembali
                if (in_array('Post Journey', $labels)) {
                    $data['post_journey_pejalan'] *= $percentage;
                } else {
                    $data['post_journey_pejalan'] = 0;
                }
            } else {
                // Handle the error case when the divisor is zero
                $data['pre_journey_pejalan'] = 0;
                $data['port_journey_pejalan'] = 0;
                $data['on_board_journey_pejalan'] = 0;
                $data['post_journey_pejalan'] = 0;
            }
            // 


            $kendaraan_data = array();

            // Cek apakah label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $kendaraan_data[] = $data['pre_journey'];
            }

            // Cek apakah label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $kendaraan_data[] = $data['port_journey'];
            }

            // Cek apakah label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $kendaraan_data[] = $data['on_board_journey'];
            }

            // Cek apakah label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $kendaraan_data[] = $data['post_journey'];
            }

            $pejalan_data = array();

            // Cek apakah label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $pejalan_data[] = $data['pre_journey_pejalan'];
            }

            // Cek apakah label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $pejalan_data[] = $data['port_journey_pejalan'];
            }

            // Cek apakah label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $pejalan_data[] = $data['on_board_journey_pejalan'];
            }

            // Cek apakah label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $pejalan_data[] = $data['post_journey_pejalan'];
            }

            // Menyusun data untuk grafik kendaraan Bar chart
            $chart_data = [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Kendaraan',
                        'data' => $kendaraan_data,
                        'backgroundColor' => [
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384'
                        ],
                        'borderColor' => [
                            'red',
                            'red','red','red'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];
            // Menyusun data untuk grafik Pejalan Kaki Bar Chart
            $chart_data_pejalan = [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Pejalan Kaki',
                        'data' => $pejalan_data,
                        'backgroundColor' => [
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB'
                        ],
                        'borderColor' => [
                            'blue','blue','blue','blue'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];

        }
        //batas nilai cabang


        $data['cabang'] = $this->Model_akun->getCabang();
       
        

        // result di web
		// $data['pre_point_admin'] = ($pre_item != 0) ?  round($pre_poin / $pre_item) : 0;
		// $data['port_point_admin'] = ($port_item != 0) ?  round($port_poin / $port_item) : 0;
		// $data['on_point_admin'] = ($on_item != 0) ?  round($on_poin / $on_item) : 0;
		// $data['post_point_admin'] = ($post_item != 0) ?  round($post_poin / $post_item) : 0;
		// $data['all_point_admin'] = ($all_item != 0) ?  round($all_poin / $all_item) : 0;

        $data['pre_point_admin'] = $pre_poin ;
		$data['port_point_admin'] = $port_poin ;
		$data['on_point_admin'] = $on_poin;
		$data['post_point_admin'] = $post_poin ;
		$data['all_point_admin'] = ($all_item != 0) ?  round($all_poin / $all_item) : 0;
        
        
	
		// Menyiapkan data untuk chart  
		if ($kendaraanData + $pejalanKakiData !== 0) {
            $kendaraanPercentage = ($kendaraanData / ($kendaraanData + $pejalanKakiData)) * 100;
            $pejalanKakiPercentage = ($pejalanKakiData / ($kendaraanData + $pejalanKakiData)) * 100;
        } else {
            // Handle the error case when the divisor is zero
            $kendaraanPercentage = 0;
            $pejalanKakiPercentage = 0;
        }
         
	
		// Menambahkan data chart ke dalam variabel $data
		$data['kendaraanPercentage'] = $kendaraanPercentage;
		$data['pejalanKakiPercentage'] = $pejalanKakiPercentage;
 
       
        
        // Menyimpan data grafik dalam variabel $data
        $data['chart_data'] = json_encode($chart_data);
        $data['chart_data_pejalan'] = json_encode($chart_data_pejalan);
        


		$this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('dashboard/ambon/admin', $data);
        $this->load->view('admin/layout/footer');
		
	}
    public function index_ori($cabang_id = null, $today = null, $dateEnd = null)
	{
		// Dapatkan nilai cabang dari pengguna yang sedang login
        
        $id_user = $this->session->userdata('id_user');
        $user = $this->Model_akun->getCabangByID($id_user);
        $cabang = $user;

        // Mendapatkan tanggal hari ini
        if ($today === null) {
            // Mendapatkan tanggal hari ini jika parameter $today tidak ada
            $today = date('Y-m-d');
        }
        
    
        $data['today'] = $today;
        
 
		$data['title'] = 'Dasboard'; 
        $data['cabang'] = $this->Model_akun->getCabangByID($id_user);
        $data['ket'] = $this->Model_akun->getCabangByID($id_user);
        $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        $data['level'] = $this->Model_akun->getLVById($id_user);

        //cabang id
        $id = $cabang_id;
        if ($id === "") {
            $id =null;
        }
        $data['id'] = $id;
    
        //nilai cabang
        if ($id === null) {
            $pre_poin = $this->Model_beranda->count_pre_all($today);
            $port_poin = $this->Model_beranda->count_port_all($today);
            $on_poin = $this->Model_beranda->count_on_all($today);
            $post_poin = $this->Model_beranda->count_post_all($today);
            $all_poin = $this->Model_beranda->count_all_admin($today);

            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            // hitung jumlah item peilaian 
            $pre_item = $this->Model_beranda->count_item_admin( 'Pre Journey');
            $port_item = $this->Model_beranda->count_item_admin( 'Port Journey');
            $on_item = $this->Model_beranda->count_item_admin( 'On Board Journey');
            $post_item = $this->Model_beranda->count_item_admin( 'Post Journey');
            $all_item = $this->Model_beranda->count_item_all_admin();

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done_admin('Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done_admin('Port Journey', $today);
            $on_done = $this->Model_beranda->count_done_admin('On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done_admin('Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all_admin($today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows_admin();
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences_admin($today);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows_admin();
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences_admin($today);

            // Mengambil data dari database
            $kendaraanData = $this->getData_admin();
            $pejalanKakiData = $this->getData_admin();

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData_admin('Pre Journey', $today);
            $data['port_journey'] = $this->Model_beranda->getJourneyData_admin('Port Journey', $today);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData_admin('On Board Journey', $today);
            $data['post_journey'] = $this->Model_beranda->getJourneyData_admin('Post Journey', $today);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Pre Journey', $today);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Port Journey', $today);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('On Board Journey', $today);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Post Journey', $today);

            
            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);

            $data['journey'] = $this->Model_beranda->item_admin(); 
            
            $data['pre_next'] = $this->Model_beranda->item_admin_next('Pre Journey'); 
            $data['port_next'] = $this->Model_beranda->item_admin_next('Port Journey'); 
            $data['on_next'] = $this->Model_beranda->item_admin_next('On Board Journey'); 
            $data['post_next'] = $this->Model_beranda->item_admin_next('Post Journey'); 


            // Pastikan indeks ada dalam array dan memiliki nilai yang valid sebelum melakukan operasi matematika
            $data['pre_journey'] = $data['pre_journey'] ?? 0;
            $data['port_journey'] = $data['port_journey'] ?? 0;
            $data['on_board_journey'] = $data['on_board_journey'] ?? 0;
            $data['post_journey'] = $data['post_journey'] ?? 0;

            $total_poin = $data['pre_journey'] + $data['port_journey'] + $data['on_board_journey'] + $data['post_journey'];

            if ($total_poin !== 0) {
                $percentage = 100 / $total_poin;
                $data['pre_journey'] *= $percentage;
                $data['port_journey'] *= $percentage;
                $data['on_board_journey'] *= $percentage;
                $data['post_journey'] *= $percentage;
            } else {
                // Handle the error case when the divisor is zero
                $data['pre_journey'] = 0;
                $data['port_journey'] = 0;
                $data['on_board_journey'] = 0;
                $data['post_journey'] = 0;
            }

            $data['pre_journey_pejalan'] = $data['pre_journey_pejalan'] ?? 0;
            $data['port_journey_pejalan'] = $data['port_journey_pejalan'] ?? 0;
            $data['on_board_journey_pejalan'] = $data['on_board_journey_pejalan'] ?? 0;
            $data['post_journey_pejalan'] = $data['post_journey_pejalan'] ?? 0;
            // pejalan kaki
                $total_poin_pejalan = $data['pre_journey_pejalan'] + $data['port_journey_pejalan'] + $data['on_board_journey_pejalan'] + $data['post_journey_pejalan'];

                if ($total_poin_pejalan !== 0) {
                    $percentage_pejalan = 100 / $total_poin_pejalan;
                    $data['pre_journey_pejalan'] *= $percentage_pejalan;
                    $data['port_journey_pejalan'] *= $percentage_pejalan;
                    $data['on_board_journey_pejalan'] *= $percentage_pejalan;
                    $data['post_journey_pejalan'] *= $percentage_pejalan;
                } else {
                    // Handle the error case when the divisor is zero
                    $data['pre_journey_pejalan'] = 0;
                    $data['port_journey_pejalan'] = 0;
                    $data['on_board_journey_pejalan'] = 0;
                    $data['post_journey_pejalan'] = 0;
                }
            

            // Menyusun data untuk grafik kendaraan Bar chart
            $chart_data = [
                'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
                'datasets' => [
                    [
                        'label' => 'Kendaraan',
                        'data' => [
                            $data['pre_journey'],
                            $data['port_journey'],
                            $data['on_board_journey'],
                            $data['post_journey']
                        ],
                        'backgroundColor' => [
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384'
                        ],
                        'borderColor' => [
                            'red',
                            'red','red','red'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];
            // Menyusun data untuk grafik Pejalan Kaki Bar Chart
            $chart_data_pejalan = [
                'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
                'datasets' => [
                    [
                        'label' => 'Pejalan Kaki',
                        'data' => [
                            $data['pre_journey_pejalan'],
                            $data['port_journey_pejalan'],
                            $data['on_board_journey_pejalan'],
                            $data['post_journey_pejalan']
                        ],
                        'backgroundColor' => [
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB'
                        ],
                        'borderColor' => [
                            'blue','blue','blue','blue'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];

        } else {
            //$id === ada nilainya
            $data['id_cabang'] = $this->Model_akun->getCabangByID_admin($id);
             // hitung point
            $pre_poin = $this->Model_beranda->count_pre($id, $today);
            $port_poin = $this->Model_beranda->count_port($id, $today);
            $on_poin = $this->Model_beranda->count_on($id, $today);
            $post_poin = $this->Model_beranda->count_post($id, $today);
            $all_poin = $this->Model_beranda->count_all($id, $today);

            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            // hitung jumlah item peilaian
            $pre_item = $this->Model_beranda->count_item($id,  'Pre Journey');
            $port_item = $this->Model_beranda->count_item($id,  'Port Journey');
            $on_item = $this->Model_beranda->count_item($id,  'On Board Journey');
            $post_item = $this->Model_beranda->count_item($id,  'Post Journey');
            $all_item = $this->Model_beranda->count_item_all($id);

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done($id,  'Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done($id,  'Port Journey', $today);
            $on_done = $this->Model_beranda->count_done($id,  'On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done($id,  'Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all($id, $today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows($id);
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences($id, $today);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows($id);
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences($id, $today);

            // Mengambil data dari database
            $kendaraanData = $this->getData($id);
            $pejalanKakiData = $this->getData_pej($id);

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData($id,  'Pre Journey', $today);
            $data['port_journey'] = $this->Model_beranda->getJourneyData($id,  'Port Journey', $today);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData($id,  'On Board Journey', $today);
            $data['post_journey'] = $this->Model_beranda->getJourneyData($id,  'Post Journey', $today);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Pre Journey', $today);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Port Journey', $today);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'On Board Journey', $today);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Post Journey', $today);


            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);
            $data['journey'] = $this->Model_beranda->item($id); 


            // label bar chart
            $journey_bar = $this->Model_beranda->item_barchart($id);
            $data['journey_bar'] = $journey_bar;
            $labels = array();

            // Loop melalui data 'journey' untuk mengisi array labels
            foreach ($journey_bar as $journeybar) {
                $labels[] = $journeybar['journey']; // Ganti 'nama_journey' dengan kolom yang sesuai di tabel 'journey'
            }
            $kendaraan_data = array();

            // Cek apakah label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $kendaraan_data[] = $data['pre_journey'];
            }

            // Cek apakah label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $kendaraan_data[] = $data['port_journey'];
            }

            // Cek apakah label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $kendaraan_data[] = $data['on_board_journey'];
            }

            // Cek apakah label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $kendaraan_data[] = $data['post_journey'];
            }

            $pejalan_data = array();

            // Cek apakah label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $pejalan_data[] = $data['pre_journey_pejalan'];
            }

            // Cek apakah label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $pejalan_data[] = $data['port_journey_pejalan'];
            }

            // Cek apakah label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $pejalan_data[] = $data['on_board_journey_pejalan'];
            }

            // Cek apakah label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $pejalan_data[] = $data['post_journey_pejalan'];
            }

            // bar pejalan kaki
            // Inisialisasi variabel total_poin dengan nol
            $total_poin_pejalan = 0;

            // Jika label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $total_poin_pejalan += $data['pre_journey_pejalan'];
            }

            // Jika label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $total_poin_pejalan += $data['port_journey_pejalan'];
            }

            // Jika label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $total_poin_pejalan += $data['on_board_journey_pejalan'];
            }

            // Jika label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $total_poin_pejalan += $data['post_journey_pejalan'];
            }

            // Jika total_poin_pejalan tidak sama dengan nol, lakukan perhitungan persentase
            if ($total_poin_pejalan !== 0) {
                $percentage = 100 / $total_poin_pejalan;

                // Jika label 'Pre Journey' ada dalam data journey, hitung persentase dan simpan kembali
                if (in_array('Pre Journey', $labels)) {
                    $data['pre_journey_pejalan'] *= $percentage;
                } else {
                    $data['pre_journey_pejalan'] = 0;
                }

                // Jika label 'Port Journey' ada dalam data journey, hitung persentase dan simpan kembali
                if (in_array('Port Journey', $labels)) {
                    $data['port_journey_pejalan'] *= $percentage;
                } else {
                    $data['port_journey_pejalan'] = 0;
                }

                // Jika label 'On Board Journey' ada dalam data journey, hitung persentase dan simpan kembali
                if (in_array('On Board Journey', $labels)) {
                    $data['on_board_journey_pejalan'] *= $percentage;
                } else {
                    $data['on_board_journey_pejalan'] = 0;
                }

                // Jika label 'Post Journey' ada dalam data journey, hitung persentase dan simpan kembali
                if (in_array('Post Journey', $labels)) {
                    $data['post_journey_pejalan'] *= $percentage;
                } else {
                    $data['post_journey_pejalan'] = 0;
                }
            } else {
                // Handle the error case when the divisor is zero
                $data['pre_journey_pejalan'] = 0;
                $data['port_journey_pejalan'] = 0;
                $data['on_board_journey_pejalan'] = 0;
                $data['post_journey_pejalan'] = 0;
            }
            // 


            $kendaraan_data = array();

            // Cek apakah label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $kendaraan_data[] = $data['pre_journey'];
            }

            // Cek apakah label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $kendaraan_data[] = $data['port_journey'];
            }

            // Cek apakah label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $kendaraan_data[] = $data['on_board_journey'];
            }

            // Cek apakah label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $kendaraan_data[] = $data['post_journey'];
            }

            $pejalan_data = array();

            // Cek apakah label 'Pre Journey' ada dalam data journey
            if (in_array('Pre Journey', $labels)) {
                $pejalan_data[] = $data['pre_journey_pejalan'];
            }

            // Cek apakah label 'Port Journey' ada dalam data journey
            if (in_array('Port Journey', $labels)) {
                $pejalan_data[] = $data['port_journey_pejalan'];
            }

            // Cek apakah label 'On Board Journey' ada dalam data journey
            if (in_array('On Board Journey', $labels)) {
                $pejalan_data[] = $data['on_board_journey_pejalan'];
            }

            // Cek apakah label 'Post Journey' ada dalam data journey
            if (in_array('Post Journey', $labels)) {
                $pejalan_data[] = $data['post_journey_pejalan'];
            }

            // Menyusun data untuk grafik kendaraan Bar chart
            $chart_data = [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Kendaraan',
                        'data' => $kendaraan_data,
                        'backgroundColor' => [
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384'
                        ],
                        'borderColor' => [
                            'red',
                            'red','red','red'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];
            // Menyusun data untuk grafik Pejalan Kaki Bar Chart
            $chart_data_pejalan = [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Pejalan Kaki',
                        'data' => $pejalan_data,
                        'backgroundColor' => [
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB'
                        ],
                        'borderColor' => [
                            'blue','blue','blue','blue'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];

        }
        //batas nilai cabang


        $data['cabang'] = $this->Model_akun->getCabang();
       
        

        // result di web
		$data['pre_point_admin'] = ($pre_item != 0) ?  round($pre_poin / $pre_item) : 0;
		$data['port_point_admin'] = ($port_item != 0) ?  round($port_poin / $port_item) : 0;
		$data['on_point_admin'] = ($on_item != 0) ?  round($on_poin / $on_item) : 0;
		$data['post_point_admin'] = ($post_item != 0) ?  round($post_poin / $post_item) : 0;
		$data['all_point_admin'] = ($all_item != 0) ?  round($all_poin / $all_item) : 0;
        
        
	
		// Menyiapkan data untuk chart
		if ($kendaraanData + $pejalanKakiData !== 0) {
            $kendaraanPercentage = ($kendaraanData / ($kendaraanData + $pejalanKakiData)) * 100;
            $pejalanKakiPercentage = ($pejalanKakiData / ($kendaraanData + $pejalanKakiData)) * 100;
        } else {
            // Handle the error case when the divisor is zero
            $kendaraanPercentage = 0;
            $pejalanKakiPercentage = 0;
        }
         
	
		// Menambahkan data chart ke dalam variabel $data
		$data['kendaraanPercentage'] = $kendaraanPercentage;
		$data['pejalanKakiPercentage'] = $pejalanKakiPercentage;
 
       
        
        // Menyimpan data grafik dalam variabel $data
        $data['chart_data'] = json_encode($chart_data);
        $data['chart_data_pejalan'] = json_encode($chart_data_pejalan);
        


		$this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('dashboard/ambon/admin', $data);
        $this->load->view('admin/layout/footer');

		
	}
    public function index_item_null($cabang_id = null, $today = null)
	{
		// Dapatkan nilai cabang dari pengguna yang sedang login
        
        $id_user = $this->session->userdata('id_user');
        $user = $this->Model_akun->getCabangByID($id_user);
        $cabang = $user;

        // Mendapatkan tanggal hari ini
        if ($today === null) {
            // Mendapatkan tanggal hari ini jika parameter $today tidak ada
            $today = date('Y-m-d');
        }
        
    
        $data['today'] = $today;
        
 
		$data['title'] = 'Dasboard'; 
        $data['cabang'] = $this->Model_akun->getCabangByID($id_user);
        $data['ket'] = $this->Model_akun->getCabangByID($id_user);
        $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        $data['level'] = $this->Model_akun->getLVById($id_user);

        //cabang id
        $id = $cabang_id;
        if ($id === "") {
            $id =null;
        }
        $data['id'] = $id;
    
        //nilai cabang
        if ($id === null) {
            $pre_poin = $this->Model_beranda->count_pre_all($today);
            $port_poin = $this->Model_beranda->count_port_all($today);
            $on_poin = $this->Model_beranda->count_on_all($today);
            $post_poin = $this->Model_beranda->count_post_all($today);
            $all_poin = $this->Model_beranda->count_all_admin($today);

            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            // hitung jumlah item peilaian
            $pre_item = $this->Model_beranda->count_item_admin( 'Pre Journey');
            $port_item = $this->Model_beranda->count_item_admin( 'Port Journey');
            $on_item = $this->Model_beranda->count_item_admin( 'On Board Journey');
            $post_item = $this->Model_beranda->count_item_admin( 'Post Journey');
            $all_item = $this->Model_beranda->count_item_all_admin();

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done_admin('Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done_admin('Port Journey', $today);
            $on_done = $this->Model_beranda->count_done_admin('On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done_admin('Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all_admin($today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows_admin();
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences_admin($today);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows_admin();
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences_admin($today);

            // Mengambil data dari database
            $kendaraanData = $this->getData_admin();
            $pejalanKakiData = $this->getData_admin();

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData_admin('Pre Journey', $today);
            $data['port_journey'] = $this->Model_beranda->getJourneyData_admin('Port Journey', $today);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData_admin('On Board Journey', $today);
            $data['post_journey'] = $this->Model_beranda->getJourneyData_admin('Post Journey', $today);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Pre Journey', $today);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Port Journey', $today);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('On Board Journey', $today);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Post Journey', $today);


            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);

            $data['journey'] = $this->Model_beranda->item_admin(); 
            
            $data['pre_next'] = $this->Model_beranda->item_admin_next('Pre Journey'); 
            $data['port_next'] = $this->Model_beranda->item_admin_next('Port Journey'); 
            $data['on_next'] = $this->Model_beranda->item_admin_next('On Board Journey'); 
            $data['post_next'] = $this->Model_beranda->item_admin_next('Post Journey'); 
        } else {
            //$id === ada nilainya

             // hitung point
            $pre_poin = $this->Model_beranda->count_pre($id, $today);
            $port_poin = $this->Model_beranda->count_port($id, $today);
            $on_poin = $this->Model_beranda->count_on($id, $today);
            $post_poin = $this->Model_beranda->count_post($id, $today);
            $all_poin = $this->Model_beranda->count_all($id, $today);

            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            // hitung jumlah item peilaian
            $pre_item = $this->Model_beranda->count_item($id,  'Pre Journey');
            $port_item = $this->Model_beranda->count_item($id,  'Port Journey');
            $on_item = $this->Model_beranda->count_item($id,  'On Board Journey');
            $post_item = $this->Model_beranda->count_item($id,  'Post Journey');
            $all_item = $this->Model_beranda->count_item_all($id);

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done($id,  'Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done($id,  'Port Journey', $today);
            $on_done = $this->Model_beranda->count_done($id,  'On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done($id,  'Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all($id, $today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows($id);
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences($id, $today);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows($id);
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences($id, $today);

            // Mengambil data dari database
            $kendaraanData = $this->getData($id);
            $pejalanKakiData = $this->getData_pej($id);

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData($id,  'Pre Journey', $today);
            $data['port_journey'] = $this->Model_beranda->getJourneyData($id,  'Port Journey', $today);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData($id,  'On Board Journey', $today);
            $data['post_journey'] = $this->Model_beranda->getJourneyData($id,  'Post Journey', $today);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Pre Journey', $today);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Port Journey', $today);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'On Board Journey', $today);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Post Journey', $today);


            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);
            $data['journey'] = $this->Model_beranda->item($id); 
        }
        //batas nilai cabang


        $data['cabang'] = $this->Model_akun->getCabang();
       
        

        // result di web
		$data['pre_point_admin'] = ($pre_item != 0) ?  round($pre_poin / $pre_item) : 0;
		$data['port_point_admin'] = ($port_item != 0) ?  round($port_poin / $port_item) : 0;
		$data['on_point_admin'] = ($on_item != 0) ?  round($on_poin / $on_item) : 0;
		$data['post_point_admin'] = ($post_item != 0) ?  round($post_poin / $post_item) : 0;
		$data['all_point_admin'] = ($all_item != 0) ?  round($all_poin / $all_item) : 0;
        
        
	
		// Menyiapkan data untuk chart
		if ($kendaraanData + $pejalanKakiData !== 0) {
            $kendaraanPercentage = ($kendaraanData / ($kendaraanData + $pejalanKakiData)) * 100;
            $pejalanKakiPercentage = ($pejalanKakiData / ($kendaraanData + $pejalanKakiData)) * 100;
        } else {
            // Handle the error case when the divisor is zero
            $kendaraanPercentage = 0;
            $pejalanKakiPercentage = 0;
        }
         
	
		// Menambahkan data chart ke dalam variabel $data
		$data['kendaraanPercentage'] = $kendaraanPercentage;
		$data['pejalanKakiPercentage'] = $pejalanKakiPercentage;
 
       
        // Pastikan indeks ada dalam array dan memiliki nilai yang valid sebelum melakukan operasi matematika
        $data['pre_journey'] = $data['pre_journey'] ?? 0;
        $data['port_journey'] = $data['port_journey'] ?? 0;
        $data['on_board_journey'] = $data['on_board_journey'] ?? 0;
        $data['post_journey'] = $data['post_journey'] ?? 0;

        $total_poin = $data['pre_journey'] + $data['port_journey'] + $data['on_board_journey'] + $data['post_journey'];

        if ($total_poin !== 0) {
            $percentage = 100 / $total_poin;
            $data['pre_journey'] *= $percentage;
            $data['port_journey'] *= $percentage;
            $data['on_board_journey'] *= $percentage;
            $data['post_journey'] *= $percentage;
        } else {
            // Handle the error case when the divisor is zero
            $data['pre_journey'] = 0;
            $data['port_journey'] = 0;
            $data['on_board_journey'] = 0;
            $data['post_journey'] = 0;
        }

        $data['pre_journey_pejalan'] = $data['pre_journey_pejalan'] ?? 0;
        $data['port_journey_pejalan'] = $data['port_journey_pejalan'] ?? 0;
        $data['on_board_journey_pejalan'] = $data['on_board_journey_pejalan'] ?? 0;
        $data['post_journey_pejalan'] = $data['post_journey_pejalan'] ?? 0;
        // pejalan kaki
            $total_poin_pejalan = $data['pre_journey_pejalan'] + $data['port_journey_pejalan'] + $data['on_board_journey_pejalan'] + $data['post_journey_pejalan'];

            if ($total_poin_pejalan !== 0) {
                $percentage_pejalan = 100 / $total_poin_pejalan;
                $data['pre_journey_pejalan'] *= $percentage_pejalan;
                $data['port_journey_pejalan'] *= $percentage_pejalan;
                $data['on_board_journey_pejalan'] *= $percentage_pejalan;
                $data['post_journey_pejalan'] *= $percentage_pejalan;
            } else {
                // Handle the error case when the divisor is zero
                $data['pre_journey_pejalan'] = 0;
                $data['port_journey_pejalan'] = 0;
                $data['on_board_journey_pejalan'] = 0;
                $data['post_journey_pejalan'] = 0;
            }
        

        // Menyusun data untuk grafik kendaraan Bar chart
        $chart_data = [
            'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
            'datasets' => [
                [
                    'label' => 'Kendaraan',
                    'data' => [
                        $data['pre_journey'],
                        $data['port_journey'],
                        $data['on_board_journey'],
                        $data['post_journey']
                    ],
                    'backgroundColor' => [
                        '#FF6384',
                        '#FF6384',
                        '#FF6384',
                        '#FF6384'
                    ],
                    'borderColor' => [
                        'red',
                        'red','red','red'
                    ],
                    'borderWidth' => 1
                ]
            ]
        ];
        // Menyusun data untuk grafik Pejalan Kaki Bar Chart
        $chart_data_pejalan = [
            'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
            'datasets' => [
                [
                    'label' => 'Pejalan Kaki',
                    'data' => [
                        $data['pre_journey_pejalan'],
                        $data['port_journey_pejalan'],
                        $data['on_board_journey_pejalan'],
                        $data['post_journey_pejalan']
                    ],
                    'backgroundColor' => [
                        '#36A2EB',
                        '#36A2EB',
                        '#36A2EB',
                        '#36A2EB'
                    ],
                    'borderColor' => [
                        'blue','blue','blue','blue'
                    ],
                    'borderWidth' => 1
                ]
            ]
        ];

        // Menyimpan data grafik dalam variabel $data
        $data['chart_data'] = json_encode($chart_data);
        $data['chart_data_pejalan'] = json_encode($chart_data_pejalan);
        


		$this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('dashboard/detail/admin', $data);
        $this->load->view('admin/layout/footer');

		
	}
    public function index_item($journey = null,  $today = null, $cabang_id = null)
	{
        
		$data['title'] = 'Dasboard'; 
        // params

        // Mendapatkan tanggal hari ini
        if ($today === null) {
            // Mendapatkan tanggal hari ini jika parameter $today tidak ada
            $today = date('Y-m-d');
        }
        $start_value = $this->input->get('start');
        if ($start_value !== null) {
            // Mendapatkan tanggal hari ini jika parameter $today tidak ada
            $today = $start_value ;
        }

        //cabang id
        $cabang_id = $this->input->get('c');
        $id = $cabang_id;
        if ($id === "") {
            $id =null;
        }
        $data['id'] = $id;
        
        // end
        $end_value = $this->input->get('end');
        if ($end_value === "") {
            $end_value =null;
        }

        $data['id'] = $id;
        $data['today'] = $today;
        $data['nama_journey'] = $journey;

        //nilai cabang
        if ($id === null) {
            $pre_poin = $this->Model_beranda->count_pre_all($today);
            $port_poin = $this->Model_beranda->count_port_all($today);
            $on_poin = $this->Model_beranda->count_on_all($today);
            $post_poin = $this->Model_beranda->count_post_all($today);
            $all_poin = $this->Model_beranda->count_all_admin($today);

            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            //hitung jumlah item peilaian
            $pre_item = $this->Model_beranda->count_item_admin( 'Pre Journey');
            $port_item = $this->Model_beranda->count_item_admin( 'Port Journey');
            $on_item = $this->Model_beranda->count_item_admin( 'On Board Journey');
            $post_item = $this->Model_beranda->count_item_admin( 'Post Journey');
            $all_item = $this->Model_beranda->count_item_all_admin();

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done_admin('Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done_admin('Port Journey', $today);
            $on_done = $this->Model_beranda->count_done_admin('On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done_admin('Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all_admin($today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows_admin_item(urldecode($journey));
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences_admin_item(urldecode($journey), $today);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows_admin_item(urldecode($journey));
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences_admin_item($today, urldecode($journey));

            // Mengambil data dari database
            $kendaraanData = $this->getData_admin();
            $pejalanKakiData = $this->getData_admin();

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData_admin('Pre Journey', $today);
            $data['port_journey'] = $this->Model_beranda->getJourneyData_admin('Port Journey', $today);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData_admin('On Board Journey', $today);
            $data['post_journey'] = $this->Model_beranda->getJourneyData_admin('Post Journey', $today);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Pre Journey', $today);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Port Journey', $today);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('On Board Journey', $today);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Post Journey', $today);


            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);

            // $data['journey'] = $this->Model_beranda->item_admin(); 
            
            $data['pre_next'] = $this->Model_beranda->item_admin_next('Pre Journey'); 
            $data['port_next'] = $this->Model_beranda->item_admin_next('Port Journey'); 
            $data['on_next'] = $this->Model_beranda->item_admin_next('On Board Journey'); 
            $data['post_next'] = $this->Model_beranda->item_admin_next('Post Journey'); 

            //data detail 
            $item_done = $this->Model_beranda->count_done_item_null($journey, $today);
            $item = $this->Model_beranda->count_item_item_null(urldecode($journey));
            $data['item_done'] = $item_done;
            $data['item'] = $item;


            $data['nama_journey'] = urldecode($journey);
            $data['journey'] = $this->Model_beranda->item_journey_null($journey); 
            $poin_item = $this->Model_beranda->getJourneyItem_null(urldecode($journey), $today);
            $data['poin_journey'] = ($poin_item != 0) ?  round($poin_item / $item): 0;

            $data['ket'] = 'All Cabang';

            // Pastikan indeks ada dalam array dan memiliki nilai yang valid sebelum melakukan operasi matematika
            $data['pre_journey'] = $data['pre_journey'] ?? 0;
            $data['port_journey'] = $data['port_journey'] ?? 0;
            $data['on_board_journey'] = $data['on_board_journey'] ?? 0;
            $data['post_journey'] = $data['post_journey'] ?? 0;

            $total_poin = $data['pre_journey'] + $data['port_journey'] + $data['on_board_journey'] + $data['post_journey'];

            if ($total_poin !== 0) {
                $percentage = 100 / $total_poin;
                $data['pre_journey'] *= $percentage;
                $data['port_journey'] *= $percentage;
                $data['on_board_journey'] *= $percentage;
                $data['post_journey'] *= $percentage;
            } else {
                // Handle the error case when the divisor is zero
                $data['pre_journey'] = 0;
                $data['port_journey'] = 0;
                $data['on_board_journey'] = 0;
                $data['post_journey'] = 0;
            }

            $data['pre_journey_pejalan'] = $data['pre_journey_pejalan'] ?? 0;
            $data['port_journey_pejalan'] = $data['port_journey_pejalan'] ?? 0;
            $data['on_board_journey_pejalan'] = $data['on_board_journey_pejalan'] ?? 0;
            $data['post_journey_pejalan'] = $data['post_journey_pejalan'] ?? 0;
            // pejalan kaki
                $total_poin_pejalan = $data['pre_journey_pejalan'] + $data['port_journey_pejalan'] + $data['on_board_journey_pejalan'] + $data['post_journey_pejalan'];

                if ($total_poin_pejalan !== 0) {
                    $percentage_pejalan = 100 / $total_poin_pejalan;
                    $data['pre_journey_pejalan'] *= $percentage_pejalan;
                    $data['port_journey_pejalan'] *= $percentage_pejalan;
                    $data['on_board_journey_pejalan'] *= $percentage_pejalan;
                    $data['post_journey_pejalan'] *= $percentage_pejalan;
                } else {
                    // Handle the error case when the divisor is zero
                    $data['pre_journey_pejalan'] = 0;
                    $data['port_journey_pejalan'] = 0;
                    $data['on_board_journey_pejalan'] = 0;
                    $data['post_journey_pejalan'] = 0;
                }
            

            // Menyusun data untuk grafik kendaraan Bar chart
            $chart_data = [
                'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
                'datasets' => [
                    [
                        'label' => 'Kendaraan',
                        'data' => [
                            $data['pre_journey'],
                            $data['port_journey'],
                            $data['on_board_journey'],
                            $data['post_journey']
                        ],
                        'backgroundColor' => [
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384'
                        ],
                        'borderColor' => [
                            'red',
                            'red','red','red'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];
            // Menyusun data untuk grafik Pejalan Kaki Bar Chart
            $chart_data_pejalan = [
                'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
                'datasets' => [
                    [
                        'label' => 'Pejalan Kaki',
                        'data' => [
                            $data['pre_journey_pejalan'],
                            $data['port_journey_pejalan'],
                            $data['on_board_journey_pejalan'],
                            $data['post_journey_pejalan']
                        ],
                        'backgroundColor' => [
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB'
                        ],
                        'borderColor' => [
                            'blue','blue','blue','blue'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ];
        } else {
            //$id === ada nilainya

             // hitung point
             $data['id_cabang'] = $this->Model_akun->getCabangByID_admin($id);

            $pre_poin = $this->Model_beranda->count_pre($id, $today);
            $port_poin = $this->Model_beranda->count_port($id, $today);
            $on_poin = $this->Model_beranda->count_on($id, $today);
            $post_poin = $this->Model_beranda->count_post($id, $today);
            $all_poin = $this->Model_beranda->count_all($id, $today);

            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            // hitung jumlah item peilaian
            $pre_item = $this->Model_beranda->count_item($id,  'Pre Journey');
            $port_item = $this->Model_beranda->count_item($id,  'Port Journey');
            $on_item = $this->Model_beranda->count_item($id,  'On Board Journey');
            $post_item = $this->Model_beranda->count_item($id,  'Post Journey');
            $all_item = $this->Model_beranda->count_item_all($id);

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done($id,  'Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done($id,  'Port Journey', $today);
            $on_done = $this->Model_beranda->count_done($id,  'On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done($id,  'Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all($id, $today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows_admin_all($id, $journey);
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences_admin_all($id, $today, $journey);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows_admin_all($id, $journey);
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences_admin_all($id, $today, $journey);

            // Mengambil data dari database
            $kendaraanData = $this->getData($id);
            $pejalanKakiData = $this->getData_pej($id);

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData($id,  'Pre Journey', $today);
            $data['port_journey'] = $this->Model_beranda->getJourneyData($id,  'Port Journey', $today);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData($id,  'On Board Journey', $today);
            $data['post_journey'] = $this->Model_beranda->getJourneyData($id,  'Post Journey', $today);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Pre Journey', $today);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Port Journey', $today);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'On Board Journey', $today);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Post Journey', $today);


            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);
            $data['item_journey'] = $this->Model_beranda->item($id); 

            //data detail 
            $item_done = $this->Model_beranda->count_done_item($id,  $journey, $today);
            $item = $this->Model_beranda->count_item_item($id,  $journey);
            $data['item_done'] = $item_done;
            $data['item'] = $item;


            $data['nama_journey'] = $this->Model_beranda->nama_journey($id, $journey); 
            $data['id_journey'] = $journey; 
            $data['journey'] = $this->Model_beranda->item_journey($id, $journey); 
            $poin_item = $this->Model_beranda->getJourneyItem($id,  $journey, $today);
            $data['poin_journey'] = ($poin_item != 0) ?  round($poin_item / $item): 0;
            $data['ket'] = $this->Model_akun->getCabangByID_admin_cabang($id);

             // label bar chart
             $journey_bar = $this->Model_beranda->item_barchart($id);
             $data['journey_bar'] = $journey_bar;
             $labels = array();
 
             // Loop melalui data 'journey' untuk mengisi array labels
             foreach ($journey_bar as $journeybar) {
                 $labels[] = $journeybar['journey']; // Ganti 'nama_journey' dengan kolom yang sesuai di tabel 'journey'
             }
             $kendaraan_data = array();
 
             // Cek apakah label 'Pre Journey' ada dalam data journey
             if (in_array('Pre Journey', $labels)) {
                 $kendaraan_data[] = $data['pre_journey'];
             }
 
             // Cek apakah label 'Port Journey' ada dalam data journey
             if (in_array('Port Journey', $labels)) {
                 $kendaraan_data[] = $data['port_journey'];
             }
 
             // Cek apakah label 'On Board Journey' ada dalam data journey
             if (in_array('On Board Journey', $labels)) {
                 $kendaraan_data[] = $data['on_board_journey'];
             }
 
             // Cek apakah label 'Post Journey' ada dalam data journey
             if (in_array('Post Journey', $labels)) {
                 $kendaraan_data[] = $data['post_journey'];
             }
 
             $pejalan_data = array();
 
             // Cek apakah label 'Pre Journey' ada dalam data journey
             if (in_array('Pre Journey', $labels)) {
                 $pejalan_data[] = $data['pre_journey_pejalan'];
             }
 
             // Cek apakah label 'Port Journey' ada dalam data journey
             if (in_array('Port Journey', $labels)) {
                 $pejalan_data[] = $data['port_journey_pejalan'];
             }
 
             // Cek apakah label 'On Board Journey' ada dalam data journey
             if (in_array('On Board Journey', $labels)) {
                 $pejalan_data[] = $data['on_board_journey_pejalan'];
             }
 
             // Cek apakah label 'Post Journey' ada dalam data journey
             if (in_array('Post Journey', $labels)) {
                 $pejalan_data[] = $data['post_journey_pejalan'];
             }
 
             // bar pejalan kaki
             // Inisialisasi variabel total_poin dengan nol
             $total_poin_pejalan = 0;
 
             // Jika label 'Pre Journey' ada dalam data journey
             if (in_array('Pre Journey', $labels)) {
                 $total_poin_pejalan += $data['pre_journey_pejalan'];
             }
 
             // Jika label 'Port Journey' ada dalam data journey
             if (in_array('Port Journey', $labels)) {
                 $total_poin_pejalan += $data['port_journey_pejalan'];
             }
 
             // Jika label 'On Board Journey' ada dalam data journey
             if (in_array('On Board Journey', $labels)) {
                 $total_poin_pejalan += $data['on_board_journey_pejalan'];
             }
 
             // Jika label 'Post Journey' ada dalam data journey
             if (in_array('Post Journey', $labels)) {
                 $total_poin_pejalan += $data['post_journey_pejalan'];
             }
 
             // Jika total_poin_pejalan tidak sama dengan nol, lakukan perhitungan persentase
             if ($total_poin_pejalan !== 0) {
                 $percentage = 100 / $total_poin_pejalan;
 
                 // Jika label 'Pre Journey' ada dalam data journey, hitung persentase dan simpan kembali
                 if (in_array('Pre Journey', $labels)) {
                     $data['pre_journey_pejalan'] *= $percentage;
                 } else {
                     $data['pre_journey_pejalan'] = 0;
                 }
 
                 // Jika label 'Port Journey' ada dalam data journey, hitung persentase dan simpan kembali
                 if (in_array('Port Journey', $labels)) {
                     $data['port_journey_pejalan'] *= $percentage;
                 } else {
                     $data['port_journey_pejalan'] = 0;
                 }
 
                 // Jika label 'On Board Journey' ada dalam data journey, hitung persentase dan simpan kembali
                 if (in_array('On Board Journey', $labels)) {
                     $data['on_board_journey_pejalan'] *= $percentage;
                 } else {
                     $data['on_board_journey_pejalan'] = 0;
                 }
 
                 // Jika label 'Post Journey' ada dalam data journey, hitung persentase dan simpan kembali
                 if (in_array('Post Journey', $labels)) {
                     $data['post_journey_pejalan'] *= $percentage;
                 } else {
                     $data['post_journey_pejalan'] = 0;
                 }
             } else {
                 // Handle the error case when the divisor is zero
                 $data['pre_journey_pejalan'] = 0;
                 $data['port_journey_pejalan'] = 0;
                 $data['on_board_journey_pejalan'] = 0;
                 $data['post_journey_pejalan'] = 0;
             }
             // 
 
 
             $kendaraan_data = array();
 
             // Cek apakah label 'Pre Journey' ada dalam data journey
             if (in_array('Pre Journey', $labels)) {
                 $kendaraan_data[] = $data['pre_journey'];
             }
 
             // Cek apakah label 'Port Journey' ada dalam data journey
             if (in_array('Port Journey', $labels)) {
                 $kendaraan_data[] = $data['port_journey'];
             }
 
             // Cek apakah label 'On Board Journey' ada dalam data journey
             if (in_array('On Board Journey', $labels)) {
                 $kendaraan_data[] = $data['on_board_journey'];
             }
 
             // Cek apakah label 'Post Journey' ada dalam data journey
             if (in_array('Post Journey', $labels)) {
                 $kendaraan_data[] = $data['post_journey'];
             }
 
             $pejalan_data = array();
 
             // Cek apakah label 'Pre Journey' ada dalam data journey
             if (in_array('Pre Journey', $labels)) {
                 $pejalan_data[] = $data['pre_journey_pejalan'];
             }
 
             // Cek apakah label 'Port Journey' ada dalam data journey
             if (in_array('Port Journey', $labels)) {
                 $pejalan_data[] = $data['port_journey_pejalan'];
             }
 
             // Cek apakah label 'On Board Journey' ada dalam data journey
             if (in_array('On Board Journey', $labels)) {
                 $pejalan_data[] = $data['on_board_journey_pejalan'];
             }
 
             // Cek apakah label 'Post Journey' ada dalam data journey
             if (in_array('Post Journey', $labels)) {
                 $pejalan_data[] = $data['post_journey_pejalan'];
             }
 
             // Menyusun data untuk grafik kendaraan Bar chart
             $chart_data = [
                 'labels' => $labels,
                 'datasets' => [
                     [
                         'label' => 'Kendaraan',
                         'data' => $kendaraan_data,
                         'backgroundColor' => [
                             '#FF6384',
                             '#FF6384',
                             '#FF6384',
                             '#FF6384'
                         ],
                         'borderColor' => [
                             'red',
                             'red','red','red'
                         ],
                         'borderWidth' => 1
                     ]
                 ]
             ];
             // Menyusun data untuk grafik Pejalan Kaki Bar Chart
             $chart_data_pejalan = [
                 'labels' => $labels,
                 'datasets' => [
                     [
                         'label' => 'Pejalan Kaki',
                         'data' => $pejalan_data,
                         'backgroundColor' => [
                             '#36A2EB',
                             '#36A2EB',
                             '#36A2EB',
                             '#36A2EB'
                         ],
                         'borderColor' => [
                             'blue','blue','blue','blue'
                         ],
                         'borderWidth' => 1
                     ]
                 ]
             ];
        }
        //batas nilai cabang
        $data['cabang'] = $this->Model_akun->getCabang();

        // result di web
		$data['pre_point_admin'] = ($pre_item != 0) ?  round($pre_poin / $pre_item) : 0;
		$data['port_point_admin'] = ($port_item != 0) ?  round($port_poin / $port_item) : 0;
		$data['on_point_admin'] = ($on_item != 0) ?  round($on_poin / $on_item) : 0;
		$data['post_point_admin'] = ($post_item != 0) ?  round($post_poin / $post_item) : 0;
		$data['all_point_admin'] = ($all_item != 0) ?  round($all_poin / $all_item) : 0;
	
		// Menyiapkan data untuk chart
		if ($kendaraanData + $pejalanKakiData !== 0) {
            $kendaraanPercentage = ($kendaraanData / ($kendaraanData + $pejalanKakiData)) * 100;
            $pejalanKakiPercentage = ($pejalanKakiData / ($kendaraanData + $pejalanKakiData)) * 100;
        } else {
            // Handle the error case when the divisor is zero
            $kendaraanPercentage = 0;
            $pejalanKakiPercentage = 0;
        }
         
	
		// Menambahkan data chart ke dalam variabel $data
		$data['kendaraanPercentage'] = $kendaraanPercentage;
		$data['pejalanKakiPercentage'] = $pejalanKakiPercentage;
 
        // Menyimpan data grafik dalam variabel $data
        $data['chart_data'] = json_encode($chart_data);
        $data['chart_data_pejalan'] = json_encode($chart_data_pejalan);

		$this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('dashboard/detail/admin', $data);
        $this->load->view('admin/layout/footer');

		 
	}

    public function index_today($today = null)
	{
		// Dapatkan nilai cabang dari pengguna yang sedang login
        
        $id_user = $this->session->userdata('id_user');
        $user = $this->Model_akun->getCabangByID($id_user);
        $cabang = $user;

        // Mendapatkan tanggal hari ini
        if ($today === null) {
            // Mendapatkan tanggal hari ini jika parameter $today tidak ada
            $today = date('Y-m-d');
        }
        
    
        $data['today'] = $today;
        
 
		$data['title'] = 'Dasboard'; 
        $data['cabang'] = $this->Model_akun->getCabangByID($id_user);
        $data['ket'] = $this->Model_akun->getCabangByID($id_user);
        $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        $data['level'] = $this->Model_akun->getLVById($id_user);

        //cabang id
        
        $id =null;
        $data['id'] = $id;
    
        //nilai cabang
        if ($id === null) { 
            $pre_poin = $this->Model_beranda->count_pre_all($today);
            $port_poin = $this->Model_beranda->count_port_all($today);
            $on_poin = $this->Model_beranda->count_on_all($today);
            $post_poin = $this->Model_beranda->count_post_all($today);
            $all_poin = $this->Model_beranda->count_all_admin($today);

            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            // hitung jumlah item peilaian
            $pre_item = $this->Model_beranda->count_item_admin( 'Pre Journey');
            $port_item = $this->Model_beranda->count_item_admin( 'Port Journey');
            $on_item = $this->Model_beranda->count_item_admin( 'On Board Journey');
            $post_item = $this->Model_beranda->count_item_admin( 'Post Journey');
            $all_item = $this->Model_beranda->count_item_all_admin();

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done_admin('Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done_admin('Port Journey', $today);
            $on_done = $this->Model_beranda->count_done_admin('On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done_admin('Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all_admin($today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows_admin();
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences_admin($today);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows_admin();
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences_admin($today);

            // Mengambil data dari database
            $kendaraanData = $this->getData_admin();
            $pejalanKakiData = $this->getData_admin();

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData_admin('Pre Journey', $today);
            $data['port_journey'] = $this->Model_beranda->getJourneyData_admin('Port Journey', $today);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData_admin('On Board Journey', $today);
            $data['post_journey'] = $this->Model_beranda->getJourneyData_admin('Post Journey', $today);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Pre Journey', $today);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Port Journey', $today);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('On Board Journey', $today);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej_admin('Post Journey', $today);


            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);

            $data['journey'] = $this->Model_beranda->item_admin(); 
            
            $data['pre_next'] = $this->Model_beranda->item_admin_next('Pre Journey'); 
            $data['port_next'] = $this->Model_beranda->item_admin_next('Port Journey'); 
            $data['on_next'] = $this->Model_beranda->item_admin_next('On Board Journey'); 
            $data['post_next'] = $this->Model_beranda->item_admin_next('Post Journey'); 
        } else {
            //$id === ada nilainya

             // hitung point
            $pre_poin = $this->Model_beranda->count_pre($id, $today);
            $port_poin = $this->Model_beranda->count_port($id, $today);
            $on_poin = $this->Model_beranda->count_on($id, $today);
            $post_poin = $this->Model_beranda->count_post($id, $today);
            $all_poin = $this->Model_beranda->count_all($id, $today);

            $data['pre_poin'] = $pre_poin;
            $data['port_poin'] = $port_poin;
            $data['on_poin'] = $on_poin;
            $data['post_poin'] = $post_poin;
            $data['all_poin'] = $all_poin;
            // hitung jumlah item peilaian
            $pre_item = $this->Model_beranda->count_item($id,  'Pre Journey');
            $port_item = $this->Model_beranda->count_item($id,  'Port Journey');
            $on_item = $this->Model_beranda->count_item($id,  'On Board Journey');
            $post_item = $this->Model_beranda->count_item($id,  'Post Journey');
            $all_item = $this->Model_beranda->count_item_all($id);

            $data['pre_item'] = $pre_item;
            $data['port_item'] = $port_item;
            $data['on_item'] = $on_item;
            $data['post_item'] = $post_item;
            $data['all_item'] = $all_item;

            // hitung laporan yang sudah done
            $pre_done = $this->Model_beranda->count_done($id,  'Pre Journey', $today);
            $port_done = $this->Model_beranda->count_done($id,  'Port Journey', $today);
            $on_done = $this->Model_beranda->count_done($id,  'On Board Journey', $today);
            $post_done = $this->Model_beranda->count_done($id,  'Post Journey', $today);
            $all_done = $this->Model_beranda->count_done_all($id, $today);

            $data['pre_done'] = $pre_done;
            $data['port_done'] = $port_done;
            $data['on_done'] = $on_done;
            $data['post_done'] = $post_done;
            $data['all_done'] = $all_done;


            // dounat
            $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows($id);
            $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences($id, $today);
            $data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows($id);
            $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences($id, $today);

            // Mengambil data dari database
            $kendaraanData = $this->getData($id);
            $pejalanKakiData = $this->getData_pej($id);

             // Mengambil data dari database untuk kendaraan
            $data['pre_journey'] = $this->Model_beranda->getJourneyData($id,  'Pre Journey', $today);
            $data['port_journey'] = $this->Model_beranda->getJourneyData($id,  'Port Journey', $today);
            $data['on_board_journey'] = $this->Model_beranda->getJourneyData($id,  'On Board Journey', $today);
            $data['post_journey'] = $this->Model_beranda->getJourneyData($id,  'Post Journey', $today);

            // Mengambil data dari database untuk pejalan kaki
            $data['pre_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Pre Journey', $today);
            $data['port_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Port Journey', $today);
            $data['on_board_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'On Board Journey', $today);
            $data['post_journey_pejalan'] = $this->Model_beranda->getJourneyData_pej($id,  'Post Journey', $today);


            $data['nama'] = $this->Model_akun->getUsernameById($id_user);
            $data['level'] = $this->Model_akun->getLVById($id_user);
            $data['journey'] = $this->Model_beranda->item($id); 
        }
        //batas nilai cabang


        $data['cabang'] = $this->Model_akun->getCabang();
       
        

        // result di web
		$data['pre_point_admin'] = ($pre_item != 0) ?  round($pre_poin / $pre_item) : 0;
		$data['port_point_admin'] = ($port_item != 0) ?  round($port_poin / $port_item) : 0;
		$data['on_point_admin'] = ($on_item != 0) ?  round($on_poin / $on_item) : 0;
		$data['post_point_admin'] = ($post_item != 0) ?  round($post_poin / $post_item) : 0;
		$data['all_point_admin'] = ($all_item != 0) ?  round($all_poin / $all_item) : 0;
        
        
	
		// Menyiapkan data untuk chart
		if ($kendaraanData + $pejalanKakiData !== 0) {
            $kendaraanPercentage = ($kendaraanData / ($kendaraanData + $pejalanKakiData)) * 100;
            $pejalanKakiPercentage = ($pejalanKakiData / ($kendaraanData + $pejalanKakiData)) * 100;
        } else {
            // Handle the error case when the divisor is zero
            $kendaraanPercentage = 0;
            $pejalanKakiPercentage = 0;
        }
         
	
		// Menambahkan data chart ke dalam variabel $data
		$data['kendaraanPercentage'] = $kendaraanPercentage;
		$data['pejalanKakiPercentage'] = $pejalanKakiPercentage;
 
       
        // Pastikan indeks ada dalam array dan memiliki nilai yang valid sebelum melakukan operasi matematika
        $data['pre_journey'] = $data['pre_journey'] ?? 0;
        $data['port_journey'] = $data['port_journey'] ?? 0;
        $data['on_board_journey'] = $data['on_board_journey'] ?? 0;
        $data['post_journey'] = $data['post_journey'] ?? 0;

        $total_poin = $data['pre_journey'] + $data['port_journey'] + $data['on_board_journey'] + $data['post_journey'];

        if ($total_poin !== 0) {
            $percentage = 100 / $total_poin;
            $data['pre_journey'] *= $percentage;
            $data['port_journey'] *= $percentage;
            $data['on_board_journey'] *= $percentage;
            $data['post_journey'] *= $percentage;
        } else {
            // Handle the error case when the divisor is zero
            $data['pre_journey'] = 0;
            $data['port_journey'] = 0;
            $data['on_board_journey'] = 0;
            $data['post_journey'] = 0;
        }

        $data['pre_journey_pejalan'] = $data['pre_journey_pejalan'] ?? 0;
        $data['port_journey_pejalan'] = $data['port_journey_pejalan'] ?? 0;
        $data['on_board_journey_pejalan'] = $data['on_board_journey_pejalan'] ?? 0;
        $data['post_journey_pejalan'] = $data['post_journey_pejalan'] ?? 0;
        // pejalan kaki
            $total_poin_pejalan = $data['pre_journey_pejalan'] + $data['port_journey_pejalan'] + $data['on_board_journey_pejalan'] + $data['post_journey_pejalan'];

            if ($total_poin_pejalan !== 0) {
                $percentage_pejalan = 100 / $total_poin_pejalan;
                $data['pre_journey_pejalan'] *= $percentage_pejalan;
                $data['port_journey_pejalan'] *= $percentage_pejalan;
                $data['on_board_journey_pejalan'] *= $percentage_pejalan;
                $data['post_journey_pejalan'] *= $percentage_pejalan;
            } else {
                // Handle the error case when the divisor is zero
                $data['pre_journey_pejalan'] = 0;
                $data['port_journey_pejalan'] = 0;
                $data['on_board_journey_pejalan'] = 0;
                $data['post_journey_pejalan'] = 0;
            }
        

        // Menyusun data untuk grafik kendaraan Bar chart
        $chart_data = [
            'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
            'datasets' => [
                [
                    'label' => 'Kendaraan',
                    'data' => [
                        $data['pre_journey'],
                        $data['port_journey'],
                        $data['on_board_journey'],
                        $data['post_journey']
                    ],
                    'backgroundColor' => [
                        '#FF6384',
                        '#FF6384',
                        '#FF6384',
                        '#FF6384'
                    ],
                    'borderColor' => [
                        'red',
                        'red','red','red'
                    ],
                    'borderWidth' => 1
                ]
            ]
        ];
        // Menyusun data untuk grafik Pejalan Kaki Bar Chart
        $chart_data_pejalan = [
            'labels' => ['Pre Journey', 'Port Journey', 'On Board Journey', 'Post Journey'],
            'datasets' => [
                [
                    'label' => 'Pejalan Kaki',
                    'data' => [
                        $data['pre_journey_pejalan'],
                        $data['port_journey_pejalan'],
                        $data['on_board_journey_pejalan'],
                        $data['post_journey_pejalan']
                    ],
                    'backgroundColor' => [
                        '#36A2EB',
                        '#36A2EB',
                        '#36A2EB',
                        '#36A2EB'
                    ],
                    'borderColor' => [
                        'blue','blue','blue','blue'
                    ],
                    'borderWidth' => 1
                ]
            ]
        ];

        // Menyimpan data grafik dalam variabel $data
        $data['chart_data'] = json_encode($chart_data);
        $data['chart_data_pejalan'] = json_encode($chart_data_pejalan);
        


		$this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('dashboard/ambon/admin', $data);
        $this->load->view('admin/layout/footer');

		
	}
    
	public function profil()
	{
		$data['judul']='Halaman Admin';
		$data['header']='admin/layout/header';
		$data['isi']='admin/isi/profil';
		$data['profil']=$this->model_admin->profil_pengguna();
		$this->load->view('admin/layout/layout',$data);
	}
	
	public function ajax_gambar()
	{
		$data['gambarnya']=$this->model_admin->profil_pengguna();
		$this->load->view('admin/isi/ajax_gambar',$data);
	}
	
	public function update_profil()
	{
		$this->_validate_update_profil();
		$config['upload_path'] = './assets/gambar/';
        $config['allowed_types'] = 'jpg|png|jpeg|bmp';
        $config['encrypt_name'] = true; 
		
		$this->upload->initialize($config);
        if(!empty($_FILES['userfile'])){
            if ($this->upload->do_upload('userfile')){
                $gambar = $this->upload->data();
                $config['image_library']='gd2';
				$config['source_image']='./assets/gambar/'.$gambar['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
				$config['max_size']= 50000;
				$config['width']= 120;
				$config['height']= 160;
                $config['new_image']= './assets/gambar/'.$gambar['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
				$gambar1 = array(
					'gambar' => $gambar['file_name']	
				);
				$this->db->where('id_user',$this->session->userdata('id_user'));
				$this->db->update('user',$gambar1);	
            }
		}
		$this->model_admin->update_profil();
		echo json_encode(array("status" => TRUE));
	}
	
	private function _validate_update_profil()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
	
		if($this->input->post('nama_user') == '')
		{
			$data['inputerror'][] = 'nama_user';
			$data['error_string'][] = 'Field tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Field tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	
	
	public function ajax_soal()
	{
		$list = $this->model_soal->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$nomor=1;
		foreach ($list as $soa) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<div>'.$soa->soal.'</div>
					  <div>A. '.$soa->pilihan_a.'</div>
					  <div>B. '.$soa->pilihan_b.'</div>
					  <div>C. '.$soa->pilihan_c.'</div>
					  <div>D. '.$soa->pilihan_d.'</div>
					  <div>E. '.$soa->pilihan_e.'</div>
					  <div class = "fw-bold"> Jawaban : '.$soa->jawaban.'</div>';
			$row[] = '<div class="text-center"><a class="" href="javascript:void(0)" title="Edit" onclick="edit_soal('."'".$soa->id_soal."'".')"><i">Gambar Tidak Tersedia</i> </a></div>';
			$row[] = '<div class="text-center">'.$soa->status_soal.'</div>';
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_soal('."'".$soa->id_soal."'".')"><i class="bi bi-pencil-square"></i> </a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_soal('."'".$soa->id_soal."'".')"><i class="bi bi-trash3-fill"></i> </a></div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_soal->count_all(),
						"recordsFiltered" => $this->model_soal->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function tambah_soal()
	{
		$this->_validate_soal();
		$data = array(
				'soal' => $this->input->post('soal'),
				'pilihan_a' => $this->input->post('pilihan_a'),
				'pilihan_b' => $this->input->post('pilihan_b'),
				'pilihan_c' => $this->input->post('pilihan_c'),
				'pilihan_d' => $this->input->post('pilihan_d'),
				'pilihan_e' => $this->input->post('pilihan_e'),
				'jawaban' => $this->input->post('jawaban'),
				'status_soal' => $this->input->post('status_soal')
			);
		$insert = $this->model_soal->save($data);
		echo json_encode(array("status" => TRUE));
	}
	
	// public function edit_soal($id_soal)
	// {
	// 	$data = $this->model_soal->get_by_id($id_soal);
	// 	echo json_encode($data);
	// }
	
	// public function update_soal()
	// {
	// 	$this->_validate_soal();
	// 	$data = array(
	// 			'soal' => $this->input->post('soal'),
	// 			'pilihan_a' => $this->input->post('pilihan_a'),
	// 			'pilihan_b' => $this->input->post('pilihan_b'),
	// 			'pilihan_c' => $this->input->post('pilihan_c'),
	// 			'pilihan_d' => $this->input->post('pilihan_d'),
	// 			'pilihan_e' => $this->input->post('pilihan_e'),
	// 			'jawaban' => $this->input->post('jawaban'),
	// 			'status_soal' => $this->input->post('status_soal')
	// 		);
			
	// 	$this->model_soal->update(array('id_soal' => $this->input->post('id_soal')), $data);
	// 	echo json_encode(array("status" => TRUE));
	// }

	public function hapus_soal($id_soal)
	{
		
		$this->db->where('id_soal',$id_soal);
		$this->db->delete('soal');
        redirect(base_url() . 'admin/soal');
	}
    public function hapus_regional($id_regional)
	{
		
		$this->db->where('id_regional',$id_regional);
		$this->db->delete('regional');
		redirect(base_url() . 'admin/regional_null');
	}
    public function hapus_cabang($id_cabang)
	{
		$this->db->where('id_cabang',$id_cabang);
		$this->db->delete('cabang');
		redirect(base_url() . 'admin/cabang_null');
	}
    public function hapus_journey($id_journey)
	{
		$this->db->where('id_journey',$id_journey);
		$this->db->delete('journey');
		redirect(base_url() . 'admin/journey_null');
	}
    public function hapus_pelabuhan($id_pelabuhan)
	{
		$this->db->where('id_pelabuhan',$id_pelabuhan);
		$this->db->delete('pelabuhan');
		redirect(base_url() . 'admin/pelabuhan_null');
	}
    public function hapus_kapal($id_kapal)
	{
		$this->db->where('id_kapal',$id_kapal);
		$this->db->delete('kapal');
		redirect(base_url() . 'admin/kapal_null');
	}
    public function hapus_type_option($id_type_option)
	{
		$this->db->where('id_type_option',$id_type_option);
		$this->db->delete('type_option');
		redirect(base_url() . 'admin/typeoption_null');
	}
	

	public function laporan()
    { 
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
		$data['laporan'] = $this->model_laporan->get_data_by_status_admin('proses');

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/laporan', $data);
        $this->load->view('admin/layout/footer');
    }
	public function laporan_tolak()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        $data['laporan'] = $this->model_laporan->get_data_by_status_admin('tolak');

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/laporan_tolak', $data);
        $this->load->view('admin/layout/footer');
    }
	public function laporan_setuju()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        $data['laporan'] = $this->model_laporan->get_data_by_status_admin('setuju');

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/laporan_setuju', $data);
        $this->load->view('admin/layout/footer');
    }

	public function tambah_user()
    {
        $data['title'] = 'Tambah Akun User';


        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/registrasi', $data);
        $this->load->view('admin/layout/footer');
    }
	public function akun_user()
    {
        $data['title'] = 'Akun User';

        $this->load->model('Model_akun');
        $data['data'] = $this->Model_akun->get_data();
        $data['data_cabang'] = $this->Model_akun->getCabang();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tableakun', $data);
        $this->load->view('admin/layout/footer');


    }
    
    public function edit_akun($id)
    {
        $data['user'] = $this->db->get_where('user', array('id_user' => $id))->row_array();

        $data['data_cabang'] = $this->Model_akun->getCabang();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/edit_user', $data);
        $this->load->view('admin/layout/footer');
    }
 
	public function soal()
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data();
        $data['data_regional'] = $this->Model_soal->get_regional();
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['data_journey'] = $this->Model_akun->getJourney_option();
        
        $data['data_kapal'] = $this->Model_akun->getKapal_item();
        $data['data_pelabuhan'] = $this->Model_akun->getPelabuhan_item();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/soal', $data);
        $this->load->view('admin/layout/footer');
    }

    public function soal_cabang($cabang = null)
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data_soal($cabang);
        $data['data_regional'] = $this->Model_soal->get_regional();
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['data_journey'] = $this->Model_akun->getJourney($cabang);
        $data['cabang'] = $cabang;

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/soal', $data);
        $this->load->view('admin/layout/footer');
    }

    public function soal_journey_cabang( $cabang = null , $journey = null)
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        
        $data['data'] = $this->Model_soal->get_data_soal_journey_cabang($journey, $cabang);
        
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['data_journey'] = $this->Model_akun->getJourney($cabang);
        $data['data_pelabuhan'] = $this->Model_akun->getPelabuhan($cabang);
        $data['data_kapal'] = $this->Model_akun->getKapal($cabang);
        $data['cabang'] = $cabang;
        $data['journey'] = $journey;

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/soal', $data);
        $this->load->view('admin/layout/footer');
    }
    public function journey_null()
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data_journey_null();
        
        $data['data_cabang'] = $this->Model_akun->getCabang();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tablejourney', $data);
        $this->load->view('admin/layout/footer');
    }
    public function regional_null()
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_regional();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tableregional', $data);
        $this->load->view('admin/layout/footer');
    }
    public function cabang_null()
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data_regional'] = $this->Model_soal->get_regional();
        
        $data['data'] = $this->Model_akun->getCabang();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tablecabang', $data);
        $this->load->view('admin/layout/footer');
    }
    public function journey($cabang = null)
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        
        $data['data'] = $this->Model_soal->get_data_journey($cabang);
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['cabang'] = $cabang;

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tablejourney', $data);
        $this->load->view('admin/layout/footer');
    }
    public function journey_cabang( $cabang = null , $journey = null)
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        
        $data['data'] = $this->Model_soal->get_data_journey_cabang($journey, $cabang);
        
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['data_journey'] = $this->Model_akun->getJourney($cabang);
        $data['data_pelabuhan'] = $this->Model_akun->getPelabuhan($cabang);
        $data['data_kapal'] = $this->Model_akun->getKapal($cabang);
        $data['cabang'] = $cabang;
        $data['journey'] = $journey;

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tabletypeoption', $data);
        $this->load->view('admin/layout/footer');
    }
    public function pelabuhan_null()
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data_pelabuhan_null();
        $data['data_cabang'] = $this->Model_akun->getCabang();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tablepelabuhan', $data);
        $this->load->view('admin/layout/footer');
    }
    public function pelabuhan($cabang = null)
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data_pelabuhan($cabang);
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['cabang'] = $cabang;

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tablepelabuhan', $data);
        $this->load->view('admin/layout/footer');
    }
    public function pelabuhan_newpelabuhan($cabang = null , $journey = null, $pelabuhan = null)
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data_pelabuhan_newpelabuhan($cabang , $journey , $pelabuhan);
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['cabang'] = $cabang;
        $data['pelabuhan'] = $pelabuhan;

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tabletypeoption', $data);
        $this->load->view('admin/layout/footer');
    }
    public function kapal_null()
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data_kapal_null();
        $data['data_cabang'] = $this->Model_akun->getCabang();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tablekapal', $data);
        $this->load->view('admin/layout/footer');
    }
    public function kapal($cabang = null)
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data_kapal($cabang);
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['cabang'] = $cabang;

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tablekapal', $data);
        $this->load->view('admin/layout/footer');
    }
    
    public function typeoption_null()
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data_type_option_null();
        $data['data_cabang'] = $this->Model_akun->getCabang();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tabletypeoption', $data);
        $this->load->view('admin/layout/footer');
    }
    public function typeoption($cabang = null)
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data_type_option($cabang);
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['data_journey'] = $this->Model_akun->getJourney($cabang);
        $data['cabang'] = $cabang;

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tabletypeoption', $data);
        $this->load->view('admin/layout/footer');
    }
    public function getJourneyOptions() {
        $selectedCabang = $this->input->get('cabang');
        
        // Panggil model untuk mendapatkan data journey berdasarkan cabang
        $data_journey = $this->Model_akun->getJourney($selectedCabang);
        // var_dump( $data_journey);
        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_journey);
    }
    public function getJourneyOptions_post() {
        $selectedCabang = $this->input->post('cabang');
        
        // Panggil model untuk mendapatkan data journey berdasarkan cabang
        $data_journey = $this->Model_akun->getJourney($selectedCabang);
        // var_dump( $data_journey);
        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_journey);
    }
    public function getPelabuhanOptions_() {
        $selectedCabang = $this->input->get('cabang');
        
        // Panggil model untuk mendapatkan data journey berdasarkan cabang
        $data_pelabuhan = $this->Model_akun->getPelabuhan($selectedCabang);
        // var_dump($data_pelabuhan);
        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_pelabuhan);
    }
    public function getPelabuhanOptions_post() {
        $selectedCabang = $this->input->post('cabang');
        
        // Panggil model untuk mendapatkan data journey berdasarkan cabang
        $data_pelabuhan = $this->Model_akun->getPelabuhan($selectedCabang);
        // var_dump($data_pelabuhan);
        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_pelabuhan);
    }
    public function getKapalOptions_() {
        $selectedCabang = $this->input->get('cabang');
        
        // Panggil model untuk mendapatkan data journey berdasarkan cabang
        $data_pelabuhan = $this->Model_akun->getKapal($selectedCabang);

        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_pelabuhan);
    }
    public function getKapalOptions_post() {
        $selectedCabang = $this->input->post('cabang');
        
        // Panggil model untuk mendapatkan data journey berdasarkan cabang
        $data_pelabuhan = $this->Model_akun->getKapal($selectedCabang);

        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_pelabuhan);
    }
    public function getoption_BYjourney() {
        $selectedJourney = $this->input->post('id_journey');
        
        // Panggil model untuk mendapatkan data journey berdasarkan cabang
        $data_option = $this->Model_akun->getTypeoptionByidjourney($selectedJourney);

        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_option);
    }
    public function getoption_BYpelabuhan() {
        $selectedpelabuhan = $this->input->post('id_pelabuhan');
        
        // Panggil model untuk mendapatkan data pelabuhan berdasarkan cabang
        $data_option = $this->Model_akun->getTypeoptionByidpelabuhan($selectedpelabuhan);

        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_option);
    }
    public function getoption_BYkapal() {
        $selectedkapal = $this->input->post('id_kapal');
        
        // Panggil model untuk mendapatkan data kapal berdasarkan cabang
        $data_option = $this->Model_akun->getTypeoptionByidkapal($selectedkapal);

        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_option);
    }
    
    public function getpelabuhanOptions() {
        $selectedCabang = $this->input->get('cabang');
        
        // Panggil model untuk mendapatkan data journey berdasarkan cabang
        $data_pelabuhan = $this->Model_akun->getJourney($selectedCabang);

        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data_pelabuhan);
    }
    public function laporan_detail($laporan_id) {
        $data['title'] = 'Laporan Detail';
    
        // Get laporan data based on laporan_id
        $laporan = $this->Model_laporan->getLaporanById($laporan_id);
    
        if (!$laporan) {
            // Handle case when laporan is not found
            show_404(); // Or display an error message
            return;
        }
    
        // Extract id_soal values from laporan
        $id_soal_array = explode(', ', $laporan->id_soal);
    
        $soal_data = array(); // To store fetched soal data
    
        foreach ($id_soal_array as $id_soal) {
            $soal = $this->Model_soal->getSoalByLaporanId($id_soal);
            
            if ($soal) {
                $soal_data[] = $soal;
            }
        }
    
        // Pass data to the view
        $data['laporan'] = $laporan;
        $data['soal'] = $soal_data;
    
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/laporan_detail', $data);
        $this->load->view('admin/layout/footer');
    }
    

    public function add_user()
    {

        $data = array(
            'nik' => $this->input->post('nik'),
            'nama_user' => $this->input->post('nama_user'),
            'gender' => $this->input->post('gender'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'level_pengguna' => $this->input->post('level_pengguna'),
            'id_cabang' => $this->input->post('cabang'),
            'id_regional' => $this->input->post('regional'),
            // 'ket' => $this->input->post('ket'),
            // 'status_user' => $this->input->post('status_user')
        );

        $this->db->insert('user', $data);
        redirect(base_url() . 'admin/akun_user');
    }

    public function hapus_akun($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
        redirect(base_url() . 'admin/akun_user');
    }
    public function update_akun($id)
    {
        $nik = $this->input->post('nik');
        $nama_user = $this->input->post('nama_user');
        $gender = $this->input->post('gender');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level_pengguna = $this->input->post('level_pengguna');
        $status_user = $this->input->post('status_user');

        $this->load->model('model_akun');
        $this->model_akun->update_data($nik, $nama_user, $gender, $username, $password, $level_pengguna, $status_user);
        redirect('element/edit_akun');
    }
    public function add_regional()
    {
        $data = array(
            'regional' => $this->input->post('regional')
        );

        $this->db->insert('regional', $data);
        redirect(base_url() . 'admin/regional_null');
    }
    public function add_cabang()
    {
        $data = array(
            'id_regional' => $this->input->post('regional'),
            'cabang' => $this->input->post('cabang')
        );

        $this->db->insert('cabang', $data);
        redirect(base_url() . 'admin/cabang_null');
    }
    public function add_journey()
    {
        $data = array(
            'id_cabang' => $this->input->post('cabang'),
            'journey' => $this->input->post('journey')
        );

        $this->db->insert('journey', $data);
        redirect(base_url() . 'admin/journey_null');
    }
    public function add_pelabuhan()
    {
        $data = array(
            'id_cabang' => $this->input->post('cabang'),
            'pelabuhan' => $this->input->post('pelabuhan')
        );

        $this->db->insert('pelabuhan', $data);
        redirect(base_url() . 'admin/pelabuhan_null');
    }
    public function add_kapal()
    {
        $data = array(
            'id_cabang' => $this->input->post('cabang'),
            'kapal' => $this->input->post('kapal')
        );

        $this->db->insert('kapal', $data);
        redirect(base_url() . 'admin/kapal_null');
    }
    public function add_type_option()
{
    $pelabuhan = $this->input->post('pelabuhan');
    $kapal = $this->input->post('kapal');
    
    // Prepare data array
    $data = array(
        'id_cabang' => $this->input->post('cabang'),
        'id_journey' => $this->input->post('journey'),
        'id_pelabuhan' => ($pelabuhan === "") ? NULL : $this->input->post('pelabuhan'),
        'id_kapal' => ($kapal === "") ? NULL : $this->input->post('kapal'),
        'type_option' => $this->input->post('type_option')
    );
    
    $this->db->insert('type_option', $data);
    redirect(base_url() . 'admin/typeoption_null');
}

    public function add_soal()
    {
        $id_pelabuhan = $this->input->post('pelabuhan');
        $id_kapal = $this->input->post('kapal');
        
        $data = array(
            'id_regional' => $this->input->post('regional'),
            'id_cabang' => $this->input->post('cabang'),
            'id_journey' => $this->input->post('journey'),
            'id_pelabuhan' => !empty($id_pelabuhan) ? $id_pelabuhan : null,
            'id_kapal' => !empty($id_kapal) ? $id_kapal : null,
            'id_type_option' => $this->input->post('type_option'),
            'type' => $this->input->post('type'),
            'soal' => $this->input->post('soal'),
            'jawaban_1' => $this->input->post('jawaban_1'),
            'jawaban_2' => $this->input->post('jawaban_2'),
            'jawaban_benar' => $this->input->post('jawaban_benar'),
            'gambar' => $this->input->post('gambar'),
            'hari' => $this->input->post('hari'),
            'last_input' => $this->input->post('last_input')
        );

        $this->db->insert('soal', $data);
        redirect(base_url() . 'admin/soal');
    }

    
    public function edit_regional($id)
    {
        $data['regional'] = $this->db->get_where('regional', array('id_regional' => $id))->row_array();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/edit_regional', $data);
        $this->load->view('admin/layout/footer');
    }
    public function edit_type_option($id)
    {
        $data['title'] = 'Edit Type Option';
        $data['data_regional'] = $this->Model_soal->get_regional();
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['data_journey'] = $this->Model_akun->getJourney_option();
        
        $data['data_kapal'] = $this->Model_akun->getKapal_item();
        $data['data_pelabuhan'] = $this->Model_akun->getPelabuhan_item();

        $data['type_option'] = $this->db->get_where('type_option', array('id_type_option' => $id))->row_array();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/edit_type_option', $data);
        $this->load->view('admin/layout/footer');
    }
    public function update_regional($id)
    {
        $data = array(
            'regional' => $this->input->post('regional')
        );

        $this->db->where('id_regional', $id);
        $this->db->update('regional', $data);

        redirect(base_url() . 'admin/regional_null');
    }
    public function edit_cabang($id)
    {
        $data['data_regional'] = $this->Model_soal->get_regional();
        $data['cabang'] = $this->db->get_where('cabang', array('id_cabang' => $id))->row_array();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/edit_cabang', $data);
        $this->load->view('admin/layout/footer');
    }
    public function edit_journey($id)
    {
        $data['data_regional'] = $this->Model_soal->get_regional();
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['journey'] = $this->db->get_where('journey', array('id_journey' => $id))->row_array();

        

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/edit_journey', $data);
        $this->load->view('admin/layout/footer');
    }
    public function edit_pelabuhan($id)
    {
        $data['data_regional'] = $this->Model_soal->get_regional();
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['pelabuhan'] = $this->db->get_where('pelabuhan', array('id_pelabuhan' => $id))->row_array();

        

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/edit_pelabuhan', $data);
        $this->load->view('admin/layout/footer');
    }
    public function edit_kapal($id)
    {
        $data['data_regional'] = $this->Model_soal->get_regional();
        
        $data['data_cabang'] = $this->Model_akun->getCabang();
        $data['kapal'] = $this->db->get_where('kapal', array('id_kapal' => $id))->row_array();

        

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/edit_kapal', $data);
        $this->load->view('admin/layout/footer');
    }
    public function update_journey($id)
    {
        $data = array(
            'id_cabang' => $this->input->post('cabang'),
            'journey' => $this->input->post('journey')
        );

        $this->db->where('id_journey', $id);
        $this->db->update('journey', $data);

        redirect(base_url() . 'admin/journey_null');
    }
    
    public function update_user($id)
    {
        $data = array(
            'nik' => $this->input->post('nik'),
            'nama_user' => $this->input->post('nama_user'),
            'gender' => $this->input->post('gender'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'level_pengguna' => $this->input->post('level_pengguna'),
            'id_cabang' => $this->input->post('cabang'),
            'id_regional' => $this->input->post('regional'),
            // 'ket' => $this->input->post('ket'),
            // 'status_user' => $this->input->post('status_user')
        );

        

        $this->db->where('id_user', $id);
        $this->db->update('user', $data);

        redirect(base_url() . 'admin/akun_user');
    }
    public function update_cabang($id)
    {
        $data = array(
            'id_regional' => $this->input->post('regional'),
            'cabang' => $this->input->post('cabang')
        );

        $this->db->where('id_cabang', $id);
        $this->db->update('cabang', $data);

        redirect(base_url() . 'admin/cabang_null');
    }
    public function update_pelabuhan($id)
    {
        $data = array(
            'id_cabang' => $this->input->post('cabang'),
            'pelabuhan' => $this->input->post('pelabuhan')
        );

        $this->db->where('id_pelabuhan', $id);
        $this->db->update('pelabuhan', $data);

        redirect(base_url() . 'admin/pelabuhan_null');
    }
    public function update_kapal($id)
    {
        $data = array(
            'id_cabang' => $this->input->post('cabang'),
            'kapal' => $this->input->post('kapal')
        );

        $this->db->where('id_kapal', $id);
        $this->db->update('kapal', $data);

        redirect(base_url() . 'admin/kapal_null');
    }
    
    public function update_type_option($id)
    {
        $data = array(
            'id_cabang' => $this->input->post('cabang'),
            'id_journey' => $this->input->post('journey'),
            'type_option' => $this->input->post('type_option')
        );

        $id_kapal = $this->input->post('kapal');
        if (!empty($id_kapal)) {
            $data['id_kapal'] = $id_kapal;
        }

        $id_pelabuhan = $this->input->post('pelabuhan');
        if (!empty($id_pelabuhan)) {
            $data['id_pelabuhan'] = $id_pelabuhan;
        }

        $this->db->where('id_type_option', $id);
        $this->db->update('type_option', $data);

        redirect(base_url() . 'admin/typeoption_null');
    }


    public function edit_soal($id)
    {
        $data['title'] = 'Edit Soal';
        $data['soal'] = $this->db->get_where('soal', array('id_soal' => $id))->row_array();

        $id_journey = $data['soal']['id_journey'];
        $id_pelabuhan = $data['soal']['id_pelabuhan'];
        $id_kapal = $data['soal']['id_kapal'];

        // $data['data_type_option'] = $this->Model_soal->get_data_type_option_soal($id_journey, $id_pelabuhan, $id_kapal );


        $data['data_regional'] = $this->Model_soal->get_regional();
        $data['data_cabang'] = $this->Model_akun->getCabang();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/edit_soal', $data);
        $this->load->view('admin/layout/footer');
    }
    public function update_soal($id)
    {
        $id_pelabuhan = $this->input->post('pelabuhan');
        $id_kapal = $this->input->post('kapal');
        $data = array(
            'id_regional' => $this->input->post('regional'),
            'id_cabang' => $this->input->post('cabang'),
            'id_journey' => $this->input->post('journey'),
            'id_pelabuhan' => !empty($id_pelabuhan) ? $id_pelabuhan : null,
            'id_kapal' => !empty($id_kapal) ? $id_kapal : null,
            'id_type_option' => $this->input->post('type_option'),
            'type' => $this->input->post('type'),
            'soal' => $this->input->post('soal'),
            'jawaban_1' => $this->input->post('jawaban_1'),
            'jawaban_2' => $this->input->post('jawaban_2'),
            'jawaban_benar' => $this->input->post('jawaban_benar'),
            'hari' => $this->input->post('hari'),
            'last_input' => $this->input->post('last_input')
        );

        $this->db->where('id_soal', $id);
        $this->db->update('soal', $data);

        redirect(base_url() . 'admin/soal');
    }

    public function get_cabang_by_regional() {
        $selected_regional = $this->input->post('selected_regional'); // Ambil data regional yang dipilih dari request
        $data_cabang = $this->Model_soal->get_cabang_by_regional($selected_regional); // Panggil model untuk mendapatkan data cabang
        echo json_encode($data_cabang); // Mengembalikan data cabang dalam format JSON
    }
    public function send_data_journey() {
        if ($this->input->is_ajax_request()) {
            $dataJourney = $this->input->post('dataJourney');
            $id_pelabuhan = null;
            $id_kapal = null;
            $Typeoption = $this->Model_soal->get_data_type_option_soal($dataJourney, $id_pelabuhan, $id_kapal);
    
            // You might want to return the Typeoption array as JSON if needed
            echo json_encode(['Typeoption' => $Typeoption]);
        }
    } 
    
    // public function uploaddata()
    // {
    //     $config['upload_path'] = FCPATH . 'uploads\\';

    //     $config['allowed_types'] = 'xlsx|xls';
    //     $config['file_name'] = 'Data_Soal_' . time();
    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);
        
    //     if ($this->upload->do_upload('importexcel')) {
    //         $file = $this->upload->data();
    //         $reader = ReaderEntityFactory::createXLSXReader();

    //         $reader->open('uploads/' . $file['file_name']);
    //         foreach ($reader->getSheetIterator() as $sheet) {
    //             $numRow = 1;
    //             foreach ($sheet->getRowIterator() as $row) {
    //                 if ($numRow > 1) {  
    //                     $namaRegionalExcel = $row->getCellAtIndex(1);
    //                     $idRegional = $this->Model_soal->getIdRegionalFromName($namaRegionalExcel);

    //                     $namaCabangExcel = $row->getCellAtIndex(2);
    //                     $idCabang = $this->Model_soal->getIdCabangFromName($namaCabangExcel);

    //                     $namaJourneyExcel = $row->getCellAtIndex(3);
    //                     $idJourney = $this->Model_soal->getIdJourneyFromName($namaJourneyExcel, $idCabang);

    //                     $namaTypeOptionExcel = $row->getCellAtIndex(4);
    //                     $idTypeOption = $this->Model_soal->getIdTypeOptionFromName($namaTypeOptionExcel, $idCabang, $idJourney);

    //                     $namaKapalExcel = $row->getCellAtIndex(5);
    //                     $idKapal = $this->Model_soal->getIdKapalFromName($namaKapalExcel, $idCabang);
                        
    //                     $namaPelabuhanExcel = $row->getCellAtIndex(6);
    //                     $idPelabuhan = $this->Model_soal->getIdPelabuhanFromName($namaPelabuhanExcel, $idCabang);

    //                     // $excelDate = $row->getCellAtIndex(14); // Misalnya: "20/08/2023"

    //                     // Konversi format tanggal dari "d/m/Y" menjadi "Y-m-d"
    //                     // $dateObj = DateTime::createFromFormat('d/m/Y', $excelDate);
    //                     // if ($dateObj) {
    //                     //     $formattedDate = $dateObj->format('Y-m-d'); // Hasil: "2023-08-20"
    //                     // } else {
    //                     //     $formattedDate = null; // Tanggal tidak valid, set menjadi null
    //                     // }

    //                     if ($idRegional !== false) {
    //                         $data = array(
    //                             'id_regional'  => $idRegional,
    //                             'id_cabang'  => $idCabang,
    //                             'id_journey'       => $idJourney,
    //                             'id_type_option'       => $idTypeOption,
    //                             'id_kapal' => ($idKapal !== null) ? $idKapal : null,
    //                             'id_pelabuhan' => ($idPelabuhan !== null) ? $idPelabuhan : null,
    //                             'type'       => $row->getCellAtIndex(7),
    //                             'soal'       => $row->getCellAtIndex(8),
    //                             'jawaban_1'       => $row->getCellAtIndex(9),
    //                             'jawaban_2'       => $row->getCellAtIndex(10),
    //                             'jawaban_benar'       => $row->getCellAtIndex(11),
    //                             'gambar'       => $row->getCellAtIndex(12),
    //                             'hari'       => $row->getCellAtIndex(13),
    //                             'last_input'       => date('Y-m-d', strtotime('-1 day')), 
    //                         );
    //                         $this->db->insert('soal', $data);
    //                     } else {
    //                         // Nama regional tidak ditemukan
    //                         echo "Nama regional tidak ditemukan.";
    //                     }
    //                 }
    //                 $numRow++;
    //             }
    //             $reader->close();
    //             unlink('uploads/' . $file['file_name']);
    //             $this->session->set_flashdata('pesan', 'import Data Berhasil');
    //             redirect('admin/soal');
    //         }
    //     } else {
    //         echo "Error :" . $this->upload->display_errors();
    //         $uploadPath = $config['upload_path'];
    //         echo "Upload path: $uploadPath";

    //     };
    // }
    public function uploaddata()
    {
        $config['upload_path'] = FCPATH . 'uploads\\';

        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'Data_Soal_' . time();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $successData = [];
        $failedData = [];
        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();

            $reader->open('uploads/' . $file['file_name']);
            
            // Array untuk menyimpan data yang akan diimpor
            $importData = array();
            
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        $namaRegionalExcel = $row->getCellAtIndex(1);
                        $idRegional = $this->Model_soal->getIdRegionalFromName($namaRegionalExcel);

                        $namaCabangExcel = $row->getCellAtIndex(2);
                        $idCabang = $this->Model_soal->getIdCabangFromName($namaCabangExcel, $idRegional);

                        $namaJourneyExcel = $row->getCellAtIndex(3);
                        $idJourney = $this->Model_soal->getIdJourneyFromName($namaJourneyExcel, $idCabang);

                       
                        $namaTypeOptionExcel = $row->getCellAtIndex(4);


                        $namaKapalExcel = $row->getCellAtIndex(5);
                        if ($namaKapalExcel->getValue() !== '') {
                            $idKapal = $this->Model_soal->getIdKapalFromName($namaKapalExcel, $idCabang);
                        } else {
                            $idKapal = null;
                        }

                        $namaPelabuhanExcel = $row->getCellAtIndex(6);
                        if ($namaPelabuhanExcel->getValue() !== '') {
                            $idPelabuhan = $this->Model_soal->getIdPelabuhanFromName($namaPelabuhanExcel, $idCabang);
                        } else {
                            $idPelabuhan = null;
                        }

                        $idTypeOption = $this->Model_soal->getIdTypeOptionFromName(
                            $namaTypeOptionExcel,
                            $idCabang,
                            $idJourney,
                            $idPelabuhan,
                            $idKapal
                        );

                        // ...

                        if ($idRegional !== false) {
                            $data = array(
                                'id_regional'  => $idRegional,
                                'id_cabang'  => $idCabang,
                                'id_journey'       => $idJourney,
                                'id_type_option'       => $idTypeOption,
                                'id_kapal' => ($idKapal !== null) ? $idKapal : null,
                                'id_pelabuhan' => ($idPelabuhan !== null) ? $idPelabuhan : null,
                                'type'       => $row->getCellAtIndex(7),
                                'soal'       => $row->getCellAtIndex(8),
                                'jawaban_1'       => $row->getCellAtIndex(9),
                                'jawaban_2'       => $row->getCellAtIndex(10),
                                'jawaban_benar'       => $row->getCellAtIndex(11),
                                'gambar'       => $row->getCellAtIndex(12),
                                'hari'       => $row->getCellAtIndex(13),
                                'last_input'       => date('Y-m-d', strtotime('-31 day')), 
                            );

                            // Tambahkan data ke dalam array importData
                            $importData[] = $data;
                        } else {
                            // Nama regional tidak ditemukan
                            echo "Nama regional tidak ditemukan.";
                        }
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                
                // Loop melalui array importData dan cek apakah data sudah ada dalam tabel sebelum menambahkannya
                foreach ($importData as $data) {
                    $existingData = $this->Model_soal->getDataByIds($data['id_regional'], $data['id_cabang'], $data['id_journey'], $data['id_type_option'], $data['id_kapal'], $data['id_pelabuhan'], $data['type'], $data['soal'], $data['jawaban_1'], $data['jawaban_2'], $data['jawaban_benar']);
                    if (!$existingData) {
                        $this->db->insert('soal', $data);
                        $successData[] = $data; // Menyimpan data yang berhasil diimpor
                    } else {
                        $failedData[] = $data; // Menyimpan data yang gagal diimpor
                    }
                }

                $successCount = count($successData);
                $errorCount = count($failedData);
        
                // Ubah pesan sesuai dengan jumlah data yang berhasil dan gagal diimpor
                $successMessage = '<span style="font-weight: bold;">Data Baru:</span> <span style="font-weight: bold; color: #66bb6a;">' . ($successCount > 0 ? $successCount : '0') . ' Data Baru Berhasil diimpor. </span> <br>';
                $errorMessage = '<span style="font-weight: bold;">Data Sama: </span> <span style="font-weight: bold; color: red;">' . ($errorCount > 0 ? $errorCount : '0') . ' Data Sama diimpor.</span>';
                $this->session->set_flashdata('import_message', $successMessage . '\n' . $errorMessage);
                redirect('admin/soal');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
            $uploadPath = $config['upload_path'];
            echo "Upload path: $uploadPath";
        }
    }
    public function excel()
    {
        $data['title'] = 'Laporan Excel'; 
        $data['data'] = $this->Model_soal->get_dataall_soal();
		$this->load->view('admin/ambon/excel', $data);
    }

    public function capture() {
        $this->load->helper('file');
        require_once APPPATH.'third_party/dompdf/autoload.inc.php'; // Load Dompdf
    
        $screenshot = $this->input->post('screenshot'); // Data gambar dalam base64
    
        if (!empty($screenshot)) {
            $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $screenshot));
    
            $filename = 'screenshot_' . date('YmdHis') . '.png';
            $filepath = FCPATH . 'uploads_ss/' . $filename;
            $asdp = FCPATH . 'logo/s.png';
            $bumn = FCPATH . 'logo/logo_2.png';
            write_file($filepath, $image_data);
            
            // Generate PDF
            $pdf = new Dompdf\Dompdf(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            $dir = __DIR__;
            $imageDataUri = 'data:image/png;base64,' . base64_encode(file_get_contents($filepath));
            $imagelogo1 = 'data:image/png;base64,' . base64_encode(file_get_contents($asdp));
            $imagelogo2 = 'data:image/png;base64,' . base64_encode(file_get_contents($bumn));
            
            $html = '<html><body>';
            
            // Header
            $html .= '<div style="display: flex; justify-content: space-between;">';
            $html .= '<div style="flex: 1;"><img src="'. $imagelogo2  .'" style="max-width: 80px; margin-bottom: - 40px;"></div>';
            $html .= '<div style="text-align: center; flex: 1 ; margin-top: -25px;">Report Service Touch Point Cabang Ambon PT ASDP Indonesia Ferry (Persero)</div>';
            $html .= '<div style="flex: 1; text-align: right;"><img src="'. $imagelogo1  .'" style="max-width: 80px; margin-top: -40px;"></div>';
            $html .= '</div>';
            
            
            // Divider
            $html .= '<hr style="border: none; border-top: 1px solid black;">';
            
            // Screenshot
            $html .= '<img src="' . $imageDataUri . '" style="max-width: 100%; background-color: red; margin-top:20px;" />';
            $html .= '</body></html>';
    
            $pdf->loadHtml($html);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();
    
            $pdfFilename = 'Dashboard_' . date('Y-m-d_His') . '.pdf';
            $pdfPath = FCPATH . 'uploads_ss/' . $pdfFilename;
            file_put_contents($pdfPath, $pdf->output());
    
            $response = array('status' => 'success', 'message' => 'Screenshot captured.', 'pdf_filename' => $pdfFilename);
        } else {
            $response = array('status' => 'error', 'message' => 'Screenshot data is empty.');
        }
        echo json_encode($response);
    }
    

    public function asset()
    {
        $data['title'] = 'Asset';

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/asset', $data);
        $this->load->view('admin/layout/footer');
    }
    public function laporan_masalah()
    {
        $data['title'] = 'Laporan Masalah';

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar', $data);  
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/laporan_masalah', $data);
        $this->load->view('admin/layout/footer');
    }
    
    public function ubah_sandi()
    {
        $data['title'] = 'Edit Profil';


        $this->load->view('admin/layout//header', $data);
        $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/ubah_sandi', $data);
        $this->load->view('admin/layout//footer');
    }
    public function delete_all_soal()
    {
        $totalDeleted = $this->Model_soal->delete_all('soal');

        if ($totalDeleted > 0) {
            // Jika ada data yang dihapus, tampilkan SweetAlert dengan jumlah data yang dihapus
            $message = "Berhasil menghapus $totalDeleted data soal.";
        } else {
            // Jika tidak ada data yang dihapus, tampilkan pesan lain
            $message = "Tidak ada data soal yang dihapus.";
        }

        // Redirect ke halaman dengan pesan SweetAlert
        $this->session->set_flashdata('message', $message);
        redirect('admin/soal');
    }
    public function get_total_soal() {
        $total_soal = $this->Model_soal->get_total('soal'); // Mengambil jumlah total data soal dari model
        echo $total_soal; // Mengirimkan jumlah data soal sebagai respons AJAX
    }
    
    public function tambah_laporan()
    {
        $data['title'] = 'Laporan';

       
        $data['tanggal_hari_ini'] = date('Y-m-d');
        $id_user = $this->session->userdata('id_user');
        $user = $this->Model_akun->getCabangByID($id_user);
        $cabang = $user;
        $id = $this->Model_akun->getID($id_user);//id cabang

        $data['regional'] = $this->Model_laporan->get_all_regional();
        $data['cabang'] = $this->Model_laporan->get_all_cabang();
        $data['jenis_journey'] = $this->Model_laporan->jenis_journey($id);
        $data['pelabuhan'] = $this->Model_laporan->pelabuhan_cabang($id);
        $data['kapal'] = $this->Model_laporan->kapal_cabang($id);

        $data['pre_option'] = $this->Model_laporan->pre_option($id);
        $data['post_option'] = $this->Model_laporan->post_option($id);

        $this->load->view('admin/layout/header', $data);
         $this->load->view('admin/layout/sidebar', $data);
        $this->load->view('admin/layout/topbar', $data);
        $this->load->view('admin/ambon/tambah_laporan', $data);
        $this->load->view('admin/layout/footer');
    }

    public function getJourneyOptions_pelabuhan()
    {
        $selectedPelabuhan = $this->input->post('pelabuhan'); // Mengambil nilai pelabuhan yang dipilih dari POST data

        // Ambil opsi jenis perjalanan dari database berdasarkan pelabuhan yang dipilih
        $journeyOptions = $this->Model_laporan->getJourneyOptionsByPelabuhan($selectedPelabuhan);

        // Mengembalikan opsi jenis perjalanan dalam format JSON
        echo json_encode($journeyOptions);
    }

    public function getJourneyOptions_kapal()
    {
        $selectedkapal = $this->input->post('kapal'); // Mengambil nilai kapal yang dipilih dari POST data

        // Ambil opsi jenis perjalanan dari database berdasarkan kapal yang dipilih
        $journeyOptions = $this->Model_laporan->getJourneyOptionsBykapal($selectedkapal);

        // Mengembalikan opsi jenis perjalanan dalam format JSON
        echo json_encode($journeyOptions);
    }
    public function getType_journey()
    {
        $selectedCabang = $this->input->post('cabang'); // Mengambil nilai Cabang yang dipilih dari POST data

        // Ambil opsi jenis perjalanan dari database berdasarkan Cabang yang dipilih
        $journeyOptions = $this->Model_laporan->getJourneyOptionsByCabang($selectedCabang);

        // Mengembalikan opsi jenis perjalanan dalam format JSON
        echo json_encode($journeyOptions);
    }
    public function getJourneyOptions_type_journey()
    {
        $selectedtype_journey = $this->input->post('type_journey'); // Mengambil nilai type_journey yang dipilih dari POST data

        // Ambil opsi jenis perjalanan dari database berdasarkan type_journey yang dipilih
        $journeyOptions = $this->Model_laporan->getJourneyOptionsBytype_journey($selectedtype_journey);

        // Mengembalikan opsi jenis perjalanan dalam format JSON
        echo json_encode($journeyOptions);
    }
    
    
    
    
    
    

}