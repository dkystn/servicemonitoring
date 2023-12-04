<div class="container" style="width: 80%;">
<form class="user mt-2" method="post" action="<?php echo base_url('admin/update_regional/' . $regional['id_regional']); ?>" >
    <div class="container row" >
        <div class="col-md-12">
            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit Regional </h5>
        </div>
        <div class="col-md-12 mb-2">
            <label for="regional">Regional</label>
            <input class="form-control" type="text" name="regional" id="regional" value="<?php echo $regional['regional']; ?>">
        </div>
    </div>

    <div class="modal-footer">
        <a class="collapse-item" href="<?= base_url('admin/regional_null'); ?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </a>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
</div>

<!---Container Fluid-->