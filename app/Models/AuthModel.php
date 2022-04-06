<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user_token';
    protected $useTimesStamp = 'true';
    protected $allowedFields = ['email', 'token', 'created_at'];

    public function getToken($data = false)
    {
        if ($data == false) {
            return $this->findAll();
        }
        return $this->where($data)->first();
    }
}
