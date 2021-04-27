<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table = 'pendidikan';
    protected $primaryKey = 'id_pendidikan';
    protected $allowedFields = ['id_pegawai', 'nama', 'tahun_lulus', 'tingkat', 'jurusan', 'alamat', 'ijazah'];
    protected $useTimestamps = true;

    public function getPendidikan($id)
    {
        return $this->where('id_pegawai', $id)->find();
    }
}
