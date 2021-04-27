<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link p-2 d-flex text-center bg-secondary" style="height:73px; align-items:center;">
        <img src="/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3 h-100 mt-0" style="max-height:none">
        <span class="brand-text"><b>SPS</b></span>
    </a>

    <!-- Sidebar -->
    <style>
        .layout-fixed.layout-navbar-fixed.custom .sidebar {
            margin-top: 73px;
            height: calc(100vh - 73px);
        }

        .layout-fixed .sidebar {
            margin-top: 73px;
        }
    </style>
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                if (session()->get('role') == 'Admin') { ?>
                    <li class="nav-item">
                        <a href="/admin/pegawai" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Data Pegawai
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/payroll" class="nav-link">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Payrol Pegawai
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>
                                Tunjangan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/tunjangan/lembur" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Lembur
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tunjangan/kinerja" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Kinerja
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tunjangan/teller" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Teller
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tunjangan/auditor" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Auditor
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tunjangan/hari-raya" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Hari Raya
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tunjangan/prestasi" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Prestasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tunjangan/pendidikan" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Pendidikan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tunjangan/tantiem" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Tantiem
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cut"></i>
                            <p>
                                Potongan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/potongan/angsuran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Angsuran
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/potongan/lain-lain" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Lain-lain
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Pengaturan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/pengaturan-tunjangan" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Tunjangan
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="/pegawai/profil" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Data Pegawai
                            </p>
                        </a>
                    </li>
                <?php  }
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>