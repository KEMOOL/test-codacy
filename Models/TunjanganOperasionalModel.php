<?php

namespace App\Models;

use CodeIgniter\Model;

class TunjanganOperasionalModel extends Model
{
    protected $table = 'tunjangan_operasional';
    protected $primaryKey = 'id_tunjangan';
    protected $allowedFields = ['jabatan', 'nominal'];
    protected $useTimestamps = true;

    public function getTunjangan($jabatan)
    {
        return $this->where('jabatan', $jabatan)->first();
    }
}
