<?php

namespace App\Models;

use CodeIgniter\Model;

class TantiemModel extends Model
{
    protected $table = 'tantiem';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_pegawai', 'bulan_tahun', 'nominal'];
    protected $useTimestamps = true;

    public function getTunjangan($tanggal, $idPegawai = false)
    {
        if ($idPegawai == false)
            return $this->select('pegawai.nama, pegawai.nik, tantiem.id, tantiem.nominal')->join('pegawai', 'pegawai.id_pegawai = tantiem.id_pegawai')->where('bulan_tahun', $tanggal)->find();

        return $this->select('pegawai.nama, pegawai.nik, tantiem.id, tantiem.nominal')->join('pegawai', 'pegawai.id_pegawai = tantiem.id_pegawai')->where('tantiem.id_pegawai', $idPegawai)->where('bulan_tahun', $tanggal)->first();
    }

    public function getTunjanganID($id)
    {
        return $this->select('pegawai.nama, pegawai.nik, tantiem.id, tantiem.nominal')->join('pegawai', 'pegawai.id_pegawai = tantiem.id_pegawai')->where('id', $id)->first();
    }

    public function getTahun()
    {
        return $this->select('YEAR(updated_at) as tahun')->groupBy('YEAR(updated_at)')->find();
    }
}
