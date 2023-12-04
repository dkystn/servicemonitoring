
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model yang diperlukan
        $this->load->model('model_soal');
    }

    public function get_filtered_data2()
    {
        // Ambil nilai yang dipilih dari dropdown   
        $regional = $this->input->post('regional');
        $cabang = $this->input->post('cabang');
        $type = $this->input->post('type');
        $type_journey = $this->input->post('type_journey');
        $type_option = $this->input->post('type_option');

        // Panggil model untuk mendapatkan data berdasarkan filter
        $data = $this->model_soal->get_filtered_data($regional, $cabang, $type, $type_journey, $type_option,);

        // Mengembalikan data dalam format JSON
        echo json_encode($data);
    }
    public function get_filtered_data()
    {
        // Ambil nilai yang dipilih dari dropdown
        $regional = $this->input->post('regional');
        $cabang = $this->input->post('cabang');
        $type = $this->input->post('type');
        $typeJourney1 = $this->input->post('type_journey');
        $typeJourney2 = $this->input->post('type_journey2');
        
        // Menentukan nilai untuk $typeJourney berdasarkan $typeJourney1 atau $typeJourney2 yang tidak sama dengan '0'
        // $typeJourney = $typeJourney1 !== '0' ? $typeJourney1 : ($typeJourney2 !== '0' ? $typeJourney2 : '');
        $typeJourney = '';
        if(!empty($typeJourney2)){
            $typeJourney = $typeJourney2;
        } else{
            $typeJourney = $typeJourney1;
        }

        // Mengambil nilai dari empat inputan form
        $type_option = $this->input->post('type_option1');
        $type_option2 = $this->input->post('type_option2');
        $type_option3 = $this->input->post('type_option3');
        $type_option4 = $this->input->post('type_option4');
        $type_option5 = $this->input->post('type_option5');
        $type_option6 = $this->input->post('type_option6');
        $type_option7 = $this->input->post('type_option7');
        $type_option8 = $this->input->post('type_option8');


        // Menentukan nilai untuk dimasukkan ke kolom "type_option"
        $type_option_value = '';
        if ($type_option) {
            $type_option_value = $type_option;
        } elseif ($type_option2) {
            $type_option_value = $type_option2;
        } elseif ($type_option3) {
            $type_option_value = $type_option3;
        } elseif ($type_option4) {
            $type_option_value = $type_option4;
        } elseif ($type_option5) {
            $type_option_value = $type_option5;
        } elseif ($type_option6) {
            $type_option_value = $type_option6;
        } elseif ($type_option7) {
            $type_option_value = $type_option7;
        } elseif ($type_option8) {
            $type_option_value = $type_option8;
        }

        // Panggil model untuk mendapatkan data berdasarkan filter
        $data = $this->model_soal->get_filtered_data($regional, $cabang, $type, $typeJourney, $type_option_value);

        // Mengembalikan data dalam format JSON
        echo json_encode($data);
    }
    public function getKendaraanData()
    {
        $totalKendaraan = $this->Model_laporan_ambon->getTotalKendaraan(); // Memanggil metode di model untuk mendapatkan jumlah total kendaraan
        $totalPoin = $this->Model_laporan_ambon->getTotalPoin(); // Memanggil metode di model untuk mendapatkan total poin

        $response['total_kendaraan'] = $totalPoin / $totalKendaraan; // Menghitung rata-rata poin per kendaraan
        echo json_encode($response);
    }


    public function get_filtered_data_option()
    {
        
        $pelabuhan = $this->input->post('pelabuhan');

        // Panggil model untuk mendapatkan data berdasarkan filter
        $data = $this->model_soal->get_filtered_data_option( $pelabuhan);

        // Mengembalikan data dalam format JSON
        echo json_encode($data);
    }



    
}
