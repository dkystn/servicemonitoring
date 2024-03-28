<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    <h3>Selamat Datang !</h3>
    <span>Selamat anda berasil login sebagai Admin </span>
 
    <div class="row mb-3 mt-3">
        <div class="col-md-6">
            <img src="<?= base_url('assets/'); ?>img/boy.png" width:100px;>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class=" col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Nilai Total Kendaraan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">98</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Nilai Total Pejalan Kaki</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">99</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Akun User</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumlah_data; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---Container Fluid-->