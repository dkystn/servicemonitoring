<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Element extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function tambah_laporan()
    {
        $data['title'] = 'Laporan';
        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data();


        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_p', $data);
        $this->load->view('_layout/topbar_p_explicit', $data);
        $this->load->view('pegawai/tambah_laporan', $data);
        $this->load->view('_layout/footer');
    }

    public function ubah_sandi()
    {
        $data['title'] = 'Edit Profil';


        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('element/ubah_sandi', $data);
        $this->load->view('_layout/footer');
    }
    public function ubah_sandi_a()
    {
        $data['title'] = 'Edit Profil';


        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_a', $data);
        $this->load->view('_layout/topbar_a', $data);
        $this->load->view('element/ubah_sandi', $data);
        $this->load->view('_layout/footer');
    }
    public function ubah_sandi_p()
    {
        $data['title'] = 'Edit Profil';


        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_p', $data);
        $this->load->view('_layout/topbar_p', $data);
        $this->load->view('element/ubah_sandi', $data);
        $this->load->view('_layout/footer');
    }

    public function tambah_user()
    {
        $data['title'] = 'Tambah Akun User';


        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_a', $data);
        $this->load->view('_layout/topbar_a', $data);
        $this->load->view('admin/ambon/registrasi', $data);
        $this->load->view('_layout/footer');
    }
    public function akun_user()
    {
        $data['title'] = 'Akun User';

        $this->load->model('Model_akun');
        $data['data'] = $this->Model_akun->get_data();

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_a', $data);  
        $this->load->view('_layout/topbar_a', $data);
        $this->load->view('admin/ambon/tableakun', $data);
        $this->load->view('_layout/footer');
    }
    public function soal()
    {
        $data['title'] = 'Soal';

        $this->load->model('Model_soal');
        $data['data'] = $this->Model_soal->get_data();

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_a', $data);
        $this->load->view('_layout/topbar_a', $data);
        $this->load->view('admin/ambon/soal', $data);
        $this->load->view('_layout/footer');
    }
    public function add_user()
    {

        if (isset($_POST['add'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->element->add_user($inputan);
        } else if (isset($_POST['edit'])) {
            $inputan = $this->input->post(null, TRUE);
            $this->element->add_user($inputan);
        }
        redirect('element/akun_user2');
    }

    public function add_user2()
    {

        $data = array(
            'nik' => $this->input->post('nik'),
            'nama_user' => $this->input->post('nama_user'),
            'gender' => $this->input->post('gender'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'level_pengguna' => $this->input->post('level_pengguna'),
            'cabang' => $this->input->post('cabang'),
            'status_user' => $this->input->post('status_user')
        );

        $this->db->insert('user', $data);
        redirect(base_url() . 'element/akun_user');
    }
    public function add_soal()
    {
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

        $type_journey = $this->input->post('type_journey');
        $type_journey2 = $this->input->post('type_journey2');

        if ($this->input->post('type') == 'Pejalan Kaki' && $type_journey == 0) {
            $type_journey = $type_journey2;
        }

        $data = array(
            'regional' => $this->input->post('regional'),
            'cabang' => $this->input->post('cabang'),
            'type' => $this->input->post('type'),
            'type_journey' => $type_journey,
            'type_option' => $type_option_value, // Menambahkan nilai ke kolom "type_option"
            'soal' => $this->input->post('soal'),
            'jawaban_1' => $this->input->post('jawaban_1'),
            'jawaban_2' => $this->input->post('jawaban_2'),
            'jawaban_benar' => $this->input->post('jawaban_benar'),
            'gambar_bukti' => $this->input->post('gambar_bukti')
        );

        $this->db->insert('soal', $data);
        redirect(base_url() . 'element/soal');
    }
    public function getDataSoal($regional, $cabang, $type, $type_journey, $type_option)
    {
        $data = $this->Model_soal->getDataByFilters($regional, $cabang, $type, $type_journey, $type_option);
        echo json_encode($data);
    }
    public function edit_akun($id_user)
    {
        $data['data'] = $this->db->get_where('user', array('id_user' => $id_user))->row();
        $this->load->view('element/akun_user', $data);
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
    public function edit_soal($id)
    {
        $data['soal'] = $this->db->get_where('soal', array('id_soal' => $id))->row_array();

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_a', $data);
        $this->load->view('_layout/topbar_a', $data);
        $this->load->view('element/edit_soal', $data);
        $this->load->view('_layout/footer');
    }
    public function get_soal()
    {
        $type = $this->input->post('type');
        $data['soal'] = $this->Model_soal->get_soal_by_type($type); // contoh query ke database menggunakan model

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_p', $data);
        $this->load->view('_layout/topbar_p_explicit', $data);
        $this->load->view('element/table2/soal2', $data);
        $this->load->view('_layout/footer');
    }
    public function update_soal($id)
    {
        $data = array(
            'type' => $this->input->post('type'),
            'type_journey' => $this->input->post('type_journey') ?: $this->input->post('type_journey2'),
            'type_option' => $this->input->post('type_option'),
            'soal' => $this->input->post('soal'),
            'jawaban_1' => $this->input->post('jawaban_1'),
            'jawaban_2' => $this->input->post('jawaban_2'),
            'jawaban_benar' => $this->input->post('jawaban_benar'),
            'gambar_bukti' => $this->input->post('gambar_bukti')
        );

        $this->db->where('id_soal', $id);
        $this->db->update('soal', $data);

        redirect(base_url() . 'element/soal');
    }
    public function hapus_akun($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
        redirect(base_url() . 'element/akun_user');
    }
    public function hapus_soal($id)
    {
        $this->db->where('id_soal', $id);
        $this->db->delete('soal');
        redirect(base_url() . 'element/soal');
    }
    public function login()
    {
        $data['title'] = 'Login';
        $this->load->view('element/login.php', $data);
    }

    public function change_password()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('change_password_view');
        } else {
            $password = $this->input->post('password');

            $this->load->database();
            $this->db->update('user', array('password' => $password), array('id_user' => $this->session->userdata('id_user')));
            redirect('login');
        }
    }
    
    public function update_status_tacit($id_tacit)
    {
        $this->load->model('model_tacit');
        $this->model_tacit->update_status($id_tacit);

        redirect(site_url('Element/tacit'));
    }

    public function logout()
    {
        // Hapus semua session
        $this->session->sess_destroy();

        // Redirect ke halaman login
        redirect(site_url('Element/login'));
    }
    public function searchData()
    {

        $keyword = $this->input->get('term');
        $data = $this->model_tacit->search()($keyword);
        echo json_encode($data);
    }

    public function laporan()
    {
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

        $type_journey = $this->input->post('type_journey');
        $type_journey2 = $this->input->post('type_journey2');

        if ($this->input->post('type') == 'Pejalan Kaki' && $type_journey == 0) {
            $type_journey = $type_journey2;
        }
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');
        $cabang = $this->input->post('cabang');
        $regional = $this->input->post('regional');
        $type = $this->input->post('type');
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
        redirect(site_url('Element/laporan_p'));
    }

    public function verifikasi_laporan_p()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');

        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('proses');
        }

        // Mendapatkan data gambar untuk setiap laporan
        foreach ($data['laporan'] as $key => $lap) {
            // Pisahkan nama-nama file gambar menjadi array
            $gambar_names = explode(', ', $lap->gambar);
            $data['laporan'][$key]->gambar_names = $gambar_names;
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('pimpinan/ambon/verifikasi_laporan', $data);
        $this->load->view('_layout/footer');
    }
    public function laporan_pimpinan()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');

        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('proses');
        }

        // Mendapatkan data gambar untuk setiap laporan
        foreach ($data['laporan'] as $key => $lap) {
            // Pisahkan nama-nama file gambar menjadi array
            $gambar_names = explode(', ', $lap->gambar);
            $data['laporan'][$key]->gambar_names = $gambar_names;
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('pimpinan/ambon/laporan_proses', $data);
        $this->load->view('_layout/footer');
    }
    public function laporan_p()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');

        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('proses');
        }

        // Mendapatkan data gambar untuk setiap laporan
        foreach ($data['laporan'] as $key => $lap) {
            // Pisahkan nama-nama file gambar menjadi array
            $gambar_names = explode(', ', $lap->gambar);
            $data['laporan'][$key]->gambar_names = $gambar_names;
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_p', $data);
        $this->load->view('_layout/topbar_p_laporan', $data);
        $this->load->view('pegawai/laporan_proses', $data);
        $this->load->view('_layout/footer');
    }
    public function laporan_a()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');

        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('proses');
        }

        // Mendapatkan data gambar untuk setiap laporan
        foreach ($data['laporan'] as $key => $lap) {
            // Pisahkan nama-nama file gambar menjadi array
            $gambar_names = explode(', ', $lap->gambar);
            $data['laporan'][$key]->gambar_names = $gambar_names;
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_a', $data);
        $this->load->view('_layout/topbar_a', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('_layout/footer');
    }
    public function laporan_pimpinan_tolak()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('tolak');
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('pimpinan/ambon/laporan_tolak', $data);
        $this->load->view('_layout/footer');
    }
    public function laporan_p_tolak()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('tolak');
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_p', $data);
        $this->load->view('_layout/topbar_p_laporan', $data);
        $this->load->view('pegawai/laporan_tolak', $data);
        $this->load->view('_layout/footer');
    }
    public function laporan_a_tolak()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('tolak');
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_a', $data);
        $this->load->view('_layout/topbar_a', $data);
        $this->load->view('admin/ambon/laporan_tolak', $data);
        $this->load->view('_layout/footer');
    }

    public function laporan_pimpinan_setuju()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('setuju');
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('pimpinan/ambon/laporan_pimpinan_setuju', $data);
        $this->load->view('_layout/footer');
    }

    public function laporan_p_setuju()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('setuju');
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_p', $data);
        $this->load->view('_layout/topbar_p_laporan', $data);
        $this->load->view('pegawai/laporan_setuju', $data);
        $this->load->view('_layout/footer');
    }
    public function laporan_a_setuju()
    {
        $data['title'] = 'Laporan';
        $this->load->model('model_laporan');
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['laporan'] = $this->model_laporan->search($search);
        } else {
            $data['laporan'] = $this->model_laporan->get_data_by_status('setuju');
        }

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_a', $data);
        $this->load->view('_layout/topbar_a', $data);
        $this->load->view('admin/ambon/laporan_setuju', $data);
        $this->load->view('_layout/footer');
    }


    public function laporan_detail($id)
    {
        $data['title'] = 'laporan';
        $this->load->model('model_laporan');
        $laporan = $this->model_laporan->get_laporan_by_id($id);
     
        if (!empty($laporan)) {
            // Mengakses semua soal yang memiliki nilai "cabang" dan "regional" yang sesuai dengan nilai yang tersimpan di tabel "laporan"
            $this->load->model('model_soal');
            $cabang = $laporan[0]->cabang; // Ambil nilai "cabang" dari salah satu objek laporan
            $regional = $laporan[0]->regional; // Ambil nilai "regional" dari salah satu objek laporan
            $type = $laporan[0]->type;
            $type_journey = $laporan[0]->type_journey;
            $type_option = $laporan[0]->type_option;
            $data['soal'] = $this->model_soal->get_soal_by_laporan($cabang, $regional, $type, $type_journey, $type_option);
    
            $data['laporan'] = $laporan;
    
            $this->load->view('_layout/header', $data);
            $this->load->view('_layout/sidebar_p', $data);
            $this->load->view('_layout/topbar_p_explicit', $data);
            $this->load->view('element/knowladge/laporan_detail', $data);
            $this->load->view('_layout/footer');
        } else {
            // Tampilkan pesan error
            show_error('Laporan tidak ditemukan');
    
            // Atau lakukan redirect ke halaman lain
            // redirect('halaman_lain');
        }
    }
    public function laporan_detail_pimpinan($id)
    {
        $data['title'] = 'laporan';
        $this->load->model('model_laporan');
        $laporan = $this->model_laporan->get_laporan_by_id($id);
    
        if (!empty($laporan)) {
            // Mengakses semua soal yang memiliki nilai "cabang" dan "regional" yang sesuai dengan nilai yang tersimpan di tabel "laporan"
            $this->load->model('model_soal');
            $cabang = $laporan[0]->cabang; // Ambil nilai "cabang" dari salah satu objek laporan
            $regional = $laporan[0]->regional; // Ambil nilai "regional" dari salah satu objek laporan
            $type = $laporan[0]->type;
            $type_journey = $laporan[0]->type_journey;
            $type_option = $laporan[0]->type_option;
            $data['soal'] = $this->model_soal->get_soal_by_laporan($cabang, $regional, $type, $type_journey, $type_option);
    
            $data['laporan'] = $laporan;
    
            $this->load->view('_layout/header', $data);
            $this->load->view('_layout/sidebar', $data);
            $this->load->view('_layout/topbar', $data);
            $this->load->view('element/knowladge/laporan_detail_pimpinan', $data);
            $this->load->view('_layout/footer');
        } else {
            // Tampilkan pesan error
            show_error('Laporan tidak ditemukan');
    
            // Atau lakukan redirect ke halaman lain
            // redirect('halaman_lain');
        }
    }
    public function laporan_detail_a($id)
    {
        $data['title'] = 'laporan';
        $this->load->model('model_laporan');
        $laporan = $this->model_laporan->get_laporan_by_id($id);
    
        if (!empty($laporan)) {
            // Mengakses semua soal yang memiliki nilai "cabang" dan "regional" yang sesuai dengan nilai yang tersimpan di tabel "laporan"
            $this->load->model('model_soal');
            $cabang = $laporan[0]->cabang; // Ambil nilai "cabang" dari salah satu objek laporan
            $regional = $laporan[0]->regional; // Ambil nilai "regional" dari salah satu objek laporan
            $type = $laporan[0]->type;
            $type_journey = $laporan[0]->type_journey;
            $type_option = $laporan[0]->type_option;
            $data['soal'] = $this->model_soal->get_soal_by_laporan($cabang, $regional, $type, $type_journey, $type_option);
    
            $data['laporan'] = $laporan;
    
            $this->load->view('_layout/header', $data);
            $this->load->view('_layout/sidebar_a', $data);
            $this->load->view('_layout/topbar_a', $data);
            $this->load->view('element/knowladge/laporan_detail_a', $data);
            $this->load->view('_layout/footer');
        } else {
            // Tampilkan pesan error
            show_error('Laporan tidak ditemukan');
    
            // Atau lakukan redirect ke halaman lain
            // redirect('halaman_lain');
        }
    }
    public function update_laporan($id_laporan)
    {
        $this->load->model('model_laporan');
        $this->model_laporan->update_laporan($id_laporan);

        redirect(site_url('Element/verifikasi_laporan_p'));
    }
    public function update_laporan_tolak_a($id_laporan)
    {
        $this->load->model('model_laporan');
        $this->model_laporan->update_laporan_tolak($id_laporan);
        $laporan = $this->model_laporan->get_laporan_by_id($id_laporan);
        $jawaban_pilihan_semua = isset($laporan[0]->jawaban_pilihan) ? $laporan[0]->jawaban_pilihan : '';

        redirect(site_url('Element/verifikasi_laporan_p'));
    }
    public function update_laporan_tolak($id)
    {
        $data['title'] = 'laporan';
        $this->load->model('model_laporan');
        $laporan = $this->model_laporan->get_laporan_by_id($id);
    
        if (!empty($laporan)) {
            
            $this->load->model('model_soal');
            $cabang = $laporan[0]->cabang; 
            $regional = $laporan[0]->regional; 
            $type = $laporan[0]->type;
            $type_journey = $laporan[0]->type_journey;
            $type_option = $laporan[0]->type_option;
            $data['soal'] = $this->model_soal->get_soal_by_laporan($cabang, $regional, $type, $type_journey, $type_option);
    
            $data['laporan'] = $laporan;
    
            $this->load->view('_layout/header', $data);
            $this->load->view('_layout/sidebar_p', $data);
            $this->load->view('_layout/topbar_p_explicit', $data);
            $this->load->view('element/edit_laporan copy', $data);
            $this->load->view('_layout/footer');
        } else {
            // Tampilkan pesan error
            show_error('Laporan tidak ditemukan');
    
            // Atau lakukan redirect ke halaman lain
            // redirect('halaman_lain');
        }
    }


public function update_laporan_edit_gambar_aman($id)
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
        $jawaban_benar = $this->db->get_where('soal', $where)->row("jawaban_benar");

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
        'jawaban_pilihan' => implode(',', $jawaban_pilihan_array), // Mengubah array menjadi string
        'poin' => $persentase_poin,
        'gambar' => implode(',', $gambar_baru) // Menyertakan data gambar laporan yang sudah ada sebelumnya
    );

    // Update data laporan ke database
    $this->db->where('id_laporan', $id);
    $this->db->update('laporan', $data);

    // Redirect ke halaman lain setelah proses update selesai
    redirect(site_url('Element/laporan_p'));
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
    redirect(site_url('Element/laporan_p'));
}


    public function edit_laporan($id)
    {
        $data['laporan'] = $this->db->get_where('laporan', array('id_laporan' => $id))->row_array();

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar_a', $data);
        $this->load->view('_layout/topbar_a', $data);
        $this->load->view('element/edit_laporan copy', $data);
        $this->load->view('_layout/footer');
    }
    

    // Di dalam controller UserController
    public function getUsername($id)
    {
        // Panggil method di model untuk mendapatkan username
        $username = $this->UserModel->getUsernameById($id);

        if ($username) {
            // Jika username ditemukan, kembalikan sebagai respons JSON
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($username));
        } else {
            // Jika username tidak ditemukan, kembalikan respons JSON kosong atau tindakan lainnya
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(null));
        }
    }

}
