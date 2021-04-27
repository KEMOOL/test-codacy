<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Pegawai</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-body">
                    <div id="carouselContent" class="carousel slide wrap-group" data-interval="false">
                        <form role="form" id="form_tambah_pegawai" action="/admin/pegawai/insert" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="carousel-inner" role="listbox">

                                <!--===== Form Identitas Pegawai =====-->

                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning alert-dismissible">
                                                <h4>1. Form Identitas Pegawai</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="padding: 15px;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_pegawai">
                                                    Nama <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('nama_pegawai')) ? 'is-invalid' : '' ?>" id="nama_pegawai" name="nama_pegawai" placeholder="Masukkan Nama" autofocus value="<?= old('nama_pegawai'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_pegawai'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nip">
                                                    NIP <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : '' ?>" id="nip" name="nip" placeholder="Masukkan NIP" value="<?= old('nip'); ?>">
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
                                                    <input type="text" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ?>" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan" value="<?= old('jabatan'); ?>">
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
                                                <label for="nik_pegawai">
                                                    NIK <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('nik_pegawai')) ? 'is-invalid' : '' ?>" id="nik_pegawai" name="nik_pegawai" placeholder="Masukkan NIK" value="<?= old('nik_pegawai'); ?>">
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-info btn-flat btn-file">
                                                            pilih file <input type="file" id="file_nik_pegawai" name="file_nik_pegawai">
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nik_pegawai'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_npwp">
                                                    No NPWP <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('no_npwp')) ? 'is-invalid' : '' ?>" id="no_npwp" name="no_npwp" placeholder="Masukkan NPWP" value="<?= old('no_npwp'); ?>">
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
                                                    <input type="text" class="form-control <?= ($validation->hasError('no_bpjs_tk')) ? 'is-invalid' : '' ?>" id="no_bpjs_tk" name="no_bpjs_tk" placeholder="Masukkan No BPJS TK" value="<?= old('no_bpjs_tk'); ?>">
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
                                                <label for="no_bpjs_kesehatan">
                                                    No Peserta BPJS Kesehatan <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('no_bpjs_kesehatan')) ? 'is-invalid' : '' ?>" id="no_bpjs_kesehatan" name="no_bpjs_kesehatan" placeholder="Masukkan No BPJS Kesehatan" value="<?= old('no_bpjs_kesehatan'); ?>"><span class="input-group-append">
                                                        <button type="button" class="btn btn-info btn-flat btn-file">
                                                            pilih file <input type="file" id="file_no_bpjs_kesehatan" name="file_no_bpjs_kesehatan">
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('no_bpjs_kesehatan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_dplk">
                                                    No Peserta DPLK <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('no_dplk')) ? 'is-invalid' : '' ?>" id="no_dplk" name="no_dplk" placeholder="Masukkan No DPLK" value="<?= old('no_dplk'); ?>"><span class="input-group-append">
                                                        <button type="button" class="btn btn-info btn-flat btn-file">
                                                            pilih file <input type="file" id="file_no_dplk" name="file_bo_dplk">
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
                                                <input type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : '' ?>" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="<?= old('tempat_lahir'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tempat_lahir'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir <sup style="color: red;">*</sup></label>
                                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_lahir'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tanggal_lahir'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">
                                                    Alamat Email <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Masukkan Alamat Email" value="<?= old('email'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('email'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kelamin_pegawai">
                                                    Jenis Kelamin <sup style="color: red;">*</sup>
                                                </label>
                                                <select class="form-control <?= ($validation->hasError('jenis_kelamin_pegawai')) ? 'is-invalid' : '' ?> select2 single" id="jenis_kelamin_pegawai" name="jenis_kelamin_pegawai" data-placeholder="Pilih jenis kelamin" style="width: 100%;">
                                                    <option></option>
                                                    <option value="Laki-laki" <?= (old('jenis_kelamin_pegawai') == 'Laki-laki') ? "selected" : '' ?>>Laki-laki
                                                    </option>
                                                    <option value="Perempuan" <?= (old('jenis_kelamin_pegawai') == 'Perempuan') ? "selected" : '' ?>>Perempuan
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jenis_kelamin_pegawai'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="agama">Agama <sup style="color: red;">*</sup></label>
                                                <select class="form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : '' ?> select2 single" id="agama" name="agama" data-placeholder="Pilih agama" style="width: 100%;">
                                                    <option></option>
                                                    <option value="Islam" <?= (old('agama') == 'Islam') ? "selected" : "" ?>>Islam
                                                    </option>
                                                    <option value="Kristen" <?= (old('agama') == 'Kristen') ? "selected" : "" ?>>
                                                        Kristen</option>
                                                    <option value="Katolik" <?= (old('agama') == 'Katolik') ? "selected" : "" ?>>
                                                        Katolik</option>
                                                    <option value="Hindu" <?= (old('agama') == 'Hindu') ? "selected" : "" ?>>Hindu
                                                    </option>
                                                    <option value="Buddha" <?= (old('agama') == 'Buddha') ? "selected" : "" ?>>
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
                                                <input type="text" class="form-control <?= ($validation->hasError('gol_darah')) ? 'is-invalid' : '' ?>" id="gol_darah" name="gol_darah" placeholder="Masukkan Golongan Darah" value="<?= old('gol_darah'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('gol_darah'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_telepon_pegawai">
                                                    No Telepon <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('nomor_telepon_pegawai')) ? 'is-invalid' : '' ?>" id="nomor_telepon_pegawai" name="nomor_telepon_pegawai" placeholder="Masukkan Masukkan No Telepon" value="<?= old('nomor_telepon_pegawai'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nomor_telepon_pegawai'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_rummah">
                                                    Alamat Rumah <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('alamat_rummah')) ? 'is-invalid' : '' ?>" id="alamat_rummah" name="alamat_rummah" placeholder="Masukkan Alamat Rumah" value="<?= old('alamat_rummah'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('alamat_rummah'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_domisili">
                                                    Alamat Domisili <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('alamat_domisili')) ? 'is-invalid' : '' ?>" id="alamat_domisili" name="alamat_domisili" placeholder="Masukkan Alamat Domisili" value="<?= old('alamat_domisili'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('alamat_domisili'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status_pegawai">
                                                    Status Pegawai <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control <?= ($validation->hasError('status_pegawai')) ? 'is-invalid' : '' ?> select2 single" id="status_pegawai" name="status_pegawai" data-placeholder="Pilih Status Pegawai" style="width: 100%;">
                                                        <option></option>
                                                        <option value="Pegawai Tetap" <?= (old('status_pegawai') == 'Pegawai Tetap') ? "selected" : "" ?>>Pegawai Tetap
                                                        </option>
                                                        <option value="Calon Pegawai" <?= (old('status_pegawai') == 'Calon Pegawai') ? "selected" : "" ?>>
                                                            Calon Pegawai</option>
                                                        <option value="Pegawai Kontrak" <?= (old('status_pegawai') == 'Pegawai Kontrak') ? "selected" : "" ?>>
                                                            Pegawai Kontrak</option>
                                                        <option value="Pegawai Alih Daya" <?= (old('status_pegawai') == 'Pegawai Alih Daya') ? "selected" : "" ?>>Pegawai Alih Daya</option>
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
                                                <label for="status_pernikahan">
                                                    Status Pernikahan <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control <?= ($validation->hasError('status_pernikahan')) ? 'is-invalid' : '' ?> select2 single" id="status_pernikahan" name="status_pernikahan" data-placeholder="Pilih Status Pernikahan" style="width: 100%;">
                                                        <option></option>
                                                        <option value="Menikah" <?= (old('status_pernikahan') == 'Menikah') ? "selected" : "" ?>>Menikah</option>
                                                        <option value="Belum Menikah" <?= (old('status_pernikahan') == 'Belum Menikah') ? "selected" : "" ?>>Belum Menikah</option>
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
                                            <div class="form-group">
                                                <label for="pendidikan_pegawai">Pendidikan Terakhir <sup style="color: red;">*</sup></label>
                                                <select class="form-control <?= ($validation->hasError('pendidikan_pegawai')) ? 'is-invalid' : '' ?> select2 single" id="pendidikan_pegawai" name="pendidikan_pegawai" data-placeholder="Pilih Pendidikan Terakhir" style="width: 100%;">
                                                    <option></option>
                                                    <option value="SD atau Setingkat" <?= (old('pendidikan_pegawai') == 'SD atau Setingkat') ? "selected" : "" ?>>SD atau Setingkat
                                                    </option>
                                                    <option value="SMP atau Setingkat" <?= (old('pendidikan_pegawai') == 'SMP atau Setingkat') ? "selected" : "" ?>>
                                                        SMP atau Setingkat</option>
                                                    <option value="SMA atau Setingkat" <?= (old('pendidikan_pegawai') == 'SMA atau Setingkat') ? "selected" : "" ?>>
                                                        SMA atau Setingkat</option>
                                                    <option value="Diploma I  atau Setingkat" <?= (old('pendidikan_pegawai') == 'Diploma I  atau Setingkat') ? "selected" : "" ?>>Diploma I atau Setingkat
                                                    </option>
                                                    <option value="Diploma II atau Setingkat" <?= (old('pendidikan_pegawai') == 'Diploma II atau Setingkat') ? "selected" : "" ?>>
                                                        Diploma II atau Setingkat</option>
                                                    <option value="Sarjana Muda" <?= (old('pendidikan_pegawai') == 'Sarjana Muda') ? "selected" : "" ?>>
                                                        Sarjana Muda</option>
                                                    <option value="Akademi" <?= (old('pendidikan_pegawai') == 'Akademi') ? "selected" : "" ?>>
                                                        Akademi</option>
                                                    <option value="Diploma III" <?= (old('pendidikan_pegawai') == 'Diploma III') ? "selected" : "" ?>>
                                                        Diploma III</option>
                                                    <option value="Diploma IV" <?= (old('pendidikan_pegawai') == 'Diploma IV') ? "selected" : "" ?>>
                                                        Diploma IV</option>
                                                    <option value="Sarjana (S1)" <?= (old('pendidikan_pegawai') == 'Sarjana (S1)') ? "selected" : "" ?>>
                                                        Sarjana (S1)</option>
                                                    <option value="Magister (S2)" <?= (old('pendidikan_pegawai') == 'Magister (S2)') ? "selected" : "" ?>>
                                                        Magister (S2)</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pendidikan_pegawai'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_pengangkatan">Tahun Pengangkatan <sup style="color: red;">*</sup></label>
                                                <input type="date" id="tahun_pengangkatan" name="tahun_pengangkatan" class="form-control <?= ($validation->hasError('tahun_pengangkatan')) ? 'is-invalid' : '' ?>" value="<?= old('tahun_pengangkatan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tahun_pengangkatan'); ?>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="gol_ruang_masa_kerja">
                                                    Golongan/Ruang/Masa Kerja Jabatan <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control ?= ($validation->hasError('gol_ruang_masa_kerja')) ? 'is-invalid' : '' ?>" id="gol_ruang_masa_kerja" name="gol_ruang_masa_kerja" placeholder="Masukkan Golongan/Ruang/Masa Kerja Jabatan" value="?= old('gol_ruang_masa_kerja'); ?>"><span class="input-group-append">
                                                        <button type="button" class="btn btn-info btn-flat btn-file">
                                                            pilih file <input type="file" id="file_gol_ruang_masa_kerja" name="file_gol_ruang_masa_kerja">
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    ?= $validation->getError('gol_ruang_masa_kerja'); ?>
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label for="gaji_berkala">
                                                    Gaji Berkala <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('gaji_berkala')) ? 'is-invalid' : '' ?>" id="gaji_berkala" name="gaji_berkala" placeholder="Masukkan Gaj Berkala" value="<?= old('gaji_berkala'); ?>"><span class="input-group-append">
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
                                                <label for="customFile">Foto Pegawai</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="foto_pegawai" name="foto_pegawai">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--=====Form Keluarga Pegawai =====-->

                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning alert-dismissible">
                                                <h4>2. Form Keluarga Pegawai</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>SUAMI/ISTRI</h6>
                                            <div class="form-group">
                                                <label for="nama_pasangan">
                                                    Nama <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('nama_pasangan')) ? 'is-invalid' : '' ?>" id="nama_pasangan" name="nama_pasangan" placeholder="Masukkan Nama" autofocus value="<?= old('nama_pasangan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_pasangan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nik_pasangan">
                                                    NIK <sup style="color: red;">*</sup>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('nik_pasangan')) ? 'is-invalid' : '' ?>" id="nik_pasangan" name="nik_pasangan" placeholder="Masukkan NIK" autofocus value="<?= old('nik_pasangan'); ?>">
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-info btn-flat btn-file">
                                                            pilih file <input type="file" id="file_nik_pasangan" name="file_nik_pasangan">
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nik_pasangan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ttl_pasangan">
                                                    TTL <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('ttl_pasangan')) ? 'is-invalid' : '' ?>" id="ttl_pasangan" name="ttl_pasangan" placeholder="Masukkan TTL" autofocus value="<?= old('ttl_pasangan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('ttl_pasangan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_telepon_pasangan">
                                                    No Telp <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('nomor_telepon_pasangan')) ? 'is-invalid' : '' ?>" id="nomor_telepon_pasangan" name="nomor_telepon_pasangan" placeholder="Masukkan No Telepon" value="<?= old('nomor_telepon_pasangan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nomor_telepon_pasangan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pekerjaan_pasangan">
                                                    Pekerjaan <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('pekerjaan_pasangan')) ? 'is-invalid' : '' ?>" id="pekerjaan_pasangan" name="pekerjaan_pasangan" placeholder="Masukkan Pekerjaan" value="<?= old('pekerjaan_pasangan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pekerjaan_pasangan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="hubungan_pasangan">
                                                    Hubungan <sup style="color: red;">*</sup>
                                                </label>
                                                <select class="form-control <?= ($validation->hasError('hubungan_pasangan')) ? 'is-invalid' : '' ?> select2 single" id="hubungan_pasangan" name="hubungan_pasangan" data-placeholder="Pilih Hubungan" style="width: 100%;">
                                                    <option></option>
                                                    <option value="Suami" <?= (old('hubungan_pasangan') == 'Suami') ? "selected" : '' ?>>Suami
                                                    </option>
                                                    <option value="Istri" <?= (old('hubungan_pasangan') == 'Istri') ? "selected" : '' ?>>Istri
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('hubungan_pasangan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pendidikan_pasangan">
                                                    Pendidikan <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('pendidikan_pasangan')) ? 'is-invalid' : '' ?>" id="pendidikan_pasangan" name="pendidikan_pasangan" placeholder="Masukkan Pendidikan" value="<?= old('pendidikan_pasangan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pendidikan_pasangan'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>ANAK</h6>
                                            <div class="form-group">
                                                <label for="nama_anak">
                                                    Nama <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('nama_anak')) ? 'is-invalid' : '' ?>" id="nama_anak" name="nama_anak" placeholder="Masukkan Nama" autofocus value="<?= old('nama_anak'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_anak'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nik_anak">
                                                    NIK <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('nik_anak')) ? 'is-invalid' : '' ?>" id="nik_anak" name="nik_anak" placeholder="Masukkan NIK" autofocus value="<?= old('nik_anak'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nik_anak'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ttl_anak">
                                                    TTL <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('ttl_anak')) ? 'is-invalid' : '' ?>" id="ttl_anak" name="ttl_anak" placeholder="Masukkan TTL" autofocus value="<?= old('ttl_anak'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('ttl_anak'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kelamin_anak">
                                                    Jenis Kelamin <sup style="color: red;">*</sup>
                                                </label>
                                                <select class="form-control <?= ($validation->hasError('jenis_kelamin_anak')) ? 'is-invalid' : '' ?> select2 single" id="jenis_kelamin_anak" name="jenis_kelamin_anak" data-placeholder="Pilih jenis kelamin" style="width: 100%;">
                                                    <option></option>
                                                    <option value="Laki-laki" <?= (old('jenis_kelamin_anak') == 'Laki-laki') ? "selected" : '' ?>>Laki-laki
                                                    </option>
                                                    <option value="Perempuan" <?= (old('jenis_kelamin_anak') == 'Perempuan') ? "selected" : '' ?>>Perempuan
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jenis_kelamin_anak'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pekerjaan_anak">
                                                    Pekerjaan <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('pekerjaan_anak')) ? 'is-invalid' : '' ?>" id="pekerjaan_anak" name="pekerjaan_anak" placeholder="Masukkan Pekerjaan" value="<?= old('pekerjaan_anak'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pekerjaan_anak'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="hubungan_anak">
                                                    Hubungan <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('hubungan_anak')) ? 'is-invalid' : '' ?>" id="hubungan_anak" name="hubungan_anak" placeholder="Masukkan Hubungan" value="<?= old('hubungan_anak'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('hubungan_anak'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pendidikan_anak">
                                                    Pendidikan Terakhir <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('pendidikan_anak')) ? 'is-invalid' : '' ?>" id="pendidikan_anak" name="pendidikan_anak" placeholder="Masukkan Pendidikan Terakhir" value="<?= old('pendidikan_anak'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pendidikan_anak'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--===== Pendidikan dan Pelatihan Pegawai =====-->

                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning alert-dismissible">
                                                <h4>3. Pendidikan dan Pelatihan Pegawai</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>PENDIDIKAN</h6>
                                            <div class="form-group">
                                                <label for="nama_sekolah">
                                                    Nama Sekolah <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('nama_sekolah')) ? 'is-invalid' : '' ?>" id="nama_sekolah" name="nama_sekolah" placeholder="Masukkan Nama Sekolah" value="<?= old('nama_sekolah'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_sekolah'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_lulus">
                                                    Tahun Lulus <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('tahun_lulus')) ? 'is-invalid' : '' ?>" id="tahun_lulus" name="tahun_lulus" placeholder="Masukkan Tahun Lulus" value="<?= old('tahun_lulus'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tahun_lulus'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">
                                                    Jurusan <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : '' ?>" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan" value="<?= old('jurusan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jurusan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_sekolah">
                                                    Alamat Sekolah <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('alamat_sekolah')) ? 'is-invalid' : '' ?>" id="alamat_sekolah" name="alamat_sekolah" placeholder="Masukkan Alamat Sekolah" value="<?= old('alamat_sekolah'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('alamat_sekolah'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="customFile">Dokumen Ijasah</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="dokumen_ijasah" name="dokumen_ijasah">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('dokumen_ijasah'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>PELATIHAN</h6>
                                            <div class="form-group">
                                                <label for="judul_pelatihan">
                                                    Judul Pelatihan <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('judul_pelatihan')) ? 'is-invalid' : '' ?>" id="judul_pelatihan" name="judul_pelatihan" placeholder="Masukkan Judul Pelatihan" value="<?= old('judul_pelatihan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('judul_pelatihan'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="penyelenggara">
                                                    Penyelenggara <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('penyelenggara')) ? 'is-invalid' : '' ?>" id="penyelenggara" name="penyelenggara" placeholder="Masukkan Penyelenggara" value="<?= old('penyelenggara'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('penyelenggara'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="tanggal_pelatihan">
                                                    Tanggal <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('tanggal_pelatihan')) ? 'is-invalid' : '' ?>" id="tanggal_pelatihan" name="tanggal_pelatihan" placeholder="Masukkan Tanggal" value="<?= old('tanggal_pelatihan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tanggal_pelatihan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="lokasi">
                                                    Lokasi <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('lokasi')) ? 'is-invalid' : '' ?>" id="lokasi" name="lokasi" placeholder="Masukkan Lokasi" value="<?= old('lokasi'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('lokasi'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="customFile">Dokumen</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="dokumen_pelatihan" name="dokumen_pelatihan" multiple>
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('dokumen_pelatihan'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--===== Penggajian Karyawan =====-->

                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning alert-dismissible">
                                                <h4>4. Penggajian Karyawan</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pangkat">
                                                    Pangkat <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('pangkat')) ? 'is-invalid' : '' ?>" id="pangkat" name="pangkat" placeholder="Masukkan Pangkat" value="<?= old('pangkat'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pangkat'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="golongan">
                                                    Golongan <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('golongan')) ? 'is-invalid' : '' ?>" id="golongan" name="golongan" placeholder="Masukkan Golongan" value="<?= old('golongan'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('golongan'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ruang">
                                                    Ruang <sup style="color: red;">*</sup>
                                                </label>
                                                <input type="text" class="form-control <?= ($validation->hasError('ruang')) ? 'is-invalid' : '' ?>" id="ruang" name="ruang" placeholder="Masukkan Ruang" value="<?= old('ruang'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('ruang'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tunjangan_pasangan">
                                                    Tunjangan Suami/Istri <sup style="color: red;">*</sup>
                                                </label>
                                                <select class="form-control <?= ($validation->hasError('tunjangan_pasangan')) ? 'is-invalid' : '' ?> select2 single" id="tunjangan_pasangan" name="tunjangan_pasangan" data-placeholder="Pilih Status Tunjangan" style="width: 100%;">
                                                    <option></option>
                                                    <option value="Ya" <?= (old('tunjangan_pasangan') == 'Ya') ? "selected" : '' ?>>Ya
                                                    </option>
                                                    <option value="Tidak" <?= (old('tunjangan_pasangan') == 'Tidak') ? "selected" : '' ?>>Tidak
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tunjangan_pasangan'); ?>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="jumlah_anak">
                                                    Jumlah Anak <sup style="color: red;">*</sup>
                                                </label>
                                                <select class="form-control <?= ($validation->hasError('jumlah_anak')) ? 'is-invalid' : '' ?> select2 single" id="jumlah_anak" name="jumlah_anak" data-placeholder="Pilih Jumlah Anak" style="width: 100%;">
                                                    <option></option>
                                                    <option value="0" <?= (old('jumlah_anak') == '0') ? "selected" : '' ?>>0
                                                    </option>
                                                    <option value="1" <?= (old('jumlah_anak') == '1') ? "selected" : '' ?>>1
                                                    </option>
                                                    <option value="2" <?= (old('jumlah_anak') == '2') ? "selected" : '' ?>>2
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_anak'); ?>
                                                </div>
                                            </div> -->

                                            <div class="form-group">
                                                <label for="jumlah_anggota_keluarga">
                                                    Jumlah Anggota Keluarga <sup style="color: red;">*</sup>
                                                </label>
                                                <select class="form-control <?= ($validation->hasError('jumlah_anggota_keluarga')) ? 'is-invalid' : '' ?> select2 single" id="jumlah_anggota_keluarga" name="jumlah_anggota_keluarga" data-placeholder="Pilih Jumlah Anggota Keluarga" style="width: 100%;">
                                                    <option></option>
                                                    <option value="1" <?= (old('jumlah_anggota_keluarga') == '1') ? "selected" : '' ?>>1
                                                    </option>
                                                    <option value="2" <?= (old('jumlah_anggota_keluarga') == '2') ? "selected" : '' ?>>2
                                                    </option>
                                                    <option value="3" <?= (old('jumlah_anggota_keluarga') == '3') ? "selected" : '' ?>>3
                                                    </option>
                                                    <option value="4" <?= (old('jumlah_anggota_keluarga') == '4') ? "selected" : '' ?>>4
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_anggota_keluarga'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="" data-type="control_button">
                                        <a class="prev" href="#carouselContent" role="button" data-slide="prev" style="display: none;">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-angle-double-left"></i> Previous
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="float-right" data-type="control_button">
                                        <a class="next" href="#carouselContent" role="button" data-slide="next">
                                            <button class="btn btn-primary">
                                                Next <i class="fas fa-angle-double-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary kirim" style="display: none;">
                                            <i class="icon fas fa-paper-plane"></i> Selesai
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>