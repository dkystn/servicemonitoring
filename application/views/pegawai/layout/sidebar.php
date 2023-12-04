<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('Beranda'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/'); ?>img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 12px;">Service Monitoring</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('Beranda'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider"> 
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2" aria-expanded="true" aria-controls="collapseBootstrap2">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Data Laporan</span>
        </a>
        <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Penilaian</h6>
                <a class="collapse-item" href="<?= base_url('pegawai/laporan_proses'); ?>">Proses</a>
                <a class="collapse-item" href="<?= base_url('pegawai/laporan_tolak'); ?>">Tolak</a>
                <a class="collapse-item" href="<?= base_url('pegawai/laporan_setuju'); ?>">Terima</a>
            </div> 
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage2" aria-expanded="true" aria-controls="collapsePage2">
            <i class="fas fa-fw fa-columns"></i>
            <span>Laporan</span>
        </a>
        <div id="collapsePage2" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan</h6>
                <!-- <a class="collapse-item" href="<?= base_url('pegawai/tambah_laporan'); ?>">Laporan</a> -->
                <a class="collapse-item" href="<?= base_url('beranda/tambah_laporan'); ?>">Laporan </a>
            </div>
        </div>
    </li> 
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pegawai/ubah_sandi'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Profil Saya</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>
<!-- Sidebar -->