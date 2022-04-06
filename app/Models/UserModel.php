<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $useTimesStamp = 'true';
    protected $allowedFields = ['name', 'email', 'password', 'image', 'role_id', 'is_active', 'created_at'];

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function getUserByEmail($email = false)
    {
        if ($email == false) {
            return $this->findAll();
        }
        return $this->where(['email' => $email])->first();
    }
}
