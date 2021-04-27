<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<style>
    .custom .dashboard {
        display: flex;
        align-items: center;
        min-height: calc(100vh - 130px);
        font-family: "Stardos Stencil";
        font-weight: bold;
    }

    .custom .dashboard .title {
        font-size: 56px;
    }

    .custom .dashboard img {
        max-height: 300px;
        margin: 30px 0;
    }

    .custom .dashboard .welcome {
        font-size: 40px;
    }
</style>
<div class="content-wrapper">
    <div class="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto text-center">
                    <h1 class="title ">
                        PT BPR BKK KOTA SEMARANG
                    </h1>
                    <img src="/img/logo.png" class="img-fluid" alt="">
                    <?php
                    if ((session()->get('role') == 'Admin')) { ?>
                        <div class="welcome">Selamat Datang di Staffing and Payroll System, Admin BKK</div>
                    <?php  } else {
                    ?>
                        <div class="welcome">Selamat Datang di Staffing and Payroll System, <?= $pegawai['nama'] ?></div>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->


<?= $this->endSection(); ?>