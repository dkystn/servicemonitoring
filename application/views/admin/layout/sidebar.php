<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion " id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('Admin'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/'); ?>img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 12px;">Service Monitoring</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('Admin'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2" aria-expanded="true" aria-controls="collapseBootstrap2">
            <i class="fas fa-fw fa-database"></i>
            <span>Database Laporan</span>
        </a>
        <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Status Laporan</h6>
                <a class="collapse-item" href="<?= base_url('admin/laporan'); ?>">Proses</a>
                <a class="collapse-item" href="<?= base_url('admin/laporan_tolak'); ?>">Tolak</a>
                <a class="collapse-item" href="<?= base_url('admin/laporan_setuju'); ?>">Terima</a>
            </div>
        </div> 
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true" aria-controls="collapseTable">
            <i class="fas fa-fw fa-database"></i>
            <span>Database Akun </span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Akun</h6>
                <!-- <a class="collapse-item" href="<?= base_url('admin/tambah_user'); ?>">Tambah Akun User</a> -->
                <a class="collapse-item" href="<?= base_url('admin/akun_user'); ?>">Kelola Akun User</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable2" aria-expanded="true" aria-controls="collapseTable2">
            <i class="fas fa-fw fa-database"></i>
            <span>Database Item</span>
        </a>
        <div id="collapseTable2" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Item Penilaian</h6>
                <a class="collapse-item" href="<?= base_url('admin/regional_null'); ?>">Regional</a>
                <a class="collapse-item" href="<?= base_url('admin/cabang_null'); ?>">Cabang</a>
                <a class="collapse-item" href="<?= base_url('admin/journey_null'); ?>">Type Journey</a>
                <a class="collapse-item" href="<?= base_url('admin/pelabuhan_null'); ?>">Pelabuhan</a>
                <a class="collapse-item" href="<?= base_url('admin/kapal_null'); ?>">Kapal</a>
                <a class="collapse-item" href="<?= base_url('admin/typeoption_null'); ?>">Type Option</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable3" aria-expanded="true" aria-controls="collapseTable3">
            <i class="fas fa-fw fa-database"></i>
            <span>Database Pertanyaan</span>
        </a>
        <div id="collapseTable3" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pertanyaan</h6>
                <a class="collapse-item" href="<?= base_url('admin/soal'); ?>">Pertanyaan</a>
            </div>
        </div>
    </li>
    <!-- <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/tambah_laporan'); ?>">
            <i class="fas fa-fw fa-file"></i>
            <span>Isi Laporan Umum</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/tambah_laporan'); ?>">
            <i class="fas fa-fw fa-file"></i>
            <span>Testing Soal</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/laporan_masalah'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan Masalah</span>
        </a>
    </li> -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/asset'); ?>">
            <i class="fas fa-fw fa-file"></i>
            <span>Asset</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/ubah_sandi'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Profil Saya</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="version" >Version 2.0.5</div>
</ul>
<!-- Sidebar -->