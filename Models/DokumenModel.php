<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $allowedFields = ['id_pegawai', 'kategori', 'nama', 'status'];
    protected $useTimestamps = true;

    public function getDokumen($id)
    {
        return $this->where('id_pegawai', $id)->find();
    }

    public function getLastDokumenKategori($id, $kategori)
    {
        return $this->where('id_pegawai', $id)->where('kategori', $kategori)->orderBy('id_dokumen', 'DESC')->first();
    }
}
