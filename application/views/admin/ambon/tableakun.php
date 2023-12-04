 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"> Akun User</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page"> Kelola Akun User</li>
         </ol>
     </div>

     <div class="row">
         <div class="col-lg-12 mb-4">
             <!-- Simple Tables -->
             <div class="card">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary"> Kelola Akun User</h6>
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="#myBtn">
                         + Tambah Akun User
                     </button>
                 </div>
                 
                 <div class="table-responsive" >
                     <table class="table align-items-center table-flush" id="table">
                         <thead class="thead-light">
                             <tr>
                                 <th>No</th>
                                 <th>NIP</th>
                                 <th>Nama</th>
                                 <th>Username</th>
                                 <th>Password</th>
                                 <th>Jabatan</th>
                                 <th>Gender</th>
                                 <th>Regional</th>
                                 <th>Cabang</th>
                                 <th class="text-center" colspan="2">Aksi</th>
                             </tr>
                         </thead>
                         <tbody >
                            <?php $no = 1; foreach ($data as $d){ ?>
                                <tr class="searchable-item">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d->nik; ?></td>
                                    <td><?php echo $d->nama_user; ?></td>
                                    <td><?php echo $d->username; ?></td>
                                    <td><?php echo $d->password; ?></td>
                                    <td><?php echo $d->level_pengguna; ?></td>
                                    <td><?php echo $d->gender; ?></td>
                                    <td>
                                        <?php
                                        $regional_data = $this->Model_soal->get_regional_by_id($d->id_regional);
                                        echo $regional_data !== null ? $regional_data->regional : '-'; // Assuming "nama_pelabuhan" is the column name in the "tabel_pelabuhan" table that you want to display
                                        ?>
                                    </td>
                                    <td>
                                    <?php
                                        $cabang_data = $this->Model_soal->get_cabang_by_id($d->id_cabang);
                                        echo $cabang_data !== null ? $cabang_data->cabang : '-';
                                        ?>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a class="btn btn-warning" href="<?php echo site_url('admin/edit_akun/' . $d->id_user); ?>" onclick="return confirm('Anda yakin ingin mengedit data ini?');">
                                                edit
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a  class="btn btn-danger" href="<?php echo site_url('admin/hapus_akun/' . $d->id_user); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                            Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
     <!--Row-->
     <div class="card-footer"></div>
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header"> 
                     <h5 class="modal-title" id="exampleModalLabel">Form Tambah Akun </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                   <form class="user mt-2" action="<?php echo base_url().'admin/add_user'; ?>" method="post" >
                 <div class="container">
                  
                        <label for="nik">NIP</label> 
                        <div class="form-group">
                            <input class="form-control" type="text" name="nik" id="nik">
                        </div>
                        <label for="nama_user">Nama</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="nama_user" id="nama_user">
                        </div>
                        <label for="gender">Gender</label>
                        <div class="form-group">
                            <select class="form-control" name="gender">
                                <option class="form-control" value="L">Laki-laki</option>
                                <option  class="form-control" value="P">Perempuan</option>
                            </select>
                        </div>
                        <label for="username">Username</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="username" id="username">
                        </div>
                        <label for="password">password</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="password" id="password">
                        </div>
                        <label for="level_pengguna">Jabatan</label>
                        <div class="form-group">
                            <select class="form-control" name="level_pengguna">
                                <option value="Pimpinan">Pimpinan</option>
                                <option value="Admin">Admin</option>
                                <option value="Pegawai">Pegawai</option>
                            </select>
                        </div>
                        <input class="form-control" type="text" name="regional" id="regional" value="" readonly>
                        <label for="cabang">Cabang</label>
                        <div class="form-group">
                            <select class="form-control" name="cabang" id="cabangSelect">
                            <option value="0">Select Cabang</option>
                            <?php 
                                foreach ($data_cabang as $row) { ?>
                                    <option value="<?php echo $row->id_cabang; ?>"  data-regional="<?php echo $row->id_regional; ?>"><?php echo $row->cabang; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <!-- <label for="ket">Akses Kapal/Pelabuhan</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="ket" id="ket">
                        </div>
                        
                        
                        <label for="status_user">Status User</label>
                        <div class="form-group">
                            <select class="form-control" name="status_user">
                                <option value="Aktif" selected>Aktif</option>
                            </select>
                        </div> -->
                        
                 
                 </div>
                 
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Tambah</button>
                 </div>

                </form>
             </div>
         </div>
     </div>
 </div>
 <script>
    // Mendapatkan elemen-elemen yang diperlukan
    const regionalInput = document.getElementById('regional');
    const cabangSelect = document.getElementById('cabangSelect');

    // Menambahkan event listener untuk perubahan pada pilihan cabang
    cabangSelect.addEventListener('change', function () {
        // Mendapatkan id_regional yang terkait dengan pilihan cabang
        const selectedOption = cabangSelect.options[cabangSelect.selectedIndex];
        const idRegional = selectedOption.getAttribute('data-regional');

        // Menetapkan id_regional pada input teks "regional"
        regionalInput.value = idRegional;
    });
</script>
 <!---Container Fluid-->

 <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Form Ubah Akun</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form class="user mt-2" action="<?php echo site_url('admin/update_akun/' . $data->id_user); ?>" method="post">

                     <div class="container">
                  
                        <label for="nik">NIP</label> 
                        <div class="form-group">
                            <input class="form-control" type="text"  name="nik" id="nik">
                        </div>
                        <label for="nama_user">Nama</label>
                        <div class="form-group">
                            <input class="form-control" type="text"  name="nama_user" id="nama_user">
                        </div>
                        <label for="gender">Gender</label>
                        <div class="form-group">
                            <input class="form-control" type="text"  name="gender" id="gender">
                        </div>
                        <label for="username">Username</label>
                        <div class="form-group">
                            <input class="form-control" type="text"  name="username" id="username">
                        </div>
                        <label for="password">password</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="password" id="password">
                        </div>
                        <label for="level_pengguna">Jabatan</label>
                        <div class="form-group">
                            <input class="form-control" type="text"  name="level_pengguna" id="level_pengguna">
                        </div>
                        <label for="status_user">Status User</label>
                        <div class="form-group">
                            <input class="form-control" type="text"  name="status_user" id="status_user">
                        </div>
                 </div>
                 
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" value="Simpan" class="btn btn-primary">Ubah</button>
                 </div>

                </form>
             </div>
         </div>
     </div>
     </div>
