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
                 <form id="form_id" action="<?= base_url('pegawai/laporan') ?>" method="post" enctype="multipart/form-data">
                 <div class="container ">
                     <div class="row">
                         <div class="col-md-12 mb-3">
                             <span>Nama</span>
                         </div>
                         <div class="col-md-12 mb-3">
                             <input class="form-control" type="text" name="nama" id="nama" >
                         </div>
                         <div class="col-md-12  mb-3">
                             <span>Tanggal</span>
                         </div>
                         <div class="col-md-12  mb-3">
                         <input type="date" class="form-control" name="tanggal" id="tanggal" readonly>
                        </div>
                        
                        <div class="col-md-12">
                             <label for="regional">Regional</label>
                             <div class="form-group">
                                 <select class="form-control" name="regional">
                                    <option value="<?php echo $regional; ?>" disable><?php echo $regional; ?></option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <label for="cabang">Cabang</label>
                             <div class="form-group">
                                 <select class="form-control" name="cabang" >
                                    <option value="<?php echo $cabang; ?>" disable><?php echo $cabang; ?></option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-12 col-lg-4">
                             <label for="type">Type Pertanyaan</label>
                             <div class="form-group">
                                 <select class="form-control" name="type" onchange="showSubmenu()">
                                     <option value="0">Select Type Pertanyaan</option>
                                     <option value="Kendaraan">Kendaraan</option>
                                     <option value="Pejalan Kaki">Pejalan Kaki</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-12 col-lg-4" id="submenu1" style="display:none">
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
                         <!-- Pre Journey -->
                         <div class="col-12 col-lg-4" id="submenu7" style="display:none">
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
                         <!-- Port Journey -->
                         <div class="col-12 col-lg-4" id="submenu8" style="display:none">
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
                         <!-- On Board Journey -->
                         <div class="col-12 col-lg-4"  id="submenu9" style="display:none">
                                 <label for="type_option7">Type Journey Option</label>
                                 <div class="form-group">
                                     <select class="form-control" name="type_option7" id="type_option7">
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
                         <!-- Post Journey -->
                         <div class="col-12 col-lg-4" id="submenu10" style="display:none">
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
                             <div cass="col-12 col-lg-4" id="submenu2" style="display:none">
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
                         <!-- Pre Journey -->
                         <div class="col-12 col-lg-4" id="submenu3" style="display:none">
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
                         <!-- Port Journey -->
                         <div class="col-12 col-lg-4" id="submenu4" style="display:none">
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
                         <!-- On Board Journey -->
                         <div class="col-12 col-lg-4" id="submenu5" style="display:none">
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
                         <!-- Post Journey -->
                         <div class="col-12 col-lg-4" id="submenu6" style="display:none">
                                 <label for="type_option4">Type Journey Option</label>
                                 <div class="form-group">
                                     <select class="form-control" name="type_option4">
                                         <option value="0">Select Type Journey Option</option>
                                         <option value="Terminal Peyebrangan Post">Terminal Peyebrangan Post</option>
                                         <option value="Toilet Post">Penjualan Tiket</option>
                                         <option value="Transportasi Lanjutan">Transportasi Lanjutan</option>
                                         <option value="Petunjuk Keluar Pelabuhan">Petunjuk Keluar Pelabuhan</option>
                                         <option value="Contact Center">Contact Center</option>
                                     </select>
                                 </div>
                             </div>
                     </div>
                 </div>
                 <div id="result" style="font-size: 15px;"></div>
                 <div id="response-message"></div>
                 <div class="container">
                     <div class="row">
                         <div class="col-md-12 text-center mt-4 mb-4">
                         <button type="submit" class="btn btn-primary">Submit</button>
                         </div>
                     </div>
                 </div>
                 </form>
             </div>
         </div>
     </div>
     <!--Row-->
 </div>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script>
    window.addEventListener('DOMContentLoaded', (event) => {
    let today = new Date().toISOString().split('T')[0];
    document.getElementById('tanggal').value = today;
    });
 </script>
 <script>
        function setDefaultDate() {
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            var day = currentDate.getDate().toString().padStart(2, '0');
            var formattedDate = year + '-' + month + '-' + day;

            document.getElementById("tanggal").value = formattedDate;
        }

        setDefaultDate();

</script>

 <script>
     function showSubmenu() {
         var selectBox = document.getElementsByName("type")[0];
         var selectedValue = selectBox.options[selectBox.selectedIndex].value;
         var submenu1 = document.getElementById("submenu1");
         var submenu2 = document.getElementById("submenu2");
         var submenu3 = document.getElementById("submenu3");
         var submenu4 = document.getElementById("submenu4");
         var submenu5 = document.getElementById("submenu5");
         var submenu6 = document.getElementById("submenu6");
         var submenu7 = document.getElementById("submenu7");
         var submenu8 = document.getElementById("submenu8");
         var submenu9 = document.getElementById("submenu9");
         var submenu10 = document.getElementById("submenu10");



         submenu1.style.display = "none";
         submenu2.style.display = "none";

         if (selectedValue === "Kendaraan") {
             submenu1.style.display = "block";
             submenu2.style.display = "none";
             submenu3.style.display = "none";
             submenu4.style.display = "none";
             submenu5.style.display = "none";
             submenu6.style.display = "none";
             submenu7.style.display = "none";
             submenu8.style.display = "none";
             submenu9.style.display = "none";
             submenu10.style.display = "none";

             submenu3.selectedIndex = 0;
             submenu4.selectedIndex = 0;
             submenu5.selectedIndex = 0;
             submenu6.selectedIndex = 0;
             submenu7.selectedIndex = 0;
             submenu8.selectedIndex = 0;
             submenu9.selectedIndex = 0;
             submenu12.selectedIndex = 0;

         } else if (selectedValue === "Pejalan Kaki") {
             submenu2.style.display = "block";
             submenu1.style.display = "none";
             submenu3.style.display = "none";
             submenu4.style.display = "none";
             submenu5.style.display = "none";
             submenu6.style.display = "none";
             submenu7.style.display = "none";
             submenu8.style.display = "none";
             submenu9.style.display = "none";
             submenu10.style.display = "none";

             submenu3.selectedIndex = 0;
             submenu4.selectedIndex = 0;
             submenu5.selectedIndex = 0;
             submenu6.selectedIndex = 0;
             submenu7.selectedIndex = 0;
             submenu8.selectedIndex = 0;
             submenu9.selectedIndex = 0;
             submenu12.selectedIndex = 0;
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
     var arrayNamaForm = [];
     $(document).ready(function() {
         // Tambahkan event listener untuk perubahan nilai dropdown
         $('select[name="regional"], select[name="type"], select[name="type_journey"], select[name="type_journey2"], select[name="type_option"], select[name="type_option2"], select[name="type_option3"], select[name="type_option4"], select[name="type_option5"], select[name="type_option6"], select[name="type_option7"], select[name="type_option8"], select[name="cabang"]').change(function() {
             var selectedRegional = $('select[name="regional"]').val();
             var selectedType = $('select[name="type"]').val();
             var selectedValue1 = $('select[name="type_journey"]').val();
             var selectedValue2 = $('select[name="type_journey2"]').val();
             var selectedValue3 = $('select[name="type_option"]').val();
             var selectedValue4 = $('select[name="type_option2"]').val();
             var selectedValue5 = $('select[name="type_option3"]').val();
             var selectedValue6 = $('select[name="type_option4"]').val();
             var selectedValue7 = $('select[name="type_option5"]').val();
             var selectedValue8 = $('select[name="type_option6"]').val();
             var selectedValue9 = $('select[name="type_option7"]').val();
             var selectedValue10 = $('select[name="type_option8"]').val();
             var selectedCabang = $('select[name="cabang"]').val();
             // Ambil nilai dari inputan nama
             var nama = $('#nama').val();

             // Ambil nilai dari inputan tanggal
             var tanggal = $('#tanggal').val();

             // Hanya melakukan permintaan Ajax jika nilai yang dipilih tidak kosong
             if ((selectedRegional !== '0' && selectedType !== '0') || (selectedValue1 !== '0' || selectedValue2 !== '0') || (selectedValue3 !== '0' || selectedValue4 !== '0' || selectedValue5 !== '0' || selectedValue6 !== '0' || selectedValue7 !== '0' || selectedValue8 !== '0' || selectedValue9 !== '0' || selectedValue10 !== '0') || selectedCabang !== '0') {
                 // Tampilkan data regional, type, type journey, type journey option, dan cabang yang dipilih
                 $('#selectedValues').html('Selected Regional: ' + selectedRegional + '<br>Selected Type: ' + selectedType + '<br>Selected Type Journey 1: ' + selectedValue1 + '<br>Selected Type Journey 2: ' + selectedValue2 + '<br>Selected Type Journey Option 1: ' + selectedValue3 + '<br>Selected Type Journey Option 2: ' + selectedValue4 + '<br>Selected Type Journey Option 3: ' + selectedValue5 + '<br>Selected Type Journey Option 4: ' + selectedValue6 + '<br>Selected Type Journey Option 5: ' + selectedValue7 + '<br>Selected Type Journey Option 6: ' + selectedValue8 + '<br>Selected Type Journey Option 7: ' + selectedValue9 + '<br>Selected Type Journey Option 8: ' + selectedValue10 + '<br>Selected Cabang: ' + selectedCabang);
                 
                 // Kirim permintaan Ajax ke server
                //  console.log(selectedValue3);
                 $.ajax({
                     url: "<?php echo base_url('ajax-controller/get-filtered-data'); ?>",
                     type: "POST",
                     dataType: "json",
                     data: {
                         regional: selectedRegional,
                         type: selectedType,
                         type_journey: selectedValue1,
                         type_journey2: selectedValue2,
                         type_option1: selectedValue3,
                         type_option2: selectedValue4,
                         type_option3: selectedValue5,
                         type_option4: selectedValue6,
                         type_option5: selectedValue7,
                         type_option6: selectedValue8,
                         type_option7: selectedValue9,
                         type_option8: selectedValue10,
                         cabang: selectedCabang
                     },
                     success: function(response) {
                         // Tangani respons dari server
                         if (response.length > 0) {
                             var resultHtml = '';

                             // Kode yang dicetak hanya sekali
                            //  resultHtml += `<div class="container">
                            //                 <div class="row">
                            //                 <div class="col-md-12 text-danger mt-3  ">
                            //                     <span >Pastikan Data Yang Di Input Benar !! </span>
                            //                 </div>
                            //                 <div class="col-md-12 text-danger mb-3">
                            //                 <button type="button" class="btn btn-danger" onclick="reloadBrowser()">Reload Data Salah</button>
                            //                 </div>
                            //                 <div class="col-md-2">
                            //                     <span> Nama</span>
                            //                 </div>
                                           
                            //                 <div class="col-md-10">
                            //                     <span>: ${nama}</span>
                            //                 </div>
                            //                 <div class="col-md-2 ">
                            //                     <span> Tanggal</span>
                            //                 </div>
                            //                 <div class="col-md-10 ">
                            //                     <span>: ${tanggal}</span>
                            //                 </div>
                                            
                            //                 <div class="col-md-2 mt-3">
                            //                     <span>Type Regional </span>
                            //                 </div>
                            //                 <div class="col-md-10 mt-3">
                            //                     <span>: ${response[0].regional}</span>
                            //                 </div>
                            //                 <div class="col-md-2">
                            //                     <span>Cabang </span>
                            //                 </div>
                            //                 <div class="col-md-10">
                            //                     <span>: ${response[0].cabang}</span>
                            //                 </div>
                            //                 <div class="col-md-2">
                            //                     <span>Type  </span>
                            //                 </div>
                            //                 <div class="col-md-10">
                            //                     <span>: ${response[0].type}</span>
                            //                 </div>  
                            //                 <div class="col-md-2">
                            //                     <span>Type Journey </span>
                            //                 </div>
                            //                 <div class="col-md-10">
                            //                     <span>: ${response[0].type_journey}</span>
                            //                 </div>  
                            //                 <div class="col-md-2">
                            //                     <span>Type Option </span>
                            //                 </div>
                            //                 <div class="col-md-10">
                            //                     <span>: ${response[0].type_option}</span>
                            //                 </div>
                            //                 </div>
                            //                 </div>`;
                            resultHtml += `<hr>`
                             for (var i = 0; i < response.length; i++) {
                                arrayNamaForm.push(`radio_${i + 1}`);
                                 // Kode yang diulang
                                 resultHtml += `
                                 <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <span>${response[i].soal} </span>
                                            <input type="hidden" name="soal_${i + 1}" value="${response[i].soal}">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                <label class="custom-control custom-radio">
                                                <input required name="radio_${i + 1}" type="radio" class="custom-control-input" data-jawaban="jawaban_1" value="${response[i].jawaban_1}">
                                                    <span class="custom-control-label">
                                                        ${response[i].jawaban_1}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                <label class="custom-control custom-radio">
                                                <input name="radio_${i + 1}" type="radio" class="custom-control-input" data-jawaban="jawaban_2" value="${response[i].jawaban_2}">
                                                    <span class="custom-control-label">
                                                        ${response[i].jawaban_2}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="margin-left: 10px;">
                                        <input type="hidden" name="jawaban_benar_${i + 1}" value="${response[i].jawaban_benar}">
                                        </div>
                                        <div class="col-md-12" style="margin-left: 10px;">
                                        <input type="hidden" name="status" value="proses">
                                        </div>
                                        <div class="col-md-12">
                                            <label  class="btn btn-warning" style="font-size: 11px;" for="file">
                                                Gambar + <input type="file" id="file" name="gambar[]" multiple>
                                            </label>
                                        </div>
                                    </div>
                                </div>`;
                             }
                            //  console.log(arrayNamaForm);
                             $('#result').html(resultHtml);
                         } else {
                             $('#result').html('<span id="error-message">Proses Pencarian Data Belum Ada Yang Sesuai , Isi Semua Data ........</span>');
                         }
                         $('#error-message').css({
                             'color': 'red',
                             'font-weight': 'bold',
                             'margin-left': '30px'
                         });
                     },
                     error: function(xhr, status, error) {
                         console.log(error);
                     }
                 });
             } else {
                 // Hapus data yang ditampilkan
                 $('#selectedValues').html('');
                 $('#result').html('');
             }
         });

     });
     function confirmSubmit(event, params) {
            confirm("Press a button!");
            
        }
        document.getElementById("form_id").addEventListener("submit", function(event) {
            event.preventDefault(); 
            
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin melanjutkan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Sukses', 'Tipe Confirmation dipilih atau tidak semua form memilih Required!', 'success');
                    event.target.submit();
                    // Lakukan tindakan yang sesuai untuk tipe "confirmation" atau kombinasi tipe "required" dan "confirmation" di sini
                }
                });
            });
    </script>
 <script>

     function reloadBrowser() {
         location.reload(); // Fungsi untuk me-reload browser
     }
 </script>