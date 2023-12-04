 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"> Pelabuhan</h1>
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="./">Home</a></li>
             <li class="breadcrumb-item">Tables</li>
             <li class="breadcrumb-item active" aria-current="page"> Kelola Pelabuhan</li>
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
    </div>
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"> Kelola Pelabuhan</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="#myBtn">
                     + Tambah Pelabuhan
            </button>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush" id="tablen">
                <thead class="thead-light">
                         <tr>
                             <th>No</th>
                             <th>Cabang</th>
                             <th>Pelabuhan</th>
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
                                 <td><?php echo $d->pelabuhan; ?></td>
                                 <td>
                                 <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-end align-items-end">
                                                    <a class="btn btn-warning" href="<?php echo site_url('admin/edit_pelabuhan/' . $d->id_pelabuhan); ?>" onclick="return confirm('Anda yakin ingin mengedit data ini?');">
                                                        edit
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="order-first">
                                                    <a class="btn btn-danger" href="<?php echo site_url('admin/hapus_pelabuhan/' . $d->id_pelabuhan); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
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
                 <h5 class="modal-title" id="exampleModalLabel">Form Tambah Pelabuhan </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form class="user mt-2" action="<?php echo base_url() . 'admin/add_pelabuhan'; ?>" method="post">
                 <div class="container row">
                     <div class="col-md-12">
                        <label for="cabang">Cabang</label>
                        <div class="form-group">
                            <select class="form-control" name="cabang" id="cabang2" onchange="showSubmenu4()">
                            <option value="">All Cabang</option>
                                <?php foreach ($data_cabang as $row) { ?>
                                    <?php $selected = ($cabang == $row->id_cabang) ? "selected" : ""; ?>
                                    <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                     </div> 
                     <div id="submenu4"  class="col-md-12" style="display:none">
                             <label for="type_journey">Type Journey </label>
                             <div class="form-group">
                                <select class="form-control" name="journey" id="journey2" onchange="showSubmenu5()">
                                <option value="">All Journey</option>
                                </select>
                             </div> 
                     </div>
                     <div id="submenu5"  class="col-md-12" style="display:none">
                         <label>Pelabuhan</label>
                         <div class="form-group">
                             <input class="form-control" type="text" name="pelabuhan" id="pelabuhan">
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
            window.location.href = "<?php echo base_url('Admin/pelabuhan_null/'); ?>";
        }else {
            var baseUrl = "<?php echo base_url('Admin/pelabuhan/'); ?>";
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
 <script>
    function showSubmenu4() {
        var selectBoxCabang = document.getElementById("cabang2");
        var selectedValueCabang = selectBoxCabang.options[selectBoxCabang.selectedIndex].value;
        var submenu4 = document.getElementById("submenu4");
        var journeySelect = document.getElementById("journey2");
        var submenu5 = document.getElementById("submenu5");

        if (selectedValueCabang === "") {
            submenu4.style.display = "none";
            submenu5.style.display = "none";
        } else {
            submenu4.style.display = "block";

            $.ajax({
                url: "<?= base_url('Admin/getJourneyOptions') ?>",
                method: "GET",
                data: { cabang: selectedValueCabang },
                dataType: "json",
                success: function(response) {
                    journeySelect.innerHTML = "<option value=''>All Journey</option>";

                    var hasPortJourney = false;

                    for (var i = 0; i < response.length; i++) {
                        var option = document.createElement("option");
                        option.value = response[i].id_journey;
                        option.textContent = response[i].journey;
                        journeySelect.appendChild(option);

                        if (response[i].journey === "Port Journey") {
                            hasPortJourney = true;
                        }
                    }

                    if (!hasPortJourney) {
                        
                        journeySelect.innerHTML = `<option value="" style="color: red;">Port Journey Tidak Tersedia</option>`;
                        submenu5.style.display = "none";
                    } else {
                        $('#journey2 option:contains("Port Journey")').prop('selected', true);
                        submenu5.style.display = "block";
                    }
                }
            });
        }
    }

    // Panggil showSubmenu4() saat halaman pertama kali dimuat
    window.addEventListener('load', showSubmenu4);

    // Panggil showSubmenu4() saat terjadi perubahan pada elemen cabang
    var cabangSelect2 = document.getElementById("cabang2");
    cabangSelect2.addEventListener('change', showSubmenu4);
</script>
