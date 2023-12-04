<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Laporan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Laporan</li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </div>
    <?php if (isset($laporan) && !empty($laporan)) : ?>
    <?php $item = $laporan[0]; ?> <!-- Ambil salah satu objek laporan -->
    <div class="row">
        <div class="col-md-2">
            <div class="modal-body">
            <span>Nama Pelapor</span>
            <p><?php echo $item->nama; ?></p>
            </div>
        </div>
        <div class="col-md-1">  
            <div class="modal-body">
                <span>Poin</span>
                <p><?php echo $item->poin; ?></p>
            </div> 
        </div>
        <div class="col-md-2">  
            <div class="modal-body">
                <span>Tanggal</span>
                <p><?php echo $item->tanggal; ?></p>
            </div>
        </div>
        <div class="col-md-2">  
            <div class="modal-body">
                <span>Cabang</span>
                <p><?php echo $item->cabang; ?></p>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <?php foreach ($soal as $key => $soal_item): ?>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                        <p><?php echo $soal_item->soal; ?> </p>
                           <p> - <?php echo $soal_item->jawaban_1; ?><br>
                            - <?php echo $soal_item->jawaban_2; ?></p>
                            
                        </div>
                        <div class="col-md-6">
                            <span>Jawaban Benar</span>
                            <p><?php echo $soal_item->jawaban_benar; ?></p>
                            <span>Jawaban Laporan</span>
                            <?php $jawaban_array = explode(',', $item->jawaban_pilihan); ?>
                            <p><?php echo $jawaban_array[$key]; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
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
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</div>