<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('Model_laporan');
		$sesi_login=$this->session->userdata('loginMasuk');
		if($sesi_login == false)
		{
			redirect('login');
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

	
    public function index($today = null)
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

        $id = $this->Model_akun->getID($id_user);
        
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

        // Menyimpan data grafik dalam variabel $data
        $data['chart_data'] = json_encode($chart_data);
        $data['chart_data_pejalan'] = json_encode($chart_data_pejalan);
        $data['nama'] = $this->Model_akun->getUsernameById($id_user);
        $data['level'] = $this->Model_akun->getLVById($id_user);
        
        $data['journey'] = $this->Model_beranda->item($id); 


		$this->load->view('pimpinan/layout/header', $data);
        $this->load->view('pimpinan/layout/sidebar', $data);
        $this->load->view('pimpinan/layout/topbar', $data);
        $this->load->view('dashboard/ambon/pimpinan', $data);
        $this->load->view('pimpinan/layout/footer');
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

		$this->load->view('pimpinan/layout/header', $data);
        $this->load->view('pimpinan/layout/sidebar', $data);
        $this->load->view('pimpinan/layout/topbar', $data);
        $this->load->view('dashboard/detail/pimpinan', $data);
        $this->load->view('pimpinan/layout/footer');
	}

		

	public function laporan_pimpinan()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        $data['laporan'] = $this->model_laporan->get_data_by_status('proses');

        $this->load->view('pimpinan/layout/header', $data);
        $this->load->view('pimpinan/layout/sidebar', $data);
        $this->load->view('pimpinan/layout/topbar', $data);
        $this->load->view('pimpinan/ambon/laporan_proses', $data);
        $this->load->view('pimpinan/layout/footer');
    }

	public function laporan_pimpinan_tolak()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        $data['laporan'] = $this->model_laporan->get_data_by_status('tolak');

        $this->load->view('pimpinan/layout/header', $data);
        $this->load->view('pimpinan/layout/sidebar', $data);
        $this->load->view('pimpinan/layout/topbar', $data);
        $this->load->view('pimpinan/ambon/laporan_tolak', $data);
        $this->load->view('pimpinan/layout/footer');
    }

	public function laporan_pimpinan_setuju()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        $data['laporan'] = $this->model_laporan->get_data_by_status('setuju');

        $this->load->view('pimpinan/layout/header', $data);
        $this->load->view('pimpinan/layout/sidebar', $data);
        $this->load->view('pimpinan/layout/topbar', $data);
        $this->load->view('pimpinan/ambon/laporan_pimpinan_setuju', $data);
        $this->load->view('pimpinan/layout/footer');
    }
	public function verifikasi_laporan() 
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        $data['laporan'] = $this->model_laporan->get_data_by_status('proses');

        $this->load->view('pimpinan/layout/header', $data);
        $this->load->view('pimpinan/layout/sidebar', $data);
        $this->load->view('pimpinan/layout/topbar', $data);
        $this->load->view('pimpinan/ambon/verifikasi_laporan', $data);
        $this->load->view('pimpinan/layout/footer');
    }

    public function ubah_sandi()
    {
        $data['title'] = 'Edit Profil';


        $this->load->view('pimpinan/layout/header', $data);
        $this->load->view('pimpinan/layout/sidebar', $data);
        $this->load->view('pimpinan/layout/topbar', $data);
        $this->load->view('pimpinan/ambon/ubah_sandi', $data);
        $this->load->view('pimpinan/layout/footer');
    }

    public function update_laporan_aktif($id_laporan)
    {
        $this->load->model('model_laporan');
        $this->model_laporan->update_laporan($id_laporan);

        redirect(site_url('pimpinan/laporan_pimpinan_setuju'));
    }

    public function update_laporan_tolak($id_laporan)
    {
        $this->load->model('model_laporan');
        $this->model_laporan->update_laporan_tolak($id_laporan);
        $laporan = $this->model_laporan->get_laporan_by_id($id_laporan);
        $jawaban_pilihan_semua = isset($laporan[0]->jawaban_pilihan) ? $laporan[0]->jawaban_pilihan : '';

        redirect(site_url('pimpinan/laporan_pimpinan_tolak'));
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
    
        // Kirim data laporan dan soal ke view
        $data['laporan'] = $laporan;
        $data['soal'] =  $soal_data;
    
            $this->load->view('pimpinan/layout/header', $data);
            $this->load->view('pimpinan/layout/sidebar', $data);
            $this->load->view('pimpinan/layout/topbar', $data);
            $this->load->view('pimpinan/ambon/laporan_detail_pimpinan', $data);
            $this->load->view('pimpinan/layout/footer');
       
    }
	
}


