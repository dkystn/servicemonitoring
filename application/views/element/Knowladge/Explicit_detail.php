<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Explicit Knowladge</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Khowladge</li>
            <li class="breadcrumb-item active" aria-current="page">Explicit</li>
        </ol> 
    </div>
    <?php if (isset($explicit) && !empty($explicit)) : ?>
        <div class="modal-body">
            <span>Judul</span>
            <p> <?php echo $explicit->judul_explicit; ?></p>
        </div>
        <div class="modal-body">
            <span>Keterangan</span>
            <p> <?php echo $explicit->keterangan_explicit; ?></p>
        </div>
        <div class="modal-body">
            <span>Tanggal</span>
            <p> <?php echo $explicit->tgl_explicit; ?></p>
        </div>
        <span>File</span>
        <div class="modal-body text-center">

            <img src="<?php echo base_url() . 'uploads/' . $explicit->gambar ?>" width="30%"> </img>
        </div>
    <?php endif; ?>
</div>