<?php

namespace App\Models;

use CodeIgniter\Model;

class PayrollModel extends Model
{
    protected $table = 'payroll';
    protected $primaryKey = 'id_payroll';
    protected $allowedFields = ['id_pegawai', 'nama', 'unit_kerja', 'pangkat', 'status_marital', 'jumlah_anak', 'jabatan', 'gaji_pokok', 't_pasangan', 't_anak', 'lembur', 't_pangan', 't_jabatan', 't_operasional', 't_kinerja', 't_teller', 't_auditor', 'jumlah', 'bpjs_kes', 'j_pensiun', 'j_hari_tua', 'p_angsuran', 'p_lain_lain', 'jumlah_potongan', 'gaji_bersih', 'thr', 't_prestasi', 't_pendidikan', 'tantiem', 'no_rekening', 'bank', 'bulan', 'tahun'];
    protected $useTimestamps = true;

    public function getData($bulan, $tahun)
    {
        return $this->where('bulan', $bulan)->where('tahun', $tahun)->find();
    }

    public function getDetail($id_pegawai, $bulan, $tahun)
    {
        return $this->where('id_pegawai', $id_pegawai)->where('bulan', $bulan)->where('tahun', $tahun)->first();
    }

    public function getTahun()
    {
        return $this->select('tahun')->groupBy('tahun')->find();
    }
}
