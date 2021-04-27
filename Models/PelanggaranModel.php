<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $table = 'pelanggaran';
    protected $primaryKey = 'id_pelanggaran';
    protected $allowedFields = ['id_pegawai', 'catatan', 'dokumen'];
    protected $useTimestamps = true;

    public function getPelanggaran($id)
    {
        return $this->where('id_pegawai', $id)->find();
    }
}
