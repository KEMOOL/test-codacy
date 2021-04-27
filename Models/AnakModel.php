<?php

namespace App\Models;

use CodeIgniter\Model;

class AnakModel extends Model
{
    protected $table = 'anak';
    protected $primaryKey = 'id_anak';
    protected $allowedFields = ['id_pegawai', 'nama', 'nik', 'ttl', 'jenis_kelamin', 'pekerjaan', 'hubungan', 'pendidikan'];
    protected $useTimestamps = true;

    public function getAnak($id)
    {
        return $this->where('id_pegawai', $id)->find();
    }

    public function getAnakNIK($nik)
    {
        return $this->where('nik', $nik)->first();
    }
}
