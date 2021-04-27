<?php

namespace App\Models;

use CodeIgniter\Model;

class PasanganModel extends Model
{
    protected $table = 'pasangan';
    protected $primaryKey = 'id_pasangan';
    protected $allowedFields = ['id_pegawai', 'nama', 'nik', 'file_nik', 'ttl', 'no_telp', 'pekerjaan', 'hubungan', 'pendidikan'];
    protected $useTimestamps = true;

    public function getPasangan($id)
    {
        return $this->where('id_pegawai', $id)->find();
    }

    public function getPasanganNIK($nik)
    {
        return $this->where('nik', $nik)->first();
    }
}
