 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Data Laporan</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Data Laporan</li>
             <li class="breadcrumb-item active" aria-current="page">Laporan Proses ACC</li>
         </ol>
     </div>
     <div class="row">

            <?php
                $combinedData = array(); // Array untuk menyimpan data yang digabungkan
                
                // Loop pertama untuk menggabungkan data
                foreach ($laporan as $item) {
                    $key = $item->id_type_option . '-' . $item->tanggal; // Buat kunci dengan menggabungkan id_type_option dan tanggal
                    if (isset($combinedData[$key])) {
                        $combinedData[$key]->jumlah_data++;
                        // Jika kunci sudah ada, tambahkan nilai poin ke data yang sudah ada
                        $combinedData[$key]->poin += $item->poin;
                    } else {
                        // Jika kunci belum ada, tambahkan data ke array
                        $item->jumlah_data = 1;
                        $combinedData[$key] = $item;
                    }
                }
                usort($combinedData, function($a, $b) {
                    return strtotime($b->tanggal) - strtotime($a->tanggal);
                });
                // Loop kedua untuk mencetak hasil
                foreach ($combinedData as $item) {
                    $id_journey = $item->id_journey;
                    $id_type_option = $item->id_type_option;
                    $id_kapal = $item->id_kapal;
                    $id_pelabuhan = $item->id_pelabuhan;

                    // Ambil data "journey" berdasarkan id_journey
                    $journey = $this->Model_laporan->journey($id_journey);
                    $option = $this->Model_laporan->option($id_type_option);
                    $kapal = $this->Model_laporan->kapal($id_kapal);
                    $pelabuhan = $this->Model_laporan->pelabuhan($id_pelabuhan);

                    $poin = $item->poin  ;
            ?>
        <!-- Row -->
     <div class="col-md-6 searchable-item">

            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $item->nama; ?></h6>
                    <button class="btn btn-warning">PROSES</button>
                </div>
                <div class="card-body">
                    <p><?php echo $item->tanggal; ?></p>
                    <?php echo $journey->journey; ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                    <span style="display:<?php echo ($kapal == null) ? 'none' : 'inline'; ?>"><?php echo $kapal->kapal; ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" style="display:<?php echo ($kapal == null) ? 'none' : 'inline'; ?>">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                    <span style="display:<?php echo ($pelabuhan == null) ? 'none' : 'inline'; ?>"><?php echo $pelabuhan->pelabuhan; ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" style="display:<?php echo ($pelabuhan == null) ? 'none' : 'inline'; ?>">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                    <span><?php echo $option->type_option; ?></span>
                    <p>Poin : <?php echo $poin; ?></p>
                         <a class="btn btn-success" href="#" onclick="showConfirmation()">Verifikasi</a>
                        <button class="btn btn-danger " data-toggle="modal" data-target="#exampleModal<?php echo $item->id_laporan; ?>" id="#myBtn" >Tolak</button>
                        <a class="btn btn-primary" href="<?php echo site_url('Pimpinan/laporan_detail/'.$item->id_laporan ) ?>">Lihat Detail</a>
                </div>
            </div>
        </div>

     <!-- Modal -->
     <div class="modal fade" id="exampleModal<?php echo $item->id_laporan; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Form Catatan </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                   <form id="myform" class="user mt-2" action="<?php echo base_url('pimpinan/update_laporan_tolak/'.$item->id_laporan); ?>" method="post" >
                 <div class="container">
                        <label for="catatan">Catatan</label> 
                        <div class="form-group text-center">
                            <textarea name="catatan" id="catatan" style="width: 80%;" rows="10"></textarea>
                        </div>
                 </div>
                 
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" onclick="confirmSubmit(event)" class="btn btn-primary">Tambah</button>
                 </div>

                </form>
             </div>
         </div>
     </div>
 <!-- </div> -->
 <?php } ?>
 </div>
 </div>
 <script>
    function showConfirmation() {
    swal({
        title: "Konfirmasi",
        text: "Anda yakin ingin memverifikasi laporan ini?",
        icon: "warning",
        buttons: ["Batal", "Verifikasi"],
        dangerMode: true,
    })
    .then((willActivate) => {
        if (willActivate) {
        activateLaporan();
        } else {
        // Tidak melakukan apa pun jika dibatalkan
        }
    });
    }

    function activateLaporan() {
    swal("Terimakasih!", "Permintaan aktivasi laporan telah terkirim.", "success");
    window.location.href = "<?php echo base_url('pimpinan/update_laporan_aktif/'.$item->id_laporan); ?>";
    }
</script>
<script>
  function confirmSubmit(event) {
            event.preventDefault(); // Mencegah aksi default pengiriman form

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin Menolak Laporan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengirim form jika pengguna yakin
                    event.target.form.submit();
                }
            });
        }
</script>