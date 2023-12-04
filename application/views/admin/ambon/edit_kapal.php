<div class="container" style="width: 80%;">
<form class="user mt-2" method="post" action="<?php echo base_url('admin/update_kapal/' . $kapal['id_kapal']); ?>" >
    <div class="container row" >
        <div class="col-md-12">
            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit kapal </h5>
        </div>
        <div class="col-md-12 mb-2">
        <label for="cabang">Cabang</label>
                         <div class="form-group">
                             <select class="form-control" name="cabang">
                            
                             <?php  foreach ($data_cabang as $row) { ?>
                                    <?php $selected = ($kapal['id_cabang'] == $row->id_cabang) ? "selected" : ""; ?>
                                    <option value="<?php echo $row->id_cabang; ?>" <?php echo $selected; ?>><?php echo $row->cabang; ?></option>
                                <?php } ?>
                             </select>
                         </div>
        </div>
        <div class="col-md-12 mb-2">
            <label for="cabang">kapal</label>
            <input class="form-control" type="text" name="kapal" id="kapal" value="<?php echo $kapal['kapal']; ?>">
        </div>
    </div>

    <div class="modal-footer">
        <a class="collapse-item" href="<?= base_url('admin/pelabuhan_null'); ?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </a>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
</div>

<!---Container Fluid-->