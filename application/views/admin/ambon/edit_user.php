<div class="container" style="width: 80%;">
<form class="user mt-2" method="post" action="<?php echo base_url('admin/update_user/' . $user['id_user']); ?>" >
    <div class="container row" >
        <div class="col-md-12">
            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit User </h5>
        </div>
        <div class="col-md-12">
        <label for="nik">NIP</label> 
            <div class="form-group">
                <input class="form-control" type="text" name="nik" id="nik" value="<?php echo $user['nik']; ?>">
            </div>
        </div>
        <div class="col-md-12 mb-2">
            <label for="cabang">Nama User</label>
            <input class="form-control" type="text" name="nama_user" id="nama_user" value="<?php echo $user['nama_user']; ?>">
        </div>
        <div class="col-md-12">
            <label for="gender">Gender</label>
            <div class="form-group">
                <select class="form-control" name="gender">
                <?php $selectedL = ($user['gender'] == "L") ? "selected" : ""; ?>
                <?php $selectedP = ($user['gender'] == "P") ? "selected" : ""; ?>
                    <option class="form-control" value="L" <?php echo $selectedL; ?>>Laki-laki</option>
                    <option  class="form-control" value="P" <?php echo $selectedP; ?>>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <label for="username">Username</label>
            <div class="form-group">
                <input class="form-control" type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
            </div>
        </div>
        <div class="col-md-12">
            <label for="password">Password</label>
            <div class="form-group">
                <input class="form-control" type="text" name="password" id="password" value="<?php echo $user['password']; ?>">
            </div>
        </div>
        <div class="col-md-12">
            <label for="level_pengguna">Jabatan</label>
            <div class="form-group">
                <?php $selectedPimpinan = ($user['level_pengguna'] == "Pimpinan") ? "selected" : ""; ?>
                <?php $selectedAdmin = ($user['level_pengguna'] == "Admin") ? "selected" : ""; ?>
                <?php $selectedPegawai = ($user['level_pengguna'] == "Pegawai") ? "selected" : ""; ?>
                <select class="form-control" name="level_pengguna">
                    <option value="Pimpinan" <?php echo $selectedPimpinan; ?> >Pimpinan</option>
                    <option value="Admin" <?php echo $selectedAdmin ; ?> >Admin</option>
                    <option value="Pegawai" <?php echo $selectedPegawai ; ?> >Pegawai</option>
                </select>
            </div>
        </div>
        <input class="form-control" type="text" name="regional" id="regional" value="<?php echo $user['id_regional']; ?>" readonly>
        <div class="col-md-12 mb-2">
            <label for="cabang">Cabang</label>
            <div class="form-group">
                <select class="form-control" name="cabang" id="cabangSelect">
                    <?php foreach ($data_cabang as $row) { ?>
                        <?php $selected = ($user['id_cabang'] == $row->id_cabang) ? "selected" : ""; ?>
                        <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?> data-regional="<?php echo $row->id_regional; ?>" ><?php echo $row->cabang; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="collapse-item" href="<?= base_url('admin/akun_user'); ?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </a>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
</div>
<script>
    // Mendapatkan elemen-elemen yang diperlukan
    const regionalInput = document.getElementById('regional');
    const cabangSelect = document.getElementById('cabangSelect');

    // Menambahkan event listener untuk perubahan pada pilihan cabang
    cabangSelect.addEventListener('change', function () {
        // Mendapatkan id_regional yang terkait dengan pilihan cabang
        const selectedOption = cabangSelect.options[cabangSelect.selectedIndex];
        const idRegional = selectedOption.getAttribute('data-regional');

        // Menetapkan id_regional pada input teks "regional"
        regionalInput.value = idRegional;
    });
</script>

<!---Container Fluid-->