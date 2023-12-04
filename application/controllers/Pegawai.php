<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function detail_pre() 
    {
        $data['title'] = 'Detail Pre Journey';
        $id_user = $this->session->userdata('id_user');
        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data();


        $this->load->view('pegawai/layout/header', $data);
         $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('pegawai/ambon/tambah_laporan', $data);
        $this->load->view('pegawai/layout/footer');
    }
    public function tambah_laporan()
    { 
        $data['title'] = 'Laporan';
        
        $id_user = $this->session->userdata('id_user');
        $data['tanggal_hari_ini'] = date('Y-m-d');
        
        $data['cabang'] = $this->Model_akun->getCabangByID($id_user);
        $data['data'] = $this->Model_soal->get_data();
        $data['regional'] = $this->Model_akun->getRegional($id_user);

        $this->load->view('pegawai/layout/header', $data);
         $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('pegawai/ambon/tambah_laporan', $data);
        $this->load->view('pegawai/layout/footer');
    }
    
    public function getCabangLoggedIn()
    {
        $cabang = $this->session->userdata('cabang');
        return $cabang;
    }   
    public function laporan()
    {
        $tanggal = $this->input->post('tanggal');
        $cabang = $this->input->post('cabang');
        $type = $this->input->post('type');
        $type_journey = $this->input->post('type_journey');
        $type_journey2 = $this->input->post('type_journey2');
        
        // Mengambil nilai dari empat inputan form
        $type_option = $this->input->post('type_option');
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

        if ($this->input->post('type') == 'Pejalan Kaki' && $type_journey == 0) {
            $type_journey = $type_journey2;
        }

        $check = 0;
        // echo $type_option_value;
        $getCabang = $this->db->query("SELECT * FROM laporan WHERE cabang = '$cabang' AND tanggal =  '$tanggal' AND type = '$type' AND type_journey = '$type_journey' AND type_option = '$type_option_value'");
        foreach ($getCabang->result_array() as $c) {
            $check++;
        }
        // echo $check;
        if($check ==0) {
            $nama = $this->input->post('nama');
            $regional = $this->input->post('regional');
            $status = $this->input->post('status');

            // Inisialisasi array jawaban_pilihan dan poin
            $jawaban_pilihan = array();
            $poin = 0;
            $jumlah_soal = 0;

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'radio_') === 0) {
                    $index = substr($key, strlen('radio_'));
                    $jawaban_pilihan[$index] = $value; // Simpan jawaban yang dipilih dalam array
                    $jumlah_soal++; // Tambahkan jumlah soal
                } elseif (strpos($key, 'jawaban_benar_') === 0) {
                    $index = substr($key, strlen('jawaban_benar_'));
                    if (isset($jawaban_pilihan[$index]) && $jawaban_pilihan[$index] == $value) {
                        $poin++; // Tambahkan poin jika jawaban benar
                    }
                }
            }

            // Menghitung persentase poin
            $persentase_poin = ($poin / $jumlah_soal) * 100;

            // Gabungkan jawaban yang dipilih menjadi satu inputan
            $jawaban_pilihan_str = implode(', ', $jawaban_pilihan);

            // Mendapatkan informasi file yang diunggah
            $uploaded_files = $_FILES['gambar'];

            // Menghitung jumlah file yang diunggah
            $jumlah_file = count($uploaded_files['name']);

            // Menyiapkan array untuk menyimpan nama file
            $gambar = array();

            // Mengunggah file satu per satu
            for ($i = 0; $i < $jumlah_file; $i++) {
                // Mendapatkan nama file
                $file_name = $uploaded_files['name'][$i];

                // Mendapatkan path sementara file yang diunggah
                $file_tmp = $uploaded_files['tmp_name'][$i];

                // Generate nama unik untuk file
                $file_unique_name = uniqid() . '_' . $file_name;

                // Tentukan lokasi penyimpanan file
                $file_destination = 'uploads/' . $file_unique_name;

                // Pindahkan file ke lokasi tujuan
                move_uploaded_file($file_tmp, $file_destination);

                // Simpan nama file ke dalam array gambar
                $gambar[] = $file_unique_name;
            }

            // Buat array data untuk dimasukkan ke database
            $data = array(
                'nama' => $nama,
                'tanggal' => $tanggal,
                'regional' => $regional,
                'cabang' => $cabang,
                'type' => $type,
                'type_journey' => $type_journey,
                'type_option' => $type_option_value,
                'jawaban_pilihan' => $jawaban_pilihan_str,
                'poin' => $persentase_poin,
                'status' => $status,
                'gambar' => implode(',', $gambar) // Menggabungkan array gambar menjadi string dengan pemisah koma
            );

            // Lakukan insert data ke tabel laporan
            $this->db->insert('laporan', $data);

            // Redirect ke halaman lain setelah berhasil menyimpan data
            redirect(site_url('pegawai/laporan_proses'));
        } else {
            echo "<script>alert('Gagal Laporan Sudah Di  Isi !!');</script>";
            echo "<script>window.location.href = '".site_url('pegawai/tambah_laporan')."';</script>";
        }
    }


    public function laporan_update()
    {
        $id_user = $this->session->userdata('id_user');
        $user = $this->Model_akun->getCabangByID($id_user);
        $cabang = $user;
        
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');
        $id_journey = $this->input->post('id_journey');
        $id_cabang = $this->input->post('cabang');
        
        $type_option = $this->input->post('type_option');
        $type_option2 = $this->input->post('type_option2');
        $type_option3 = $this->input->post('type_option3');
        $type_option4 = $this->input->post('type_option4');

        $type_option_value = '';
        if ($type_option) {
            $type_option_value = $type_option;
        } elseif ($type_option2) {
            $type_option_value = $type_option2;
        } elseif ($type_option3) {
            $type_option_value = $type_option3;
        } elseif ($type_option4) {
            $type_option_value = $type_option4;
        }

        $pelabuhan = $this->input->post('pelabuhan');
        $kapal = $this->input->post('kapal');

        $id_kapal = !empty($kapal) ? $kapal : null;
        $id_pelabuhan = !empty($pelabuhan) ? $pelabuhan : null;

        $check = 0;
        $getCabang = $this->db->query("SELECT * FROM laporan WHERE id_cabang = '$id_cabang' AND tanggal =  '$tanggal' AND id_type_option = '$type_option_value'");
        foreach ($getCabang->result_array() as $c) {
            $check++;
        }
        
        if ($check == 0) {
            $status = $this->input->post('status');
            $jawaban_pilihan = array();
            
            // $jawaban_pilihan = array();
            
            $poin = 0;
            $jumlah_soal = 0;

            $jumlah_soal_kendaraan = 0;
            $jumlah_soal_pejalan_kaki = 0;

            $poin_kendaraan = 0;
            $poin_pejalan_kaki = 0;

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'radio_') === 0) {
                    $index = substr($key, strlen('radio_'));
                    $jawaban_pilihan[$index] = $value; // Simpan jawaban yang dipilih dalam array
                    $jumlah_soal++; // Tambahkan jumlah soal
                } elseif (strpos($key, 'jawaban_benar_') === 0) {
                    $index = substr($key, strlen('jawaban_benar_'));
                    if (isset($jawaban_pilihan[$index]) && $jawaban_pilihan[$index] == $value) {
                        $poin++; // Tambahkan poin jika jawaban benar
                    }
                }
            }

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'radio_') === 0) {
                    $index = substr($key, strlen('radio_'));
            
                    // Tambahkan jawaban pilihan ke dalam array sesuai index soal
                    $jawaban_pilihan[$index] = $value;
            
                    // Ambil jenis soal dari hidden input
                    $type_value_for_soal = $this->input->post('type_' . $index);
            
                    // Cek apakah jawaban yang dipilih sesuai dengan jawaban benar untuk masing-masing jenis soal
                    if ($type_value_for_soal === 'Kendaraan') {
                        // Jika jawaban yang dipilih sama dengan jawaban benar, tambahkan poin pada kolom 'poin_kendaraan'
                        $jawaban_benar_kendaraan = $this->input->post('jawaban_benar_' . $index);
                        if (isset($jawaban_pilihan[$index]) && $jawaban_pilihan[$index] === $jawaban_benar_kendaraan) {
                            $poin_kendaraan++;
                        }
                        // Tambahkan jumlah soal kendaraan
                        $jumlah_soal_kendaraan++;
                    } elseif ($type_value_for_soal === 'Pejalan Kaki') {
                        // Jika jawaban yang dipilih sama dengan jawaban benar, tambahkan poin pada kolom 'poin_pejalan_kaki'
                        $jawaban_benar_pejalan_kaki = $this->input->post('jawaban_benar_' . $index);
                        if (isset($jawaban_pilihan[$index]) && $jawaban_pilihan[$index] === $jawaban_benar_pejalan_kaki) {
                            $poin_pejalan_kaki++;
                        }
                        // Tambahkan jumlah soal pejalan kaki
                        $jumlah_soal_pejalan_kaki++;
                    }
                }
            }


            // Menghitung persentase poin
            $persentase_poin = ($poin / $jumlah_soal) * 100;

            if ($jumlah_soal_kendaraan != 0) {
                $persentase_poin_kendaraan = ($poin_kendaraan / $jumlah_soal_kendaraan) * 100;
            } else {
                $persentase_poin_kendaraan = 0;
            }
            
            // Calculate the percentage for $persentase_poin_pejalan_kaki
            if ($jumlah_soal_pejalan_kaki != 0) {
                $persentase_poin_pejalan_kaki = ($poin_pejalan_kaki / $jumlah_soal_pejalan_kaki) * 100;
            } else {
                $persentase_poin_pejalan_kaki = 0;
            }


            // Gabungkan jawaban yang dipilih menjadi satu inputan
            $jawaban_pilihan_str = implode(', ', $jawaban_pilihan);

            // Mendapatkan informasi file yang diunggah
            $uploaded_files = $_FILES['gambar'];

            // Menghitung jumlah file yang diunggah
            $jumlah_file = count($uploaded_files['name']);

            // Menyiapkan array untuk menyimpan nama file
            $gambar = array();

            // Mengunggah file satu per satu
            for ($i = 0; $i < $jumlah_file; $i++) {
                $id_soal = $this->input->post('id_soal_' . $i);
                
                // Mendapatkan nama file
                $file_name = $uploaded_files['name'][$i];

                // Mendapatkan path sementara file yang diunggah
                $file_tmp = $uploaded_files['tmp_name'][$i];

                // Generate nama unik untuk file
                $file_unique_name = uniqid() . '_' . $file_name;

                // Tentukan lokasi penyimpanan file
                $file_destination = 'uploads/' . $file_unique_name;

                // Pindahkan file ke lokasi tujuan
                move_uploaded_file($file_tmp, $file_destination);

                // Simpan nama file ke dalam array gambar
                $gambar[] = $file_unique_name;
            }
            // Inisialisasi $type_values sebagai array kosong
            $type_values = array();

            // Mendapatkan data dari form POST dengan mengiterasi $_POST
            foreach ($_POST as $key => $value) {
                // Cek apakah key sesuai dengan format "type_x", x adalah angka
                if (preg_match('/^type_\d+$/', $key)) {
                    // Jika sesuai, tambahkan nilai ke array $type_values
                    $type_values[] = $value;
                }
            }

            // Menggabungkan array menjadi satu string dengan pemisah koma
            $type_str = implode(', ', $type_values);


            $id_soal_values = array();

            // Mendapatkan data dari form POST dengan mengiterasi $_POST
            foreach ($_POST as $key => $value) {
                // Cek apakah key sesuai dengan format "id_soal_x", x adalah angka
                if (preg_match('/^id_soal_\d+$/', $key)) {
                    // Jika sesuai, tambahkan nilai ke array $id_soal_values
                    $id_soal_values[] = $value;
                }
            }

            // Menggabungkan array menjadi satu string dengan pemisah koma
            $id_soal_str = implode(', ', $id_soal_values);



            
            // Buat array data untuk dimasukkan ke database
            $data = array(
                'id_type_option' => $type_option_value,
                'id_journey' => $id_journey,
                'id_cabang' => $id_cabang,
                'id_kapal' => $id_kapal,
                'id_pelabuhan' => $id_pelabuhan,
                'id_soal' => $id_soal_str,
                'nama' => $nama,
                'tanggal' => $tanggal,
                'type' => $type_str, // Use the comma-separated string for the 'type' column
                'jawaban_pilihan' => $jawaban_pilihan_str,
                'poin' => $persentase_poin,
                'poin_kendaraan' => $persentase_poin_kendaraan, // Add 'poin_kendaraan' to the database array
                'poin_pejalan_kaki' => $persentase_poin_pejalan_kaki, // Add 'poin_pejalan_kaki' to the database array
                'status' => $status,
                'gambar' => implode(',', $gambar) // Menggabungkan array gambar menjadi string dengan pemisah koma
            );

            // Lakukan insert data ke tabel laporan
            $this->db->insert('laporan', $data);

            // Assuming you have loaded the database library in CodeIgniter and the table names are 'soal' and 'laporan'
            foreach ($_POST as $name => $value) {
                // Periksa apakah input memiliki nama yang cocok dengan pola 'id_soal_N'
                if (preg_match('/^id_soal_\d+$/', $name)) {
                    $id_soal = $value; // Dapatkan id_soal dari input HTML
            
                    $dataSoal = $this->db->get_where('soal', array('id_type_option' => $type_option_value, 'id_soal' => $id_soal))->row_array();
                    if ($dataSoal) {
                        $dataLaporan = array(
                            'last_input' => $tanggal
                        );
            
                        // Lakukan pembaruan hanya untuk baris dengan 'id_type_option' yang sama dan 'id_soal' yang sesuai
                        $this->db->where('id_type_option', $type_option_value);
                        $this->db->where('id_soal', $id_soal);
                        $this->db->update('soal', $dataLaporan);
                    }
                }
            }

            redirect(site_url('pegawai/laporan_proses'));
        } else {
            echo "<script>alert('Gagal Laporan Sudah Di  Isi !!');</script>";
            echo "<script>window.location.href = '".site_url('Beranda/tambah_laporan')."';</script>";
        }
    }

    function getLastInput() {
        
    }



    public function laporan_proses()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan'); 

        $data['laporan'] = $this->model_laporan->get_data_by_status('proses');
        
        // echo $cabang;
        $this->load->view('pegawai/layout//header', $data);
         $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('pegawai/ambon/laporan_proses', $data);
        $this->load->view('pegawai/layout//footer');
    }

    public function laporan_tolak()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        $data['laporan'] = $this->model_laporan->get_data_by_status('tolak');

        $this->load->view('pegawai/layout//header', $data);
         $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('pegawai/ambon/laporan_tolak', $data);
        $this->load->view('pegawai/layout//footer');
    }
    public function laporan_setuju()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        
        $data['laporan'] = $this->model_laporan->get_data_by_status('setuju');

        $this->load->view('pegawai/layout//header', $data);
         $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('pegawai/ambon/laporan_setuju', $data);
        $this->load->view('pegawai/layout//footer');
    }


    public function ubah_sandi()
    {
        $data['title'] = 'Edit Profil';


        $this->load->view('pegawai/layout//header', $data);
        $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('pegawai/ambon/ubah_sandi', $data);
        $this->load->view('pegawai/layout//footer');
    }
    // public function laporan_detail($id_type_option, $tanggal)
    // {
    //     $data['title'] = 'laporan';
    //     $this->load->model('model_laporan');
    //     $data['laporan'] = $this->Model_laporan->getLaporanDetail($id_type_option, $tanggal);
    
        
    
    //         $this->load->view('pegawai/layout//header', $data);
    //         $this->load->view('pegawai/layout/sidebar', $data);
    //         $this->load->view('pegawai/layout/topbar', $data);
    //         $this->load->view('pegawai/ambon/laporan_detail', $data);
    //         $this->load->view('pegawai/layout//footer');
        
    // }
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
    
        // Load view dengan data yang dikirim
        $this->load->view('pegawai/layout//header', $data);
            $this->load->view('pegawai/layout/sidebar', $data);
            $this->load->view('pegawai/layout/topbar', $data);
            $this->load->view('pegawai/ambon/laporan_detail', $data);
            $this->load->view('pegawai/layout//footer');
    }
    public function edit_laporan_tolak($laporan_id)
    {
        $data['title'] = 'laporan';
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
    
            $this->load->view('pegawai/layout//header', $data);
            $this->load->view('pegawai/layout/sidebar', $data);
            $this->load->view('pegawai/layout/topbar', $data);
            $this->load->view('pegawai/ambon/edit_laporan', $data);
            $this->load->view('pegawai/layout//footer');
       
    }
    public function edit_laporan_tolak2($id_type_option, $tanggal)
    {
        $data['title'] = 'laporan edit';
        $laporan = $this->Model_laporan->getLaporanByTypeOptionAndTanggal($id_type_option, $tanggal);
    
        // Ambil data soal berdasarkan id_type_option
        $soal = $this->Model_soal->getSoalByTypeOption($id_type_option);
    
        // Kirim data laporan dan soal ke view
        $data['laporan'] = $laporan;
        $data['soal'] = $soal;
    
        
    
            $this->load->view('pegawai/layout//header', $data);
            $this->load->view('pegawai/layout/sidebar', $data);
            $this->load->view('pegawai/layout/topbar', $data);
            $this->load->view('pegawai/ambon/edit_laporan', $data);
            $this->load->view('pegawai/layout//footer');
       
    }
    public function update_laporan_edit($id)
    {
        // Mendapatkan data laporan dari database
        $laporan = $this->db->get_where('laporan', ['id_laporan' => $id])->row();

        if (!$laporan) {
            // Jika laporan tidak ditemukan, lakukan penanganan kesalahan sesuai kebutuhan
            // Misalnya, tampilkan pesan error atau redirect ke halaman lain
            die("Laporan tidak ditemukan");
        }

        // Mendapatkan input dari form
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');
        $uploaded_files = isset($_FILES['gambar']) ? $_FILES['gambar'] : null;

        // Jika nama atau tanggal tidak diubah, gunakan data yang tersimpan
        if (empty($nama)) {
            $nama = $laporan->nama;
        }

        if (empty($tanggal)) {
            $tanggal = $laporan->tanggal;
        }

        // Inisialisasi array jawaban_pilihan dan poin
        $jawaban_pilihan_array = isset($laporan->jawaban_pilihan) ? explode(',', $laporan->jawaban_pilihan) : [];
        $poin = 0;
        $jumlah_soal = 0;
        $ada_perubahan_jawaban = false; // Tambahkan variabel penanda perubahan jawaban

        $jumlah_soal_kendaraan = 0;
        $jumlah_soal_pejalan_kaki = 0;

        $poin_kendaraan = 0;
        $poin_pejalan_kaki = 0;

        // Proses perhitungan poin dan penggantian jawaban_pilihan
        foreach ($jawaban_pilihan_array as $index => $jawaban_terpilih) {
            $key = $index + 1;
            $new_jawaban = $this->input->post("radio_{$key}");
        
            // Jika ada perubahan pada jawaban_pilihan, update nilainya dan tandai ada perubahan
            if ($new_jawaban && $new_jawaban != $jawaban_terpilih) {
                $jawaban_pilihan_array[$index] = $new_jawaban;
                $ada_perubahan_jawaban = true;
            }
        
            $jumlah_soal++;
        
            // Ambil jawaban benar dari tabel soal berdasarkan id_soal dari laporan
            $id_soal_array = explode(', ', $laporan->id_soal);
            $id_soal = $id_soal_array[$index];
        
            $where = array(
                // 'id_cabang' => $laporan->id_cabang,
                // 'id_journey' => $laporan->id_journey,
                // 'id_type_option' => $laporan->id_type_option,
                'id_soal' => $id_soal
            );
        
            $jawaban_benar = $this->db->where($where)->get('soal')->row()->jawaban_benar;
        
            // Periksa jawaban terpilih dengan jawaban benar
            if ($jawaban_benar == $jawaban_pilihan_array[$index]) {
                $poin++; // Poin total
                
                // Mendapatkan tipe soal untuk id_soal saat ini
                
            }
            $type_value_for_soal = $this->db->where($where)->get('soal')->row()->type;
        
                if ($type_value_for_soal === 'Kendaraan') {
                    $jumlah_soal_kendaraan++;

                    // $jawaban_benar_kendaraan = $this->input->post('jawaban_benar_' . $index);
                    if ($jawaban_benar == $jawaban_pilihan_array[$index]) {
                        $poin_kendaraan++;
                    }
                } elseif ($type_value_for_soal === 'Pejalan Kaki') {
                    $jumlah_soal_pejalan_kaki++;

                    // $jawaban_benar_pejalan_kaki = $this->input->post('jawaban_benar_' . $index);
                    if ($jawaban_benar == $jawaban_pilihan_array[$index]) {
                        $poin_pejalan_kaki++;
                    }
                }
        }
        // Menghitung persentase poin
        $persentase_poin = ($poin / $jumlah_soal) * 100;
        
        if ($jumlah_soal_kendaraan != 0) {
            $persentase_poin_kendaraan = ($poin_kendaraan / $jumlah_soal_kendaraan) * 100;
        } else {
            $persentase_poin_kendaraan = 0;
        }
        
        // Calculate the percentage for $persentase_poin_pejalan_kaki
        if ($jumlah_soal_pejalan_kaki != 0) {
            $persentase_poin_pejalan_kaki = ($poin_pejalan_kaki / $jumlah_soal_pejalan_kaki) * 100;
        } else {
            $persentase_poin_pejalan_kaki = 0;
        }
        

        // Cek apakah terdapat perubahan pada file yang diunggah
        $ada_perubahan_gambar = false;

        // Menghapus gambar lama yang tidak berubah
        $gambar_lama = explode(',', $laporan->gambar);
        $gambar_baru = $gambar_lama; // Inisialisasi array gambar baru dengan gambar lama

        // Upload the files to the server
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($uploaded_files && !empty(array_filter($uploaded_files['name']))) {
            foreach ($uploaded_files['name'] as $index => $file_name) {
                if (isset($_FILES['gambar']['name'][$index]) && $_FILES['gambar']['name'][$index] !== "") {
                    $file_type = $_FILES['gambar']['type'][$index]; // Get the file type
                    $file_tmp = $_FILES['gambar']['tmp_name'][$index];
                    $file_unique_name = uniqid() . '_' . $file_name;
                    $file_destination = './uploads/' . $file_unique_name;

                    if (move_uploaded_file($file_tmp, $file_destination)) {
                        // Hapus gambar lama jika ada
                        $gambar_lama_path = './uploads/' . $gambar_lama[$index];
                        if (file_exists($gambar_lama_path)) {
                            unlink($gambar_lama_path);
                        }

                        // Tambahkan gambar baru ke array gambar baru pada urutan yang sesuai
                        $gambar_baru[$index] = $file_unique_name;
                        $ada_perubahan_gambar = true;
                    } else {
                        // Handle upload failure if necessary
                    }
                }
            }
        }

        // Jika tidak ada perubahan pada form edit dan gambar, langsung redirect ke halaman lain
        if (!$ada_perubahan_jawaban && !$ada_perubahan_gambar) {
            redirect(site_url('Element/laporan_p'));
        }

        

        // Update data laporan di database
        $data = array(
            'nama' => $nama,
            'tanggal' => $tanggal,
            'status' => 'proses',
            'jawaban_pilihan' => implode(', ', $jawaban_pilihan_array), // Mengubah array menjadi string
            'poin' => $persentase_poin,
            'poin_kendaraan' => $persentase_poin_kendaraan, 
            'poin_pejalan_kaki' => $persentase_poin_pejalan_kaki, 
            'gambar' => implode(',', $gambar_baru) // Menyertakan data gambar laporan yang sudah ada sebelumnya
        );

        // Update data laporan ke database
        $this->db->where('id_laporan', $id);
        $this->db->update('laporan', $data);

        // Redirect ke halaman lain setelah proses update selesai
        redirect(site_url('pegawai/laporan_proses'));
    }

    public function update_laporan_edit2($id_type_option, $tanggal)
    {
        // Mendapatkan data laporan dari database
        $laporan = $this->Model_laporan->edit_laporan($id_type_option, $tanggal);

        if (!$laporan) {
            // Jika laporan tidak ditemukan, lakukan penanganan kesalahan sesuai kebutuhan
            // Misalnya, tampilkan pesan error atau redirect ke halaman lain
            die("Laporan tidak ditemukan");
        }

        // Mendapatkan input dari form
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');
        $uploaded_files = isset($_FILES['gambar']) ? $_FILES['gambar'] : null;

        // Jika nama atau tanggal tidak diubah, gunakan data yang tersimpan
        if (empty($nama)) {
            $nama = $laporan->nama;
        }

        if (empty($tanggal)) {
            $tanggal = $laporan->tanggal;
        }

        // Inisialisasi array jawaban_pilihan dan poin
        $jawaban_pilihan_array = isset($laporan->jawaban_pilihan) ? explode(',', $laporan->jawaban_pilihan) : [];
        $poin = 0;
        $jumlah_soal = 0;
        $ada_perubahan_jawaban = false; // Tambahkan variabel penanda perubahan jawaban

        // Proses perhitungan poin dan penggantian jawaban_pilihan
        foreach ($jawaban_pilihan_array as $index => $jawaban_terpilih) {
            $key = $index + 1;
            $new_jawaban = $this->input->post("radio_{$id}_{$key}");

            // Jika ada perubahan pada jawaban_pilihan, update nilainya dan tandai ada perubahan
            if ($new_jawaban && $new_jawaban != $jawaban_terpilih) {
                $jawaban_pilihan_array[$index] = $new_jawaban;
                $ada_perubahan_jawaban = true;
            }

            $jumlah_soal++;

            // Get the correct answer from the laporan table if the conditions match
            $where = array(
                'cabang' => $laporan->cabang,
                'type' => $laporan->type,
                'type_journey' => $laporan->type_journey,
                'type_option' => $laporan->type_option
            );
            $jawaban_benar = $this->db->where($where)->get('soal')->row($index)->jawaban_benar;
            // If the correct answer is not found in the laporan table, get it from the soal table
            if ($jawaban_benar == $jawaban_pilihan_array[$index]) {
                $poin++;
            }
        }

        // Cek apakah terdapat perubahan pada file yang diunggah
        $ada_perubahan_gambar = false;

        // Menghapus gambar lama yang tidak berubah
        $gambar_lama = explode(',', $laporan->gambar);
        $gambar_baru = $gambar_lama; // Inisialisasi array gambar baru dengan gambar lama

        // Upload the files to the server
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($uploaded_files && !empty(array_filter($uploaded_files['name']))) {
            foreach ($uploaded_files['name'] as $index => $file_name) {
                if (isset($_FILES['gambar']['name'][$index]) && $_FILES['gambar']['name'][$index] !== "") {
                    $file_type = $_FILES['gambar']['type'][$index]; // Get the file type
                    $file_tmp = $_FILES['gambar']['tmp_name'][$index];
                    $file_unique_name = uniqid() . '_' . $file_name;
                    $file_destination = './uploads/' . $file_unique_name;

                    if (move_uploaded_file($file_tmp, $file_destination)) {
                        // Hapus gambar lama jika ada
                        $gambar_lama_path = './uploads/' . $gambar_lama[$index];
                        if (file_exists($gambar_lama_path)) {
                            unlink($gambar_lama_path);
                        }

                        // Tambahkan gambar baru ke array gambar baru pada urutan yang sesuai
                        $gambar_baru[$index] = $file_unique_name;
                        $ada_perubahan_gambar = true;
                    } else {
                        // Handle upload failure if necessary
                    }
                }
            }
        }

        // Jika tidak ada perubahan pada form edit dan gambar, langsung redirect ke halaman lain
        if (!$ada_perubahan_jawaban && !$ada_perubahan_gambar) {
            redirect(site_url('Element/laporan_p'));
        }

        // Menghitung persentase poin
        $persentase_poin = ($poin / $jumlah_soal) * 100;

        // Update data laporan di database
        $data = array(
            'nama' => $nama,
            'tanggal' => $tanggal,
            'status' => 'proses',
            'jawaban_pilihan' => implode(', ', $jawaban_pilihan_array), // Mengubah array menjadi string
            'poin' => $persentase_poin,
            'gambar' => implode(',', $gambar_baru) // Menyertakan data gambar laporan yang sudah ada sebelumnya
        );

        // Update data laporan ke database
        $this->db->where('id_laporan', $id);
        $this->db->update('laporan', $data);

        // Redirect ke halaman lain setelah proses update selesai
        redirect(site_url('pegawai/laporan_proses'));
    }
    public function close_laporan_tolak()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        $data['laporan'] = $this->model_laporan->get_data_by_status('tolak');

        $this->load->view('pegawai/layout//header', $data);
        $this->load->view('pegawai/layout/sidebar', $data);
        $this->load->view('pegawai/layout/topbar', $data);
        $this->load->view('pegawai/ambon/laporan_tolak', $data);
        $this->load->view('pegawai/layout//footer');
    }





    public function getJourneyOptions()
    {
        $selectedPelabuhan = $this->input->post('pelabuhan'); // Mengambil nilai pelabuhan yang dipilih dari POST data

        // Ambil opsi jenis perjalanan dari database berdasarkan pelabuhan yang dipilih
        $journeyOptions = $this->Model_laporan->getJourneyOptionsByPelabuhan($selectedPelabuhan);

        // Mengembalikan opsi jenis perjalanan dalam format JSON
        echo json_encode($journeyOptions);
    }
    
    // public function getJourneyOptions()
    // {
    //     $selectedPelabuhan = $this->input->post('pelabuhan'); // Mengambil nilai pelabuhan yang dipilih dari POST data

    //     // Ambil opsi jenis perjalanan dari tabel "type_option" berdasarkan pelabuhan yang dipilih
    //     $journeyOptions = $this->Model_laporan->getJourneyOptionsByPelabuhan($selectedPelabuhan);

    //     // Ambil data "last_input" dari tabel "soal" berdasarkan kondisi tertentu
    //     $soalData = $this->Model_laporan->getSoalDataByCondition(); // Gantilah ini dengan fungsi yang sesuai

    //     // Mengembalikan opsi jenis perjalanan dalam format JSON
    //     $response = [];

    //     foreach ($journeyOptions as $option) {
    //         // Tentukan apakah harus menonaktifkan opsi berdasarkan kondisi di tabel "soal"
    //         $disableOption = false;

    //         foreach ($soalData as $soal) {
    //             // Misalnya, Anda ingin menonaktifkan opsi jika "last_input" tidak sama dengan hari ini
    //             if ($soal->last_input != date('Y-m-d')) {
    //                 $disableOption = true;
    //                 break;
    //             }
    //         }

    //         $response[] = [
    //             'id_type_option' => $option->id_type_option,
    //             'type_option' => $option->type_option,
    //             'disabled' => $disableOption, // Menambahkan status 'disabled' berdasarkan kondisi
    //         ];
    //     }

    //     echo json_encode($response);
    // }

    public function getJourneyOptions_kapal()
    {
        $selectedkapal = $this->input->post('kapal'); // Mengambil nilai kapal yang dipilih dari POST data

        // Ambil opsi jenis perjalanan dari database berdasarkan kapal yang dipilih
        $journeyOptions = $this->Model_laporan->getJourneyOptionsBykapal($selectedkapal);

        // Mengembalikan opsi jenis perjalanan dalam format JSON
        echo json_encode($journeyOptions);
    }
    public function get_soal()
    {
        $selectedjourney = $this->input->post('journey'); // Mengambil nilai journey yang dipilih dari POST data
        $selectedOption1 = $this->input->post('option1'); // Mengambil nilai option1 yang dipilih dari POST data
        $selectedOption2 = $this->input->post('option2'); // Mengambil nilai option2 yang dipilih dari POST data
        $selectedOption3 = $this->input->post('option3'); // Mengambil nilai option3 yang dipilih dari POST data
        $selectedOption4 = $this->input->post('option4'); // Mengambil nilai option4 yang dipilih dari POST data
        
        
        $journeyOptions = $this->Model_laporan->get_soal($selectedjourney, $selectedOption1, $selectedOption2, $selectedOption3, $selectedOption4);
    
        // Mengembalikan opsi jenis perjalanan dalam format JSON
        echo json_encode($journeyOptions);
    }
    public function check_laporan_exists()
    {
        $idSoal = $this->input->post('id_soal');
        $tanggal = $this->input->post('tanggal');

        $laporanExists = $this->Model_laporan->check_laporan_exists($idSoal, $tanggal);

        echo json_encode($laporanExists);
    }
    
    


    // public function getSoal()
    // {
    //     $selectedRegional = $this->input->post('regional'); // Mengambil nilai kapal yang dipilih dari POST data
    //     $selectedValue1 = $this->input->post('journey');
    //     $selectedValue2 = $this->input->post('pelabuhan');
    //     $selectedValue3 = $this->input->post('kapal');
    //     $selectedValue4 = $this->input->post('type_option');
    //     $selectedValue5 = $this->input->post('type_option2');
    //     $selectedValue6 = $this->input->post('type_option3');
    //     $selectedValue7 = $this->input->post('type_option4');
    //     $selectedCabang = $this->input->post('cabang');

    //     $selectedOption = '';
    //     if ($selectedValue4) {
    //         $selectedOption = $selectedValue4;
    //     } elseif ($selectedValue5) {
    //         $selectedOption = $selectedValue5;
    //     } elseif ($selectedValue6) {
    //         $selectedOption = $selectedValue6;
    //     } elseif ($selectedValue7) {
    //         $selectedOption = $selectedValue7;
    //     } 
       
    //     // Ambil opsi jenis perjalanan dari database berdasarkan kapal yang dipilih
    //     $journeyOptions = $this->Model_laporan->getSoal_all(    $selectedRegional, 
    //                                                             $selectedValue1,
    //                                                             $selectedValue2,
    //                                                             $selectedValue3,
    //                                                             $selectedOption, 
    //                                                             $selectedCabang );

    //     // Mengembalikan opsi jenis perjalanan dalam format JSON
    //     echo json_encode($journeyOptions);
    // }

}