<?php

namespace App\Models;

use CodeIgniter\Model;

class PangkatModel extends Model
{
    protected $table = 'flag_pangkat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bulan_tanggal'];
    protected $useTimestamps = true;

    public function getData($bulanTanggal)
    {
        return $this->where('bulan_tanggal', $bulanTanggal)->find();
    }
}
