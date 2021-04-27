<?php

namespace App\Models;

use CodeIgniter\Model;

class RumusModel extends Model
{
    protected $table = 'rumus';
    protected $primaryKey = 'id_rumus';
    protected $allowedFields = ['id_rumus', 'nama', 'rumus'];
    protected $useTimestamps = true;

    public function getRumus($nama)
    {
        return $this->where('nama', $nama)->first();
    }
}
