<div class="container" style="width: 80%;">
<form class="user mt-2" method="post" action="<?php echo base_url('admin/update_type_option/' . $type_option['id_type_option']); ?>" >
    <div class="container row" >
        <div class="col-md-12">
            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit Type Option </h5>
        </div>
        <div class="col-md-12">
                     <label for="cabang">Cabang</label>
                        <div class="form-group">
                            <select class="form-control" name="cabang" id="cabang2"  onchange="showSubmenu4()">
                            <option value="">All Cabang</option>
                                <?php 
                                foreach ($data_cabang as $row) { ?>
                                    <?php $selected = ($type_option['id_cabang'] == $row->id_cabang) ? "selected" : ""; ?>
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
                             <input class="form-control" value="<?php echo $type_option['type_option']; ?>" type="text" name="type_option" id="type_option">
                         </div>
                     </div>
    </div>

    <div class="modal-footer">
        <a class="collapse-item" href="<?= base_url('admin/typeoption_null'); ?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </a>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
</div>

<!---Container Fluid-->

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

                        // Tambahkan kondisi untuk memeriksa apakah opsi harus dipilih (selected) atau tidak
                        if (response[i].id_journey == <?= $type_option['id_journey'] ?>) {
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
                        <?php if ($type_option['id_pelabuhan'] !== null) { ?>
                            if (response[i].id_pelabuhan == <?= $type_option['id_pelabuhan'] ?>) {
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
                        <?php if ($type_option['id_kapal'] !== null) { ?>
                            if (response[i].id_kapal == <?= $type_option['id_kapal'] ?>) {
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