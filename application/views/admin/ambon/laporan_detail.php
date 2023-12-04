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
    .poin{
        display: flex;
            justify-content: end;
    }
    .text--1 {
    color: rgba(149,149,255,1);
    }
  
    input[type="radio"].readonly {
    opacity: 0.5; /* not necessary */
    pointer-events: none;
    }
    @media only screen and (max-width: 600px) {
  
    }

</style>
<!-- Container Fluid-->

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <span class="h3 mb-0 text-gray-800">Data Laporan </span>
        
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Laporan</li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </div>
     <!-- Ambil salah satu objek laporan -->
     
    <div class="row">
                    <div class="col-4 col-lg-3 poin">
                        <div class="card">
                            <div class="item item--1">
                                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"></path><path fill="rgba(149,149,255,1)" d="M17 15.245v6.872a.5.5 0 0 1-.757.429L12 20l-4.243 2.546a.5.5 0 0 1-.757-.43v-6.87a8 8 0 1 1 10 0zm-8 1.173v3.05l3-1.8 3 1.8v-3.05A7.978 7.978 0 0 1 12 17a7.978 7.978 0 0 1-3-.582zM12 15a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"></path></svg>
                                <span class="quantity"><?php echo $laporan->poin; ?></span>
                                <span class="text text--1"> Poin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 col-lg-8">
                        <div class="">
                            <div class="row">
                                <div class="col-4 col-lg-3">
                                    <label for="nama">Nama Pelapor</label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <input class="form-control" type="text"  name="nama" id="nama"  value="<?php echo $laporan->nama; ?>" style="width:90%;" readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-lg-3">
                                    <label for="tanggal">Tanggal</label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <input class="form-control" type="date"  name="tanggal" id="tanggal"  value="<?php echo $laporan->tanggal; ?>" style="width:90%;"  readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-lg-3">
                                    <label for="tanggal">Detail</label>
                                </div>
                                <?php $journey = $this->Model_laporan->journey($laporan->id_journey);
                                    $option = $this->Model_laporan->option($laporan->id_type_option);
                                    $kapal = $this->Model_laporan->kapal($laporan->id_kapal);
                                    $pelabuhan = $this->Model_laporan->pelabuhan($laporan->id_pelabuhan);
                                ?>
                                <div class="col-8 col-lg-9">
                                                    <?php echo $journey->journey; ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                <span style="display:<?php echo ($kapal == null) ? 'none' : 'inline'; ?>"><?php echo $kapal->kapal; ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" style="display:<?php echo ($kapal == null) ? 'none' : 'inline'; ?>">
                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                <span style="display:<?php echo ($pelabuhan == null) ? 'none' : 'inline'; ?>"><?php echo $pelabuhan->pelabuhan; ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" style="display:<?php echo ($pelabuhan == null) ? 'none' : 'inline'; ?>">
                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                <span><?php echo $option ->type_option; ?></span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3 col-lg-3">
                                    <label for="tanggal">Poin Kendaraan</label>
                                </div>
                                <div class="col-3 col-lg-3">
                                    <input class="form-control" type="text"  name="tanggal" id="tanggal"  value="<?php echo $laporan->poin_kendaraan; ?>" style="width:90%;"  readonly>
                                </div>
                                <div class="col-3 col-lg-3">
                                    <label for="tanggal">Poin Pejalan Kaki</label>
                                </div>
                                <div class="col-3 col-lg-3">
                                    <input class="form-control" type="text"  name="tanggal" id="tanggal"  value="<?php echo $laporan->poin_pejalan_kaki; ?>" style="width:90%;"  readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="modal-body">
        <?php foreach ($soal as $key => $soal_all): ?>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                        <div class="col-md-6">
                            <p><?php echo $soal_all->soal; ?> </p>
                            <p> - <?php echo $soal_all->jawaban_1; ?><br>
                                - <?php echo $soal_all->jawaban_2; ?></p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6 col-lg-12">
                                    <span>Jawaban Benar</span>
                                    <p><?php echo $soal_all->jawaban_benar; ?></p>
                                </div>
                                <div class="col-6 col-lg-12">
                                    <span>Jawaban Laporan</span>
                                    <?php $jawaban_array = explode(', ', $laporan->jawaban_pilihan); ?>
                                    <p><?php echo $jawaban_array[$key]; ?></p>
                                </div>
                                <div class="col-6 col-lg-12">
                                    <span>Type Soal</span>
                                    <?php $type = explode(', ', $laporan->type); ?>
                                    <p><?php echo $type[$key]; ?></p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-md-6">
                <span>File Pendukung :</span>
                <div class="modal-body text-center">
                    <?php if (!empty($laporan->gambar)): ?>
                        <?php $gambar_array = explode(',', $laporan->gambar); ?>
                        <?php if (isset($gambar_array[$key])): ?>
                            <img src="<?php echo base_url() . 'uploads/' . $gambar_array[$key]; ?>" width="30%" alt="Gambar Kosong">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    </div>
</div>