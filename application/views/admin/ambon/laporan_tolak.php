 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Laporan Ditolak</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Data Laporan</li>
             <li class="breadcrumb-item active" aria-current="page"> Kelola Laporan Ditolak</li>
         </ol>
     </div>

     <div class="row">
         <div class="col-lg-12 mb-4">
            <div class="row mb-3">
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
             </div>
             <!-- Simple Tables -->
             <div class="card">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Laporan Status Ditolak</h6>
                 </div>
                 
                 <div class="table-responsive" >
                     <table class="table align-items-center table-flush" id="table">
                         <thead class="thead-light">
                             <tr class="text-center">
                                    <th class="text-nowrap">No</th>
                                    <th class="text-nowrap">Nama</th>
                                    <th class="text-nowrap">Tanggal</th>
                                    <th class="text-nowrap">Poin</th>
                                    <th class="text-nowrap">Poin Kendaraan</th>
                                    <th class="text-nowrap">Poin Pejalan Kaki</th>
                                    <th class="text-nowrap">Cabang</th>
                                    <th class="text-nowrap">Detail</th>
                                 <th class="text-center" colspan="2">Aksi</th>
                             </tr>
                         </thead>
                         <tbody >
                            <?php $no = 1; 
                            $laporan = array_reverse($laporan);
                            foreach ($laporan as $d){ ?>
                                <tr class="searchable-item">
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td><?php echo $d->nama; ?></td>
                                    <td class="text-center" data-date="<?php echo $d->tanggal; ?>" ><?php echo $d->tanggal; ?></td>
                                    <td class="text-center" style="color: <?php
                                                                    $all_point = $d->poin;
                                                                    if ($all_point < 60) {
                                                                        echo 'red';
                                                                    } elseif ($all_point >= 61 && $all_point <= 70) {
                                                                        echo 'orange';
                                                                    } elseif ($all_point >= 71 && $all_point <= 100) {
                                                                        echo 'rgb(37, 190, 48, 1)';
                                                                    }
                                                                ?>; font-weight: bold; " ><?php echo $d->poin; ?></td>
                                    <td class="text-center" style="color: <?php
                                                                    $all_point = $d->poin_kendaraan;
                                                                    if ($all_point < 60) {
                                                                        echo 'red';
                                                                    } elseif ($all_point >= 61 && $all_point <= 70) {
                                                                        echo 'orange';
                                                                    } elseif ($all_point >= 71 && $all_point <= 100) {
                                                                        echo 'rgb(37, 190, 48, 1)';
                                                                    }
                                                                ?>; font-weight: bold; " ><?php echo $d->poin_kendaraan; ?></td>
                                    <td class="text-center" style="color: <?php
                                                                    $all_point = $d->poin_pejalan_kaki;
                                                                    if ($all_point < 60) {
                                                                        echo 'red';
                                                                    } elseif ($all_point >= 61 && $all_point <= 70) {
                                                                        echo 'orange';
                                                                    } elseif ($all_point >= 71 && $all_point <= 100) {
                                                                        echo 'rgb(37, 190, 48, 1)';
                                                                    }
                                                                ?>; font-weight: bold; " ><?php echo $d->poin_pejalan_kaki; ?></td>
                                    <td><?php
                                        $cabang_data = $this->Model_soal->get_cabang_by_id($d->id_cabang);
                                        echo $cabang_data !== null ? $cabang_data->cabang : '-';
                                        ?></td>
                                    <td><span><?php
                                        $journey_data = $this->Model_soal->get_journey_by_id($d->id_journey);
                                        echo $journey_data !== null ? $journey_data->journey : '-';
                                        ?></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                        </svg>
                                        <span style="display:<?php echo ($d->id_kapal == null) ? 'none' : 'inline'; ?>">
                                            <?php
                                            $kapal_data = $this->Model_soal->get_kapal_by_id($d->id_kapal);
                                            echo $kapal_data !== null ? $kapal_data->kapal : '-';
                                            ?>
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" style="display:<?php echo ($d->id_kapal == null) ? 'none' : 'inline'; ?>">
                                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                        </svg>
                                        <span style="display:<?php echo ($d->id_pelabuhan == null) ? 'none' : 'inline'; ?>">
                                            <?php
                                            $pelabuhan_data = $this->Model_soal->get_pelabuhan_by_id($d->id_pelabuhan);
                                            echo $pelabuhan_data !== null ? $pelabuhan_data->pelabuhan : '-'; // Assuming "nama_pelabuhan" is the column name in the "tabel_pelabuhan" table that you want to display
                                            ?>
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" style="display:<?php echo ($d->id_pelabuhan == null) ? 'none' : 'inline'; ?>">
                                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                        </svg>
                                        <span><?php
                                        $type_option_data = $this->Model_soal->get_type_option_by_id($d->id_type_option);
                                        echo $type_option_data !== null ? $type_option_data->type_option : '-';
                                        ?></span></td>
                                    <td>
                                        <div class="text-center">
                                            <a  class="btn btn-primary" href="<?php echo site_url('Admin/laporan_detail/'.$d->id_laporan ); ?>">
                                            Detail 
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
     </div>
     <!--Row-->
     <div class="card-footer"></div>
     <script>
    // Fungsi untuk menyaring data laporan berdasarkan tanggal
    function filterDataByDate() {
        var dateStart = document.getElementById("date_start").value;
        var dateEnd = document.getElementById("date_end").value;
        var rows = document.getElementsByClassName("searchable-item");

        for (var i = 0; i < rows.length; i++) {
            var rowDate = rows[i].querySelector(".text-center[data-date]").getAttribute("data-date");
            rows[i].style.display = (rowDate >= dateStart && rowDate <= dateEnd) ? "" : "none";
        }
    }

    // Inisialisasi event listener untuk perubahan tanggal
    document.getElementById("date_start").addEventListener("change", filterDataByDate);
    document.getElementById("date_end").addEventListener("change", filterDataByDate);

    // Panggil fungsi filterDataByDate saat halaman pertama kali dimuat
    filterDataByDate();
</script>
     