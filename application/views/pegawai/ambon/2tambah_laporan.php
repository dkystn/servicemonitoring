 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"> Laporan</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
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
                 <form id="form_id" action="<?= base_url('pegawai/laporan_update') ?>" method="post" enctype="multipart/form-data">
                 <div class="container ">
                     <div class="row">
                        <div class="col-md-12 mb-3">
                             <span>Nama</span>
                         </div>
                         <div class="col-md-12 mb-3">
                             <input class="form-control" type="text" name="nama" id="nama" placeholder="Isi Nama Pelapor">
                         </div>
                         <div class="col-md-12  mb-3">
                             <span>Tanggal</span>
                         </div>
                         <div class="col-md-12  mb-3"> 
                         <input class="form-control" type="date" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="col-md-12">
                             <label for="regional">Regional</label>
                             <div class="form-group">
                                 <select class="form-control" name="regional"  readonly>
                                     <?php foreach ($regional as $row) { ?>
                                        <option value="<?php echo $row->id_regional; ?>" >Regional <?php echo $row->id_regional; ?></option>
                                    <?php } ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <label for="cabang">Cabang</label>
                             <div class="form-group">
                                 <select class="form-control" name="cabang"   readonly>
                                    <?php foreach ($regional as $row) { ?>
                                        <option value="<?php echo $row->id_cabang; ?>" ><?php echo $row->cabang; ?></option>
                                    <?php } ?>
                                 </select>
                             </div>
                         </div>
                        <!-- Type Journey -->
                        <div id="type_journey" class="col-md-12">
                            <label for="type_journey">Type Journey</label>
                            <div class="form-group">
                                <select class="form-control" name="type_journey" onchange="showSubmenu()">
                                    <option value="0">Select Type Journey</option>
                                    <?php foreach ($jenis_journey as $row) { ?>
                                        <option value="<?php echo $row->journey; ?>|<?php echo $row->id_journey; ?>"><?php echo $row->journey; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <input type="text" id="id_journey" name="id_journey" style="display:none">

                        <!-- Pelabuhan -->
                        <div id="pelabuhan" class="col-md-12" style="display:none">
                            <label for="pelabuhan">Pelabuhan</label>
                            <div class="form-group">
                                <select class="form-control" name="pelabuhan" >
                                    <option value="0">Select Pelabuhan</option>
                                    <?php foreach ($pelabuhan as $row) { ?>
                                        <option value="<?php echo $row->id_pelabuhan; ?>"><?php echo $row->pelabuhan; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Kapal -->
                        <div id="kapal" class="col-md-12" style="display:none">
                            <label for="kapal">Kapal</label>
                            <div class="form-group">
                                <select class="form-control" name="kapal" >
                                    <option value="0">Select Kapal</option>
                                    <?php foreach ($kapal as $row) { ?>
                                        <option value="<?php echo $row->id_kapal; ?>"><?php echo $row->kapal; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- Type Journey Option -->
                        <div id="type_option" class="col-md-12" style="display:none">
                            <label for="type_option">Type Journey Option</label>
                            <div class="form-group">
                                <select class="form-control" name="type_option" >
                                    <option value="0">Select Type Journey Option</option>
                                    <?php foreach ($pre_option as $row) { ?>
                                        <option value="<?php echo $row->id_type_option; ?>"><?php echo $row->type_option; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!--  -->
                        <!-- Type Journey Option -->
                        <div id="type_option2" class="col-md-12" style="display:none">
                            <label for="type_option2">Type Journey Option</label>
                            <div class="form-group">
                                <select class="form-control" name="type_option2" >
                                    <option value="0">Select Type Journey Option </option>
                                    <?php foreach ($post_option as $row) { ?>
                                        <option value="<?php echo $row->id_type_option; ?>"><?php echo $row->type_option; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!--  -->
                        <!-- Type Journey Option -->
                        <div id="type_option3" class="col-md-12" style="display:none">
                            <label for="type_option3">Type Journey Option</label>
                            <div class="form-group">
                                <select class="form-control" name="type_option3" >
                                    <option value="0">Select Type Journey Option</option>
                                </select>
                            </div>
                        </div>
                        <!--  -->
                        <!-- Type Journey Option -->
                        <div id="type_option4" class="col-md-12" style="display:none">
                            <label for="type_option4">Type Journey Option</label>
                            <div class="form-group">
                                <select class="form-control" name="type_option4" >
                                    <option value="0">Select Type Journey Option</option>
                                </select>
                            </div>
                        </div>
                        <div id="result" class="col-md-12" style="font-size: 15px;"></div>
                        <!--  -->
                     </div>
                 </div>
                 
                 <div id="response-message"></div>
                 <div class="container">
                     <div class="row">
                         <div class="col-md-12 text-center mt-4 mb-4">
                         <button type="submit" class="btn btn-primary" onclick="confirmSubmit(event)">Submit</button>
                         </div>
                     </div>
                 </div>
                 </form>
             </div>
         </div>
     </div>
     <!--Row-->
 </div>
 
<!-- <script>
        function confirmSubmit(event) {
            event.preventDefault(); // Mencegah aksi default pengiriman form

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin dengan jawaban Anda?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengirim form jika pengguna yakin
                    event.target.form.submit();
                }
            });
        }
    </script> -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 <script>
     function showSubmenu() {
         var selectBox = document.getElementsByName("type_journey")[0];
         
         var submenu1 = document.getElementById("pelabuhan");
         var submenu2 = document.getElementById("kapal");
         var submenu3 = document.getElementById("type_option");
         var submenu4 = document.getElementById("type_option2");
         
         var submenu5 = document.getElementById("type_option3");
         var submenu6 = document.getElementById("type_option4");

         var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        value_all = selectedValue
         value_all.split("|");
         arrSplit = value_all.split("|");
         arrSplit[0];
         var value_0 = arrSplit[0];
         var value_1 = arrSplit[1];
        
        // Reset nilai dropdown yang terpengaruh
        $('select[name="pelabuhan"]').val('0');
        $('select[name="kapal"]').val('0');
        $('select[name="type_option"]').val('0');
        $('select[name="type_option2"]').val('0');
        $('select[name="type_option3"]').val('0');
        $('select[name="type_option4"]').val('0');

         submenu1.style.display = "none";
         submenu2.style.display = "none";
         submenu3.style.display = "none";
         submenu4.style.display = "none";

         if (value_0 === "Pre Journey") {
             submenu3.style.display = "block";
            //  $('select[name="pelabuhan"]').empty();
            //  $('select[name="kapal"]').empty();
            // $('select[name="type_option2"]').empty();
            // $('select[name="type_option3"]').empty();
            // $('select[name="type_option4"]').empty();
             submenu1.style.display = "none";
             submenu2.style.display = "none";
             submenu4.style.display = "none";
             
             submenu5.style.display = "none";
             submenu6.style.display = "none";

         } else if (value_0 === "Port Journey") {
            submenu1.style.display = "block";
            //  $('select[name="kapal"]').empty();
            // $('select[name="type_option"]').empty();
            // $('select[name="type_option2"]').empty();
            // $('select[name="type_option4"]').empty();
            submenu2.style.display = "none";
            submenu3.style.display = "none";
            submenu4.style.display = "none";

             submenu5.style.display = "none";
             submenu6.style.display = "none";

         } else if (value_0 === "On Board Journey") {
            submenu2.style.display = "block";
            //  $('select[name="pelabuhan"]').empty();
            // $('select[name="type_option"]').empty();
            // $('select[name="type_option2"]').empty();
            // $('select[name="type_option3"]').empty();
            submenu3.style.display = "none";
            submenu4.style.display = "none";
            
            submenu5.style.display = "none";
             submenu6.style.display = "none";
            submenu1.style.display = "none";
             
         } else if (value_0 === "Post Journey") {
             submenu4.style.display = "block";
            //  $('select[name="pelabuhan"]').empty();
            // $('select[name="kapal"]').empty();
            // $('select[name="type_option"]').empty();
            // $('select[name="type_option3"]').empty();
            // $('select[name="type_option4"]').empty();
            submenu2.style.display = "none";
            submenu3.style.display = "none";
            submenu1.style.display = "none";
            
            submenu5.style.display = "none";
             submenu6.style.display = "none";
         }
         
     }
 </script>
 <script>
    $(document).ready(function() {
        // Menambahkan event listener ketika pelabuhan dipilih
        $('select[name="pelabuhan"]').change(function() {
            var selectedPelabuhan = $(this).val(); // Mengambil nilai pelabuhan yang dipilih

            // Memuat opsi jenis perjalanan berdasarkan pelabuhan yang dipilih
            $.ajax({
                url: '<?php echo base_url("Pegawai/getJourneyOptions"); ?>',
                type: 'POST',
                data: { pelabuhan: selectedPelabuhan },
                dataType: 'json',
                success: function(response) {
                    // Menghapus semua opsi yang ada sebelumnya
                    // $('select[name="type_option3"]').empty();

                    // Menambahkan opsi jenis perjalanan yang baru
                    $.each(response, function(index, value) {
                        $('select[name="type_option3"]').append('<option value="' + value.id_type_option + '">' + value.type_option +   value.id_type_option + '</option>');
                    });

                    // Menampilkan elemen dengan id="type_option3"
                    $('#type_option3').show();
                }
            });
        });
    });
</script>
 <script>
    $(document).ready(function() {
        // Menambahkan event listener ketika kapal dipilih
        $('select[name="kapal"]').change(function() {
            var selectedkapal = $(this).val(); // Mengambil nilai kapal yang dipilih

            // Memuat opsi jenis perjalanan berdasarkan kapal yang dipilih
            $.ajax({
                url: '<?php echo base_url("Pegawai/getJourneyOptions_kapal"); ?>',
                type: 'POST',
                data: { kapal: selectedkapal },
                dataType: 'json',
                success: function(response) {
                    // Menghapus semua opsi yang ada sebelumnya
                    // $('select[name="type_option4"]').empty();

                    // Menambahkan opsi jenis perjalanan yang baru
                    $.each(response, function(index, value) {
                        $('select[name="type_option4"]').append('<option value="' + value.id_type_option + '">' + value.type_option + value.id_type_option +'</option>');
                    });

                    // Menampilkan elemen dengan id="type_option4"
                    $('#type_option4').show();
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
         
        // Menambahkan event listener ketika journey dipilih
        $('select[name="type_journey"], select[name="type_option"], select[name="type_option2"], select[name="type_option3"], select[name="type_option4"]').change(function() {
            var selectedjourney = $('select[name="type_journey"]').val();
            var selectedOption1 = $('select[name="type_option"]').val();
            var selectedOption2 = $('select[name="type_option2"]').val();
            var selectedOption3 = $('select[name="type_option3"]').val();
            var selectedOption4 = $('select[name="type_option4"]').val();
            var value_all = selectedjourney
            value_all.split("|");
            arrSplit = value_all.split("|");
            arrSplit[0];
            var value_0 = arrSplit[0];
            var value_1 = arrSplit[1]; 
            var form_id = document.getElementById("id_journey");
            form_id.value = value_1;


            $.ajax({
                url: '<?php echo base_url("Pegawai/get_soal"); ?>',
                type: 'POST',
                data: {
                    journey: value_0,
                    option1: selectedOption1,
                    option2: selectedOption2,
                    option3: selectedOption3,
                    option4: selectedOption4
                },
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {
                        var resultHtml = '';
                        resultHtml += `<hr>`;
                        for (var i = 0; i < response.length; i++) {
                            var today = document.getElementById('tanggal').value;
                            // var today = response[i].last_input;
                            // var today = new Date(response[i].last_input);
                            // today.toLocalDateString();
                            var targetHari = Number(response[i].hari);
                            var currentDate = new Date(response[i].last_input);
                            currentDate.setDate(currentDate.getDate() + targetHari);

                            var formattedDate = currentDate.toISOString().slice(0, 10);
                            
                            if (today < formattedDate) {
                                console.log('eror')
                                console.log(today);
                                console.log(formattedDate);
                               
                            }else {
                                resultHtml += `
                                <div class="container">
                                    <div class="row">
                                    <!-- Tambahkan input tersembunyi untuk jumlah soal -->
                                        <input type="hidden" name="jumlah_soal" value="${response.length}">
                                        <div class="col-md-12 mt-4">
                                            <span>${response[i].soal}</span>
                                            <input type="hidden" name="soal_${i + 1}" value="${response[i].soal}">
                                            <input type="hidden" name="id_soal_${i + 1}" value="${response[i].id_soal}">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                <label class="custom-control custom-radio">
                                                    <input required name="radio_${i + 1}" type="radio" class="custom-control-input" data-jawaban="jawaban_1" value="${response[i].jawaban_1}" }>
                                                    <span class="custom-control-label">
                                                        ${response[i].jawaban_1}
                                                    </span>
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                <label class="custom-control custom-radio">
                                                    <input name="radio_${i + 1}" type="radio" class="custom-control-input" data-jawaban="jawaban_2" value="${response[i].jawaban_2}" }>
                                                    <span class="custom-control-label">
                                                        ${response[i].jawaban_2}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="margin-left: 10px;">
                                        <span style=" font-size: 10px; font-style: italic;"> *(Per ${response[i].hari} hari ) (Gambar : ${response[i].gambar ? 'Wajib' : 'Tidak Wajib'} )</span>
                                        </div>
                                        <div class="col-md-12" style="margin-left: 10px;">
                                            <input type="hidden" name="jawaban_benar_${i + 1}" value="${response[i].jawaban_benar}">
                                        </div>
                                        <div class="col-md-12" style="margin-left: 10px;">
                                            <input type="hidden" name="status" value="proses">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="btn btn-warning" style="font-size: 11px;" for="file">
                                                Gambar + <input type="file" class="file-input" id="file" name="gambar[]" ${response[i].gambar ? 'required' : ''} multiple>
                                            </label>
                                        </div>

                                        <div class="col-md-12" style="margin-left: 10px;">
                                            <input type="hidden"  name="type_${i + 1}" value="${response[i].type}">
                                        </div>
                                        <div class="col-md-12" style="margin-left: 10px;">
                                            <input type="hidden"  value="${response[i].gambar}">
                                        </div>
                                    </div>
                                </div>`;
                            }
                            
                        }

                        $('#result').html(resultHtml);

                        $('.file-input').on('change', function() {
                            var selectedFiles = this.files;
                            var currentDate = new Date().toJSON().slice(0, 10);

                            for (var i = 0; i < selectedFiles.length; i++) {
                                var fileDate = selectedFiles[i].lastModifiedDate.toJSON().slice(0, 10);
                                if (fileDate !== currentDate) {
                                    Swal.fire('Warning', 'Silahkan Gunakan Foto Terbaru ! !', 'warning');
                                    this.value = ''; // Clear the selected files
                                    return;
                                }
                            }
                        });
                    } else {
                        $('#result').html('<span id="error-message">Proses Pencarian Data Belum Ada Yang Sesuai, Isi Semua Data ........</span>');
                    }
                    $('#error-message').css({
                        'color': 'red',
                        'font-weight': 'bold',
                        'margin-left': '30px'
                    });
                }
            });
        });
    });
    function confirmSubmit(event, params) {
            
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

