 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"> Laporan</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item active" aria-current="page"> Laporan Masalah</li>
         </ol>
     </div>

     <div class="row">
         <div class="col-lg-12 mb-4">
             <!-- Simple Tables -->
             <div class="card">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary"> Laporan</h6>
                 </div>
                 <form id="form_id" action="<?= base_url('pegawai/laporan_update') ?>" method="post" enctype="multipart/form-data">
                 <div class="container ">
                     <div class="row">
                        <div class="col-md-12 mb-3">
                             <span>Nama</span>
                         </div>
                         <div class="col-md-12 mb-3">
                             <input class="form-control" type="text" name="nama" id="nama" placeholder="Isi Nama Pelapor">
                         </div>
                         <div class="col-md-12  mb-3">
                             <span>Tanggal</span>
                         </div>
                         <div class="col-md-12  mb-3"> 
                            <input class="form-control" type="date" name="tanggal" id="tanggal" >
                            </div>
                        <div class="col-md-12">
                             <label for="regional">Regional</label>
                             <div class="form-group">
                                 <select class="form-control" name="regional" id="regional" disabled>
                                    <option value="0">Select Regional</option>
                                     <?php foreach ($regional as $row) { ?>
                                        <option value="<?php echo $row->id_regional; ?>" >Regional <?php echo $row->id_regional; ?></option>
                                    <?php } ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <label for="cabang">Cabang</label>
                             <div class="form-group">
                                 <select class="form-control" name="cabang"  >
                                    <option value="0">Select Cabang</option>
                                 </select>
                             </div>
                         </div>
                        <!-- Type Journey -->
                        <div id="type_journey" class="col-md-12">
                            <label for="type_journey">Type Journey</label>
                            <div class="form-group">
                                <select class="form-control" name="type_journey" onchange="showSubmenu()">
                                    <option value="0">Select Type Journey</option>
                                    
                                </select>
                            </div>
                        </div>
                        <input type="text" id="id_journey" name="id_journey" style="display:none">

                        <!-- Pelabuhan -->
                        <div id="pelabuhan" class="col-md-12" style="display:none">
                            <label for="pelabuhan">Pelabuhan</label>
                            <div class="form-group">
                                <select class="form-control" name="pelabuhan" >
                                    <option value="0">Select Pelabuhan</option>
                                   
                                </select>
                            </div>
                        </div>
                        
                        <!-- Kapal -->
                        <div id="kapal" class="col-md-12" style="display:none">
                            <label for="kapal">Kapal</label>
                            <div class="form-group">
                                <select class="form-control" name="kapal" >
                                    <option value="0">Select Kapal</option>
                                    <?php foreach ($kapal as $row) { ?>
                                        <option value="<?php echo $row->id_kapal; ?>"><?php echo $row->kapal; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- Type Journey Option -->
                        <div id="type_option" class="col-md-12" style="display:none">
                            <label for="type_option">Type Journey Option</label>
                            <div class="form-group">
                                <select class="form-control" name="type_option" >
                                    <option value="0">Select Type Journey Option</option>
                                </select>
                            </div>
                        </div>
                        <!--  -->
                        <!-- Type Journey Option -->
                        <div id="type_option2" class="col-md-12" style="display:none">
                            <label for="type_option2">Type Journey Option</label>
                            <div class="form-group">
                                <select class="form-control" name="type_option2" >
                                    <option value="0">Select Type Journey Option </option>
                                </select>
                            </div>
                        </div>
                        <!--  -->
                        <!-- Type Journey Option -->
                        <div id="type_option3" class="col-md-12" style="display:none">
                            <label for="type_option3">Type Journey Option 3</label>
                            <div class="form-group">
                                <select class="form-control" name="type_option3" >
                                    <option value="0">Select Type Journey Option</option>
                                </select>
                            </div>
                        </div>
                        <!--  -->
                        <!-- Type Journey Option -->
                        <div id="type_option4" class="col-md-12" style="display:none">
                            <label for="type_option4">Type Journey Option</label>
                            <div class="form-group">
                                <select class="form-control" name="type_option4" >
                                    <option value="0">Select Type Journey Option</option>
                                </select>
                            </div>
                        </div>
                        <div id="result" class="col-md-12" style="font-size: 15px;"></div>
                        <!--  -->
                     </div>
                 </div>
                 
                 <div id="response-message"></div>
                 <div class="container">
                     <div class="row">
                         <div class="col-md-12 text-center mt-4 mb-4">
                         <button type="submit" class="btn btn-primary" onclick="confirmSubmit(event)">Submit</button>
                         </div>
                     </div>
                 </div>
                 </form>
             </div>
         </div>
     </div>
     <!--Row-->
 </div>
 
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function confirmSubmit(event, params) {
            
        }
        document.getElementById("form_id").addEventListener("submit", function(event) {
            event.preventDefault(); 
            
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin melanjutkan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Sukses', 'Tipe Confirmation dipilih atau tidak semua form memilih Required!', 'success');
                    
                    event.target.submit();
                    // Lakukan tindakan yang sesuai untuk tipe "confirmation" atau kombinasi tipe "required" dan "confirmation" di sini
                }
                });
            });
</script>

