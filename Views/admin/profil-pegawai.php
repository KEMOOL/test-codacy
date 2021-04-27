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

    <style>
        .tab-content h4 {
            text-decoration: underline;
        }

        .tab-content .avatar {
            max-width: 400px;
            width: 100%;
            margin-top: 5px;
            margin-bottom: 10px;
            padding-right: 10px;
        }

        #tabel_identitas_pegawai tr td:first-child {
            width: 210px;
            text-align: right;
            padding-right: 15px;
        }

        #tabel_identitas_pegawai tr td:last-child {
            padding-left: 15px;
        }

        .dokumen {
            width: 100%;
            max-width: 200px;
            height: auto;
        }

        .header {
            margin-top: 30px;
            margin-bottom: 5px;
            min-height: 32px;
        }

        .header h5 {
            display: inline-block;
        }

        .header button {
            float: right;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <?php
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        ?>
        <div class="container-fluid">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1 bg-gray-dark">
                    <ul class="nav nav-tabs" id="tab_profil" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab_identitas" data-toggle="pill" href="#isi_tab_identitas" role="tab" aria-controls="isi_tab_identitas" aria-selected="true">Identitas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab_keluarga" data-toggle="pill" href="#isi_tab_keluarga" role="tab" aria-controls="isi_tab_keluarga" aria-selected="false">Keluarga</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab_pendidikan" data-toggle="pill" href="#isi_tab_pendidikan" role="tab" aria-controls="isi_tab_pendidikan" aria-selected="false">Pendidikan/Pelatihan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab_pelanggaran" data-toggle="pill" href="#isi_tab_pelanggaran" role="tab" aria-controls="isi_tab_pelanggaran" aria-selected="false">Pelanggaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab_cuti" data-toggle="pill" href="#isi_tab_cuti" role="tab" aria-controls="isi_tab_cuti" aria-selected="false">Cuti dan Izin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab_penilaian" data-toggle="pill" href="#isi_tab_penilaian" role="tab" aria-controls="isi_tab_penilaian" aria-selected="false">Penilaian</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <?php
                    if (session()->getFlashData('pesan')) {
                        echo "<input type='hidden' id='flash_data' value='" . session()->getFlashData('pesan') . "'>";
                    }
                    if (session()->getFlashData('error')) {
                        echo "<input type='hidden' id='error_flash_data' value='" . session()->getFlashData('error') . "'>";
                    }
                    ?>
                    <div class="tab-content" id="isi_tab_profil">
                        <div class="tab-pane fade show active" id="isi_tab_identitas" role="tabpanel" aria-labelledby="tab_identitas">
                            <h4>Identitas Pegawai</h4>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <img src="/dokumen/identitas/foto/<?= $pegawai['id_pegawai'] ?>/<?= $pegawai['foto'] ?>" class="avatar img-fluid" alt="">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-sm no-border" id="tabel_identitas_pegawai">
                                        <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td id="nama"><?= $pegawai['nama'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>NIP</td>
                                                <td id="nip"><?= $pegawai['nip'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jabatan</td>
                                                <td id="jabatan"><?= $pegawai['jabatan'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>NIK</td>
                                                <td id="nik"><?= $pegawai['nik'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>No NPWP</td>
                                                <td id="no_npwp"><?= $pegawai['no_npwp'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Peserta BPJS TK</td>
                                                <td id="no_bpjs_tk"><?= $pegawai['no_bpjs_tk'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Peserta BPJS Kesehatan</td>
                                                <td id="no_bpjs_kes"><?= $pegawai['no_bpjs_kes'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Peserta DPLK</td>
                                                <td id="no_dplk"><?= $pegawai['no_dplk'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tempat Lahir</td>
                                                <td id="tempat_lahir"><?= $pegawai['tempat_lahir'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td id="tanggal_lahir">
                                                    <?= strftime("%d %B %Y", strtotime($pegawai['tanggal_lahir'])); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Email</td>
                                                <td id="email"><?= $pegawai['email'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td id="jenis_kelamin"><?= $pegawai['jenis_kelamin'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Agama</td>
                                                <td id="agama"><?= $pegawai['agama'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Golongan Darah</td>
                                                <td id="goln_darah"><?= $pegawai['gol_darah'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Telephon</td>
                                                <td id="no_telp"><?= $pegawai['no_telp'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Rumah</td>
                                                <td id="alamat_rumah"><?= $pegawai['alamat_rumah'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Domisili</td>
                                                <td id="alamat_domisili"><?= $pegawai['alamat_domisili'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status Pegawai</td>
                                                <td id="status_pegawai"><?= $pegawai['status_pegawai'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status Pernikahan</td>
                                                <td id="status_pernikahan"><?= $pegawai['status_pernikahan'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Pendidikan Terakhir</td>
                                                <td id="pendidikan"><?= $pegawai['pendidikan_terakhir'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Pangkat/ Golongan/ Ruang</td>
                                                <td id="pangkat"><?= $pegawai['gol_ruang_masa_kerja'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Penerimaan Gaji Bulan Ini</td>
                                                <td id="gaji_berkala"><?= $pegawai['gaji_berkala'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-primary mr-3 btn-dokumen" id="dokumen_identitas_pegawai">
                                    <i class="fas fa-fw fa-file mr-1"></i> Lihat Dokumen
                                </button>
                                <a href="/admin/pegawai/edit/<?= $pegawai['nik'] ?>">
                                    <button type="button" class="btn btn-warning" style="width: 160px;">
                                        <i class="fas fa-fw fa-edit mr-1"></i> Edit
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="isi_tab_keluarga" role="tabpanel" aria-labelledby="tab_keluarga">
                            <h4>Keluarga Pegawai</h4>
                            <div class="header">
                                <h5>Suami/Istri</h5>
                                <?php
                                if ($pegawai['status_pernikahan'] != 'Belum Menikah') { ?>
                                    <button type="button" class="btn btn-primary btn-sm text-right btn-tambah-data" id="tambah_pasangan">
                                        <i class="icon fas fa-plus"></i>
                                        Tambah Data
                                    </button>
                                <?php  }
                                ?>

                            </div>
                            <div class="table-responsive pl-5">
                                <table class="table table-bordered" id="tabel_pasangan_pegawai">
                                    <thead class="bg-gray-dark">
                                        <tr>
                                            <th style="width: 10px">No.</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>TTL</th>
                                            <th>No. Telp</th>
                                            <th>Pekerjaan</th>
                                            <th>Hubungan</th>
                                            <th>Pendidikan</th>
                                            <th>Dokumen</th>
                                            <th style="width: 101px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!$pasangan) { ?>
                                            <tr>
                                                <td colspan="10" style="text-align: center;">Data Belum Diisi atau Belum Mempunyai Pasangan</td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($pasangan as $key => $value) :
                                            ?>
                                                <tr class="pasangan" id="<?= $value['id_pasangan'] ?>">
                                                    <td><?= ++$key ?></td>
                                                    <td><?= $value['nama'] ?></td>
                                                    <td><?= $value['nik'] ?></td>
                                                    <td><?= $value['ttl'] ?></td>
                                                    <td><?= $value['no_telp'] ?></td>
                                                    <td><?= $value['pekerjaan'] ?></td>
                                                    <td id="hubungan_pasangan"><?= $value['hubungan'] ?></td>
                                                    <td><?= $value['pendidikan'] ?></td>
                                                    <td>
                                                        <?php
                                                        if (explode('.', $value['file_nik'])[1] == 'pdf') { ?>
                                                            <a data-fancybox data-type='iframe' data-src='/dokumen/identitas/<?= $pegawai[' id_pegawai'] ?>/<?= $value['file_nik'] ?>' href='javascript:;'>
                                                                <button type='button' class='btn btn-sm btn-primary mb-2'>Lihat</button>
                                                            </a>
                                                        <?php
                                                        } else { ?>
                                                            <a href='/dokumen/identitas/<?= $pegawai['id_pegawai'] ?>/<?= $value['file_nik'] ?>' data-fancybox data-caption='NIK  <?= $value['nama'] ?>'>
                                                                <button type='button' class='btn btn-sm btn-primary mb-2'>Lihat</button>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>
                                                        <button type='button' class='btn btn-sm btn-success mr-0 download-dokumen' onclick='downloadDokumen(event)'>
                                                            <i class='fas fa-fw fa-file-download mr-1'></i> Download
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button type=" button" class="btn btn-sm btn-warning mb-2 btn-edit-tabel">
                                                            <i class="fas fa-fw fa-edit"></i> Edit
                                                        </button>
                                                        <form action="/admin/pasangan/<?= $value['nik'] ?>" class="d-inline form_delete" method="post">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="button" class="btn btn-sm  btn-danger">
                                                                <i class="fas fa-fw fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                            endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="header">
                                <h5>Anak</h5>
                                <?php
                                if ($pegawai['status_pernikahan'] != 'Belum Menikah') { ?>
                                    <button type="button" class="btn btn-primary btn-sm text-right btn-tambah-data" id="tambah_anak">
                                        <i class="icon fas fa-plus"></i>
                                        Tambah Data
                                    </button>
                                <?php  }
                                ?>
                            </div>
                            <div class="table-responsive pl-5">
                                <table class="table table-bordered" id="tabel_anak_pegawai">
                                    <thead class="bg-gray-dark">
                                        <tr>
                                            <th style="width: 10px">No.</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>TTL</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Pekerjaan</th>
                                            <th>Hubungan</th>
                                            <th>Pendidikan</th>
                                            <th style="width: 101px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!$anak) { ?>
                                            <tr>
                                                <td colspan="9" style="text-align: center;">Data Belum Diisi atau Belum Mempunyai Anak</td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($anak as $key => $value) :
                                            ?>
                                                <tr class="anak" id="<?= $value['id_anak'] ?>">
                                                    <td><?= ++$key ?></td>
                                                    <td><?= $value['nama'] ?></td>
                                                    <td><?= $value['nik'] ?></td>
                                                    <td><?= $value['ttl'] ?></td>
                                                    <td><?= $value['jenis_kelamin'] ?></td>
                                                    <td><?= $value['pekerjaan'] ?></td>
                                                    <td><?= $value['hubungan'] ?></td>
                                                    <td><?= $value['pendidikan'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning mb-2 btn-edit-tabel">
                                                            <i class="fas fa-fw fa-edit"></i> Edit
                                                        </button>
                                                        <form action="/admin/anak/<?= $value['nik'] ?>" class="d-inline form_delete" method="post">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="button" class="btn btn-sm  btn-danger">
                                                                <i class="fas fa-fw fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                            endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="isi_tab_pendidikan" role="tabpanel" aria-labelledby="tab_pendidikan">
                            <h4>Pendidikan dan Pelatihan</h4>
                            <div class="header">
                                <h5>Pendidikan Formal</h5>
                                <button type="button" class="btn btn-primary btn-sm text-right btn-tambah-data" id="tambah_pendidikan">
                                    <i class="icon fas fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                            <div class="table-responsive pl-5">
                                <table class="table table-bordered" id="tabel_pendidikan_formal">
                                    <thead class="bg-gray-dark">
                                        <tr>
                                            <th style="width: 10px">No.</th>
                                            <th>Nama Sekolah</th>
                                            <th>Tahun Lulus</th>
                                            <th>Jurusan</th>
                                            <th>Alamat Sekolah</th>
                                            <th style="width: 170px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!$pendidikan) { ?>
                                            <tr>
                                                <td colspan="9" style="text-align: center;">Data Belum Diisi atau Belum Mempunyai Pendidikan</td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($pendidikan as $key => $value) : ?>
                                                <tr class="pendidikan" id="<?= $value['id_pendidikan'] ?>">
                                                    <td><?= ++$key ?></td>
                                                    <td><?= $value['nama'] ?></td>
                                                    <td><?= $value['tahun_lulus'] ?></td>
                                                    <td><?= $value['jurusan'] ?></td>
                                                    <td><?= $value['alamat'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning btn-edit-tabel">
                                                            <i class="fas fa-fw fa-edit"></i> Edit
                                                        </button>
                                                        <form action="/admin/pendidikan/<?= $value['id_pendidikan'] ?>" class="d-inline form_delete" method="post">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="button" class="btn btn-sm  btn-danger">
                                                                <i class="fas fa-fw fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="header">
                                <h5>Pelatihan dan Data Kursus</h5>
                                <button type="button" class="btn btn-primary btn-sm text-right btn-tambah-data" id="tambah_pelatihan">
                                    <i class="icon fas fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                            <div class="table-responsive pl-5">
                                <table class="table table-bordered" id="tabel_pelatihan">
                                    <thead class="bg-gray-dark">
                                        <tr>
                                            <th style="width: 10px">No.</th>
                                            <th>Judul Pelatihan</th>
                                            <th>Penyelenggara</th>
                                            <th>Tanggal</th>
                                            <th>Lokasi</th>
                                            <th style="width: 170px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!$pelatihan) { ?>
                                            <tr>
                                                <td colspan="9" style="text-align: center;">Data Belum Diisi atau Belum Mempunyai Pelatihan</td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($pelatihan as $key => $value) : ?>
                                                <tr class="pelatihan" id="<?= $value['id_pelatihan'] ?>">
                                                    <td><?= ++$key ?></td>
                                                    <td><?= $value['judul'] ?></td>
                                                    <td><?= $value['penyelenggara'] ?></td>
                                                    <td class="tanggal_pelatihan"><?= $value['tanggal'] ?></td>
                                                    <td><?= $value['lokasi'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning btn-edit-tabel">
                                                            <i class="fas fa-fw fa-edit"></i> Edit
                                                        </button>
                                                        <form action="/admin/pelatihan/<?= $value['id_pelatihan'] ?>" class="d-inline form_delete" method="post">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="button" class="btn btn-sm  btn-danger">
                                                                <i class="fas fa-fw fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-primary mr-3 btn-dokumen float-right" id="dokumen_pendidikan_pelatihan" style="width: 160px;">
                                <i class="fas fa-fw fa-file mr-1"></i> Lihat Dokumen
                            </button>
                        </div>
                        <div class="tab-pane fade" id="isi_tab_pelanggaran" role="tabpanel" aria-labelledby="tab_pelanggaran">
                            <h4>Data Pelanggaran</h4>
                            <div class="header">
                                <button type="button" class="btn btn-primary btn-sm text-right btn-tambah-data" id="tambah_pelanggaran">
                                    <i class="icon fas fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                            <table class="table table-bordered" id="tabel_pelanggaran">
                                <thead class="bg-gray-dark">
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Catatan Pelanggaran</th>
                                        <th>Dokumen</th>
                                        <th style="width: 170px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!$pelanggaran) { ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">Data Belum Diisi atau Belum Mempunyai Pelanggaran</td>
                                        </tr>
                                        <?php
                                    } else {
                                        foreach ($pelanggaran as $key => $value) : ?>
                                            <tr class="pelanggaran" id="<?= $value['id_pelanggaran'] ?>">
                                                <td><?= ++$key ?></td>
                                                <td><?= $value['catatan'] ?></td>
                                                <td>
                                                    <?php
                                                    if (explode('.', $value['dokumen'])[1] == 'pdf') { ?>
                                                        <a data-fancybox data-type='iframe' data-src='/dokumen/pelanggaran/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>' href='javascript:;'>
                                                            <button type='button' class='btn btn-sm btn-primary'>Lihat</button>
                                                        </a>
                                                    <?php
                                                    } else { ?>
                                                        <a href='/dokumen/pelanggaran/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>' data-fancybox data-caption='Dokumen Pelanggaran'>
                                                            <button type='button' class='btn btn-sm btn-primary'>Lihat</button>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <button type='button' class='btn btn-sm btn-success mr-0 download-dokumen' onclick='downloadDokumen(event)'>
                                                        <i class='fas fa-fw fa-file-download mr-1'></i> Download
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning btn-edit-tabel">
                                                        <i class="fas fa-fw fa-edit"></i> Edit
                                                    </button>
                                                    <form action="/admin/pelanggaran/<?= $value['id_pelanggaran'] ?>" class="d-inline form_delete" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="button" class="btn btn-sm  btn-danger">
                                                            <i class="fas fa-fw fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="isi_tab_cuti" role="tabpanel" aria-labelledby="tab_cuti">
                            <h4>Data Cuti dan Izin Pegawai</h4>
                            <div class="header">
                                <?php
                                if ($sisaCuti > 0) { ?>
                                    <button type="button" class="btn btn-primary btn-sm text-right btn-tambah-data" id="tambah_cuti">
                                        <i class="icon fas fa-plus"></i>
                                        Tambah Data
                                    </button>
                                <?php } ?>
                            </div>
                            <table class="table table-bordered" id="tabel_cuti">
                                <thead class="bg-gray-dark">
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Tanggal</th>
                                        <th>Alasan</th>
                                        <th>Lama Cuti (Hari)</th>
                                        <th>Sisa Cuti (Hari)</th>
                                        <th>Dokumen</th>
                                        <th style="width: 170px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!$cuti) { ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">Data Belum Diisi atau Belum Mempunyai Cuti</td>
                                        </tr>
                                        <?php
                                    } else {
                                        foreach ($cuti as $key => $value) : ?>
                                            <tr class="cuti" id="<?= $value['id_cuti'] ?>">
                                                <td><?= ++$key ?></td>
                                                <td>
                                                    <?php $tanggal = strftime("%d %B %Y", strtotime($value['tanggal'])); ?>
                                                    <?= $tanggal ?>
                                                </td>
                                                <td><?= $value['alasan'] ?></td>
                                                <td><?= $value['lama'] ?></td>
                                                <td><?= $value['sisa'] ?></td>
                                                <td>
                                                    <?php
                                                    if (explode('.', $value['dokumen'])[1] == 'pdf') { ?>
                                                        <a data-fancybox data-type='iframe' data-src='/dokumen/cuti/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>' href='javascript:;'>
                                                            <button type='button' class='btn btn-sm btn-primary'>Lihat</button>
                                                        </a>
                                                    <?php
                                                    } else { ?>
                                                        <a href='/dokumen/cuti/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>' data-fancybox data-caption='Dokumen Cuti/Izin <?= $tanggal ?>'>
                                                            <button type='button' class='btn btn-sm btn-primary'>Lihat</button>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <button type='button' class='btn btn-sm btn-success mr-0 download-dokumen' onclick='downloadDokumen(event)'>
                                                        <i class='fas fa-fw fa-file-download mr-1'></i> Download
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary btn-edit-tabel">
                                                        <i class="fas fa-fw fa-edit"></i> Edit
                                                    </button>
                                                    <form action="/admin/cuti/<?= $value['id_cuti'] ?>" class="d-inline form_delete" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="button" class="btn btn-sm  btn-danger">
                                                            <i class="fas fa-fw fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="isi_tab_penilaian" role="tabpanel" aria-labelledby="tab_penilaian">
                            <h4>Penilaian Pegawai</h4>
                            <div class="header">
                                <button type="button" class="btn btn-primary btn-sm text-right btn-tambah-data" id="tambah_penilaian">
                                    <i class="icon fas fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                            <table class="table table-bordered" id="tabel_penilaian">
                                <thead class="bg-gray-dark">
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Indikator Penilaian</th>
                                        <th>Nilai</th>
                                        <th>Dokumen</th>
                                        <th style="width: 170px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!$penilaian) { ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">Data Belum Diisi atau Belum Mempunyai Penilaian</td>
                                        </tr>
                                        <?php
                                    } else {
                                        foreach ($penilaian as $key => $value) : ?>
                                            <tr class="penilaian" id="<?= $value['id_penilaian'] ?>">
                                                <td><?= ++$key ?></td>
                                                <td><?= $value['indikator'] ?></td>
                                                <td><?= $value['nilai'] ?></td>
                                                <td>
                                                    <?php
                                                    if (explode('.', $value['dokumen'])[1] == 'pdf') { ?>
                                                        <a data-fancybox data-type='iframe' data-src='/dokumen/penilaian/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>' href='javascript:;'>
                                                            <button type='button' class='btn btn-sm btn-primary'>Lihat</button>
                                                        </a>
                                                    <?php
                                                    } else { ?>
                                                        <a href='/dokumen/penilaian/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>' data-fancybox data-caption='Dokumen Penilaian'>
                                                            <button type='button' class='btn btn-sm btn-primary'>Lihat</button>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <button type='button' class='btn btn-sm btn-success mr-0 download-dokumen' onclick='downloadDokumen(event)'>
                                                        <i class='fas fa-fw fa-file-download mr-1'></i> Download
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning btn-edit-tabel">
                                                        <i class="fas fa-fw fa-edit"></i> Edit
                                                    </button>
                                                    <form action="/admin/penilaian/<?= $value['id_penilaian'] ?>" class="d-inline form_delete" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="button" class="btn btn-sm  btn-danger">
                                                            <i class="fas fa-fw fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_pasangan" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form Suami / Istri</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form role="form" action="/admin/pasangan/tambah" method="POST" id="form_pasangan">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_pasangan">
                                                Nama <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control" id="nama_pasangan" name="nama_pasangan" placeholder="Masukkan Nama" autofocus required>
                                            <div class="invalid-feedback"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik_pasangan">
                                                NIK <sup style="color: red;">*</sup>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nik_pasangan" name="nik_pasangan" placeholder="Masukkan NIK" required>
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-info btn-flat btn-file">
                                                        pilih file <input type="file" id="file_nik" name="file_nik">
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="invalid-feedback"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ttl_pasangan">
                                                TTL <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="ttl_pasangan" name="ttl_pasangan" placeholder="Masukkan TTL" required>
                                            <div class="invalid-feedback"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telp">
                                                No Telp <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No Telepon" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="pekerjaan_pasangan">
                                                Pekerjaan <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control" id="pekerjaan_pasangan" name="pekerjaan_pasangan" placeholder="Masukkan Pekerjaan" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="hubungan_pasangan">
                                                Hubungan <sup style="color: red;">*</sup>
                                            </label>
                                            <select class="form-control  select2 single" id="hubungan_pasangan" name="hubungan_pasangan" data-placeholder="Pilih Hubungan" style="width: 100%;" required>
                                                <option></option>
                                                <option value="Suami">Suami
                                                </option>
                                                <option value="Istri">Istri
                                                </option>
                                            </select>
                                            <div class="invalid-feedback"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pendidikan_pasangan">
                                                Pendidikan <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="pendidikan_pasangan" name="pendidikan_pasangan" placeholder="Masukkan Pendidikan" required>
                                            <div class="invalid-feedback"></div>
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
            <div class="modal fade" id="modal_anak" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form Anak</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form role="form" action="/admin/anak/tambah" method="POST" id="form_anak">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_anak">
                                                Nama <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control" id="nama_anak" name="nama_anak" placeholder="Masukkan Nama" autofocus required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik_anak">
                                                NIK <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control" id="nik_anak" name="nik_anak" placeholder="Masukkan NIK" required>
                                            <div class="invalid-feedback"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ttl_anak">
                                                TTL <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="ttl_anak" name="ttl_anak" placeholder="Masukkan TTL" required>
                                            <div class="invalid-feedback"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">
                                                Jenis Kelamin <sup style="color: red;">*</sup>
                                            </label>
                                            <select class="form-control select2 single" id="jenis_kelamin" name="jenis_kelamin" data-placeholder="Pilih jenis kelamin" style="width: 100%;" required>
                                                <option></option>
                                                <option value="Laki-laki">Laki-laki
                                                </option>
                                                <option value="Perempuan">Perempuan
                                                </option>
                                            </select>
                                            <div class="invalid-feedback"> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="pekerjaan_anak">
                                                Pekerjaan <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="pekerjaan_anak" name="pekerjaan_anak" placeholder="Masukkan Pekerjaan" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="hubungan_anak">
                                                Hubungan <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control" id="hubungan_anak" name="hubungan_anak" placeholder="Masukkan Hubungan" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pendidikan_anak">
                                                Pendidikan Terakhir <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control" id="pendidikan_anak" name="pendidikan_anak" placeholder="Masukkan Pendidikan Terakhir" required>
                                            <div class="invalid-feedback"></div>
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
            <div class="modal fade" id="modal_pendidikan" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form Pendidikan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form role="form" action="/admin/pendidikan/tambah" method="POST" id="form_pendidikan">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_sekolah">
                                                Nama Sekolah <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="nama_sekolah" name="nama_sekolah" placeholder="Masukkan Nama Sekolah" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_lulus">
                                                Tahun Lulus <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="tahun_lulus" name="tahun_lulus" placeholder="Masukkan Tahun Lulus" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tingkat_pendidikan">
                                                Tingkat Pendidikan <sup style="color: red;">*</sup>
                                            </label>
                                            <select class="form-control select2 single" id="tingkat_pendidikan" name="tingkat_pendidikan" data-placeholder="Pilih Tingkat Pendidikan" style="width: 100%;" required>
                                                <option></option>
                                                <option value="SD atau Setingkat">SD atau Setingkat
                                                </option>
                                                <option value="SMP atau Setingkat">
                                                    SMP atau Setingkat</option>
                                                <option value="SMA atau Setingkat">
                                                    SMA atau Setingkat</option>
                                                <option value="Diploma I  atau Setingkat">Diploma I atau Setingkat
                                                </option>
                                                <option value="Diploma II atau Setingkat">
                                                    Diploma II atau Setingkat</option>
                                                <option value="Sarjana Muda">
                                                    Sarjana Muda</option>
                                                <option value="Akademi">
                                                    Akademi</option>
                                                <option value="Diploma III">
                                                    Diploma III</option>
                                                <option value="Diploma IV">
                                                    Diploma IV</option>
                                                <option value="Sarjana (S1)">
                                                    Sarjana (S1)</option>
                                                <option value="Magister (S2)">
                                                    Magister (S2)</option>
                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="alamat_sekolah">
                                                Alamat Sekolah <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" placeholder="Masukkan Alamat Sekolah" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customFile">Dokumen Ijasah</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input pdf" id="dokumen_ijasah" name="dokumen_ijasah" required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <div class="invalid-feedback"> </div>
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
            <div class="modal fade" id="modal_pelatihan" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form Pelatihan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form role="form" action="/admin/pelatihan/tambah" method="POST" id="form_pelatihan">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="judul_pelatihan">
                                                Judul Pelatihan <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="judul_pelatihan" name="judul_pelatihan" placeholder="Masukkan Judul Pelatihan" required>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="penyelenggara">
                                                Penyelenggara <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" placeholder="Masukkan Penyelenggara" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="tanggal_pelatihan">
                                                Tanggal <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="tanggal_pelatihan" name="tanggal_pelatihan" placeholder="Masukkan Tanggal" required>
                                            <div class="invalid-feedback"></div>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="tanggal_pelatihan">
                                                Tanggal <sup style="color: red;">*</sup>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="tanggal_pelatihan" name="tanggal_pelatihan" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lokasi">
                                                Lokasi <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="lokasi" name="lokasi" placeholder="Masukkan Lokasi" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customFile">Dokumen</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input pdf" id="dokumen_pelatihan" name="dokumen_pelatihan[]" multiple required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
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
            <div class="modal fade" id="modal_pelanggaran" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form Pelanggaran</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form role="form" action="/admin/pelanggaran/tambah" method="POST" id="form_pelanggaran">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="catatan">
                                                Catatan <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="catatan" name="catatan" placeholder="Masukkan Catatan" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="customFile">Dokumen</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input pdf" id="dokumen_pelanggaran" name="dokumen_pelanggaran" required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
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
            <div class="modal fade" id="modal_cuti" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form cuti</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form role="form" action="/admin/cuti/tambah" method="POST" id="form_cuti">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="tanggal_cuti">
                                                Tanggal Cuti <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="date" id="tanggal_cuti" name="tanggal_cuti" class="form-control 
                                            " required>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_cuti">
                                                Jenis Cuti <sup style="color: red;">*</sup>
                                            </label>
                                            <select class="form-control select2 single" id="jenis_cuti" name="jenis_cuti" data-placeholder="Pilih Jenis Cuti" style="width: 100%;" required>
                                                <option></option>
                                                <option value="Tahunan">Tahunan</option>
                                                <option value="Non-tahunan">Non-tahunan</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alasan">
                                                Alasan <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="alasan" name="alasan" placeholder="Masukkan Alasan" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lama_cuti">
                                                Lama Cuti (Hari) <sup style="color: red;">*</sup>
                                            </label>
                                            <input type="text" class="form-control " id="lama_cuti" name="lama_cuti" placeholder="Masukkan Lama Cuti (Hari)" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customFile">Dokumen</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input pdf" id="dokumen_cuti" name="dokumen_cuti" required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
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
            <div class="modal fade" id="modal_penilaian" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="icon fas fa-plus"></i> Form Penilaian</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form role="form" action="/admin/penilaian/tambah" method="POST" id="form_penilaian">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label for="indikator">
                                                        Indikator <sup style="color: red;">*</sup>
                                                    </label>
                                                    <input type="text" class="form-control indikator" id="indikator1" name="indikator[]" placeholder="Masukkan Indikator" required>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="nilai">
                                                        Nilai <sup style="color: red;">*</sup>
                                                    </label>
                                                    <input type="text" class="form-control nilai" id="nilai1" name="nilai[]" placeholder="Nilai" required>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-primary" id="tambah_indikator">Tambah Indikator</button>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="customFile">Dokumen</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input pdf" id="dokumen_penilaian" name="dokumen_penilaian" required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
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
            <div class="modal fade" id="modal_dokumen" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Dokumen X</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <table class="table table-bordered" id="tabel_dokumen">
                                <thead class="bg-gray-dark">
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Nama Dokumen</th>
                                        <th style="width:230px">Dokumen</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?= $this->endSection(); ?>