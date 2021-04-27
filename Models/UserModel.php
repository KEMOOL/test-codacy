<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'role', 'password', 'token'];
    protected $useTimestamps = true;

    public function getUser($username)
    {
        return $this->where('username', $username)->first();
    }
}
