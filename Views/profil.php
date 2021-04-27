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
    </style>
    <!-- Main content -->
    <section class="content">
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
                    <div class="tab-content" id="isi_tab_profil">
                        <div class="tab-pane fade show active" id="isi_tab_identitas" role="tabpanel" aria-labelledby="tab_identitas">
                            <h4>Identitas Pegawai</h4>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <img src="/img/profil/<?= $pegawai['foto'] ?>" class="avatar img-fluid" alt="">
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
                                                <td id="tanggal_lahir"><?= $pegawai['tanggal_lahir'] ?></td>
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
                                                <td id="gol_darah"><?= $pegawai['gol_darah'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Telephon</td>
                                                <td id="no_tlp"><?= $pegawai['no_telp'] ?></td>
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
                                                <td>Gaji Berkala</td>
                                                <td id="gaji">Rp <?= $pegawai['gaji_berkala'] ?>,-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- <a href="/pegawai/dokumen"> -->
                            <button type="button" class="btn btn-warning text-white mr-3 btn-dokumen float-right" id="dokumen_identitas_pegawai" style="width: 150px;">Lihat Dokumen</button>
                            <!-- </a> -->
                        </div>
                        <div class="tab-pane fade" id="isi_tab_keluarga" role="tabpanel" aria-labelledby="tab_keluarga">
                            <h4>Keluarga Pegawai</h4>
                            <h5 class="mt-4">Suami/Istri</h5>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!$pasangan) { ?>
                                            <tr>
                                                <td colspan="9" style="text-align: center;">Data Belum Diisi atau Belum Mempunyai Pasangan</td>
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
                                                    <td><?= $value['hubungan'] ?></td>
                                                    <td><?= $value['pendidikan'] ?></td>
                                                </tr>
                                        <?php
                                            endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="mt-4">Anak</h5>
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
                                                </tr>
                                        <?php
                                            endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <a href="/pegawai/dokumen">
                                <button type="button" class="btn btn-warning float-right text-white">Lihat Dokumen</button>
                            </a> -->
                            <button type="button" class="btn btn-warning text-white mr-3 btn-dokumen float-right" id="dokumen_keluarga" style="width: 150px;">Lihat Dokumen</button>
                        </div>
                        <div class="tab-pane fade" id="isi_tab_pendidikan" role="tabpanel" aria-labelledby="tab_pendidikan">
                            <h4>Pendidikan dan Pelatihan</h4>
                            <h5 class="mt-4">Pendidikan Formal</h5>
                            <div class="table-responsive pl-5">
                                <table class="table table-bordered" id="tabel_pendidikan_formal">
                                    <thead class="bg-gray-dark">
                                        <tr>
                                            <th style="width: 10px">No.</th>
                                            <th>Nama Sekolah</th>
                                            <th>Tahun Lulus</th>
                                            <th>Jurusan</th>
                                            <th>Alamat Sekolah</th>
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
                                                </tr>
                                        <?php endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="mt-4">Pelatihan dan Data Kursus</h5>
                            <div class="table-responsive pl-5">
                                <table class="table table-bordered" id="tabel_pelatihan">
                                    <thead class="bg-gray-dark">
                                        <tr>
                                            <th style="width: 10px">No.</th>
                                            <th>Judul Pelatihan</th>
                                            <th>Penyelenggara</th>
                                            <th>Tanggal</th>
                                            <th>Lokasi</th>
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
                                                    <td><?= $value['tanggal'] ?></td>
                                                    <td><?= $value['lokasi'] ?></td>
                                                </tr>
                                        <?php endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-warning text-white mr-3 btn-dokumen float-right" id="dokumen_pendidikan_pelatihan" style="width: 150px;">Lihat Dokumen</button>
                        </div>
                        <div class="tab-pane fade" id="isi_tab_pelanggaran" role="tabpanel" aria-labelledby="tab_pelanggaran">
                            <h4>Data Pelanggaran</h4>
                            <table class="table table-bordered" id="tabel_pelanggaran">
                                <thead class="bg-gray-dark">
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Catatan Pelanggaran</th>
                                        <th>Dokumen</th>
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
                                                    <!-- <img src="/img/default.png" class="dokumen d-block mb-2" alt=""> -->

                                                    <?php
                                                    if (explode('.', $value['dokumen']) == 'pdf') { ?>
                                                        <a data-fancybox data-type="iframe" data-src="/dokumen/pelanggaran/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>" href='javascript:;'>
                                                            <button type='button' class='btn btn-sm btn-primary mr-2'>Lihat</button>
                                                        </a>
                                                    <?php
                                                    } else { ?>
                                                        <a href="/dokumen/pelanggaran/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>" data-fancybox data-caption="Dokumen Cuti <?= $value['catatan'] ?>">
                                                            <button type="button" class="btn btn-sm btn-primary mr-2">Lihat</button>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <button type='button' class='btn btn-sm btn-primary mr-2 download-dokumen' onclick='downloadDokumen(event)'>
                                                        <i class='fas fa-file-download mr-1'> </i> Download
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="isi_tab_cuti" role="tabpanel" aria-labelledby="tab_cuti">
                            <h4>Data Cuti dan Izin Pegawai</h4>
                            <table class="table table-bordered" id="tabel_cuti">
                                <thead class="bg-gray-dark">
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Tanggal</th>
                                        <th>Alasan</th>
                                        <th>Sisa Cuti (Hari)</th>
                                        <th>Dokumen</th>
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
                                                <td><?= $value['tanggal'] ?></td>
                                                <td><?= $value['alasan'] ?></td>
                                                <td><?= $value['sisa'] ?></td>
                                                <td>
                                                    <!-- <img src="/img/default.png" class="dokumen d-block mb-2" alt=""> -->
                                                    <?php
                                                    if (explode('.', $value['dokumen']) == 'pdf') { ?>
                                                        <a data-fancybox data-type="iframe" data-src="/dokumen/cuti/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>" href='javascript:;'>
                                                            <button type='button' class='btn btn-sm btn-primary mr-2'>Lihat</button>
                                                        </a>
                                                    <?php
                                                    } else { ?>
                                                        <a href="/dokumen/cuti/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>" data-fancybox data-caption="Dokumen Cuti Tanggal <?= $value['tanggal'] ?>">
                                                            <button type="button" class="btn btn-sm btn-primary mr-2">Lihat</button>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <button type='button' class='btn btn-sm btn-primary mr-2 download-dokumen' onclick='downloadDokumen(event)'>
                                                        <i class='fas fa-file-download mr-1'> </i> Download
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class=" tab-pane fade" id="isi_tab_penilaian" role="tabpanel" aria-labelledby="tab_penilaian">
                            <h4>Penilaian Pegawai</h4>
                            <table class="table table-bordered" id="tabel_cuti">
                                <thead class="bg-gray-dark">
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Indikator Penilaian</th>
                                        <th>Nilai</th>
                                        <th>Dokumen</th>
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
                                                    <!-- <img src="/img/default.png" class="dokumen d-block mb-2" alt=""> -->

                                                    <?php
                                                    if (explode('.', $value['dokumen']) == 'pdf') { ?>
                                                        <a data-fancybox data-type="iframe" data-src="/dokumen/penilaian/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>" href='javascript:;'>
                                                            <button type='button' class='btn btn-sm btn-primary mr-2'>Lihat</button>
                                                        </a>
                                                    <?php
                                                    } else { ?>
                                                        <a href="/dokumen/penilaian/<?= $pegawai['id_pegawai'] ?>/<?= $value['dokumen'] ?>" data-fancybox data-caption="Dokumen Penilaian <?= $value['indikator'] ?>">
                                                            <button type="button" class="btn btn-sm btn-primary mr-2">Lihat</button>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <button type='button' class='btn btn-sm btn-primary mr-2 download-dokumen' onclick='downloadDokumen(event)'>
                                                        <i class='fas fa-file-download mr-1'> </i> Download
                                                    </button>
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
                                        <th>Dokumen</th>
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