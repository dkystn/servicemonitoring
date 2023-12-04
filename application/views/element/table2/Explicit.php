 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"> Explicit Knowladge Saya</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page"> Explicit Knowladge Saya</li>
         </ol>
     </div> 

     <div class="row">
         <div class="col-lg-12 mb-4">
             <!-- Simple Tables -->
             <div class="card">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary"> Explicit Knowladge Sayas</h6>
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
                                 <th>file</th>
                             </tr>
                         </thead>
                         <tbody>
                         <?php $no = 1; foreach ($explicit as $explicit){ ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $explicit->judul_explicit; ?></td>
                                    <td><?php echo $explicit->tgl_explicit; ?></td>
                                    <td><?php echo $explicit->keterangan_explicit; ?></td> 
                                    <td><?php echo $explicit->gambar; ?></td>
                            <?php } ?>
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
                 <form class="user mt-2" action="<?php echo site_url('Element/add_explicit'); ?>"  method="post" enctype="multipart/form-data" >
                 <div class="container">
                  
                        <label for="nik">Judul Khowladge</label> 
                        <div class="form-group">
                            <input class="form-control" type="text" name="judul_explicit" id="judul_explicit" required="">
                        </div>
                        <label for="nama_user">Tanggal Buat</label>
                        <div class="form-group">
                            <input class="form-control" type="date" name="tgl_explicit" id="tgl_explicit" required="">
                        </div>
                        <label for="keterangan">Keterangan</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="keterangan_explicit" id="keterangan_explicit" required="">
                        </div>
                        <label for="status">Status User</label>
                        <div class="form-group">
                            <select class="form-control" name="status">
                                <option value="" selected>OFF</option>
                            </select>
                        </div>
                        <label for="gambar">Gambar</label>
                        <div class="form-group">
                            <input class="form-control" type="file" name="gambar" id="gambar" size="20" required="">
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