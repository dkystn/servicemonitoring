<form class="user mt-2" method="post" action="<?php echo base_url('admin/update_soal/' . $soal['id_soal']); ?>">
    <div class="container row">
        <div class="col-md-12">
            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit Soal </h5>
        </div>
        <div class="col-md-12">
    <?php
    $selectedValue = isset($selectedRegional) ? $selectedRegional : $soal['id_regional'];
    ?>
    <input class="form-control" type="text" name="regional" id="regional" value="<?php echo $selectedValue; ?>" readonly>
</div>
<div class="col-md-12">
    <label for="cabang">Cabang</label>
    <select class="form-control" name="cabang" id="cabang2" onchange="updateRegional()">
        <option value="">All Cabang</option>
        <?php
        $selectedRegional = null; // Inisialisasi $selectedRegional
        foreach ($data_cabang as $row) {
            $selected = ($soal['id_cabang'] == $row->id_cabang) ? "selected" : "";
            echo "<option value='{$row->id_cabang}' data-regional='{$row->id_regional}' $selected>{$row->cabang}</option>";

            if ($selected) {
                $selectedRegional = $row->id_regional;
            }
        }
        ?>
    </select>
</div>

        <div id="submenu4" class="col-md-12">
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
                    <!-- Rest of your HTML and PHP code -->
                    <select class="form-control" name="type_option" id="type_option">
                        <!-- Options will be populated here using JavaScript -->
                    </select>
                </div>
        </div>
        <div class="col-md-12"> 
            <label for="type">Type Pertanyaan</label>
            <select class="form-control" name="type" >
                <?php $selected1 = ($soal['type'] == "Kendaraan") ? "selected" : "";
                $selected2 = ($soal['type'] == "Pejalan Kaki") ? "selected" : ""; ?>
                    <option value="0">Select Type Pertanyaan</option>
                    <option value="Kendaraan" <?php echo $selected1; ?>>Kendaraan</option>
                    <option value="Pejalan Kaki" <?php echo $selected2; ?>>Pejalan Kaki</option>
           </select>
        </div>
        <div class=" col-md-12">
            <label for="nik">Soal</label>
            <div class="form-group">
                <input class="form-control" type="text" name="soal" id="soal" value="<?php echo $soal['soal']; ?>">
            </div>
        </div>
        <div class="col-md-12">
    <label for="jawaban_1">Jawaban 1</label>
    <div class="form-group">
        <input class="form-control" type="text" name="jawaban_1" id="jawaban_1" value="<?php echo $soal['jawaban_1']; ?>" data-value="<?php echo $soal['jawaban_1']; ?>">
    </div>
</div>
<div class="col-md-12">
    <label for="jawaban_2">Jawaban 2</label>
    <div class="form-group">
        <input class="form-control" type="text" name="jawaban_2" id="jawaban_2" value="<?php echo $soal['jawaban_2']; ?>" data-value="<?php echo $soal['jawaban_2']; ?>">
    </div>
</div>
<div class="col-md-12">
    <label for="jawaban_benar">Jawaban Benar</label>
    <div class="form-group">
        <select class="form-control" name="jawaban_benar" id="jawaban_benar">
            <option value="jawaban_1">Jawaban 1</option>
            <option value="jawaban_2">Jawaban 2</option>
        </select>
    </div>
</div>
<div class="col-md-12">
    <label for="hari">Hari Pengisian</label>
    <div class="form-group">
        <input class="form-control" type="number" name="hari" id="hari" value="<?php echo $soal['hari']; ?>"> 
    </div>
</div>
<div class="col-md-12">
    <label for="last_input">Tanggal</label>
    <div class="form-group">
        <input class="form-control" type="date" name="last_input" id="last_input" value="<?php echo $soal['last_input']; ?>">
    </div>
</div>



    </div>

    <div class="modal-footer">
        <a class="collapse-item" href="<?= base_url('admin/soal'); ?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </a>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>

<!---Container Fluid-->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    var jawaban1Input = document.getElementById("jawaban_1");
    var jawaban2Input = document.getElementById("jawaban_2");
    var jawabanBenarDropdown = document.getElementById("jawaban_benar");

    // Fungsi untuk mengupdate opsi dropdown dan pilihan yang dipilih
    function updateJawabanOptions() {
        var jawaban1 = jawaban1Input.value;
        var jawaban2 = jawaban2Input.value;

        jawabanBenarDropdown.innerHTML = "";

        var option1 = new Option(jawaban1, jawaban1); // Ubah value menjadi jawaban1
        var option2 = new Option(jawaban2, jawaban2); // Ubah value menjadi jawaban2

        jawabanBenarDropdown.add(option1);
        jawabanBenarDropdown.add(option2);

        // Memperbarui opsi yang dipilih pada "Jawaban Benar" berdasarkan input terbaru
        var selectedOption = jawabanBenarDropdown.value;
        if (selectedOption === jawaban1) {
            option1.selected = true;
        } else if (selectedOption === jawaban2) {
            option2.selected = true;
        }
    }

    // Memanggil fungsi saat input jawaban berubah
    jawaban1Input.addEventListener("input", updateJawabanOptions);
    jawaban2Input.addEventListener("input", updateJawabanOptions);

    // Memanggil fungsi saat dropdown "Jawaban Benar" berubah
    jawabanBenarDropdown.addEventListener("change", function () {
        var selectedOption = jawabanBenarDropdown.value;
        if (selectedOption === jawaban1) {
            jawaban1Input.value = jawaban1Input.getAttribute("data-value");
        } else if (selectedOption === jawaban2) {
            jawaban2Input.value = jawaban2Input.getAttribute("data-value");
        }
    });

    // Memanggil fungsi saat halaman dimuat
    updateJawabanOptions();
});

</script>


<script>
    function updateRegional() {
        var selectBoxCabang = document.getElementById("cabang2");
        var selectedOptionCabang = selectBoxCabang.options[selectBoxCabang.selectedIndex];
        var selectedRegional = selectedOptionCabang.getAttribute('data-regional');

        var regionalInput = document.getElementById('regional');
        var regionalHiddenInput = document.getElementById('regional_hidden');

        regionalInput.value = selectedRegional;
        regionalHiddenInput.value = selectedRegional;

        showSubmenu4(); // Panggil fungsi untuk memperbarui submenu4 setelah cabang berubah
    }

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
                    console.log(response);
                    for (var i = 0; i < response.length; i++) {
                        
                        var option = document.createElement("option");
                        option.value = response[i].id_journey;
                        option.textContent = response[i].journey;
                        option.setAttribute("data-journey", response[i].id_journey);

                        // Tambahkan kondisi untuk memeriksa apakah opsi harus dipilih (selected) atau tidak
                        if (response[i].id_journey == <?= $soal['id_journey'] ?>) {
                            option.selected = true;
                        }

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
        var dataJourney = selectElement.options[selectElement.selectedIndex].getAttribute('data-journey'); // Mengambil atribut data-journey

        var pelabuhan = document.getElementById("pelabuhan2");
        var kapal = document.getElementById("kapal2");
        var type = document.getElementById("type");

        var selectBoxCabang = document.getElementById("cabang2");
        var selectedValueCabang = selectBoxCabang.options[selectBoxCabang.selectedIndex].value;
        // console.log("id journey"  + dataJourney);
        
        $.ajax({
            url: "<?php echo site_url('Admin/send_data_journey'); ?>",
            method: "POST",
            data: { dataJourney: dataJourney },
            dataType: "json",  // Expecting JSON response
            success: function(response) {
                var Typeoption = response.Typeoption;  // Get the Typeoption array

                // Generate the dropdown options
                var dropdownHtml = '<option value="">Type option</option>';
                for (var i = 0; i < Typeoption.length; i++) {
                    var row = Typeoption[i];
                    var selected = (row.id_type_option  == <?php echo $soal['id_type_option']; ?>) ? "selected" : "";
                    dropdownHtml += '<option value="' + row.id_type_option + '" ' + selected + '>' + row.type_option + '</option>';
                }

                // Set the generated options to the dropdown
                $("#type_option").html(dropdownHtml);
            }
        });

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
                        <?php if ($soal['id_pelabuhan'] !== null) { ?>
                            if (response[i].id_pelabuhan == <?= $soal['id_pelabuhan'] ?>) {
                                option.selected = true;
                            }
                        <?php } ?>
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
                        <?php if ($soal['id_kapal'] !== null) { ?>
                            if (response[i].id_kapal == <?= $soal['id_kapal'] ?>) {
                                option.selected = true;
                            }
                        <?php } ?>
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