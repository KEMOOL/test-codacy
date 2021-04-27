<?php

namespace App\Models;

use CodeIgniter\Model;

class TunjanganModel extends Model
{
    protected $table = 'tunjangan';
    protected $primaryKey = 'id_tunjangan';
    protected $allowedFields = ['jabatan', 'jenis_tunjangan', 'nominal'];
    protected $useTimestamps = true;

    public function getTunjangan($jenis)
    {
        return $this->where('jenis_tunjangan', $jenis)->find();
    }

    public function getTunjanganSpesifik($jabatan, $jenis)
    {
        return $this->where('jabatan', $jabatan)->where('jenis_tunjangan', $jenis)->first();
    }
}
