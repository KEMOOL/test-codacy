<?php

namespace App\Models;

use CodeIgniter\Model;

class PLainlainModel extends Model
{
    protected $table = 'p_lain_lain';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_pegawai', 'bulan_tahun', 'nominal'];
    protected $useTimestamps = true;

    public function getPotongan($tanggal, $idPegawai = false)
    {
        if ($idPegawai == false)
            return $this->select('pegawai.nama, pegawai.nik, p_lain_lain.id, p_lain_lain.nominal')->join('pegawai', 'pegawai.id_pegawai = p_lain_lain.id_pegawai')->where('bulan_tahun', $tanggal)->find();

        return $this->select('pegawai.nama, pegawai.nik, p_lain_lain.id, p_lain_lain.nominal')->join('pegawai', 'pegawai.id_pegawai = p_lain_lain.id_pegawai')->where('p_lain_lain.id_pegawai', $idPegawai)->where('bulan_tahun', $tanggal)->first();
    }

    public function getPotonganID($id)
    {
        return $this->select('pegawai.nama, pegawai.nik, p_lain_lain.id, p_lain_lain.nominal')->join('pegawai', 'pegawai.id_pegawai = p_lain_lain.id_pegawai')->where('id', $id)->first();
    }

    public function getTahun()
    {
        return $this->select('YEAR(updated_at) as tahun')->groupBy('YEAR(updated_at)')->find();
    }
}
