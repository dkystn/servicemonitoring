<style>
    .card {
    width: 95px;
    height: 120px;
    color: white;
    display: grid;
    gap: 5px;
    overflow: visible;
    }

    .card .item {
    border-radius: 10px;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    }

    .item:hover {
    transform: scale(1.10);
    transition: all 0.3s;
    }

    .item svg {
    width: 40px;
    height: 40px;
    margin-bottom: 7px;
    }

    .item--1 {
    background: #c7c7ff;
    }

    .quantity {
    font-size: 25px;
    font-weight: 600;
    }

    .text {
    font-size: 12px;
    font-family: inherit;
    font-weight: 600;
    }

    .text--1 {
    color: rgba(149,149,255,1);
    }
    .card-catatan {
    position: relative;
    width: 220px;
    height: 125px;
    border-radius: 14px;
    z-index: 1111;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: 20px 20px 60px #bebebe, -20px -20px 60px #ffffff;
    ;
    }

    .bg-catatan {
    position: absolute;
    top: 5px;
    left: 5px;
    width: 210px;
    height: 115px;
    z-index: 2;
    background: rgba(255, 255, 255, .95);
    backdrop-filter: blur(24px);
    border-radius: 10px;
    overflow: hidden;
    outline: 2px solid white;
    }

    .blob-catatan {
    position: absolute;
    z-index: 1;
    top: 50%;
    left: 50%;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-color: #ff0000;
    opacity: 1;
    filter: blur(12px);
    animation: blob-bounce 5s infinite ease;
    }

    @keyframes blob-bounce {
    0% {
        transform: translate(-100%, -100%) translate3d(0, 0, 0);
    }

    25% {
        transform: translate(-100%, -100%) translate3d(100%, 0, 0);
    }

    50% {
        transform: translate(-100%, -100%) translate3d(100%, 100%, 0);
    }

    75% {
        transform: translate(-100%, -100%) translate3d(0, 100%, 0);
    }

    100% {
        transform: translate(-100%, -100%) translate3d(0, 0, 0);
    }
    }

</style>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Laporan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Laporan</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Detail</li>
        </ol>
    </div>
    <div class="container">
        <form method="post" action="<?php echo base_url('element/update_laporan_edit/' . $laporan[0]->id_laporan); ?>" enctype="multipart/form-data">
            <?php if (isset($laporan) && !empty($laporan)) : ?>
                <?php $item = $laporan[0]; ?>
                <div class="row">
                    <div class="col-md-1">
                        <div class="card">
                            <div class="item item--1">
                                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"></path><path fill="rgba(149,149,255,1)" d="M17 15.245v6.872a.5.5 0 0 1-.757.429L12 20l-4.243 2.546a.5.5 0 0 1-.757-.43v-6.87a8 8 0 1 1 10 0zm-8 1.173v3.05l3-1.8 3 1.8v-3.05A7.978 7.978 0 0 1 12 17a7.978 7.978 0 0 1-3-.582zM12 15a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"></path></svg>
                                <span class="quantity"><?php echo $item->poin; ?></span>
                                <span class="text text--1"> Poin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="nama">Nama Pelapor</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text"  name="nama" id="nama"  value="<?php echo $item->nama; ?>" style="width:90%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <label for="tanggal">Tanggal</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="date"  name="tanggal" id="tanggal"  value="<?php echo $item->tanggal; ?>" style="width:90%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 " >
                        <div class="card-catatan">
                            <div class="bg-catatan">
                                <span style=" margin-left: 10px; font-size: 18px;"><?php echo $item->catatan; ?></span>
                            </div>
                            <div class="blob-catatan">

                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-body">
                    <?php
                    foreach ($soal as $key => $soal_item):;
                    $jawaban_pilihan_semua = isset($item->jawaban_pilihan) ? $item->jawaban_pilihan : '';
                    $jawaban_pilihan_array = explode(', ', $jawaban_pilihan_semua);
                    $jawaban_1_checked = '';
                    $jawaban_2_checked = '';

                        ${"jawaban_pilihan_no" . ($key + 1)} = isset($jawaban_pilihan_array[$key]) ? $jawaban_pilihan_array[$key] : '';
                        ${"jawaban_1_no" . ($key + 1)} = $soal_item->jawaban_1;
                        ${"jawaban_2_no" . ($key + 1)} = $soal_item->jawaban_2;
                        $jawaban_1_checked = (${"jawaban_pilihan_no" . ($key + 1)} == ${"jawaban_1_no" . ($key + 1)}) ? 'checked' : '';
                        $jawaban_2_checked = (${"jawaban_pilihan_no" . ($key + 1)} == ${"jawaban_2_no" . ($key + 1)}) ? 'checked' : '';
                        ?>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><?php echo $soal_item->soal; ?> </p>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                    <label class="custom-control custom-radio">
                                                        <input
                                                            name="radio_<?php echo $item->id_laporan; ?>_<?php echo $key + 1; ?>"
                                                            type="radio"
                                                            class="custom-control-input"
                                                            data-jawaban="jawaban_1"
                                                            value="<?php echo $soal_item->jawaban_1; ?>"
                                                            <?php echo $jawaban_1_checked; ?>
                                                        >
                                                        <span class="custom-control-label">
                                                            <?php echo $soal_item->jawaban_1; ?>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                    <label class="custom-control custom-radio">
                                                        <input
                                                            name="radio_<?php echo $item->id_laporan; ?>_<?php echo $key + 1; ?>"
                                                            type="radio"
                                                            class="custom-control-input"
                                                            data-jawaban="jawaban_2"
                                                            value="<?php echo $soal_item->jawaban_2; ?>"
                                                            <?php echo $jawaban_2_checked; ?>
                                                        >
                                                        <span class="custom-control-label">
                                                            <?php echo $soal_item->jawaban_2; ?>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <span>Jawaban Pilihan : </span>
                                                <span><?php echo $jawaban_pilihan_array[$key]; ?></span>
                                            
                                            </div>
                                            <div class="col-md-12">
                                                <span>Jawaban semua : </span>
                                                <span><?php echo $jawaban_pilihan_semua; ?></span>
                                            
                                            </div>
                                            <div class="col-md-12">
                                                <span>Jawaban Benar : </span>
                                                <span><?php echo $soal_item->jawaban_benar; ?></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span>File Pendukung :</span>
                                        <div class="modal-body text-center">
                                            <?php if (!empty($item->gambar)): ?>
                                                <?php $gambar_array = explode(',', $item->gambar); ?>
                                                <?php if (isset($gambar_array[$key])): ?>
                                                    <img src="<?php echo base_url() . 'uploads/' . $gambar_array[$key]; ?>" width="30%" alt="Gambar Kosong">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 mt-3">
                                        <span>Ubah File pendukung :</span>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-warning" style="font-size: 11px;">
                                            Gambar + <input type="file" name="gambar[]" multiple>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="modal-footer">
                <a class="collapse-item" href="<?= base_url('element/laporan_p_tolak'); ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </a>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
</div>