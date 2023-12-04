 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Data Laporan</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Data Laporan</li>
             <li class="breadcrumb-item active" aria-current="page">Laporan Setuju</li>
         </ol>
     </div>
     <div class="row">
         <?php foreach ($laporan as $laporan) { ?>
             <!-- Row -->

             <div class="col-md-6">
                 <div class="card mb-4">
                     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                         <h6 class="m-0 font-weight-bold text-primary"><?php echo $laporan->nama; ?></h6>
                         <button class="btn btn-success">SUCCESS</button>
                     </div>
                     <div class="card-body">
                         <p><?php echo $laporan->tanggal; ?></p>
                         <p>Point: <?php echo $laporan->poin; ?></p>
                         <a class="btn btn-primary" href="<?php echo site_url('element/laporan_detail/' . $laporan->id_laporan) ?>">Lihat Detail</a>
                     </div>

                 </div>
             </div>

             <!-- Row -->

         <?php } ?>
     </div>
 </div>