 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Verifikasi Laporan</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Data Laporan</li>
             <li class="breadcrumb-item active" aria-current="page">Verifikasi Laporan </li>
         </ol>
     </div>
     <div class="row">
         <?php foreach ($laporan as $laporan) { ?>
             <!-- Row -->
             <div class="col-md-6">
                 <div class="card mb-4">
                     <div class="card-header d-flex flex-row align-items-center justify-content-between">
                         <h6 class="m-0 font-weight-bold text-primary"><?php echo $laporan->nama; ?></h6>
                         <button class="btn btn-warning">PROSES</button>
                     </div>
                     <div class="card-body">
                         <p><?php echo $laporan->tanggal; ?></p>
                         <p>Point: <?php echo $laporan->poin; ?></p>
                         <?php
                            $gambar_names = explode(', ', $laporan->gambar);
                            if (!empty($gambar_names[1])) {
                                $gambar_path = base_url('assets/gambar/' . $gambar_names[1]);
                                echo '<img src="' . $gambar_path . '" alt="Gambar">';
                            }
                            ?>
                        <a class="btn btn-success "href="<?php echo base_url('element/update_laporan/'.$laporan->id_laporan); ?>">Aktifkan</a> 
                        <button class="btn btn-danger " data-toggle="modal" data-target="#exampleModal" id="#myBtn" >Tolak</button>
                        <a class="btn btn-primary" href="<?php echo site_url('element/laporan_detail_pimpinan/' . $laporan->id_laporan) ?>">Lihat Detail</a>
                     </div>
                 </div>
             </div>
             <!-- Row -->
         <?php } ?>
     </div>
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Form Catatan </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                   <form class="user mt-2" action="<?php echo base_url('element/update_laporan_tolak_a/'.$laporan->id_laporan); ?>" method="post" >
                 <div class="container">
                        <label for="catatan">Catatan</label> 
                        <div class="form-group text-center">
                            <textarea name="catatan" id="catatan" style="width: 80%;" rows="10"></textarea>
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