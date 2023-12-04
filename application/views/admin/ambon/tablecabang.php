 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"> Cabang</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page"> Kelola Cabang</li>
         </ol>
     </div>
 </div>
 <div class="container">
    <div class="row">
    <div class="col-8 col-md-5 mb-4 ">
                    <!-- <label for="">Import Excel</label> -->
                    <!-- <form id="uploadForm" action="<?php echo base_url() . 'admin/uploaddata'; ?>" method="post" enctype="multipart/form-data">
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
                    </form> -->
                </div>
    </div>
    <!-- <script>
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
    </script> -->
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"> Kelola Cabang</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="#myBtn">
               + Tambah Cabang
            </button>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush" id="tablen">
                <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Regional</th>
                                <th>Cabang</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                </thead>
                <tbody>
                            <?php $no = 1;
                                foreach ($data as $d) { ?>
                                <tr class="searchable-item">
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"> 
                                        <?php
                                        $regional_data = $this->Model_soal->get_regional_by_id($d->id_regional);
                                        echo $regional_data !== null ? $regional_data->regional : '-';
                                        ?>
                                    </td>
                                    <td><?php echo $d->cabang; ?>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-end align-items-end">
                                                    <a class="btn btn-warning" href="<?php echo site_url('admin/edit_cabang/' . $d->id_cabang); ?>" onclick="return confirm('Anda yakin ingin mengedit data ini?');">
                                                        edit
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="order-first">
                                                    <a class="btn btn-danger" href="<?php echo site_url('admin/hapus_cabang/' . $d->id_cabang); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
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
             <form class="user mt-2" action="<?php echo base_url() . 'admin/add_cabang'; ?>" method="post">
                 <div class="container row">
                 <div class="col-md-12">
                         <label for="regional">Regional</label>
                         <div class="form-group">
                             <select class="form-control" name="regional">
                             <?php foreach ($data_regional as $row) { ?>
                                    <?php $selected = ($regional == $row->id_regional) ? "selected" : ""; ?>
                                    <option value="<?php echo $row->id_regional; ?>" <?php echo $selected; ?>><?php echo $row->regional; ?></option>
                                <?php } ?>
                             </select>
                         </div>
                     </div>
                 <div class=" col-md-12">
                         <label>Cabang</label>
                         <div class="form-group">
                             <input class="form-control" type="text" name="cabang" id="cabang">
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
 <script>
    // Fungsi untuk mendapatkan cabang terbaru dan mengalihkan ke halaman index
    function updateCabangAndRedirect() {
        var newCabang = document.getElementById("cabang").value;
        if (newCabang === "") {
            window.location.href = "<?php echo base_url('Admin/journey_null/'); ?>";
        }else {
            var baseUrl = "<?php echo base_url('Admin/journey/'); ?>";
            var url = baseUrl + newCabang ;
            window.location.href = url;
        }
        
    }
    // Tambahkan event listener untuk memanggil fungsi updateCabangAndRedirect saat input cabang berubah
    document.getElementById("cabang").addEventListener("change", updateCabangAndRedirect);
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