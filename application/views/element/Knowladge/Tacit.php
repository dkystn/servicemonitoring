<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Tacit Knowladge</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Knowladge</li>
            <li class="breadcrumb-item active" aria-current="page">Tacit</li>
        </ol>
    </div>
    <?php foreach ($tacit as $tacit) { ?>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-6">
            <!-- Popover basic -->
            <div class="card mb-4">
            
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $tacit->judul_tacit; ?></h6>
                </div>
                <div class="card-body">
                    <p><?php echo $tacit->keterangan_tacit; ?></p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="#myBtn">
                         Lihat Selengkapnya
                     </button>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Row-->
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
                     <p> <?php echo $tacit->judul_tacit; ?></p>
                 </div>
                 <div class="modal-body">
                    <span>Keterangan</span>
                     <p> <?php echo $tacit->keterangan_tacit; ?></p>
                 </div>
                 <div class="modal-body">
                    <span>Tanggal</span>
                     <p> <?php echo $tacit->tgl_tacit; ?></p>
                 </div>
                 
             </div>
         </div>
     </div>
     <?php } ?>
</div>
<!---Container Fluid-->
