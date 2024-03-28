<style>
    .bg-all {
        border-radius: 25px;
        margin-left: 20px;
    }

    @media only screen and (max-width: 600px) {
        .bg-all {
            border-radius: 25px;
            margin-left: 0px;
            width: 80%;

        }

        .bg-center {
            display: flex;
            justify-content: center;
        }

        .col-6.col-lg-3.searchable-item {
            margin-top: 10px;
        }

        #lineChart {
            margin-top: 10px;
        }
    }
</style>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>
    <h3>Selamat Datang !</h3>
    <span>Selamat anda berhasil login sebagai <?php echo $level; ?> </span>
    <div class="row mb-3 mt-3" id="capture">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="row">
                        <div class="col-10 col-md-4">
                            <label for="cabang">
                                <?php
                                if ($nama_kapal) {
                                    echo 'Cabang    
                                        <img style="margin-left: 10px; margin-right:5px;" width="20" height="20" src="https://img.icons8.com/ios/50/wharf.png" alt="wharf"/>
                                        ' . $nama_kapal . ' ';
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" id="deletekapal" style="margin-left: 5px;">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>';
                                } elseif ($nama_pelabuhan) {
                                    echo 'Cabang 
                                        <img style="margin-left: 10px; margin-right:5px;" width="30" height="30" src="https://img.icons8.com/dotty/80/port.png" alt="port"/>
                                        ' . $nama_pelabuhan . ' ';
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" id="deletepelabuhan" style="margin-left: 5px;">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>';
                                } elseif (isset($_GET['j'])) {
                                    $j = $_GET['j'];
                                    if ($j === '1') {
                                        $j = 'Pre Journey';
                                    } else {
                                        $j = 'Port Journey';
                                    }
                                    echo 'Cabang 
                                    <img style="margin-left: 10px; margin-right:5px;"  width="20" height="20" src="https://img.icons8.com/material-outlined/24/journey.png" alt="journey"/>
                                        ' . $j . ' ';
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" id="journey" style="margin-left: 5px;">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>';
                                } else {
                                    echo 'Cabang';
                                }
                                ?>
                            </label>
                            <div class="form-group">
                                <select class="form-control" name="cabang" id="cabang">
                                    <option value="">All Cabang</option>
                                    <?php foreach ($cabang as $row) { ?>
                                        <?php
                                        // Cek apakah $cabang_id sesuai dengan nilai value dari opsi saat ini
                                        $selected = ($id == $row->id_cabang) ? "selected" : "";
                                        ?>
                                        <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-10 col-md-6 ">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="row">
                                        <div class="col-8 col-md-8">
                                            <h6 class="start-date" id="start-date">Tanggal Awal</h6>
                                        </div>
                                        <div class="col-2 col-md-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" id="deleteIconstart">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control" type="date" name="date_start" id="date_start" value="<?php echo isset($_GET['start']) ? htmlspecialchars($_GET['start']) : $today; ?>">
                                            <!-- <input class="form-control" type="date" name="date_start" id="date_start" > -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <div class="row">
                                        <div class="col-8 col-md-8">
                                            <h6>Tanggal Akhir</h6>
                                        </div>
                                        <div class="col-2 col-md-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" id="deleteIcon">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control" type="date" name="date_end" id="date_end" value="<?php echo isset($_GET['end']) ? htmlspecialchars($_GET['end']) : ''; ?>">
                                            <!-- <input class="form-control" type="date" name="date_end" id="date_end" > -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <label for="tanggal">Tanggal</label>
                                            <input  class="form-control" type="date" name="tanggal" id="tanggal" value="<?php echo $today; ?>" style="width: 100%;"> -->
                        </div>
                    </div>
                    <div class="dropdown no-arrow">
                        <button class="btn btn-success" id="captureBtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
                            </svg>
                        </button>
                        <div id="screenshotResult">
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="row bg-center">
                    <!-- Total Point -->
                    <div class="col-11 col-lg-2 text-center bg-all" style="background-color: 
                                        <?php
                                        $totalPoin = 0; // Variabel untuk menyimpan total poin
                                        $count = 0;

                                        // foreach ($journey as $item) {
                                        // $totalPoin += ($laporan) ? $laporan->poin : 0;
                                        //                          $count++;
                                        // }

                                        $id_pelabuhan   = $this->input->get('p');
                                        $id_kapal       = $this->input->get('k');
                                        $cabang         = $this->input->get('c');
                                        $end            = $this->input->get('end');
                                        $start          = $this->input->get('start');

                                        $j              = $this->input->get('j');
                                        $queryjourney   = $this->db->get_where('journey', array('id_journey' => $j));
                                        $rowjourney     = $queryjourney->row_array();

                                        if ($j) {
                                            // Print the ship name
                                            $namaJourney = $rowjourney['journey'];
                                            $id_journey = $this->Model_beranda->item_journey_id($namaJourney);
                                        } else {
                                            $id_journey = null;
                                        }
                                        if ($j && $cabang) {
                                            $id_journey = $this->Model_beranda->item_journey_id_cabang($cabang, $namaJourney);
                                        }

                                        foreach ($journey as $item_point) {
                                            if (isset($item_point->id_type_option)) {
                                                $this->db->where('laporan.id_type_option', $item_point->id_type_option);
                                            }
                                            if ($j) {
                                                $this->db->where('laporan.id_journey', $id_journey->id_journey);
                                            }
                                            if ($cabang) {
                                                $this->db->where('laporan.id_cabang', $cabang);
                                            }
                                            if ($id_pelabuhan) {
                                                $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
                                            }
                                            if ($id_kapal) {
                                                $this->db->where('laporan.id_kapal', $id_kapal);
                                            }
                                            if ($end) {

                                                $this->db->where('laporan.tanggal >=', $today);
                                                $this->db->where('laporan.tanggal <=', $end);
                                            } else {
                                                $this->db->where('laporan.tanggal', $today);
                                            }

                                            $this->db->where('laporan.status', 'setuju');
                                            $query_laporan_point = $this->db->get('laporan');
                                            $laporan_point = $query_laporan_point->row();

                                            $totalPoin += ($laporan_point) ? $laporan_point->poin : 0;
                                            $count++;
                                        }
                                        // 
                                        $this->db->select_sum('poin');
                                        if ($j) {
                                            $this->db->where('laporan.id_journey', $id_journey->id_journey);
                                        }
                                        if ($cabang) {
                                            $this->db->where('laporan.id_cabang', $cabang);
                                        }
                                        if ($id_pelabuhan) {
                                            $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
                                        }
                                        if ($id_kapal) {
                                            $this->db->where('laporan.id_kapal', $id_kapal);
                                        }
                                        if ($end) {

                                            $this->db->where('laporan.tanggal >=', $today);
                                            $this->db->where('laporan.tanggal <=', $end);
                                        } else {
                                            $this->db->where('laporan.tanggal', $today);
                                        }

                                        $this->db->where('laporan.status', 'setuju');
                                        $query_poin_all = $this->db->get('laporan');
                                        $jumlah_poin_all = $query_poin_all->row()->poin;
                                        // 
                                        if ($j) {
                                            $this->db->where('laporan.id_journey', $id_journey->id_journey);
                                        }
                                        if ($cabang) {
                                            $this->db->where('laporan.id_cabang', $cabang);
                                        }
                                        if ($id_pelabuhan) {
                                            $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
                                        }
                                        if ($id_kapal) {
                                            $this->db->where('laporan.id_kapal', $id_kapal);
                                        }
                                        if ($end) {

                                            $this->db->where('laporan.tanggal >=', $today);
                                            $this->db->where('laporan.tanggal <=', $end);
                                        } else {
                                            $this->db->where('laporan.tanggal', $today);
                                        }

                                        $this->db->where('laporan.status', 'setuju');
                                        $query_poin_all = $this->db->get('laporan');
                                        $jumlah_data_all = $query_poin_all->num_rows();
                                        // 

                                        // Select sum of points per id_type_option
                                        $this->db->select('id_type_option, SUM(poin) as total_poin, COUNT(*) as total_data');
                                        // Conditions similar to what you have
                                        if ($j) {
                                            $this->db->where('laporan.id_journey', $id_journey->id_journey);
                                        }
                                        if ($cabang) {
                                            $this->db->where('laporan.id_cabang', $cabang);
                                        }
                                        if ($id_pelabuhan) {
                                            $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
                                        }
                                        if ($id_kapal) {
                                            $this->db->where('laporan.id_kapal', $id_kapal);
                                        }
                                        if ($end) {
                                            $this->db->where('laporan.tanggal >=', $today);
                                            $this->db->where('laporan.tanggal <=', $end);
                                        } else {
                                            $this->db->where('laporan.tanggal', $today);
                                        }
                                        $this->db->where('laporan.status', 'setuju');
                                        $this->db->group_by('id_type_option'); // Group by id_type_option
                                        $query = $this->db->get('laporan');

                                        $result = $query->result(); // Get the result

                                        $nilai_rata_rata = array(); // Array to store the averages per id_type_option

                                        foreach ($result as $row) {
                                            // Calculate average for each id_type_option
                                            $nilai_rata_rata[$row->id_type_option] = $row->total_data > 0 ? $row->total_poin / $row->total_data : 0;
                                        }


                                        if ($cabang && $j  && !$end || $cabang && $id_kapal  && !$end || $cabang && $id_pelabuhan  && !$end  || $j  && !$end) {
                                            // if($jumlah_data >= 2){
                                            //     $point = ($count > 0) ? $totalPoin / $jumlah_data : 0;
                                            // }else{
                                            $point = ($count > 0) ? $totalPoin / $count : 0;
                                            // }

                                            $cek = "ke 1";
                                        } elseif ($cabang && !$end && $start) {
                                            $point = ($pre_point_admin + $port_point_admin + $on_point_admin + $post_point_admin) / 4;
                                            $cek = "ke 2";
                                        } elseif ($j && $end || $id_pelabuhan  && $end || $id_kapal  && $end ) {
                                            // Menghitung jumlah data dalam JSON
                                            $json_data = json_encode($nilai_rata_rata);
                                            $data_array = json_decode($json_data, true);
                                            $jumlah_data_json = count($data_array);

                                            // Menghitung jumlah nilai dalam JSON
                                            $total_nilai_json = 0;
                                            foreach ($data_array as $nilai) {
                                                $total_nilai_json += $nilai;
                                            }
                                            $point = $total_nilai_json / $count;
                                            $cek = "ke 3";
                                        } else {
                                            $point = ($pre_point_admin + $port_point_admin + $on_point_admin + $post_point_admin) / 4;
                                            $cek = "ke 4";
                                        }
                                        $point = round($point, 1);


                                        $all_point = $all_point_admin;
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
                                <?php //echo $count . '/' . $totalPoin . '/' . $cek .'/'.$jumlah_poin_all .'/'. $jumlah_data_all .'/'. $point .'/';
                                ?>
                                <Span style="font-size: 60px; font-weight: bold; color:white;"><?php echo $point; ?></Span> <span style="  color:white;">/100</span> <br>
                                <span class="atur-text" style="color:white; font-size: 10px;">Item (<?php echo $all_done; ?> / <?php echo $all_item; ?>)</span> <br>
                                <span style="font-size: 30px; font-weight: bold; color:white;">Total Poin</span>
                            </div>
                            <!-- Button Orange -->
                            <?php if ($id == null) : ?>
                                <div class="col-md-12 mb-3 searchable-item">
                                    <?php
                                    $url = $_SERVER['REQUEST_URI'];
                                    $j = '1';
                                    // Check if the variable 'j' is already in the URL and remove it
                                    $url = preg_replace('/&?j=\w+/', '', $url);
                                    // Append 'j' to the URL
                                    $separator = (strpos($url, '?') === false) ? '?' : '&';
                                    $url .= $separator . "j=$j";
                                    // Check if the variable 'p' is already in the URL
                                    if (strpos($url, 'p=') !== false) {
                                        // If 'p' is present, remove it from the URL
                                        $url = preg_replace('/&?p=\w+/', '', $url);
                                    }
                                    // Check if the variable 'k' is already in the URL
                                    if (strpos($url, 'k=') !== false) {
                                        // If 'p' is present, remove it from the URL
                                        $url = preg_replace('/&?k=\w+/', '', $url);
                                    }
                                    ?>
                                    <a href="<?php echo $url; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                        <button style="width:95%" type="button" class="btn btn-warning"><?php echo $pre_next->journey; ?></button>
                                    </a>
                                </div>
                                <div class="col-md-12 mb-3 searchable-item">
                                    <?php
                                    $url = $_SERVER['REQUEST_URI'];
                                    $j = '2';

                                    // Check if the variable 'j' is already in the URL and remove it
                                    $url = preg_replace('/&?j=\w+/', '', $url);

                                    // Append 'j' to the URL
                                    $separator = (strpos($url, '?') === false) ? '?' : '&';
                                    $url .= $separator . "j=$j";
                                    // Check if the variable 'p' is already in the URL
                                    if (strpos($url, 'p=') !== false) {
                                        // If 'p' is present, remove it from the URL
                                        $url = preg_replace('/&?p=\w+/', '', $url);
                                    }
                                    // Check if the variable 'k' is already in the URL
                                    if (strpos($url, 'k=') !== false) {
                                        // If 'p' is present, remove it from the URL
                                        $url = preg_replace('/&?k=\w+/', '', $url);
                                    }
                                    ?>
                                    <a href="<?php echo $url; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                        <button style="width:95%" type="button" class="btn btn-warning"><?php echo $port_next->journey; ?></button>
                                    </a>
                                </div>
                                <div class="col-md-12 mb-3 searchable-item">
                                    <?php
                                    $url = $_SERVER['REQUEST_URI'];
                                    $j = '3';

                                    // Check if the variable 'j' is already in the URL and remove it
                                    $url = preg_replace('/&?j=\w+/', '', $url);

                                    // Append 'j' to the URL
                                    $separator = (strpos($url, '?') === false) ? '?' : '&';
                                    $url .= $separator . "j=$j";
                                    // Check if the variable 'p' is already in the URL
                                    if (strpos($url, 'p=') !== false) {
                                        // If 'p' is present, remove it from the URL
                                        $url = preg_replace('/&?p=\w+/', '', $url);
                                    }
                                    // Check if the variable 'k' is already in the URL
                                    if (strpos($url, 'k=') !== false) {
                                        // If 'p' is present, remove it from the URL
                                        $url = preg_replace('/&?k=\w+/', '', $url);
                                    }
                                    ?>
                                    <a href="<?php echo $url; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                        <button style="width:95%" type="button" class="btn btn-warning"><?php echo $on_next->journey; ?></button>
                                    </a>
                                </div>
                                <div class="col-md-12 mb-3 searchable-item">
                                    <?php
                                    $url = $_SERVER['REQUEST_URI'];
                                    $j = '4';

                                    // Check if the variable 'j' is already in the URL and remove it
                                    $url = preg_replace('/&?j=\w+/', '', $url);

                                    // Append 'j' to the URL
                                    $separator = (strpos($url, '?') === false) ? '?' : '&';
                                    $url .= $separator . "j=$j";
                                    // Check if the variable 'p' is already in the URL
                                    if (strpos($url, 'p=') !== false) {
                                        // If 'p' is present, remove it from the URL
                                        $url = preg_replace('/&?p=\w+/', '', $url);
                                    }
                                    // Check if the variable 'k' is already in the URL
                                    if (strpos($url, 'k=') !== false) {
                                        // If 'p' is present, remove it from the URL
                                        $url = preg_replace('/&?k=\w+/', '', $url);
                                    }
                                    ?>
                                    <a href="<?php echo $url; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                        <button style="width:95%" type="button" class="btn btn-warning"><?php echo $post_next->journey; ?></button>
                                    </a>
                                </div>
                                <!--  -->
                            <?php else : ?>
                                <!--  -->
                                <?php $j = 1;

                                $end =  $this->input->get('end');
                                foreach ($journey as $item) { ?>
                                    <div class="col-md-12 mb-3 searchable-item">
                                        <?php

                                        $cabang = $this->input->get('c');
                                        // Ambil data laporan berdasarkan nilai $item->id_type_option (atau sesuaikan dengan referensi yang benar)
                                        if (!empty($item->id_type_option)) {
                                            $this->db->where('laporan.id_type_option', $item->id_type_option);
                                            if ($end) {

                                                $this->db->where('tanggal >=', $today);
                                                $this->db->where('tanggal <=', $end);
                                            } else {
                                                $this->db->where('laporan.tanggal', $today);
                                            }

                                            // $this->db->where('laporan.tanggal', $today);
                                            $this->db->where('laporan.status', 'setuju');
                                            $query_laporan = $this->db->get('laporan');
                                            $laporan = $query_laporan->row(); // Menggunakan row() karena hanya ingin satu baris data
                                            $jumlah_data = $query_laporan->num_rows(); // Jika $laporan tidak kosong, maka cetak nilai poin, jika kosong, cetak '0'
                                            if ($laporan !== null && $jumlah_data <= 1) {
                                                $link = base_url('Admin/laporan_detail/' . $laporan->id_laporan);
                                            } elseif ($end) {

                                                $link = '#';
                                                $poin = '0';
                                            } else {

                                                $link = '#';
                                                $poin = '0';
                                            }

                                            $modal = null;
                                        } else {

                                            $link = $_SERVER['REQUEST_URI'];


                                            // Check if the variable 'j' is already in the URL and remove it
                                            $link = preg_replace('/&?j=\w+/', '', $link);

                                            // Append 'j' to the URL
                                            $separator = (strpos($link, '?') === false) ? '?' : '&';
                                            $link .= $separator . "j=$j";
                                            // Check if the variable 'p' is already in the URL
                                            if (strpos($link, 'p=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $link = preg_replace('/&?p=\w+/', '', $link);
                                            }
                                            // Check if the variable 'k' is already in the URL
                                            if (strpos($link, 'k=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $link = preg_replace('/&?k=\w+/', '', $link);
                                            }
                                            if ($j == 2) {
                                                $modal = 'data-toggle="modal" data-target="#myModal" ';
                                            } elseif ($j == 3) {
                                                $modal = 'data-toggle="modal" data-target="#myModal2" ';
                                            } else {
                                                $modal = null;
                                            }
                                        }

                                        $j++;
                                        ?>
                                        <?php if ($modal == null) : ?>
                                            <a href="<?= $link; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                            <?php elseif ($modal != null) : ?>
                                                <a <?= $modal; ?> style="text-decoration: none; color:rgb(73, 73, 73);">
                                                <?php endif; ?>
                                                <button style="width:95%" type="button" class="btn btn-warning">
                                                    <?php if (!empty($item->journey)) {
                                                        echo $item->journey;
                                                    } else {
                                                        echo $item->type_option;
                                                    }; ?></button>
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
                            <!-- Point -->
                            <div class="col-lg-12">
                                <div class="row">
                                    <?php if ($id == null && $nama_journey == null) : ?>
                                        <div class="col-6 col-lg-3   searchable-item">
                                            <?php
                                            $url = $_SERVER['REQUEST_URI'];
                                            $j = '1';

                                            // Check if the variable 'j' is already in the URL and remove it
                                            $url = preg_replace('/&?j=\w+/', '', $url);

                                            // Append 'j' to the URL
                                            $separator = (strpos($url, '?') === false) ? '?' : '&';
                                            $url .= $separator . "j=$j";
                                            // Check if the variable 'p' is already in the URL
                                            if (strpos($url, 'p=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $url = preg_replace('/&?p=\w+/', '', $url);
                                            }
                                            // Check if the variable 'k' is already in the URL
                                            if (strpos($url, 'k=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $url = preg_replace('/&?k=\w+/', '', $url);
                                            }
                                            ?>
                                            <a href="<?php echo $url; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                <div class="text-center" style="background-color: 
                                                    <?php
                                                    $pre_point = $pre_point_admin;
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
                                                        <?php echo $pre_point_admin; ?>
                                                    </Span>
                                                    <span style="color:white; font-size: 12px;">/100</span> <br>
                                                    <span style="font-weight: bold; color:white; font-size: 13px;"><?php echo $pre_next->journey; ?></span>
                                                    <span class="atur-text" style="color:white; font-size: 9px;">(<?php echo $pre_done; ?> / <?php echo $pre_item; ?>)</span> <br>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-6 col-lg-3  searchable-item">
                                            <?php
                                            $url = $_SERVER['REQUEST_URI'];
                                            $j = '2';

                                            // Check if the variable 'j' is already in the URL and remove it
                                            $url = preg_replace('/&?j=\w+/', '', $url);

                                            // Append 'j' to the URL
                                            $separator = (strpos($url, '?') === false) ? '?' : '&';
                                            $url .= $separator . "j=$j";
                                            // Check if the variable 'p' is already in the URL
                                            if (strpos($url, 'p=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $url = preg_replace('/&?p=\w+/', '', $url);
                                            }
                                            // Check if the variable 'k' is already in the URL
                                            if (strpos($url, 'k=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $url = preg_replace('/&?k=\w+/', '', $url);
                                            }
                                            ?>
                                            <a href="<?php echo $url; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                <div class="text-center" style="background-color: 
                                                    <?php
                                                    $port_point = $port_point_admin;
                                                    if ($port_point < 60) {
                                                        echo 'red';
                                                    } elseif ($port_point >= 61 && $port_point <= 70) {
                                                        echo 'orange';
                                                    } elseif ($port_point >= 71 && $port_point <= 100) {
                                                        echo 'rgb(37, 190, 48, 1)';
                                                    }
                                                    ?>; height: 100px; border-radius: 10px; padding:10px;">
                                                    <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                        <?php echo $port_point_admin; ?>
                                                    </Span>
                                                    <span style="color:white; font-size: 12px;">/100</span> <br>
                                                    <span style="font-weight: bold; color:white; font-size: 13px;"><?php echo $port_next->journey; ?></span>
                                                    <span class="atur-text" style="color:white; font-size: 9px;">(<?php echo $port_done; ?> / <?php echo $port_item; ?>)</span> <br>
                                                </div>
                                            </a>

                                        </div>

                                        <div class="col-6 col-lg-3  searchable-item">
                                            <?php
                                            $url = $_SERVER['REQUEST_URI'];
                                            $j = '3';

                                            // Check if the variable 'j' is already in the URL and remove it
                                            $url = preg_replace('/&?j=\w+/', '', $url);

                                            // Append 'j' to the URL
                                            $separator = (strpos($url, '?') === false) ? '?' : '&';
                                            $url .= $separator . "j=$j";
                                            // Check if the variable 'p' is already in the URL
                                            if (strpos($url, 'p=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $url = preg_replace('/&?p=\w+/', '', $url);
                                            }
                                            // Check if the variable 'k' is already in the URL
                                            if (strpos($url, 'k=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $url = preg_replace('/&?k=\w+/', '', $url);
                                            }
                                            ?>
                                            <a href="<?php echo $url; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                <div class="text-center" style="background-color: 
                                                    <?php
                                                    $on_point = $on_point_admin;
                                                    if ($on_point < 60) {
                                                        echo 'red';
                                                    } elseif ($on_point >= 61 && $on_point <= 70) {
                                                        echo 'orange';
                                                    } elseif ($on_point >= 71 && $on_point <= 100) {
                                                        echo 'rgb(37, 190, 48, 1)';
                                                    }
                                                    ?>; height: 100px; border-radius: 10px; padding:10px;">
                                                    <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                        <?php echo $on_point_admin; ?>
                                                    </Span>
                                                    <span style="color:white; font-size: 12px;">/100</span> <br>
                                                    <span style="font-weight: bold; color:white;  font-size: 13px;"><?php echo $on_next->journey; ?></span>
                                                    <span class="atur-text" style="color:white; font-size: 9px;">(<?php echo $on_done; ?> / <?php echo $on_item; ?>)</span> <br>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-6 col-lg-3  searchable-item">
                                            <?php
                                            $url = $_SERVER['REQUEST_URI'];
                                            $j = '4';

                                            // Check if the variable 'j' is already in the URL and remove it
                                            $url = preg_replace('/&?j=\w+/', '', $url);

                                            // Append 'j' to the URL
                                            $separator = (strpos($url, '?') === false) ? '?' : '&';
                                            $url .= $separator . "j=$j";
                                            // Check if the variable 'p' is already in the URL
                                            if (strpos($url, 'p=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $url = preg_replace('/&?p=\w+/', '', $url);
                                            }
                                            // Check if the variable 'k' is already in the URL
                                            if (strpos($url, 'k=') !== false) {
                                                // If 'p' is present, remove it from the URL
                                                $url = preg_replace('/&?k=\w+/', '', $url);
                                            }
                                            ?>
                                            <a href="<?php echo $url; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                <div class="text-center" style="background-color: 
                                                    <?php
                                                    $post_point = $post_point_admin;
                                                    if ($post_point < 60) {
                                                        echo 'red';
                                                    } elseif ($post_point >= 61 && $post_point <= 70) {
                                                        echo 'orange';
                                                    } elseif ($post_point >= 71 && $post_point <= 100) {
                                                        echo 'rgb(37, 190, 48, 1)';
                                                    }
                                                    ?>; height: 100px; border-radius: 10px; padding:10px;">
                                                    <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                        <?php echo $post_point_admin; ?>
                                                    </Span>
                                                    <span style="color:white; font-size: 12px;">/100</span> <br>
                                                    <span style="font-weight: bold; color:white;  font-size: 13px;"><?php echo $post_next->journey; ?></span>
                                                    <span class="atur-text" style="color:white; font-size: 9px;">(<?php echo $post_done; ?> / <?php echo $post_item; ?>)</span> <br>
                                                </div>
                                            </a>

                                        </div>
                                        <!--  -->
                                    <?php else : ?>
                                        <!--  -->
                                        <?php
                                        $totalPoin_2 = 0; // Variabel untuk menyimpan total poin
                                        $count_2  = 0;
                                        $cabang = $this->input->get('c');
                                        $end = $this->input->get('end');
                                        foreach ($journey as $item) { ?>
                                            <?php if (!empty($item->journey) && $item->journey == 'Pre Journey') : ?>
                                                <div class="col-6 col-lg-3   searchable-item">
                                                    <?php
                                                    $url = $_SERVER['REQUEST_URI'];
                                                    $j = '1';

                                                    // Check if the variable 'j' is already in the URL and remove it
                                                    $url = preg_replace('/&?j=\w+/', '', $url);

                                                    // Append 'j' to the URL
                                                    $separator = (strpos($url, '?') === false) ? '?' : '&';
                                                    $url .= $separator . "j=$j";
                                                    // Check if the variable 'p' is already in the URL
                                                    if (strpos($url, 'p=') !== false) {
                                                        // If 'p' is present, remove it from the URL
                                                        $url = preg_replace('/&?p=\w+/', '', $url);
                                                    }
                                                    // Check if the variable 'k' is already in the URL
                                                    if (strpos($url, 'k=') !== false) {
                                                        // If 'p' is present, remove it from the URL
                                                        $url = preg_replace('/&?k=\w+/', '', $url);
                                                    }
                                                    ?>
                                                    <a href="<?php echo $url; ?>" style="text-decoration: none; color: rgb(73, 73, 73);">
                                                        <div class="text-center" style="background-color: 
                                                            <?php
                                                            $pre_point = $pre_point_admin;
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
                                                                <?php echo $pre_point_admin; ?>
                                                            </Span> 
                                                            <span style="color:white; font-size: 12px;">/100</span> <br>
                                                            <span style="font-weight: bold; color:white; font-size: 13px;"><?php echo $item->journey; ?></span>
                                                            <span class="atur-text" style="color:white; font-size: 9px;">(<?php echo $pre_done; ?> / <?php echo $pre_item; ?>)</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php elseif (!empty($item->journey) && $item->journey == 'Port Journey') : ?>
                                                <div class="col-6 col-lg-3  searchable-item">
                                                    <div class="text-center" style="background-color: 
                                                        <?php
                                                        $port_point = $port_point_admin;
                                                        if ($port_point < 60) {
                                                            echo 'red';
                                                        } elseif ($port_point >= 61 && $port_point <= 70) {
                                                            echo 'orange';
                                                        } elseif ($port_point >= 71 && $port_point <= 100) {
                                                            echo 'rgb(37, 190, 48, 1)';
                                                        }
                                                        ?>; height: 100px; border-radius: 10px; padding:10px;" data-toggle="modal" data-target="#myModal">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <span style="font-size: 40px; font-weight: bold; color:white;">
                                                                    <?php echo $port_point_admin; ?>
                                                                </span>
                                                                <span style="color:white; font-size: 12px;">/100</span> <br>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                                                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0" />
                                                                </svg>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <span style="font-weight: bold; color:white; font-size: 13px;"><?php echo $item->journey; ?></span>
                                                                <span class="atur-text" style="color:white; font-size: 9px;">(<?php echo $port_done; ?> / <?php echo $port_item; ?>)</span> <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- The Modal -->
                                                    <div class="modal" id="myModal">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Pilih Pelabuhan</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Modal Body -->
                                                                <div class="modal-body">
                                                                    <!-- Your modal content goes here -->
                                                                    <div class="row">
                                                                        <?php foreach ($pelabuhan as $row) { ?>
                                                                            <div class="col-md-12 mb-1">
                                                                                <?php
                                                                                $id_pelabuhan = $row->id_pelabuhan;
                                                                                $url = $_SERVER['REQUEST_URI'];

                                                                                // Check if the variable 'k' is already in the URL
                                                                                if (strpos($url, 'p=') !== false) {
                                                                                    // If 'k' is present, replace its value with $id_pelabuhan
                                                                                    $url = preg_replace('/(\?|&)p=\d+/', '$1p=' . $id_pelabuhan, $url);
                                                                                } else {
                                                                                    // If 'k' is not present, append it to the URL
                                                                                    $separator = (strpos($url, '?') === false) ? '?' : '&';
                                                                                    $url .= $separator . "p=$id_pelabuhan";
                                                                                }
                                                                                // Check if the variable 'p' is already in the URL
                                                                                if (strpos($url, 'k=') !== false) {
                                                                                    // If 'p' is present, remove it from the URL
                                                                                    $url = preg_replace('/&?k=\w+/', '', $url);
                                                                                }
                                                                                // Check if the variable 'j' is already in the URL
                                                                                if (strpos($url, 'j=') !== false) {
                                                                                    // If 'p' is present, remove it from the URL
                                                                                    $url = preg_replace('/&?j=\w+/', '', $url);
                                                                                }
                                                                                ?>
                                                                                <a href="<?php echo $url; ?>" class="btn text-center btn-outline-light" style="width: 100%;">
                                                                                    <?php echo $row->pelabuhan; ?>
                                                                                </a>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                                <!-- Modal Footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php elseif (!empty($item->journey) && $item->journey == 'On Board Journey') : ?>
                                                <div class="col-6 col-lg-3  searchable-item">
                                                    <div class="text-center" style="background-color: 
                                                        <?php
                                                        $on_point = $on_point_admin;
                                                        if ($on_point < 60) {
                                                            echo 'red';
                                                        } elseif ($on_point >= 61 && $on_point <= 70) {
                                                            echo 'orange';
                                                        } elseif ($on_point >= 71 && $on_point <= 100) {
                                                            echo 'rgb(37, 190, 48, 1)';
                                                        }
                                                        ?>; height: 100px; border-radius: 10px; padding:10px;" data-toggle="modal" data-target="#myModal2">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <span style="font-size: 40px; font-weight: bold; color:white;">
                                                                    <?php echo $on_point_admin; ?>
                                                                </span>
                                                                <span style="color:white; font-size: 12px;">/100</span> <br>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                                                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0" />
                                                                </svg>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <span style="font-weight: bold; color:white; font-size: 13px;"><?php echo $item->journey; ?></span>
                                                                <span class="atur-text" style="color:white; font-size: 9px;">(<?php echo $on_done; ?> / <?php echo $on_item; ?>)</span> <br>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- The Modal -->
                                                    <div class="modal" id="myModal2">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Pilih Kapal</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Modal Body -->
                                                                <div class="modal-body">
                                                                    <!-- Your modal content goes here -->
                                                                    <div class="row">
                                                                        <?php foreach ($kapal as $row) { ?>
                                                                            <div class="col-md-12 mb-1">
                                                                                <?php
                                                                                $id_kapal = $row->id_kapal;
                                                                                $url = $_SERVER['REQUEST_URI'];

                                                                                // Check if the variable 'k' is already in the URL
                                                                                if (strpos($url, 'k=') !== false) {
                                                                                    // If 'k' is present, replace its value with $id_kapal
                                                                                    $url = preg_replace('/(\?|&)k=\d+/', '$1k=' . $id_kapal, $url);
                                                                                } else {
                                                                                    // If 'k' is not present, append it to the URL
                                                                                    $separator = (strpos($url, '?') === false) ? '?' : '&';
                                                                                    $url .= $separator . "k=$id_kapal";
                                                                                }

                                                                                // Check if the variable 'p' is already in the URL
                                                                                if (strpos($url, 'p=') !== false) {
                                                                                    // If 'p' is present, remove it from the URL
                                                                                    $url = preg_replace('/&?p=\w+/', '', $url);
                                                                                }

                                                                                // Check if the variable 'j' is already in the URL
                                                                                if (strpos($url, 'j=') !== false) {
                                                                                    // If 'p' is present, remove it from the URL
                                                                                    $url = preg_replace('/&?j=\w+/', '', $url);
                                                                                }
                                                                                ?>
                                                                                <a href="<?php echo $url; ?>" class="btn text-center btn-outline-light" style="width: 100%;">
                                                                                    <?php echo $row->kapal; ?>
                                                                                </a>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                                <!-- Modal Footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php elseif (!empty($item->journey) && $item->journey == 'Post Journey') : ?>
                                                <div class="col-6 col-lg-3  searchable-item">
                                                    <?php
                                                    $url = $_SERVER['REQUEST_URI'];
                                                    $j = '4';

                                                    // Check if the variable 'j' is already in the URL and remove it
                                                    $url = preg_replace('/&?j=\w+/', '', $url);

                                                    // Append 'j' to the URL
                                                    $separator = (strpos($url, '?') === false) ? '?' : '&';
                                                    $url .= $separator . "j=$j";
                                                    ?>
                                                    <a href="<?php echo $url; ?>" style="text-decoration: none; color:rgb(73, 73, 73);">
                                                        <div class="text-center" style="background-color: 
                                                            <?php
                                                            $post_point = $post_point_admin;
                                                            if ($post_point < 60) {
                                                                echo 'red';
                                                            } elseif ($post_point >= 61 && $post_point <= 70) {
                                                                echo 'orange';
                                                            } elseif ($post_point >= 71 && $post_point <= 100) {
                                                                echo 'rgb(37, 190, 48, 1)';
                                                            }
                                                            ?>; height: 100px; border-radius: 10px; padding:10px;">
                                                            <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                                <?php echo $post_point_admin; ?>
                                                            </Span>
                                                            <span style="color:white; font-size: 12px;">/100</span> <br>
                                                            <span style="font-weight: bold; color:white; font-size: 13px;"><?php echo $item->journey; ?></span>
                                                            <span class="atur-text" style="color:white; font-size: 9px;">(<?php echo $post_done; ?> / <?php echo $post_item; ?>)</span> <br>
                                                        </div>
                                                    </a>

                                                </div>
                                            <?php else : ?>
                                                <div class="col-6 col-lg-3 mt-2 searchable-item">
                                                    <?php

                                                    // Ambil data laporan berdasarkan nilai $item->id_type_option (atau sesuaikan dengan referensi yang benar)
                                                    // Duplikat query yang telah ada sebelumnya untuk mengambil data laporan
                                                    $this->db->where('laporan.id_type_option', $item->id_type_option);
                                                    if ($end) {
                                                        $this->db->where('tanggal >=', $today);
                                                        $this->db->where('tanggal <=', $end);
                                                    } else {
                                                        $this->db->where('laporan.tanggal', $today);
                                                    }
                                                    $this->db->where('laporan.status', 'setuju');
                                                    $query_laporan = $this->db->get('laporan');
                                                    $laporan = $query_laporan->row(); // Menggunakan row() karena hanya ingin satu baris data
                                                    $jumlah_data = $query_laporan->num_rows();

                                                    // Menambahkan query baru untuk menghitung jumlah total poin
                                                    $this->db->select_sum('poin');
                                                    $this->db->where('laporan.id_type_option', $item->id_type_option);
                                                    if ($end) {
                                                        $this->db->where('tanggal >=', $today);
                                                        $this->db->where('tanggal <=', $end);
                                                    } else {
                                                        $this->db->where('laporan.tanggal', $today);
                                                    }
                                                    $this->db->where('laporan.status', 'setuju');
                                                    $query_poin = $this->db->get('laporan');
                                                    $jumlah_poin = $query_poin->row()->poin;

                                                    // Jika $laporan tidak kosong, maka cetak nilai poin, jika kosong, cetak '0'
                                                    if ($laporan !== null && $jumlah_data <= 1) {
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
                                                                            ; height: <?php
                                                                                        if ($cabang == null) {
                                                                                            echo '150px';
                                                                                        } else {
                                                                                            echo '100px';
                                                                                        } ?> ; border-radius: 10px; padding: 8px;">
                                                            <?php

                                                            // Checking if $cabang is null
                                                            if ($cabang == null) {
                                                                // Printing HTML content
                                                            ?>
                                                                <span style="font-weight: bold; color:white; font-size:9px;">
                                                                    (
                                                                    <?php
                                                                    // Checking if $item->id_cabang is not null
                                                                    if ($item->id_cabang != null) {
                                                                        // Fetching cabang data
                                                                        $cabang_data = $this->Model_soal->get_cabang_by_id($item->id_cabang);
                                                                        // Checking if cabang_data is not null
                                                                        echo $cabang_data !== null ? $cabang_data->cabang : '-';
                                                                    }
                                                                    ?>

                                                                    <?php
                                                                    // Checking if $item->id_cabang is not null
                                                                    if ($item->id_pelabuhan != null) {
                                                                        // Fetching pelabuhan data
                                                                        $pelabuhan_data = $this->Model_soal->get_pelabuhan_by_id($item->id_pelabuhan);
                                                                        // Checking if pelabuhan_data is not null
                                                                        echo $pelabuhan_data !== null ? '-> ' . $pelabuhan_data->pelabuhan : '-';
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    // Checking if $item->id_cabang is not null
                                                                    if ($item->id_kapal != null) {
                                                                        // Fetching kapal data
                                                                        $kapal_data = $this->Model_soal->get_kapal_by_id($item->id_kapal);
                                                                        // Checking if kapal_data is not null
                                                                        echo $kapal_data !== null ? '-> ' . $kapal_data->kapal : '-';
                                                                    }
                                                                    ?>
                                                                    )
                                                                </span>
                                                                <br>
                                                            <?php
                                                            } // End of if condition
                                                            ?>

                                                            <Span style="font-size: 40px; font-weight: bold; color:white;">
                                                                <?php
                                                                $totalPoin_2 += ($laporan) ? $laporan->poin : 0;
                                                                $count_2++;
                                                                $laporan_poin = ($laporan) ? $laporan->poin : 0;
                                                                if ($jumlah_data >= 2) {

                                                                    $nilai = $jumlah_poin / $jumlah_data;
                                                                    echo ($laporan) ? $nilai  : '0';
                                                                } elseif ($jumlah_data <= 1) {
                                                                    $nilai = $laporan_poin;
                                                                    echo ($laporan) ? $nilai  : '0';
                                                                }
                                                                ?>
                                                            </Span>
                                                            <span style="color:white; font-size: 12px;">/100</span> <br>
                                                            <span style="font-weight: bold; color:white; font-size: 12px;"><?php echo $item->type_option; ?></span>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                        <?php } ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!--  -->
                            <div class="col-12 col-lg-12 searchable-item">
                                <canvas id="lineChart"></canvas>
                                <?php
                                // Mendapatkan tanggal saat ini
                                $currentDate = date('Y-m-d');
                                $id_user = $this->session->userdata('id_user');
                                $user = $this->Model_akun->getCabangByID($id_user);
                                $cabang = $user;

                                if (isset($_GET['c'])) {
                                    $id_cabang = $_GET['c'];
                                } else {
                                    $id_cabang = null;
                                }
                                if (isset($_GET['k'])) {
                                    $id_kapal = $_GET['k'];
                                } else {
                                    $id_kapal = null;
                                }
                                if (isset($_GET['p'])) {
                                    $id_pelabuhan = $_GET['p'];
                                } else {
                                    $id_pelabuhan = null;
                                }
                                if (isset($_GET['j'])) {
                                    $j = $_GET['j'];
                                } else {
                                    $j = null;
                                }
                                $queryjourney = $this->db->get_where('journey', array('id_journey' => $j));
                                $rowjourney = $queryjourney->row_array();

                                if ($j) {
                                    // Print the ship name
                                    $namaJourney = $rowjourney['journey'];
                                }
                                if ($j && $id_cabang) {
                                    $id_journey = $this->Model_beranda->item_journey_id_cabang($id_cabang, $namaJourney);
                                }
                                // Mendapatkan tanggal awal dan akhir dari parameter query string (jika ada)
                                if (isset($_GET['start'])) {
                                    $startDate = $_GET['start'];
                                    if (isset($_GET['end'])) {
                                        $endDate = $_GET['end'];
                                    } else {
                                        // Jika tanggal akhir tidak diberikan, gunakan tanggal awal
                                        $endDate = $startDate;
                                    }
                                } elseif ($j) {
                                    $startDate = $today;
                                    if (isset($_GET['end'])) {
                                        $endDate = $_GET['end'];
                                    } else {
                                        // Jika tanggal akhir tidak diberikan, gunakan tanggal awal
                                        $endDate = $startDate;
                                    }
                                } else {
                                    // Jika tanggal awal tidak diberikan, gunakan rentang default 6 bulan yang lalu
                                    $defaultBulan = 1;
                                    $startDate = date('Y-m-d', strtotime('-' . $defaultBulan . ' months', strtotime($currentDate)));
                                    $endDate = $currentDate;
                                }

                                if ($id == null) {
                                    $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                                    $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                                    $this->db->where('laporan.tanggal >=', $startDate);
                                    $this->db->where('laporan.tanggal <=', $endDate);
                                    if ($nama_journey) {
                                        $this->db->where('journey.journey', $nama_journey);
                                    }
                                    $this->db->where('laporan.status', 'setuju');
                                    $this->db->order_by('laporan.tanggal', 'ASC');
                                    $query = $this->db->get('laporan');
                                } else {
                                    $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                                    $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                                    $this->db->where('laporan.id_cabang', $id);
                                    $this->db->where('laporan.tanggal >=', $startDate);
                                    $this->db->where('laporan.tanggal <=', $endDate);
                                    if ($id_pelabuhan != null) {
                                        $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
                                    }
                                    if ($id_kapal != null) {
                                        $this->db->where('laporan.id_kapal', $id_kapal);
                                    }
                                    if ($j != null) {
                                        $this->db->where('laporan.id_journey', $id_journey->id_journey);
                                    }
                                    $this->db->where('laporan.status', 'setuju');
                                    $this->db->order_by('laporan.tanggal', 'ASC');
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
                                                        <span style="font-size:20px;">
                                                            <?php
                                                            $roundedPercentage = round($hasil_kendaraan); // Membulatkan nilai
                                                            echo $roundedPercentage; // Mencetak nilai yang telah dibulatkan
                                                            ?>%</span>
                                                        <span style="font-size:10px;">(<?php echo $done_kendaraan; ?>/<?php echo $item_kendaraan; ?>)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-7 col-lg-7 searchable-item">
                                                <canvas id="barChart1" width="900" height="700"></canvas>
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
                                                        <span style="font-size:20px;">
                                                            <?php
                                                            $roundedPercentage = round($hasil_pejalankaki); // Membulatkan nilai
                                                            echo $roundedPercentage; // Mencetak nilai yang telah dibulatkan
                                                            ?>%</span>
                                                        <span style="font-size:10px;">(<?php echo $done_pejalankaki; ?>/<?php echo $item_pejalankaki; ?>)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-7 col-lg-7 searchable-item">
                                                <canvas id="barChart2" width="900" height="700"></canvas>
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
            document.addEventListener('DOMContentLoaded', function() {
                const dateStartInput = document.getElementById('date_start');
                const dateEndInput = document.getElementById('date_end');
                const newCabang = document.getElementById('cabang');
                const tanggalH6 = document.querySelector('.start-date');
                const spans = document.querySelectorAll('.atur-text');
                const deleteIconstart = document.getElementById('deleteIconstart');
                const deleteIcon = document.getElementById('deleteIcon');

                // const deletekapal = document.getElementById('deletekapal');
                // const resetButton = document.getElementById('resetButton');
                // const journey = document.getElementById('journey');
                // const deletepelabuhan = document.getElementById('deletepelabuhan');

                dateEndInput.addEventListener('change', updateStyles);
                dateStartInput.addEventListener('change', updateDateInputs);
                dateEndInput.addEventListener('change', validateDateRange);
                deleteIconstart.addEventListener('click', deleteEndDatestart);
                deleteIcon.addEventListener('click', deleteEndDate);
                newCabang.addEventListener('change', updateCabangAndRedirect);

                if (document.getElementById('deletekapal')) {
                    const deletekapal = document.getElementById('deletekapal');
                    deletekapal.addEventListener('click', deleteKapal);
                }

                if (document.getElementById('resetButton')) {
                    const resetButton = document.getElementById('resetButton');
                    resetButton.addEventListener('click', resetQueryParams);
                }

                if (document.getElementById('journey')) {
                    const journey = document.getElementById('journey');
                    journey.addEventListener('click', deleteParameterJourney);
                }

                if (document.getElementById('deletepelabuhan')) {
                    const deletepelabuhan = document.getElementById('deletepelabuhan');
                    deletepelabuhan.addEventListener('click', deletePelabuhan);
                }


                window.addEventListener('load', function() {
                    updateStyles();
                });

                function updateStyles() {
                    const urlParams = new URLSearchParams(window.location.search);
                    const startParam = urlParams.get('start');
                    const endParam = urlParams.get('end');
                    const jParam = urlParams.get('j');
                    const pParam = urlParams.get('p');
                    const kParam = urlParams.get('k');
                    if (!startParam) {
                        tanggalH6.textContent = 'Tanggal';
                        dateEndInput.disabled = true;
                    } else if (endParam) {
                        tanggalH6.textContent = 'Tanggal Awal';
                        spans.forEach(span => span.style.display = 'none');
                        dateEndInput.disabled = false;
                    }
                    if (jParam || kParam || pParam) {

                        spans.forEach(span => span.style.display = 'none');
                    }
                }

                function updateDateInputs() {
                    const isDateStartEmpty = dateStartInput.value.trim() === '';
                    dateEndInput.disabled = isDateStartEmpty;
                    updateStyles();
                    updateDateRange();
                }

                function validateDateRange() {
                    const startDate = new Date(dateStartInput.value);
                    const endDate = new Date(dateEndInput.value);

                    if (endDate > startDate) {
                        updateDateRange();
                    } else {
                        showDateWarning();
                    }
                }

                function updateDateRange() {
                    const urlParams = new URLSearchParams(window.location.search);

                    // Mendapatkan nilai-nilai parameter jika ada, atau null jika tidak ada
                    const id_kapal = urlParams.has('k') ? urlParams.get('k') : null;
                    const id_pelabuhan = urlParams.has('p') ? urlParams.get('p') : null;
                    const id_journey = urlParams.has('j') ? urlParams.get('j') : null;

                    const startDate = dateStartInput.value;
                    const endDate = dateEndInput.value;
                    const c = newCabang.value;

                    const baseUrl = window.location.href.split('?')[0];

                    // Membuat array yang berisi parameter-parameter baru
                    const params = [];
                    // Menambahkan parameter c jika c ada
                    if (c) {
                        params.push(`c=${c}`);
                    }

                    // Menambahkan parameter id_kapal jika ada
                    if (id_kapal) {
                        params.push(`k=${id_kapal}`);
                    }

                    // Menambahkan parameter id_pelabuhan jika ada
                    if (id_pelabuhan) {
                        params.push(`p=${id_pelabuhan}`);
                    }

                    // Menambahkan parameter id_journey jika ada
                    if (id_journey) {
                        params.push(`j=${id_journey}`);
                    }

                    // Menambahkan parameter start jika startDate ada
                    if (startDate) {
                        params.push(`start=${startDate}`);
                        // dateStartInput.value = startDate  ;

                    }

                    // Menambahkan parameter end jika endDate ada
                    if (endDate) {
                        params.push(`end=${endDate}`);
                    }


                    // Menggabungkan parameter-parameter baru dengan '&' dan menggabungkannya dengan baseUrl
                    const newUrl = `${baseUrl}?${params.join('&')}`;

                    // Mengarahkan ke URL baru
                    window.location.href = newUrl;

                }

                function updateCabangAndRedirect() {
                    const startDate = dateStartInput.value;
                    const endDate = dateEndInput.value;
                    const c = newCabang.value;

                    const baseUrl = window.location.href.split('?')[0];
                    const params = [startDate ? `start=${startDate}` : '', endDate ? `end=${endDate}` : '', c ? `c=${c}` : ''];
                    const newUrl = `${baseUrl}?${params.filter(Boolean).join('&')}`;

                    window.location.href = newUrl;
                }

                function deleteEndDatestart() {
                    deleteParameter('start');
                }

                function deleteEndDate() {
                    deleteParameter('end');
                }

                function deleteKapal() {
                    deleteParameter('k');
                }

                function deletePelabuhan() {
                    deleteParameter('p');
                    console.log("delete P");
                }

                function resetQueryParams() {
                    const baseUrl = window.location.href.split('?')[0];
                    window.location.href = baseUrl;
                }

                function deleteParameter(param) {
                    const url = new URL(window.location.href);
                    url.searchParams.delete(param);
                    const newUrl = url.toString();
                    window.location.href = newUrl;
                }

                function deleteParameterJourney() {
                    deleteParameter('j');
                }

                function showDateWarning() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tanggal Tidak Sesuai!',
                        text: 'Masukan Tanggal Lebih dari Tanggal Awal !'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            tanggalH6.textContent = 'Tanggal';
                            dateEndInput.value = '';
                            resetQueryParams();
                        }
                    });
                }
            });
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
                dataAttributes: <?php echo json_encode($dataAttributes); ?>,
                datasets: [{
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
                    },
                    onClick: function(event, elements) {
                        if (elements.length > 0) {
                            console.log('Chart clicked');
                            var dataIndex = elements[0].index;
                            var idLaporan = data.dataAttributes[dataIndex];
                            // console.log('idLaporan:', idLaporan);

                            // Redirect to the controller with id_laporan parameter
                            window.location.href = "<?= site_url('Admin/laporan_detail/') ?>" + idLaporan;
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#captureBtn').click(function() {
                    $('#screenshotResult').empty(); // Clear previous result

                    var element = document.getElementById('capture');

                    html2canvas(element, {
                        useCORS: true
                    }).then(function(canvas) {
                        var screenshotData = canvas.toDataURL('image/jpeg', 0.9);

                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("admin/capture"); ?>',
                            data: {
                                screenshot: screenshotData
                            },
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


        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
        <!-- <script src="path-to-html2canvas/html2canvas.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>