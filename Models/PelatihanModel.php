<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihanModel extends Model
{
    protected $table = 'pelatihan';
    protected $primaryKey = 'id_pelatihan';
    protected $allowedFields = ['id_pegawai', 'judul', 'penyelenggara', 'tanggal', 'lokasi', 'dokumen'];
    protected $useTimestamps = true;

    public function getPelatihan($id)
    {
        return $this->where('id_pegawai', $id)->find();
    }
}
