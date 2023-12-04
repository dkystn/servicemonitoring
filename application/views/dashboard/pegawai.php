<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>
    <h3>Selamat Datang !</h3>
    <span>Selamat anda berasil login sebagai Pegawai </span>

    <div class="row mb-3 mt-3">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="row">
                                    <div class="col-md-2  text-center" style="background-color: #7784ec; border-radius: 25px; margin-left:20px;">
                                        <div class="row text-center">
                                            <div class="col-md-12">
                                                <Span style="font-size: 70px; font-weight: bold; color:white;"><?php echo $all_point_ambon; ?></Span> <br>
                                                <span style="font-size: 30px; font-weight: bold; color:white;">Total Poin </span>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                            <button style="width:95%" type="button" class="btn btn-warning">Pre Journey</button>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                            <button style="width:95%" type="button" class="btn btn-warning">Port Journey</button>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                            <button style="width:95% font-size: 10px;" type="button" class="btn btn-warning">On Board Journey</button>
                                            </div>
                                            <div class="col-md-12 mt-3 ">
                                            <button style="width:95%" type="button" class="btn btn-warning">Post Journey</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9 ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3" >
                                                        <div class="text-center" style="background-color: aqua; height: 100px; border-radius: 10px; padding:10px;">
                                                            <Span style="font-size: 40px; font-weight: bold; color:rgb(73, 73, 73);"> <?php echo $pre_point_ambon; ?></Span> <br>
                                                            <span style="font-weight: bold;">Pre Journey</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" >
                                                        <div class="text-center" style="background-color: aquamarine; height: 100px; border-radius: 10px; padding:10px;">
                                                        <Span style="font-size: 40px; font-weight: bold; color:rgb(73, 73, 73);"><?php echo $port_point_ambon; ?></Span> <br>
                                                            <span style="font-weight: bold;">Port Journey</span></div>
                                                    </div>
                                                    <div class="col-md-3" >
                                                        <div class="text-center" style="background-color: aqua; height: 100px; border-radius: 10px; padding:10px;">
                                                        <Span style="font-size: 40px; font-weight: bold; color:rgb(73, 73, 73);"><?php echo $on_point_ambon; ?></Span> <br>
                                                            <span style="font-weight: bold;">On Board Journey</span></div>
                                                    </div>
                                                    <div class="col-md-3" >
                                                        <div class="text-center" style="background-color: aquamarine; height: 100px; border-radius: 10px; padding:10px;">
                                                        <Span style="font-size: 40px; font-weight: bold; color:rgb(73, 73, 73);"><?php echo $post_point_ambon; ?></Span> <br>
                                                            <span style="font-weight: bold;">Post Journey</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <canvas id="lineChart"></canvas>
                                                    <?php
                                                    // Mendapatkan tanggal saat ini
                                                    $currentDate = date('Y-m-d');

                                                    // Menghitung tanggal 6 bulan yang lalu
                                                    $sixMonthsAgo = date('Y-m-d', strtotime('-6 months', strtotime($currentDate)));

                                                    // Mengambil data dari database menggunakan CodeIgniter Query Builder
                                                    $this->db->select('poin, tanggal');
                                                    $this->db->where('type', 'Kendaraan');
                                                    $this->db->where('cabang', 'AMBON');
                                                    $this->db->where('status', 'setuju');
                                                    $this->db->where('tanggal >=', $sixMonthsAgo);
                                                    $this->db->order_by('tanggal', 'ASC');
                                                    $query = $this->db->get('laporan');

                                                    $labels = [];
                                                    $kendaraanData = [];
                                                    foreach ($query->result() as $row) {
                                                        $labels[] = date('M d', strtotime($row->tanggal));
                                                        $kendaraanData[] = $row->poin;
                                                    }

                                                    $this->db->select('poin, tanggal');
                                                    $this->db->where('type', 'Pejalan Kaki');
                                                    $this->db->where('cabang', 'AMBON');
                                                    $this->db->where('status', 'setuju');
                                                    $this->db->where('tanggal >=', $sixMonthsAgo);
                                                    $this->db->order_by('tanggal', 'ASC');
                                                    $query = $this->db->get('laporan');

                                                    $pejalanKakiData = [];
                                                    foreach ($query->result() as $row) {
                                                        $pejalanKakiData[] = $row->poin;
                                                    }
                                                    ?>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                            <canvas id="myChart"></canvas>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <canvas id="barChart1"  width="900" height="700"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <canvas id="myChart2"></canvas>
                                                            </div>
                                                            <div class="col-md-7">
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
        var ctx = document.getElementById('myChart').getContext('2d');
        var donutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Kendaraan'],
                datasets: [{
                    data: [<?php echo $kendaraanPercentage; ?>, <?php echo (100 - $kendaraanPercentage); ?>],
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
                    data: [<?php echo $pejalanKakiPercentage; ?>, <?php echo (100 - $pejalanKakiPercentage); ?>],
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
    var chartData2 = <?php echo $chart_data; ?>;
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