 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"> Type Option</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page"> Kelola Type Option</li>
         </ol>
     </div>
 </div>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <label for="cabang">Cabang</label>
            <div class="form-group">
                <select class="form-control" name="cabang" id="cabang" onchange="showSubmenu()">
                <option value="">All Cabang</option>
                    <?php foreach ($data_cabang as $row) { ?>
                        <?php $selected = ($cabang == $row->id_cabang) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div id="submenu1" class="col-md-2"  style="display:none">
            <label for="journey">Journey</label>
            <div class="form-group">
                <select class="form-control" name="journey" id="journey" onchange="showSubmenu2()">
                <option value="">All Journey</option>
                    <?php foreach ($data_journey as $row) { ?>
                        <?php $selected = ($journey == $row->id_journey) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_journey; ?>" <?php echo $selected; ?>><?php echo $row->journey; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- <div id="submenu2" class="col-md-2"  style="display:none">
            <label for="pelabuhan">Pelabuhan</label>
            <div class="form-group">
                <select class="form-control" name="pelabuhan" id="pelabuhan" onchange="showSubmenu3()">
                <option value="">All Pelabuhan</option>
                    <?php foreach ($data_pelabuhan as $row) { ?>
                        <?php $selected = ($pelabuhan == $row->id_pelabuhan) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_pelabuhan; ?>" <?php echo $selected; ?>><?php echo $row->pelabuhan; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div id="submenu3" class="col-md-2"  style="display:none">
            <label for="kapal">Kapal</label>
            <div class="form-group">
                <select class="form-control" name="kapal" id="kapal">
                <option value="">All Kapal</option>
                    <?php foreach ($data_kapal as $row) { ?>
                        <?php $selected = ($id == $row->id_kapal) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_kapal; ?>" <?php echo $selected; ?>><?php echo $row->kapal; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div> -->
    </div>
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"> Kelola Type Option</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="#myBtn">
                + Tambah Type Option
            </button>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush" id="tablen">
               <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Cabang</th>
                        <th>Journey</th>
                        <th>Pelabuhan</th>
                        <th>Kapal</th>
                        <th>Type Option</th>
                        <th class="text-center"  >Aksi</th>
                    </tr>
            </thead>
            <tbody>
                         <?php $no = 1;
                            foreach ($data as $d) { ?>
                             <tr class="searchable-item">
                                 <td><?php echo $no++; ?></td>
                                 <td>
                                    <?php
                                        $cabang_data = $this->Model_soal->get_cabang_by_id($d->id_cabang);
                                        echo $cabang_data !== null ? $cabang_data->cabang : '-';
                                        ?>
                                </td>
                                <td>
                                    <?php
                                        $journey_data = $this->Model_soal->get_journey_by_id($d->id_journey);
                                        echo $journey_data !== null ? $journey_data->journey : '-';
                                        ?>
                                </td>
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
                                 <td>
                                 <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-end align-items-end">
                                                    <a class="btn btn-warning" href="<?php echo site_url('admin/edit_type_option/' . $d->id_type_option); ?>" onclick="return confirm('Anda yakin ingin mengedit data ini?');">
                                                        edit
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="order-first">
                                                    <a class="btn btn-danger" href="<?php echo site_url('admin/hapus_type_option/' . $d->id_type_option); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                                        Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                 </td>
                             </tr>
                         <?php } ?>
            </tbody>
        </table>
    </div>
</div>
  
 <!--Row-->
 <div class="card-footer"></div>
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
             <form class="user mt-2" action="<?php echo base_url() . 'admin/add_type_option'; ?>" method="post">
                 <div class="container row">
                     <div class="col-md-12">
                     <label for="cabang">Cabang</label>
                        <div class="form-group">
                            <select class="form-control" name="cabang" id="cabang2"  onchange="showSubmenu4()">
                            <option value="">All Cabang</option>
                                <?php 
                                foreach ($data_cabang as $row) { ?>
                                    <?php $selected = ($cabang == $row->id_cabang) ? "selected" : ""; ?>
                                    <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                     </div>
                     
                     <div id="submenu4"  class="col-md-12" style="display:none">
                             <label for="type_journey">Type Journey </label>
                             <div class="form-group">
                                <select class="form-control" name="journey" id="journey2" >
                                <option value="">All Journey</option>
                                    
                                </select>
                             </div> 
                     </div>
                      <!-- Pelabuhan -->
                      <div id="pelabuhan2" class="col-md-12" style="display:none">
                            <label for="pelabuhan">Pelabuhan</label>
                            <div class="form-group">
                                <select class="form-control" name="pelabuhan" id="pelabuhan3">
                                    <option value="">Select Pelabuhan</option>
                                    
                                </select>
                            </div>
                        </div>
                        
                        <!-- Kapal -->
                        <div id="kapal2" class="col-md-12" style="display:none">
                            <label for="kapal">Kapal</label>
                            <div class="form-group">
                                <select class="form-control" name="kapal" id="kapal3">
                                    <option value="">Select Kapal</option>
                                    
                                </select>
                            </div>
                        </div>
                     <div id="type" class=" col-md-12" style="display:none">
                         <label>Type option</label>
                         <div class="form-group">
                             <input class="form-control" type="text" name="type_option" id="type_option">
                         </div>
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

 <!---Container Fluid-->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- Tambahkan script ini di bagian head atau sebelum penutup body </body> -->
<script>
    function showSubmenu() {
        var selectBoxcabang = document.getElementById("cabang");
        var selectedValuecabang = selectBoxcabang.options[selectBoxcabang.selectedIndex].value;
        // 
        var submenu1 = document.getElementById("submenu1");
        var submenu2 = document.getElementById("submenu2");
        var submenu3 = document.getElementById("submenu3");

        if (selectedValuecabang === "") {
        submenu1.style.display = "none"; 
        submenu2.style.display = "none";
        submenu3.style.display = "none";
        } else {
        submenu1.style.display = "block"; 
        submenu2.style.display = "none";
        submenu3.style.display = "none";
        }

    }

    // Tambahkan event listener untuk memanggil showSubmenu() saat halaman pertama kali dimuat
    window.addEventListener('load', showSubmenu);

    // Tambahkan event listener untuk memanggil showSubmenu() saat terjadi perubahan pada elemen cabang
    var cabangSelect = document.getElementById("cabang");
    cabangSelect.addEventListener('change', showSubmenu);
</script>
<script>
    function showSubmenu2() {
        var selectBoxjourney = document.getElementById("journey");
        var selectedIndex = selectBoxjourney.selectedIndex;
        var selectedTextjourney = selectBoxjourney.options[selectedIndex].text;

        var submenu1 = document.getElementById("submenu1");
        var submenu2 = document.getElementById("submenu2");
        var submenu3 = document.getElementById("submenu3");

        if (selectedTextjourney === "Port Journey") {
            submenu2.style.display = "block";
            submenu3.style.display = "none"; 
        } else if (selectedTextjourney === "On Board Journey") {
            submenu3.style.display = "block";
            submenu2.style.display = "none"; 
        } else {
            submenu2.style.display = "none";
            submenu3.style.display = "none";
        }
    }

    // Tambahkan event listener untuk memanggil showSubmenu2() saat halaman pertama kali dimuat
    window.addEventListener('load', showSubmenu2);
    
    var journeySelect = document.getElementById("journey");
    journeySelect.addEventListener('change', showSubmenu2);
</script>
<!-- <script>
    function showSubmenu3() {
        var selectBoxpelabuhan = document.getElementById("pelabuhan");
        var selectedValuepelabuhan = selectBoxpelabuhan.options[selectBoxpelabuhan.selectedIndex].value;

       
        // 
        var submenu1 = document.getElementById("submenu1");
        var submenu2 = document.getElementById("submenu2");
        var submenu3 = document.getElementById("submenu3");

        if (selectedTextjourney === "Port Journey") {
            submenu1.style.display = "block";
            submenu2.style.display = "block";
        } else {
            submenu2.style.display = "none";
        }

    }

    // Tambahkan event listener untuk memanggil showSubmenu() saat halaman pertama kali dimuat
    window.addEventListener('load', showSubmenu3);

    // Tambahkan event listener untuk memanggil showSubmenu() saat terjadi perubahan pada elemen pelabuhan
    
    var pelabuhanSelect = document.getElementById("pelabuhan");
    pelabuhanSelect.addEventListener('change', showSubmenu3);
</script> -->
<!-- Pastikan Anda sudah mengimpor jQuery sebelum menggunakan $.ajax -->
<script>
    function showSubmenu4() {
        var selectBoxCabang = document.getElementById("cabang2");
        var selectedValueCabang = selectBoxCabang.options[selectBoxCabang.selectedIndex].value;
        var submenu4 = document.getElementById("submenu4");
        var pelabuhan = document.getElementById("pelabuhan2");
        var kapal = document.getElementById("kapal2");
        var type = document.getElementById("type");

        if (selectedValueCabang === "") {
            submenu4.style.display = "none";
            pelabuhan.style.display = "none";
            kapal.style.display = "none";
            type.style.display = "none";
        } else {
            $.ajax({
                url: "<?= base_url('Admin/getJourneyOptions') ?>",
                method: "GET",
                data: { cabang: selectedValueCabang },
                dataType: "json",
                success: function(response) {
                    var journeySelect = document.getElementById("journey2");
                    journeySelect.innerHTML = "<option value=''>All Journey</option>";

                    for (var i = 0; i < response.length; i++) {
                        var option = document.createElement("option");
                        option.value = response[i].id_journey;
                        option.textContent = response[i].journey;
                        journeySelect.appendChild(option);
                    }

                    // Panggil fungsi tampilkanJourney() untuk menangani tampilan
                    tampilkanJourney(journeySelect);
                    // type.style.display = "none";
                }
            });
        }
    }

    function tampilkanJourney(selectElement) {
        var selectedJourney = selectElement.options[selectElement.selectedIndex].text;

        var pelabuhan = document.getElementById("pelabuhan2");
        var kapal = document.getElementById("kapal2");
        var type = document.getElementById("type");

        var selectBoxCabang = document.getElementById("cabang2");
        var selectedValueCabang = selectBoxCabang.options[selectBoxCabang.selectedIndex].value;

        if (selectedJourney === "Port Journey") {
            $.ajax({
                url: "<?= base_url('Admin/getPelabuhanOptions_') ?>",
                method: "GET",
                data: { cabang: selectedValueCabang },
                dataType: "json",
                success: function(response) {
                    console.log(response); 
                    var pelabuhanSelect = document.getElementById("pelabuhan3");
                    pelabuhanSelect.innerHTML = "<option value=''>All Pelabuhan</option>";

                    for (var i = 0; i < response.length; i++) {
                        var option = document.createElement("option");
                        option.value = response[i].id_pelabuhan;
                        option.textContent = response[i].pelabuhan;
                        console.log(option); 
                        pelabuhanSelect.appendChild(option);
                    }
                    tampilkanPelabuhan(pelabuhanSelect);
                    // Setelah opsi pelabuhan ditambahkan, tampilkan elemen pelabuhan
                    // pelabuhan.style.display = "block";
                    // kapal.style.display = "none";
                    // type.style.display = "none";

                }
            });
        } else if (selectedJourney === "On Board Journey") {
            $.ajax({
                url: "<?= base_url('Admin/getKapalOptions_') ?>",
                method: "GET",
                data: { cabang: selectedValueCabang },
                dataType: "json",
                success: function(response) {
                    console.log(response); 
                    var kapalSelect = document.getElementById("kapal3");
                    kapalSelect.innerHTML = "<option value=''>All Kapal</option>";

                    for (var i = 0; i < response.length; i++) {
                        var option = document.createElement("option");
                        option.value = response[i].id_kapal;
                        option.textContent = response[i].kapal;
                        console.log(option); 
                        kapalSelect.appendChild(option);
                    }
                    tampilkanKapal(kapalSelect);
                    // Setelah opsi pelabuhan ditambahkan, tampilkan elemen pelabuhan
                    // pelabuhan.style.display = "none";
                    // kapal.style.display = "block";
                    // type.style.display = "none";
                }
            });
        } else if (selectedJourney === "Pre Journey" || selectedJourney === "Post Journey") {
            kapal.style.display = "none";
            pelabuhan.style.display = "none";
            type.style.display = "block";
        }

        var submenu4 = document.getElementById("submenu4");
        submenu4.style.display = "block";
    }


    var pelabuhanSelect = document.getElementById("pelabuhan3");

    // Add an event listener to the dropdown
    pelabuhanSelect.addEventListener("change", function() {
        tampilkanPelabuhan(pelabuhanSelect);
    });
    function tampilkanPelabuhan(pelabuhanSelect) {
        var selectedPelabuhan = pelabuhanSelect.options[pelabuhanSelect.selectedIndex].value;
        var type = document.getElementById("type");
        var pelabuhan2 = document.getElementById("pelabuhan2"); // Renamed to avoid conflict
        var kapal = document.getElementById("kapal2");
        pelabuhan2.style.display = "block";

        if (selectedPelabuhan === "") {
            pelabuhan2.style.display = "block";
            kapal.style.display = "none";
            type.style.display = "none";
            console.log("kosong");
        } else {
            type.style.display = "block";
            pelabuhan2.style.display = "block";
            kapal.style.display = "none";
            console.log("ada");
        }
        console.log(selectedPelabuhan);

        // var submenu4 = document.getElementById("submenu4");
        // submenu4.style.display = "block";
    }

    tampilkanPelabuhan(pelabuhanSelect);
    
    // 
    // 
    var kapalSelect = document.getElementById("kapal3");

    // Add an event listener to the dropdown
    kapalSelect.addEventListener("change", function() {
        tampilkanKapal(kapalSelect);
    });
    function tampilkanKapal(kapalSelect) {
        var selectedKapal = kapalSelect.options[kapalSelect.selectedIndex].value;
        var type = document.getElementById("type");
        var kapal2 = document.getElementById("kapal2"); // Renamed to avoid conflict
        var pelabuhan = document.getElementById("pelabuhan2");

        kapal2.style.display = "block";

        if (selectedKapal === "") {
            kapal2.style.display = "block";
            pelabuhan.style.display = "none";
            type.style.display = "none";
            console.log("kosong");
        } else {
            type.style.display = "block";
            kapal2.style.display = "block";
            pelabuhan.style.display = "none";
            console.log("ada");
        }
        console.log(selectedKapal);

        // var submenu4 = document.getElementById("submenu4");
        // submenu4.style.display = "block";
    }

    tampilkanKapal(kapalSelect);
    // 
    // Panggil showSubmenu4() saat halaman pertama kali dimuat
    window.addEventListener('load', showSubmenu4);

    // Panggil showSubmenu4() saat terjadi perubahan pada elemen cabang
    var cabangSelect2 = document.getElementById("cabang2");
    cabangSelect2.addEventListener('change', showSubmenu4);

    // Panggil tampilkanJourney() saat terjadi perubahan pada elemen journey2
    var journeySelect = document.getElementById("journey2");
    journeySelect.addEventListener('change', function() {
        tampilkanJourney(journeySelect);
    });
</script>






<script>
    // Fungsi untuk mendapatkan cabang terbaru dan mengalihkan ke halaman index
    function updateCabangAndRedirect() {
        var newCabang = document.getElementById("cabang").value;
        if (newCabang === "") {
            window.location.href = "<?php echo base_url('Admin/typeoption_null/'); ?>";
        }else {
            var baseUrl = "<?php echo base_url('Admin/typeoption/'); ?>";
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
                var baseUrl = "<?php echo base_url('Admin/typeoption/'); ?>";
                var url = baseUrl + cabang ;
                window.location.href = url;
            }else {
                var baseUrl = "<?php echo base_url('Admin/journey_cabang/'); ?>";
                var url = baseUrl + cabang + "/"  + newjourney;
                window.location.href = url;
            }
    }
    // Tambahkan event listener untuk memanggil fungsi updatejourneyAndRedirect saat input cabang berubah
    document.getElementById("journey").addEventListener("change", updatejourneyAndRedirect);
</script>

<!-- <script>
    function updatepelabuhanAndRedirect() {
            var newpelabuhan = document.getElementById("pelabuhan").value;
            var cabang = "<?php echo $cabang; ?>"; 
            var journey = "<?php echo $journey; ?>";
            if (newpelabuhan === "") {
                var baseUrl = "<?php echo base_url('Admin/journey_cabang/'); ?>";
                var url = baseUrl + cabang + "/"  + journey;
                window.location.href = url;
            }else {
                var baseUrl = "<?php echo base_url('Admin/pelabuhan_newpelabuhan/'); ?>";
                var url = baseUrl + cabang + "/"  + journey + "/"  + newpelabuhan;
                window.location.href = url;
            }
    }
    // Tambahkan event listener untuk memanggil fungsi updatepelabuhanAndRedirect saat input cabang berubah
    document.getElementById("pelabuhan").addEventListener("change", updatepelabuhanAndRedirect);
</script> -->
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
 <!-- <script>
     function showSubmenu() {
         var selectBox = document.getElementsByName("type")[0];
         var selectedValue = selectBox.options[selectBox.selectedIndex].value;
         var submenu1 = document.getElementById("submenu1");
         var submenu2 = document.getElementById("submenu2");

         submenu1.style.display = "none";
         submenu2.style.display = "none";

         if (selectedValue === "Kendaraan") {
             submenu1.style.display = "block";
         } else if (selectedValue === "Pejalan Kaki") {
             submenu2.style.display = "block";
         }
     }

     function showSubmenu2() {
         var selectBox = document.getElementsByName("type_journey2")[0];
         var selectedValue = selectBox.options[selectBox.selectedIndex].value;
         var submenu3 = document.getElementById("submenu3");

         submenu3.style.display = "none";
         submenu4.style.display = "none";
         submenu5.style.display = "none";
         submenu6.style.display = "none";


         if (selectedValue === "Pre Journey") {
             submenu3.style.display = "block";
             submenu4.style.display = "none";
             submenu5.style.display = "none";
             submenu6.style.display = "none";
         } else if (selectedValue === "Port Journey") {
             submenu4.style.display = "block";
             submenu3.style.display = "none";
             submenu5.style.display = "none";
             submenu6.style.display = "none";
         } else if (selectedValue === "On Board Journey") {
             submenu5.style.display = "block";
             submenu3.style.display = "none";
             submenu4.style.display = "none";
             submenu6.style.display = "none";
         } else if (selectedValue === "Post Journey") {
             submenu6.style.display = "block";
             submenu3.style.display = "none";
             submenu4.style.display = "none";
             submenu5.style.display = "none";
         }
     }

     function showSubmenu3() {
         var selectBox = document.getElementsByName("type_journey")[0];
         var selectedValue = selectBox.options[selectBox.selectedIndex].value;
         var submenu3 = document.getElementById("submenu7");

         submenu7.style.display = "none";
         submenu8.style.display = "none";
         submenu9.style.display = "none";
         submenu10.style.display = "none";


         if (selectedValue === "Pre Journey") {
             submenu7.style.display = "block";
             submenu8.style.display = "none";
             submenu9.style.display = "none";
             submenu10.style.display = "none";
         } else if (selectedValue === "Port Journey") {
             submenu8.style.display = "block";
             submenu7.style.display = "none";
             submenu9.style.display = "none";
             submenu10.style.display = "none";
         } else if (selectedValue === "On Board Journey") {
             submenu9.style.display = "block";
             submenu7.style.display = "none";
             submenu8.style.display = "none";
             submenu10.style.display = "none";
         } else if (selectedValue === "Post Journey") {
             submenu10.style.display = "block";
             submenu7.style.display = "none";
             submenu8.style.display = "none";
             submenu9.style.display = "none";
         }

     }
 </script> -->