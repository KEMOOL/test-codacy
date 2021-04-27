<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark bg-secondary" style="height: 73px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <style>
                .custom .main-header .nav-link {
                    height: auto;
                }

                .custom .nav-link .avatar {
                    width: auto;
                    max-height: 40px;
                }

                .custom .dropdown-toggle::after {
                    display: inline-block;
                    margin-left: .255em;
                    border-top: .3em solid;
                    border-right: .3em solid transparent;
                    border-bottom: 0;
                    border-left: .3em solid transparent;
                    width: 1rem;
                    text-align: center;
                    vertical-align: 0;
                    border: 0;
                    font-weight: 900;
                    content: '\f105';
                    font-family: 'Font Awesome 5 Free';
                }

                .custom .show .dropdown-toggle::after {
                    content: '\f107';
                }
            </style>
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <?php
                if ((session()->get('role') == 'Admin')) { ?>
                    <img src="/img/logo.png" class="avatar img-circle elevation-2 mr-2" alt="User Image">
                    BKK
                <?php  } else {
                ?>
                    <img src="/img/profil/<?= $pegawai['foto'] ?>" class="avatar img-circle elevation-2 mr-2" alt="User Image">
                    <?= $pegawai['nama'] ?>
                <?php
                } ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <!-- <a class="nav-link text-center p-0" href="#"> -->
                <button class="btn btn-primary btn-block btn-flat" id="ganti_password" data-toggle="modal" data-target="#modal_ganti_password">Ganti Password</button>
                <!-- </a> -->
                <a class="nav-link text-center" href="/login/logout">
                    <b style="color: red;"><i class="fas fa-sign-out-alt"></i> Keluar</b>
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->