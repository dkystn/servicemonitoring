<form class="user mt-2" action="<?php echo base_url() . 'Element/add_user2'; ?>" method="post">
    <div class="container">

        <label for="nik">NIP</label>
        <div class="form-group">
            <input class="form-control" type="text" name="nik" id="nik">
        </div>
        <label for="nama_user">Nama</label>
        <div class="form-group">
            <input class="form-control" type="text" name="nama_user" id="nama_user">
        </div>
        <label for="gender">Gender</label>
        <div class="form-group">
            <select class="form-control" name="gender">
                <option class="form-control" value="L">Laki-laki</option>
                <option class="form-control" value="P">Perempuan</option>
            </select>
        </div>
        <label for="username">Username</label>
        <div class="form-group">
            <input class="form-control" type="text" name="username" id="username">
        </div>
        <label for="password">password</label>
        <div class="form-group">
            <input class="form-control" type="text" name="password" id="password">
        </div>
        <label for="level_pengguna">Jabatan</label>
        <div class="form-group">
            <select class="form-control" name="level_pengguna">
                <option value="Pimpinan">Pimpinan</option>
                <option value="Admin">Admin</option>
                <option value="Pegawai">Pegawai</option>
            </select>
        </div>
        <label for="status_user">Status User</label>
        <div class="form-group">
            <select class="form-control" name="status_user">
                <option value="Aktif" selected>Aktif</option>
            </select>
        </div>



    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </div>

</form>