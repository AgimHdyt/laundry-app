<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $db;
    protected $time;
    protected $validation;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db           = \Config\Database::connect();
        $this->time = new Time('now');
        $this->session = session();
        $this->validation = \Config\Services::validation();
        if (!session()->get('email')) {
            return redirect()->to('/');
        }
    }
    public function index()
    {

        $data = [
            'title' => 'Data Users',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'users' => $this->userModel->getUser()
        ];
        return view('admin/v_index', $data);
    }

    public function addUser()
    {

        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $current_password = $this->request->getVar('current_password');
        $role_id = $this->request->getVar('role_id');
        $is_active = $this->request->getVar('is_active');

        if (!$this->validate([
            'name' => 'required|trim',
            'email' => 'required|is_unique[users.email]|trim|valid_email',
            'password' => [
                'rules' => 'required|trim|min_length[8]|matches[current_password]',
                'errors' => [
                    'matches' => 'Password don\'t match',
                    'min_length' => 'Password too short'
                ],
            ],
            'role_id' => 'required|trim',
        ])) {
            return redirect()->to('/admin')->withInput();
        }
        $save = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'image' => 'avatar.png',
            'role_id' => $role_id,
            'is_active' => $is_active,
            'created_at' => time()
        ];

        $this->userModel->save($save);

        $this->session->setFlashdata('success', 'User have been registered!');
        return redirect()->to('/admin');
    }

    public function editUser()
    {

        $id = $this->request->getVar('id');
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $current_password = $this->request->getVar('current_password');
        $role_id = $this->request->getVar('role_id');
        $is_active = $this->request->getVar('is_active');

        if (!$this->validate([
            'name' => 'required|trim',
            'email' => 'required|trim|valid_email',
            'role_id' => 'required|trim',
        ])) {
            return redirect()->to('/admin')->withInput();
        }

        $user = $this->userModel->getUser($id);
        $new_password = null;
        if (!$password) {
            $new_password = $user['password'];
        } else {
            $new_password = $password;
        }
        $update = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($new_password, PASSWORD_DEFAULT),
            'image' => 'avatar.png',
            'role_id' => $role_id,
            'is_active' => $is_active,
            'created_at' => time()
        ];

        $this->userModel->update($id, $update);

        $this->session->setFlashdata('success', 'User have been changed!');
        return redirect()->to('/admin');
    }

    public function delUser($id)
    {
        $this->userModel->delete($id);

        $this->session->setFlashdata('success', 'User have been deleted!');
        return redirect()->to('/admin');
    }

    public function getuser()
    {
        $id =  $this->request->getVar('id');
        $data = $this->userModel->getUser($id);
        echo json_encode($data);
    }
}
