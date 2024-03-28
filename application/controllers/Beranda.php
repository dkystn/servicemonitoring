<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$sesi_login=$this->session->userdata('loginMasuk');
        $this->load->model('Model_akun');
		if($sesi_login == false)
		{
			redirect('login');
		}
	}
    private function getData_admin($point) {
        $this->load->database(); // Menghubungkan ke database
        $this->db->select($point);
        $this->db->from('laporan');
        $this->db->where('status', 'setuju');
        $this->db->where('tanggal', date('Y-m-d')); // Laporan di hari ini saja

        $query = $this->db->get();
        $result = $query->row();

        return ($result !== null) ? $result->poin_kendaraan : 0;
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

	public function index($cabang_id = null, $today = null)
	{
		// Dapatkan nilai cabang dari pengguna yang sedang login
        
        $id_user = $this->session->userdata('id_user');
        $id = $this->session->userdata('id_cabang');
        // if ($id === "") {
        //     $id = null;
        // }
        $data['id'] = $id;

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
            $kendaraanData = $this->getData_admin('poin_kendaraan');
            $pejalanKakiData = $this->getData_admin('poin_pejalan_kaki');

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
        


		$this->load->view('pegawai/layout//header', $data);
        $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('dashboard/ambon/pegawai', $data);
        $this->load->view('pegawai/layout//footer');
		
	}
    public function index_2($today = null)
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
        $end_value = $this->input->get('end');
        if ($end_value === "") {
            $end_value =null;
        }
        $id_kapal = null;
    
        $data['today'] = $today;
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
        $querykapal = $this->db->get_where('kapal', array('id_kapal' => $id_kapal, 'id_cabang' => $cabang));
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
        $querypelabuhan = $this->db->get_where('pelabuhan', array('id_pelabuhan' => $id_pelabuhan, 'id_cabang' => $cabang));
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

 
		$data['title'] = 'Dasboard'; 
        $data['cabang'] = $this->Model_akun->getCabangByID($id_user);
        $data['ket'] = $this->Model_akun->getCabangByID($id_user);
        $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        $data['level'] = $this->Model_akun->getLVById($id_user);

        $id = $this->Model_akun->getID($id_user);
        
        // hitung point
        $pre_poin = $this->Model_beranda->count_pre($id, $today,$end_value,$id_kapal);
        $port_poin = $this->Model_beranda->count_port($id, $today,$end_value,$id_kapal);
        $on_poin = $this->Model_beranda->count_on($id, $today,$end_value,$id_kapal);
        $post_poin = $this->Model_beranda->count_post($id, $today,$end_value,$id_kapal);
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

        // result di web
		$data['pre_point_ambon'] = ($pre_item != 0) ?  round($pre_poin / $pre_item) : 0;
		$data['port_point_ambon'] = ($port_item != 0) ?  round($port_poin / $port_item) : 0;
		$data['on_point_ambon'] = ($on_item != 0) ?  round($on_poin / $on_item) : 0;
		$data['post_point_ambon'] = ($post_item != 0) ?  round($post_poin / $post_item) : 0;
		$data['all_point_ambon'] = ($all_item != 0) ?  round($all_poin / $all_item) : 0;
        
        // dounat
        $data['item_kendaraan'] = $this->Model_beranda->countKendaraanRows($id);
        $data['done_kendaraan'] = $this->Model_beranda->countKendaraanOccurrences($id, $today);
		$data['item_pejalankaki'] = $this->Model_beranda->countpejalankakiRows($id);
        $data['done_pejalankaki'] = $this->Model_beranda->countpejalankakiOccurrences($id, $today);

		// Mengambil data dari database
		$kendaraanData = $this->getData($id);
		$pejalanKakiData = $this->getData_pej($id);
	
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

        // label bar chart
        $journey_bar = $this->Model_beranda->item_barchart($id);
        $data['journey_bar'] = $journey_bar;
        $labels = array();

        
        // Loop melalui data 'journey' untuk mengisi array labels
        foreach ($journey_bar as $journey) {
            $labels[] = $journey['journey']; // Ganti 'nama_journey' dengan kolom yang sesuai di tabel 'journey'
        }

        // bar kendaraan
        // Inisialisasi variabel total_poin dengan nol
        $total_poin = 0;

        // Jika label 'Pre Journey' ada dalam data journey
        if (in_array('Pre Journey', $labels)) {
            $total_poin += $data['pre_journey'];
        }

        // Jika label 'Port Journey' ada dalam data journey
        if (in_array('Port Journey', $labels)) {
            $total_poin += $data['port_journey'];
        }

        // Jika label 'On Board Journey' ada dalam data journey
        if (in_array('On Board Journey', $labels)) {
            $total_poin += $data['on_board_journey'];
        }

        // Jika label 'Post Journey' ada dalam data journey
        if (in_array('Post Journey', $labels)) {
            $total_poin += $data['post_journey'];
        }

        // Jika total_poin tidak sama dengan nol, lakukan perhitungan persentase
        if ($total_poin !== 0) {
            $percentage = 100 / $total_poin;

            // Jika label 'Pre Journey' ada dalam data journey, hitung persentase dan simpan kembali
            if (in_array('Pre Journey', $labels)) {
                $data['pre_journey'] *= $percentage;
            } else {
                $data['pre_journey'] = 0;
            }

            // Jika label 'Port Journey' ada dalam data journey, hitung persentase dan simpan kembali
            if (in_array('Port Journey', $labels)) {
                $data['port_journey'] *= $percentage;
            } else {
                $data['port_journey'] = 0;
            }

            // Jika label 'On Board Journey' ada dalam data journey, hitung persentase dan simpan kembali
            if (in_array('On Board Journey', $labels)) {
                $data['on_board_journey'] *= $percentage;
            } else {
                $data['on_board_journey'] = 0;
            }

            // Jika label 'Post Journey' ada dalam data journey, hitung persentase dan simpan kembali
            if (in_array('Post Journey', $labels)) {
                $data['post_journey'] *= $percentage;
            } else {
                $data['post_journey'] = 0;
            }
        } else {
            // Handle the error case when the divisor is zero
            $data['pre_journey'] = 0;
            $data['port_journey'] = 0;
            $data['on_board_journey'] = 0;
            $data['post_journey'] = 0;
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

        // Menyimpan data grafik dalam variabel $data
        $data['chart_data'] = json_encode($chart_data);
        $data['chart_data_pejalan'] = json_encode($chart_data_pejalan);
        $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        $data['level'] = $this->Model_akun->getLVById($id_user);
        
        $data['journey'] = $this->Model_beranda->item($id); 
        
		$this->load->view('pegawai/layout//header', $data);
        $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('dashboard/ambon/pegawai', $data);
        $this->load->view('pegawai/layout//footer');
	}
    public function index_item($journey, $today = null)
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
        $data['journey'] = $journey;
        $data['id_journey'] = $journey;

 
		$data['title'] = 'Dasboard'; 
        $data['cabang'] = $this->Model_akun->getCabangByID($id_user);
        $data['ket'] = $this->Model_akun->getCabangByID($id_user);
        $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        $data['level'] = $this->Model_akun->getLVById($id_user);

        $id = $this->Model_akun->getID($id_user);
        
        
        // dounat
        $data['item_kendaraan_item'] = $this->Model_beranda->countKendaraanRows_item($id, $journey);
        $data['done_kendaraan_item'] = $this->Model_beranda->countKendaraanOccurrences_item($id, $today, $journey);
		$data['item_pejalankaki_item'] = $this->Model_beranda->countpejalankakiRows_item($id, $journey);
        $data['done_pejalankaki_item'] = $this->Model_beranda->countpejalankakiOccurrences_item($id, $today, $journey);

		// Mengambil data dari database
		$kendaraanData = $this->getData($id);
		$pejalanKakiData = $this->getData_pej($id);
	
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

        // label bar chart
        $journey_bar = $this->Model_beranda->item_barchart($id);
        $data['journey_bar'] = $journey_bar;
        $labels = array();

        
        // Loop melalui data 'journey' untuk mengisi array labels
        foreach ($journey_bar as $journeybar) {
            $labels[] = $journeybar['journey']; // Ganti 'nama_journey' dengan kolom yang sesuai di tabel 'journey'
        }

         // bar kendaraan
        // Inisialisasi variabel total_poin dengan nol
        $total_poin = 0;

        // Jika label 'Pre Journey' ada dalam data journey
        if (in_array('Pre Journey', $labels)) {
            $total_poin += $data['pre_journey'];
        }

        // Jika label 'Port Journey' ada dalam data journey
        if (in_array('Port Journey', $labels)) {
            $total_poin += $data['port_journey'];
        }

        // Jika label 'On Board Journey' ada dalam data journey
        if (in_array('On Board Journey', $labels)) {
            $total_poin += $data['on_board_journey'];
        }

        // Jika label 'Post Journey' ada dalam data journey
        if (in_array('Post Journey', $labels)) {
            $total_poin += $data['post_journey'];
        }

        // Jika total_poin tidak sama dengan nol, lakukan perhitungan persentase
        if ($total_poin !== 0) {
            $percentage = 100 / $total_poin;

            // Jika label 'Pre Journey' ada dalam data journey, hitung persentase dan simpan kembali
            if (in_array('Pre Journey', $labels)) {
                $data['pre_journey'] *= $percentage;
            } else {
                $data['pre_journey'] = 0;
            }

            // Jika label 'Port Journey' ada dalam data journey, hitung persentase dan simpan kembali
            if (in_array('Port Journey', $labels)) {
                $data['port_journey'] *= $percentage;
            } else {
                $data['port_journey'] = 0;
            }

            // Jika label 'On Board Journey' ada dalam data journey, hitung persentase dan simpan kembali
            if (in_array('On Board Journey', $labels)) {
                $data['on_board_journey'] *= $percentage;
            } else {
                $data['on_board_journey'] = 0;
            }

            // Jika label 'Post Journey' ada dalam data journey, hitung persentase dan simpan kembali
            if (in_array('Post Journey', $labels)) {
                $data['post_journey'] *= $percentage;
            } else {
                $data['post_journey'] = 0;
            }
        } else {
            // Handle the error case when the divisor is zero
            $data['pre_journey'] = 0;
            $data['port_journey'] = 0;
            $data['on_board_journey'] = 0;
            $data['post_journey'] = 0;
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

        // Menyimpan data grafik dalam variabel $data
        $data['chart_data'] = json_encode($chart_data);
        $data['chart_data_pejalan'] = json_encode($chart_data_pejalan);
        $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        $data['level'] = $this->Model_akun->getLVById($id_user);

        //data detail 
        $item_done = $this->Model_beranda->count_done_item($id,  $journey, $today);
        $item = $this->Model_beranda->count_item_item($id,  $journey);
        $data['item_done'] = $item_done;
        $data['item'] = $item;


        $data['nama_journey'] = $this->Model_beranda->nama_journey($id, $journey); 
        $data['journey'] = $this->Model_beranda->item_journey($id, $journey); 
        $poin_item = $this->Model_beranda->getJourneyItem($id,  $journey, $today);
        $data['poin_journey'] = ($poin_item != 0) ?  round($poin_item / $item): 0;

		$this->load->view('pegawai/layout//header', $data);
        $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('dashboard/detail/pegawai', $data);
        $this->load->view('pegawai/layout//footer');
	}
    public function tambah_laporan()
    {
        $data['title'] = 'Laporan';

       
        $data['tanggal_hari_ini'] = date('Y-m-d');
        $id_user = $this->session->userdata('id_user');
        $user = $this->Model_akun->getCabangByID($id_user);
        $cabang = $user;
        $id = $this->Model_akun->getID($id_user);//id cabang
        // $id_type_option = $this->Model_akun->getIDtypeoption($id_user);//id type_option

        $data['regional'] = $this->Model_laporan->get_regional($id);
        $data['cabang'] = $this->Model_laporan->get_all_cabang();
        $data['jenis_journey'] = $this->Model_laporan->jenis_journey($id);
        $data['pelabuhan'] = $this->Model_laporan->pelabuhan_cabang($id);
        $data['kapal'] = $this->Model_laporan->kapal_cabang($id);

        $data['pre_option'] = $this->Model_laporan->pre_option($id);
        $data['post_option'] = $this->Model_laporan->post_option($id);

        // $data['ket'] = $this->Model_akun->ket($id_user);
        // $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        // $data['level'] = $this->Model_akun->getLVById($id_user);
        // $data['detail'] = $this->Model_laporan->detail_cabang($cabang);
        // $data['data'] = $this->Model_soal->get_data();
        // $data['ket'] = $this->Model_akun->ket($id_user);
        // $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        // $data['level'] = $this->Model_akun->getLVById($id_user);

        $this->load->view('pegawai/layout/header', $data);
         $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('pegawai/ambon/2tambah_laporan', $data);
        $this->load->view('pegawai/layout/footer');
    }
    public function getOptions()
    {

        $id_user = $this->session->userdata('id_user');
        $user = $this->Model_akun->getCabangByID($id_user);
        $cabang = $user;

        $selectedValue = $this->input->post('selectedValue');

        // Panggil method di model untuk mendapatkan opsi berdasarkan nilai yang dipilih
        $options = $this->Model_laporan->getOptions($selectedValue, $cabang);

        // Kirim data opsi sebagai respons Ajax
        echo json_encode($options);
    }
   
}


