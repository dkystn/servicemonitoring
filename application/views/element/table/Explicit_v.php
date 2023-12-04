 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Verifikasi Explicit Knowladge</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page">Verifikasi Explicit Knowladge</li>
         </ol>
     </div>

     <div class="row">
         <div class="col-lg-12 mb-4">
             <!-- Simple Tables -->
             <div class="card">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Verifikasi Explicit Knowladges</h6>
                 </div>
                 
                 <div class="table-responsive">
                     <table class="table align-items-center table-flush">
                         <thead class="thead-light">
                             <tr>
                                 <th>No</th>
                                 <th>Judul Khowladge</th>
                                 <th>Tanggal Buat</th>
                                 <th>Keterangan</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                         <?php $no = 1; foreach ($explicit as $explicit){ ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $explicit->judul_explicit; ?></td>
                                    <td><?php echo $explicit->tgl_explicit; ?></td>
                                    <td><?php echo $explicit->keterangan_explicit; ?></td>
                                    <td><div class="text-center">
                                    <a class="btn btn-primary"href="<?php echo base_url('element/update_status/'.$explicit->id_explicit); ?>">Aktifkan</a>

                                    <a  class="btn btn-danger" href="<?php echo site_url('element/hapus_explicit/' . $explicit->id_explicit); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                     Hapus
                                    </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                         </tbody>
                     </table>
                 </div>
                 <div class="card-footer"></div>
             </div>
         </div>
     </div>
     <!--Row-->
 </div>
 <!---Container Fluid-->