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
    @media only screen and (max-width: 600px) {
        .catatan{
            display: flex;
            justify-content: center;
            margin-top:30px;
        }
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
        <form method="post" action="<?php echo base_url('pegawai/update_laporan_edit/' . $laporan->id_laporan); ?>" enctype="multipart/form-data">
        
                <div class="row">
                    <div class="col-4 col-lg-2">
                        <div class="card">
                            <div class="item item--1">
                                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"></path><path fill="rgba(149,149,255,1)" d="M17 15.245v6.872a.5.5 0 0 1-.757.429L12 20l-4.243 2.546a.5.5 0 0 1-.757-.43v-6.87a8 8 0 1 1 10 0zm-8 1.173v3.05l3-1.8 3 1.8v-3.05A7.978 7.978 0 0 1 12 17a7.978 7.978 0 0 1-3-.582zM12 15a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"></path></svg>
                                <span class="quantity"><?php echo $laporan->poin; ?></span>
                                <span class="text text--1"> Poin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 col-lg-7">
                        <div class="">
                            <div class="row">
                                <div class="col-4 col-lg-3">
                                    <label for="nama">Nama Pelapor</label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <input class="form-control" type="text"  name="nama" id="nama"  value="<?php echo $laporan->nama; ?>" style="width:90%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-lg-3">
                                    <label for="tanggal">Tanggal</label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <input class="form-control" type="date"  name="tanggal" id="tanggal"  value="<?php echo $laporan->tanggal; ?>" style="width:90%;">
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
                        </div>
                    </div>
                    <div class="col-md-3 catatan" >
                        <div class="card-catatan">
                            <div class="bg-catatan">
                                <span style=" margin-left: 10px; font-size: 18px;"><?php echo $laporan->catatan; ?></span>
                            </div>
                            <div class="blob-catatan">

                            </div>
                        </div> 
                    </div>
                    
                </div>
                <div class="modal-body">
                <?php foreach ($soal as $key => $soal_all) { 
                  
                    
                    // $key ++;
                        ?> 
                        <hr>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                            <?php $jawaban_array = explode(', ', $laporan->jawaban_pilihan); 
                                                    $type_array = explode(', ', $laporan->type) ;
                                            ?>
                                            <div class="col-md-12">
                                                <input type="hidden" value="<?php echo $type_array[$key]; ?>">
                                                </div>
                                                <div class="col-md-12">
                                                    <p><?php echo $soal_all->soal; ?> </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                        <label class="custom-control custom-radio">
                                                            <input
                                                                name="radio_<?php echo $key + 1; ?>"
                                                                type="radio"
                                                                class="custom-control-input"
                                                                data-jawaban="jawaban_1"
                                                                value="<?php echo $soal_all->jawaban_1; ?>"
                                                                <?php echo  $jawaban_array[$key] == $soal_all->jawaban_1 ? 'checked' : ''; ?>
                                                            >
                                                            <span class="custom-control-label">
                                                                <?php echo $soal_all->jawaban_1; ?>
                                                            </span>
                                                            
                                                        </label>
                                                    </div>
                                                    
                                                </div> 
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                        <label class="custom-control custom-radio">
                                                            <input
                                                                name="radio_<?php echo $key + 1; ?>"
                                                                type="radio"
                                                                class="custom-control-input"
                                                                data-jawaban="jawaban_2"
                                                                value="<?php echo $soal_all->jawaban_2; ?>"
                                                                <?php echo  $jawaban_array[$key] == $soal_all->jawaban_2 ? 'checked' : ''; ?>
                                                            >
                                                            <span class="custom-control-label">
                                                                <?php echo $soal_all->jawaban_2; ?>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- <input type="text" name="jawaban_benar_<?php echo $key + 1; ?>" value="<?php echo $soal_all->jawaban_benar; ?>"> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
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
                                        
                                        <div class="col-md-12 mb-3 mt-3">
                                            <span>Ubah File pendukung :</span>
                                        </div>
                                        <div class="col-md-12">
                                                <label  class="btn btn-warning" style="font-size: 11px;" for="file">
                                                    Gambar + <input type="file" id="file" name="gambar[]" multiple>
                                                </label>
                                            </div>
                                    </div>
                                </div>
                        
                            
                            </div>
                        <?php } ?>
                </div>
            <div class="modal-footer">
                <a class="collapse-item" href="<?= base_url('pegawai/close_laporan_tolak'); ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </a>
                <button type="submit" class="btn btn-primary" onclick="confirmSubmit(event)">Edit</button>
            </div>
        </form>
    </div>
</div>
<script>
        function confirmSubmit(event) {
            event.preventDefault(); // Mencegah aksi default pengiriman form

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin dengan jawaban Anda?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengirim form jika pengguna yakin
                    event.target.form.submit();
                }
            });
        }
    </script>