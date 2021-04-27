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
            <div class="card ">
                <div class="card-body" id="payroll">
                    <?= csrf_field() ?>
                    <?php
                    if (session()->getFlashData('error')) {
                        echo "<input type='hidden' id='error_flash_data' value='" . session()->getFlashData('error') . "'>";
                    }
                    if (session()->getFlashData('success')) {
                        echo "<input type='hidden' id='flash_data' value='" . session()->getFlashData('success') . "'>";
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bulan">Bulan</label>
                                <select class="form-control select2 single" id="bulan" name="bulan" data-placeholder="Pilih bulan" style="width: 100%;">
                                    <option></option>
                                    <?php
                                    setlocale(LC_ALL, 'id-ID', 'id_ID');
                                    foreach ($bulan as $bulan) : ?>
                                        <option value=<?= $bulan ?> <?= ($bulan == strftime('%B')) ? 'selected' : '' ?>><?= $bulan ?></option>
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
                    <div class="mb-3" id="tampilkan">
                        <div class="row">
                            <div class="col-lg-8"><button type="button" class="btn btn-primary" id="tampil_data">
                                    <b>Tampilkan</b>
                                </button>
                                <button type="button" class="btn btn-success export" id="Gaji">
                                    <i class="fas fa-file-export"></i><b> Export Gaji</b>
                                </button>
                                <button type="button" class="btn btn-success export" id="Pajak">
                                    <i class="fas fa-file-export"></i><b> Export Pajak</b>
                                </button>
                            </div>
                            <div class="col-lg-4">
                                <?php
                                if ($tombolPangkat) {
                                ?>
                                    <a href="/admin/payroll/naikPangkat">
                                        <button type="button" class="btn btn-primary float-right" id="naik_pangkat">
                                            <b>Naik Pangkat</b>
                                        </button>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered datatables" id="tabel_payroll">
                            <thead class="bg-gray-dark">
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Unit Kerja</th>
                                    <th rowspan="2">Pangkat</th>
                                    <th rowspan="2">Status Marital</th>
                                    <th rowspan="2">Jumlah Anak</th>
                                    <th rowspan="2">Jabatan</th>
                                    <th rowspan="2">Gaji Pokok</th>
                                    <th rowspan="2">Tunjangan Suami/Istri</th>
                                    <th rowspan="2">Tunjangan Anak</th>
                                    <th rowspan="2">Lembur</th>
                                    <th rowspan="2">Tunjangan Pangan</th>
                                    <th rowspan="2">Tunjangan Jabatan</th>
                                    <th rowspan="2">Tunjangan Operasional</th>
                                    <th rowspan="2">Tunjangan Kinerja</th>
                                    <th rowspan="2">Tunjangan Teller</th>
                                    <th rowspan="2">Tunjangan Auditor</th>
                                    <th rowspan="2">Jumlah</th>
                                    <th rowspan="2">BPJS Kesehatan</th>
                                    <th colspan="2">BPJS Ketenagakerjaan</th>
                                    <th rowspan="2">Angsuran Pinjaman</th>
                                    <th rowspan="2">Lain-lain Potongan</th>
                                    <th rowspan="2">Jumlah Potongan</th>
                                    <th rowspan="2">Gaji Bersih</th>
                                    <th rowspan="2">THR</th>
                                    <th rowspan="2">Tunjangan Prestasi</th>
                                    <th rowspan="2">Tunjangan Pendidikan</th>
                                    <th rowspan="2">Jaspro/Tantiem</th>
                                    <th rowspan="2">No Rekening</th>
                                    <th rowspan="2">Bank</th>
                                </tr>
                                <tr>
                                    <th>J. Hari Tua</th>
                                    <th>J. Pensiun</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($payroll as $key => $value) : ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= $value['nama'] ?></td>
                                        <td><?= $value['unit_kerja'] ?></td>
                                        <td><?= $value['pangkat'] ?></td>
                                        <td><?= $value['status_marital'] ?></td>
                                        <td><?= $value['jumlah_anak'] ?></td>
                                        <td><?= $value['jabatan'] ?></td>
                                        <td class="nominal"><?= $value['gaji_pokok'] ?></td>
                                        <td class="nominal"><?= $value['t_pasangan'] ?></td>
                                        <td class="nominal"><?= $value['t_anak'] ?></td>
                                        <td class="nominal"><?= $value['lembur'] ?></td>
                                        <td class="nominal"><?= $value['t_pangan'] ?></td>
                                        <td class="nominal"><?= $value['t_jabatan'] ?></td>
                                        <td class="nominal"><?= $value['t_operasional'] ?></td>
                                        <td class="nominal"><?= $value['t_kinerja'] ?></td>
                                        <td class="nominal"><?= $value['t_teller'] ?></td>
                                        <td class="nominal"><?= $value['t_auditor'] ?></td>
                                        <td class="nominal"><?= $value['jumlah'] ?></td>
                                        <td class="nominal"><?= $value['bpjs_kes'] ?></td>
                                        <td class="nominal"><?= $value['j_hari_tua'] ?></td>
                                        <td class="nominal"><?= $value['j_pensiun'] ?></td>
                                        <td class="nominal"><?= $value['p_angsuran'] ?></td>
                                        <td class="nominal"><?= $value['p_lain_lain'] ?></td>
                                        <td class="nominal"><?= $value['jumlah_potongan'] ?></td>
                                        <td class="nominal"><?= $value['gaji_bersih'] ?></td>
                                        <td class="nominal"><?= $value['thr'] ?></td>
                                        <td class="nominal"><?= $value['t_prestasi'] ?></td>
                                        <td class="nominal"><?= $value['t_pendidikan'] ?></td>
                                        <td class="nominal"><?= $value['tantiem'] ?></td>
                                        <td class=""><?= $value['no_rekening'] ?></td>
                                        <td class=""><?= $value['bank'] ?></td>
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
    </section>
</div>

<?= $this->endSection(); ?>