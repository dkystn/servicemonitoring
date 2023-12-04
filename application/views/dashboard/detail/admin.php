<style>
    .bg-all{
        border-radius: 25px; margin-left:20px;
    }
    @media only screen and (max-width: 600px) {
        .bg-all{
        border-radius: 25px; 
        margin-left:0px;
        width:80%;
        
    }
    .bg-center{
        display: flex;
    justify-content: center;
    }
    .col-6.col-lg-3.searchable-item{
        margin-top:10px;
    }
    #lineChart{
        margin-top:10px;
    }
    }
</style>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1> 
    </div>
    <h3>Dasboard Detail Item <?php echo $nama_journey; ?></h3>
 
    <div class="row mb-3 mt-3" id="capture"> 
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="row">
                        <div class="col-10 col-md-4">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $ket; ?></h6>
                        </div>
                        <div class="col-10 col-md-8">
                            <input  class="form-control" type="date" name="tanggal" id="tanggal" value="<?php echo $today; ?>" style="width: 100%;">
                        </div>
                    </div>
                                    <div class="dropdown no-arrow">
                                    <button class="btn btn-success" id="captureBtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
  <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
</svg></button>
                                    <div id="screenshotResult"></div>
                                        <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="row bg-center">
                                    <div class="col-11 col-lg-2 text-center bg-all" style="background-color: <?php
                                                                    $all_point = $poin_journey;
                                                                    if ($all_point < 60) {
                                                                        echo 'red';
                                                                    } elseif ($all_point >= 61 && $all_point <= 70) {
                                                                        echo 'orange';
                                                                    } elseif ($all_point >= 71 && $all_point <= 100) {
                                                                        echo 'rgb(37, 190, 48, 1)';
                                                                    }
                                                                ?>; ">
                                        <div class="row text-center ">
                                            <div class="col-md-12 searchable-item">
                                                <Span style="font-size: 70px; font-weight: bold; color:white;"><?php echo $poin_journey; ?></Span> <span style="  color:white;">/100</span> <br>
                                                <span style="color:white; font-size: 10px;">Item (<?php echo $item_done; ?> / <?php echo $item; ?>)</span> <br>
                                                <span style="font-size: 15px; font-weight: bold; color:white;">Total Poin <?php echo $nama_journey; ?></span>
                                            </div>
                                            <!--  -->
                                            <?php if ($id == null): ?>
                                                <!--  -->
                                                <?php foreach ($journey as $item) { ?>
                                                            <?php
                                                                // Ambil data laporan berdasarkan nilai $item->id_type_option (atau sesuaikan dengan referensi yang benar)
                                                                $this->db->where('laporan.id_type_option', $item->id_type_option);
                                                                $this->db->where('laporan.tanggal', $today);
                                                                $this->db->where('laporan.status', 'setuju');
                                                                $query_laporan = $this->db->get('laporan');
                                                                $laporan = $query_laporan->row(); // Menggunakan row() karena hanya ingin satu baris data
                                                                // Jika $laporan tidak kosong, maka cetak nilai poin, jika kosong, cetak '0'
                                                                if ($laporan !== null) {
                                                                    $link = base_url('Admin/laporan_detail/' . $laporan->id_laporan);
                                                                } else {
                                                                    $link = '#';
                                                                    $poin = '0';
                                                                }
                                                            ?>
                                                            <div class="col-md-12 mb-3 searchable-item">
                                                            <a href="<?= $link; ?>" style="text-decoration: none; color:rgb(73, 73, 73); ">
                                                                <button style="width:95%" type="button" class="btn btn-warning">
                                                                (<?php
                                                                $cabang_data = $this->Model_soal->get_cabang_by_id($item->id_cabang);
                                                                echo $cabang_data !== null ? $cabang_data->cabang : '-';
                                                                ?>) <br><?php echo $item->type_option; ?></button>
                                                            </a>

                                                            </div>
                                                <?php } ?>
                                                <!--  -->
                                            <?php else :?>
                                                <!--  -->
                                                <?php foreach ($journey as $item) { ?>
                                                    <?php
                                                                // Ambil data laporan berdasarkan nilai $item->id_type_option (atau sesuaikan dengan referensi yang benar)
                                                                $this->db->where('laporan.id_type_option', $item->id_type_option);
                                                                $this->db->where('laporan.tanggal', $today);
                                                                $this->db->where('laporan.status', 'setuju');
                                                                $query_laporan = $this->db->get('laporan');
                                                                $laporan = $query_laporan->row(); // Menggunakan row() karena hanya ingin satu baris data
                                                                // Jika $laporan tidak kosong, maka cetak nilai poin, jika kosong, cetak '0'
                                                                if ($laporan !== null) {
                                                                    $link = base_url('Admin/laporan_detail/' . $laporan->id_laporan);
                                                                } else {
                                                                    $link = '#';
                                                                    $poin = '0';
                                                                }
                                                            ?>
                                                <div class="col-md-12 mb-3 searchable-item">
                                                <a href="<?= $link; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                    <button style="width:95%" type="button" class="btn btn-warning"><?php echo $item->type_option; ?></button>
                                                    </a>
                                                </div>
                                                <?php } ?>
                                                 <!--  -->
                                            <?php endif; ?>
                                            <!--  -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-9 ">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <!--  -->
                                                    <?php if ($id == null): ?>
                                                        <!--  -->
                                                        <?php foreach ($journey as $item) { ?>
                                                        <div class="col-6 col-lg-3  mt-3 searchable-item">
                                                        
                                                            <?php
                                                                // Ambil data laporan berdasarkan nilai $item->id_type_option (atau sesuaikan dengan referensi yang benar)
                                                                $this->db->where('laporan.id_type_option', $item->id_type_option);
                                                                $this->db->where('laporan.tanggal', $today);
                                                                $this->db->where('laporan.status', 'setuju');
                                                                $query_laporan = $this->db->get('laporan');
                                                                $laporan = $query_laporan->row(); // Menggunakan row() karena hanya ingin satu baris data
                                                                // Jika $laporan tidak kosong, maka cetak nilai poin, jika kosong, cetak '0'
                                                                if ($laporan !== null) {
                                                                    $link = base_url('Admin/laporan_detail/' . $laporan->id_laporan);
                                                                } else {
                                                                    $link = '#';
                                                                    $poin = '0';
                                                                }
                                                            ?>
                                                                    <a href="<?= $link; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                                        <div class="text-center" style="background-color: 
                                                                            <?php
                                                                                $pre_point = ($laporan) ? $laporan->poin : '0';
                                                                                if ($pre_point < 60) {
                                                                                    echo 'red';
                                                                                } elseif ($pre_point >= 61 && $pre_point <= 70) {
                                                                                    echo 'orange';
                                                                                } elseif ($pre_point >= 71 && $pre_point <= 100) {
                                                                                    echo 'rgb(37, 190, 48, 1)';
                                                                                }
                                                                            ?>
                                                                            ; height: 100%; border-radius: 10px; padding:10px;">
                                                                            <span style="font-weight: bold; color:white;">(
                                                                            <?php
                                                                            $cabang_data = $this->Model_soal->get_cabang_by_id($item->id_cabang);
                                                                            echo $cabang_data !== null ? $cabang_data->cabang : '-';
                                                                            ?>
                                                                            )</span><br>
                                                                            <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                                                <?php echo ($laporan) ? $laporan->poin : '0'; ?>
                                                                            </Span>
                                                                            <span style="color:white; font-size: 12px;">/100</span> <br>
                                                                            <span style="font-weight: bold; color:white;"><?php echo $item->type_option; ?></span>
                                                                        </div>
                                                                    </a>
                                                        </div>
                                                    <?php } ?>
                                                        <!--  -->
                                                    <?php else :?>
                                                        <!--  -->
                                                        <?php foreach ($journey as $item) { ?>
                                                        <div class="col-6 col-lg-3 mt-3  searchable-item">
                                                            <?php
                                                                // Ambil data laporan berdasarkan nilai $item->id_type_option (atau sesuaikan dengan referensi yang benar)
                                                                $this->db->where('laporan.id_type_option', $item->id_type_option);
                                                                $this->db->where('laporan.tanggal', $today);
                                                                $this->db->where('laporan.status', 'setuju');
                                                                $query_laporan = $this->db->get('laporan');
                                                                $laporan = $query_laporan->row(); // Menggunakan row() karena hanya ingin satu baris data
                                                                // Jika $laporan tidak kosong, maka cetak nilai poin, jika kosong, cetak '0'
                                                                if ($laporan !== null) {
                                                                    $link = base_url('Admin/laporan_detail/' . $laporan->id_laporan);
                                                                } else {
                                                                    $link = '#';
                                                                    $poin = '0';
                                                                }
                                                            ?>
                                                                <a href="<?= $link; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                                        <div class="text-center" style="background-color: 
                                                                            <?php
                                                                                $pre_point = ($laporan) ? $laporan->poin : '0';
                                                                                if ($pre_point < 60) {
                                                                                    echo 'red';
                                                                                } elseif ($pre_point >= 61 && $pre_point <= 70) {
                                                                                    echo 'orange';
                                                                                } elseif ($pre_point >= 71 && $pre_point <= 100) {
                                                                                    echo 'rgb(37, 190, 48, 1)';
                                                                                }
                                                                            ?>
                                                                            ; height: 100px; border-radius: 10px; padding:10px;">
                                                                            <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                                                <?php echo ($laporan) ? $laporan->poin : '0'; ?>
                                                                            </Span>
                                                                            <span style="color:white; font-size: 12px;">/100</span> <br>
                                                                            <span style="font-weight: bold; color:white;"><?php echo $item->type_option; ?></span>
                                                                        </div>
                                                                        </a>
                                                        </div>
                                                    <?php } ?>
                                                        <!--  -->
                                                    <?php endif; ?>
                                                    <!--  -->
                                                    
                                                </div>
                                            </div>
                                           
                                            <div class="col-12 col-lg-12 searchable-item">
                                                <canvas id="lineChart"></canvas>
                                                <?php
                                                // Mendapatkan tanggal saat ini
                                                $currentDate = date('Y-m-d');
                                                $id_user = $this->session->userdata('id_user');
                                                $user = $this->Model_akun->getCabangByID($id_user);
                                                $cabang = $user;

                                                // Mendapatkan tanggal awal dan akhir dari parameter query string (jika ada)
                                                if (isset($_GET['start']) && isset($_GET['end'])) {
                                                    $startDate = $_GET['start'];
                                                    $endDate = $_GET['end'];
                                                } else {
                                                    // Jika tanggal awal dan akhir tidak diberikan, gunakan rentang default 6 bulan yang lalu
                                                    $defaultBulan = 6;
                                                    $startDate = date('Y-m-d', strtotime('-' . $defaultBulan . ' months', strtotime($currentDate)));
                                                    $endDate = $currentDate;
                                                }

                                                if ($id == null) {
                                                    $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                                                    $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                                                    $this->db->where('laporan.tanggal >=', $startDate);
                                                    $this->db->where('laporan.tanggal <=', $endDate);
                                                    $this->db->where('laporan.status', 'setuju');
                                                    $this->db->order_by('tanggal', 'ASC');
                                                    $query = $this->db->get('laporan');
                                                } else {
                                                    $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                                                    $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                                                    $this->db->where('laporan.id_cabang', $id);
                                                    $this->db->where('laporan.tanggal >=', $startDate);
                                                    $this->db->where('laporan.tanggal <=', $endDate);
                                                    $this->db->where('laporan.status', 'setuju');
                                                    $this->db->order_by('tanggal', 'ASC');
                                                    $query = $this->db->get('laporan');
                                                }

                                                $labels = [];
                                                $kendaraanData = [];
                                                $pejalanKakiData = [];
                                                foreach ($query->result() as $row) {
                                                    $labels[] = date('d M', strtotime($row->tanggal));
                                                    $dataAttributes[] = $row->id_laporan;

                                                    $kendaraanData[] = $row->poin_kendaraan;
                                                    $pejalanKakiData[] = $row->poin_pejalan_kaki;
                                                }
                                                ?>

                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="row">
                                                    <div class="col-6 col-lg-3">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <h6>Tanggal Awal</h6>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <input class="form-control" type="date" name="date_start" id="date_start">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-lg-3">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <h6>Tanggal Akhir</h6>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <input class="form-control" type="date" name="date_end" id="date_end">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label>Default</label>
                                                        <div class="form-group">
                                                            <button class="btn btn-info" name="bulan" id="resetButton">
                                                                Default 6 Bulan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-5 col-lg-5 searchable-item">
                                                                <div class="row">
                                                                <?php
                                                                        if ($item_kendaraan == 0) {
                                                                            $hasil_kendaraan = 0;
                                                                        } else {
                                                                            $hasil_kendaraan = $done_kendaraan / $item_kendaraan * 100;
                                                                        }
                                                                        ?>
                                                                
                                                                    <div class="col-md-12">
                                                                        <canvas id="myChart"></canvas>
                                                                    </div>
                                                                    <div class="col-md-12 text-center mt-3">
                                                                        <span style="font-size:20px;"><?php
                                                                        $roundedPercentage = round($hasil_kendaraan); // Membulatkan nilai
                                                                        echo $roundedPercentage; // Mencetak nilai yang telah dibulatkan
                                                                        ?>%</span>
                                                                        <span style="font-size:10px;">(<?php echo $done_kendaraan; ?>/<?php echo $item_kendaraan; ?>)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-7 col-lg-7 searchable-item">
                                                                <canvas id="barChart1"  width="900" height="700"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-5 col-lg-5 searchable-item">
                                                                <div class="row">
                                                                <?php
                                                                        if ($item_pejalankaki == 0) {
                                                                            $hasil_pejalankaki = 0;
                                                                        } else {
                                                                            $hasil_pejalankaki = $done_pejalankaki / $item_pejalankaki * 100;
                                                                        }
                                                                        ?>
                                                                    <div class="col-md-12">
                                                                        <canvas id="myChart2"></canvas>
                                                                    </div>
                                                                    <div class="col-md-12 text-center mt-3">
                                                                        <span style="font-size:20px;"><?php
                                                                        $roundedPercentage = round($hasil_pejalankaki); // Membulatkan nilai
                                                                        echo $roundedPercentage; // Mencetak nilai yang telah dibulatkan
                                                                        ?>%</span>
                                                                        <span style="font-size:10px;">(<?php echo $done_pejalankaki; ?>/<?php echo $item_pejalankaki; ?>)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-7 col-lg-7 searchable-item">
                                                                <canvas id="barChart2"  width="900" height="700"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 mt-4 mb-4 ">
                                                <button class="btn btn-warning">weekly</button>
                                                <button class="btn btn-warning">monthly</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                
            </div>
        </div>
        <!---Container Fluid-->
        <script>
    // Cari elemen tanggal awal dan akhir berdasarkan ID
    const dateStartInput = document.getElementById('date_start');
    const dateEndInput = document.getElementById('date_end');

    // Tambahkan event listener untuk mendeteksi perubahan nilai tanggal awal dan akhir
    dateStartInput.addEventListener('change', updateDateRange);
    dateEndInput.addEventListener('change', updateDateRange);

    function updateDateRange() {
        const startDate = dateStartInput.value;
        const endDate = dateEndInput.value;

        if (startDate !== '' && endDate !== '') {
            const baseUrl = window.location.href.split('?')[0]; // Dapatkan URL dasar tanpa query string
            const newUrl = `${baseUrl}?start=${startDate}&end=${endDate}`;
            window.location.href = newUrl;
        }
    }

    // Set tanggal awal dan akhir secara otomatis sesuai nilai dari parameter query string (jika ada)
    const urlParams = new URLSearchParams(window.location.search);
    const startDateParam = urlParams.get('start');
    const endDateParam = urlParams.get('end');
    if (startDateParam !== null && endDateParam !== null) {
        dateStartInput.value = startDateParam;
        dateEndInput.value = endDateParam;
    }

    const resetButton = document.getElementById('resetButton');

    // Tambahkan event listener untuk menghapus parameter query string saat tombol diklik
    resetButton.addEventListener('click', function () {
        const baseUrl = window.location.href.split('?')[0]; // Dapatkan URL dasar tanpa query string
        window.location.href = baseUrl; // Arahkan ke URL dasar tanpa query string
    });
</script>


        <script>
            // Fungsi untuk mendapatkan tanggal terbaru dan mengalihkan ke halaman index
            function updateDateAndRedirect() {
                var newDate = document.getElementById("tanggal").value;
                var journey = "<?php echo $id_journey ?>";
                var nama_journey = "<?php echo $nama_journey ?>";
                var cabang_id = "<?php echo $id ?>"; // Tambahkan tanda kutip di sini
                // var encodedJourney = encodeURIComponent(nama_journey);
                var baseUrl = "<?php echo base_url('Admin/index_item/'); ?>";
                var url; 

                if (cabang_id === "" ) {
                    url = baseUrl + nama_journey + "/" + newDate;
                } else {
                    url = baseUrl + journey + "/" + newDate + "/" + cabang_id;
                }
                window.location.href = url;
            }

            // Pastikan event listener ditambahkan setelah elemen "tanggal" ada dalam DOM
            document.getElementById("tanggal").addEventListener("change", updateDateAndRedirect);

        </script>


        <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var donutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Kendaraan'],
                datasets: [{
                    data: [<?php echo $hasil_kendaraan; ?>, <?php echo (100 - $hasil_kendaraan); ?>],
                    backgroundColor: ['#FF6384', '#8181813d']
                }]
            },
            options: {
                cutoutPercentage: 50,
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Donut Chart'
                }
            }
        });

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var donutChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Pejalan Kaki'],
                datasets: [{
                    data: [<?php echo $hasil_pejalankaki; ?>, <?php echo (100 - $hasil_pejalankaki); ?>],
                    backgroundColor: ['#36A2EB', '#8181813d']
                }]
            },
            options: {
                cutoutPercentage: 50,
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Donut Chart'
                }
            }
        });
    </script> 
    <script>
    var data = {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [
            {
                label: 'Kendaraan',
                data: <?php echo json_encode($kendaraanData); ?>,
                borderColor: 'red',
                fill: false
            },
            {
                label: 'Pejalan Kaki',
                data: <?php echo json_encode($pejalanKakiData); ?>,
                borderColor: 'blue',
                fill: false
            }
        ]
    };

    // Membuat line chart
    var ctx = document.getElementById('lineChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("barChart1").getContext('2d');
            var chartData = <?php echo $chart_data; ?>;
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: chartData,
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
        var ctx2 = document.getElementById("barChart2").getContext('2d');
        var chartData2 = <?php echo $chart_data_pejalan; ?>;
        var myChart2 = new Chart(ctx2, {
            type: 'horizontalBar',
            data: chartData2,
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });

    </script>
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="path-to-html2canvas/html2canvas.min.js"></script>


    <script>
        $(document).ready(function() {
        $('#captureBtn').click(function() {
            $('#screenshotResult').empty(); // Clear previous result

            var element = document.getElementById('capture');
            
            html2canvas(element, { useCORS: true }).then(function(canvas) {
                var screenshotData = canvas.toDataURL('image/jpeg', 0.9);

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url("admin/capture"); ?>',
                    data: { screenshot: screenshotData },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            var downloadLink = '<a href="<?php echo base_url("uploads_ss/"); ?>' + response.pdf_filename + '" download style="color:white; text-decoration: none;">Download</a>';
                            $('#screenshotResult').html('<button class="btn btn-danger mt-2">' + downloadLink + '</button>');
                            $('#captureBtn').hide(); // Hide capture button after success

                            // Show capture button again after download
                            $('#screenshotResult a').click(function() {
                                $('#captureBtn').show();
                                $('#screenshotResult').empty(); // Clear result
                            });
                        } else {
                            $('#screenshotResult').html('<p>Error capturing screenshot.</p>');
                        }
                    }
                });
            });
        });
    });

        
    </script>