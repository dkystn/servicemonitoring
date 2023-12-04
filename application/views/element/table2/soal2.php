 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"> Laporan</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page"> Laporan</li>
         </ol>
     </div>

     <div class="row">
         <div class="col-lg-12 mb-4">
             <!-- Simple Tables -->
             <div class="card">
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary"> Laporan</h6>

                 </div>
                 <div class="container row">
                     <div class="col-md-12">
                         <label for="regional">Regional</label>
                         <div class="form-group">
                             <select class="form-control" name="regional" id="regional">
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
                             <select class="form-control" name="cabang" id="cabang">
                                 <option value="0">Select Cabang</option>
                                 <option value="AMBON">AMBON</option>
                                 <option value="BAKAUHENI">BAKAUHENI</option>
                                 <option value="BALIKPAPAN">BALIKPAPAN</option>
                                 <option value="BANDA ACEH">BANDA ACEH</option>
                                 <option value="BANGKA">Regional 4</option>
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
                             <select class="form-control" name="type" onchange="showSubmenu()" id="type">
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
                                 <select class="form-control" name="type_journey" onchange="showSubmenu3()" id="type_journey">
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
                                 <select class="form-control" name="type_option5" id="type_option5">
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
                                 <select class="form-control" name="type_option6" id="type_option6">
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
                     <div id="submenu2" style="display:none">
                         <div class="col-md-12">
                             <label for="type_journey2">Type Journey 2</label>
                             <div class="form-group">
                                 <select class="form-control" name="type_journey2" onchange="showSubmenu2()" id="type_journey2">
                                     <option value="0">Select Type Journey</option>
                                     <option value="Pre Journey">Pre Journey</option>
                                     <option value="Port Journey">Port Journey</option>
                                     <option value="On Board Journey">On Board Journey</option>
                                     <option value="Post Journey">Post Journey</option>
                                 </select>
                             </div>
                         </div>
                     </div>

                     <div id="result"></div>
                 </div>
             </div>
         </div>
         <!--Row-->
     </div>
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
                 submenu2.style.display = "none";
                 submenu3.style.display = "none";
                 submenu4.style.display = "none";
                 submenu5.style.display = "none";
                 submenu6.style.display = "none";
             } else if (selectedValue === "Pejalan Kaki") {
                 submenu2.style.display = "block";
                 submenu1.style.display = "none";
                 submenu7.style.display = "none";
                 submenu8.style.display = "none";
                 submenu9.style.display = "none";
                 submenu10.style.display = "none";
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
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
         $(document).ready(function() {
             // Tambahkan event listener untuk perubahan nilai dropdown "Regional"
             $('#regional').change(function() {
                 var selectedRegional = $(this).val(); // Ambil nilai yang dipilih dari dropdown "Regional"
                 var selectedCabang = $('#cabang').val(); // Ambil nilai yang dipilih dari dropdown "Cabang"
                 var selectedType = $('#type').val(); // Ambil nilai yang dipilih dari dropdown "Type Pertanyaan"

                 // Hanya melakukan permintaan Ajax jika regional yang dipilih bukan "Select Regional", cabang yang dipilih bukan "Select Cabang", dan tipe yang dipilih bukan "Select Type Pertanyaan"
                 if (selectedRegional !== '0' && selectedCabang !== '0' && selectedType !== '0') {
                     // Kirim permintaan Ajax ke server
                     $.ajax({
                         url: "<?php echo base_url('ajax-controller/get-filtered-data'); ?>",
                         type: "POST",
                         dataType: "json",
                         data: {
                             regional: selectedRegional,
                             cabang: selectedCabang,
                             type: selectedType // Tambahkan nilai dropdown "Type Pertanyaan" ke data yang dikirim ke server
                         },
                         success: function(response) {
                             // Tangani respons dari server
                             if (response.length > 0) {
                                 var resultHtml = '';
                                 for (var i = 0; i < response.length; i++) {
                                     resultHtml += '<p> Field 1: ' + response[i].soal + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].regional + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].cabang + '</p>';
                                     resultHtml += '<p> Field 3: ' + response[i].type_journey + '</p>'; // Ganti 'field_name' dengan nama kolom yang ingin ditampilkan
                                 }
                                 $('#result').html(resultHtml);
                             } else {
                                 $('#result').html('No data available.');
                             }
                         },
                         error: function(xhr, status, error) {
                             console.log(error);
                         }
                     });
                 } else {
                     $('#result').html('');
                 }
             });

             // Tambahkan event listener untuk perubahan nilai dropdown "Cabang"
             $('#cabang').change(function() {
                 var selectedRegional = $('#regional').val(); // Ambil nilai yang dipilih dari dropdown "Regional"
                 var selectedCabang = $(this).val(); // Ambil nilai yang dipilih dari dropdown "Cabang"
                 var selectedType = $('#type').val(); // Ambil nilai yang dipilih dari dropdown "Type Pertanyaan"

                 // Hanya melakukan permintaan Ajax jika regional yang dipilih bukan "Select Regional", cabang yang dipilih bukan "Select Cabang", dan tipe yang dipilih bukan "Select Type Pertanyaan"
                 if (selectedRegional !== '0' && selectedCabang !== '0' && selectedType !== '0') {
                     // Kirim permintaan Ajax ke server
                     $.ajax({
                         url: "<?php echo base_url('ajax-controller/get-filtered-data'); ?>",
                         type: "POST",
                         dataType: "json",
                         data: {
                             regional: selectedRegional,
                             cabang: selectedCabang,
                             type: selectedType // Tambahkan nilai dropdown "Type Pertanyaan" ke data yang dikirim ke server
                         },
                         success: function(response) {
                             // Tangani respons dari server
                             if (response.length > 0) {
                                 var resultHtml = '';
                                 for (var i = 0; i < response.length; i++) {
                                     resultHtml += '<p> Field 1: ' + response[i].soal + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].regional + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].cabang + '</p>';
                                     resultHtml += '<p> Field 3: ' + response[i].type_journey + '</p>'; // Ganti 'field_name' dengan nama kolom yang ingin ditampilkan
                                 }
                                 $('#result').html(resultHtml);
                             } else {
                                 $('#result').html('No data available.');
                             }
                         },
                         error: function(xhr, status, error) {
                             console.log(error);
                         }
                     });
                 } else {
                     $('#result').html('');
                 }
             });

             // Tambahkan event listener untuk perubahan nilai dropdown "Type Pertanyaan"
             $('#type').change(function() {
                 var selectedRegional = $('#regional').val(); // Ambil nilai yang dipilih dari dropdown "Regional"
                 var selectedCabang = $('#cabang').val(); // Ambil nilai yang dipilih dari dropdown "Cabang"
                 var selectedType = $(this).val(); // Ambil nilai yang dipilih dari dropdown "Type Pertanyaan"
                 var selectedTypeJourney = $('#type_journey').val();
                 var selectedTypeJourney2 = $('#type_journey2').val();

                 // Hanya melakukan permintaan Ajax jika regional yang dipilih bukan "Select Regional", cabang yang dipilih bukan "Select Cabang", dan tipe yang dipilih bukan "Select Type Pertanyaan"
                 if (selectedRegional !== '0' && selectedCabang !== '0' && selectedType !== '0') {
                     // Kirim permintaan Ajax ke server
                     $.ajax({
                         url: "<?php echo base_url('ajax-controller/get-filtered-data'); ?>",
                         type: "POST",
                         dataType: "json",
                         data: {
                             regional: selectedRegional,
                             cabang: selectedCabang,
                             type: selectedType // Tambahkan nilai dropdown "Type Pertanyaan" ke data yang dikirim ke server
                         },
                         success: function(response) {
                             // Tangani respons dari server
                             if (response.length > 0) {
                                 var resultHtml = '';
                                 for (var i = 0; i < response.length; i++) {
                                     resultHtml += '<p> Field 1: ' + response[i].soal + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].regional + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].cabang + '</p>';
                                     resultHtml += '<p> Field 3: ' + response[i].type_journey + '</p>'; // Ganti 'field_name' dengan nama kolom yang ingin ditampilkan
                                 }
                                 $('#result').html(resultHtml);
                             } else {
                                 $('#result').html('No data available.');
                             }
                         },
                         error: function(xhr, status, error) {
                             console.log(error);
                         }
                     });
                 } else {
                     $('#result').html('');
                 }
             });
             $('#type_journey').change(function() {
                 var selectedRegional = $('#regional').val();
                 var selectedCabang = $('#cabang').val();
                 var selectedType = $('#type').val();
                 var selectedTypeJourney = $(this).val();

                 // Hanya melakukan permintaan Ajax jika tipe journey yang dipilih bukan "Select Type Journey"
                 if (selectedTypeJourney !== '0') {
                     // Kirim permintaan Ajax ke server
                     $.ajax({
                         url: "<?php echo base_url('ajax-controller/get-filtered-data'); ?>",
                         type: "POST",
                         dataType: "json",
                         data: {
                             regional: selectedRegional,
                             cabang: selectedCabang,
                             type: selectedType,
                             type_journey: selectedTypeJourney
                         },
                         success: function(response) {
                             // Tangani respons dari server
                             if (response.length > 0) {
                                 var resultHtml = '';
                                 for (var i = 0; i < response.length; i++) {
                                     resultHtml += '<p> Field 1: ' + response[i].soal + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].regional + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].cabang + '</p>';
                                     resultHtml += '<p> Field 3: ' + response[i].type_journey + '</p>'; // Ganti 'field_name' dengan nama kolom yang ingin ditampilkan
                                 }
                                 $('#result').html(resultHtml);
                             } else {
                                 $('#result').html('No data available.');
                             }
                         },
                         error: function(xhr, status, error) {
                             console.log(error);
                         }
                     });
                 } else {
                     $('#result').html('');
                 }
             });

             // Tambahkan event listener untuk perubahan nilai dropdown "Type Journey 2"
             $('#type_journey2').change(function() {
                 var selectedRegional = $('#regional').val();
                 var selectedCabang = $('#cabang').val();
                 var selectedType = $('#type').val();
                 var selectedTypeJourney2 = $(this).val();

                 // Hanya melakukan permintaan Ajax jika tipe journey yang dipilih bukan "Select Type Journey"
                 if (selectedTypeJourney2 !== '0') {
                     // Kirim permintaan Ajax ke server
                     $.ajax({
                         url: "<?php echo base_url('ajax-controller/get-filtered-data'); ?>",
                         type: "POST",
                         dataType: "json",
                         data: {
                             regional: selectedRegional,
                             cabang: selectedCabang,
                             type: selectedType,
                             type_journey2: selectedTypeJourney2
                         },
                         success: function(response) {
                             // Tangani respons dari server
                             if (response.length > 0) {
                                 var resultHtml = '';
                                 for (var i = 0; i < response.length; i++) {
                                     resultHtml += '<p> Field 1: ' + response[i].soal + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].regional + '</p>';
                                     resultHtml += '<p> Field 2: ' + response[i].cabang + '</p>';
                                     resultHtml += '<p> Field 3: ' + response[i].type_journey + '</p>'; // Ganti 'field_name' dengan nama kolom yang ingin ditampilkan
                                 }
                                 $('#result').html(resultHtml);
                             } else {
                                 $('#result').html('No data available.');
                             }
                         },
                         error: function(xhr, status, error) {
                             console.log(error);
                         }
                     });
                 } else {
                     $('#result').html('');
                 }
             });

         });
     </script>