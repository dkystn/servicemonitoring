 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Verifikasi Tacit Knowladge</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page">Verifikasi Tacit Knowladge</li>
         </ol>
     </div>

     <div class="row">
         <div class="col-lg-12 mb-4">
             <!-- Simple Tables -->
             <div class="card">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Verifikasi Tacit Knowladges</h6>
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
                         <?php $no = 1; foreach ($tacit as $tacit){ ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tacit->judul_tacit; ?></td>
                                    <td><?php echo $tacit->tgl_tacit; ?></td>
                                    <td><?php echo $tacit->keterangan_tacit; ?></td>
                                    <td><div class="text-center">
                                    <a href="<?php echo base_url('element/update_status_tacit/'.$tacit->id_tacit); ?>">Aktifkan</a>
                                    <a  class="btn" href="<?php echo site_url('element/hapus_tacit/' . $tacit->id_tacit); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                     <button>Hapus</button>
                                    </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                         <tbody>
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