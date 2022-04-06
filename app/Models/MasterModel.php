<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterModel extends Model
{
    protected $table = 'user_menu';
    protected $useTimesStamp = 'true';
    // protected $allowedFields = ['name', 'email', 'password', 'image', 'role_id', 'is_active', 'created_at'];

    public function getMenu($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
