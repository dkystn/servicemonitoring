 <!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Soal</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page"> Kelola soal</li>
         </ol>
     </div>
 </div>
<div class="container"> 
    <div class="row">
        <div class="col-md-2">
            <label for="cabang">Cabang</label>
            <div class="form-group">
                <select class="form-control" name="cabang" id="cabang">
                <option value="">All Cabang</option>
                    <?php foreach ($data_cabang as $row) { ?>
                        <?php $selected = ($cabang == $row->id_cabang) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div id="j" class="col-md-2" style="display:none">
            <label for="journey">Journey</label>
            <div class="form-group">
                <select class="form-control" name="journey" id="journey">
                <option value="">All Journey</option>
                    <?php foreach ($data_journey as $row) { ?>
                        <?php $selected = ($journey == $row->id_journey) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_journey; ?>" <?php echo $selected; ?>><?php echo $row->journey; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-4 col-md-2 mt-4">
                    <!-- <label for="">Export Excel</label> -->
                    <a href="<?= base_url('Admin/excel'); ?>"  ><button type="button" style="margin-bottom: 10px" class="btn btn-success" data-toggle="modal" data-target="#tambahData">
                        <div class="fa fa-edit"></div> Export
                    </button></a> 
                </div>
                <div class="col-6 col-md-5 mt-4 ">
                    <!-- <label for="">Import Excel</label> -->
                    <form id="uploadForm" action="<?php echo base_url() . 'admin/uploaddata'; ?>" method="post" enctype="multipart/form-data">
                        <div class="row" >
                            <div class="col-6 col-md-5">
                                <input type="file" class="hidden" id="importexcel" name="importexcel" accept=".xlsx,.xls" style="display: none;">
                                <button type="button" class="btn btn-info" onclick="chooseFile()"><div class="fa fa-plus"></div> Import</button>
                            </div>
                            
                            <div class="col-6 col-md-4">
                                <button type="submit" class="btn btn-info" id="submitButton" style="display: none;">Submit</button>
                            </div>
                            <div class="col-6 col-md-3">
                                <div id="fileInfo" style="display: none;">
                                    <span id="fileName"></span>
                                    <a href="#" id="removeFile" onclick="removeFile()" style="color:red;"><div class="fa fa-times"></div></a>
                                </div>
                                <div id="progressDiv" style="display: none;">
                                    <progress id="progressBar" value="0" max="100"></progress>
                                    <span id="progressPercent">0%</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
        <div class="col-2 col-md-2 mt-4">
            <!-- <label for="">Delet All Soal</label> -->
            <a  onclick="showConfirmation();"><button type="button" style="margin-bottom: 10px" class="btn btn-danger" >
                <div class="fa fa-trash"></div> Semua
            </button></a> 
            <script>
                function showConfirmation() {
                    $.ajax({
                        url: '<?= base_url('Admin/get_total_soal'); ?>',
                        method: 'GET',
                        success: function(response) {
                            Swal.fire({
                                title: "Apakah Yakin?",
                                text: "Menghapus " + response + " data soal, SOAL TIDAK DAPAT DI PULIHKAN !!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonText: "Hapus!",
                                cancelButtonText: "Batal",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: '<?= base_url('Admin/get_total_soal'); ?>',
                                        method: 'POST', // Anda dapat mengganti metode HTTP sesuai kebutuhan
                                        success: function(response) {
                                            // Menampilkan pesan sukses setelah berhasil menghapus
                                            Swal.fire({
                                                title: "Berhasil",
                                                text: "Berhasil menghapus " + response + " data soal",
                                                icon: "success"
                                            }).then((result) => {
                                                // Jika pengguna menutup pesan sukses, lakukan sesuatu jika perlu
                                                if (result.isConfirmed || result.isDismissed) {
                                                    // Lakukan tindakan lain jika diperlukan
                                                    // Contoh: Redirect ke halaman lain
                                                    window.location.href = '<?= base_url('Admin/delete_all_soal'); ?>';
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            </script>
        </div>
        <script>
            function chooseFile() {
                document.getElementById('importexcel').click();
            }

            document.getElementById('importexcel').addEventListener('change', function() {
                showFileInfo(this.files[0].name);
                showProgress();
            });

            function showFileInfo(fileName) {
                document.getElementById('fileInfo').style.display = 'block';
                document.getElementById('fileName').innerText = fileName;
            }

            function removeFile() {
                document.getElementById('importexcel').value = '';
                document.getElementById('fileInfo').style.display = 'none';
                document.getElementById('progressDiv').style.display = 'none';
                document.getElementById('submitButton').style.display = 'none';
            }

            function showProgress() {
                document.getElementById('progressDiv').style.display = 'block';

                let progressBar = document.getElementById('progressBar');
                let progressPercent = document.getElementById('progressPercent');
                let percent = 0;

                let interval = setInterval(function() {
                    percent += 5;
                    progressBar.value = percent;
                    progressPercent.innerText = percent + '%';

                    if (percent >= 100) {
                        clearInterval(interval);
                        document.getElementById('progressDiv').style.display = 'none';
                        document.getElementById('submitButton').style.display = 'block';
                    }
                }, 200);
            }
        </script>
        <!-- <div class="col-md-2">
            <label for="cabang">Pelabuhan</label>
            <div class="form-group">
                <select class="form-control" name="cabang" id="cabang">
                <option value="">All Pelabuhan</option>
                    <?php foreach ($data_cabang as $row) { ?>
                        <?php $selected = ($id == $row->id_cabang) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <label for="cabang">Kapal</label>
            <div class="form-group">
                <select class="form-control" name="cabang" id="cabang">
                <option value="">All Kapal</option>
                    <?php foreach ($data_cabang as $row) { ?>
                        <?php $selected = ($id == $row->id_cabang) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <label for="cabang">Type Option</label>
            <div class="form-group">
                <select class="form-control" name="cabang" id="cabang">
                <option value="">All Type Option</option>
                    <?php foreach ($data_cabang as $row) { ?>
                        <?php $selected = ($id == $row->id_cabang) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <label for="cabang">Type</label>
            <div class="form-group">
                <select class="form-control" name="cabang" id="cabang">
                <option value="">All Type</option>
                    <?php foreach ($data_cabang as $row) { ?>
                        <?php $selected = ($id == $row->id_cabang) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div> -->
    </div>
    <div class="card">  
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"> Kelola Soal</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="#myBtn">
            + Tambah soal
            </button>
            
        </div>
        <?php
            // Assuming you have $data as your dataset and it's already fetched from your source
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $itemsPerPage = 50;
            $start = ($page - 1) * $itemsPerPage;
            $end = $start + $itemsPerPage;
            $totalRows = count($data);

            // Slice the data to show only the current page
            $dataSlice = array_slice($data, $start, $itemsPerPage);

            $no = $start + 1;
        ?>

        <div class="table-responsive">
            <table class="table align-items-center table-flush" id="tablen">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Jawaban 1</th>
                        <th>Jawaban 2</th>
                        <th>Jawban benar</th>
                        <th>Regional</th>
                        <th>Cabang</th>
                        <th>Type</th>
                        <th>Type Journey</th>
                        <th>Pelabuhan</th>
                        <th>Kapal</th>
                        <th>Type Option</th> 
                        <th>Gambar</th> 
                        <th>Last Input</th> 
                        <th class="text-center" colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataSlice as $d) { ?>
                        <tr class="searchable-item">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d->soal; ?></td>
                            <td><?php echo $d->jawaban_1; ?></td>
                            <td><?php echo $d->jawaban_2; ?></td>
                            <td><?php echo $d->jawaban_benar; ?></td>
                            <td><?php echo $d->regional; ?></td>
                            <td><?php echo $d->cabang; ?></td>
                            <td><?php echo $d->type; ?></td>
                            <td><?php echo $d->journey; ?></td>
                            <td>
                                <?php
                                    $pelabuhan_data = $this->Model_soal->get_pelabuhan_by_id($d->id_pelabuhan);
                                    echo $pelabuhan_data !== null ? $pelabuhan_data->pelabuhan : '-'; // Assuming "nama_pelabuhan" is the column name in the "tabel_pelabuhan" table that you want to display
                                ?>
                            </td>
                            <td>
                                 <?php
                                    $kapal_data = $this->Model_soal->get_kapal_by_id($d->id_kapal);
                                    echo $kapal_data !== null ? $kapal_data->kapal : '-';
                                ?>
                            </td>
                            <td><?php echo $d->type_option; ?></td>
                            <td><?php echo $d->gambar ? 'Wajib' : 'Tidak Wajib' ; ?></td>
                            <td><?php echo $d->last_input; ?></td>
                            <td>
                                <div class="text-center">
                                    <a class="btn btn-warning" href="<?php echo site_url('admin/edit_soal/' . $d->id_soal); ?>" onclick="return confirm('Anda yakin ingin mengedit data ini?');">
                                        edit
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <a class="btn btn-danger" href="<?php echo site_url('admin/hapus_soal/' . $d->id_soal); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            // Display pagination if there are more than $itemsPerPage rows
            if ($totalRows > $itemsPerPage) {
                $totalPages = ceil($totalRows / $itemsPerPage);

                // Define how many pages to show before and after the current page
                $numPagesToShow = 5; // You can adjust this number as needed

                // Calculate the range of pages to display
                $startPage = max(1, $page - $numPagesToShow);
                $endPage = min($totalPages, $page + $numPagesToShow);

            ?>
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo ($page - 1); ?>">Previous</a>
                        </li>
                    <?php } ?>
                    <?php if ($page > 6) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=1">1</a>
                        </li>
                    <?php } ?>

                    <?php if ($startPage > 1) { ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php } ?>

                    <?php for ($i = $startPage; $i <= $endPage; $i++) { ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>

                    <?php if ($endPage < $totalPages) { ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php } ?>

                    <?php if ($page < $totalPages) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $totalPages; ?>"><?php echo $totalPages; ?></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo ($page + 1); ?>">Next</a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>
  
 <!--Row-->
 <div class="card-footer">

 </div>
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Tambah Soal </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
            </div>
            <form class="user mt-2" action="<?php echo base_url() . 'admin/add_soal'; ?>" method="post">
                <div class="container row">
                    <div class="col-md-12">
                         <label for="regional">Regional</label>
                         <div class="form-group">
                             <select class="form-control" name="regional" id="regional2" onchange="cabangByRegional()">
                                 <option value="0">Select Regional</option>
                                 <?php foreach ($data_regional as $row) { ?>
                                    <option value="<?php echo $row->id_regional; ?>" ><?php echo $row->regional; ?></option>
                                <?php } ?>
                             </select>
                         </div>
                     </div>
                    <div class="col-md-12" style="display:none">
                         <label for="cabang">Cabang</label>
                         <div class="form-group">
                             <select class="form-control" name="cabang" id="cabang2"  onchange="getJourneyByCabang()">
                                 <option value="0">Select Cabang</option>
                             </select>
                         </div>
                    </div>
                         <div id="journey" class="col-md-12" style="display:none" >
                             <label for="type_journey">Type Journey</label>
                             <div class="form-group">
                                 <select class="form-control"name="journey" id="journey2"  onchange="getTypeByJourney()">
                                     <option value=" 0">Select Type Journey</option>
                                 </select>
                             </div>
                         </div>
                         <div id="pelabuhan2" class="col-md-12" style="display:none">
                            <label for="pelabuhan">Pelabuhan</label>
                            <div class="form-group">
                                <select class="form-control" name="pelabuhan" id="pelabuhan3" >
                                    <option value="">Select Pelabuhan</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div id="kapal2" class="col-md-12" style="display:none">
                            <label for="kapal">Kapal</label>
                            <div class="form-group">
                                <select class="form-control" name="kapal" id="kapal3">
                                    <option value="">Select Kapal</option>
                                </select>
                            </div>
                        </div>
                        <div id="type" class="col-md-12" style="display:none">
                             <label for="type_option5">Type Journey Option</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_option" id="type_option"  onchange="tampilInput()">
                                     <option value="0">Select Type Journey Option</option>
                                 </select>
                             </div>
                        </div>
                        <div id="type_pertanyaan" class="col-md-12" style="display:none">
                            <label for="type">Type Pertanyaan</label>
                            <div class="form-group">
                                <select class="form-control" name="type" >
                                    <option value="0">Select Type Pertanyaan</option>
                                    <option value="Kendaraan">Kendaraan</option>
                                    <option value="Pejalan Kaki">Pejalan Kaki</option>
                                </select>
                            </div>
                        </div>
                        <div id="soal" class=" col-md-12" style="display:none">
                            <label>Soal</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="soal" id="soal">
                            </div>
                        </div>
                        <div id="j_1" class=" col-md-12" style="display:none">
                            <label>Jawaban 1</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="jawaban_1" id="jawaban_1">
                            </div>
                        </div>
                        <div id="j_2" class=" col-md-12" style="display:none">
                            <label>Jawaban 2</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="jawaban_2" id="jawaban_2">
                            </div>
                        </div>
                        <div id="j_b" class="col-md-12" style="display:none">
                            <label for="jawaban_benar">Jawaban Benar</label>
                            <div class="form-group">
                                <select class="form-control" name="jawaban_benar">
                                    <option value="jawaban_1">Jawaban 1</option>
                                    <option value="jawaban_2">Jawaban 2</option>
                                </select>
                            </div>
                        </div>
                        <div id="gambar" class="col-md-12" style="display:none">
                            <label for="gambar">Gambar</label>
                            <div class="form-group">
                                <select class="form-control" name="gambar" >
                                    <option value="0">Select Status Gambar</option>
                                    <option value="required">Wajib Disi</option>
                                    <option value="">Tidak Wajib Disi</option>
                                </select>
                            </div>
                        </div>
                        
                        <div id="hari" class=" col-md-12" style="display:none">
                            <label>Hari Pengisian</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="hari">
                            </div>
                        </div>
                        <div id="tanggal" class=" col-md-12" style="display:none">
                            <label>Tanggal Berlaku</label>
                            <div class="form-group">
                                <input class="form-control" type="date" name="last_input">
                            </div>
                        </div>
                     <!-- <div class="col-md-12">
                         <label for="gambar_bukti">Gambar</label>
                         <div class="form-group">
                             <input class="form-control" type="text" name="gambar_bukti" id="gambar_bukti">
                         </div>
                     </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
            </form>
         </div>
     </div>
 </div>

 <!---Container Fluid-->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script>
    // Fungsi untuk mendapatkan cabang terbaru dan mengalihkan ke halaman index
    function updateCabangAndRedirect() {
        var newCabang = document.getElementById("cabang").value;
        if (newCabang === "") {
            window.location.href = "<?php echo base_url('Admin/soal/'); ?>";
        }else {
            var baseUrl = "<?php echo base_url('Admin/soal_cabang/'); ?>";
            var url = baseUrl + newCabang ;
            window.location.href = url;
        }
        
    }
    // Tambahkan event listener untuk memanggil fungsi updateCabangAndRedirect saat input cabang berubah
    document.getElementById("cabang").addEventListener("change", updateCabangAndRedirect);
</script>
<script>
    function updatejourneyAndRedirect() {
            var newjourney = document.getElementById("journey").value;
            var cabang = "<?php echo $cabang; ?>"; 
            if (newjourney === "") {
                var baseUrl = "<?php echo base_url('Admin/soal_cabang/'); ?>";
                var url = baseUrl + cabang ;
                window.location.href = url;
            }else {
                var baseUrl = "<?php echo base_url('Admin/soal_journey_cabang/'); ?>";
                var url = baseUrl + cabang + "/"  + newjourney;
                window.location.href = url;
            }
    }
    // Tambahkan event listener untuk memanggil fungsi updatejourneyAndRedirect saat input cabang berubah
    document.getElementById("journey").addEventListener("change", updatejourneyAndRedirect);
</script>


<script>
$(document).ready(function() {
    // Ambil nilai jumlah data yang diinputkan
    var defaultDataCount = 10;
    $('#data-count').on('input', function() {
        var count = parseInt($(this).val());
        filterData(count);
    });

    // Filter data sesuai dengan jumlah yang diinputkan
    function filterData(count) {
        $('#table tbody tr').hide(); // Sembunyikan semua baris

        $('#table tbody tr:lt(' + count + ')').show(); // Tampilkan baris sejumlah count
    }

    // Pencarian data
    $('#search').on('input', function() {
        var keyword = $(this).val().toLowerCase();

        $('#table tbody tr').hide(); // Sembunyikan semua baris

        // Tampilkan baris yang sesuai dengan keyword
        $('#table tbody tr').filter(function() {
            return $(this).text().toLowerCase().includes(keyword);
        }).show();
    });

    // Filter dropdown
    $('.filter-dropdown').on('change', function() {
        var column = $(this).data('column');
        var value = $(this).val();

        $('#table tbody tr').hide(); // Sembunyikan semua baris

        // Tampilkan baris yang sesuai dengan dropdown filter
        $('#table tbody tr').filter(function() {
            return $(this).find('td:eq(' + column + ')').text() === value;
        }).show();
    });
});
</script>

 <script>
     function updateJawabanOptions() {
         var jawaban1 = document.getElementById("jawaban_1").value;
         var jawaban2 = document.getElementById("jawaban_2").value;

         var selectElement = document.getElementsByName("jawaban_benar")[0];
         selectElement.innerHTML = ""; // Menghapus opsi jawaban yang ada sebelumnya

         var option1 = document.createElement("option");
         option1.value = jawaban1;
         option1.text = jawaban1;

         var option2 = document.createElement("option");
         option2.value = jawaban2;
         option2.text = jawaban2;

         selectElement.add(option1);
         selectElement.add(option2);

         // Memperbarui opsi yang dipilih pada "Jawaban Benar" berdasarkan input terbaru
         var selectedOption = selectElement.value;
         if (selectedOption === "jawaban_1") {
             option1.selected = true;
         } else if (selectedOption === "jawaban_2") {
             option2.selected = true;
         }
     }

     document.getElementById("jawaban_1").addEventListener("input", updateJawabanOptions);
     document.getElementById("jawaban_2").addEventListener("input", updateJawabanOptions);
 </script>

 <script>
    function showSubmenu() {
        var selectBoxcabang = document.getElementById("cabang");
        var selectedValuecabang = selectBoxcabang.options[selectBoxcabang.selectedIndex].value;
        // 
        var j = document.getElementById("j");

        if (selectedValuecabang === "") {
        j.style.display = "none"; 
        } else {
        j.style.display = "block"; 
        }

    }

    // Tambahkan event listener untuk memanggil showSubmenu() saat halaman pertama kali dimuat
    window.addEventListener('load', showSubmenu);

    // Tambahkan event listener untuk memanggil showSubmenu() saat terjadi perubahan pada elemen cabang
    var cabangSelect = document.getElementById("cabang");
    cabangSelect.addEventListener('change', showSubmenu);
</script>

<script>
    function cabangByRegional() {
        var selected_regional = $("#regional2").val(); // Mengambil nilai ID regional yang dipilih

            $.ajax({
                url: "<?php echo site_url('admin/get_cabang_by_regional'); ?>",
                type: "POST",
                data: { selected_regional: selected_regional },
                dataType: "json",
                success: function(data) {
                    var cabangDropdown = $("#cabang2");
                    cabangDropdown.empty();
                    cabangDropdown.append('<option value="0">Select Cabang</option>');
                    $.each(data, function(index, value) {
                        cabangDropdown.append('<option value="' + value.id_cabang + '">' + value.cabang + '</option>');
                        var selectedCabang = value.id_cabang;
                    });
                    cabangDropdown.parent().parent().show();
                }
            });
        }

    function getJourneyByCabang() {
    var selected_cabang = $("#cabang2").val(); // Mengambil nilai ID cabang yang dipilih
    var journeyDropdown = $("#journey2");
    
        if (selected_cabang === "0"){
            journeyDropdown.parent().parent().hide(); 
        } else {
            $.ajax({
                url: "<?php echo site_url('admin/getJourneyOptions_post'); ?>",
                type: "POST",
                data: { cabang: selected_cabang },
                dataType: "json",
                success: function(data) {
                    var journeyDropdown = $("#journey2");
                    journeyDropdown.empty();
                    journeyDropdown.append('<option value="0">Select Type Journey</option>');
                    $.each(data, function(index, value) {
                        journeyDropdown.append('<option value="' + value.id_journey + '">' + value.journey + '</option>');
                    });
                    journeyDropdown.parent().parent().show(); 
                }
            });
        }
        
    }
    function getTypeByJourney() {
        var selected_cabang = $("#cabang2").val();
        var selectedJourney = $("#journey2").val();
        var selected_journey = $("#journey2 option:selected").text(); // Get the text of the selected option
        
        var typeDropdown = $("#type");
        var pelabuhan2Dropdown = $("#pelabuhan2");
        var kapalDropdown = $("#kapal2");

        if (selected_journey === "Port Journey") {
            $.ajax({
                    url: "<?php echo site_url('admin/getPelabuhanOptions_post'); ?>",
                    type: "POST",
                    data: { cabang: selected_cabang },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        var pelabuhanDropdown = $("#pelabuhan3");
                        pelabuhanDropdown.empty();
                        pelabuhanDropdown.append('<option value="0">Select Type Option</option>');
                        $.each(data, function(index, value) {
                            pelabuhanDropdown.append('<option value="' + value.id_pelabuhan + '">' + value.pelabuhan + '</option>');
                        });
                        pelabuhanDropdown.parent().parent().show(); 
                        
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", status, error); // Menampilkan pesan error di konsol
                    }
                });

            pelabuhan2Dropdown.show();
            typeDropdown.hide(); 
            kapalDropdown.hide();
        } else if (selected_journey === "On Board Journey") {
            $.ajax({
                    url: "<?php echo site_url('admin/getKapalOptions_post'); ?>",
                    type: "POST",
                    data: { cabang: selected_cabang },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        // console.log("URL: " + "<?php echo site_url('getPelabuhanOptions_'); ?>");
                        // console.log("Data: " + JSON.stringify({ cabang: selected_cabang }));

                        var kapalDropdown = $("#kapal3");
                        kapalDropdown.empty();
                        kapalDropdown.append('<option value="0">Select Type Option</option>');
                        $.each(data, function(index, value) {
                            kapalDropdown.append('<option value="' + value.id_kapal + '">' + value.kapal + '</option>');
                        });
                        kapalDropdown.parent().parent().show();
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", status, error); // Menampilkan pesan error di konsol
                    }
                });
            kapalDropdown.show();
            typeDropdown.hide(); 
            pelabuhan2Dropdown.hide();
        } else {
            $.ajax({
                    url: "<?php echo site_url('admin/getoption_BYjourney'); ?>",
                    type: "POST",
                    data: { id_journey: selectedJourney },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        // console.log("URL: " + "<?php echo site_url('getPelabuhanOptions_'); ?>");
                        // console.log("Data: " + JSON.stringify({ cabang: selected_cabang }));

                        var typeDropdown = $("#type_option");
                        typeDropdown.empty();
                        typeDropdown.append('<option value="0">Select Type Option</option>');
                        $.each(data, function(index, value) {
                            typeDropdown.append('<option value="' + value.id_type_option + '">' + value.type_option + '</option>');
                        });
                        typeDropdown.parent().parent().show(); 
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", status, error); // Menampilkan pesan error di konsol
                    }
                });
            kapalDropdown.hide();
            pelabuhan2Dropdown.hide();
            typeDropdown.show();
        }
    }

    function pelabuhan(){
        var typeDropdown_type = $("#type");
        var selectedPelabuhan = $("#pelabuhan3").val();

        $.ajax({
        url: "<?php echo site_url('admin/getoption_BYpelabuhan'); ?>",
        type: "POST",
        data: { id_pelabuhan: selectedPelabuhan },
        dataType: "json",
        success: function(data) {
            var typeDropdown = $("#type_option");
            typeDropdown.empty();
            typeDropdown.append('<option value="0">Select Type Option</option>');
            $.each(data, function(index, value) {
                typeDropdown.append('<option value="' + value.id_type_option + '">' + value.type_option + '</option>');
            });
            typeDropdown.parent().parent().show(); 
            typeDropdown_type.show();
            },
            error: function(xhr, status, error) {
                onsole.log("Error:", status, error); // Menampilkan pesan error di konsol
            }
        });      
    }
    $("#pelabuhan3").on("change", function() {
        pelabuhan(); // Panggil fungsi pelabuhan di sini
    });

    function kapal(){
        var typeDropdown_type = $("#type");
        var selectedKapal = $("#kapal3").val();

        $.ajax({
        url: "<?php echo site_url('admin/getoption_BYkapal'); ?>",
        type: "POST",
        data: { id_kapal: selectedKapal },
        dataType: "json",
        success: function(data) {

            var typeDropdown = $("#type_option");
            typeDropdown.empty();
            typeDropdown.append('<option value="0">Select Type Option</option>');
            $.each(data, function(index, value) {
                typeDropdown.append('<option value="' + value.id_type_option + '">' + value.type_option + '</option>');
            });
            typeDropdown.parent().parent().show(); 
            typeDropdown_type.show();
            },
            error: function(xhr, status, error) {
                console.log("Error:", status, error); // Menampilkan pesan error di konsol
            }
        });   
    }
    $("#kapal3").on("change", function() {
        kapal(); // Panggil fungsi kapal di sini
    });


    function tampilInput() {
    var selected_type_option = $("#type_option").val(); // Mengambil nilai ID type_option yang dipilih
    console.log(selected_type_option);

    var type_pertanyaan = $("#type_pertanyaan");
    var soal = $("#soal");
    var j_1 = $("#j_1");
    var j_2 = $("#j_2");
    var j_b = $("#j_b");
    var hari = $("#hari");
    var tanggal = $("#tanggal");
    var gambar = $("#gambar");


        if (selected_type_option !== "0"){
            type_pertanyaan.show();
            soal.show();
            j_1.show();
            j_2.show();
            j_b.show();
            hari.show();
            tanggal.show();
            gambar.show();
        } else {
            type_pertanyaan.hide();
            soal.hide();
            j_1.hide();
            j_2.hide();
            j_b.hide();
            hari.hide();
            tanggal.hide();
            gambar.hide();
        }
    }
    

</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        <?php if ($this->session->flashdata('import_message')): ?>
        Swal.fire('Warning', '<?php echo $this->session->flashdata('import_message'); ?>', 'warning');
        <?php endif; ?>
    });
</script>


