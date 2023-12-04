 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Data Explicit Knowladge</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Khowladge</li>
             <li class="breadcrumb-item active" aria-current="page">Explicit</li>
         </ol>
     </div>
     <?php foreach ($explicit as $explicit) { ?>
         <!-- Row -->
         <div class="row">
             <div class="col-md-6">
                 <!-- Modal basic -->
                 <div class="card mb-4">

                     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                         <h6 class="m-0 font-weight-bold text-primary"><?php echo $explicit->judul_explicit; ?></h6>
                     </div>
                     <div class="card-body">
                         <p><?php echo $explicit->keterangan_explicit; ?></p>
                         <a href="<?php echo site_url('element/Explicit_detail/' . $explicit->id_explicit) ?>">Lihat Detail</a>
                     </div>

                 </div>
             </div>
         </div>
         <!-- Row -->

         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">

                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <span>Judul</span>
                         <p> <?php echo $explicit->judul_explicit; ?></p>
                     </div>
                     <div class="modal-body">
                         <span>Keterangan</span>
                         <p> <?php echo $explicit->keterangan_explicit; ?></p>
                     </div>
                     <div class="modal-body">
                         <span>Tanggal</span>
                         <p> <?php echo $explicit->tgl_explicit; ?></p>
                     </div>
                     <div class="modal-body">
                         <span>File</span>
                         <img src="<?php echo $explicit->gambar; ?>"> </img>
                     </div>

                 </div>
             </div>
         </div>
     <?php } ?>
 </div>