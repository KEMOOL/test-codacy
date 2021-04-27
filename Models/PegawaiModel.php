<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $allowedFields = ['nama', 'nip', 'file_nip', 'jabatan', 'detail_jabatan', 'file_jabatan', 'nik', 'file_nik', 'no_npwp', 'file_no_npwp', 'no_bpjs_tk', 'file_no_bpjs_tk', 'no_bpjs_kes', 'file_no_bpjs_kes', 'no_dplk', 'file_no_dplk', 'tempat_lahir', 'tanggal_lahir', 'email', 'jenis_kelamin', 'agama', 'gol_darah', 'no_telp', 'alamat_rumah', 'alamat_domisili', 'status_pegawai', 'file_status_pegawai', 'status_pernikahan', 'file_status_pernikahan', 'jumlah_anak', 'pendidikan_terakhir', 'pendidikan_daftar', 'tahun_pengangkatan', 'gol_ruang_masa_kerja', 'gaji_berkala', 'file_gaji_berkala', 'no_rekening', 'bank', 'foto', 'iterasi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;


    public function getAll()
    {
        return $this->orderBy('tahun_pengangkatan')->withDeleted()->findAll();
    }

    public function getPegawaiNIK($nik)
    {
        return $this->where('nik', $nik)->first();
    }

    public function getPegawaiemail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getPegawaiJabatan($jabatan)
    {
        return $this->where('jabatan', $jabatan)->find();
    }
}
