<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Data Pegawai</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <form role="form" id="form_update_pegawai" action="/admin/pegawai/updateIdentitas" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning alert-dismissible">
                                    <h4>Form Identitas Pegawai</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="padding: 15px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">
                                        Nama <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= $pegawai['nama']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nip">
                                        NIP <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : '' ?>" id="nip" name="nip" placeholder="Masukkan NIP" value="<?= $pegawai['nip']; ?>" required>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_nip" name="file_nip"></button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nip'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">
                                        Jabatan <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <select class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ?> select2 single" id="jabatan" name="jabatan" data-placeholder="Pilih Jabatan" style="width: 100%;" required>
                                            <option></option>
                                            <option value="Kepala Bidang" <?= ($pegawai['jabatan'] == 'Kepala Bidang') ? "selected" : "" ?>>Kepala Bidang</option>
                                            <option value="Kepala Sub Bidang" <?= ($pegawai['jabatan'] == 'Kepala Sub Bidang') ? "selected" : "" ?>>Kepala Sub Bidang</option>
                                            <option value="Kepala Cabang" <?= ($pegawai['jabatan'] == 'Kepala Cabang') ? "selected" : "" ?>>Kepala Cabang</option>
                                            <option value="Kepala Seksi" <?= ($pegawai['jabatan'] == 'Kepala Seksi') ? "selected" : "" ?>>Kepala Seksi</option>
                                            <option value="Kepala Sub Seksi" <?= ($pegawai['jabatan'] == 'Kepala Sub Seksi') ? "selected" : "" ?>>Kepala Sub Seksi</option>
                                            <option value="Kepala SKAI" <?= ($pegawai['jabatan'] == 'Kepala SKAI') ? "selected" : "" ?>>Kepala SKAI</option>
                                            <option value="Anggota SKAI" <?= ($pegawai['jabatan'] == 'Anggota SKAI') ? "selected" : "" ?>>Anggota SKAI</option>
                                            <option value="Staff" <?= ($pegawai['jabatan'] == 'Staff') ? "selected" : "" ?>>Staff</option>
                                            <option value="Staf Non Administrasi" <?= ($pegawai['jabatan'] == 'Staf Non Administrasi') ? "selected" : "" ?>>Staf Non Administrasi</option>
                                        </select>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_jabatan" name="file_jabatan">
                                            </button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jabatan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="detail_jabatan">
                                        Detail Jabatan <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('detail_jabatan')) ? 'is-invalid' : '' ?>" id="detail_jabatan" name="detail_jabatan" placeholder="Masukkan Detail Jabatan" value="<?= $pegawai['detail_jabatan'] ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('detail_jabatan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nik">
                                        NIK <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : '' ?>" id="nik" name="nik" placeholder="Masukkan NIK" value="<?= $pegawai['nik']; ?>" required>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_nik" name="file_nik">
                                            </button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nik'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_npwp">
                                        No NPWP <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control <?= ($validation->hasError('no_npwp')) ? 'is-invalid' : '' ?>" id="no_npwp" name="no_npwp" placeholder="Masukkan NPWP" value="<?= $pegawai['no_npwp']; ?>" required>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_no_npwp" name="file_no_npwp">
                                            </button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_npwp'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_bpjs_tk">
                                        No Peserta BPJS TK <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control <?= ($validation->hasError('no_bpjs_tk')) ? 'is-invalid' : '' ?>" id="no_bpjs_tk" name="no_bpjs_tk" placeholder="Masukkan No BPJS TK" value="<?= $pegawai['no_bpjs_tk']; ?>" required>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_no_bpjs_tk" name="file_no_bpjs_tk">
                                            </button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_bpjs_tk'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_bpjs_kes">
                                        No Peserta BPJS Kesehatan <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control <?= ($validation->hasError('no_bpjs_kes')) ? 'is-invalid' : '' ?>" id="no_bpjs_kes" name="no_bpjs_kes" placeholder="Masukkan No BPJS Kesehatan" value="<?= $pegawai['no_bpjs_kes']; ?>" required>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_no_bpjs_kes" name="file_no_bpjs_kes">
                                            </button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_bpjs_kes'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_dplk">
                                        No Peserta DPLK <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control <?= ($validation->hasError('no_dplk')) ? 'is-invalid' : '' ?>" id="no_dplk" name="no_dplk" placeholder="Masukkan No DPLK" value="<?= $pegawai['no_dplk']; ?>" required>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_no_dplk" name="file_no_dplk" value="<?= $pegawai['file_no_dplk']; ?>">
                                            </button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_dplk'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">
                                        Tempat Lahir <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : '' ?>" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="<?= $pegawai['tempat_lahir']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tempat_lahir'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir <sup style="color: red;">*</sup></label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : '' ?>" value="<?= $pegawai['tanggal_lahir']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tanggal_lahir'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        Alamat Email <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Masukkan Alamat Email" value="<?= $pegawai['email']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">
                                        Jenis Kelamin <sup style="color: red;">*</sup>
                                    </label>
                                    <select class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?> select2 single" id="jenis_kelamin" name="jenis_kelamin" data-placeholder="Pilih jenis kelamin" style="width: 100%;" required>
                                        <option></option>
                                        <option value="Laki-laki" <?= ($pegawai['jenis_kelamin'] == 'Laki-laki') ? "selected" : '' ?>>Laki-laki
                                        </option>
                                        <option value="Perempuan" <?= ($pegawai['jenis_kelamin'] == 'Perempuan') ? "selected" : '' ?>>Perempuan
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jenis_kelamin'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama <sup style="color: red;">*</sup></label>
                                    <select class="form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : '' ?> select2 single" id="agama" name="agama" data-placeholder="Pilih agama" style="width: 100%;" required>
                                        <option></option>
                                        <option value="Islam" <?= ($pegawai['agama'] == 'Islam') ? "selected" : "" ?>>Islam
                                        </option>
                                        <option value="Kristen" <?= ($pegawai['agama'] == 'Kristen') ? "selected" : "" ?>>
                                            Kristen</option>
                                        <option value="Katolik" <?= ($pegawai['agama'] == 'Katolik') ? "selected" : "" ?>>
                                            Katolik</option>
                                        <option value="Hindu" <?= ($pegawai['agama'] == 'Hindu') ? "selected" : "" ?>>Hindu
                                        </option>
                                        <option value="Buddha" <?= ($pegawai['agama'] == 'Buddha') ? "selected" : "" ?>>
                                            Buddha</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agama'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gol_darah">
                                        Golongan Darah <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('gol_darah')) ? 'is-invalid' : '' ?>" id="gol_darah" name="gol_darah" placeholder="Masukkan Golongan Darah" value="<?= $pegawai['gol_darah']; ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('gol_darah'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telepon">
                                        No Telepon <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nomor_telepon')) ? 'is-invalid' : '' ?>" id="nomor_telepon" name="nomor_telepon" placeholder="Masukkan Masukkan No Telepon" value="<?= $pegawai['no_telp']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nomor_telepon'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_rumah">
                                        Alamat Rumah <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('alamat_rumah')) ? 'is-invalid' : '' ?>" id="alamat_rumah" name="alamat_rumah" placeholder="Masukkan Alamat Rumah" value="<?= $pegawai['alamat_rumah']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat_rumah'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_domisili">
                                        Alamat Domisili <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('alamat_domisili')) ? 'is-invalid' : '' ?>" id="alamat_domisili" name="alamat_domisili" placeholder="Masukkan Alamat Domisili" value="<?= $pegawai['alamat_domisili']; ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat_domisili'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status_pernikahan">
                                        Status Pernikahan <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <select class="form-control <?= ($validation->hasError('status_pernikahan')) ? 'is-invalid' : '' ?> select2 single" id="status_pernikahan" name="status_pernikahan" data-placeholder="Pilih Status Pernikahan" style="width: 100%;" required>
                                            <option></option>
                                            <option value="Menikah" <?= ($pegawai['status_pernikahan'] == 'Menikah') ? "selected" : "" ?>>Menikah</option>
                                            <option value="Belum Menikah" <?= ($pegawai['status_pernikahan'] == 'Belum Menikah') ? "selected" : "" ?>>Belum Menikah</option>
                                        </select>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_status_pernikahan" name="file_status_pernikahan">
                                            </button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('status_pernikahan'); ?>
                                    </div>
                                </div>
                                <?php
                                if ($pegawai['jumlah_anak'] != 0) { ?>
                                    <div class="form-group">
                                        <label for="jumlah_anak">
                                            Jumlah Anak <sup style="color: red;">*</sup>
                                        </label>
                                        <select class="form-control select2 single" id="jumlah_anak" name="jumlah_anak" data-placeholder="Pilih Jumlah Anak" style="width: 100%;">
                                            <option></option>
                                            <option value="0" <?= ($pegawai['jumlah_anak'] == 0) ? 'selected' : '' ?>>0</option>
                                            <option value="1" <?= ($pegawai['jumlah_anak'] == 1) ? 'selected' : '' ?>>1</option>
                                            <option value="2" <?= ($pegawai['jumlah_anak'] == 2) ? 'selected' : '' ?>>2</option>
                                        </select>
                                    </div>
                                <?php }                                 ?>
                                <div class="form-group">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir <sup style="color: red;">*</sup></label>
                                    <select class="form-control <?= ($validation->hasError('pendidikan_terakhir')) ? 'is-invalid' : '' ?> select2 single" id="pendidikan_terakhir" name="pendidikan_terakhir" data-placeholder="Pilih Pendidikan Terakhir" style="width: 100%;" required>
                                        <option></option>
                                        <option value="SD atau Setingkat" <?= ($pegawai['pendidikan_terakhir'] == 'SD atau Setingkat') ? "selected" : "" ?>>SD atau Setingkat
                                        </option>
                                        <option value="SMP atau Setingkat" <?= ($pegawai['pendidikan_terakhir'] == 'SMP atau Setingkat') ? "selected" : "" ?>>
                                            SMP atau Setingkat</option>
                                        <option value="SMA atau Setingkat" <?= ($pegawai['pendidikan_terakhir'] == 'SMA atau Setingkat') ? "selected" : "" ?>>
                                            SMA atau Setingkat</option>
                                        <option value="Diploma I  atau Setingkat" <?= ($pegawai['pendidikan_terakhir'] == 'Diploma I  atau Setingkat') ? "selected" : "" ?>>Diploma I atau Setingkat
                                        </option>
                                        <option value="Diploma II atau Setingkat" <?= ($pegawai['pendidikan_terakhir'] == 'Diploma II atau Setingkat') ? "selected" : "" ?>>
                                            Diploma II atau Setingkat</option>
                                        <option value="Sarjana Muda" <?= ($pegawai['pendidikan_terakhir'] == 'Sarjana Muda') ? "selected" : "" ?>>
                                            Sarjana Muda</option>
                                        <option value="Akademi" <?= ($pegawai['pendidikan_terakhir'] == 'Akademi') ? "selected" : "" ?>>
                                            Akademi</option>
                                        <option value="Diploma III" <?= ($pegawai['pendidikan_terakhir'] == 'Diploma III') ? "selected" : "" ?>>
                                            Diploma III</option>
                                        <option value="Diploma IV" <?= ($pegawai['pendidikan_terakhir'] == 'Diploma IV') ? "selected" : "" ?>>
                                            Diploma IV</option>
                                        <option value="Sarjana (S1)" <?= ($pegawai['pendidikan_terakhir'] == 'Sarjana (S1)') ? "selected" : "" ?>>
                                            Sarjana (S1)</option>
                                        <option value="Magister (S2)" <?= ($pegawai['pendidikan_terakhir'] == 'Magister (S2)') ? "selected" : "" ?>>
                                            Magister (S2)</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pendidikan_terakhir'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status_pegawai">
                                        Status Pegawai <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <select class="form-control <?= ($validation->hasError('status_pegawai')) ? 'is-invalid' : '' ?> select2 single" id="status_pegawai" name="status_pegawai" data-placeholder="Pilih Status Pegawai" style="width: 100%;" required>
                                            <option></option>
                                            <option value="Pegawai Tetap" <?= ($pegawai['status_pegawai'] == 'Pegawai Tetap') ? "selected" : "" ?>>Pegawai Tetap
                                            </option>
                                            <option value="Calon Pegawai" <?= ($pegawai['status_pegawai'] == 'Calon Pegawai') ? "selected" : "" ?>>
                                                Calon Pegawai</option>
                                            <option value="Pegawai Kontrak" <?= ($pegawai['status_pegawai'] == 'Pegawai Kontrak') ? "selected" : "" ?>>
                                                Pegawai Kontrak</option>
                                            <option value="Pegawai Alih Daya" <?= ($pegawai['status_pegawai'] == 'Pegawai Alih Daya') ? "selected" : "" ?>>Pegawai Alih Daya</option>
                                        </select>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_status_pegawai" name="file_status_pegawai">
                                            </button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('status_pegawai'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_pengangkatan">Tahun Pengangkatan <sup style="color: red;">*</sup></label>
                                    <input type="date" id="tahun_pengangkatan" name="tahun_pengangkatan" class="form-control <?= ($validation->hasError('tahun_pengangkatan')) ? 'is-invalid' : '' ?>" value="<?= $pegawai['tahun_pengangkatan']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tahun_pengangkatan'); ?>
                                    </div>
                                </div>
                                <?php
                                if ($pegawai['status_pegawai'] != 'Pegawai Kontrak' && $pegawai['status_pegawai'] != 'Pegawai Alih Daya') {
                                ?>
                                    <div class="form-group">
                                        <label for="gol_ruang_masa_kerja">
                                            Golongan/Ruang/Masa Kerja <sup style="color: red;">*</sup>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control <?= ($validation->hasError('gol_ruang_masa_kerja')) ? 'is-invalid' : '' ?>" id="gol_ruang_masa_kerja" name="gol_ruang_masa_kerja" placeholder="Masukkan Golongan/Ruang/Masa Kerja" value="<?= $pegawai['gol_ruang_masa_kerja'] ?>" required>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-info btn-flat btn-file">
                                                    pilih file <input type="file" id="file_gol_ruang_masa_kerja" name="file_gol_ruang_masa_kerja">
                                                </button>
                                            </span>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('gol_ruang_masa_kerja'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="iterasi">Iterasi dalam 4 Tahun <sup style="color: red;">*</sup></label>
                                        <input type="text" id="iterasi" name="iterasi" class="form-control <?= ($validation->hasError('iterasi')) ? 'is-invalid' : '' ?>" value="<?= $pegawai['iterasi'] ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('iterasi'); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="gaji_berkala">
                                        Gaji Berkala <sup style="color: red;">*</sup>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control <?= ($validation->hasError('gaji_berkala')) ? 'is-invalid' : '' ?>" id="gaji_berkala" name="gaji_berkala" placeholder="Masukkan Gaj Berkala" value="<?= $pegawai['gaji_berkala']; ?>" <?= ($pegawai['status_pegawai'] == 'Pegawai Kontrak' || $pegawai['status_pegawai'] == 'Pegawai Alih Daya') ? '' : 'disabled' ?>>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat btn-file">
                                                pilih file <input type="file" id="file_gaji_berkala" name="file_gaji_berkala">
                                            </button>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('gaji_berkala'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_rekening">
                                        No Rekening <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('no_rekening')) ? 'is-invalid' : '' ?>" id="no_rekening" name="no_rekening" placeholder="Masukkan No Rekening" value="<?= $pegawai['no_rekening']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_rekening'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bank">
                                        Nama Bank <sup style="color: red;">*</sup>
                                    </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('bank')) ? 'is-invalid' : '' ?>" id="bank" name="bank" placeholder="Masukkan Nama Bank" value="<?= $pegawai['bank']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('bank'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="customFile">Foto Pegawai</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('foto'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <!-- <button type="button" class="btn btn-primary kirim-form">
                                <i class="icon fas fa-paper-plane"></i> Selesai
                            </button> -->
                            <button type="submit" class="btn btn-primary kirim">
                                <i class="icon fas fa-paper-plane"></i> Selesai
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>