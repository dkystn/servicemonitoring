 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"> Tacit Knowladge Saya </h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page"> Tacit Knowladge Saya</li>
         </ol>
     </div>

     <div class="row">
         <div class="col-lg-12 mb-4">
             <!-- Simple Tables -->
             <div class="card">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary"> Tacit Knowladge Saya</h6>
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="#myBtn">
                         + Tambah Knowladge
                     </button>
                 </div>
                 <div class="table-responsive">
                     <table class="table align-items-center table-flush">
                         <thead class="thead-light">
                             <tr>
                                 <th>No</th>
                                 <th>Judul Khowladge</th>
                                 <th>Tanggal Buat</th>
                                 <th>Keterangan</th>
                             </tr>
                         </thead>
                         <?php $no = 1; foreach ($tacit as $tacit){ ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tacit->judul_tacit; ?></td>
                                    <td><?php echo $tacit->tgl_tacit; ?></td>
                                    <td><?php echo $tacit->keterangan_tacit; ?></td>
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
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Form Tambah Khowladge</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="container">
                 <form class="user mt-2" action="<?php echo base_url().'Element/add_tacit'; ?>" method="post" >
                 <div class="container">
                  
                        <label for="nik">Judul Khowladge</label> 
                        <div class="form-group">
                            <input class="form-control" type="text" name="judul_tacit" id="judul_tacit">
                        </div>
                        <label for="nama_user">Tanggal Buat</label>
                        <div class="form-group">
                            <input class="form-control" type="date" name="tgl_tacit" id="tgl_tacit">
                        </div>
                        <label for="username">Keterangan</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="keterangan_tacit" id="keterangan_tacit">
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