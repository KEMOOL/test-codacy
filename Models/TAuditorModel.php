<?php

namespace App\Models;

use CodeIgniter\Model;

class TAuditorModel extends Model
{
    protected $table = 't_auditor';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_pegawai', 'bulan_tahun', 'jabatan', 'nominal'];
    protected $useTimestamps = true;

    public function getTunjangan($tanggal, $idPegawai = false)
    {
        if ($idPegawai == false)
            return $this->select('pegawai.nama, pegawai.nik, t_auditor.id, t_auditor.jabatan, t_auditor.nominal')->join('pegawai', 'pegawai.id_pegawai = t_auditor.id_pegawai')->where('bulan_tahun', $tanggal)->find();

        return $this->select('pegawai.nama, pegawai.nik, t_auditor.id, t_auditor.jabatan,t_auditor.nominal')->join('pegawai', 'pegawai.id_pegawai = t_auditor.id_pegawai')->where('t_auditor.id_pegawai', $idPegawai)->where('bulan_tahun', $tanggal)->first();
    }

    public function getTunjanganID($id)
    {
        return $this->select('pegawai.nama, pegawai.nik, t_auditor.id, t_auditor.jabatan, t_auditor.nominal')->join('pegawai', 'pegawai.id_pegawai = t_auditor.id_pegawai')->where('id', $id)->first();
    }

    public function getTahun()
    {
        return $this->select('YEAR(updated_at) as tahun')->groupBy('YEAR(updated_at)')->find();
    }
}
