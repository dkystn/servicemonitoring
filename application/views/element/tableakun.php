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
                 
                 <div class="table-responsive">
                     <table class="table align-items-center table-flush" id="table">
                         <thead class="thead-light">
                             <tr>
                                 <th>No</th>
                                 <th>NIP</th>
                                 <th>Nama</th>
                                 <th>Username</th>
                                 <th>Jabatan</th>
                                 <th>Gender</th>
                                 <th>Cabang</th>
                                 <th>Status</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                            <?php $no = 1; foreach ($data as $d){ ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d->nik; ?></td>
                                    <td><?php echo $d->nama_user; ?></td>
                                    <td><?php echo $d->username; ?></td>
                                    <td><?php echo $d->level_pengguna; ?></td>
                                    <td><?php echo $d->gender; ?></td>
                                    <td><?php echo $d->cabang; ?></td>
                                    <td><?php echo $d->status_user; ?></td>
                                    <td><div class="text-center">
                                    <a  class="btn btn-danger" href="<?php echo site_url('element/hapus_akun/' . $d->id_user); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
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
                   <form class="user mt-2" action="<?php echo base_url().'Element/add_user2'; ?>" method="post" >
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
                        <label for="cabang">Cabang</label>
                        <div class="form-group">
                            <select class="form-control" name="cabang">
                            <option value="0">Select Cabang</option>
                                     <option value="AMBON">AMBON</option>
                                     <option value="BAJOE">BAJOE</option>
                                     <option value="BAKAUHENI">BAKAUHENI</option>
                                     <option value="BALIKPAPAN">BALIKPAPAN</option>
                                     <option value="BANDA ACEH">BANDA ACEH</option>
                                     <option value="BANGKA">Regional 4</option>
                                     <option value="BATAM">BATAM</option>
                                     <option value="BATULICIN">BATULICIN</option>
                                     <option value="BAU BAU">BAU BAU</option>
                                     <option value="BIAK">BIAK</option>
                                     <option value="BITUNG">BITUNG</option>
                                     <option value="DANAU TOBA">DANAU TOBA</option>
                                     <option value="JEPARA">JEPARA</option>
                                     <option value="KAYANGAN">KAYANGAN</option>
                                     <option value="KETAPANG">KETAPANG</option>
                                     <option value="KUPANG">KUPANG</option>
                                     <option value="LEMBAR">LEMBAR</option>
                                     <option value="LUWUK">LUWUK</option>
                                     <option value="MERAK">MERAK</option>
                                     <option value="MERAUKE">MERAUKE</option>
                                     <option value="PADANG">PADANG</option>
                                     <option value="PONTIANAK">PONTIANAK</option>
                                     <option value="SAPE">SAPE</option>
                                     <option value="SELAYAR">SELAYAR</option>
                                     <option value="SINGKIL">SINGKIL</option>
                                     <option value="SORONG">SORONG</option>
                                     <option value="SURABAYA">SURABAYA</option>
                                     <option value="TERNATE">TERNATE</option>
                                     <option value="TUAL">TUAL</option>
                            </select>
                        </div>
                        
                        
                        <label for="status_user">Status User</label>
                        <div class="form-group">
                            <select class="form-control" name="status_user">
                                <option value="Aktif" selected>Aktif</option>
                            </select>
                        </div>
                        
                 
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
                 <form class="user mt-2" action="<?php echo site_url('element/update_akun/' . $data->id_user); ?>" method="post">

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
