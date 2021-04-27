<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil Pegawai</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="/admin/pegawai/tambah">
                        <button type="button" class="btn btn-primary btn-sm" id="tambah_pegawai">
                            <i class="icon fas fa-plus"></i>
                            Tambah Pegawai
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <?php
                    if (session()->getFlashData('pesan')) {
                        echo "<input type='hidden' id='flash_data' value='" . session()->getFlashData('pesan') . "'>";
                    }
                    ?>
                    <style>
                        .dataTable tr td:last-child {
                            text-align: center;
                        }
                    </style>
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="bg-gray-dark">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($pegawai as $key => $value) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['nama'] ?></td>
                                    <td><?= $value['nip'] ?></td>
                                    <td><?= $value['jabatan'] ?></td>
                                    <td>
                                        <a href="/admin/pegawai/<?= $value['nik'] ?>">
                                            <button type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-fw fa-info"></i> Detail</button>
                                        </a>
                                        <form action="/admin/pegawai/<?= $value['nik'] ?>" class="d-inline form_delete" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="button" class="btn btn-sm  btn-danger">
                                                <i class="fas fa-fw fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>