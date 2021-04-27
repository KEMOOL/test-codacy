<?php

namespace App\Models;

use CodeIgniter\Model;

class CutiModel extends Model
{
    protected $table = 'cuti';
    protected $primaryKey = 'id_cuti';
    protected $allowedFields = ['id_pegawai', 'jenis_cuti', 'alasan', 'tanggal', 'lama', 'dokumen'];
    protected $useTimestamps = true;

    public function getCuti($id)
    {
        return $this->where('id_pegawai', $id)->find();
    }

    public function getCutiTahunan($id)
    {
        return $this->where('id_pegawai', $id)->where('jenis_cuti', 'Tahunan')->find();
    }
}
