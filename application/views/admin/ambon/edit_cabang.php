<div class="container" style="width: 80%;">
<form class="user mt-2" method="post" action="<?php echo base_url('admin/update_cabang/' . $cabang['id_cabang']); ?>" >
    <div class="container row" >
        <div class="col-md-12">
            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit Cabang </h5>
        </div>
        <div class="col-md-12 mb-2">
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
        <div class="col-md-12 mb-2">
            <label for="cabang">Cabang</label>
            <input class="form-control" type="text" name="cabang" id="cabang" value="<?php echo $cabang['cabang']; ?>">
        </div>
    </div>

    <div class="modal-footer">
        <a class="collapse-item" href="<?= base_url('admin/cabang_null'); ?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </a>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
</div>

<!---Container Fluid-->