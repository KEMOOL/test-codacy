<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payroll</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php
            if (session()->getFlashData('pesan')) {
                echo "<input type='hidden' id='flash_data' value='" . session()->getFlashData('pesan') . "'>";
            }
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Tunjangan Jabatan</h4>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th>Jabatan</th>
                                        <th>Tunjangan</th>
                                        <th style="width: 70px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($jabatan as $key => $value) : ?>
                                        <tr class="tunjangan-pengaturan" id="<?= $value['id_tunjangan'] ?>">
                                            <td><?= ++$key ?></td>
                                            <td><?= $value['jabatan'] ?></td>
                                            <td class="nominal"><?= $value['nominal'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning btn-edit-tabel">
                                                    <i class="fas fa-fw fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Tunjangan Lain-Lain</h4>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th>Posisi</th>
                                        <th>Tunjangan</th>
                                        <th style="width: 70px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($lain_lain as $key => $value) : ?>
                                        <tr class="tunjangan-pengaturan" id="<?= $value['id_tunjangan'] ?>">
                                            <td><?= ++$key ?></td>
                                            <td><?= $value['jabatan'] ?></td>
                                            <td class="nominal"><?= $value['nominal'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning btn-edit-tabel">
                                                    <i class="fas fa-fw fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Tunjangan Operasional</h4>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th>Jabatan</th>
                                        <th>Tunjangan</th>
                                        <th style="width: 70px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($operasional as $key => $value) : ?>
                                        <tr class="tunjangan-pengaturan" id="<?= $value['id_tunjangan'] ?>">
                                            <td><?= ++$key ?></td>
                                            <td><?= $value['jabatan'] ?></td>
                                            <td class="nominal"><?= $value['nominal'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning btn-edit-tabel">
                                                    <i class="fas fa-fw fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Rumus</h4>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th>Nama</th>
                                        <th>Rumus</th>
                                        <th style="width: 70px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($rumus as $key => $value) : ?>
                                        <tr class="rumus" id="<?= $value['id_rumus'] ?>">
                                            <td><?= ++$key ?></td>
                                            <td><?= $value['nama'] ?></td>
                                            <td>
                                                <?php
                                                if ($value['nama'] == 'pasangan') { ?>
                                                    <?= $value['rumus'] ?> % dari gaji pokok
                                                <?php
                                                } elseif ($value['nama'] == 'anak') { ?>
                                                    <?= $value['rumus'] ?> % dari gaji pokok per anak
                                                <?php
                                                } elseif ($value['nama'] == 'pangan') {
                                                    $rumus = explode('|', $value['rumus']) ?>
                                                    <?= $rumus[0] ?> % * gaji pokok + <?= $rumus[1] ?> * jumlah anggota keluarga
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning btn-edit-tabel">
                                                    <i class="fas fa-fw fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal_tunjangan" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form Tunjangan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="/admin/tunjangan/tambah" method="POST" id="form_tunjangan">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jabatan">
                                        Jabatan <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control " id="jabatan" name="jabatan" placeholder="Masukkan Jabatan" required>
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
    <div class="modal fade" id="modal_rumus" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form Tunjangan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="/admin/rumus/tambah" method="POST" id="form_rumus">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="persentase">
                                Persentase <sup style="color: red;">*</sup>
                            </label>
                            <div class="input-group">
                                <input type="number" class="form-control " id="persentase" name="persentase" placeholder="Masukkan Persentase" min="0" max="100" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">% dari gaji pokok</span>
                                </div>
                                <div class="invalid-feedback"></div>
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