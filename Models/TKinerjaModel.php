<?php

namespace App\Models;

use CodeIgniter\Model;

class TkinerjaModel extends Model
{
    protected $table = 't_kinerja';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_pegawai', 'bulan_tahun', 'nominal'];
    protected $useTimestamps = true;

    public function getTunjangan($tanggal, $idPegawai = false)
    {
        if ($idPegawai == false)
            return $this->select('pegawai.nama, pegawai.nik, t_kinerja.id, t_kinerja.nominal')->join('pegawai', 'pegawai.id_pegawai = t_kinerja.id_pegawai')->where('bulan_tahun', $tanggal)->find();

        return $this->select('pegawai.nama, pegawai.nik, t_kinerja.id, t_kinerja.nominal')->join('pegawai', 'pegawai.id_pegawai = t_kinerja.id_pegawai')->where('t_kinerja.id_pegawai', $idPegawai)->where('bulan_tahun', $tanggal)->first();
    }

    public function getTunjanganID($id)
    {
        return $this->select('pegawai.nama, pegawai.nik, t_kinerja.id, t_kinerja.nominal')->join('pegawai', 'pegawai.id_pegawai = t_kinerja.id_pegawai')->where('id', $id)->first();
    }

    public function getTahun()
    {
        return $this->select('YEAR(updated_at) as tahun')->groupBy('YEAR(updated_at)')->find();
    }

    public function getTunjanganPegawaiBulan($tanggal, $idPegawai)
    {
        return $this->select('pegawai.nama, pegawai.nik, t_kinerja.id, t_kinerja.nominal')->join('pegawai', 'pegawai.id_pegawai = t_kinerja.id_pegawai')->where('t_kinerja.id_pegawai', $idPegawai)->where('bulan_tahun', $tanggal)->find();
    }
}
