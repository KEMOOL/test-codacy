<?php

namespace App\Models;

use CodeIgniter\Model;

class TunjanganJabatanModel extends Model
{
    protected $table = 'tunjangan_jabatan';
    protected $primaryKey = 'id_tunjangan';
    protected $allowedFields = ['jabatan', 'nominal'];
    protected $useTimestamps = true;

    public function getTunjangan($jabatan)
    {
        return $this->where('jabatan', $jabatan)->first();
    }
}
