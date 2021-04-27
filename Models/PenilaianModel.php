<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $allowedFields = ['id_pegawai', 'indikator', 'nilai', 'dokumen'];
    protected $useTimestamps = true;

    public function getPenilaian($id)
    {
        return $this->where('id_pegawai', $id)->find();
    }
}
