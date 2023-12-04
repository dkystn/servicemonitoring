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


 <div class="row">
     <div class="col-lg-12 mb-4">
         <!-- Simple Tables -->
         <div class="filter-container">
    <label for="data-count">Jumlah data:</label>
    <input type="number" id="data-count" min="1" max="100">
    <label for="search">Cari data:</label>
    <input type="text" id="search">
</div>
         <div class="card">
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary"> Kelola Soal</h6>
                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="#myBtn">
                     + Tambah soal
                 </button>
             </div>

             <div class="table-responsive">
                 <table class="table align-items-center table-flush" id="table">
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
                             <th>Type Option</th>
                             <th class="text-center" colspan="2">Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php $no = 1;
                            foreach ($data as $d) { ?>
                             <tr>
                                 <td><?php echo $no++; ?></td>
                                 <td><?php echo $d->soal; ?></td>
                                 <td><?php echo $d->jawaban_1; ?></td>
                                 <td><?php echo $d->jawaban_2; ?></td>
                                 <td><?php echo $d->jawaban_benar; ?></td>
                                 <td><?php echo $d->regional; ?></td>
                                 <td><?php echo $d->cabang; ?></td>
                                 <td><?php echo $d->type; ?></td>
                                 <td><?php echo $d->type_journey; ?></td>
                                 <td><?php echo $d->type_option; ?></td>
                                 <td>
                                     <div class="text-center">
                                         <a class="btn btn-warning" href="<?php echo site_url('element/edit_soal/' . $d->id_soal); ?>" onclick="return confirm('Anda yakin ingin mengedit data ini?');">
                                             edit
                                         </a>
                                     </div>
                                 </td>
                                 <td>

                                     <div class="text-center">
                                         <a class="btn btn-danger" href="<?php echo site_url('element/hapus_soal/' . $d->id_soal); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                             Hapus
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
             <form class="user mt-2" action="<?php echo base_url() . 'Element/add_soal'; ?>" method="post">
                 <div class="container row">
                     <div class="col-md-12">
                         <label for="regional">Regional</label>
                         <div class="form-group">
                             <select class="form-control" name="regional">
                                 <option value="0">Select Regional</option>
                                 <option value="Regional 1">Regional 1</option>
                                 <option value="Regional 2">Regional 2</option>
                                 <option value="Regional 3">Regional 3</option>
                                 <option value="Regional 4">Regional 4</option>
                             </select>
                         </div>
                     </div>
                     <div class="col-md-12">
                         <label for="cabang">Cabang</label>
                         <div class="form-group">
                             <select class="form-control" name="cabang">
                                 <option value="0">Select Cabang</option>
                                 <option value="AMBON">AMBON</option>
                                 <option value="BAKAUHENI">BAKAUHENI</option>
                                 <option value="BALIKPAPAN">BALIKPAPAN</option>
                                 <option value="BANDA ACEH">BANDA ACEH</option>
                                 <option value="BATAM">BATAM</option>
                                 <option value="BATULICIN">BATULICIN</option>
                                 <option value="BAU BAU">BAU BAU</option>
                                 <option value="BIAK">BIAK</option>
                                 <option value="BITUNG">BITUNG</option>
                                 <option value="DANAU TOBA">DANAU TOBA</option>
                                 <option value="JEPARA">JEPARA</option>
                                 <option value="KAYANGAN">KAYANGAN</option>
                                 <option value="KETAPANG">KETAPANG</option>
                                 <option value="KUPANG">KUPANG</option>
                                 <option value="LEMBAR">LEMBAR</option>
                                 <option value="LUWUK">LUWUK</option>
                                 <option value="MERAK">MERAK</option>
                                 <option value="MERAUKE">MERAUKE</option>
                                 <option value="PADANG">PADANG</option>
                                 <option value="PONTIANAK">PONTIANAK</option>
                                 <option value="SAPE">SAPE</option>
                                 <option value="SELAYAR">SELAYAR</option>
                                 <option value="SINGKIL">SINGKIL</option>
                                 <option value="SORONG">SORONG</option>
                                 <option value="SURABAYA">SURABAYA</option>
                                 <option value="TERNATE">TERNATE</option>
                                 <option value="TUAL">TUAL</option>
                             </select>
                         </div>
                     </div>
                     <div class="col-md-12">
                         <label for="type">Type Pertanyaan</label>
                         <div class="form-group">
                             <select class="form-control" name="type" onchange="showSubmenu()">
                                 <option value="0">Select Type Pertanyaan</option>
                                 <option value="Kendaraan">Kendaraan</option>
                                 <option value="Pejalan Kaki">Pejalan Kaki</option>
                             </select>
                         </div>
                     </div>
                     <div id="submenu1" style="display:none">
                         <div class="col-md-12">
                             <label for="type_journey">Type Journey 1</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_journey" onchange="showSubmenu3()">
                                     <option value=" 0">Select Type Journey</option>
                                     <option value="Pre Journey">Pre Journey</option>
                                     <option value="Port Journey">Port Journey</option>
                                     <option value="On Board Journey">On Board Journey</option>
                                     <option value="Post Journey">Post Journey</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <!-- Pre Journey -->
                     <div id="submenu7" style="display:none">
                         <div class="col-md-12">
                             <label for="type_option5">Type Journey Option</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_option5">
                                     <option value="0">Select Type Journey Option</option>
                                     <option value="Informasi">Informasi</option>
                                     <option value="Penjualan Tiket">Penjualan Tiket</option>
                                     <option value="Contact Center Pre">Contact Center Pre</option>
                                     <option value="Petunjuk Jalan">Petunjuk Jalan</option>
                                     <option value="Buffer Zone">Buffer Zone</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <!-- Port Journey -->
                     <div id="submenu8" style="display:none">
                         <div class="col-md-12">
                             <label for="type_option6">Type Journey Option</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_option6">
                                     <option value="0">Select Type Journey Option</option>
                                     <option value="Stopper">Stopper</option>
                                     <option value="Toll Gate">Toll Gate</option>
                                     <option value="Akses Jalan Pelabuhan">Akses Jalan Pelabuhan</option>
                                     <option value="Customer Service">Customer Service</option>
                                     <option value="Petunjuk Menuju Kapal">Petunjuk Menuju Kapal</option>
                                     <option value="Keamanan Port">Keamanan Port</option>
                                     <option value="Toilet Port">Toilet Port</option>
                                     <option value="Announcement Port">Announcement Port</option>
                                     <option value="Parkir Siap Muat">Parkir Siap Muat</option>
                                     <option value="Boarding Area">Boarding Area</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <!-- On Board Journey -->
                     <div id="submenu9" style="display:none">
                         <div class="col-md-12">
                             <label for="type_option7">Type Journey Option</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_option7">
                                     <option value="0">Select Type Journey Option</option>
                                     <option value="Parkir Dek Kendaraan">Parkir Dek Kendaraan</option>
                                     <option value="Petugas Kapal">Petugas Kapal</option>
                                     <option value="Ruang Informasi">Ruang Informasi</option>
                                     <option value="Announcement On Board">Announcement On Board</option>
                                     <option value="Toilet On Board">Toilet On Board</option>
                                     <option value="Ruang Akomodasi">Informasi</option>
                                     <option value="Petunjuk Di Atas Kapal">Petunjuk Di Atas Kapal</option>
                                     <option value="Entertainment On Board">Entertainment On Board</option>
                                     <option value="Keamanan On Board">Keamanan On Board</option>
                                     <option value="Area Komersil">Area Komersil</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <!-- Post Journey -->
                     <div id="submenu10" style="display:none">
                         <div class="col-md-12">
                             <label for="type_option8">Type Journey Option</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_option8">
                                     <option value="0">Select Type Journey Option</option>
                                     <option value="Terminal Peyebrangan Post">Terminal Peyebrangan Post</option>
                                     <option value="Petunjuk Keluar Pelabuhan">Petunjuk Keluar Pelabuhan</option>
                                     <option value="Contact Center">Contact Center</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div id="submenu2" style="display:none">
                         <div class="col-md-12">
                             <label for="type_journey2">Type Journey 2</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_journey2" onchange="showSubmenu2()">
                                     <option value="0">Select Type Journey</option>
                                     <option value="Pre Journey">Pre Journey</option>
                                     <option value="Port Journey">Port Journey</option>
                                     <option value="On Board Journey">On Board Journey</option>
                                     <option value="Post Journey">Post Journey</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <!-- Pre Journey -->
                     <div id="submenu3" style="display:none">
                         <div class="col-md-12">
                             <label for="type_option">Type Journey Option</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_option">
                                     <option value="0">Select Type Journey Option</option>
                                     <option value="Informasi">Informasi</option>
                                     <option value="Penjualan Tiket">Penjualan Tiket</option>
                                     <option value="Contact Center Pre">Contact Center Pre</option>
                                     <option value="Petunjuk Jalan">Petunjuk Jalan</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <!-- Port Journey -->
                     <div id="submenu4" style="display:none">
                         <div class="col-md-12">
                             <label for="type_option2">Type Journey Option</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_option2">
                                     <option value="0">Select Type Journey Option</option>
                                     <option value="Shuttle Bus">Shuttle Bus</option>
                                     <option value="Loket Tiket">Loket Tiket</option>
                                     <option value="Terminal Penyebrangan Port">Terminal Penyebrangan Port</option>
                                     <option value="Customer Services">Customer Services</option>
                                     <option value="Petunjuk Menuju Kapal">Petunjuk Menuju Kapal</option>
                                     <option value="Keamanan Port">Keamanan Port</option>
                                     <option value="Toilet Port">Toilet Port</option>
                                     <option value="Announcement Port">Announcement Port</option>
                                     <option value="Entertainment Port">Entertainment Port</option>
                                     <option value="Ruang Tunggu">Ruang Tunggu</option>
                                     <option value="Boarding Area">Boarding Area</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <!-- On Board Journey -->
                     <div id="submenu5" style="display:none">
                         <div class="col-md-12">
                             <label for="type_option3">Type Journey Option</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_option3">
                                     <option value="0">Select Type Journey Option</option>
                                     <option value="Petugas Kapal">Petugas Kapal</option>
                                     <option value="Ruang Informasi">Ruang Informasi</option>
                                     <option value="Announcement On Board">Announcement On Board</option>
                                     <option value="Toilet On Board">Toilet On Board</option>
                                     <option value="Ruang Akomodasi">Informasi</option>
                                     <option value="Petunjuk Di Atas Kapal">Petunjuk Di Atas Kapal</option>
                                     <option value="Entertainment On Board">Entertainment On Board</option>
                                     <option value="Keamanan On Board">Keamanan On Board</option>
                                     <option value="Area Komersil">Area Komersil</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <!-- Post Journey -->
                     <div id="submenu6" style="display:none">
                         <div class="col-md-12">
                             <label for="type_option4">Type Journey Option</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_option4">
                                     <option value="0">Select Type Journey Option</option>
                                     <option value="Terminal Peyebrangan Post">Terminal Peyebrangan Post</option>
                                     <option value="Toilet Post">Toilet Post</option>
                                     <option value="Transportasi Lanjutan">Transportasi Lanjutan</option>
                                     <option value="Petunjuk Keluar Pelabuhan">Petunjuk Keluar Pelabuhan</option>
                                     <option value="Contact Center">Contact Center</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div class=" col-md-12">
                         <label>Soal</label>
                         <div class="form-group">
                             <input class="form-control" type="text" name="soal" id="soal">
                         </div>
                     </div>
                     <div class=" col-md-12">
                         <label>Jawaban 1</label>
                         <div class="form-group">
                             <input class="form-control" type="text" name="jawaban_1" id="jawaban_1">
                         </div>
                     </div>
                     <div class=" col-md-12">
                         <label>Jawaban 2</label>
                         <div class="form-group">
                             <input class="form-control" type="text" name="jawaban_2" id="jawaban_2">
                         </div>
                     </div>
                     <div class="col-md-12">
                         <label for="jawaban_benar">Jawaban Benar</label>
                         <div class="form-group">
                             <select class="form-control" name="jawaban_benar">
                                 <option value="jawaban_1">Jawaban 1</option>
                                 <option value="jawaban_2">Jawaban 2</option>
                             </select>
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
 </script>