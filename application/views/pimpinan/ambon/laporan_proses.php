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
     
    <!-- <div class="row mb-3">
        <div class="col-md-2">
            <div class="row">
                <div class="col-md-12">
                    <h6>Tanggal Awal</h6>
                </div>
                <div class="col-md-12">
                    <input class="form-control" type="date" name="date_start" id="date_start" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
                <div class="col-md-12">
                    <h6>Tanggal Akhir</h6>
                </div>
                <div class="col-md-12">
                   <input class="form-control" type="date" name="date_end" id="date_end" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
        </div>
    </div> -->
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
        <div class="col-md-6 searchable-item" data-date="<?php echo $item->tanggal; ?>">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $item->nama; ?></h6>
                    <button class="btn btn-warning">PROSES</button>
                </div>
                <div class="card-body">
                    <p><?php echo $item->tanggal; ?></p>
                    <span><?php echo $journey->journey; ?></span>
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
                    <span><?php echo $option ->type_option; ?></span>
                    <p>Poin : <?php echo $poin; ?></p>
                    <a class="btn btn-primary" href="<?php echo site_url('Pimpinan/laporan_detail/'.$item->id_laporan ) ?>">Lihat Detail</a>
                </div>
            </div>
        </div>

        <!-- Row -->
    <?php } ?>
</div>


 </div>

 <!-- <script>
    function filterDataByDate() {
        var dateStart = new Date(document.getElementById("date_start").value).getTime();
        var dateEnd = new Date(document.getElementById("date_end").value).getTime();
        var rows = document.getElementsByClassName("searchable-item");

        for (var i = 0; i < rows.length; i++) {
            var rowDate = new Date(rows[i].getAttribute("data-date")).getTime();
            if (rowDate >= dateStart && rowDate <= dateEnd) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    document.getElementById("date_start").addEventListener("change", filterDataByDate);
    document.getElementById("date_end").addEventListener("change", filterDataByDate);

    filterDataByDate(); // Initial filter on page load
</script> -->