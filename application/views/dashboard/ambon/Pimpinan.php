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
    <h3>Selamat Datang !</h3>
    <span>Selamat anda berasil login sebagai  <?php echo $level; ?> </span>
 
    <div class="row mb-3 mt-3"> 
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $ket; ?></h6>
                        </div>
                        <div class="col-md-8">
                            <input  class="form-control" type="date" name="tanggal" id="tanggal" value="<?php echo $today; ?>" style="width: 100%;">
                        </div>
                    </div>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
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
                                                                    $all_point = $all_point_ambon;
                                                                    if ($all_point < 60) {
                                                                        echo 'red';
                                                                    } elseif ($all_point >= 61 && $all_point <= 70) {
                                                                        echo 'orange';
                                                                    } elseif ($all_point >= 71 && $all_point <= 100) {
                                                                        echo 'rgb(37, 190, 48, 1)';
                                                                    }
                                                                ?>; ">
                                        <div class="row text-center">
                                            <div class="col-md-12 searchable-item">
                                                <Span style="font-size: 70px; font-weight: bold; color:white;"><?php echo $all_point_ambon; ?></Span> <span style="  color:white;">/100</span> <br>
                                                <span style="color:white; font-size: 10px;">Item (<?php echo $all_done; ?> / <?php echo $all_item; ?>)</span> <br>
                                                <span style="font-size: 30px; font-weight: bold; color:white;">Total Poin</span>
                                            </div>
                                            <?php foreach ($journey as $item) { ?>
                                            <div class="col-md-12 mb-3 searchable-item">
                                                <a href="<?= base_url('Pimpinan/index_item/' . $item->id_journey); ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                    <button style="width:95%" type="button" class="btn btn-warning"><?php echo $item->journey; ?></button>
                                                </a>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-9 ">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                <?php foreach ($journey as $item) { ?>
                                                            <?php if ($item->journey == 'Pre Journey'): ?>
                                                                <div class="col-6 col-lg-3   searchable-item">
                                                                <a href="<?= base_url('Pimpinan/index_item/' . $item->id_journey .'/' .$today); ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                                
                                                                        <div class="text-center" style="background-color: 
                                                                            <?php
                                                                                $pre_point = $pre_point_ambon;
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
                                                                                <?php echo $pre_point_ambon; ?>
                                                                            </Span>
                                                                            <span style="color:white; font-size: 12px;">/100</span> <br>
                                                                            <span style="font-weight: bold; color:white;"><?php echo $item->journey; ?></span>
                                                                            <span style="color:white; font-size: 10px;">(<?php echo $pre_done; ?> / <?php echo $pre_item; ?>)</span> <br>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            <?php elseif ($item->journey == 'Port Journey'): ?>
                                                                
                                                                <div class="col-6 col-lg-3  searchable-item">
                                                                <a href="<?= base_url('Pimpinan/index_item/' . $item->id_journey.'/' .$today); ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                                <div class="text-center" style="background-color: <?php
                                                                        $port_point = $port_point_ambon;
                                                                        if ($port_point < 60) {
                                                                            echo 'red';
                                                                        } elseif ($port_point >= 61 && $port_point <= 70) {
                                                                            echo 'orange';
                                                                        } elseif ($port_point >= 71 && $port_point <= 100) {
                                                                            echo 'rgb(37, 190, 48, 1)';
                                                                        }
                                                                    ?>; height: 100px; border-radius: 10px; padding:10px;">
                                                                        <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                                            <?php echo $port_point_ambon; ?>
                                                                        </Span>
                                                                        <span style="color:white; font-size: 12px;">/100</span> <br>
                                                                        <span style="font-weight: bold; color:white;"><?php echo $item->journey; ?></span>
                                                                        <span style="color:white; font-size: 10px;">(<?php echo $port_done; ?> / <?php echo $port_item; ?>)</span> <br>
                                                                    </div>
                                                                </a>
                                                                    
                                                                </div>
                                                            <?php elseif ($item->journey == 'On Board Journey'): ?>
                                                                <div class="col-6 col-lg-3  searchable-item">
                                                                <a href="<?= base_url('Pimpinan/index_item/' . $item->id_journey) .'/' .$today; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                                <div class="text-center" style="background-color: <?php
                                                                        $on_point = $on_point_ambon;
                                                                        if ($on_point < 60) {
                                                                            echo 'red';
                                                                        } elseif ($on_point >= 61 && $on_point <= 70) {
                                                                            echo 'orange';
                                                                        } elseif ($on_point >= 71 && $on_point <= 100) {
                                                                            echo 'rgb(37, 190, 48, 1)';
                                                                        }
                                                                    ?>; height: 100px; border-radius: 10px; padding:10px;">
                                                                        <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                                            <?php echo $on_point_ambon; ?>
                                                                        </Span>
                                                                        <span style="color:white; font-size: 12px;">/100</span> <br>
                                                                        <span style="font-weight: bold; color:white;"><?php echo $item->journey; ?></span>
                                                                        <span style="color:white; font-size: 9px;">(<?php echo $on_done; ?> / <?php echo $on_item; ?>)</span> <br>
                                                                    </div>
                                                                </a>
                                                                    
                                                                </div>
                                                            <?php elseif ($item->journey == 'Post Journey'): ?>
                                                                <div class="col-6 col-lg-3  searchable-item">
                                                                <a href="<?= base_url('Pimpinan/index_item/' . $item->id_journey) .'/' .$today; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                                <div class="text-center" style="background-color: <?php
                                                                        $post_point = $post_point_ambon;
                                                                        if ($post_point < 60) {
                                                                            echo 'red';
                                                                        } elseif ($post_point >= 61 && $post_point <= 70) {
                                                                            echo 'orange';
                                                                        } elseif ($post_point >= 71 && $post_point <= 100) {
                                                                            echo 'rgb(37, 190, 48, 1)';
                                                                        }
                                                                    ?>; height: 100px; border-radius: 10px; padding:10px;">
                                                                        <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                                            <?php echo $post_point_ambon; ?>
                                                                        </Span>
                                                                        <span style="color:white; font-size: 12px;">/100</span> <br>
                                                                        <span style="font-weight: bold; color:white;"><?php echo $item->journey; ?></span>
                                                                        <span style="color:white; font-size: 10px;">(<?php echo $post_done; ?> / <?php echo $post_item; ?>)</span> <br>
                                                                    </div>
                                                                </a>
                                                                   
                                                                </div>
                                                            <?php endif; ?>
                                                    <?php } ?>
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
                                                    $id = $this->Model_akun->getID($id_user);

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
                                                    // Mengambil data dari database menggunakan CodeIgniter Query Builder
                                                    // $this->db->select('laporan.poin_kendaraan');
                                                    $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                                                    $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                                                    $this->db->where('laporan.id_cabang', $id);
                                                    // $this->db->where('type', 'Kendaraan');
                                                    $this->db->where('laporan.tanggal >=', $startDate);
                                                    $this->db->where('laporan.tanggal <=', $endDate);
                                                    $this->db->where('laporan.status', 'setuju');
                                                    $this->db->order_by('tanggal', 'ASC');
                                                    $query = $this->db->get('laporan');


                                                    $labels = [];
                                                    $kendaraanData = [];
                                                    foreach ($query->result() as $row) {
                                                        // $labels[] = date('M d', strtotime($row->tanggal));
                                                        // $labels[] = $row->poin_kendaraan ."INI BELUM";
                                                        $labels[] = date('d M', strtotime($row->tanggal));
                                                        $kendaraanData[] = $row->poin_kendaraan;
                                                    }

                                                    $this->db->select('laporan.poin_pejalan_kaki');
                                                    $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                                                    $this->db->where('laporan.id_cabang', $id);
                                                    // $this->db->where('type', 'Pejalan Kaki');
                                                    $this->db->where('laporan.tanggal >=', $startDate);
                                                    $this->db->where('laporan.tanggal <=', $endDate);
                                                    $this->db->where('laporan.status', 'setuju');
                                                    $this->db->order_by('tanggal', 'ASC');
                                                    $query = $this->db->get('laporan');

                                                    $pejalanKakiData = [];
                                                    foreach ($query->result() as $row) {
                                                        
                                                        $pejalanKakiData[] = $row->poin_pejalan_kaki;
                                                    }
                                                    ?>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="row">
                                                    <div class="col-6 col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h6>Tanggal Awal</h6>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input class="form-control" type="date" name="date_start" id="date_start">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h6>Tanggal Akhir</h6>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input class="form-control" type="date" name="date_end" id="date_end">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-6">
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
                                                                    
                                                                    <?php if ($item_kendaraan == 0) {
                                                                            $hasil_kendaraan = 0;
                                                                        } else {
                                                                            $hasil_kendaraan = $done_kendaraan / $item_kendaraan * 100;
                                                                        } ?>
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
                                                                } ?>
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
                window.location.href = "<?php echo base_url('Pimpinan/index/'); ?>" + newDate;
            }

            // Tambahkan event listener untuk memanggil fungsi updateDateAndRedirect saat input tanggal berubah
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