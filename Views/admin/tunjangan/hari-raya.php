<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tunjangan hariraya</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm text-right btn-tambah-data" id="tambah_tunjangan_hariraya">
                        <i class="icon fas fa-plus"></i>
                        Tambah Data
                    </button>
                </div>
                <div class="card-body" id="tunjangan_hariraya">
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bulan">Bulan</label>
                                <select class="form-control select2 single" id="bulan" name="bulan" data-placeholder="Pilih bulan" style="width: 100%;">
                                    <option></option>
                                    <?php
                                    foreach ($bulan as $key => $bulan) : ?>
                                        <option value='<?= ++$key ?>' <?= ($key == intval(date('m'))) ? 'selected' : '' ?>><?= $bulan ?></option>
                                    <?php endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tahun">tahun</label>
                                <select class="form-control select2 single" id="tahun" name="tahun" data-placeholder="Pilih tahun" style="width: 100%;">
                                    <option></option>
                                    <?php
                                    if ($tahun) {
                                        foreach ($tahun as $tahun) : ?>
                                            <option value='<?= $tahun['tahun'] ?>' <?= ($tahun['tahun'] == intval(date('Y'))) ? 'selected' : '' ?>><?= $tahun['tahun'] ?></option>
                                        <?php endforeach;
                                    } else { ?>
                                        <option value='<?= date('Y') ?>' selected><?= date('Y') ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success mb-3" id="tampil_data">
                        <b>Tampilkan</b>
                    </button>
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="bg-gray-dark">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($pegawai as $key => $value) : ?>
                                <tr class="tunjangan-hariraya" id="<?= $value['id'] ?>">
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['nama'] ?></td>
                                    <td><?= $value['nik'] ?></td>
                                    <td class="nominal"><?= $value['nominal'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning btn-edit-tabel">
                                            <i class="fas fa-fw fa-edit"></i> Edit
                                        </button>
                                        <form action="/admin/tunjangan/hariraya/<?= $value['id'] ?>" class="d-inline form_delete" method="post">
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
    <div class="modal fade" id="modal_tunjangan_hariraya" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form hariraya</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="/admin/hariraya/tambah" method="POST" id="form_hariraya">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nik">
                                        NIK <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control " id="nik" name="nik" placeholder="Masukkan nik" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nominal">
                                        Nominal <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Rp
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Masukkan Nominal" min="0" max="2147483647" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="icon fas fa-paper-plane"></i> <b>Submit</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>