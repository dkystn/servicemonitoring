<form class="user mt-2" method="post" action="<?php echo base_url('element/update_soal/' . $soal['id_soal']); ?>">
    <div class="container row">
        <div class="col-md-12">
            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit Soal </h5>
        </div>
        <div class="col-md-12">
            <label for="regional">Regional</label>
            <input class="form-control" type="text" disabled name="regional" id="regional" value="<?php echo $soal['regional']; ?>">
        </div>
        <div class="col-md-12">
            <label for="cabang">Cabang</label>
            <input class="form-control" type="text" disabled name="cabang" id="cabang" value="<?php echo $soal['cabang']; ?>">
        </div>
        <div class="col-md-12"> 
            <label for="type">Type Pertanyaan</label>
            <input class="form-control" type="text" readonly name="type" id="type" value="<?php echo $soal['type']; ?>">
        </div>
        <div class="col-md-12">
            <label for="type_journey">Type Journey</label>
            <input class="form-control" type="text" readonly name="type_journey" id="type_journey" value="<?php echo $soal['type_journey']; ?>">
        </div>
        <div class="col-md-12">
            <label for="type_option">Type Journey Option</label>
            <input class="form-control" type="text" readonly name="type_option" id="type_option" value="<?php echo $soal['type_option']; ?>">
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
                <input class="form-control" type="text" name="jawaban_1" id="jawaban_1" value="<?php echo $soal['jawaban_1']; ?>">
            </div>
        </div>
        <div class="col-md-12">
            <label for="jawaban_2">Jawaban 2</label>
            <div class="form-group">
                <input class="form-control" type="text" name="jawaban_2" id="jawaban_2" value="<?php echo $soal['jawaban_2']; ?>">
            </div>
        </div>
        <div class="col-md-12">
            <label for="jawaban_benar">Jawaban Benar</label>
            <div class="form-group">
                <input class="form-control" type="text" name="jawaban_benar" id="jawaban_benar" value="<?php echo $soal['jawaban_benar']; ?>">
            </div>
        </div>
        <div class="col-md-12">
            <label for="gambar_bukti">Gambar</label>
            <div class="form-group">
                <input class="form-control" type="text" name="gambar_bukti" id="gambar_bukti" value="<?php echo $soal['gambar_bukti']; ?>">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <a class="collapse-item" href="<?= base_url('element/soal'); ?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </a>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>

<!---Container Fluid-->