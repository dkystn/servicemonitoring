<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Login';
		$this->load->view('element/login.php',$data);
	}
	
	public function masuk_login2()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");
			
		$cek = $this->model_login->cek_data_pengguna($username,md5($password));
		
        if(count($cek) == 1){ 
            foreach ($cek as $rows) {
				$id_user = $rows->id_user;
                $nama_user = $rows->nama_user;
				$level_pengguna = $rows->level_pengguna;
				$id_cabang = $rows->id_cabang;
            }
			
            $this->session->set_userdata(array(
                'loginMasuk'		=> TRUE, 
				'id_user' 			=> $id_user,
				'nama_user' 		=> $nama_user,
				'level_pengguna' 	=> $level_pengguna,
				'id_cabang' 	=> $id_cabang
            ));
			if($this->session->userdata('level_pengguna')=='Admin'){
				redirect('admin');
			}else if ($this->session->userdata('level_pengguna')=='Pegawai'){
				redirect('beranda');
			}else {
				redirect('Pimpinan');
			}
		
		}else{
			$this->session->set_flashdata('pesan','<script>swal.fire("Gagal","Username atau password tidak ditemukan","error")</script>');
            redirect('login');
		}
	}
	public function masuk_login()
{
    $username = $this->input->post("username");
    $password = $this->input->post("password");
    
    $cek = $this->model_login->cek_data_pengguna($username, $password);
    
    if (count($cek) == 1) {
        foreach ($cek as $rows) {
            $id_user = $rows->id_user;
            $nama_user = $rows->nama_user;
            $level_pengguna = $rows->level_pengguna;
            $cabang = $rows->id_cabang; // Menambahkan variabel cabang
        }
        
        $this->session->set_userdata(array(
            'loginMasuk'        => TRUE,
            'id_user'           => $id_user,
            'nama_user'         => $nama_user,
            'level_pengguna'    => $level_pengguna,
            'id_cabang'         => $cabang // Menyimpan cabang dalam session
        ));
        
        if ($this->session->userdata('level_pengguna') == 'Admin') {
            redirect('admin');
        } else if ($this->session->userdata('level_pengguna') == 'Pegawai') {
            redirect('beranda');
        } else if ($this->session->userdata('level_pengguna') == 'Pimpinan') {
            redirect('pimpinan');
        }
    } else {
        // Cek apakah username ada dalam database
        $cek_username = $this->model_login->cek_username($username);
        
        if (count($cek_username) == 0) {
            // Jika username tidak terdaftar
            $pesan = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Login Gagal !</strong> Username Tidak terdaftar !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            // Jika username terdaftar, maka password salah
            $pesan = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Login Gagal !</strong> Password Salah !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        
        $this->session->set_flashdata('pesan', $pesan);
        redirect('login');
    }
}




	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	

}


